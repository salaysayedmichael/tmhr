$(document).ready(function(){

	$('#shift_name,#time_in,#time_out').on('focus',function(){
		$(this).removeClass('warning shake animated');	
	});

	$('#add_shift').on('click',function(){
		// var base_url       = $(".base-url").val();
		var baseUrl         = 'http://localhost/tmhr/index.php/Settings/storeShift';
		var shiftName      = $('#shift_name').val();
		var shiftDetails   = $('#shift_details').val();
		var timeIn         = $('#time_in').val();
		var timeOut        = $('#time_out').val();
		var breakIn        = $('#break_in').val();
		var breakOut       = $('#break_out').val();
		// var token          = $.cookie("csrf_cookie_name");
		var allow = false;
		var addShift;
		var total = $().val();
		// var data = 'shiftName='+shiftName+'&shiftDetails='+shiftDetails+'&timeIn='+timeIn+'&timeOut='+timeOut+'&breakIn='+breakIn+'&breakOut='+breakOut+'&addShift='+addShift+'&csrf_token_name='+token+'';
		// var data = {shiftName:shiftName, shiftDetails:shiftDetails,timeIn:timeIn,timeOut:timeOut,breakIn:breakIn,breakOut:breakOut,addShift:addShift,token:csrf_token_name}
		if(shiftName == '' || timeIn == '' || timeOut == '')
		{
			$('#shift_name,#time_in,#time_out').addClass('warning shake animated');
			setTimeout(function(){
				$('#shift_name,#time_in,#time_out').removeClass('warning shake animated');
			},4000);
			alertify.error('Fill in empty field(s).');

		}
		else if(timeIn >= timeOut)
		{
			alertify.error('Time in must be greater than time out!');
		}
		else if(breakIn != '' || breakOut != '')
		{
			if(breakIn >= breakOut)
			{
				alertify.error('Break In must be greater than break out!');
			}
		}

		
		

	// 	$.ajax({
	// 		type:'POST',
	// 		url:baseUrl,
	// 		data:data,
	// 		success: function(data){
	// 			alert(data);

	// 			if(data == 'success')
	// 			{
	// 				alert('success');
	// 			}
	// 			else
	// 			{
	// 				alert('failed');
	// 			}
	// 		}
	// 	});
	});

	$('#table-shifts').DataTable();

});