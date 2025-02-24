<?php
#Name:index.html
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
<link rel="stylesheet" href="{$address}assets/index.css">
HEREDOC;
###Get file data
require_once $location . '/dependencies/ritchey_get_content_from_value_tag_i1_v1/ritchey_get_content_from_value_tag_i1_v1.php';
$data = ritchey_get_content_from_value_tag_i1_v1("{$location}/content_files/pages/index.html.txt", 1, TRUE, TRUE);
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
@file_put_contents("{$location}{$public_folder}/index.html", $data);
##</value>
?>