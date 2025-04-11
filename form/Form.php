<?php

namespace gearguard\phpmvc\form;

use gearguard\phpmvc\Model;
use gearguard\phpmvc\form\Field;


class Form
{
	public static function begin($action, $method, $id = '', $class = 'appointment-form')
	{
		echo sprintf('<form action="%s" method="%s" class="%s" id="%s">', $action, $method, $class, $id);
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
