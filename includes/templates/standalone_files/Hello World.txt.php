<?php
#Name:Hello World.txt
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
##Create data
$data = "Hello World";
##Write data
@file_put_contents("{$location}{$public_folder}/Hello World.txt", $data);
##</value>
?>