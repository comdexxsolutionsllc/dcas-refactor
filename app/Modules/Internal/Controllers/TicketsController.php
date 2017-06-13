<?php

namespace Modules\Internal\Controllers;

use App\Http\Controllers\Controller;
use App\NullCategory;
use App\User;
use Cache;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Modules\Internal\Emails\AppMailer;
use Modules\Internal\Models\Category;
use Modules\Internal\Models\Ticket;

class TicketsController extends Controller {

    protected $categories;

    /**
     * TicketsController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');

        $this->categories = Cache::remember('categories', 15, function() {
            return Category::all();
        });
    }


    /**
     * Display a listing of the resource.
     * @return Response
     */
    public function index(User $user, Ticket $ticket)
    {
        $this->authorize('view', $ticket);

        $tickets = Ticket::paginate(10);
//        dd($tickets);
        $categories = $this->categories;

        return view('Internal::tickets.index', compact('tickets', 'categories'));
    }


    /**
     * Show the form for creating a new resource.
     * @return Response
     */
    public function create()
    {
        $categories = $this->categories;

        return view('Internal::tickets.create', compact('categories'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  Request $request
     *
     * @param \Modules\Internal\Emails\AppMailer $mailer
     * @return Response
     */
    public function store(Request $request, AppMailer $mailer)
    {
        $this->validate($request, [
            'title'    => 'required',
            'category' => 'required',
            'priority' => 'required',
            'message'  => 'required'
        ]);

        $ticket = new Ticket([
            'title'       => $request->input('title'),
            'user_id'     => Auth::user()->id,
            'ticket_id'   => Modules\Internal\Classes\TicketId::Generate(),
            'category_id' => $request->input('category'),
            'priority'    => $request->input('priority'),
            'message'     => $request->input('message'),
            'status'      => "Open",
        ]);

        $ticket->save();

        $mailer->sendTicketInformation(Auth::user(), $ticket);

        return redirect()->back()->with("status", "A ticket with ID: #$ticket->ticket_id has been opened.");

    }


    /**
     * Show the specified resource.
     * @return Response
     */
    public function show($ticket_id)
    {
        $ticket = Ticket::where('ticket_id', $ticket_id)->with('comments')->firstOrFail();

        $category = ($ticket->category ? $ticket->category : new NullCategory);

        return view('Internal::tickets.show', compact('ticket', 'category'));
    }


    /**
     * Show the form for editing the specified resource.
     * @return Response
     */
    public function edit()
    {
        return view('Internal::tickets.edit');
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  Request $request
     *
     * @return Response
     */
    public function update(Request $request)
    {
    }


    /**
     * Remove the specified resource from storage.
     * @return Response
     */
    public function destroy()
    {
    }


    /**
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function userTickets()
    {
        $tickets = Ticket::where('user_id', Auth::user()->id)->paginate(10);
        $categories = $this->categories;

        return view('Internal::tickets.user_tickets', compact('tickets', 'categories'));
    }


    /**
     *
     * @param           $ticket_id
     * @param AppMailer $mailer
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function close($ticket_id, AppMailer $mailer)
    {
        $ticket = Ticket::where('ticket_id', $ticket_id)->firstOrFail();

        $this->authorize('close', $ticket);

        $ticket->status = 'Closed';

        $ticket->save();

        $ticketOwner = $ticket->user;

        $mailer->sendTicketStatusNotification($ticketOwner, $ticket);

        return redirect()->back()->with("status", "The ticket has been closed.");
    }
}
