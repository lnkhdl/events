<?php

namespace App\Validation\Rules;

abstract class Rule
{
    protected $value;
    protected $condition;
    protected $errorMessage;

    abstract public function isValid(): bool;
    abstract public function setError(): void;

    public function __construct(array $data)
    {
        $this->value = $data['value'];
        $this->condition = $data['condition'];
        $this->setError();
    }
   
    public function getError(): string
    {
        return $this->errorMessage;
    }
}