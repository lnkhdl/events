<?php

namespace App\Validation;

class EventValidator extends Validator
{
    protected function setFieldsDetails(): array
    {
        return [
            'event_name' => 'required|min:2|max:50',
            'event_city' => 'required|email'
        ];
    }
}