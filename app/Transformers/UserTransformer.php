<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\User;

/**
 * Class UserTransformer
 * @package namespace App\Transformers;
 */
class UserTransformer extends TransformerAbstract
{

    /**
     * Transform the \User entity
     * @param User|\User $model
     * @return array
     */
    public function transform(User $model)
    {
        return [
            'name' => (string)$model->name,
            'email' => (string)$model->email,
            'is_admin' => (boolean)$model->is_admin,
            'dates' => (object) [
                'created' => date('Y-m-d H:i', strtotime($model->created_at)),
                'updated' => date('Y-m-d H:i', strtotime($model->updated_at))
            ]
        ];
    }
}
