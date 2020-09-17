<?php

namespace App\Core\Routing\Request;

class Request
{
    private $path;
    private $method;
    private $post;
    private $parameters;

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
    public function setPath($path): Request
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
    public function setMethod($method): Request
    {
        $this->method = strtoupper($method);

        return $this;
    }

    /**
     * Get the value of post
     */ 
    public function getPost(): array
    {
        return array_map('trim', $this->post);
    }

    /**
     * Set the value of post
     *
     * @return Request
     */ 
    public function setPost($post): Request
    {
        $this->post = $post;

        return $this;
    }

    /**
     * Get the value of parameters
     */ 
    public function getParameters(): array
    {
        return $this->parameters;
    }

    /**
     * Set the value of parameters
     *
     * @return Request
     */ 
    public function setParameters($parameters): Request
    {
        $this->parameters = $parameters;

        return $this;
    }
}
