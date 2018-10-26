<?php
/**
 * This file adds the WordPress customizer heading control for the theme.
 */

if ( class_exists( 'WP_Customize_Control' ) && ! class_exists( 'Paradox_Customizer_Heading_Control' ) ) {

	/**
	 * Paradox Class Heading Control displays a heading and description.
	 */
	class Paradox_Customizer_Heading_Control extends WP_Customize_Control {

		/**
		 * Whitelist instructions parameter.
		 *
		 * @var string
		 */
		public $instructions = '';

		/**
		 * Output the heading control content.
		 *
		 * @return  void
		 */
		public function render_content() {

			switch ( $this->type ) {

				case 'heading':
					if ( isset( $this->label ) ) {
						echo '<hr><span class="customize-control-title">' . $this->label . '</span>';
					}

					if ( isset( $this->instructions ) ) {
						echo $this->instructions;
					}

					if ( isset( $this->description ) ) {
						echo '<span class="description customize-control-description">' . $this->description . '</span><hr>';
					}

					break;

			}

		}

	}

} // End if().
