<?php

namespace App\Validation\Rules;

use DateTime;

class DatetimeRule extends Rule
{
    private $htmlDateTimeFormat = 'Y-m-d\TH:i';

    public function setError(): void
    {
        $this->errorMessage = "The field ':name' is not a valid datetime.";
    }

    public function isValid(): bool
    {
        if ($this->value) {
            $dateTime = DateTime::createFromFormat($this->htmlDateTimeFormat, $this->value);

            if ($dateTime instanceof DateTime && $dateTime->format($this->htmlDateTimeFormat) == $this->value) {
                return true;
            }
        }

        return false;
    }
}
