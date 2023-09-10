/**
 * Registers a new block provided a unique name and an object defining its behavior.
 *
 * @see https://developer.wordpress.org/block-editor/reference-guides/block-api/block-registration/
 */
import { registerBlockType } from '@wordpress/blocks';
import './style.scss';

import Edit from './edit';
import Save from './save';
import metadata from './block.json';

registerBlockType(metadata.name, {
	/**
	 * @see ./edit.js
	 */
	// render_callback: render_substar_block,
	render: metadata.render,
	edit: Edit,
	save: Save,
	attributes: metadata.attributes,
});

