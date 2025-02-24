<?php
#Name: Determine Course ID
#Description:
#Content:
##<value>
$n = 1;
$location = realpath(dirname(__FILE__, $n));
while (is_file("{$location}/app.php") !== TRUE) {
	$n++;
	$location = realpath(dirname(__FILE__, $n));
	if ($n > 50){
		exit(1);
	}
}
eval(@substr(@file_get_contents("{$location}/evals/global_variables.php"), 5, -2));
### Hash the course name, course reading material, and course evaluation
require_once $location . '/dependencies/ritchey_get_content_from_value_tag_i1_v1/ritchey_get_content_from_value_tag_i1_v1.php';
$course_name = ritchey_get_content_from_value_tag_i1_v1("{$location}/configuration_files/shared/course_name.txt", 1, TRUE, TRUE);
$reading_material = ritchey_get_content_from_value_tag_i1_v1("{$location}/content_files/pages/reading-material.html.txt", 1, TRUE, TRUE);
$course_evaluation = file_get_contents("{$location}/databases/evaluation.txt"); // This only exists if the database creation task script has been run first!
//$course_id = hash('sha256', "{$course_name}{$reading_material}{$course_evaluation}");
$course_id = hash('md5', "{$course_name}{$reading_material}{$course_evaluation}");
##</value>
?>