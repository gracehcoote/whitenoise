import PropTypes from 'prop-types';
import React from 'react';
import BasePropertyEditor from './BasePropertyEditor';
import SelectProperty from './PropertyItems/SelectProperty';
import { connect } from 'react-redux';
import { TextareaProperty } from './PropertyItems';
import CheckboxProperty from './PropertyItems/CheckboxProperty';
import TextProperty from './PropertyItems/TextProperty';
import DatePickerProperty from './PropertyItems/DatePickerProperty';
import {
  LIMIT_ONCE_PER_EMAIL_ADDRESS,
  LIMIT_AUTH_UNLIMITED,
  LIMIT_COOKIE,
  LIMIT_IP_COOKIE,
  LIMIT_AUTH_COOKIE,
  LIMIT_AUTH_IP_COOKIE,
  LIMIT_AUTH,
} from '../../constants/Form';
import { translate } from '../../app';

@connect((state) => ({
  properties: state.composer.properties,
  metadata: state.metadata,
}))
export default class Validation extends BasePropertyEditor {
  static title = 'Validation';

  static contextTypes = {
    ...BasePropertyEditor.contextTypes,
    properties: PropTypes.shape({
      successMessage: PropTypes.string,
      errorMessage: PropTypes.string,
      showSpinner: PropTypes.bool,
      showLoadingText: PropTypes.bool,
      loadingText: PropTypes.string,
      limitFormSubmissions: PropTypes.string,
    }).isRequired,
    isPro: PropTypes.bool.isRequired,
  };

  render() {
    const { properties } = this.context;
    const { formCloseDate } = this.props.metadata;
    const {
      successMessage,
      errorMessage,
      limitFormSubmissions,
      showSpinner = false,
      showLoadingText = false,
      loadingText = 'Loading...',
    } = properties;

    const { isPro } = this.context;

    return (
      <div>
        <TextareaProperty
          label="Success Message"
          name="successMessage"
          instructions="The text to be shown at the top of the form if the submit is successful (AJAX), or load in your template with `form.successMessage`."
          value={successMessage}
          onChangeHandler={this.update}
          placeholder="Thank you for your message, we'll be in touch with you as soon as possible."
        />

        <TextareaProperty
          label="Error Message"
          name="errorMessage"
          instructions="The text to be shown at the top of the form if there are any errors upon submit (AJAX), or load in your template with `form.errorMessage`."
          value={errorMessage}
          onChangeHandler={this.update}
          placeholder="Sorry, there was an error submitting the form. Please try again."
        />

        <hr />

        <CheckboxProperty
          label="Show Loading Indicator on Submit"
          bold={true}
          instructions="Show a loading indicator on the submit button upon submittal of the form."
          name="showSpinner"
          checked={showSpinner}
          onChangeHandler={this.update}
        />

        <CheckboxProperty
          label="Show Loading Text"
          bold={true}
          instructions="Enabling this will change the submit button's label to the text of your choice."
          name="showLoadingText"
          checked={showLoadingText}
          onChangeHandler={this.update}
        />

        {showLoadingText && (
          <TextProperty label="Loading Text" name="loadingText" value={loadingText} onChangeHandler={this.update} />
        )}

        <hr />

        {isPro && (
          <SelectProperty
            label="Limit Form Submission Rate"
            instructions="Limit the number of times a user can submit the form."
            name="limitFormSubmissions"
            value={limitFormSubmissions}
            emptyOption="Do not limit"
            onChangeHandler={this.update}
            options={[
              { key: LIMIT_AUTH_UNLIMITED, value: translate('Logged in Users only (no limit)') },
              { key: LIMIT_COOKIE, value: translate('Once per Cookie only') },
              { key: LIMIT_IP_COOKIE, value: translate('Once per IP/Cookie combo') },
              { key: LIMIT_AUTH, value: translate('Once per logged in Users only') },
              { key: LIMIT_AUTH_COOKIE, value: translate('Once per logged in User or Guest Cookie only') },
              { key: LIMIT_AUTH_IP_COOKIE, value: translate('Once per logged in User or Guest IP/Cookie combo') },
              { key: LIMIT_ONCE_PER_EMAIL_ADDRESS, value: translate('Once per Email Address only') },
            ]}
          />
        )}

        <DatePickerProperty
          name="formCloseDate"
          value={formCloseDate}
          label="Stop Submissions After"
          instructions="Set a date after which the form will no longer accept submissions."
          onChangeHandler={this.updateMetadataDirectly}
        />
      </div>
    );
  }
}
