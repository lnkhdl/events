<?php

namespace App\Validation\Rules;

class MinRule extends Rule
{
    public function setError(): void
    {
        $this->errorMessage = "The field ':name' is too short. Minimum length is '" . $this->condition . "'.";
    }

    public function isValid(): bool
    {
        return (strlen($this->value) >= (int)$this->condition);
    }
}