<?php

if(class_exists('WP_Customize_Control')):
	/**
	 * steed_Control_Upsell_Theme_Info class.
	 */
	class steed_Control_Upsell_Theme_Info extends WP_Customize_Control {

		/**
		 * Control type
		 *
		 * @var string control type
		 */
		public $type = 'steed-control-upsell';

		/**
		 * Button text
		 *
		 * @var string button text
		 */
		public $button_text = '';

		/**
		 * Button link
		 *
		 * @var string button url
		 */
		public $button_url = '#';

		/**
		 * List of features
		 *
		 * @var array theme features / options
		 */
		public $options = array();

		/**
		 * List of explanations
		 *
		 * @var array additional info
		 */
		public $explained_features = array();

		/**
		 * Label text for each feature
		 *
		 * @var string|void label text
		 */
		public $pro_label = '';

		/**
		 * Hestia_Control_Upsell_Theme_Info constructor.
		 *
		 * @param WP_Customize_Manager $manager the customize manager class.
		 * @param string               $id id.
		 * @param array                $args customizer manager parameters.
		 */
		public function __construct( WP_Customize_Manager $manager, $id, array $args ) {
			$this->button_text;
			$this->pro_label   = esc_html__( 'PRO', 'steed' );
			$manager->register_control_type( 'steed_Control_Upsell_Theme_Info' );
			parent::__construct( $manager, $id, $args );

		}
		/**
		 * Enqueue resources for the control
		 */
		public function enqueue() {
			wp_enqueue_style( 'steed-upsell-style', get_template_directory_uri() . '/includes/php/customizer-theme-upsell-control/style.css', STEED_VERSION );
		}

		/**
		 * Json conversion
		 */
		public function to_json() {
			parent::to_json();
			$this->json['button_text']  = $this->button_text;
			$this->json['button_url']   = $this->button_url;
			$this->json['options']      = $this->options;
			$this->json['explained_features'] = $this->explained_features;
			$this->json['pro_label'] = $this->pro_label;
		}

		/**
		 * Control content
		 */
		public function content_template() {
	?>
			<div class="steed-upsell">
				<# if ( data.options ) { #>
					<ul class="steed-upsell-features">
						<# for (option in data.options) { #>
							<li><span class="upsell-pro-label">{{ data.pro_label }}</span>{{ data.options[option] }}
							</li>
							<# } #>
					</ul>
					<# } #>

						<# if ( data.button_text && data.button_url ) { #>
							<a target="_blank" href="{{ data.button_url }}" class="button button-primary" target="_blank">{{
								data.button_text }}</a>
							<# } #>
								<hr>

								<# if ( data.explained_features ) { #>
									<ul class="steed-upsell-feature-list">
										<# for (requirement in data.explained_features) { #>
											<li>* {{ data.explained_features[requirement] }}</li>
											<# } #>
									</ul>
									<# } #>
			</div>
		<?php
		}
	}
endif;