<?php

namespace App\Validation;

class EventValidator extends Validator
{
    protected function setFieldsDetails(): array
    {
        return [
            //'example' => 'required|min:2|max:50|email|date|datetime'
            'name' => 'required|min:2|max:50',
            'city' => 'required|max:50',
            'address' => 'required|max:50',
            'date' => 'required|datetime',
            'description' => 'max:65535'
        ];
    }
}