<?php

namespace Modules\Internal\Models;

use App\BaseModel;
//use Illuminate\Database\Eloquent\Model;

class Comment extends BaseModel {

    protected $fillable = [ 'ticket_id', 'user_id', 'comment' ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }


    public function user()
    {
        return $this->belongsTo('\App\User');
    }
}
