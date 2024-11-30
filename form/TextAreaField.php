<?php

namespace gearguard\phpmvc\form;

class TextAreaField extends BaseField
{
	public function renderInput(): string
	{
		return sprintf(
			'<textarea id="%s" name="%s" class="notes%s" placeholder="Enter any additional details">%s</textarea>',
			$this->attribute,
			$this->attribute,
			$this->model->hasError($this->attribute) ? ' is-invalid' : '',
			$this->model->{$this->attribute}
		);
	}
}
