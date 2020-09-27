<?php

declare(strict_types=1);

namespace App\Core\Routing\Request;

class Request
{
    private $path;
    private $method;
    private $post = [];
    private $parameters = [];

    /**
     * Get the value of path
     */ 
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * Set the value of path
     *
     * @return Request
     */ 
    public function setPath(string $path): Request
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get the value of method
     */ 
    public function getMethod(): string
    {
        return $this->method;
    }

    /**
     * Set the value of method
     *
     * @return Request
     */ 
    public function setMethod(string $method): Request
    {
        $this->method = strtoupper($method);

        return $this;
    }

    /**
     * Get the value of post
     */ 
    public function getPost(): ?array
    {
        return $this->post ? array_map('trim', $this->post) : null;
    }

    /**
     * Set the value of post
     *
     * @return Request
     */ 
    public function setPost(array $post): Request
    {
        $this->post = $post;

        return $this;
    }

    /**
     * Get the value of parameters
     */ 
    public function getParameters(): ?array
    {
        return $this->parameters ?? null;
    }

    /**
     * Set the value of parameters
     *
     * @return Request
     */ 
    public function setParameters(array $parameters): Request
    {
        $this->parameters = $parameters;

        return $this;
    }
}
