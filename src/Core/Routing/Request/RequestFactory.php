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

        $request = new Request();
        $request->setPath($path)->setMethod($method);

        if (strtoupper($method) === 'POST' || strtoupper($method) === 'PUT') {
            if (!isset($_POST) || $_POST == null) {
                // API
                $data = json_decode(file_get_contents("php://input"), true);
                if ($data == false || $data == null) {
                    throw new Exception('Cannot read POST/PUT data.', 400);
                } else {
                    $request->setPost($data);
                }       
            } else {
                $request->setPost($_POST);
            }            
        }

        return $request;
    }
}