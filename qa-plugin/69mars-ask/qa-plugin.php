<?php
/*
	Plugin Name: 69 mars - Ask
	Plugin URI:
	Plugin Description: Example of page plugin
	Plugin Version: 1.1
	Plugin Date: 2011-12-06
	Plugin Author: Question2Answer
	Plugin Author URI: http://www.question2answer.org/
	Plugin License: GPLv2
	Plugin Minimum Question2Answer Version: 1.5
	Plugin Update Check URI:
*/


if (!defined('QA_VERSION')) { // don't allow this page to be requested directly from browser
	header('Location: ../../');
	exit;
}


qa_register_plugin_module('page', 'qa-69mars-ask.php', 'qa_69mars_ask', '69 mars - Ajouter une proposition');
qa_register_plugin_phrases('qa-69mars-ask-lang-*.php', '69mars-ask');
