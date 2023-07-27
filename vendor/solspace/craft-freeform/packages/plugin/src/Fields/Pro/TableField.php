<?php

namespace Solspace\Freeform\Fields\Pro;

use GraphQL\Type\Definition\Type;
use Solspace\Freeform\Library\Composer\Components\AbstractField;
use Solspace\Freeform\Library\Composer\Components\FieldInterface;
use Solspace\Freeform\Library\Composer\Components\Fields\Interfaces\ExtraFieldInterface;
use Solspace\Freeform\Library\Composer\Components\Fields\Interfaces\MultiDimensionalValueInterface;
use Solspace\Freeform\Library\Composer\Components\Fields\Interfaces\MultipleValueInterface;
use Solspace\Freeform\Library\Composer\Components\Fields\Traits\MultipleValueTrait;

class TableField extends AbstractField implements MultipleValueInterface, MultiDimensionalValueInterface, ExtraFieldInterface
{
    use MultipleValueTrait;

    public const COLUMN_TYPE_STRING = 'string';
    public const COLUMN_TYPE_SELECT = 'select';
    public const COLUMN_TYPE_CHECKBOX = 'checkbox';

    public array $columns = [];

    /** @var array */
    protected $tableLayout;

    /** @var bool */
    protected $useScript;

    /** @var int */
    protected $maxRows;

    /** @var string */
    protected $addButtonLabel = 'Add';

    /** @var string */
    protected $addButtonMarkup;

    /** @var string */
    protected $removeButtonLabel = 'Remove';

    /** @var string */
    protected $removeButtonMarkup;

    public function getType(): string
    {
        return self::TYPE_TABLE;
    }

    /**
     * @return null|array
     */
    public function getTableLayout()
    {
        return $this->tableLayout;
    }

    public function isUseScript(): bool
    {
        return (bool) $this->useScript;
    }

    /**
     * @return null|int
     */
    public function getMaxRows()
    {
        return $this->maxRows;
    }

    /**
     * @return null|string
     */
    public function getAddButtonLabel()
    {
        $attributes = $this->getCustomAttributes();

        return $attributes->getAddButtonLabel() ?? $this->addButtonLabel;
    }

