<?php


namespace app\controllers;

use app\core\Application;
use app\core\Controller;
use app\core\Request;
use app\models\User;

class AuthController extends Controller
{
    public function login() {
        $this->setLayout('auth');
        return $this->render('login');
    }

    public function register(Request $request) {
        $this->setLayout('auth');
        $user = new User();

        if ($request->isPost()) {
            // Get post request data from form submission.
            $user->loadData($request->getBody());
            // If data passes validation & registration was successful, display success notification.
            if ($user->validate() && $user->save()) {

                Application::$app->response->redirect('/');
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

}