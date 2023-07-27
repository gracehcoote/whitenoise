<?php

namespace Solspace\Freeform\Fields\Pro;

use GraphQL\Type\Definition\Type;
use Solspace\Freeform\Library\Composer\Components\AbstractField;
use Solspace\Freeform\Library\Composer\Components\Fields\DataContainers\Option;
use Solspace\Freeform\Library\Composer\Components\Fields\Interfaces\ExtraFieldInterface;
use Solspace\Freeform\Library\Composer\Components\Fields\Interfaces\OptionsInterface;
use Solspace\Freeform\Library\Composer\Components\Fields\Interfaces\SingleValueInterface;
use Solspace\Freeform\Library\Composer\Components\Fields\Traits\SingleValueTrait;
use Solspace\Freeform\Library\Composer\Components\Validation\Constraints\NumericConstraint;
use Solspace\Freeform\Library\Helpers\HashHelper;

class RatingField extends AbstractField implements SingleValueInterface, ExtraFieldInterface, OptionsInterface
{
    use SingleValueTrait;
    public const MIN_VALUE = 3;
    public const MAX_VALUE = 10;

    /** @var int */
    protected $maxValue;

    /** @var string */
    protected $colorIdle;

    /** @var string */
    protected $colorHover;

    /** @var string */
    protected $colorSelected;

    /**
     * {@inheritDoc}
     */
    public function getType(): string
    {
        return self::TYPE_RATING;
    }

    public function getOptions(): array
    {
        $options = [];
        for ($i = 1; $i <= $this->getMaxValue(); ++$i) {
            $options[] = new Option($i, $i, $i === (int) $this->getValue());
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

    public function getMaxValue(): int
    {
        $maxValue = (int) $this->maxValue;

        if ($maxValue < self::MIN_VALUE) {
            $maxValue = self::MIN_VALUE + 1;
        }

        if ($maxValue > self::MAX_VALUE) {
            $maxValue = self::MAX_VALUE;
        }

        return $maxValue;
    }

    public function getColorIdle(): string
    {
        return $this->colorIdle;
    }

    public function getColorHover(): string
    {
        return $this->colorHover;
    }

    public function getColorSelected(): string
    {
        return $this->colorSelected;
    }

    /**
     * {@inheritDoc}
     */
    public function getConstraints(): array
    {
        $constraints = parent::getConstraints();
        $constraints[] = new NumericConstraint(
            1,
            $this->getMaxValue(),
            null,
            null,
            null,
            false,
            null,
            null,
            null,
            $this->translate('Rating must be between {{min}} and {{max}}')
        );

        return $constraints;
    }

    public function getContentGqlType(): Type|array
    {
        return Type::int();
    }

    public function getContentGqlMutationArgumentType(): Type|array
    {
        $description = $this->getContentGqlDescription();
        $description[] = 'Single option value allowed.';

        $values = [];

        foreach ($this->getOptions() as $option) {
            $values[] = $option->getValue();
        }

        if (!empty($values)) {
            $description[] = 'Options include '.implode(', ', $values).'.';
        }

        $description = implode("\n", $description);

        return [
            'name' => $this->getHandle(),
            'type' => $this->getContentGqlType(),
            'description' => trim($description),
        ];
    }

    /**
     * {@inheritDoc}
     */
    protected function getInputHtml(): string
    {
        $attributes = $this->getCustomAttributes();

        $output = $this->getStyles();

        $generatedClass = $this->getFormSha().'-'.$this->getHandle().'-rating-wrapper';

        $output .= '<div>';
        $output .= '<span class="'.$generatedClass.' form-rating-field-wrapper"';
        $output .= $this->getAttributeString('id', $this->getIdAttribute());
        $output .= '>';

        $maxValue = $this->getMaxValue();
        for ($i = $maxValue; $i >= 1; --$i) {
            $starId = $this->getIdAttribute().'_star_'.$i;

            $output .= '<input';
            $output .= $this->getInputAttributesString();
            $output .= $this->getAttributeString('name', $this->getHandle());
            $output .= $this->getAttributeString('type', 'radio');
            $output .= $this->getAttributeString('id', $starId);
            $output .= $this->getAttributeString('class', $attributes->getClass());
            $output .= $this->getAttributeString('value', $i, false);
            $output .= $this->getParameterString('checked', (int) $this->getValue() === $i);
            $output .= $attributes->getInputAttributesAsString();
            $output .= ' />'.\PHP_EOL;

            $output .= '<label';
            $output .= $this->getAttributeString('for', $starId);
            $output .= '></label>';
        }
        $output .= '</span>';
        $output .= '<div style="clear: both;"></div>';
        $output .= '</div>';

        return $output;
    }

    private function getStyles(): string
    {
        $freeform = \Yii::getAlias('@freeform');
        $cssPath = $freeform.'/Resources/css/front-end/fields/rating.css';

        $output = '<style>'.\PHP_EOL;
        $output .= @file_get_contents($cssPath);
        $output .= '</style>';

        $replaceMap = [
            'formhash' => $this->getFormSha(),
            'fieldname' => $this->getHandle(),
            'coloridle' => $this->getColorIdle(),
            'colorhover' => $this->getColorHover(),
            'colorselected' => $this->getColorSelected(),
        ];

        return str_replace(array_keys($replaceMap), $replaceMap, $output);
    }

    private function getFormSha(): string
    {
        return 'f'.HashHelper::sha1($this->getForm()->getHash(), 6);
    }
}
