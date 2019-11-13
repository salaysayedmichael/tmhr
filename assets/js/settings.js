$(document).ready(function(){

	$('#shift_name,#time_in,#time_out').on('focus',function(){
		$(this).removeClass('warning shake animated');	
	});



	$('#add_shift').on('click',function(e){
		e.preventDefault();
		var base_url       = $(".base-url").val();
		// var baseUrl         = 'http://localhost/tmhr/index.php/Settings/storeShift';
		var shiftName      = $('#shift_name').val();
		var shiftDetails   = $('#shift_details').val();
		var timeIn         = $('#time_in').val();
		var timeOut        = $('#time_out').val();
		var breakIn        = $('#break_in').val();
		var breakOut       = $('#break_out').val();
		var tm_hr_token    = $('.my-token').val();
		var allow          = false;
		var addShift;
		var timeInv2       = new Date(timeIn);
		var timeOutv2      = new Date(timeOut);
		var diff = timeOutv2 - timeInv2;
		var data = 'shiftName='+shiftName+'&shiftDetails='+shiftDetails+'&timeIn='+timeIn+'&timeOut='+timeOut+'&breakIn='+breakIn+'&breakOut='+breakOut+'&addShift='+addShift+'&tm_hr_token='+tm_hr_token+'';
		
		$(".err-message").addClass('hide')
		$(".err-message p").text('') 

		if(shiftName == '')
		{
			$('#shift_name').addClass('warning');
			$(".err-message").removeClass('hide')
			$(".err-message p").text('Shift Name is empty.') 
			setTimeout(function()
			{
				$('#shift_name').removeClass('warning');
			}, 4000);

			allow = true;
			return allow;
		}

		if(timeIn == '')
		{
			$('#time_in').addClass('warning');
			$(".err-message").removeClass('hide')
			$(".err-message p").text('Time In is empty.') 

			setTimeout(function()
			{
				$('#time_in').removeClass('warning');
			}, 4000);

			allow = true;
			return allow;
		}

		if(timeOut == '')
		{
			$('#time_out').addClass('warning');
			$(".err-message").removeClass('hide')
			$(".err-message p").text('Time Out is empty.') 

			setTimeout(function()
			{
				$('#time_out').removeClass('warning');
			}, 4000);
			
			allow = true;
			return allow;
		}

			 //Calculate time difference
		    timeInSplit = timeIn.split(':');//time in
		    timeOutSplit = timeOut.split(':');//time out

		    min = timeOutSplit[1] - timeInSplit[1];//time-out - time-in
		    hour_carry = 0;
		    if(min < 0){
		        min += 60;
		        hour_carry += 1;
		    }
		    hour = timeOutSplit[0] - timeInSplit[0]-hour_carry;//time-out - time-in
		    // diff = hour + ":" + min;
    		// alert(diff);

    		if(hour > 9)
    		{
				$(".err-message").removeClass('hide')
				$(".err-message p").text('Duty hours is more than 9 hours.') 
    			allow = true;
    			return allow;
    		}	

    		if(breakIn != '' || breakOut != '')
    		{
			    if(breakIn < timeIn || breakIn > timeOut )
			    {
			    	$('#break_in').addClass('warning');

			    	setTimeout(function(){
			    		$('#break_in').removeClass('warning');
			    	},4000);

					$(".err-message").removeClass('hide')
					$(".err-message p").text('Break In is not between Time in and out.') 
			    	allow = true;
			    	return allow;
			    }

			    if(breakOut < breakIn)
			    {
			    	$('#break_out').addClass('warning');

			    	setTimeout(function(){
			    		$('#break_out').removeClass('warning');
					},4000);
					$(".err-message").removeClass('hide')
					$(".err-message p").text('Selected Break Out is before Break In.') 
			    	allow = true;
			    	return allow;
			    }

			    allow = true;
			    return allow;
		    }

			if(!allow)
			{
				$('#modal_addShift').removeClass('in');
				$.ajax({
					type:'POST',
					url:base_url + 'Settings/storeShift',
					data:data,
					success: function(result){
						// alert(result);
						data = JSON.parse(result);
						$('#addshift-modal').modal('hide');
						if(data.error == false )
						{
							// alertify.alert(getMessageType('',''));
							alertify.alert('Success',data.message,
								function()
								{
									alertify.success('Saving update...');
									setTimeout(function(){
										location.reload();
									},1000);
									
								});
							
						}
						else
						{
							alertify.alert('Error',data.message,
								function(){
									alertify.error('Refreshing page..');
									setTimeout(function(){
										location.reload();
									},1000);
								});
							
						}
					}
				});
			}
		});


		$('body').on('click','.fetch_edit_shift',function(){
			var shift_id = $(this).attr('id');
			var tm_hr_token = $('.my-token').val();
			var data = 'shift_id='+shift_id+'&tm_hr_token='+tm_hr_token+'&edit_shift=edit';
			$.ajax({
					method:'POST',
					url:'getShiftData',
					data:data,
					success: function(result)
					{
						
						data = JSON.parse(result);
						$('#updt_shiftName').val(data.shift_name);
						$('#updt_shiftDetails').val(data.shift_details);
						$('#updt_timeIn').val(data.time_in);
						$('#updt_timeOut').val(data.time_out);
						$('#updt_breakIn').val(data.break_in);
						$('#updt_breakOut').val(data.break_out);
						$('.updt_shift').val(shift_id);
					}
			});
			 $('#updateshift-modal').modal('show');

		});

		$('body').on('click','.updt_shift',function(){
			var id = $(this).val();
			var shift_name = $('#updt_shiftName').val();
			var shift_details = $('#updt_shiftDetails').val();
			var time_in = $('#updt_timeIn').val();
			var time_out = $('#updt_timeOut').val();
			var break_in = $('#updt_breakIn').val();
			var break_out = $('#updt_breakOut').val();
			var tm_hr_token = $('.my-token').val();
			var data = 'id='+id+'&shift_name='+shift_name+'&shift_details='+shift_details+'&time_in='+time_in+'&time_out='+time_out+'&break_in='+break_in+'&break_out='+break_out+'&tm_hr_token='+tm_hr_token+'&updt_shift=updt';
			$.ajax({
				method:'POST',
				url:'updtShiftData',
				data:data,
				success: function(result){
					data = JSON.parse(result);
					$('#updateshift-modal').modal('hide');
					if(data.error)
					{
						alertify.alert('Error','<div class="alert alert-danger">'+data.message+'</div>',function(){
							alertify.error('Refreshing Page...');
						});
						setTimeout(function(){
							location.reload();
						},2000);
					}
					else
					{
						alertify.alert('Success','<div class="alert alert-success">'+data.message+'</div>',function(){
							alertify.success('Refreshing Page...');
						});
						setTimeout(function(){
							location.reload();
						},2000);
					}
				}
			});
		})
	
	$("body").on("click",".delete-shift",function(){
		id          = $(this).attr("shift-id")
		tm_hr_token = $('.my-token').val()
		if(typeof id !== "undefined"){
			alertify.confirm("Delete <i class='fa fa-trash text-danger'></i>","Confirm delete Shift?",
			function(){
				$.ajax({
					url:"deleteShift",
					type:"POST",
					data:{id,tm_hr_token},
					success:function(data){
						res = JSON.parse(data)
						if(res.success){
							alertify.alert("Success <i class='fa fa-check text-success'></i>",res.message,function(){
								alertify.success("Refreshing page...");
								setTimeout(() =>{
									location.reload()
								},1000)
							})
						}else{
							alertify.alert("Error <i class='fa fa-times text-danger'></i>",res.message,function(){
								alertify.error("Refreshing page...");
								setTimeout(() =>{
									location.reload()
								},1000)
							})
						}
					}
				})
			},
			function(){
				alertify.error("Cancel")
			})
		}
	})

	

	$('#table-shifts').DataTable();

});
