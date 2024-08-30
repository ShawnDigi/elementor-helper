<?php

class DP_Widget_Code_Block extends Elementor\Widget_Base
{
	public function get_name()
	{
		return "dp_code_block";
	}

	public function get_title()
	{
		return "DP Code Block";
	}

	public function get_categories()
	{
		return ["dp"];
	}

	protected function register_controls()
	{
		$this->start_controls_section(
			'dp_widgets',
			[
				'label' => esc_html__('DP Widgets', 'textdomain'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		/*
					PHP code block
					needs custom type to handle styling of text
					*/
		$this->add_control(
			'phpcode',
			[
				'label' => esc_html__('PHP', 'textdomain'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__('Enter your php code', 'textdomain'),
			]
		);

		/*
					CSS code block
					*/
		$this->add_control(
			'csscode',
			[
				'label' => esc_html__('CSS', 'textdomain'),
				'type' => \Elementor\Controls_Manager::TEXTAREA,
				'placeholder' => esc_html__('Enter your css code', 'textdomain'),
			]
		);

		$this->end_controls_section();
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();

			//PHP echo	
		if (isset($settings['phpcode'])) {
			$code = $settings['phpcode'];
			$phpev = eval ($code);
			echo $phpev;
		}
		
			//CSS echo	
		if (isset($settings['csscode'])) {
			echo "<style>" . $settings['csscode'] . "</style>";
		}
	}

	protected function content_template()
	{
		?>
		<# if ( ''===settings.title ) { return; } #>
			<h3>
				{{{ settings.title }}}
			</h3>
			<?php
	}
}


function register_new_widgets($widgets_manager)
{

	$widgets_manager->register(new \DP_Widget_Code_Block());

}
add_action('elementor/widgets/register', 'register_new_widgets');

?>