<?php

namespace App\Core\Routing\Response;

use App\Core\Config;

class WebResponse implements ResponseInterface
{
    public function render(string $template, $rawData = [], array $errors = []): void
    {
        $data = $rawData !== [] ? $this->cleanData($rawData) : null;

        $template = str_replace('­/', Config::get('DS'), $template);
        require_once Config::get('TEMPLATE_DIR') . '/web/' . $template . '.php';
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
