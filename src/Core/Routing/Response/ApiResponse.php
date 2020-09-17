<?php

namespace App\Core\Routing\Response;

class ApiResponse implements ResponseInterface
{
    public function render(string $template, $rawData = [], array $errors = []): void
    {
        // TODO implement method
    }

    public function redirect(string $location, array $message = []): void
    {
        // TODO implement method
    }

}