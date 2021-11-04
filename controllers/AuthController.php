<?php


namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\core\Response;
use app\models\LoginForm;
use app\models\User;

class AuthController extends Controller
{
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

}