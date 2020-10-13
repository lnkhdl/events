<?php

namespace App\Validation;

use Exception;

abstract class Validator
{
    protected $fields = [];
    protected $fieldsDetails = [];

    abstract protected function setFieldsDetails(): array;

    public function __construct(array $data)
    {
        $this->fieldsDetails = $this->setFieldsDetails();
        $this->createFields($data);
        $this->validateValues();
    }  
    
    private function createFields(array $data): void
    {
        foreach ($this->fieldsDetails as $name => $rules) {
            // Firstly, check that the field is part of the received data - for API
            // Not-required field is needed to be part of the data but can be empty
            if (array_key_exists($name, $data)) {
                $this->fields[$name] = new Field($name, $data[$name], $rules);
            } else {
                throw new Exception('Received data is not complete. "' . $name . '" is missing.', 400);
            }
        }
    }

    public function validateValues(): void
    {
        foreach ($this->fields as $field) {
            foreach ($field->rules as $rule) {
                if (!$rule->isValid()) {
                    $field->addError($rule->getError());
                }
            }
        }        
    }

    public function hasErrors(): bool
    {
        foreach ($this->fields as $field) {
            if (!empty($field->errors)) {
                return true;
            }
        }

        return false;
    }

    public function getErrors(): array
    {
        $errors = [];

        foreach ($this->fields as $field) {
            $errors[$field->name] = implode('|', $field->errors);
        }

        return $errors;
    }
}