<?php

namespace Solspace\Freeform\Fields\Pro;

use GraphQL\Type\Definition\Type;
use Solspace\Freeform\Library\Composer\Components\AbstractField;
use Solspace\Freeform\Library\Composer\Components\Fields\DataContainers\Option;
use Solspace\Freeform\Library\Composer\Components\Fields\Interfaces\ExtraFieldInterface;
use Solspace\Freeform\Library\Composer\Components\Fields\Interfaces\OptionsInterface;
use Solspace\Freeform\Library\Composer\Components\Fields\Traits\SingleValueTrait;

class OpinionScaleField extends AbstractField implements ExtraFieldInterface, OptionsInterface
{
    use SingleValueTrait;

    /** @var array */
    protected $scales;

    /** @var array */
    protected $legends;

    public function getType(): string
    {
        return self::TYPE_OPINION_SCALE;
    }

    public function getScales(): array
    {
        if (empty($this->scales)) {
            return [];
        }

        $scales = [];
        foreach ($this->scales as $index => $scale) {
            if (!isset($scale['value']) || '' === $scale['value']) {
                continue;
            }

            $value = $scale['value'];
            $label = $scale['label'] ?? $value;
            if (empty($label)) {
                $label = $value;
            }

            $scales[$index] = [
                'value' => $value,
                'label' => $label,
            ];
        }

        return $scales;
    }

    public function getOptions(): array
    {
        $options = [];
        foreach ($this->getScales() as $scale) {
            $options[] = new Option($scale['label'], $scale['value'], $this->getValue() === $scale['value']);
        }

        return $options;
    }

    public function getOptionsAsKeyValuePairs(): array
    {
        $options = [];
        foreach ($this->getOptions() as $option) {
            $options[$option->getValue()] = $option->getLabel();
        }

        return $options;
    }

    public function getLegends(): array
    {
        $legends = $this->legends ?? [];

        return array_filter($legends);
    }

    public function getContentGqlMutationArgumentType(): Type|array
    {
        $description = $this->getContentGqlDescription();
        $description[] = 'Single option value allowed.';

        $values = [];

        foreach ($this->getOptions() as $option) {
            $values[] = '"'.$option->getValue().'"';
        }

        if (!empty($values)) {
            $description[] = 'Options include '.implode(', ', $values).'.';
        }

        $legends = [];

        foreach ($this->getLegends() as $legend) {
            $legends[] = '"'.$legend['legend'].'"';
        }

        if (!empty($legends)) {
            $description[] = 'Legends include '.implode(' to ', $legends).'.';
        }

        $description = implode("\n", $description);

        return [
            'name' => $this->getHandle(),
            'type' => $this->getContentGqlType(),
            'description' => trim($description),
        ];
    }

    protected function getInputHtml(): string
    {
        if (empty($this->scales)) {
            return '';
        }

        $attributes = $this->getCustomAttributes();
        $this->addInputAttribute('class', $attributes->getClass());

        $output = '<div class="opinion-scale">';

        $output .= '<ul class="opinion-scale-scales" data-input-root>';
        foreach ($this->getScales() as $index => $scale) {
            $value = $scale['value'];
            $isSelected = $value == $this->getValue();
            $id = $this->getIdAttribute()."-{$index}";

            $output .= '<li>';

            $output .= '<input '
                .$this->getInputAttributesString()
                .$this->getAttributeString('name', $this->getHandle())
                .$this->getAttributeString('type', 'radio')
                .$this->getAttributeString('id', $id)
                .$this->getAttributeString('value', $value, true, true)
                .$this->getParameterString('checked', $isSelected)
                .$attributes->getInputAttributesAsString()
                .'/>';

            $output .= '<label for="'.$id.'">';
            $output .= $this->translate($scale['label']);
            $output .= '</label>';

            $output .= '</li>';
        }
        $output .= '</ul>';

        if ($this->getLegends()) {
            $output .= '<ul class="opinion-scale-legends">';
            foreach ($this->getLegends() as $legend) {
                $output .= '<li>';
                $output .= $legend['legend'];
                $output .= '</li>';
            }
            $output .= '</ul>';
        }

        $output .= '</div>';

        return $output;
    }
}
