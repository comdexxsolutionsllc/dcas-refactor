<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use Modules\Api\Classes\ApiMetaData;

/**
 * Class MetaTransformer
 * @package namespace App\Transformers;
 */
class MetaTransformer extends TransformerAbstract
{

    /**
     * Transform the \Meta entity
     * @param \Meta $model
     *
     * @return array
     */
    public function transform(ApiMetaData $model)
    {
        return [
            'id'         => (int) $model->id,

            /* place your other model properties here */

            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at
        ];
    }
}
