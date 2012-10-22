<?php

require_once '_base.php';

function error($message = 'error') {
	echo 'error: '. $message;
	exit;
}

if (empty($_POST) || empty($_SESSION['token']) || !isset($_POST['check']) || $_POST['check'] != $_SESSION['token']) {
	error('post');
}

// todo:
/*
 * DONE: check token
 * DONE: check if link exists
 * DONE: check is link really css file
 * DONE: improve detecting of relative links
 * DONE: fix the replacement loop (http only check now)
 * DONE: improve preg match
 * add error messages
 * check if image is real, test for broken images, non-image files
 
 
 * catch errors and warnings? send an e-mail
 * add share links () http://www.quicksprout.com/2012/07/16/100-lessons-learned-from-10-years-of-seo/
 * add google analytics
 * allow for text input
 * force file download
 * allow for exceptions (images to skip)
*/

/*
 * ajaxify the form, make the progress bar, count the images, process one by one, spit out the file
 * 
 * 1. submit the form, perform checks, collect images
 * 1.a. store the original file in DB
 * 2. return the JSON array of images (image link, line number)
 * 3. notify user about number of images, display progress bar
 * 4. foreach image from JSON  call converter
 * 5. read the file from DB? 
 * 
 * */

$cssurl = $_POST['css-url'];

if(empty($cssurl)) error('no-file');	


// check if link is pointing to an actual css file
$headers = @get_headers($cssurl);
if($headers == false || $headers[0] == 'HTTP/1.1 404 Not Found')
	error('invalid-link');

$isCss = false;
foreach ($headers as $hline) if (strpos(strtolower($hline), 'content-type: text/css') !== FALSE) $isCss = true;

if (!$isCss) error('link-not-css');
unset($headers);

$cssfile = file($cssurl);
$urlparse = parse_url($cssurl);
$csspath = $urlparse['scheme'] . '://' . $urlparse['host'] . substr($urlparse['path'], 0, -(strlen(strrchr($urlparse['path'], '/')))) . '/';
unset($urlparse); 


// ok we gotta the good file
//die('ok we gotta the good file');

// thanks inhan
// http://stackoverflow.com/questions/9893078/regex-finding-urls-in-background-image-css-having-trouble#answer-9893437
$regexp = '~\bbackground(-image)?\s*:(.*?)\(\s*(\'|")?(?<image>.*?)\3?\s*\)~i';

$images = array();
foreach ($cssfile as $k => $line) {
	
		// skip existing data uris
		if (FALSE !== strpos($line, 'url(data:image')) continue;
	
		// clean up erroneus url('
		if (FALSE !== strpos($line, "url('")) {
			$line = $cssfile[$k] = str_replace(array("url('", "')"), array('url(', ')'), $line);
		}
		
		// match all images in a line, note the line
		$matches = array();
    if (preg_match_all($regexp,$line,$matches)) {
    	foreach($matches['image'] as $match) {
    		$images[$match]['url'] = (strpos($match, 'http') === FALSE) ? $csspath . ltrim($match, '/') : $match ;
    		$images[$match]['line'][] = $k;
    	}
    }
}

// loop through images, pull them and convert
foreach ($images as $image => $details) {
  $images[$image]['b64'] = base64_encode(file_get_contents($details['url']));
  $images[$image]['img'] = getimagesize($details['url']);
}


// we got all the images converted, loop through them and replace in the css
foreach ($images as $image => $details) {
	foreach ($details['line'] as $line) {
		// last minute check if the image was actually an image file
		if (is_array($details['img'])) {
			$replacement = 'data:'.$details['img']['mime'] . ';base64,'.$details['b64'];
			$cssfile[$line] = str_ireplace($image, $replacement, $cssfile[$line]);
		}
	}
}


//header("Content-type: text/css; charset: UTF-8");
echo implode("", $cssfile);
