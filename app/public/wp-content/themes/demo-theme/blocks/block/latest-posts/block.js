const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;
const { Component, Fragment } = wp.element;
const { PanelBody, PanelRow, Button, TextControl, SelectControl, RangeControl, ServerSideRender } = wp.components;
const { RichText, InspectorControls, ColorPalette, MediaUpload } = wp.blockEditor;

registerBlockType( 'demo/latest-posts', {
	title: __( 'Latest Posts' ),
	icon: 'lock',
	category: 'common',
    attributes: {
        noPosts: {
            type: 'number',
            default: 1
        },
    },
	edit({ attributes, setAttributes }) {
        const { noPosts } = attributes;
        return (
            <Fragment>
                <InspectorControls>
                    <PanelBody title={ __( "Settings" ) }>
                        <RangeControl
                            label={ __( "No. Posts" ) }
                            value={noPosts}
                            onChange={noPosts=>setAttributes({noPosts})}
                            min={1}
                            max={10}
                        />
                    </PanelBody>
                </InspectorControls>
                <ServerSideRender 
                    block="demo/latest-posts"
                    attributes={{
                        noPosts: noPosts
                    }}
                />
            </Fragment>
		);
	},
	save() {
		return null;
	},
} );