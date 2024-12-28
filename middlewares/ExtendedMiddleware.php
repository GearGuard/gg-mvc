<?php

namespace gearguard\phpmvc\middlewares;

use gearguard\phpmvc\Application;
use gearguard\phpmvc\exception\NotFoundException;
use gearguard\phpmvc\middlewares\BaseMiddleware;

class ExtendedMiddleware extends BaseMiddleware
{

    public array $actions;
    private bool $condition;

    public function __construct(array $actions = [], bool $condition = false)
    {
        $this->actions = $actions;
        $this->condition = $condition;
    }

    public function execute()
    {
        if (Application::isGuest() && $this->condition == false) {
            if (empty($this->actions) || in_array(Application::$app->controller->action, $this->actions)) {
                throw new NotFoundException();
            }
        } else if (Application::isGuest())
            throw new NotFoundException();
    }
}