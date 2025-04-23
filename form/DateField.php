<?php
namespace gearguard\phpmvc\form;

class DateField extends BaseField
{
    public bool $readonly = false;
    public bool $disabled = false;
    public string $placeholder = '';

    public function required(bool $required = true): self
    {
        $this->required = $required;
        return $this;
    }

    public function disabled(bool $disabled = true): self
    {
        $this->disabled = $disabled;
        return $this;
    }

    public function readonly(bool $readonly = true): self
    {
        $this->readonly = $readonly;
        return $this;
    }

    public function placeholder(string $placeholder): self
    {
        $this->placeholder = $placeholder;
        return $this;
    }

    public function renderInput(): string
    {
        return sprintf(
            '<input type="date" id="%s" name="%s" value="%s" placeholder="%s" class="form-input%s" %s %s %s>',
            $this->attribute,
            $this->attribute,
            $this->model->{$this->attribute},
            $this->placeholder == '' ? "Enter the " . $this->model->getLabel($this->attribute) : $this->placeholder,
            $this->model->hasError($this->attribute) ? ' is-invalid' : '',
            $this->readonly ? ' readonly' : '',
            $this->disabled ? ' disabled' : '',
            $this->required ? ' required' : '',
        );
    }
}
