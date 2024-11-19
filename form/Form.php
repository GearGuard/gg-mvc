<?php

namespace gearguard\phpmvc\form;

use gearguard\phpmvc\Model;
use gearguard\phpmvc\form\Field;


class Form
{
	public static function begin($action, $method)
	{
		echo sprintf('<form action="%s" method="%s">', $action, $method); //sprintf() is a function that takes a format string and arguments and returns a formatted string.
		return new Form();
	}

	public static function end()
	{
		echo '</form>';
	}

	public function field(\gearguard\phpmvc\Model $model, $attribute)
	{
		return new InputField($model, $attribute);
	}
}
