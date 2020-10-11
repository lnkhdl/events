<?php

namespace App\Validation\Rules;

class DateRule extends Rule
{
    private $dateFormatUser = 'DD-MM-YYYY';
    private $dateDelimiter = '-';

    public function setError(): void
    {
        $this->errorMessage = "The field ':name' is not a valid datetime. Required format of the date {$this->dateFormatUser}.";
    }

    public function isValid(): bool
    {
        if ($this->value && strpos($this->value, $this->dateDelimiter)) {
            list($day, $month, $year) = explode($this->dateDelimiter, $this->value);
            
            if (isset($day, $month, $year)) {
                if (checkdate($month, $day, $year)) {
                    return true;
                }
            } 
        }

        return false;
    }
}
