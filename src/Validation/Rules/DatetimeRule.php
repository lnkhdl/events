<?php

namespace App\Validation\Rules;

use DateTime;

class DatetimeRule extends Rule
{
    private $dateTimeFormatUser = 'DD-MM-YYYY HH:MM';
    private $dateTimeFormat = 'd-m-Y H:i';

    public function setError(): void
    {
        $this->errorMessage = "The field ':name' is not a valid datetime. Required format is {$this->dateTimeFormatUser}.";
    }

    public function isValid(): bool
    {
        if ($this->value) {
            $dateTime = DateTime::createFromFormat($this->dateTimeFormat, $this->value);

            if ($dateTime instanceof DateTime && $dateTime->format($this->dateTimeFormat) == $this->value) {
                return true;
            }
        }

        return false;
    }
}
