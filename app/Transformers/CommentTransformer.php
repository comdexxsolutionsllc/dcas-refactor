<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Entities\Comment;

/**
 * Class CommentTransformer
 * @package namespace App\Transformers;
 */
class CommentTransformer extends TransformerAbstract
{

    /**
     * Transform the \Comment entity
     * @param \Comment $model
     *
     * @return array
     */
    public function transform(Comment $model)
    {
        return [
            'ticket_id' => (string)$model->ticket_id,
            'user_id' => (int)$model->user_id,
            'comment' => (string)$model->comment,
            'links' => [
                [
                    'rel' => 'self',
                    'uri' => '/comments/' . $model->id,
                ]
            ],
            'dates' => (object) [
                'created' => date('Y-m-d H:i', strtotime($model->created_at)),
                'updated' => date('Y-m-d H:i', strtotime($model->updated_at))
            ]
    }
}
