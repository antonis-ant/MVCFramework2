<?php


namespace app\controllers;

use antonyanant\phpmvc\Application;
use antonyanant\phpmvc\Controller;
use antonyanant\phpmvc\Request;
use antonyanant\phpmvc\Response;
use app\models\ContactForm;

/**
 * Class SiteController
 *
 * @package app\controllers
 */
class SiteController extends Controller
{
    public function home() {
        $params = [
            'name' => "Antonis"
        ];
        return $this->render('home', $params);
    }

    public function contact(Request $request, Response $response) {
        $contact = new ContactForm();
        if ($request->isPost()) {
            $contact->loadData($request->getBody());
            if ($contact->validate() && $contact->send()) {
                Application::$app->session->setFlash('success', 'Thanks for contacting us.');
                return $response->redirect('/contact');
            }
        }

        return $this->render('contact', [
            'model' => $contact
        ]);
    }
}