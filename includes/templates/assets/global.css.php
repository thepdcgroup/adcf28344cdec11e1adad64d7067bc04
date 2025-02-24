<?php
#Name:global.css
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
###Get file data
require_once $location . '/dependencies/ritchey_get_content_from_value_tag_i1_v1/ritchey_get_content_from_value_tag_i1_v1.php';
$data = ritchey_get_content_from_value_tag_i1_v1("{$location}/content_files/assets/global.css.txt", 1, TRUE, TRUE);
##Write file
###If /www/public/assets doesn't exist, create it.
if (@is_dir("{$location}{$public_folder}/assets") === FALSE){
	@mkdir("{$location}{$public_folder}/assets", 0777, TRUE);
}
if (@file_exists("{$location}{$public_folder}/assets/global.css") === TRUE){
	unlink("{$location}{$public_folder}/assets/global.css");
}
@file_put_contents("{$location}{$public_folder}/assets/global.css", $data, FILE_APPEND | LOCK_EX);
##</value>
?>