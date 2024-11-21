<?php

use App\Models\Module;

if (!function_exists('validateCreateModule')) {
    function validateCreateModule($data)
    {
        $rules = [
            'name' => 'required|unique:modules,name|min:4',
            'desc' => 'required|min:8',
        ];

        $response = validateData($data, $rules);
        return $response;
    }
}

if (!function_exists('getMaxModuleCodeNumber')) {
    function getMaxModuleCodeNumber()
    {
        $result = Module::selectRaw('MAX(RIGHT(code, 5)) as max_id')
            ->where('code', 'LIKE', '%mod_%')
            ->value('max_id');
        $currentMax = $result != null ? (int)$result : 0;
        $newNumber = $currentMax + 1;

        return sprintf("%05d", $newNumber);
    }
}
