<?php

namespace Solspace\Freeform\Elements\Actions;

use craft\elements\actions\SetStatus;
use craft\elements\db\ElementQueryInterface;
use Solspace\Freeform\Elements\Submission;
use Solspace\Freeform\Freeform;

class SetSubmissionStatusAction extends SetStatus
{
    public ?int $statusId = null;

    public function getTriggerLabel(): string
    {
        return Freeform::t('Set Status');
    }

    public function defineRules(): array
    {
        $statusIds = Freeform::getInstance()->statuses->getAllStatusIds();

        $rules = [];
        $rules[] = [['statusId'], 'required'];
        $rules[] = [
            ['statusId'],
            'in',
            'range' => $statusIds,
        ];

        return $rules;
    }

    public function getTriggerHtml(): string
    {
        return \Craft::$app->getView()->renderTemplate(
            'freeform/_components/fieldTypes/setStatusTrigger',
            [
                'statuses' => Freeform::getInstance()->statuses->getAllStatuses(),
            ]
        );
    }

    public function performAction(ElementQueryInterface $query): bool
    {
        $elementsService = \Craft::$app->getElements();

        /** @var Submission[] $submissions */
        $submissions = $query->all();
        $failCount = 0;

        static $allowedFormIds;
        if (null === $allowedFormIds) {
            $allowedFormIds = Freeform::getInstance()->submissions->getAllowedWriteFormIds();
        }

        foreach ($submissions as $submission) {
            // Skip if there's nothing to change
            if ((int) $submission->statusId === (int) $this->statusId) {
                continue;
            }

            if (!\in_array($submission->formId, $allowedFormIds, false)) {
                continue;
            }

            $submission->statusId = $this->statusId;

            if (false === $elementsService->saveElement($submission)) {
                // Validation error
                ++$failCount;
            }
        }

        // Did all of them fail?
        if ($failCount === \count($submissions)) {
            if (1 === \count($submissions)) {
                $this->setMessage(Freeform::t('Could not update status due to a validation error.'));
            } else {
                $this->setMessage(Freeform::t('Could not update statuses due to validation errors.'));
            }

            return false;
        }

        if (0 !== $failCount) {
            $this->setMessage(Freeform::t('Status updated, with some failures due to validation errors.'));
        } else {
            if (1 === \count($submissions)) {
                $this->setMessage(Freeform::t('Status updated.'));
            } else {
                $this->setMessage(Freeform::t('Statuses updated.'));
            }
        }

        return true;
    }
}
