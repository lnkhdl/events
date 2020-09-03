<?php

namespace App\Validation;

abstract class Validator
{
    protected $fields = [];
    protected $fieldsDetails = [];

    abstract protected function setFieldsDetails(): array;

    public function __construct(array $data)
    {
        $this->fieldsDetails = $this->setFieldsDetails();
        $this->setFields($data);
    }  
    
    private function setFields(array $data): void
    {
        foreach ($this->fieldsDetails as $name => $rules)
        {
            // Put exception here in case the file name doesnt exist, e.g. date is in HTML form but is not in EventValidator
            $this->fields[$name] = new Field($name, $data[$name], $rules);
        }
    }

    public function validate(): void
    {
        foreach ($this->fields as $field)
        {
            foreach ($field->rules as $rule)
            {
                if (!$rule->isValid()) {
                    $field->addError($rule->getError());
                }
            }
        }        
    }

    public function hasErrors(): bool
    {
        foreach ($this->fields as $field)
        {
            if (!empty($field->errors)) {
                return true;
            }
        }

        return false;
    }

    public function getErrors(): array
    {
        $errors = [];

        foreach ($this->fields as $field)
        {
            $errors[$field->name] = implode('|', $field->errors);
        }

        return $errors;
    }
}