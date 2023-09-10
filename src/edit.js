/**
 * Retrieves the translation of text.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-i18n/
 */
import { __ } from '@wordpress/i18n';

/**
 * React hook that is used to mark the block wrapper element.
 * It provides all the necessary props like the class name.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/packages/packages-block-editor/#useblockprops
 */
import {
	InnerBlocks,
	InspectorControls,
	useBlockProps
} from '@wordpress/block-editor';

/**
 * Lets webpack process CSS, SASS or SCSS files referenced in JavaScript files.
 * Those files can contain any CSS code that gets applied to the editor.
 *
 * @see https://www.npmjs.com/package/@wordpress/scripts#using-css
 */
import './editor.scss';

/**
 * The edit function describes the structure of your block in the context of the
 * editor. This represents what the editor will render when the block is used.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
 *
 * @return {WPElement} Element to render.
 */

import { PanelBody, SelectControl } from '@wordpress/components';
import { Fragment } from '@wordpress/element';

export default function Edit({ attributes, setAttributes }) {
	const blockProps = useBlockProps();
	// 	const innerBlocksProps = useInnerBlocksProps()
	const { tier } = attributes;

	return (
		<Fragment>
			{/* <p>Pick Content&apos;s Tier (this text won&apos;t show)</p> */}
			<InspectorControls>
				<PanelBody title="Tier Settings">
					<SelectControl
						label="Tier"
						value={tier}
						options={[
							{ label: '0 Free', value: 0 },
							{ label: '1 Baron', value: 1 },
							{ label: '2', value: 2 },
							{ label: '3', value: 3 },
							{ label: '4', value: 4 },
							{ label: '5 Royal+', value: 5 },
							{ label: '6 Royal+', value: 6 },
							{ label: '7 Royal+', value: 7 },
							{ label: '8 Royal+', value: 8 },
						]}
						onChange={(value) =>
							setAttributes({ tier: value })
						}
					/>
				</PanelBody>
			</InspectorControls>
			<div {...blockProps}>
				{/* <div {...innerBlocksProps} /> */}
				<InnerBlocks />
			</div>
		</Fragment>
	);
}
