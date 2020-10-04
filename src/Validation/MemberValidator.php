<?php

namespace App\Validation;

class MemberValidator extends Validator
{
    protected function setFieldsDetails(): array
    {
        return [
            'first_name' => 'required|min:2|max:50',
            'last_name' => 'required|min:2|max:50',
            'email' => 'required|email|max:150'
        ];
    }
}