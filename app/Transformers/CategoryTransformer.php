<?php

namespace App\Transformers;

use League\Fractal\TransformerAbstract;
use Modules\Internal\Models\Category;

/**
 * Class CategoryTransformer
 * @package namespace App\Transformers;
 */
class CategoryTransformer extends TransformerAbstract
{

    /**
     * Transform the \Category entity
     * @param \Category $model
     *
     * @return array
     */
    public function transform(Category $model)
    {
        return [
            'name' => $model->name
        ];
    }
}
