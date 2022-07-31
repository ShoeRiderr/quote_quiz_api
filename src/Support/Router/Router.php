<?php

namespace Src\Support\Router;

class Router
{
    private $request;
    private $supportedHttpMethods = [
        "GET",
        "POST",
        'PUT',
        'DELETE',
    ];

    public function __construct(RequestInterface $request)
    {
        $this->request = $request;
    }

    public function __call($name, $args)
    {
        list($route, $method) = $args;

        if (is_string($method[0])) {
            $method[0] = new $method[0]();
        }

        if (!in_array(strtoupper($name), $this->supportedHttpMethods)) {
            $this->invalidMethodHandler();
        }

        $this->{strtolower($name)}[$this->formatRoute($route)] = $method;
    }

    /**
     * Removes trailing forward slashes from the right of the route.
     */
    private function formatRoute(string $route)
    {
        $result = rtrim($route, '/');

        if ($result === '') {
            return '/';
        }

        return strpos($result, '?') !== false ? substr($result, 0, strpos($result, '?')) : $result;
    }

    private function invalidMethodHandler()
    {
        header("{$this->request->serverProtocol} 405 Method Not Allowed");
    }

    private function defaultRequestHandler()
    {
        header("{$this->request->serverProtocol} 404 Not Found");
    }

    /**
     * Resolves a route
     */
    public function resolve()
    {
        $methodDictionary = $this->{strtolower($this->request->requestMethod)};
        $formatedRoute = $this->formatRoute($this->request->requestUri);
        $method = $methodDictionary[$formatedRoute];

        if (is_null($method)) {
            $this->defaultRequestHandler();
            return;
        }

        echo call_user_func_array($method, [$this->request]);
    }

    public function __destruct()
    {
        $this->resolve();
    }
}
