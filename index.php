<!DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Find</title>
</head>
<body>

<form action="" method="post">

<label>输入网址：</label>
<input style="width:300px;" name="url" type="text" />
<input type="submit" />

</form>

</body>
</html>

<?php
include_once 'dataParse.php';

	$find = new dataParse;
	if($_POST) {
	$url = $_POST['url'];

	if($result=$find->collect($url)) {
            var_dump ($result);
	} else {
            echo 1;
	}
	}