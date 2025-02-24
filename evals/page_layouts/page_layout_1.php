<?php
if ($parent_url === ''){
	$parent_url_html = '';
} else {
$parent_url_html = <<<HEREDOC
<div class='section_outter no_print' id='section_outter_header0'>
	<div class='section_inner' id='section_inner_header0'>
	<div id='parent_button_outter'>
		<a id='parent_button' href="{$parent_url}">Go to Parent Site</a>
	</div>
	</div>
</div>
HEREDOC;
}
$data = <<<HEREDOC
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="{$address}assets/global.css">
{$page_css}
<title>{$page_title}</title>
<style>
</style>
</head>
<body>
{$parent_url_html}
<div class='section_outter no_print' id='section_outter_header1'>
	<div class='section_inner' id='section_inner_header1'>
	<nav id='navigation'>
		<a id='navigation_button' href="{$address}navigation.html">&#x2630;</a>
	</nav>
	</div>
</div>
{$content_section}
<div class='section_outter no_print' id='section_outter_footer1'>
	<div class='section_inner' id='section_inner_footer1'>
		<div id='scroll_to_top'>
			<button onclick="scrollToTop()" id="topButton">&uArr;</button>
			<script>
				function scrollToTop() {
					document.body.scrollTop = 0;
					document.documentElement.scrollTop = 0;
				}
			</script>
		</div>
	</div>
</div>
<div class='section_outter no_print' id='section_outter_footer2'>
	<div class='section_inner' id='section_inner_footer2'>
		<div id='copyright_notice'>
			<p><a href="https://laws-lois.justice.gc.ca/eng/acts/C-42/Index.html">Copyright &#169</a> {$site_owner}, and others; <a href="https://en.wikipedia.org/wiki/All_rights_reserved">all rights reserved</a>, except where explicitly stated.
			</p>
		</div>
	</div>
</div>
</body>
</html>
HEREDOC;
?>