<?php
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use League\Fractal\TransformerAbstract;

if (!function_exists('fractal_collection')) {
    /**
     * Helper to return a Fractal Collection
     * @param Collection $collection
     * @param TransformerAbstract $transformer
     * @return \Spatie\Fractal\Fractal
     */
    function fractal_collection(Collection $collection, TransformerAbstract $transformer)
    {
        $json = fractal()->collection($collection)->transformWith($transformer);

        return $json;
    }
}

if (!function_exists('fractal_item')) {
    /**
     * Helper to return a Fractal Item
     * @param Collection $collection
     * @param TransformerAbstract $transformer
     * @return \Spatie\Fractal\Fractal
     */
    function fractal_item( $collection, TransformerAbstract $transformer)
    {
        $json = fractal()->item($collection)->transformWith($transformer);

        return $json;
    }
}