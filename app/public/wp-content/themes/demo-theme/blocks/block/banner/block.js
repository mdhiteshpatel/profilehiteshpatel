const { __ } = wp.i18n;
const { registerBlockType } = wp.blocks;
const { Component, Fragment } = wp.element;
const { PanelBody, PanelRow, Button, TextControl, SelectControl, RangeControl } = wp.components;
const { RichText, InspectorControls, ColorPalette, MediaUpload } = wp.blockEditor;

registerBlockType( 'demo/banner', {
	title: __( 'Banner block title' ),
	description: __( 'banner block description' ),
	icon: 'lock',
	category: 'common',
	attributes: {
		backgroundImage: {
			type: 'string',
			default: ''
		},
		backgroundColor: {
			type: 'string',
			default: ''
		},
		headingText: {
			type: 'string',
			default: ''
		},
		paragraph: {
			type: 'string',
			default: ''
		}
	},
	edit({ attributes, setAttributes }) {
		const { headingText, paragraph, backgroundColor, backgroundImage } = attributes;
		return (
			<Fragment>
				<InspectorControls>
					<PanelBody>
						<label>Background Color</label>
						<ColorPalette
							value={backgroundColor}
							onChange={ ( value ) => setAttributes({ backgroundColor: value }) }
						/>
						<MediaUpload
							onSelect={value => {
								console.log(value);
								setAttributes({ backgroundImage: value.url });
							}}
							type="image"
							value={backgroundImage}
							render={({ open })=>(
								<Button
									onClick={ open }
									className="button button-large"
								>
									Upload Image
								</Button>
							)}
						/>
					</PanelBody>
				</InspectorControls>
				<div className="banner" style={{
					backgroundColor: backgroundColor,
					backgroundImage: `url(${backgroundImage})`
				}}>
					<div className="banner-overlay">
						<RichText
							tagName="h2"
							value={headingText}
							onChange={ ( value ) => setAttributes({ headingText: value }) }
						/>
						<RichText
							tagName="p"
							value={paragraph}
							onChange={ ( value ) => setAttributes({ paragraph: value }) }
						/>
					</div>
					<div className="banner-content">
						
					</div>
				</div>
			</Fragment>
		);
	},
	save({ attributes }) {
		const { headingText, paragraph, backgroundColor } = attributes;
		
		return (
			<div className="banner" style={{
				backgroundColor: backgroundColor
			}}>
				<div className="banner-overlay">
					<RichText.Content
						tagName="h2"
						value={headingText}
					/>
					<RichText.Content
						tagName="p"
						value={paragraph}
					/>
				</div>
				<div className="banner-content">
					
				</div>
			</div>
		);
	},
} );