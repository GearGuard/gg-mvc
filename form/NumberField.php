<?php

namespace gearguard\phpmvc\form;

use gearguard\phpmvc\Model;

class NumberField extends BaseField
{
    public float $step = 1;
    public ?float $min = null;
    public ?float $max = null;
    public bool $required = false;

    public function __construct(Model $model, string $attribute)
    {
        parent::__construct($model, $attribute);
    }

    public function step(float $step): self
    {
        $this->step = $step;
        return $this;
    }

    public function min(float $min): self
    {
        $this->min = $min;
        return $this;
    }

    public function max(float $max): self
    {
        $this->max = $max;
        return $this;
    }

    public function required(bool $required = true): self
    {
        $this->required = $required;
        return $this;
    }

    public function renderInput(): string
    {
        $attributes = [
            'type' => 'number',
            'id' => $this->attribute,
            'name' => $this->attribute,
            'value' => $this->model->{$this->attribute},
            'step' => $this->step,
            'class' => 'form-input' . ($this->model->hasError($this->attribute) ? ' is-invalid' : ''),
            'placeholder' => "Enter " . $this->model->getLabel($this->attribute)
        ];

        if ($this->min !== null) {
            $attributes['min'] = $this->min;
        }

        if ($this->max !== null) {
            $attributes['max'] = $this->max;
        }

        if ($this->required) {
            $attributes['required'] = 'required';
        }

        $attributeString = implode(' ', array_map(
            fn($key, $value) => "$key=\"" . htmlspecialchars($value) . "\"",
            array_keys($attributes),
            $attributes
        ));

        return sprintf('<input %s>', $attributeString);
    }
}
