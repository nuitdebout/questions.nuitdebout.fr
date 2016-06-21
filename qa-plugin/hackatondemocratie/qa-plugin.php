<?php
/*
	Plugin Name: Hackaton Democratie
	Plugin URI:
	Plugin Description: Hackaton Democratie
	Plugin Version: 1.0
	Plugin Date: 2016-06-21
	Plugin Author: bzzrd
	Plugin Author URI: http://www.question2answer.org/
	Plugin License: GPLv2
	Plugin Minimum Question2Answer Version: 1.5
	Plugin Update Check URI:
*/

if (!defined('QA_VERSION')) { // don't allow this page to be requested directly from browser
	header('Location: ../../');
	exit;
}


qa_register_plugin_module('page', 'qa-hackatondemocratie.php', 'qa_hackatondemocratie', 'Hackaton Democratie');
qa_register_plugin_phrases('qa-hackatondemocratie-lang-*.php', 'HackatonDemocratie');
