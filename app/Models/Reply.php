<?php

namespace App\Models;

class Reply extends Model
{
    protected $fillable = ['content'];
    //表之间的关联关系
    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
