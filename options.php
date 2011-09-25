<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 * By default it uses the theme name, in lowercase and without spaces, but this can be changed if needed.
 * If the identifier changes, it'll appear as if the options have been reset.
 * 
 */

function optionsframework_option_name() {

	// This gets the theme name from the stylesheet (lowercase and without spaces)
	$themename = get_theme_data(STYLESHEETPATH . '/style.css');
	$themename = $themename['Name'];
	$themename = preg_replace("/\W/", "", strtolower($themename) );
	
	$optionsframework_settings = get_option('optionsframework');
	$optionsframework_settings['id'] = $themename;
	update_option('optionsframework', $optionsframework_settings);
	
	// echo $themename;
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the "id" fields, make sure to use all lowercase and no spaces.
 *  
 */

function optionsframework_options() {
	
	// Test data
	$test_array = array("one" => "One","two" => "Two","three" => "Three","four" => "Four","five" => "Five");
	
	// Multicheck Array
	$multicheck_array = array("one" => "French Toast", "two" => "Pancake", "three" => "Omelette", "four" => "Crepe", "five" => "Waffle");
	
	// Multicheck Defaults
	$multicheck_defaults = array("one" => "1","five" => "1");
	
	// Background Defaults
	
	$background_defaults = array('color' => '', 'image' => '', 'repeat' => 'repeat','position' => 'top center','attachment'=>'scroll');
	
	
	// Pull all the categories into an array
	$options_categories = array();  
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
    	$options_categories[$category->cat_ID] = $category->cat_name;
	}
	
	// Pull all the pages into an array
	$options_pages = array();  
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
    	$options_pages[$page->ID] = $page->post_title;
	}
		
	// If using image radio buttons, define a directory path
	$imagepath =  get_bloginfo('stylesheet_directory') . '/images/';
		
	$options = array();

	$options[] = array( "name" => "Color Scheme",
						"type" => "heading");
							
	$options[] = array( "name" => "Main Background",
						"desc" => "Main Background. Used on header.",
						"id" => "ess_main_background",
						"std" => "#555555",
						"type" => "color");

	$options[] = array( "name" => "Link Color",
						"desc" => "Main link color. Most of link presented will use this color.",
						"id" => "ess_link_color",
						"std" => "#000000",
						"type" => "color");

	$options[] = array( "name" => "Link Hover",
						"desc" => "Color of hovered link.",
						"id" => "ess_link_hover",
						"std" => "#960000",
						"type" => "color");

	$options[] = array( "name" => "Header Color",
						"desc" => "Color of the text on header.",
						"id" => "ess_header_color",
						"std" => "#FFFFFF",
						"type" => "color");

	$options[] = array( "name" => "Header Color Hover",
						"desc" => "Color of the hovered link on header.",
						"id" => "ess_header_hover",
						"std" => "#AFAFAF",
						"type" => "color");
	
	$options[] = array( "name" => "Typography",
						"type" => "heading");

	$ess_heading_typography = array("Georgia" => "Georgia","Copse" => "Copse", "Pacifico" => "Pacifico", "Lobster" => "Lobster", "Bangers" => "Bangers", "Kreon" => "Kreon", "Leckerli+One" => "Leckerli One", "Carter+One" => "Carter One");
	$options[] = array( "name" => "Heading Typography",
						"desc" => "Select font that will be used for your headings (site name, content title and content headings).",
						"id" => "ess_heading_typography",
						"std" => "Georgia",
						"type" => "select",
						"options" => $ess_heading_typography);	
	
		
	return $options;
}