<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use App\Permission;

/**
 * Class PermissionTransformer
 * @package namespace App\Transformers;
 */
class PermissionTransformer extends TransformerAbstract
{

    /**
     * Transform the \Permission entity
     * @param \Permission $model
     *
     * @return array
     */
    public function transform(Permission $model)
    {
        return [
            'name' => $model->name,
            'display_name' => $model->display_name,
            'description' => $model->description
        ];
    }
}
