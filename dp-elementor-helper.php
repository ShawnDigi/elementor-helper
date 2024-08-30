<?php

/**
 * Plugin Name: Elementor Helper
 * Plugin URI: https://digitalpie.co.uk
 * Description: Extra features such as PHP dynamic tags
 * Version: 1.0.1
 * Author: Digtal Pie
 * Author URI: https://digitalpie.co.uk
 * Text Domain: dpeh
 * Text Domain: dpeh
 */


define("dpeh_base_dir",__dir__);
define("dpeh_base_file",__dir__);


function dp_eh_loader(){
    require("autoload.php");
}

add_action("init","dp_eh_loader");





?>
