<?php
#Name:Global Variables
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
//var_dump($location);
###Connection Type
require_once $location . '/dependencies/ritchey_get_content_from_value_tag_i1_v1/ritchey_get_content_from_value_tag_i1_v1.php';
$connection_type = rtrim(ritchey_get_content_from_value_tag_i1_v1("{$location}/configuration_files/global/connection_type.txt", 1, TRUE, TRUE));
//var_dump($connection_type);
###Domain
require_once $location . '/dependencies/ritchey_get_content_from_value_tag_i1_v1/ritchey_get_content_from_value_tag_i1_v1.php';
$domain = rtrim(ritchey_get_content_from_value_tag_i1_v1("{$location}/configuration_files/global/domain.txt", 1, TRUE, TRUE));
//var_dump($domain);
###Public Folder
require_once $location . '/dependencies/ritchey_get_content_from_value_tag_i1_v1/ritchey_get_content_from_value_tag_i1_v1.php';
$public_folder = rtrim(ritchey_get_content_from_value_tag_i1_v1("{$location}/configuration_files/global/public_folder.txt", 1, TRUE, TRUE));
//var_dump($public_folder);
###Root URL
require_once $location . '/dependencies/ritchey_get_content_from_value_tag_i1_v1/ritchey_get_content_from_value_tag_i1_v1.php';
$root_url = rtrim(ritchey_get_content_from_value_tag_i1_v1("{$location}/configuration_files/global/root_url.txt", 1, TRUE, TRUE));
//var_dump($root_url);
###Parent URL
require_once $location . '/dependencies/ritchey_get_content_from_value_tag_i1_v1/ritchey_get_content_from_value_tag_i1_v1.php';
$parent_url = rtrim(ritchey_get_content_from_value_tag_i1_v1("{$location}/configuration_files/global/parent_url.txt", 1, TRUE, TRUE));
//var_dump($parent_url);
###Site Name
require_once $location . '/dependencies/ritchey_get_content_from_value_tag_i1_v1/ritchey_get_content_from_value_tag_i1_v1.php';
$site_name = rtrim(ritchey_get_content_from_value_tag_i1_v1("{$location}/configuration_files/global/site_name.txt", 1, TRUE, TRUE));
//var_dump($site_name);
###Site Owner
require_once $location . '/dependencies/ritchey_get_content_from_value_tag_i1_v1/ritchey_get_content_from_value_tag_i1_v1.php';
$site_owner = rtrim(ritchey_get_content_from_value_tag_i1_v1("{$location}/configuration_files/global/site_owner.txt", 1, TRUE, TRUE));
//var_dump($site_owner);
$address = $connection_type . '://' . $domain . $root_url;
if (substr($address, -1) !== '/'){
	$address = $address . '/';
}
##</value>
?>