<?php

namespace gearguard\phpmvc\middlewares;

use gearguard\phpmvc\middlewares\BaseMiddleware;
use gearguard\phpmvc\Application;
use gearguard\phpmvc\exception\ForbiddenException;

class AuthMiddleware extends BaseMiddleware
{
	public array $actions;

	public function __construct(array $actions = [])
	{
		$this->actions = $actions;
	}
	public function execute()
	{
		if (Application::isGuest()) {
			if (empty($this->actions) || in_array(Application::$app->controller->action, $this->actions)) {
				throw new ForbiddenException();
			}
		}
	}
}
