<?php

namespace Solspace\Freeform\Fields;

use Solspace\Freeform\Freeform;
use Solspace\Freeform\Library\Composer\Components\AbstractField;
use Solspace\Freeform\Library\Composer\Components\Fields\Interfaces\InputOnlyInterface;
use Solspace\Freeform\Library\Composer\Components\Fields\Interfaces\NoStorageInterface;
use Solspace\Freeform\Library\Composer\Components\Fields\Interfaces\RecaptchaInterface;
use Solspace\Freeform\Library\Composer\Components\Fields\Interfaces\SingleValueInterface;
use Solspace\Freeform\Library\Composer\Components\Fields\Traits\SingleValueTrait;
use Solspace\Freeform\Models\Settings;

class RecaptchaField extends AbstractField implements NoStorageInterface, SingleValueInterface, InputOnlyInterface, RecaptchaInterface
{
    use SingleValueTrait;

    /**
     * {@inheritDoc}
     */
    public function getType(): string
    {
        return self::TYPE_RECAPTCHA;
    }

    /**
     * {@inheritDoc}
     */
    public function getHandle(): ?string
    {
        return 'grecaptcha_'.$this->getHash();
    }

    public function includeInGqlSchema(): bool
    {
        return false;
    }

    /**
     * {@inheritDoc}
     */
    protected function getInputHtml(): string
    {
        /** @var Settings $settings */
        $settings = Freeform::getInstance()->getSettings();

        $key = \Craft::parseEnv($settings->recaptchaKey);
        $type = $settings->getRecaptchaType();
        $theme = $settings->getRecaptchaTheme();
        $size = $settings->getRecaptchaSize();

        switch ($type) {
            case Settings::RECAPTCHA_TYPE_V3:
            case Settings::RECAPTCHA_TYPE_V2_INVISIBLE:
            case Settings::RECAPTCHA_TYPE_H_INVISIBLE:
                return '';

            case Settings::RECAPTCHA_TYPE_V2_CHECKBOX:
            case Settings::RECAPTCHA_TYPE_H_CHECKBOX:
            default:
                $class = Settings::RECAPTCHA_TYPE_H_CHECKBOX === $type ? 'h-captcha' : 'g-recaptcha';

                return '<div class="'.$class.'" '
                    .'data-sitekey="'.($key ?: 'invalid').'" '
                    .'data-theme="'.$theme.'" '
                    .'data-size="'.$size.'" '
                    .'></div>'
                    .'<input type="hidden" '
                    .'name="'.$this->getHandle().'" '
                    .$this->getInputAttributesString()
                    .'/>';
        }
    }
}
