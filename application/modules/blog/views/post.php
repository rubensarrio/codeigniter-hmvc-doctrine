<!DOCTYPE HTML>
<html lang="en-EN">
<head>
	<meta charset="UTF-8">
	<title><?php echo $post->title() ?></title>
	
	<style type="text/css">

	body {
	 background-color: #fff;
	 margin: 40px;
	 font-family: Lucida Grande, Verdana, Sans-serif;
	 font-size: 14px;
	 color: #4F5155;
	}

	a {
	 color: #003399;
	 background-color: transparent;
	 font-weight: normal;
	}

	h1 {
	 color: #444;
	 background-color: transparent;
	 border-bottom: 1px solid #D0D0D0;
	 font-size: 16px;
	 font-weight: bold;
	 margin: 24px 0 2px 0;
	 padding: 5px 0 6px 0;
	}
	</style>
</head>
<body>
	<h1><?php echo $post->title() ?></h1>
	<?php echo $post->content() ?>
</body>
</html>