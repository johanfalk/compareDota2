$(document).ready(function() {
    $("#steamIdForm").on('submit', function(event) {
		event.preventDefault();
		
		var steamid = $('#steamid').val();

    	if( typeof steamid == 'number') {

    		$('#loading-gif').css('display', 'block');

			$.ajax({
			   	url: "/compareDota2/public/load-player/" + steamid,
			    type: "post",
			    data: steamid
			}).done(function(data) {
				$('#loading-gif').css('display', 'none');

				if(data === 'Success') {
					var path = 'http://localhost/compareDota2/public/player/' + steamid;
	  				window.location = path;
				}
			});
    	}
	});
});