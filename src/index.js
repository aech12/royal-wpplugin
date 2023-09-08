import { registerBlockType } from '@wordpress/blocks';
import { InnerBlocks, InspectorControls, useBlockProps } from '@wordpress/block-editor';
import { PanelBody, SelectControl } from '@wordpress/components';
import { Fragment } from '@wordpress/element';

const editBlock = ({ attributes, setAttributes }) => {
    const { tier } = attributes;

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
                            { label: '2', value: 2 },
                            { label: '3', value: 3 },
                            { label: '4', value: 4 },
                            { label: '5 Royal+', value: 5 },
                            { label: '6 Royal+', value: 6 },
                            { label: '7 Royal+', value: 7 },
                            { label: '8 Royal+', value: 8 }
                        ]}
                        onChange={(value) => setAttributes({ tier: value })}
                    />
                </PanelBody>
            </InspectorControls>
            <div {...useBlockProps()}>
                <InnerBlocks />
            </div>
        </Fragment>
    );
};

registerBlockType('my-namespace/my-container-block', {
    title: 'Subscriberstar Block',
    icon: 'text',
    category: 'layout',
    attributes: {
        tier: {
            type: 'number',
            default: 1,
        },
    },
    render_callback: render_my_container_block,
    edit: editBlock,
    save() {
        return (
            <div className="my-container-block">
                <InnerBlocks.Content />
            </div>
        );
    },
});
