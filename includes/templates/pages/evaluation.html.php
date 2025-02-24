<?php
#Name:evaluation.html
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
###Set page variables
$page_title = $site_name . ' - Home';
###Create page css
$page_css = <<<HEREDOC
<link rel="stylesheet" href="{$address}assets/evaluation.css">
HEREDOC;
###Generate file data from database
$evaluation_database_data = array();
$evaluation_database_data[] = '';
$source = "{$location}/databases/evaluation.txt";
$handle = @fopen($source, 'r');
$line = '';
$n = 0;
while (@feof($handle) !== TRUE){
	$line = @fgets($handle);
	$line = trim($line);
	if ($n >=3){
		$evaluation_database_data[] = '';
		$n = 0;
	}
	$n++;
	$key = array_key_last($evaluation_database_data);
	$evaluation_database_data[$key] = $evaluation_database_data[$key] . $line . PHP_EOL;
}
@fclose($handle);
// foreach loop over the database to create $data string which contains HTML for each quiz question
$n = 0;
foreach ($evaluation_database_data as &$item){
	$n++;
	$item = explode(PHP_EOL, $item);
	$item[0] = "<div class='evaluation_question' id='q{$n}_question'><legend>" . substr($item[0], 10) . "</legend></div>";
	$item[1] = explode(' | ', substr($item[1], 9));
	$n2 = 0;
	foreach ($item[1] as &$sub_item){
		$n2++;
		$value = $sub_item;
		$sub_item = "<input type='radio' id='choice_q{$n}a{$n2}' name='question_{$n}' value='{$value}'><label for='choice_q{$n}a{$n2}'>{$value}</label><br>";
	}
	unset($sub_item);
	$item[1] = implode($item[1]);
	$item[2] = "<div class='evaluation_answer' id='q{$n}_answer'>" . substr($item[2], 8) . "</div>";
	$item = '<fieldset>' . implode($item) . '</fieldset>';
}
unset($item);
$data = implode(PHP_EOL, $evaluation_database_data);
###Create content section
$content_section = <<<HEREDOC
<div class='section_outter' id='content_section_outter'>
	<div class='section_inner' id='content_section_inner'>
		
		<div class='evaluation_instructions'>
		<div class='outter_h2'><div class='inner_h2'>Instructions</div></div>
		<div>Complete the quiz below. You are required to read each question in full. There is no time limit, and you have unlimited attempts. A score of 50% or higher is required to pass. This evaluation is open book, so you can consult the course reading material while taking it. You are also permitted to consult third-party resources including, but not limited to: books, websites, people, and AI-tools.</div>
		</div>

		<div class='outter_h2'><div class='inner_h2'>Evaluation</div></div>
		<div>
		<form action="./evaluation.html" method="get">
		{$data}
		</form>
		</div>
		
		<div class='evaluation_result'>
		<div class='outter_h2'><div class='inner_h2'>Results</div></div>
		<div id='current_grade'>Your grade will appear here once you've completed the evaluation.</div>
		</div>
		<div class='student_registration'>
		<div class='outter_h2'><div class='inner_h2'>Registration</div></div>
		Upon successful completion of the evaluation, you will qualify for a certificate. Enter your name, as you wish it to appear on the certificate. This information is NOT stored on the server, but will be stored in the certificate URL. By registering for a certificate you are declaring you completed this course in a manner which complies with the set instructions, and expectations for students. Students found to have engaged in academic dishonesty may have their certificates revoked. 
		<br><br>
		<form action="./evaluation.html" method="get">
  			<label for="student_name">Student Name:</label><br>
 			 <input type="text" id="student_name" name="student_name" value=""><br>
		</form> 
		</div>
		<div class='course_links_outter'><a class='course_links' id='certificate_link' data-base-url='./certificate.html' href='./certificate.html'>View Certificate</a></div>
