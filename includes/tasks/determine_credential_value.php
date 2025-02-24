<?php
#Name: Determine Credential value
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
### Import data from /databases/evaluation.txt
$database_data = array();
$source = "{$location}/databases/evaluation.txt";
$handle = @fopen($source, 'r');
$line = '';
$credential_value = 0;
while (@feof($handle) !== TRUE){
	$line = @fgets($handle);
	$line = trim($line);
	if (substr($line, 0, 10) === 'Question: '){
		$credential_value++;
	}
}
@fclose($handle);
##</value>
?>