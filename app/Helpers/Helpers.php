<?php

use Illuminate\Support\Facades\Validator;

if (!function_exists('addKeyValue')) {
    function addKeyValue(&$array, $data)
    {
        foreach ($data as $key => $value) {
            $array[$key] = $value;
        }
    }
}

if (!function_exists('validateData')) {
    function validateData(array $data, array $rules)
    {
        $statusCode = 200;
        $validate = true;
        $message = "";

        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            $statusCode = 422;
            $validate = false;
            $messages = $validator->messages();
            foreach ($messages->all() as $errMessage) {
                $message = $message . $errMessage . " ";
            }
        }
        $response = array(
            "statusCode" => $statusCode,
            "isSuccess" => $validate,
            "message" => $message,
        );

        return $response;
    }
}
