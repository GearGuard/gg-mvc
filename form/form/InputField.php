<?php

namespace gearguard\phpmvc\form;

use gearguard\phpmvc\Model;
use gearguard\phpmvc\form\BaseField;

class InputField extends BaseField
{
	public const TYPE_TEXT = 'text';
	public const TYPE_PASSWORD = 'password';
	public const TYPE_NUMBER = 'number';
	public const TYPE_EMAIL = 'email';
    public const TYPE_TEL = 'tel';

    private const types = [
        self::TYPE_TEXT,
        self::TYPE_PASSWORD,
        self::TYPE_NUMBER,
        self::TYPE_EMAIL,
        self::TYPE_TEL
    ];

	public string $type;
	public Model $model;
	public string $attribute;
    public bool $readonly = false;
    public bool $disabled = false;
    public string $placeholder = '';

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

	public function emailField()
	{
		$this->type = self::TYPE_EMAIL;
		return $this;
	}

    public function required(bool $required = true): self
    {
        $this->required = $required;
        return $this;
    }

    public function disabled(bool $disabled = true) : self
    {
        $this->disabled = $disabled;
        return $this;
    }

    public function readonly(bool $readonly = true) : self
    {
        $this->readonly = $readonly;
        return $this;
    }

    public function placeholder(string $placeholder): self
    {
        $this->placeholder = $placeholder;
        return $this;
    }

    public function type($type): self
    {
        if (!is_string($type)) {
            throw new \InvalidArgumentException('Type must be a string');
        } else {
            $type = strtolower($type);
            if (!in_array($type, self::types)) {
                throw new \InvalidArgumentException('Invalid type provided');
            }
        }
        $this->type = $type;
        return $this;
    }

	public function renderInput(): string
	{
		return sprintf(
			'<input type="%s" id="%s" name="%s" value="%s" placeholder="%s" class="form-input%s" %s %s %s>',
			$this->type,
			$this->attribute,
			$this->attribute,
			$this->model->{$this->attribute},
			$this->placeholder == '' ? "Enter the " . $this->model->getLabel($this->attribute): $this->placeholder,
			$this->model->hasError($this->attribute) ? ' is-invalid' : '',
            $this->readonly ? ' readonly' : '',
            $this->disabled ? ' disabled' : '',
            $this->required ? ' required' : '',
		);
	}
}