<script>
function checkAnswers() {
    let totalQuestions = 0;
    let correctCount = 0;
    let incorrectCount = 0;

    // Get all fieldsets (instead of .evaluation_question)
    document.querySelectorAll('fieldset').forEach(fieldset => {
        let questionDiv = fieldset.querySelector('.evaluation_question'); // Find the question div inside fieldset
        if (questionDiv == null) {
            return; // Skip if no question div found
        }

        let questionId = questionDiv.id;
        let questionNumberMatch = questionId.match(/\d+/);

        if (questionNumberMatch == null) {
            return; // Skip if question ID doesn't match expected pattern
        }

        let questionNumber = questionNumberMatch[0];
        let answerDiv = document.getElementById("q" + questionNumber + "_answer");

        if (answerDiv == null) {
            return; // Skip if answer div is missing
        }

        let correctAnswer = answerDiv.innerHTML.trim();

        // Find radio buttons inside the fieldset (instead of inside .evaluation_question)
        let radioInputs = fieldset.querySelectorAll('input[type="radio"]');

        if (radioInputs.length == 0) {
            console.warn("No radio buttons found in:", fieldset); // Log a warning instead of stopping execution
            return; // Skip this question but continue with others
        }

        // Get the name attribute from the first radio button
        let radioGroupName = radioInputs[0].name;

        // Find the selected option dynamically
        let selectedOption = document.querySelector('input[name="' + radioGroupName + '"]:checked');

        if (selectedOption != null) {
            let selectedValue = selectedOption.value;

            if (selectedValue === correctAnswer) {
                fieldset.classList.add("correct");
                fieldset.classList.remove("incorrect");
                correctCount += 1; // Increment correct count
            } else {
                fieldset.classList.add("incorrect");
                fieldset.classList.remove("correct");
                incorrectCount += 1; // Increment incorrect count
            }
        } else {
            fieldset.classList.remove("correct");
            fieldset.classList.remove("incorrect");
        }

        totalQuestions += 1; // Increment total questions count
    });

    // Calculate percentage
    let percentage = totalQuestions > 0 ? Math.round((correctCount / totalQuestions) * 100) : 0;
    
    var evaluation_status = false;
    if(percentage >= 50) {
    	document.getElementById("certificate_link").style.visibility = "visible";
    	evaluation_status = true;
    } else {
    	document.getElementById("certificate_link").style.visibility = "hidden";
    }

    // Update the grade display
    if (evaluation_status === true){
    	document.getElementById("current_grade").innerHTML = "Grade: " + correctCount + "/" + totalQuestions + 
        " (" + percentage + "%); " + incorrectCount + " incorrect;" + " Status: Passed";
    } else {
    	document.getElementById("current_grade").innerHTML = "Grade: " + correctCount + "/" + totalQuestions + 
        " (" + percentage + "%); " + incorrectCount + " incorrect" + " Status: Failed";
    }
}

// Attach event listeners to all radio buttons
document.querySelectorAll('input[type="radio"]').forEach(radio => {
    radio.addEventListener("change", checkAnswers);
});

// Clear previous evaluation selections if page is refreshed
window.onload = function() {
    document.querySelectorAll('input[type="radio"]').forEach(radio => {
        radio.checked = false;
    });
};

