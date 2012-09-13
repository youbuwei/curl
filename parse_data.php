<?php

return array(
    "360buy" => array(
        "goodprice" => '/<strong class=\"flk31\">(?P<result>[0-9\.]*)<\/strong> <\/div>/U',
        "goodname" => '/<div class=\"p-name\"><a href=\'.*\'>(?<result>.*)<\/a><\/div>/U',
        "goodimg" => "",
        "good_sendprice" => "",
        "shopurl" => "http://www.360buy.com",
        "shopname" => "京东商城",
        "charset" => "UTF-8"
    ),
	"tmall" => array(
		"goodprice" => '/<input type=\"hidden\" name=\"current_price\" value= \"(?<result>.*) \/>/U',
		"goodname"  => '/<input type=\"hidden" name=\"title\" value="(?<result>.*)\" \/>/U',
		"goodimg"	=> '/<input type=\"hidden\" name=\"photo_url\" value= \"(?<result>.*) \/>/U',
		"good_sendprice" => "",
		"shopurl"	=> "http://www.tmall.com",
		"shopname"	=> "天猫网",
		"charset"	=> "GBK",
	),
);
?>