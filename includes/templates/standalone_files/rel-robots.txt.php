<?php
#Name:rel-robots.txt
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
##Get file data
require_once $location . '/dependencies/ritchey_get_content_from_value_tag_i1_v1/ritchey_get_content_from_value_tag_i1_v1.php';
$data = ritchey_get_content_from_value_tag_i1_v1("{$location}/content_files/standalone_files/rel-robots.txt", 1, TRUE, TRUE);
##Write data
@file_put_contents("{$location}{$public_folder}/rel-robots.txt", $data);
##</value>
?>