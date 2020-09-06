<?php

namespace App\Core;

class Request
{
    protected $domain;
    protected $path;
    protected $method;
    protected $post;

    public function __construct()
    {
        $this->domain = $_SERVER['HTTP_HOST'];
        $this->path = htmlspecialchars($_SERVER['REQUEST_URI'], ENT_QUOTES | ENT_HTML5, 'UTF-8');
        $this->method = $this->setMethod();
        $this->post = $_POST;
    }

    public function getUrl(): string
    {
        return $this->domain . $this->path;
    }

    public function getDomain(): string
    {
        return $this->domain;
    }

    public function getPath(): string
    {
        return $this->path;
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getPost(): array
    {
        return array_map('trim', $this->post);
    }

    private function setMethod(): string
    {
        return (isset($_REQUEST['_method']) ? strtoupper($_REQUEST['_method']) : $_SERVER['REQUEST_METHOD']);
    }
}
