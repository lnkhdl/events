<?php

namespace App\Core;

use App\Core\DependencyInjector;

class View
{
    protected $config;

    public function __construct(DependencyInjector $di)
    {
        $this->config = $di->get('Config');
    }

    public function render(string $template, $rawData = [], array $errors = []): void
    {
        $data = $this->cleanData($rawData);

        $template = str_replace('­/', $this->config->get('DS'), $template);
        require_once $this->config->get('TEMPLATE_DIR') . $template . '.php';
    }

    public function redirect(string $location, array $message = []): void
    {
        $_SESSION['success'] = isset($message['success']) ? $message['success'] : null;
        $_SESSION['error'] = isset($message['error']) ? $message['error'] : null;

        header('Location: ' . $location);
        die();
    }

    private function cleanData($rawData)
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
