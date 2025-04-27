<?php

namespace gearguard\phpmvc\form;

use gearguard\phpmvc\Model;

abstract class BaseField
{
	public Model $model;
	public string $attribute;
    public bool $required = false;

	public function __construct(Model $model, string $attribute)
	{
		$this->model = $model;
		$this->attribute = $attribute;
	}

	abstract public function renderInput();

	public function __toString()
    {
		return sprintf(
			'
            <div class="form-group">
                <label for="%s" class="form-label">%s%s</label>
                %s
                <div class="invalid-feedback">
                    %s
                </div>
            </div>
            ',
			$this->attribute,
			$this->model->getLabel($this->attribute),
            $this->required ? '<span class="required-dot"> *</span>' : '',
            $this->renderInput(),
			$this->model->getFirstError($this->attribute)
		);
	}
}
