<?php

namespace gearguard\phpmvc\form;

class TextAreaField extends BaseField
{
    public bool $readonly = false;
    public bool $disabled = false;
    public string $placeholder = '';
    public int $rows;
    public int $cols;

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

    public function rows(int $rows): self
    {
        $this->rows = $rows;
        return $this;
    }

    public function cols(int $columns): self
    {
        $this->cols = $columns;
        return $this;
    }

	public function renderInput(): string
	{
        $rowncols = '';

        if (isset($this->rows)){
            $rowncols = $rowncols . "rows=". $this->rows . " ";
        }

        if (isset($this->cols)) {
            $rowncols = $rowncols . "cols=" . $this->cols . " ";
        }

		return sprintf(
			'<textarea id="%s" name="%s" class="notes%s" placeholder="%s" %s %s %s %s>%s</textarea>',
			$this->attribute,
			$this->attribute,
			$this->model->hasError($this->attribute) ? ' is-invalid' : '',
            $this->placeholder == '' ? "Enter any additional details " : $this->placeholder,
            $rowncols,
            $this->readonly ? ' readonly' : '',
            $this->disabled ? ' disabled' : '',
            $this->required ? ' required' : '',
			$this->model->{$this->attribute}
		);
	}
}
