/* Author:
	sasa@mataic.com
*/

$(document).ready(function(){
  $('#theform').submit(function() {
    var cf = $(this).find('input[name="css-url"]').val();
    var ch = $(this).find('input[name="check"]').val();
    
    if(!$.trim(cf)) {
      alert('Please enter URL to your CSS file.');
      return false;
    }
    
    
    
    $.post(
        'convert.php',
        {'check' : ch, 'css-url': cf},
        function(data, status, jqXHR) {
          
          if(-1 != data.indexOf('error:')) {
            
          }
          
          console.log(data);
        }
    );
    
    return false;
  });
}
);



