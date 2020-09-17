<?php

namespace App\Core\Routing\Request;

use Exception;

class RequestFactory
{
    public function create(): Request
    {
        if (!isset($_SERVER['REQUEST_URI'])) {
            throw new Exception('Cannot read REQUEST_URI.');
        }
        $path = htmlspecialchars($_SERVER['REQUEST_URI'], ENT_QUOTES | ENT_HTML5, 'UTF-8');


        if (!isset($_SERVER['REQUEST_METHOD']) && !isset($_REQUEST['_method'])) {
            throw new Exception('Cannot read REQUEST_METHOD or _method.');
        }
        $method = isset($_REQUEST['_method']) ? $_REQUEST['_method'] : $_SERVER['REQUEST_METHOD'];

        if ($method == 'POST' && !isset($_POST)) {
            throw new Exception('Cannot read POST data.');
        }
        

        $request = new Request();
        $request->setPath($path)->setMethod($method)->setPost($_POST);

        return $request;
    }
}