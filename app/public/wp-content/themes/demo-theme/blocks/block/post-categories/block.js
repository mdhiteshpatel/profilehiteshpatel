const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;
const { Component, Fragment } = wp.element;
const { PanelBody, PanelRow, Button, TextControl, SelectControl, RangeControl } = wp.components;
const { serverSideRender: ServerSideRender } = wp;
const { RichText, InspectorControls, ColorPalette, MediaUpload } = wp.blockEditor;

registerBlockType('demo/post-categories', {
    title: __('Posts Categories'),
    icon: 'lock',
    category: 'common',
    attributes: {
        categories: {
            type: 'object'
        },
        postCategory: {
            type: 'string',
            default: ''
        }
    },
    edit({ attributes, setAttributes }) {
        const { postCategory, categories } = attributes;
        if (!categories) {
            wp.apiFetch({
                url: '/wp-json/wp/v2/categories'
            }).then(categories => {
                setAttributes({
                    categories: categories
                });
            });
        }
        return (
            <Fragment>
                <InspectorControls>
                    <PanelBody title={__("Settings")}>
                        <SelectControl
                            label={__("Post Category")}
                            value={postCategory}
                            options={categories && categories.map(category => ({ value: category.name, label: category.name }))}
                            onChange={postCategory => setAttributes({ postCategory })}
                        />
                    </PanelBody>
                </InspectorControls>
                <ServerSideRender
                    block="demo/post-categories"
                    attributes={{
                        postCategory: postCategory,
                        categories: categories
                    }}
                />
            </Fragment>
        );
    },
    save() {
        return null;
    },
});