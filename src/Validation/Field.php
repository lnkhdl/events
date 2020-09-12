<?php

namespace App\Validation;

class Field
{
    public $name;
    protected $value;
    public $rules = [];
    public $errors = [];

    public function __construct(string $name, string $value, string $rules)
    {
        $this->name = $name;
        $this->value = $value;
        $this->setRules($rules);
    }

    private function setRules(string $rules): void
    {
        $rules = explode('|', $rules);

        foreach ($rules as $rule) {
            if (strpos($rule, ':') !== false) {
                list($ruleName, $ruleCondition) = explode(':', $rule);
            } else {
                $ruleName = $rule;
                $ruleCondition = '';
            }
            
            $this->createRule($ruleName, $ruleCondition);  
        }
    }

    private function createRule(string $name, string $condition): void
    {
        try {
            $reflRuleClass = new \ReflectionClass('\\App\\Validation\\Rules\\' . ucfirst($name) . 'Rule');
            $this->rules[$name] = $reflRuleClass->newInstance(array('value' => $this->value, 'condition' => $condition));
        } catch (\ReflectionException $e) {
            //echo $e->getMessage();
            echo "Unexpected error happened.\r\n";
            die();
        }        
    }

    public function addError(string $errorMessage): void
    {
        array_push($this->errors, str_replace(':name', $this->name, $errorMessage));
    }
}
