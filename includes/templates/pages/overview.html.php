<?php
#Name:overview.html
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
<link rel="stylesheet" href="{$address}assets/overview.css">
HEREDOC;
###Generage file data
$data = array();
$data[] = '<div class="outter_h2"><div class="inner_h2">Details</div></div>';
require_once $location . '/dependencies/ritchey_get_content_from_value_tag_i1_v1/ritchey_get_content_from_value_tag_i1_v1.php';
$course_name = ritchey_get_content_from_value_tag_i1_v1("{$location}/configuration_files/shared/course_name.txt", 1, TRUE, TRUE);
$data[] = '<div class="item"><div class="item_label">Course Name:</div>' . '<div class="item_value">' . $course_name . '</div></div>';
$course_description = ritchey_get_content_from_value_tag_i1_v1("{$location}/configuration_files/shared/course_description.txt", 1, TRUE, TRUE);
if ($course_description !== ''){
	$data[] = '<div class="item"><div class="item_label" id="course_description_label">Course Description:</div>' . '<div class="item_value" id="course_description_value">' . $course_description . '</div></div>';
}
$course_recognitions = ritchey_get_content_from_value_tag_i1_v1("{$location}/configuration_files/shared/course_recognitions.txt", 1, TRUE, TRUE);
if ($course_recognitions !== ''){
	$data[] = '<div class="item"><div class="item_label">Course Recognitions:</div>' . '<div class="item_value">' . $course_recognitions . '</div></div>';
}
$credential_level = ritchey_get_content_from_value_tag_i1_v1("{$location}/configuration_files/shared/credential_level.txt", 1, TRUE, TRUE);
$data[] = '<div class="item"><div class="item_label">Credential Level:</div>' . '<div class="item_value">' . $credential_level . '</div></div>';
$credential_type = ritchey_get_content_from_value_tag_i1_v1("{$location}/configuration_files/shared/credential_type.txt", 1, TRUE, TRUE);
$data[] = '<div class="item"><div class="item_label">Credential Type:</div>' . '<div class="item_value">' . $credential_type . '</div></div>';
$date_completed = ritchey_get_content_from_value_tag_i1_v1("{$location}/configuration_files/shared/date_completed.txt", 1, TRUE, TRUE);
$data[] = '<div class="item"><div class="item_label">Date Created:</div>' . '<div class="item_value">' . $date_completed . '</div></div>';
$education_type = ritchey_get_content_from_value_tag_i1_v1("{$location}/configuration_files/shared/education_type.txt", 1, TRUE, TRUE);
$data[] = '<div class="item"><div class="item_label">Education Type:</div>' . '<div class="item_value">' . $education_type . '</div></div>';
$evaluation_types = ritchey_get_content_from_value_tag_i1_v1("{$location}/configuration_files/shared/evaluation_types.txt", 1, TRUE, TRUE);
$data[] = '<div class="item"><div class="item_label">Evaluation Types:</div>' . '<div class="item_value">' . $evaluation_types . '</div></div>';
$provider_accredations = ritchey_get_content_from_value_tag_i1_v1("{$location}/configuration_files/shared/provider_accredations.txt", 1, TRUE, TRUE);
if ($provider_accredations !== ''){
	$data[] = '<div class="item"><div class="item_label">Provider Accredations:</div>' . '<div class="item_value">' . $provider_accredations . '</div></div>';
}
require_once $location . '/includes/tasks/determine_course_id.php';
$data[] = '<div class="item"><div class="item_label">Course ID:</div>' . '<div class="item_value">' . $course_id . '</div></div>';

require_once $location . '/includes/tasks/determine_credential_value.php';
$data[] = '<div class="item"><div class="item_label">Credential Value:</div>' . '<div class="item_value">' . $credential_value . ' NFECs (Non-Formal Education Credits)</div></div>';

$data[] = '<div class="outter_h2"><div class="inner_h2">Course Instructions</div></div>';
$data[] = '<div>To complete this course you will need to read through the reading material, and complete an evaluation. You\'ll then be given the option to generate a certificate.</div>';

$notices = ritchey_get_content_from_value_tag_i1_v1("{$location}/configuration_files/shared/notices.txt", 1, TRUE, TRUE);
$data[] = '<div class="notices"><div class="outter_h2"><div class="inner_h2">Notices</div></div>' . '<div class="notices_value">' . $notices . '</div></div>';
$data = implode(PHP_EOL, $data);
$data = $data . PHP_EOL . "<div class='course_links_outter'><a class='course_links' href='./reading-material.html'>Start Reading</a></div>";
###Create content section
$content_section = <<<HEREDOC
<div class='section_outter' id='content_section_outter'>
	<div class='section_inner' id='content_section_inner'>
		{$data}
	</div>
</div>
HEREDOC;
###Add layout to page
eval(@substr(@file_get_contents("{$location}/evals/page_layouts/page_layout_1.php"), 5, -2));
##Write file
@file_put_contents("{$location}{$public_folder}/pages/overview.html", $data);
##</value>
?>