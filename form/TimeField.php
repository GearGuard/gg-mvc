<?php

namespace gearguard\phpmvc\form;

use gearguard\phpmvc\Model;

class TimeField extends BaseField
{
    public bool $readonly = false;
    public bool $disabled = false;
    public string $min = '09:00';
    public string $max = '18:00';
    public string $placeholder = '';

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
        if (!preg_match('/^([01]\d|2[0-3]):([0-5]\d)$/', $min)) {
            throw new \InvalidArgumentException('Invalid time format. Use HH:MM.');
        }
        $this->min = $min;
        return $this;
    }

    public function max(string $max): self
    {
        if (!preg_match('/^([01]\d|2[0-3]):([0-5]\d)$/', $max)) {
            throw new \InvalidArgumentException('Invalid time format. Use HH:MM.');
        }
        $this->max = $max;
        return $this;
    }

    public function renderInput(): string
    {
        return sprintf(
            '<input type="time" id="%s" name="%s" value="%s" min="%s" max="%s" placeholder="%s" class="form-input%s" %s %s %s>',
            $this->attribute,
            $this->attribute,
            $this->model->{$this->attribute},
            $this->min,
            $this->max,
            $this->placeholder == '' ? "Enter the " . $this->model->getLabel($this->attribute): $this->placeholder,
            $this->model->hasError($this->attribute) ? ' is-invalid' : '',
            $this->readonly ? ' readonly' : '',
            $this->disabled ? ' disabled' : '',
            $this->required ? ' required' : '',
        );
    }
}
