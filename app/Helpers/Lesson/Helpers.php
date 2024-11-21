<?php

use App\Models\Lesson;

if (!function_exists('validateCreateLesson')) {
    function validateCreateLesson($data)
    {
        $rules = [
            'name' => 'required|unique:lessons,name|min:4',
            'desc' => 'required|min:8',
            'module_id' => 'required|numeric'
        ];

        $response = validateData($data, $rules);
        return $response;
    }
}

if (!function_exists('validateUpdateLesson')) {
    function validateUpdateLesson($data)
    {
        $rules = [
            'name' => 'required|unique:lessons,name|min:4',
            'desc' => 'required|min:8',
        ];

        if (isset($data['module_id'])) {
            addKeyValue($rules, ['module_id' => 'required|numeric']);
        }

        $response = validateData($data, $rules);
        return $response;
    }
}

if (!function_exists('getMaxLessonCodeNumber')) {
    function getMaxLessonCodeNumber()
    {
        $result = Lesson::selectRaw('MAX(RIGHT(code, 5)) as max_id')
            ->where('code', 'LIKE', '%less_%')
            ->value('max_id');
        $currentMax = $result != null ? (int)$result : 0;
        $newNumber = $currentMax + 1;

        return sprintf("%05d", $newNumber);
    }
}
