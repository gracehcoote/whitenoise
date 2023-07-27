<?php

namespace Solspace\Freeform\Services;

use Solspace\Freeform\Events\Forms\Types\RegisterFormTypeEvent;
use Solspace\Freeform\Form\Types\Regular;

class FormTypesService extends BaseService
{
    public const EVENT_REGISTER_FORM_TYPES = 'register-form-types';

    public function getTypes(bool $includeDefault = true): array
    {
        $event = new RegisterFormTypeEvent();
        if ($includeDefault) {
            $event->addType(Regular::class);
        }

        $this->trigger(self::EVENT_REGISTER_FORM_TYPES, $event);

        return $event->getTypes();
    }
}
