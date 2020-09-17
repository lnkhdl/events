<?php

namespace App\Core\Routing\Response;

interface ResponseInterface
{
    public function render(string $template, $rawData = [], array $errors = []): void;
    public function redirect(string $location, array $message = []): void;
}