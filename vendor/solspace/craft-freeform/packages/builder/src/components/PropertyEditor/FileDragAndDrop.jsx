import PropTypes from 'prop-types';
import React from 'react';
import { translate } from '../../app';
import { connect } from 'react-redux';
import BasePropertyEditor from './BasePropertyEditor';
import { AttributeEditorProperty } from './PropertyItems';
import ColorProperty from './PropertyItems/ColorProperty';
import CheckboxListProperty from './PropertyItems/CheckboxListProperty';
import CheckboxProperty from './PropertyItems/CheckboxProperty';
import SelectProperty from './PropertyItems/SelectProperty';
import TextareaProperty from './PropertyItems/TextareaProperty';
import TextProperty from './PropertyItems/TextProperty';

@connect((state) => ({
  hash: state.context.hash,
  properties: state.composer.properties,
  assetSources: state.assetSources,
  allFileKinds: state.fileKinds,
}))
export default class FileDragAndDrop extends BasePropertyEditor {
  static propTypes = {
    assetSources: PropTypes.arrayOf(
      PropTypes.shape({
        id: PropTypes.number.isRequired,
        name: PropTypes.string.isRequired,
        type: PropTypes.string.isRequired,
      })
    ).isRequired,
    allFileKinds: PropTypes.object.isRequired,
  };

  static contextTypes = {
    ...BasePropertyEditor.contextTypes,
    properties: PropTypes.shape({
      id: PropTypes.number.isRequired,
      type: PropTypes.string.isRequired,
      label: PropTypes.string.isRequired,
      handle: PropTypes.string.isRequired,
      placeholder: PropTypes.string,
      assetSourceId: PropTypes.number.isRequired,
      required: PropTypes.bool,
      fileKinds: PropTypes.array,
      maxFileSizeKB: PropTypes.number,
      fileCount: PropTypes.number,
      defaultUploadLocation: PropTypes.string,
      accent: PropTypes.string,
      theme: PropTypes.oneOf(['dark', 'light']),
    }).isRequired,
  };

  constructor(props, context) {
    super(props, context);

    this.getFileKindOptions = this.getFileKindOptions.bind(this);
  }

  render() {
    const { assetSources } = this.props;

    const {
      properties: {
        label,
        handle,
        placeholder,
        required,
        assetSourceId,
        fileKinds,
        maxFileSizeKB,
        fileCount,
        instructions,
        defaultUploadLocation,
        accent = '#3a85ee',
        theme = 'light',
      },
    } = this.context;

    const assetSourceList = [];
    assetSources.map((source) => {
      assetSourceList.push({
        key: source.id,
        value: source.name,
      });
    });

    return (
      <div>
        <TextProperty
          label="Handle"
          instructions="How you’ll refer to this field in the templates."
          name="handle"
          value={handle}
          onChangeHandler={this.updateHandle}
        />

        <TextProperty
          label="Label"
          instructions="Field label used to describe the field."
          name="label"
          value={label}
          onChangeHandler={this.update}
        />

        <CheckboxProperty
          label="This field is required?"
          name="required"
          checked={required}
          onChangeHandler={this.update}
        />

        <hr />

        <TextareaProperty
          label="Instructions"
          instructions="Field specific user instructions."
          name="instructions"
          value={instructions}
          onChangeHandler={this.update}
        />

        <TextProperty
          label="Placeholder"
          instructions="Field placeholder"
          name="placeholder"
          placeholder="Drag and drop files here or click to upload"
          value={placeholder}
          onChangeHandler={this.update}
        />

        <hr />

        <h4>{translate('Configuration')}</h4>

        <SelectProperty
          label="Style"
          instructions="Select style."
          name="theme"
          value={theme}
          onChangeHandler={this.update}
          options={[
            { key: 'light', value: 'Light' },
            { key: 'dark', value: 'Dark' },
          ]}
        />

        <ColorProperty
          label="Accent Color"
          instructions="Select accent color"
          name="accent"
          value={accent}
          onChangeHandler={this.updateKeyValue}
        />

        <SelectProperty
          label="Asset Source"
          instructions="Select an asset source to be able to store user uploaded files."
          name="assetSourceId"
          value={assetSourceId}
          onChangeHandler={this.update}
          isNumeric={true}
          emptyOption="Select an Asset Source..."
          options={assetSourceList}
        />

        <TextProperty
          label="Upload Location Subfolder"
          instructions="The subfolder path that files should be uploaded to. May contain {{ form.handle }} or {{ form.id }} variables as well."
          placeholder="path/to/subfolder"
          name="defaultUploadLocation"
          value={defaultUploadLocation}
          onChangeHandler={this.update}
        />

        <TextProperty
          label="File Count"
          instructions="Specify the maximum uploadable file count."
          name="fileCount"
          placeholder="1"
          value={fileCount}
          onChangeHandler={this.update}
          isNumeric={true}
        />

        <TextProperty
          label="Maximum File Size"
          instructions="Specify the maximum file size, in KB."
          name="maxFileSizeKB"
          placeholder="2048"
          value={maxFileSizeKB}
          onChangeHandler={this.update}
          isNumeric={true}
        />

        <CheckboxListProperty
          label="Allowed File Kinds"
          instructions="Leave everything unchecked to allow all file kinds."
          name="fileKinds"
          values={fileKinds}
          onChangeHandler={this.update}
          updateField={this.context.updateField}
          options={this.getFileKindOptions()}
        />

        <AttributeEditorProperty />
      </div>
    );
  }

  getFileKindOptions() {
    const { allFileKinds } = this.props;

    const fileKindList = [];
    for (let key in allFileKinds) {
      if (!allFileKinds.hasOwnProperty(key)) {
        continue;
      }

      fileKindList.push({
        key: key,
        value: allFileKinds[key].label,
      });
    }

    return fileKindList;
  }
}
