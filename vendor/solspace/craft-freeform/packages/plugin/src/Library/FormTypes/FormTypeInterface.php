<?php

namespace Solspace\Freeform\Library\FormTypes;

interface FormTypeInterface
{
    public static function getTypeName(): string;

    public static function getPropertyManifest(): array;

    /**
     * @param mixed $defaultValue
     *
     * @return mixed
     */
    public function getMetadata(string $key, $defaultValue = null);
}
