<!DOCTYPE HTML>
<html lang="en-EN">
<head>
	<meta charset="UTF-8">
	<title>Post example</title>
	
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
	<h1>Post example</h1>
	<p>Before using this example you must configure your database in file <em>application/config/database.php</em>, then you can follow this steps:</p>
	<ol>
		<li><?php echo anchor('blog/posts/install', 'Install post schema') ?></li>
		<li><?php echo anchor('blog/posts/create', 'Create a post') ?></li>
		<li><?php echo anchor('blog/posts/find/1', 'View post') ?></li>
		<li><?php echo anchor('blog/posts/remove/1', 'Remove post') ?></li>
	</ol>
</body>
</html>