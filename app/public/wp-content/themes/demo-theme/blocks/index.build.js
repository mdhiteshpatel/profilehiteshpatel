/******/ (function(modules) { // webpackBootstrap
/******/ 	// The module cache
/******/ 	var installedModules = {};
/******/
/******/ 	// The require function
/******/ 	function __webpack_require__(moduleId) {
/******/
/******/ 		// Check if module is in cache
/******/ 		if(installedModules[moduleId]) {
/******/ 			return installedModules[moduleId].exports;
/******/ 		}
/******/ 		// Create a new module (and put it into the cache)
/******/ 		var module = installedModules[moduleId] = {
/******/ 			i: moduleId,
/******/ 			l: false,
/******/ 			exports: {}
/******/ 		};
/******/
/******/ 		// Execute the module function
/******/ 		modules[moduleId].call(module.exports, module, module.exports, __webpack_require__);
/******/
/******/ 		// Flag the module as loaded
/******/ 		module.l = true;
/******/
/******/ 		// Return the exports of the module
/******/ 		return module.exports;
/******/ 	}
/******/
/******/
/******/ 	// expose the modules object (__webpack_modules__)
/******/ 	__webpack_require__.m = modules;
/******/
/******/ 	// expose the module cache
/******/ 	__webpack_require__.c = installedModules;
/******/
/******/ 	// define getter function for harmony exports
/******/ 	__webpack_require__.d = function(exports, name, getter) {
/******/ 		if(!__webpack_require__.o(exports, name)) {
/******/ 			Object.defineProperty(exports, name, {
/******/ 				configurable: false,
/******/ 				enumerable: true,
/******/ 				get: getter
/******/ 			});
/******/ 		}
/******/ 	};
/******/
/******/ 	// getDefaultExport function for compatibility with non-harmony modules
/******/ 	__webpack_require__.n = function(module) {
/******/ 		var getter = module && module.__esModule ?
/******/ 			function getDefault() { return module['default']; } :
/******/ 			function getModuleExports() { return module; };
/******/ 		__webpack_require__.d(getter, 'a', getter);
/******/ 		return getter;
/******/ 	};
/******/
/******/ 	// Object.prototype.hasOwnProperty.call
/******/ 	__webpack_require__.o = function(object, property) { return Object.prototype.hasOwnProperty.call(object, property); };
/******/
/******/ 	// __webpack_public_path__
/******/ 	__webpack_require__.p = "";
/******/
/******/ 	// Load entry module and return exports
/******/ 	return __webpack_require__(__webpack_require__.s = 0);
/******/ })
/************************************************************************/
/******/ ([
/* 0 */
/***/ (function(module, __webpack_exports__, __webpack_require__) {

"use strict";
Object.defineProperty(__webpack_exports__, "__esModule", { value: true });
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__block_banner_block__ = __webpack_require__(1);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_0__block_banner_block___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_0__block_banner_block__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__block_paragraph_block__ = __webpack_require__(2);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_1__block_paragraph_block___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_1__block_paragraph_block__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__block_latest_posts_block__ = __webpack_require__(3);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_2__block_latest_posts_block___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_2__block_latest_posts_block__);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__block_post_categories_block__ = __webpack_require__(4);
/* harmony import */ var __WEBPACK_IMPORTED_MODULE_3__block_post_categories_block___default = __webpack_require__.n(__WEBPACK_IMPORTED_MODULE_3__block_post_categories_block__);





/***/ }),
/* 1 */
/***/ (function(module, exports) {

var __ = wp.i18n.__;
var registerBlockType = wp.blocks.registerBlockType;
var _wp$element = wp.element,
    Component = _wp$element.Component,
    Fragment = _wp$element.Fragment;
var _wp$components = wp.components,
    PanelBody = _wp$components.PanelBody,
    PanelRow = _wp$components.PanelRow,
    Button = _wp$components.Button,
    TextControl = _wp$components.TextControl,
    SelectControl = _wp$components.SelectControl,
    RangeControl = _wp$components.RangeControl;
var _wp$blockEditor = wp.blockEditor,
    RichText = _wp$blockEditor.RichText,
    InspectorControls = _wp$blockEditor.InspectorControls,
    ColorPalette = _wp$blockEditor.ColorPalette,
    MediaUpload = _wp$blockEditor.MediaUpload;


registerBlockType('demo/banner', {
	title: __('Banner block title'),
	description: __('banner block description'),
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
	edit: function edit(_ref) {
		var attributes = _ref.attributes,
		    setAttributes = _ref.setAttributes;
		var headingText = attributes.headingText,
		    paragraph = attributes.paragraph,
		    backgroundColor = attributes.backgroundColor,
		    backgroundImage = attributes.backgroundImage;

		return wp.element.createElement(
			Fragment,
			null,
			wp.element.createElement(
				InspectorControls,
				null,
				wp.element.createElement(
					PanelBody,
					null,
					wp.element.createElement(
						'label',
						null,
						'Background Color'
					),
					wp.element.createElement(ColorPalette, {
						value: backgroundColor,
						onChange: function onChange(value) {
							return setAttributes({ backgroundColor: value });
						}
					}),
					wp.element.createElement(MediaUpload, {
						onSelect: function onSelect(value) {
							console.log(value);
							setAttributes({ backgroundImage: value.url });
						},
						type: 'image',
						value: backgroundImage,
						render: function render(_ref2) {
							var open = _ref2.open;
							return wp.element.createElement(
								Button,
								{
									onClick: open,
									className: 'button button-large'
								},
								'Upload Image'
							);
						}
					})
				)
			),
			wp.element.createElement(
				'div',
				{ className: 'banner', style: {
						backgroundColor: backgroundColor,
						backgroundImage: 'url(' + backgroundImage + ')'
					} },
				wp.element.createElement(
					'div',
					{ className: 'banner-overlay' },
					wp.element.createElement(RichText, {
						tagName: 'h2',
						value: headingText,
						onChange: function onChange(value) {
							return setAttributes({ headingText: value });
						}
					}),
					wp.element.createElement(RichText, {
						tagName: 'p',
						value: paragraph,
						onChange: function onChange(value) {
							return setAttributes({ paragraph: value });
						}
					})
				),
				wp.element.createElement('div', { className: 'banner-content' })
			)
		);
	},
	save: function save(_ref3) {
		var attributes = _ref3.attributes;
		var headingText = attributes.headingText,
		    paragraph = attributes.paragraph,
		    backgroundColor = attributes.backgroundColor;


		return wp.element.createElement(
			'div',
			{ className: 'banner', style: {
					backgroundColor: backgroundColor
				} },
			wp.element.createElement(
				'div',
				{ className: 'banner-overlay' },
				wp.element.createElement(RichText.Content, {
					tagName: 'h2',
					value: headingText
				}),
				wp.element.createElement(RichText.Content, {
					tagName: 'p',
					value: paragraph
				})
			),
			wp.element.createElement('div', { className: 'banner-content' })
		);
	}
});

/***/ }),
/* 2 */
/***/ (function(module, exports) {

var __ = wp.i18n.__;
var registerBlockType = wp.blocks.registerBlockType;


registerBlockType('demo/static-jsx-example', {
	title: __('Static Block Example with JSX'),
	icon: 'lock',
	category: 'common',
	edit: function edit() {
		return wp.element.createElement(
			'p',
			null,
			'Static block example built with JSX.'
		);
	},
	save: function save() {
		return wp.element.createElement(
			'p',
			null,
			'Static block example built with JSX.'
		);
	}
});

/***/ }),
/* 3 */
/***/ (function(module, exports) {

var __ = wp.i18n.__;
var registerBlockType = wp.blocks.registerBlockType;
var _wp$element = wp.element,
    Component = _wp$element.Component,
    Fragment = _wp$element.Fragment;
var _wp$components = wp.components,
    PanelBody = _wp$components.PanelBody,
    PanelRow = _wp$components.PanelRow,
    Button = _wp$components.Button,
    TextControl = _wp$components.TextControl,
    SelectControl = _wp$components.SelectControl,
    RangeControl = _wp$components.RangeControl,
    ServerSideRender = _wp$components.ServerSideRender;
var _wp$blockEditor = wp.blockEditor,
    RichText = _wp$blockEditor.RichText,
    InspectorControls = _wp$blockEditor.InspectorControls,
    ColorPalette = _wp$blockEditor.ColorPalette,
    MediaUpload = _wp$blockEditor.MediaUpload;


registerBlockType('demo/latest-posts', {
    title: __('Latest Posts'),
    icon: 'lock',
    category: 'common',
    attributes: {
        noPosts: {
            type: 'number',
            default: 1
        }
    },
    edit: function edit(_ref) {
        var attributes = _ref.attributes,
            setAttributes = _ref.setAttributes;
        var noPosts = attributes.noPosts;

        return wp.element.createElement(
            Fragment,
            null,
            wp.element.createElement(
                InspectorControls,
                null,
                wp.element.createElement(
                    PanelBody,
                    { title: __("Settings") },
                    wp.element.createElement(RangeControl, {
                        label: __("No. Posts"),
                        value: noPosts,
                        onChange: function onChange(noPosts) {
                            return setAttributes({ noPosts: noPosts });
                        },
                        min: 1,
                        max: 10
                    })
                )
            ),
            wp.element.createElement(ServerSideRender, {
                block: 'demo/latest-posts',
                attributes: {
                    noPosts: noPosts
                }
            })
        );
    },
    save: function save() {
        return null;
    }
});

/***/ }),
/* 4 */
/***/ (function(module, exports) {

var __ = wp.i18n.__;
var registerBlockType = wp.blocks.registerBlockType;
var _wp$element = wp.element,
    Component = _wp$element.Component,
    Fragment = _wp$element.Fragment;
var _wp$components = wp.components,
    PanelBody = _wp$components.PanelBody,
    PanelRow = _wp$components.PanelRow,
    Button = _wp$components.Button,
    TextControl = _wp$components.TextControl,
    SelectControl = _wp$components.SelectControl,
    RangeControl = _wp$components.RangeControl;
var _wp = wp,
    ServerSideRender = _wp.serverSideRender;
var _wp$blockEditor = wp.blockEditor,
    RichText = _wp$blockEditor.RichText,
    InspectorControls = _wp$blockEditor.InspectorControls,
    ColorPalette = _wp$blockEditor.ColorPalette,
    MediaUpload = _wp$blockEditor.MediaUpload;


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
    edit: function edit(_ref) {
        var attributes = _ref.attributes,
            setAttributes = _ref.setAttributes;
        var postCategory = attributes.postCategory,
            categories = attributes.categories;

        if (!categories) {
            wp.apiFetch({
                url: '/wp-json/wp/v2/categories'
            }).then(function (categories) {
                setAttributes({
                    categories: categories
                });
            });
        }
        return wp.element.createElement(
            Fragment,
            null,
            wp.element.createElement(
                InspectorControls,
                null,
                wp.element.createElement(
                    PanelBody,
                    { title: __("Settings") },
                    wp.element.createElement(SelectControl, {
                        label: __("Post Category"),
                        value: postCategory,
                        options: categories && categories.map(function (category) {
                            return { value: category.name, label: category.name };
                        }),
                        onChange: function onChange(postCategory) {
                            return setAttributes({ postCategory: postCategory });
                        }
                    })
                )
            ),
            wp.element.createElement(ServerSideRender, {
                block: 'demo/post-categories',
                attributes: {
                    postCategory: postCategory,
                    categories: categories
                }
            })
        );
    },
    save: function save() {
        return null;
    }
});

/***/ })
/******/ ]);