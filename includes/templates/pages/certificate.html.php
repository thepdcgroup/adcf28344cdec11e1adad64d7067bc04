<?php
#Name:certificate.html
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
$page_title = $site_name . ' - Course Material';
###Create page css
$page_css = <<<HEREDOC
<link rel="stylesheet" href="{$address}assets/certificate.css">
HEREDOC;
###Generate file data
$data = array();
$data2 = array();
$data[] = '<div class="outter_h2"><div class="inner_h2">Verify</div></div>';
$data[] =  <<<HEREDOC
<div>
You are currently verifying <label for="id_input">Certificate ID:</label>
    <input type="text" id="id_input">
If it is valid, a certificate will be displayed below.
</div>

<script>
// Get URL parameter by name
function get_url_parameter_value_v1(param_var) {
    var parameters_var = new URLSearchParams(window.location.search);
    var value_var = parameters_var.get(param_var);
    if (value_var === null || value_var === "" || value_var === undefined) {
        return false;
    }
    return value_var;
}

// Decode Certificate ID, and apply information
function decode_id_v1(id_value) {
	var switch_var = false;
	if (id_value !== null && id_value !== undefined && id_value !== '' && id_value !== false && id_value !== 'false') {
		var switch_var = true;
		console.log(id_value);
		// Decode ID to get Date Issued, and student's name. If fails, change switch_var to false.
		id_arr = id_value.split('');
		var reverse_map = {
			'0': '~',
			'1': '0',
			'2': '1',
			'3': '2',
			'4': '3',
			'5': '4',
			'6': '5',
			'7': '6',
			'8': '7',
			'9': '8',
			'a': '9',
			'b': 'a',
			'c': 'b',
			'd': 'c',
			'e': 'd',
			'f': 'e',
			'g': 'f',
			'h': 'g',
			'i': 'h',
			'j': 'i',
			'k': 'j',
			'l': 'k',
			'm': 'l',
			'n': 'm',
			'o': 'n',
			'p': 'o',
			'q': 'p',
			'r': 'q',
			's': 'r',
			't': 's',
			'u': 't',
			'v': 'u',
			'w': 'v',
			'x': 'w',
			'y': 'x',
			'z': 'y',
			'A': 'z',
			'B': 'A',
			'C': 'B',
			'D': 'C',
			'E': 'D',
			'F': 'E',
			'G': 'F',
			'H': 'G',
			'I': 'H',
			'J': 'I',
			'K': 'J',
			'L': 'K',
			'M': 'L',
			'N': 'M',
			'O': 'N',
			'P': 'O',
			'Q': 'P',
			'R': 'Q',
			'S': 'R',
			'T': 'S',
			'U': 'T',
			'V': 'U',
			'W': 'V',
			'X': 'W',
			'Y': 'X',
			'Z': 'Y',
			'~': 'Z'
		};
		for (var i = 0; i < id_arr.length; i++) {
  			if (reverse_map.hasOwnProperty(id_arr[i])) {
    			id_arr[i] = reverse_map[id_arr[i]];
 			 }
		}
		id_arr = id_arr.join('');
		id_arr = id_arr.replace(/~2/g, ",");
		id_arr = id_arr.replace(/~1/g, " ");
		id_arr = id_arr.replace(/~0/g, " | ");
		id_arr = id_arr.split(' | ');
		if (id_arr[0] !== null && id_value !== undefined && id_value !== '') {
			// Do nothing
		} else {
			var switch_var = false;
		}
		if (id_arr[1] !== null && id_value !== undefined && id_value !== '') {
			// Do nothing
		} else {
			var switch_var = false;
		}
	}
	if (switch_var === true){
		var ele = document.getElementById("certificate_verification_result");
		ele.innerHTML = 'Certificate is valid. To save a copy of the certificate, either screenshot it, or print it.';
		// Set Certificate ID in Certificate
		var ele = document.getElementById("certificate_id");
		ele.innerHTML = id_value;
		// Set Certificate Verification URL
		var ele = document.getElementById("certificate_link_a");
		ele.href = ele.innerHTML + id_value;
		ele.innerHTML = ele.innerHTML + id_value
		// Set Student Name
		var ele = document.getElementById("student");
		ele.innerHTML = id_arr[0];
		// Set Date Issued
		var ele = document.getElementById("date_issued");
		ele.innerHTML = id_arr[1];
	} else {
		var ele = document.getElementById("certificate_verification_result");
		ele.innerHTML = 'Certificate is invalid.';
		ele = document.getElementById("certificate_section_outter");
		ele.innerHTML = '';
	}
}

