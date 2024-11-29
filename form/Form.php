<?php

namespace gearguard\phpmvc\form;

use gearguard\phpmvc\Model;

class Form
{
	public static function begin($action, $method)
	{
		echo sprintf('<form action="%s" method="%s">', $action, $method);
		return new Form();
	}

	public static function end()
	{
		echo '</form>';
	}

	public function field(Model $model, $attribute)
	{
		return new InputField($model, $attribute);
	}

	public function dropDownList($model, $attribute, $options)
	{
		return new DropDownField($model, $attribute, $options);
	}

	public function dateField($model, $attribute)
	{
		return new DateField($model, $attribute);
	}

	public function timeField($model, $attribute)
	{
		return new TimeField($model, $attribute);
	}
}