    /**
     * @param string $addButtonLabel
     */
    public function setAddButtonLabel($addButtonLabel): self
    {
        $this->addButtonLabel = $addButtonLabel;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getAddButtonMarkup()
    {
        return $this->addButtonMarkup;
    }

    /**
     * @param string $addButtonMarkup
     */
    public function setAddButtonMarkup($addButtonMarkup): self
    {
        $this->addButtonMarkup = $addButtonMarkup;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getRemoveButtonLabel()
    {
        $attributes = $this->getCustomAttributes();

        return $attributes->getRemoveButtonLabel() ?? $this->removeButtonLabel;
    }

    /**
     * @param string $removeButtonLabel
     */
    public function setRemoveButtonLabel($removeButtonLabel): self
    {
        $this->removeButtonLabel = $removeButtonLabel;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getRemoveButtonMarkup()
    {
        return $this->removeButtonMarkup;
    }

    /**
     * @param string $removeButtonMarkup
     */
    public function setRemoveButtonMarkup($removeButtonMarkup): self
    {
        $this->removeButtonMarkup = $removeButtonMarkup;

        return $this;
    }

    /**
     * @return $this|AbstractField
     */
    public function setValue(mixed $value): FieldInterface
    {
        $layout = $this->getTableLayout();

        $this->values = $values = [];
        if (!\is_array($value)) {
            return $this;
        }

        foreach ($value as $rowIndex => $row) {
            if (!\is_array($row)) {
                continue;
            }

            $hasSingleValue = false;
            $rowValues = [];
            foreach ($layout as $index => $column) {
                $value = $row[$index] ?? '';
                if ($value) {
                    $hasSingleValue = true;
                }

                $rowValues[$index] = $value;
            }

            if (!$hasSingleValue) {
                continue;
            }

            $values[] = $rowValues;
        }

        $this->values = $values;

        return $this;
    }

    public function getContentGqlType(): Type|array
    {
        return Type::listOf(Type::listOf(Type::string()));
    }

    public function getContentGqlMutationArgumentType(): Type|array
    {
        $layout = [];
        $textValuesInclude = '';
        $selectValuesInclude = '';
        $checkboxValuesInclude = '';

        foreach ($this->getTableLayout() as $column) {
            $type = $column['type'] ?? self::COLUMN_TYPE_STRING;

            if (self::COLUMN_TYPE_SELECT === $type) {
                $selectValues = [];
                $options = explode(';', $column['value']);

                foreach ($options as $option) {
                    $selectValues[] = '"'.$option.'"';
                }

                if (!empty($selectValues)) {
                    $selectValuesInclude .= '- "'.$column['label'].'" column:'."\n";
                    $selectValuesInclude .= '-- Single option value allowed.'."\n";
                    $selectValuesInclude .= '-- Options include '.implode(', ', $selectValues).'.';
                }

                $layout[] = '"'.$column['label'].'"';
            } elseif (self::COLUMN_TYPE_CHECKBOX === $type) {
                $checkboxValuesInclude .= '- "'.$column['label'].'" column:'."\n";
                $checkboxValuesInclude .= '-- Single option value allowed.'."\n";
                $checkboxValuesInclude .= '-- Option value is "'.$column['value'].'".';

                $layout[] = '"'.$column['label'].'"';
            } else {
                $textValuesInclude .= '- "'.$column['label'].'" column:'."\n";
                $textValuesInclude .= '-- Single value allowed.';

                $layout[] = '"'.$column['label'].'"';
            }
        }

        $description = [];
        $description[] = $this->getInstructions();
        $description[] = 'Expected layout [['.implode(', ', $layout).']].';
        $description[] = $textValuesInclude;
        $description[] = $selectValuesInclude;
        $description[] = $checkboxValuesInclude;
        $description = implode("\n", $description);

        return [
            'name' => $this->getHandle(),
            'type' => $this->getContentGqlType(),
            'description' => trim($description),
        ];
    }

    protected function getInputHtml(): string
    {
        $layout = $this->getTableLayout();
        if (!$layout || !\is_array($layout)) {
            return '';
        }

        $attributes = $this->getCustomAttributes();
        $classString = $attributes->getClass().' '.$this->getInputClassString();

        $handle = $this->getHandle();
        $values = $this->getValue();
        if (empty($values)) {
            $values = [];
            foreach ($layout as $column) {
                $type = $column['type'] ?? self::COLUMN_TYPE_STRING;
                if (self::COLUMN_TYPE_CHECKBOX === $type) {
                    $values[] = null;
                } else {
                    $values[] = $column['value'] ?? null;
                }
            }

            $values = [$values];
        }

        $id = $this->getIdAttribute();
        $output = '<table'
            .' data-freeform-table'
            .' data-input-root'
            .$this->getAttributeString('class', $classString)
            .$this->getAttributeString('id', $id)
            .'>';

        $output .= '<thead>';
        $output .= '<tr>';
        foreach ($layout as $column) {
            $label = $column['label'] ?? '';

            $output .= '<th'.$this->getAttributeString('class', $attributes->getTableLabelsClass()).'>'.htmlentities($label).'</th>';
        }
        $output .= '<th>&nbsp;</th></tr>';
        $output .= '</thead>';

        $output .= '<tbody>';
        foreach ($values as $rowIndex => $row) {
            $output .= '<tr>';

            foreach ($layout as $index => $column) {
                $type = $column['type'] ?? self::COLUMN_TYPE_STRING;
                $defaultValue = $column['value'] ?? '';
                $value = $row[$index] ?? $defaultValue;
                $value = htmlentities($value);

                $output .= '<td>';

                $name = "{$handle}[{$rowIndex}][{$index}]";

                switch ($type) {
                    case self::COLUMN_TYPE_CHECKBOX:
                        $value = $row[$index];
                        $output .= '<input'
                            .$this->getAttributeString('type', 'checkbox')
                            .$this->getAttributeString('name', $name)
                            .$this->getAttributeString('class', $attributes->getTableCheckboxInputClass())
                            .$this->getAttributeString('value', $defaultValue)
                            .$this->getAttributeString('data-default-value', $defaultValue)
                            .($value ? ' checked' : '')
                            .' />';

                        break;

                    case self::COLUMN_TYPE_SELECT:
                        $options = explode(';', $defaultValue);
                        $output .= '<select'
                            .$this->getAttributeString('name', $name)
                            .$this->getAttributeString('class', $attributes->getTableSelectInputClass())
                            .'>';

                        foreach ($options as $option) {
                            $output .= '<option'
                                .$this->getAttributeString('value', $option)
                                .($option === $value ? ' selected' : '')
                                .'>'
                                .$option
                                .'</option>';
                        }

                        $output .= '</select>';

                        break;

                    case self::COLUMN_TYPE_STRING:
                    default:
                        $output .= '<input'
                            .$this->getAttributeString('type', 'text')
                            .$this->getAttributeString('class', $attributes->getTableTextInputClass())
                            .$this->getAttributeString('name', $name)
                            .$this->getAttributeString('value', $value)
                            .$this->getAttributeString('data-default-value', $defaultValue)
                            .' />';

                        break;
                }

                $output .= '</td>';
            }

            $output .= '<td>';
            if ($this->getRemoveButtonMarkup()) {
                $output .= $this->getRemoveButtonMarkup();
            } else {
                $output .= '<button'
                    .' data-freeform-table-remove-row'
                    .$this->getAttributeString('class', $attributes->getRemoveButtonClass())
                    .' type="button"'
                    .'>'
                    .$this->getRemoveButtonLabel()
                    .'</button>';
            }
            $output .= '</td>';

            $output .= '</tr>';
        }
        $output .= '</tbody>';
        $output .= '</table>';

        if ($this->getAddButtonMarkup()) {
            $output .= $this->getAddButtonMarkup();
        } else {
            $output .= '<button'
                .' data-freeform-table-add-row'
                .$this->getAttributeString('class', $attributes->getAddButtonClass())
                .' data-target="'.$id.'"'
                .' type="button"'
                .'>'
                .$this->getAddButtonLabel()
                .'</button>';
        }

        return $output;
    }
}
