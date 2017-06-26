<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use Modules\Internal\Models\Ticket;


/**
 * Class TicketTransformerTransformer
 * @package namespace App\Transformers;
 */
class TicketTransformer extends TransformerAbstract
{

    /**
     * List of resources to automatically include
     *
     * @var array
     */
    protected $defaultIncludes = [
        'user'
    ];


    /**
     * Transform the \Ticket entity
     * @param \TicketTransformer $model
     *
     * @return array
     */
    public function transform(Ticket $model)
    {
        return [
            'user_id' => (int)$model->user_id,
            'category_id' => (int)$model->category_id,
            'ticket_id' => (string)$model->ticket_id,
            'ticket_data' => (array)[
                'title' => (string)$model->title,
                'message' => (string)$model->message,
                'tags' => (array)[
                    'priority' => (string)$model->priority,
                    'status' => (string)$model->status
                ],
            ],
            'links' => [
                [
                    'rel' => 'self',
                    'uri' => '/tickets/' . $model->ticket_id,
                ]
            ],
            'dates' => (object) [
                'created' => date('Y-m-d H:i', strtotime($model->created_at)),
                'updated' => date('Y-m-d H:i', strtotime($model->updated_at))
            ]
        ];
    }

    /**
     * Include User
     *
     * @param Ticket $ticket
     * @return \League\Fractal\Resource\Item
     */
    public function includeUser(Ticket $ticket)
    {
        $user = $ticket->user;

        return $this->item($user, new UserTransformer);
    }
}
