# [CSS2Base64](http://lab.evervolving.com/CSS-convert-backgrounds-to-base64/)

## Version alpha - dragons ahead!

Simple web tool (under development) to convert CSS background images to base64 embedded.

The problem: 
* web pages with CSS background images don't include the backgrounds when downloaded to local computer
* viewing downloaded web pages offline won't display the background images
* printing the web page doesn't include CSS background images

Solution:
* use this tool to generate a CSS file from your own
* submit your stylesheet which includes background images
* receive rewritten CSS file with images converted to base64

## Roadmap

* DONE: check token to make sure the form originated on own server
* DONE: check if link to CSS file exists
* DONE: check is link really a CSS file
* DONE: improve detecting of relative urls to bg images
* DONE: fix the replacement loop (http only check now)
* DONE: improve preg match
* add error messages
* check if image is real, test for broken images, non-image files
* catch errors and warnings (make simple notification/logging)
* add share links
* add google analytics
* allow for text input aside from entering the link to CSS file
* force file download
* allow for exceptions (images to skip)
* make JS & non-JS version
* ajaxify the form, make the progress bar, count the images, process one by one, spit out the file
1. submit the form, perform checks, collect images
2. store the original file in DB
3. return the JSON array of images (image link, line number)
4. notify user about number of images, display progress bar
5. foreach image from JSON  call converter
6 read the file from DB? 

