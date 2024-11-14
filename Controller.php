<?php

namespace app\core;

use app\core\middlewares\BaseMiddleware;

/**
 * @author Sandhavi Wanigasooriya
 * @package app/core
 */

class Controller
{
	/*
	 * @var \app\core\middlewares\BaseMiddleware[]
	 */
	protected array $middlewares = [];
	public string $layout = 'main';
	public string $action = '';
	public function setLayout($layout)
	{
		$this->layout = $layout;
	}
	public function render($view, $params = [])
	{
		return Application::$app->view->renderView($view, $params);
	}
	public function registerMiddleware(BaseMiddleware $middleware)
	{
		$this->middlewares[] = $middleware;
	}
	public function getMiddlewares(): array
	{
		return $this->middlewares;
	}
}
