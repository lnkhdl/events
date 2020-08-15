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

    public function render($template, $data = []): void
    {
        $template = str_replace('­/', $this->config->get('DS'), $template);
        require $this->config->get('TEMPLATE_DIR') . $template . '.php';
    }
}