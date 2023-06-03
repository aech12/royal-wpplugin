/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import { useBlockProps } from '@wordpress/block-editor';
import { registerBlockType } from '@wordpress/blocks';
import { __ } from '@wordpress/i18n';
import { Fragment } from '@wordpress/element';
import { PanelBody, SelectControl } from '@wordpress/components';

/**
 * The save function defines the way in which the different attributes should
 * be combined into the final markup, which is then serialized by the block
 * editor into `post_content`.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#save
 *
 * @return {WPElement} Element to render.
 */
export default function save() {
  return (
    <Fragment>
      <img {...useBlockProps.save()} />
    </Fragment>
  );
}

registerBlockType('my-plugin/image-block', {
  title: __('My Image Block'),
  icon: 'format-image',
  category: 'common',
  supports: {
    align: true,
    html: false,
  },
  attributes: {
    imageUrl: {
      type: 'string',
      source: 'attribute',
      selector: 'img',
      attribute: 'src',
    },
    imageAlt: {
      type: 'string',
      source: 'attribute',
      selector: 'img',
      attribute: 'alt',
    },
    imageSize: {
      type: string,
      default: 'medium',
    },
    imageValue: {
      type: 'number',
      default: 1,
    },
  },
  edit: ({ attributes, setAttributes }) => {
    const { imageUrl, imageAlt, imageSize, imageValue } = attributes;

    const sizes = [
      { label: __('Thumbnail'), value: 'thumbnail' },
      { label: __('Medium'), value: 'medium' },
      { label: __('Large'), value: 'large' },
      { label: __('Full Size'), value: 'full' },
    ];

    return <Fragment>
      <img
        src={imageUrl}
        alt={imageAlt}
        {...useBlockProps()}
      />
      <PanelBody title={__('Image Settings')}>
        <SelectControl
          label={__('Image Size')}
          value={imageSize}
          options={sizes}
          onChange={(value) => setAttributes({ imageSize: value })}
        />
        <SelectControl
          label={__('Image Value')}
          value={imageValue}
          options={[
            { label: '1', value: 1 },
            { label: '2', value: 2 },
            { label: '3', value: 3 },
            { label: '4', value: 4 },
          ]}
          onChange={(value) => setAttributes({ imageValue: parseInt(value) })}
        />
      </PanelBody>
    </Fragment>
);
}