<?php

namespace App\Observers;

use App\Models\Reply;

// creating, created, updating, updated, saving,
// saved,  deleting, deleted, restoring, restored

class ReplyObserver
{
    public function creating(Reply $reply)
    {
        //
        $reply->content = clean($reply->content, 'user_topic_body');
    }

    /**
     * 创建后
     * @param Reply $reply
     */
    public function created(Reply $reply)
    {
        $reply->topic->increment('reply_count', 1);
    }

    public function updating(Reply $reply)
    {
        //
    }
}