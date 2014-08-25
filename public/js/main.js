$(document).ready(function() {
    $("#steamIdForm").on('submit', function(event) {
		event.preventDefault();
		var steamid = $('#steamid').val();
    	if( steamid !== '') {
    		$('#loading-gif').css('display', 'block');
			$.ajax({
			   	url: "/compareDota2/public/store-matches/" + steamid,
			    type: "post",
			    data: steamid
			}).done(function(data) {
				if(data === 'true') {
					var path = 'http://localhost/compareDota2/public/player/' + $('#steamid').val();
	  				window.location = path;
				}
				$('#loading-gif').css('display', 'none');
			});
    	}
	});
});