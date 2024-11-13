<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

if (!function_exists('validateUserRegister')) {
    function validateUserRegister($input)
    {
        $data = [
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => $input['password'],
            'confirm_pass' => $input['confirm_pass']
        ];

        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/[A-Z]/',
                'regex:/[a-z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*?&]/',
            ],
            'confirm_pass' => 'required|same:password'
        ];

        $response = validateData($data, $rules);
        return $response;
    }
}

if (!function_exists('validateUpdateUser')) {
    function validateUpdateUser($input)
    {
        $data = [
            'name' => $input['name'],
            'old_password' => $input['old_password']
        ];

        $rules = [
            'name' => 'required',
            'old_password' => [
                'required',
                function ($attribute, $value, $fail) {
                    if (!Hash::check($value, Auth::user()->password)) {
                        $fail('The current password is incorect.');
                    }
                },
            ]
        ];

        if (isset($input['new_password'])) {
            $passData = [
                'new_password' => $input['new_password'],
                'confirm_pass' => $input['confirm_pass']
            ];
            $passRules = [
                'new_password' =>
                [
                    'required',
                    'string',
                    'min:8',
                    'regex:/[A-Z]/',
                    'regex:/[a-z]/',
                    'regex:/[0-9]/',
                    'regex:/[@$!%*?&]/',
                ],
                'confirm_pass' => 'required|same:new_password'
            ];
            addKeyValue($data, $passData);
            addKeyValue($rules, $passRules);
        }

        if (isset($input['email']) && $input['email'] !== Auth::user()->email) {
            $emailData = ['email' => $input['email']];
            $emailRules = ['email' => 'required|email|unique:users,email'];
            addKeyValue($data, $emailData);
            addKeyValue($rules, $emailRules);
        }


        $updateArray = array();
        $response = validateData($data, $rules);

        if ($response['isSuccess']) {
            $response['isEmailChanges'] = false;
            if (isset($input['email']) && $input['email'] !== Auth::user()->email) {
                $emailData = ['email' => $input['email']];
                addKeyValue($updateArray, $emailData);
                $response['isEmailChanges'] = true;
            }
            if (isset($input['name'])) {
                $nameData = ['name' => ucwords(strtolower($input['name']))];
                addKeyValue($updateArray, $nameData);
            }
            if (isset($input['new_password'])) {
                $passData = ['password' => bcrypt($input['new_password'])];
                addKeyValue($updateArray, $passData);
            }
            $response['updateData'] = $updateArray;
        }
        return $response;
    }
}
