<?php

require_once '_base.php';

// make sure the request is coming from my own server
$_SESSION['token'] = sha1('cisto neki kurac za salt' . time()); 
 
?>
<!doctype html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js lt-ie9 lt-ie8" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js lt-ie9" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <title>Convert CSS Background images to Base64 Data URLs</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width">
  <!-- Place favicon.ico and apple-touch-icon.png in the root directory: mathiasbynens.be/notes/touch-icons -->
  <link rel="stylesheet" href="css/style.css">
  <!-- http://developers.facebook.com/docs/reference/dialogs/feed/  -->
  <meta property="og:title" content="" />
  <meta property="og:description" content="" />
  <meta property="og:image" content="" />
  <script src="js/libs/modernizr-2.5.3.min.js"></script>
</head>
<body>
  <!-- Prompt IE 6 users to install Chrome Frame. Remove this if you support IE 6.
       chromium.org/developers/how-tos/chrome-frame-getting-started -->
  <!--[if lt IE 7]><p class=chromeframe>Your browser is <em>ancient!</em> <a href="http://browsehappy.com/">Upgrade to a different browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">install Google Chrome Frame</a> to experience this site.</p><![endif]-->
  <header>
    <h1>Convert CSS Background images to Base64 Data URLs</h1>
  </header>
  <div role="main">
	 <form action="convert-nojs.php" method="post" id="theform">
   <input type="hidden" name="check" value="<?php echo $_SESSION['token'] ?>">
   <input type="text" name="css-url" placeholder="URL to your CSS file">
   <input type="submit" value="Convert!"> 
   </form>
  </div>
  
  <div id="progress">
  	<p>Awesome, there's %X% images in your CSS file. Hold tight, starting the conversion</p>
  </div>
  
  <div id="error" class="hidden">
  <p>Uh-oh! Looks like something went wrong</p>
  <p id="status"></p>
  </div>
  <footer>

  </footer>

  <!-- Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if offline -->
  <script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="js/libs/jquery-1.7.1.min.js"><\/script>')</script>

  <!-- scripts concatenated and minified via build script -->
  <script src="js/plugins.js"></script>
  <script src="js/script.js?v<?php echo time() ?>"></script>
  <!-- end scripts -->

  <!-- Asynchronous Google Analytics snippet. Change UA-XXXXX-X to be your site's ID.
       mathiasbynens.be/notes/async-analytics-snippet -->
  <script>
    var _gaq=[['_setAccount','UA-XXXXX-X'],['_trackPageview']];
    (function(d,t){var g=d.createElement(t),s=d.getElementsByTagName(t)[0];
    g.src=('https:'==location.protocol?'//ssl':'//www')+'.google-analytics.com/ga.js';
    s.parentNode.insertBefore(g,s)}(document,'script'));
  </script>
</body>
</html>