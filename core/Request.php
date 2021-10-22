<?php


namespace app\core;

class Request
{
    /**
     * Get path of requested uri from server data.
     * @return false|mixed|string the path.
     */
    public function getPath() {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $position = strpos($path, '?');

        if (!$position) {
            return $path;
        }
        return substr($path, 0, $position);
    }

    /**
     * @return string: the method of the request (GET or POST) in lowercase.
     */
    public function getMethod() {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    /**
     * Get request data and sanitize it.
     * @return array: the sanitized request body
     */
    public function getBody() {
        $body = [];
        if ($this->getMethod() === 'get') {
            foreach ($_GET as $key => $value) {
                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }
        if ($this->getMethod() === 'post') {
            foreach ($_POST as $key => $value) {
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        return $body;
    }
}