<?php
#Name: Create Evaluation Database
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
### Import data from /raw/evaluation.txt format into a flat-file database, and save to databases folder
$database_data = array();
$source = "{$location}/raw/evaluation.txt";
$handle = @fopen($source, 'r');
$line = '';
while (@feof($handle) !== TRUE){
	$line = @fgets($handle);
	$line = trim($line);
	if (ctype_digit(substr($line, 0, 1)) === TRUE){
		$pos1 = intval(strpos($line, '.')) + 2;
		$database_data[] = 'Question: '. substr($line, $pos1);
	} else if (substr($line, 0, 2) === 'A)' or substr($line, 0, 2) === 'B)'){
		if (substr($line, 0, 2) === 'A)'){
			$database_data[] = 'Choices: '. substr($line, 3) . ' | ';
		} else if (substr($line, 0, 2) === 'B)'){
			$key = array_key_last($database_data);
			$database_data[$key] = $database_data[$key] . substr($line, 3);
		}
	} else if (substr($line, 0, 8) === 'Answer: ') {
		$database_data[] = $line;
	}
}
@fclose($handle);
$database_data = implode(PHP_EOL, $database_data);
#### Write file
@file_put_contents("{$location}/databases/evaluation.txt", $database_data);
##</value>
?>