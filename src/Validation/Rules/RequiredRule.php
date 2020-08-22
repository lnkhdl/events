<?php

namespace App\Validation\Rules;

class RequiredRule extends Rule
{
    public function setError(): void
    {
        $this->errorMessage = "The field ':name' is required.";
    }

    public function isValid(): bool
    {
        return ($this->value != "" && $this->value != null && !empty($this->value) && isset($this->value));
    }
}