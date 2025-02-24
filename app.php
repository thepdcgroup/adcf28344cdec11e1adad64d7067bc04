<?php
#Name:App
#Description:This script runs the application.
#Content:
##Generate databases
$n = 1;
$location = realpath(dirname(__FILE__, $n));
while (is_file("{$location}/app.php") !== TRUE) {
	$n++;
	$location = realpath(dirname(__FILE__, $n));
	if ($n > 50){
		exit(1);
	}
}
require_once $location . '/includes/tasks/create_evaluation_database.php';
require_once $location . '/includes/tasks/determine_course_id.php'; // This task can't be run before the evaluation database is created, because it reads data from it.
require_once $location . '/includes/tasks/determine_credential_value.php'; // This task can't be run before the evaluation database is created, because it reads data from it.
##Generate items from templates
$n = 1;
$location = realpath(dirname(__FILE__, $n));
while (is_file("{$location}/app.php") !== TRUE) {
	$n++;
	$location = realpath(dirname(__FILE__, $n));
	if ($n > 50){
		exit(1);
	}
}
require_once $location . '/includes/templates/standalone_files/Hello World.txt.php';
require_once $location . '/includes/templates/standalone_files/rel-robots.txt.php';
require_once $location . '/includes/templates/standalone_files/rel-humans.txt.php';
require_once $location . '/includes/templates/standalone_files/rel-sitemap.xml.php';
require_once $location . '/includes/templates/assets/global.css.php';
require_once $location . '/includes/templates/pages/index.html.php';
require_once $location . '/includes/templates/assets/index.css.php';
require_once $location . '/includes/templates/pages/navigation.html.php';
require_once $location . '/includes/templates/assets/navigation.css.php';
require_once $location . '/includes/templates/pages/overview.html.php';
require_once $location . '/includes/templates/assets/overview.css.php';
require_once $location . '/includes/templates/pages/reading-material.html.php';
require_once $location . '/includes/templates/assets/reading-material.css.php';
require_once $location . '/includes/templates/pages/evaluation.html.php';
require_once $location . '/includes/templates/assets/evaluation.css.php';
require_once $location . '/includes/templates/pages/certificate.html.php';
require_once $location . '/includes/templates/assets/certificate.css.php';
?>