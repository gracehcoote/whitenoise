<?php

namespace Solspace\Freeform\Bundles\GraphQL\Resolvers;

use craft\base\ElementInterface;
use craft\errors\InvalidFieldException;
use craft\gql\base\Resolver;
use GraphQL\Type\Definition\ResolveInfo;
use Solspace\Freeform\Bundles\GraphQL\GqlPermissions;
use Solspace\Freeform\Freeform;
use Solspace\Freeform\Library\Composer\Components\Form;

class FormResolver extends Resolver
{
    public static function resolve($source, array $arguments, $context, ResolveInfo $resolveInfo): array
    {
        $arguments = self::getArguments($arguments);

        return Freeform::getInstance()->forms->getResolvedForms($arguments);
    }

    /**
     * @throws InvalidFieldException
     */
    public static function resolveOne(mixed $source, array $arguments, mixed $context, ResolveInfo $resolveInfo): ?Form
    {
        $arguments = self::getArguments($arguments);
        $arguments['limit'] = 1;

        if ($source instanceof ElementInterface) {
            return $source->getFieldValue($resolveInfo->fieldName);
        }

        $forms = Freeform::getInstance()->forms->getResolvedForms($arguments);
        $form = reset($forms);

        return $form ?: null;
    }

    private static function getArguments(array $arguments): array
    {
        $formUids = GqlPermissions::allowedFormUids();
        if ($formUids) {
            $arguments['uid'] = $formUids;
        }

        return $arguments;
    }
}
