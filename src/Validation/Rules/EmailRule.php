<?php

namespace App\Validation\Rules;

class EmailRule extends Rule
{
    public function setError(): void
    {
        $this->errorMessage = "The field ':name' is not a valid email address.";
    }

    public function isValid(): bool
    {
        return (filter_var($this->value, FILTER_VALIDATE_EMAIL));
    }
}