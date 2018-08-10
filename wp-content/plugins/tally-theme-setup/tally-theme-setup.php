<?php
/**
 * @package Tally Theme Setup
 */
/*
Plugin Name: Tally Theme Setup
Plugin URI: http://tallythemes.com/
Description: Import demo content for Tally Themes
Version: 2.2
Author: TallyThemes
Author URI: http://tallythemes.com/
License: GPLv2 or later
Text Domain: tally-theme-setup
Prefix: tallythemesetup_
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA..
*/

// Make sure we don't expose any info if called directly

if ( !function_exists( 'add_action' ) ) {
	echo 'Hi there!  I\'m just a plugin, not much I can do when called directly.';
	exit;
}

define( 'TALLYTHEMESETUP__PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'TALLYTHEMESETUP__PLUGIN_DRI', plugin_dir_path( __FILE__ ) );

add_action( 'after_setup_theme', 'tallythemesetup_after_setup_theme' );
function tallythemesetup_after_setup_theme(){
	if(apply_filters('tallythemesetup_load_v2', false)){
		include(TALLYTHEMESETUP__PLUGIN_DRI.'/loader-v2.php');
	}else{
		include(TALLYTHEMESETUP__PLUGIN_DRI.'/loader-v1.php');
	}
}