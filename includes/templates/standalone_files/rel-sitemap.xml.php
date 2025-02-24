<?php
#Name:rel-sitemap.xml
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
date_default_timezone_set('UTC');
$date = date("Y-m-d");
##Create data
$data = array();
$data[] = '<?xml version="1.0" encoding="UTF-8"?>';
$data[] = '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
$data[] = "\t<url>\n\t\t<loc>{$address}</loc>\n\t\t<lastmod>{$date}</lastmod>\n\t</url>";
$data[] = "\t<url>\n\t\t<loc>{$address}navigation.html</loc>\n\t\t<lastmod>{$date}</lastmod>\n\t</url>";
//$data[] = "\t<url>\n\t\t<loc>{$address}pages/about-us.html</loc>\n\t\t<lastmod>{$date}</lastmod>\n\t</url>";
//$data[] = "\t<url>\n\t\t<loc>{$address}pages/contact-us.html</loc>\n\t\t<lastmod>{$date}</lastmod>\n\t</url>";
//$data[] = "\t<url>\n\t\t<loc>{$address}pages/legal.html</loc>\n\t\t<lastmod>{$date}</lastmod>\n\t</url>";
//$data[] = "\t<url>\n\t\t<loc>{$address}pages/privacy-policy.html</loc>\n\t\t<lastmod>{$date}</lastmod>\n\t</url>";
$data[] = '</urlset>';
$data = @implode("\n", $data);
##Write data
@file_put_contents("{$location}{$public_folder}/rel-sitemap.xml", $data);
##</value>
?>