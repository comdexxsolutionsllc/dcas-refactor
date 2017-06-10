<?php

namespace DCASDomain\Support;

abstract class Sanitizer {

    protected $rules;


    /**
     * @param array $data
     * @param array $rules
     *
     * @return array
     */
    public function sanitize(array $data, array $rules = null)
    {
        $rules = $rules ?: $this->getRules();

        foreach ($rules as $field => $sanitizers)
        {
            if ( ! isset($data[$field]))
            {
                continue;
            }

            $data[$field] = $this->applySanitizersTo($data[$field], $sanitizers);
        }

        return $data;
    }


    /**
     * @param $sanitizers
     *
     * @return array
     */
    private function normalizeSanitizers($sanitizers)
    {
        return is_array($sanitizers) ? $sanitizers : explode('|', $sanitizers);
    }


    /**
     * @param $value
     * @param $sanitizers
     *
     * @return string
     */
    private function applySanitizersTo($value, $sanitizers)
    {
        foreach ($this->normalizeSanitizers($sanitizers) as $sanitizer)
        {
            $method = 'sanitize'.ucwords($sanitizer);

            $value = method_exists($this, $method) ? call_user_func([ $this, $method ],
                $value) : call_user_func($sanitizer, $value);
        }

        return $value;
    }


    /**
     * @return mixed
     */
    public function getRules()
    {
        return $this->rules;
    }
}
