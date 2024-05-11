/**
 * This represents what the editor will render when the block is used.
*
* @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-edit-save/#edit
*
* @return {WPElement} Element to render.
*/

import {
	InnerBlocks,
	InspectorControls,
	useBlockProps,
} from '@wordpress/block-editor';

import './editor.scss';

import { PanelBody, SelectControl } from '@wordpress/components';
import { Fragment } from '@wordpress/element';

export default function Edit({ attributes, setAttributes }) {
	const blockProps = useBlockProps();
	const { tier } = attributes;

	// console.log("EDIT tier ", tier, attributes)

	return (
		<Fragment>
			<InspectorControls>
				<PanelBody title="Tier Settings">
					<SelectControl
						label="Tier"
						value={tier}
						options={[
							{ label: '0 Free', value: 0 },
							{ label: '1 Baron', value: 1 },
							{ label: '2 Duke', value: 2 },
							{ label: '3 King', value: 3 },
							{ label: '4 Emperor', value: 4 },
							{ label: '5 Royal+', value: 5 },
							{ label: '6 Royal+', value: 6 },
							{ label: '7 Royal+', value: 7 },
							{ label: '8 Royal+', value: 8 },
						]}
						onChange={(value) => {
							// console.log("type ", typeof value)
							setAttributes({ tier: Number(value) })
						}}
					/>
				</PanelBody>
			</InspectorControls>
			<div {...blockProps}>
				<InnerBlocks />
			</div>
		</Fragment>
	);
}