// Initialize input value from URL parameter (if present)
window.onload = function() {
    var id_var = get_url_parameter_value_v1("id");
    id_var = decodeURIComponent(id_var);
    var input_ele = document.getElementById("id_input");

    if (id_var !== null && id_var !== undefined) { // Check if id_var has a value
        input_ele.value = id_var;
        decode_id_v1(id_var);
    }

    // Attach event listener for input changes
    input_ele.addEventListener("input", function() {
        decode_id_v1(this.value);
    });
};
</script>
HEREDOC;
$data[] = '<div class="outter_h2"><div class="inner_h2">Result</div></div><div id="certificate_verification_result"></div>';
require_once $location . '/dependencies/ritchey_get_content_from_value_tag_i1_v1/ritchey_get_content_from_value_tag_i1_v1.php';
$data2[] = '<div class="outter_h2" id="certificate_h2_outter"><div class="inner_h2" id="certificate_h2_inner">Academic Credential</div></div>';
// Course Name
$course_name = ritchey_get_content_from_value_tag_i1_v1("{$location}/configuration_files/shared/course_name.txt", 1, TRUE, TRUE);
$data2[] = '<div class="item"><div class="item_label">Course Name:</div>' . '<div class="item_value">' . $course_name . '</div></div>';
// Course ID
require_once $location . '/includes/tasks/determine_course_id.php';
$data2[] = '<div class="item"><div class="item_label">Course ID:</div>' . '<div class="item_value">' . $course_id . '</div></div>';
// Issuer
$data2[] = '<div class="item"><div class="item_label">Credential Issuer:</div>' . '<div class="item_value">' . $site_name . '</div></div>';
// Credential Level
$credential_level = ritchey_get_content_from_value_tag_i1_v1("{$location}/configuration_files/shared/credential_level.txt", 1, TRUE, TRUE);
$data2[] = '<div class="item"><div class="item_label">Credential Level:</div>' . '<div class="item_value">' . $credential_level . '</div></div>';
// Credential Type
$credential_type = ritchey_get_content_from_value_tag_i1_v1("{$location}/configuration_files/shared/credential_type.txt", 1, TRUE, TRUE);
$data2[] = '<div class="item"><div class="item_label">Credential Type:</div>' . '<div class="item_value">' . $credential_type . '</div></div>';
// Course Recognitions
$course_recognitions = ritchey_get_content_from_value_tag_i1_v1("{$location}/configuration_files/shared/course_recognitions.txt", 1, TRUE, TRUE);
if ($course_recognitions !== ''){
	$data2[] = '<div class="item"><div class="item_label">Course Recognitions:</div>' . '<div class="item_value">' . $course_recognitions . '</div></div>';
}
// Provider Accredations
$provider_accredations = ritchey_get_content_from_value_tag_i1_v1("{$location}/configuration_files/shared/provider_accredations.txt", 1, TRUE, TRUE);
if ($provider_accredations !== ''){
	$data2[] = '<div class="item"><div class="item_label">Provider Accredations:</div>' . '<div class="item_value">' . $provider_accredations . '</div></div>';
}
// Credential value
require_once $location . '/includes/tasks/determine_credential_value.php';
$data2[] = '<div class="item"><div class="item_label">Credential Value:</div>' . '<div class="item_value">' . $credential_value . ' NFECs (Non-Formal Education Credits)</div></div>';
// Date Issued
$data2[] = '<div class="item"><div class="item_label">Date Issued:</div>' . '<div class="item_value" id="date_issued"></div></div>';
// Student Name
$data2[] = '<div class="item"><div class="item_label">Student:</div>' . '<div class="item_value" id="student"></div></div>';
// Certificate ID
$data2[] = '<div class="item"><div class="item_label">Certificate ID:</div>' . '<div class="item_value" id="certificate_id"></div></div>';
$data = implode(PHP_EOL, $data);
$data2 = implode(PHP_EOL, $data2);
###Create content section
$content_section = <<<HEREDOC
<div class='section_outter no_print' id='content_section_outter'>
	<div class='section_inner' id='content_section_inner'>
		{$data}
	</div>
</div>
<div class='section_outter' id='certificate_section_outter'>
	<div class='section_inner' id='certificate_section_inner'>
		<div id='certificate_outter'>
		<div id='certificate_extra'>
		<div id='certificate_inner'>
		{$data2}
		</div>
		</div>
		</div>
		<div id='certificate_link'>Verification Link: <a id='certificate_link_a' href="{$address}pages/certificate.html?id=">{$address}pages/certificate.html?id=</a></div>
	</div>
</div>
HEREDOC;
###Add layout to page
eval(@substr(@file_get_contents("{$location}/evals/page_layouts/page_layout_1.php"), 5, -2));
##Write file
@file_put_contents("{$location}{$public_folder}/pages/certificate.html", $data);
##</value>
?>