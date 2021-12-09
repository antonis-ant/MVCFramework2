<?php


namespace app\controllers;

use tonyanant\phpmvc\Application;
use tonyanant\phpmvc\Controller;
use tonyanant\phpmvc\Request;
use tonyanant\phpmvc\Response;
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
                $response->redirect('/contact');
                return;
            }
        }
        // Request is GET, just load contact view along with form field data (if there is any).
        return $this->render('contact', [
            'model' => $contact
        ]);
    }
}