import { combineReducers } from 'redux';
import { composer, context, formId } from './Composer';
import { craftFields } from './CraftFields';
import { customFields } from './CustomFields';
import { duplicateHandles } from './DuplicateHandles';
import { assetSources, fields, fileKinds, formStatuses, specialFields } from './Fields';

import { templates } from './FormTemplates';
import { successTemplates } from './SuccessTemplates';
import { generatedOptionLists } from './GeneratedOptionLists';
import { integrations } from './Integrations';
import { paymentGateways } from './PaymentGateways';
import { mailingLists } from './MailingLists';
import { notifications } from './Notifications';
import { placeholders } from './Placeholders';
import { sourceTargets } from './SourceTargets';
import { formTypes } from './FormTypes';
import metadata from './Metadata';
import { sites } from './Sites';

export default combineReducers({
  csrfToken: (state = {}) => state,
  formId,
  formTypes,
  fields,
  specialFields,
  mailingLists,
  sourceTargets,
  formStatuses,
  generatedOptionLists,
  composer,
  context,
  craftFields,
  notifications,
  assetSources,
  templates,
  placeholders,
  duplicateHandles,
  integrations,
  paymentGateways,
  fileKinds,
  customFields,
  sites,
  metadata,
  successTemplates,
});
