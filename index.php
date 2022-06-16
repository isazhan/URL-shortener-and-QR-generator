<html>

	<head>
    	<title>Best Free Custom URL Shortener | 456.kz | Link Shortener</title>
		<meta charset="UTF-8">
		<meta name="description" content="Free URL shortener. Just put your link on our field and obtain shortened link. Simple way.">
		<meta name="keywords" content="URL, QR, shortener, free">
    	<link rel="stylesheet" href="style.css" type="text/css">		
		<script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
		<script type="text/javascript" src="js/shortener-script.js"></script>
		<!-- Yandex.Metrika counter --> <script type="text/javascript" > (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)}; m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)}) (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym"); ym(87316144, "init", { clickmap:true, trackLinks:true, accurateTrackBounce:true }); </script> <noscript><div><img src="https://mc.yandex.ru/watch/87316144" style="position:absolute; left:-9999px;" alt="" /></div></noscript> <!-- /Yandex.Metrika counter -->
		<!-- Global site tag (gtag.js) - Google Analytics -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=UA-119777510-1"></script>
		<script>
  		window.dataLayer = window.dataLayer || [];
  		function gtag(){dataLayer.push(arguments);}
  		gtag('js', new Date());
  		gtag('config', 'UA-119777510-1');
		</script>
		<!-- Global site tag (gtag.js) - Google Analytics -->
	</head>

	<body>
	
		<nav>
			<li><a href="#">Button 1</a></li>
			<li><a href="#">Button 2</a></li>
			<li style="float:right"><a href="#">Button 3</a></li>
			<li style="float:right"><a href="#">Button 4</a></li>
		</nav>
    	
		<div class="main">
			<div class="brand">456.kz</div>
			<form method="post" action="#" name="shortener" id="shortener">
    			<input type="text" name="longurl" id="longurl" placeholder="Put link here">
    			<br>
    			<input type="submit" value="Shorten and QR generate">
    		</form>
			<h3 id="message" class="success"><?php echo ( isset($message) ? $message : '' );  ?></h3>
		</div>
		
		<?php
		echo '<div class="index-seo">';
		echo htmlentities(file_get_contents("index-seo.txt"));
		echo '</div>';
		?>		
    
	</body>

</html>
<?php
	// require the include files that has all the back-end functionality
	require_once('./include.php');
	
	// check to see if a code has been supplied and process it
	if (isset($_GET['code']) && $_GET['code'] != '' && strlen($_GET['code']) > 0){
		$code = $_GET['code']; 
		
		// validate the code against the database
		$conn = mysqli_connect(DB_SERVER, DB_USER, DB_PASS, DB_NAME);
		$query = mysqli_query($conn, "SELECT * FROM short_links WHERE code='$code'");
		if (mysqli_num_rows($query) == 1){
			
			// retrieve the data from the database
			$data = mysqli_fetch_assoc($query);
			
			// update the counter in the database
			mysqli_query($conn, "UPDATE short_links SET count=count+1 WHERE code='$code'");
			
			/* ADD EXTRA STUFF HERE IF DESIRED */
			
			// set some header data and redirect the user to the url
			header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
			header("Cache-Control: no-cache");
			header("Pragma: no-cache");

			header("Location: " . $data['url']);
			
			die();
		}
		else
			$message = '<font color="red">Unable to redirect to your url</font>';
	}
?>