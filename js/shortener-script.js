// ready the sites javascript for use after the page has loaded
$(document).ready(function(){
	// process the form submission using javascript
	$("#shortener").submit(function(event){
		// get the url to be shortened
		var url = $("#longurl").val();
			
		if ($.trim(url) != ''){
			// submit all of the required data via post to the processing script
			$.post("./process.php", {url:url}, function(data){
					
				// process the returned data from the post
				if (data.substring(0, 7) == 'http://' || data.substring(0, 8) == 'https://'){
					$("#longurl").val(data).focus();
						
					// display a success message to the user
					$("#message").html('Your link has been shortened!');
						
					// update the counter shown on the page
					var counter = $("#counter").text();
					$("#counter").text(parseInt(counter) + 1);
				}
				else
					$("#message").html(data);
			});	
		}
			
		// select the text box after form submission
		$("#longurl").focus();
			
		// prevent the form from reloading the page
		return false;
	});
		
	// select the text box on page load
	$("#longurl").focus();
});