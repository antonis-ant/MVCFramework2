<?php


namespace app\core;


use app\core\middleware\baseMiddleware;

class Controller
{
    public string $layout = 'main';
    public string $action = '';
    /**
     * @var \app\core\middleware\BaseMiddleware[]
     */
    protected array $middleware = [];

    public function render($view, $params = []) {
        return Application::$app->view->renderView($view, $params);
    }

    public function setLayout($layout) {
        $this->layout = $layout;
    }

    public function registerMiddleware(BaseMiddleware $middleware) {
        $this->middleware[] = $middleware;
    }

    public function getMiddleware(): array {
        return $this->middleware;
    }

    public function setMiddleware(array $middleware): void {
        $this->middleware = $middleware;
    }


}