function create_certificate_link(){
	function get_date_v1() {
    	const date = new Date();
    	const options = { year: "numeric", month: "long", day: "numeric" };
   	return date.toLocaleDateString("en-US", options);
	}
	var certificate_date_value = get_date_v1();
	var student_name_element = document.getElementById("student_name");
	var student_name_value = document.getElementById("student_name").value;
	if (student_name_value == ''){
		student_name_value = 'Anonymous';
	}
	var certificate_id_value = student_name_value + ' | ' + certificate_date_value;
	var certificate_id_value_encoded = certificate_id_value.replace(/ \| /g, "~0");
	certificate_id_value_encoded = certificate_id_value_encoded.replace(/\s/g, "~1");
	certificate_id_value_encoded = certificate_id_value_encoded.replace(/,/g, "~2");
	certificate_id_value_encoded = certificate_id_value_encoded.split('');
	
	
	function reorganize_array_v1(arr) {
		for (var i = 0; i < arr.length; i++) {
			if (arr[i] === '~'){
				arr[i] = '0';
			} else if(arr[i] === '0') {
				arr[i] = '1';
			} else if(arr[i] === '1') {
				arr[i] = '2';
			} else if(arr[i] === '2') {
				arr[i] = '3';
			} else if(arr[i] === '3') {
				arr[i] = '4';
			} else if(arr[i] === '4') {
				arr[i] = '5';
			} else if(arr[i] === '5') {
				arr[i] = '6';
			} else if(arr[i] === '6') {
				arr[i] = '7';
			} else if(arr[i] === '7') {
				arr[i] = '8';
			} else if(arr[i] === '8') {
				arr[i] = '9';
			} else if(arr[i] === '9') {
				arr[i] = 'a';
			} else if(arr[i] === 'a') {
				arr[i] = 'b';
			} else if(arr[i] === 'b') {
				arr[i] = 'c';
			} else if(arr[i] === 'c') {
				arr[i] = 'd';
			} else if(arr[i] === 'd') {
				arr[i] = 'e';
			} else if(arr[i] === 'e') {
				arr[i] = 'f';
			} else if(arr[i] === 'f') {
				arr[i] = 'g';
			} else if(arr[i] === 'g') {
				arr[i] = 'h';
			} else if(arr[i] === 'h') {
				arr[i] = 'i';
			} else if(arr[i] === 'i') {
				arr[i] = 'j';
			} else if(arr[i] === 'j') {
				arr[i] = 'k';
			} else if(arr[i] === 'k') {
				arr[i] = 'l';
			} else if(arr[i] === 'l') {
				arr[i] = 'm';
			} else if(arr[i] === 'm') {
				arr[i] = 'n';
			} else if(arr[i] === 'n') {
				arr[i] = 'o';
			} else if(arr[i] === 'o') {
				arr[i] = 'p';
			} else if(arr[i] === 'p') {
				arr[i] = 'q';
			} else if(arr[i] === 'q') {
				arr[i] = 'r';
			} else if(arr[i] === 'r') {
				arr[i] = 's';
			} else if(arr[i] === 's') {
				arr[i] = 't';
			} else if(arr[i] === 't') {
				arr[i] = 'u';
			} else if(arr[i] === 'u') {
				arr[i] = 'v';
			} else if(arr[i] === 'v') {
				arr[i] = 'w';
			} else if(arr[i] === 'w') {
				arr[i] = 'x';
			} else if(arr[i] === 'x') {
				arr[i] = 'y';
			} else if(arr[i] === 'y') {
				arr[i] = 'z';
			} else if(arr[i] === 'z') {
				arr[i] = 'A';
			} else if(arr[i] === 'A') {
				arr[i] = 'B';
			} else if(arr[i] === 'B') {
				arr[i] = 'C';
			} else if(arr[i] === 'C') {
				arr[i] = 'D';
			} else if(arr[i] === 'D') {
				arr[i] = 'E';
			} else if(arr[i] === 'E') {
				arr[i] = 'F';
			} else if(arr[i] === 'F') {
				arr[i] = 'G';
			} else if(arr[i] === 'G') {
				arr[i] = 'H';
			} else if(arr[i] === 'H') {
				arr[i] = 'I';
			} else if(arr[i] === 'I') {
				arr[i] = 'J';
			} else if(arr[i] === 'J') {
				arr[i] = 'K';
			} else if(arr[i] === 'K') {
				arr[i] = 'L';
			} else if(arr[i] === 'L') {
				arr[i] = 'M';
			} else if(arr[i] === 'M') {
				arr[i] = 'N';
			} else if(arr[i] === 'N') {
				arr[i] = 'O';
			} else if(arr[i] === 'O') {
				arr[i] = 'P';
			} else if(arr[i] === 'P') {
				arr[i] = 'Q';
			} else if(arr[i] === 'Q') {
				arr[i] = 'R';
			} else if(arr[i] === 'R') {
				arr[i] = 'S';
			} else if(arr[i] === 'S') {
				arr[i] = 'T';
			} else if(arr[i] === 'T') {
				arr[i] = 'U';
			} else if(arr[i] === 'U') {
				arr[i] = 'V';
			} else if(arr[i] === 'V') {
				arr[i] = 'W';
			} else if(arr[i] === 'W') {
				arr[i] = 'X';
			} else if(arr[i] === 'X') {
				arr[i] = 'Y';
			} else if(arr[i] === 'Y') {
				arr[i] = 'Z';
			} else if(arr[i] === 'Z') {
				arr[i] = '~';
			}
		}
		var result = arr;
   	return result;
	}
	certificate_id_value_encoded = reorganize_array_v1(certificate_id_value_encoded);
	certificate_id_value_encoded = certificate_id_value_encoded.join('');
	var certificate_id_value_safe = encodeURIComponent(certificate_id_value_encoded);
	
	var id_parameter_value = '?id=' + certificate_id_value_safe;
	var certificate_link_element = document.getElementById("certificate_link");
	var certificate_link_value = certificate_link_element.getAttribute("data-base-url");
	certificate_link_element.href = certificate_link_value + id_parameter_value;
}

document.getElementById("student_name").addEventListener("input", function() {
    create_certificate_link();
});

// Clear previously entered student name
document.getElementById("student_name").value = "";

create_certificate_link();
</script>
	</div>
</div>
HEREDOC;
###Add layout to page
eval(@substr(@file_get_contents("{$location}/evals/page_layouts/page_layout_1.php"), 5, -2));
##Write file
@file_put_contents("{$location}{$public_folder}/pages/evaluation.html", $data);
##</value>
?>