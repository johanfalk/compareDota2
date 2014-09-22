$(document).ready(function() {
	$("#steamIDForm").on('submit', function(event)
	{
	   	event.preventDefault(); //STOP default action

		var steamID = $('#steamID').val();
	    var postData = $(this).serializeArray();
	    var formURL = $(this).attr("action");

	 	$('#loading-gif').show();

	    $.ajax(
	    {
	        url : '/compareDota2/public/player/' + steamID + '/load',
	        type: 'POST',
	        data : postData,
	        success:function(data, textStatus, jqXHR) 
	        {
	    		$('#loading-gif').hide();

	    		console.log(steamID);

	        	if(data['status'])
	        	{
	        		window.location = '/compareDota2/public/player/' + steamID;
	        	}
	        }
	    });
	});
});