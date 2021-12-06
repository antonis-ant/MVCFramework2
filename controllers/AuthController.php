<?php


namespace tonyanant\phpmvc\controllers;

use tonyanant\phpmvc\Application;
use tonyanant\phpmvc\Controller;
use tonyanant\phpmvc\middleware\AuthMiddleware;
use tonyanant\phpmvc\Request;
use tonyanant\phpmvc\Response;
use app\models\LoginForm;
use app\models\User;

class AuthController extends Controller
{

    public function __construct() {
        $this->registerMiddleware(new AuthMiddleware(['profile']));
    }

    public function login(Request $request, Response $response) {
        $loginForm = new LoginForm();
        if ($request->isPost()) {
            // Get post request data from form submission.
            $loginForm->loadData($request->getBody());
            // Data passes validation & login was successful.
            if ($loginForm->validate() && $loginForm->login()) {
                $response->redirect('/');
                return;
            }
        }

        $this->setLayout('auth');
        return $this->render('login', [
            'model' => $loginForm
        ]);
    }

    public function register(Request $request) {
        $this->setLayout('auth');
        $user = new User();

        if ($request->isPost()) {
            // Get post request data from form submission.
            $user->loadData($request->getBody());
            // Data passes validation & registration was successful.
            if ($user->validate() && $user->save()) {
                Application::$app->session->setFlash('success', 'Thanks for registering!');
                Application::$app->response->redirect('/');
                exit;
            }
            // If validation or registration failed, redirect to register form & pass the model data to the view.
            return $this->render('register', [
                'model' => $user
            ]);
        }

        // Method is GET, just return the register view, passing the model.
        return $this->render('register', [
            'model' => $user
        ]);
    }

    public function logout(Request $request, Response $response) {
        Application::$app->logout();
        $response->redirect('/');
    }

    public function profile() {
        return $this->render('profile');
    }



}