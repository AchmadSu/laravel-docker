<?php

if (!function_exists('validateCreateValuation')) {
    function validateCreateValuation($data)
    {
        $rules = [
            'user_id' => 'required|numeric',
            'module_id' => 'required|numeric',
            'lesson_id' => 'required|numeric',
            'point' => ['required', 'regex:/^\d+(\.\d{1,2})?$/']
        ];

        $response = validateData($data, $rules);
        return $response;
    }
}
