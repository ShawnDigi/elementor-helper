<?php
function register_new_dynamic_tag_group( $dynamic_tags_manager ) {

	$dynamic_tags_manager->register_group(
		'dp',
		[
			'title' => esc_html__( 'DigitalPie', 'textdomain' )
		]
	);

}
add_action( 'elementor/dynamic_tags/register', 'register_new_dynamic_tag_group' );

// custom Custom dynamic tag
add_action( 'elementor/dynamic_tags/register_tags', function( $dynamic_tags ) {
	class DP_PHP_Tag extends Elementor\Core\DynamicTags\Tag {

		public function get_name() {
			return 'php';
		}

		public function get_categories() {
			return [ 'number',
            	\Elementor\Modules\DynamicTags\Module::NUMBER_CATEGORY,
            	\Elementor\Modules\DynamicTags\Module::TEXT_CATEGORY,
            	\Elementor\Modules\DynamicTags\Module::URL_CATEGORY,
            	\Elementor\Modules\DynamicTags\Module::COLOR_CATEGORY	,
            	\Elementor\Modules\DynamicTags\Module::IMAGE_CATEGORY,
            	\Elementor\Modules\DynamicTags\Module::MEDIA_CATEGORY,
            	\Elementor\Modules\DynamicTags\Module::GALLERY_CATEGORY,
            	\Elementor\Modules\DynamicTags\Module::POST_META_CATEGORY,
            
            ];
		}

		public function get_group() {
			return [ 'dp' ];
		}

		public function get_title() {
			return 'PHP Function';
		}

		protected function _register_controls() {
			$this->add_control(
				'source',
				[
					'label' => __( 'PHP Function', 'text-domain' ),
					'type' => 'text',
				]
			);
		}
        
        function betterEval($code) {
            $tmp = tmpfile ();
            $tmpf = stream_get_meta_data ( $tmp );
            $tmpf = $tmpf ['uri'];
            fwrite ( $tmp, $code );
            $ret = include ($tmpf);
            fclose ( $tmp );
            return $ret;
        }

		public function render() {
			$source = $this->get_settings( 'source' );
            $phpev = "Function Doesn't Exist";
			if(function_exists($source)){
				$phpev = call_user_func($source);
			}
            echo $phpev;
		}
	}
	$dynamic_tags->register_tag( 'DP_PHP_Tag' );
} );



