<?php

namespace App\Core\Routing\Response;

use App\Core\Config;
use Exception;

class Response implements ResponseInterface
{
    public $type = '';

    public function __construct(string $type)
    {
        $this->setType($type);
    }

    private function setType(string $type) {
        if ($type == 'web') {
            $this->type = 'web';
        } elseif ($type == 'api') {
            $this->type = 'api';
        } else {
            throw new Exception($type . ' response type is not supported.', 500);
        }
    }

    public function render(string $template, $rawData = [], array $errors = []): void
    {
        $data = $rawData !== [] ? $this->cleanData($rawData) : null;

        $template = str_replace('­/', Config::get('DS'), $template);
        require_once Config::get('TEMPLATE_DIR') . '/' . $this->type . '/' . $template . '.php';
    }

    public function redirect(string $location, array $message = []): void
    {
        $_SESSION['success'] = isset($message['success']) ? $message['success'] : null;
        $_SESSION['error'] = isset($message['error']) ? $message['error'] : null;

        if ($this->type === 'api') {
            header('Location: ' . '/api' . $location);
        } else {
            header('Location: ' . $location);
        }       
        
        die();
    }

    public function cleanData($rawData)
    {
        if (is_array($rawData)) {
            foreach ($rawData as $key => $value) {   
                $data[$key] = $this->cleanData($value);
            }
            return $data;
        } else if (is_object($rawData)) {
            $reflection = new \ReflectionObject($rawData);
            foreach ($reflection->getProperties() as $property) {
                $property->setAccessible(true);
                $key = $property->getName();
                $value = $property->getValue($rawData);
                $data[$key] = $this->cleanData($value);
            }
            return $data;
        }
        return htmlentities($rawData, ENT_QUOTES);
    }
}