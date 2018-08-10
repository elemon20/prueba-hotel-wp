<?php
class steed_element_header_woo_cart{
	public $customize_prefix;
	public $customize_panel;
	public $customize_section;
	public $style_class;
	
	
	function __construct(){
		$this->customize_prefix = 'header_woo_cart_';
		$this->customize_section = 'steed_woo_cart';
		$this->customize_panel = 'site_header';
		
		add_action( 'customize_register', array($this, 'customize') );
		add_filter('steed_custom_css', array($this, 'css'));
		add_filter('add_to_cart_fragments', array($this, 'cart_fragments'));
	}	
	
	function cart_fragments(){
		if(function_exists('WC')){
			global $woocommerce;
			
			$fragments['a.cart-contents-steed'] = $this->cart_fragments_html();
			
			return $fragments;
		}
	}
	
	function cart_fragments_html(){
		ob_start(); 
		if(function_exists('WC')){
			?>
			<a class="cart-contents-steed" href="<?php echo wc_get_cart_url(); ?>">
				<span class="element_shoppingBag_count">
					<?php echo sprintf ( _n( '%d <span class="screen-reader-text">item</span>', '%d <span class="screen-reader-text">items</span>', WC()->cart->get_cart_contents_count(), 'steed' ), WC()->cart->get_cart_contents_count() ); ?>
				</span>
				<?php echo WC()->cart->get_cart_total(); ?>
			</a>
			<?php
		}
		$html = ob_get_clean();
		return $html;
	}
	
	function html(){
		if( steed_theme_mod($this->customize_prefix.'active') == true){
			echo '<div class="header_woo_cart"><div class="header_woo_cart_in">';
				echo $this->cart_fragments_html();
			echo '</div></div>';
		}
	}
	
	public function css($css){
		$new_css = '';
		if(function_exists('WC')){
			if( steed_theme_mod($this->customize_prefix.'active') == true){
				if( steed_theme_mod($this->customize_prefix.'icon_color') != '' ){ 
					$new_css .= '.header_woo_cart a{';
						$new_css .= 'color:'.steed_sanitize_rgba(steed_theme_mod($this->customize_prefix.'icon_color')).';'; 
					$new_css .= '}';
				}
				if( steed_theme_mod($this->customize_prefix.'icon_hover_color') != '' ){ 
					$new_css .= '.header_woo_cart a:hover{';
						$new_css .= 'color:'.steed_sanitize_rgba(steed_theme_mod($this->customize_prefix.'icon_hover_color')).';'; 
					$new_css .= '}';
				}
			}
		}
		
		return $css.$new_css;
	}
	
	function customize($wp_customize){
		$wp_customize->add_section( $this->customize_section , array(
			'title'      => __( 'Woo Shopping Cart', 'steed' ),
			'priority'   => 30,
			'panel'		=> $this->customize_panel,
		));			
			
	}
}
$GLOBALS['steed_element_header_woo_cart'] = new steed_element_header_woo_cart;
function steed_element_header_woo_cart(){
	
	$GLOBALS['steed_element_header_woo_cart']->html();
}