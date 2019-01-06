$(document).ready(function(){
	//Enabling fields to be edited and showing Apply Button
	$('#btn-change').on('click',function(){

		$('#chg-shift-code,#chg-shift-details,#chg-time-in,#chg-time-out,#chg-break-in,#chg-break-out').fadeIn().removeAttr('disabled');
		$('#btn-change').addClass('hideBtn')
		$('#btn-apply').removeClass('hideBtn');
	});
	//Validating empty fields and Applying data
	$('#btn-apply').on('click',function(){

		var shiftCode = $('#chg-shift-code').val();
		var shiftDetails = $('#chg-shift-details').val();
		var timeIn = $('#chg-time-in').val();
		var timeOut = $('#chg-time-out').val();
		var breakIn = $('#chg-break-in').val();
		var breakOut = $('#chg-break-out').val();

		if(shiftCode == ''){
			$('#chg-shift-code').fadeIn().addClass('empty-warning');
			alertify.error('Please Select Shift Code');
		}

		if(shiftDetails == ''){
			$('#chg-shift-details').fadeIn().addClass('empty-warning');
			alertify.error('Please Select Shift Details');
		}

		if(timeIn == ''){
			$('#chg-time-in').fadeIn().addClass('empty-warning');
			alertify.error('Please Select Time In');
		}

		if(timeIn == ''){
			$('#chg-time-out').fadeIn().addClass('empty-warning');
			alertify.error('Please Select Time Out');
		}

		if($('#chg-shift-details').val().trim().length < 20){
			$('#chg-shift-details').fadeIn().addClass('empty-warning');
			alertify.error('Details\'s minimum characters are 20!');
		}

		if($('#chg-shift-code,#chg-shift-details,#chg-time-in,#chg-time-out,#chg-break-in,#chg-break-out').val() != '' && $('#chg-shift-details').val().trim().length >= 20 ){
			$('#chg-shift-code,#chg-shift-details,#chg-time-in,#chg-time-out,#chg-break-in,#chg-break-out').removeClass('empty-warning');
			alertify.confirm('Change Shift','Your new shift will be'+'<br>'+'Shift: '+ shiftCode + '<br>' + 'Time In:' + timeIn + '<br>' + 'Time Out: ' + timeOut + '<br>' + 'Do you want to continue?', 
				function(){
					$('#chg-shift-code,#chg-shift-details,#chg-time-in,#chg-time-out,#chg-break-in,#chg-break-out').val('');
					$('#chg-shift-code,#chg-shift-details,#chg-time-in,#chg-time-out,#chg-break-in,#chg-break-out').fadeIn().attr('disabled',true);
					$('#btn-change').removeClass('hideBtn')
					$('#btn-apply').addClass('hideBtn');
					alertify.success('Updated Successfully');
				},function(){

				});
		}
	})
});