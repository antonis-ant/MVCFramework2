<?php

namespace app\core;

/**
 * Class Router
 * @package app\core
 */
class Router
{
    public Request $request;
    public Response $response;
    protected array $routes = [];

    /**
     * Router constructor.
     * @param Request $request
     * @param Response $response
     */
    public function __construct(Request $request, Response $response) {
        $this->request = $request;
        $this->response = $response;
    }

    /**
     * Handles the routing for get requests.
     *
     * @param $path : The page name yo route to.
     * @param $callback " The function for the content of the page.
     */
    public function get($path, $callback) {
        // Save route on assoc array, setting the path as key and the callback as value
        $this->routes['get'][$path] = $callback;
    }

    /**
     * @param $path
     * @param $callback
     */
    public function post($path, $callback) {
        // Save route on assoc array, setting the path as key and the callback as value
        $this->routes['post'][$path] = $callback;
    }

    /**
     * Using the request object to determine the path and the method that where requested,
     * find the corresponding callback function provided to finally route to the appropriate content.
     * In other words, resolve the request.
     */
    public function resolve() {
        // Get route path from request object
        $path = $this->request->getPath();
        // Also get the method from request object
        $method = $this->request->getMethod();
        // Get callback method from routes using the method and path keys
        $callback = $this->routes[$method][$path] ?? false;

        // Callback method was not found, render "Not Found" view.
        if (!$callback) {
            $this->response->setStatusCode(404);
            return $this->renderView("_404");
        }
        // String is given as callback, find & render corresponding view.
        if (is_string($callback)) {
            return $this->renderView($callback);
        }
        // SiteController class method is given, instantiate new SiteController object.
        if (is_array($callback)) {
            $callback[0] = new $callback[0]();
        }
        // Actual callback function given, call user provided callback.
        return call_user_func($callback, $this->request);
    }

    public function renderView($view, $params = []) {
        $layoutContent = $this->layoutContent('main');
        $viewContent = $this->renderOnlyView($view, $params);
        // Look for specified placeholder inside layout content and replace it with the specified view content.
        return str_replace('{{content}}', $viewContent, $layoutContent);
    }

    protected function layoutContent($layout) {
        // Start buffering the output of included file below, without displaying it.
        ob_start();
        include_once Application::$ROOT_DIR. "/views/layouts/$layout.php";
        // Return buffered content & clear buffer.
        return ob_get_clean();
    }

    protected function renderOnlyView($view, $params) {
        foreach ($params as $key => $value) {
            $$key = $value;
        }
        ob_start();
        include_once Application::$ROOT_DIR. "/views/$view.php";
        return ob_get_clean();
    }
}
