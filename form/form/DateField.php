<?php

namespace gearguard\phpmvc\form;

use gearguard\phpmvc\Model;

class DateField extends BaseField
{
    public bool $readonly = false;
    public bool $disabled = false;
    public string $placeholder = '';
    public string $min = '';
    public string $max = '';

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

    public function min(string $min): self
    {
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $min)) {
            throw new \InvalidArgumentException('Invalid date format. Use YYYY-MM-DD.');
        }
        $this->min = $min;
        return $this;
    }

    public function max(string $max): self
    {
        if (!preg_match('/^\d{4}-\d{2}-\d{2}$/', $max)) {
            throw new \InvalidArgumentException('Invalid date format. Use YYYY-MM-DD.');
        }
        $this->max = $max;
        return $this;
    }

    public function renderInput(): string
    {
        return sprintf(
            '<input type="date" id="%s" name="%s" value="%s" %s %s placeholder="%s" class="form-input%s" %s %s %s>',
            $this->attribute,
            $this->attribute,
            $this->model->{$this->attribute},
            $this->min ? 'min="' . $this->min . '"' : '',
            $this->max ? 'max="' . $this->max . '"' : '',
            $this->placeholder == '' ? "Enter the " . $this->model->getLabel($this->attribute): $this->placeholder,
            $this->model->hasError($this->attribute) ? ' is-invalid' : '',
            $this->readonly ? ' readonly' : '',
            $this->disabled ? ' disabled' : '',
            $this->required ? ' required' : '',
        );
    }
}
