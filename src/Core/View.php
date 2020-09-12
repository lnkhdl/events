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

    public function render(string $template, $data = [], array $errors = []): void
    {
        $this->convertHtmlEntitiesRecursive($data);

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

    private function convertHtmlEntitiesRecursive(&$data) {
        if (is_array($data)) {
            foreach ($data as $key => $value) {
                $data[$key] = $this->convertHtmlEntitiesRecursive($value);
            }
            return $data;
        } else if (is_object($data)) {
            foreach ($data as $key => $value) {
                $data->$key = $this->convertHtmlEntitiesRecursive($value);
            }
            return $data;
        }
        return htmlentities($data, ENT_QUOTES);
    }
}