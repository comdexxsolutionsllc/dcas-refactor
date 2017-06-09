<?php

namespace Modules\Internal\Models;

use App\BaseModel;
//use Illuminate\Database\Eloquent\Model;

class Ticket extends BaseModel {

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

    public function category()
    {
        return $this->belongsTo(Category::class);
    }


    public function comments()
    {
        return $this->hasMany(Comment::class);
    }


    public function user()
    {
        return $this->belongsTo('\App\User');
    }
}
