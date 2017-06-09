<?php

namespace Modules\Internal\Controllers;

use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Modules\Internal\Emails\AppMailer;
use Modules\Internal\Models\Comment;

class CommentsController extends Controller {

    use ValidatesRequests;


    public function postComment(Request $request, AppMailer $mailer)
    {
        $this->validate($request, [
            'comment' => 'required'
        ]);

        $comment = Comment::create([
            'ticket_id' => $request->input('ticket_id'),
            'user_id'   => Auth::user()->id,
            'comment'   => $request->input('comment'),
        ]);

        // send mail if the user commenting is not the ticket owner
        if ($comment->ticket->user->id !== Auth::user()->id)
        {
            $mailer->sendTicketComments($comment->ticket->user, Auth::user(), $comment->ticket, $comment);
        }

        return redirect()->back()->with("status", "Your comment has be submitted.");
    }
}
