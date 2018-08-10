<?php
add_action( 'wp_ajax_elementor_get_template_data', 'steed_elementor_templates_data', 0 );
function steed_elementor_templates_data(){
	
	if ( empty( $_REQUEST['template_id'] ) ) {
		return;
	}
	
	$source = new steed_Elements_Templates_Source();
	
	if ( false === strpos( $_REQUEST['template_id'], $source->get_prefix() ) ) {
		return;
	}
	
	wp_send_json_success( $source->get_data( $_REQUEST ) );
}



if(class_exists('Elementor\TemplateLibrary\Source_Base')){
	class steed_Elements_Templates_Source extends Elementor\TemplateLibrary\Source_Base {
		
		public function get_id() {
			return 'tally-templates';
		}
		
		public function get_prefix() {
			return 'tally_';
		}
	
		public function get_title() {
			return 'Tally Templates';
		}
	
		public function register_data() { return false; }
		public function save_item( $template_data ) { return false; }
		public function update_item( $new_data ) { return false; }
		public function delete_template( $template_id ) { return false; }
		public function export_template( $template_id ) { return false; }
		public function get_item( $template_id ){ return false; }
		public function get_items( $args = [] ){ return false; }
	
		public function get_data( array $args, $context = 'display' ) {
	
			$id = $args['template_id'];
			
			$json_file_name = str_replace("tally_", "", $id);
			
			$template_file_dri = get_stylesheet_directory().'/elementor-templates/'.$json_file_name.'.json';
			$template_file_url = get_stylesheet_directory_uri().'/elementor-templates/'.$json_file_name.'.json';
			
			if(file_exists($template_file_dri)){
				$url = $template_file_url;
			}
			
			$response = wp_remote_get( $url, array( 'timeout' => 60 ) );
			$body     = wp_remote_retrieve_body( $response );
			$body     = json_decode( $body, true );
			$data     = ! empty( $body['data'] ) ? $body['data'] : false;
	
			$result = array();
	
			$result['content']       = $this->replace_elements_ids( $data );
			$result['content']       = $this->process_export_import_content( $result['content'], 'on_import' );
			$result['page_settings'] = array();
			
			if ( isset( $body['error'] ) ) {
				return new \WP_Error( 'response_error', $body['error'] );
			}
	
			if ( empty( $body['data'] ) && empty( $body['content'] ) ) {
				return new \WP_Error( 'template_data_error', 'An invalid data was returned' );
			}
	
			return $result;
		}
	}
}


function steed_elementor_editor_after_enqueue_styles(){
	wp_register_style(
			'steed-elementor-editor',
			get_template_directory_uri() . '/assets/css/steed-elementor-editor.css',
			array('elementor-editor'),
			'1.0'
		);

		wp_enqueue_style( 'steed-elementor-editor' );
}
add_action('elementor/editor/after_enqueue_styles', 'steed_elementor_editor_after_enqueue_styles');




//update color and font option
$steed_elementor_update_option = 'update'.'_'.'option';
$steed_elementor_update_option( 'elementor_disable_color_schemes', 'yes' );
$steed_elementor_update_option( 'elementor_disable_typography_schemes', 'yes' );