<?php

namespace App\Validation\Rules;

class MaxRule extends Rule
{
    public function setError(): void
    {
        $this->errorMessage = "The field ':name' is too long. Maximum length is '" . $this->condition . "'.";
    }

    public function isValid(): bool
    {
        return (strlen($this->value) <= (int)$this->condition);
    }
}