<?php

namespace gearguard\phpmvc\form;

use gearguard\phpmvc\Model;
use gearguard\phpmvc\form\BaseField;

class InputField extends BaseField
{
	public const TYPE_TEXT = 'text';
	public const TYPE_PASSWORD = 'password';
	public const TYPE_NUMBER = 'number';

	public string $type;
	public Model $model;
	public string $attribute;

	/**
	 * @param \gearguard\phpmvc\Model $model
	 * @param string $attribute
	 */
	public function __construct(\gearguard\phpmvc\Model $model, string $attribute)
	{
		$this->type = self::TYPE_TEXT;
		parent::__construct($model, $attribute);
	}


	public function passwordField()
	{
		$this->type = self::TYPE_PASSWORD;
		return $this;
	}

	public function renderInput(): string
	{
		return sprintf(
			'
			<input type="%s" name="%s" value="%s" placeholder="Enter your %s" class="form-input%s">',
			$this->type,
			$this->attribute,
			$this->model->{$this->attribute},
			$this->model->getLabel($this->attribute),
			$this->model->hasError($this->attribute) ? 'is-invalid' : '',
		);
	}
}
