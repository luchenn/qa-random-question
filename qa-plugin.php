<?php

/*
	Plugin Name: Random question widget
	Plugin URI:
	Plugin Description: Outputs a random question in the sidebar
	Plugin Version: 1.0b1
	Plugin Date: 2011-08-30
	Plugin Author: NoahY
	Plugin License: GPLv2
	Plugin Minimum Question2Answer Version: 1.4
*/

// based, loosely, on https://github.com/ercalote/qa-related-questions

	if (!defined('QA_VERSION')) { // don't allow this page to be requested directly from browser
		header('Location: ../../');
		exit;
	}


	qa_register_plugin_module('widget', 'qa-random-question.php', 'qa_random_questions', 'Random question');
	qa_register_plugin_module('module', 'qa-random-admin.php', 'qa_random_question_admin', 'Random question widget');


/*
	Omit PHP closing tag to help avoid accidental output
*/
