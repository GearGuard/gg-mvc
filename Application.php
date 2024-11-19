<?php

namespace gearguard\phpmvc;

use gearguard\phpmvc\db\Database;
use gearguard\phpmvc\Controller;
use  gearguard\phpmvc\db\DbModel;

/**
 * @author Sandhavi Wanigasooriya
 * @package gearguard/phpmvc
 */

class Application
{
    public static string $ROOT_DIR;
    public string $layout = 'main';
    public string $userClass;
    public Router $router;
    public Request $request;
    public Response $response;
    public static Application $app;
    public ?Controller $controller = null;
    public Database $db;
    public Session $session;
    public ?UserModel $user;
    public View $view;
    public function __construct($rootPath, array $config)
    {
        $this->userClass = $config['userClass'];
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->session = new Session();
        $this->router = new Router($this->request, $this->response);
        $this->view = new View();

        $this->db = new Database($config['db']);

        $userInstance = new $this->userClass();

        $primaryValue = $this->session->get('user');
        if ($primaryValue) {
            $primaryKey = $userInstance->primaryKey();
            $this->user = $userInstance->findOne([$primaryKey => $primaryValue]);
        } else {
            $this->user = null;
        }
    }
    public static function isGuest()
    {
        return !self::$app->user;
    }
    public function run()
    {
        try {
            echo $this->router->resolve();
        } catch (\Exception $e) {
            $this->response->setStatusCode($e->getCode());
            echo $this->view->renderView('_error', [
                'exception' => $e
            ]);
        }
    }

    /**
     * @return \gearguard\phpmvc\Controller
     */

    public function getController(): \gearguard\phpmvc\Controller
    {
        return $this->controller;
    }

    /**
     * @param \gearguard\phpmvc\Controller $controller
     */

    public function setController(\gearguard\phpmvc\Controller $controller): void
    {
        $this->controller = $controller;
    }

    public function login(UserModel $user)
    {
        $this->user = $user;
        $primaryKey = $user->primaryKey();
        $primaryValue = $user->{$primaryKey};
        $this->session->set('user', $primaryValue);
        return true;
    }
    public function logout()
    {
        $this->user = null;
        $this->session->remove('user');
    }
}
