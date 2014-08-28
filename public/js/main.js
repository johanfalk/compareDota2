$(document).ready(function() {
    $("#steamIDForm").on('submit', function(event) {
		event.preventDefault();

		var steamID = $('#steamID').val();

    	if(steamID) {

    		$('#loading-gif').css('display', 'block');

			$.ajax({
			   	url: "/compareDota2/public/load-player/" + steamID,
			    type: "post",
			    data: steamID
			}).done(function(data) {
				$('#loading-gif').css('display', 'none');

				if(data === 'Success') {
					var path = 'http://localhost/compareDota2/public/player/' + steamID;
	  				window.location = path;
				}
			});
    	}
	});
});