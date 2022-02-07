<?php
/**
 * Gb Block include assets class.
 *
 * Handles the script and style functionality of plugin
 *
 * @since 1.0.0
 * @package gbblock
 */

defined( 'ABSPATH' ) || die;

/**
 * Class Include_Assets
 */
if ( ! class_exists( 'Include_Assets' ) ) {

	/**
	 * Class Include_Assets
	 *
	 * @since 1.0.0
	 */
	class Include_Assets {

		/**
		 * Include_Assets constructor.
		 *
		 * @since 1.0.0
		 */
		public function load() {

			/**
			 * Enqueue Block script and CSS.
			 */
			add_action( 'enqueue_block_editor_assets', array( $this, 'gbblock_add_block_scripts' ) );

			/**
			 * Enqueues Front end Scripts
			 */
			add_action( 'wp_enqueue_scripts', array( $this, 'gbblock_front_scripts' ) );

			/**
			 * Enqueues Editor end Scripts
			 */
			add_action( 'admin_enqueue_scripts', array( $this, 'gbblock_editor_scripts' ) );

		}

		/**
		 * Function ads_gallery_add_block_scripts.
		 *
		 * @since 1.0.0
		 */
		public function gbblock_add_block_scripts() {

			wp_enqueue_script(
				'gbblock-gutenberg-block',
				GBBLOCK_URL . 'assets/blocks/build/block.build.js',
				array(
					'wp-blocks',
					'wp-i18n',
					'wp-element',
					'wp-editor',
					'wp-components',
					'wp-plugins',
					'wp-edit-post',
				),
				GBBLOCK_VERSION
			);

			register_block_type(
				'gbblock-gutenberg-block',
				array(
					'editor_script' => 'gbblock-gutenberg-block',
				)
			);

			wp_localize_script(
				'gbblock-gutenberg-block',
				'gbblockGBObj',
				array(
					'pluginUrl' => GBBLOCK_URL,
				)
			);

			wp_enqueue_style( 'gbblock-block-editor-css', GBBLOCK_URL . 'assets/css/gbblock-gb-editor-blocks.css', array( 'wp-edit-blocks' ), GBBLOCK_VERSION );
			wp_enqueue_style( 'gbblock-block-front-css', GBBLOCK_URL . 'assets/css/gbblock-gb-front-blocks.css', array( 'gbblock-block-editor-css' ) );

		}

		/**
		 * Loads front end scripts
		 */
		public function gbblock_front_scripts() {
		
			wp_enqueue_style( 'gbblock-block-front-css', GBBLOCK_URL . 'assets/css/gbblock-gb-front-blocks.css', '' );

		}

		/**
		 * Loads front end scripts
		 */
		public function gbblock_editor_scripts() {
			wp_enqueue_script( 'gbblock-editor-js', GBBLOCK_URL . 'assets/js/gbblock-editor.js' );
			wp_enqueue_style( 'gbblock-editor-css', GBBLOCK_URL . 'assets/css/gbblock-editor.css', '' );
		}

	}

}
