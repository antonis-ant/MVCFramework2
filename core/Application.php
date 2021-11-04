<?php

namespace app\core;

/**
 * Class Application
 * @package app\core
 */
class Application
{
    public static string $ROOT_DIR;
    public string $userClass;
    public Router $router;
    public Request $request;
    public Response $response;
    public Session $session;
    public Database $db;
    public ?DbModel $user; // the "?" means the variable can be null (e.g. guest is browsing the website).
    public static Application $app;
    public Controller $controller;

    public function __construct($rootPath, array $config) {
        // Set config options
        /*
         * Get the user class from config. We do it this way since the User class exists outside the core
         * and we want to be able to deploy the core independently and have it work for any class name.
         * */
        $this->userClass = $config['userClass'];
        $this->db = new Database($config['db']);
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;

        // Initialize Core Classes.
        $this->request = new Request();
        $this->response = new Response();
        $this->session = new Session();
        $this->router = new Router($this->request, $this->response);

        // Get login session data
        // Get logged-in user's id.
        $primaryValue = $this->session->get('user');
        // User is logged-in get user data from database.
        if ($primaryValue) {
            $this->user = new $this->userClass();
            $primaryKey = $this->user->primaryKey(); // get user class primary key NAME.
            $this->user = $this->user->findOne([$primaryKey => $primaryValue]); // fetch user.
        } else {
            $this->user = null;
        }
    }

    public static function isGuest() {
        return !self::$app->user;
    }

    public function run() {
        echo $this->router->resolve();
    }

    /**
     * @return Controller
     */
    public function getController(): Controller {
        return $this->controller;
    }

    /**
     * @param Controller $controller
     */
    public function setController(Controller $controller): void {
        $this->controller = $controller;
    }

    public function login(DbModel $user) {
        $this->user = $user;
        $primaryKey = $user->primaryKey();
        $primaryValue = $user->{$primaryKey};
        $this->session->set('user', $primaryValue);

        return true;
    }

    public function logout() {
        $this->user = null;
        $this->session->remove('user');
    }

}