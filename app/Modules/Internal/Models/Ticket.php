<?php

namespace Modules\Internal\Models;

use App\BaseModel;
use DCASDomain\Traits\UuidForKey;

//use Illuminate\Database\Eloquent\Model;

class Ticket extends BaseModel
{
//    use UuidForKey;

    protected $fillable = [
        'user_id',
        'category_id',
        'ticket_id',
        'title',
        'priority',
        'message',
        'status'
    ];

    protected $dates = ['updated_at'];

    /**
     * Is the ticket closed
     * @return array|boolean [status; statusToLower; class]
     */
    public function isClosed($ticket, $fullOutput = true)
    {
        return ($fullOutput === true) ? (($ticket->status === 'Closed') ? ['Open', 'open', 'btn btn-xs btn-success'] : ['Close', 'close', 'btn btn-xs btn-danger']) : (($ticket->status === 'Closed') ? true : false);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('\App\User');
    }
}
