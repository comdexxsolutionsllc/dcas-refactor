<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Role;

/**
 * Class RoleTransformer
 * @package namespace App\Transformers;
 */
class RoleTransformer extends TransformerAbstract
{

    /**
     * Transform the \Role entity
     * @param \Role $model
     *
     * @return array
     */
    public function transform(Role $model)
    {
        return [
            'name' => $model->name,
            'display_name' => $model->display_name,
            'description' => $model->description
        ];
    }
}
