<?php
if (!function_exists('validateCreateBook')) {
    function validateCreateBook($input)
    {
        $rules = [
            'code' => 'required|unique:books,code',
            'title' => 'required',
            'year' => 'required|numeric',
            'author_id' => 'required|numeric',
            'city_id' => 'required|numeric',
            'publisher_id' => 'required|numeric'
        ];

        $response = validateData($input, $rules);
        return $response;
    }
}
