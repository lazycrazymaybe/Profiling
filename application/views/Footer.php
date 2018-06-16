<div class="clearfix"></div>
<footer>
	<div class="container-fluid">
		<p class="copyright">&copy; 2018 <a href="#" target="_blank">Camaman-an</a>. All Rights Reserved.</p>
	</div>
</footer>
</div>
<!-- END OF WRAPPER -->
<!-- SCRIPTS -->
<script src="<?php echo base_url().'assets/vendor/jquery/jquery.min.js'?>"></script>
<script src="<?php echo base_url().'assets/vendor/bootstrap/js/bootstrap.min.js'?>"></script>
<script src="<?php echo base_url().'assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js'?>"></script>
<script src="<?php echo base_url().'assets/vendor/chartist/js/chartist.min.js'?>"></script>
<script src="<?php echo base_url().'assets/scripts/klorofil-common.js'?>"></script>
<script src="<?php echo base_url().'assets/vendor/bootstrap/js/bootstrap-toggle.min.js'?>"></script>
<script src="<?php echo base_url().'assets/vendor/jquery/jquery.dataTables.min.js'?>"></script>
<script src="<?php echo base_url().'assets/vendor/bootstrap/js/dataTables.bootstrap.min.js'?>"></script>
<script src="<?php echo base_url().'assets/vendor/toastr/toastr.min.js'?>"></script>
<!-- END SCRIPTS -->
<script>
$(document).ready(function(){

	//PROFILE PAGE
	var dataTables1 = $('#profile_list').DataTable({
	    "processing":true,  
	    "serverSide":true,  
	    "order":[],
	    "ajax":{  
            url:"<?=base_url()?>Administrators/ajaxProfileList",  
            type:"POST"  
        }, 
       "columnDefs":[  
            {  
                 "targets":[5],  
                 "orderable":false,  
            },  
       ],  
	});

	var dataTables2 = $('#removed_profile_list').DataTable({
	    "processing":true,  
	    "serverSide":true,  
	    "order":[],
	    "ajax":{  
            url:"<?=base_url()?>Administrators/ajaxRemovedProfileList",  
            type:"POST"  
        }, 
       "columnDefs":[  
            {  
                 "targets":[5],  
                 "orderable":false,  
            },  
       ],  
	});


	var dynamic_btn = 1;
	$('#add_family_member').on('click',function(){
		dynamic_btn++;
		var html = "";
		html += '<tr class="form_style" id="row'+dynamic_btn+'">';
		html += '<td><input type="input" name="name[]" id="name" aria-describedby="Number Of Children" placeholder="Enter Family Member" class="name_list" 		 style="width: 90%"></td>';
		html += '<td><select name="relationship[]" id="relationship" class="relationship_list" style="width: 90%"><option value="">Relationship</option>		 <option value="son">Son</option><option value="daughter">Daughter</option><option value="sister">Sister</option><option value="brother">    Brother</option><option value="mother">Mother</option><option value="father">    Father</option><option value="gradpa">Grand Father</option><option value="gradma">Grand Mother</option><option value="gradson">Grand Son</option>	  <option value="graddaughter">Grand Daughter</option></select></td>';
		html += '<td><button name="remove" id="'+dynamic_btn+'" class="btn btn-danger btn_remove"><span class="fa fa-minus"></span></button></td>';
		html += '</tr>';
		$('#dynamic_forms').append(html);
	});


	$(document).on('click','.btn_remove',function(){
		var button_id = $(this).attr('id');
		$('#row'+button_id+'').remove();
	});

	$(document).on('submit','#add_profile_form',function(event){
		event.preventDefault();
		var profileID = $('#profileID').val();
		var addressID = $('#addressID').val();
		var fmemberID = $('#fmemberID').val();
		var region = $('#region').val();
		var city = $('#city').val();
		var sitio = $('#sitio').val();
		var province = $('#province').val();
		var barangay = $('#barangay').val();
		var firstName = $('#firstName').val();
		var lastName = $('#lastName').val();
		var middleName = $('#middleName').val();
		var name_extension = $('#name_extension').val();
		var pob = $('#pob').val();
		var dob = $('#dob').val();
		var gender = $('#gender').val();
		var vin = $('#vin').val();
		var no_siblings = $('#no_siblings').val();
		var present_address = $('#present_address').val();
		var civil_status = $('#civil_status').val();
		var spouse = $('#spouse').val();
		var occupation = $('#occupation').val();
		var mother = $('#mother').val();
		var mother_occupation = $('#mother_occupation').val();
		var father = $('#father').val();
		var father_occupation = $('#father_occupation').val();
		var comelect_status = $('#comelect_status').val();
		var no_children = $('#no_children').val();
		var bhw = $('#bhw').val();
		var profile_date = $('#profile_date').val();
		var url = "<?=base_url()?>Administrators/"+$('#add_profile_option').val();
		var element = document.getElementById('error_message');
		if($('#add_profile_option').val() == "updateProfile"){
			$('#dialog_body').html('Profile already in the records, update anyway? ');
		}else{
			$('#dialog_body').html('Profile already in the records, add anyway? ');
		}
		if(sitio == "" || firstName == "" || lastName == "" || middleName == "" || pob == "" || dob == "" || gender == ""  || civil_status == "" || comelect_status == "" || bhw == ""){
			$('#error_message').html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><i class="fa fa-info-circle"></i> There are some required field(s) that are not filled yet.</div>');
				element.scrollIntoView({behavior: "smooth"});
		}else{
			if(sitio.length <= 2 || firstName.length <= 2 || lastName.length <= 2 || middleName.length <= 2 || pob.length <= 5 || bhw.length <= 5){
				$('#error_message').html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><i class="fa fa-info-circle"></i>Each fields has a character minimum requirement. Please fill up correctly.</div>');
				element.scrollIntoView({behavior: "smooth"})
			}else{
				$.ajax({
					url:url,
					method:"POST",
					data:new FormData(this),
					contentType:false,
					processData:false,
					success:function(data){
						if(data == 'error'){
							$('#confirm-removal')[0].showModal();
							$('#confirm').on('click',function(){
								$('#yes_no').val('yes');
								console.log(new FormData(this))
								$.ajax({
									url:url,
									method:"POST",
									data:new FormData(this),
									contentType:false,
									processData:false,
									success:function(data1){
										console.log(data1)
										console.log(url)
										if(data1 == 'error'){
											$('#confirm-removal')[0].showModal();
											$('#dialog_body').html('Something went wrong. Try Again.');
										}else{
											window.location.href = data1;
										}
									}
								});	
							});
						}else{
							window.location.href = data;
						}
						console.log(data);
					}
				});
			}
		}

	});

	//END OF PROFILE PAGE

	// START OF USERS
	var dataTables = $('#userTable').DataTable({
	    "processing":true,  
	    "serverSide":true,  
	    "order":[],
	    "ajax":{  
            url:"<?=base_url()?>Administrators/ajaxEmployeeList",  
            type:"POST"  
        }, 
       "columnDefs":[  
            {  
                 "targets":[7],  
                 "orderable":false,  
            },  
       ],  
	});
	$(document).on('submit','#user-form', function(event){
		event.preventDefault();
		var defaultImage = "default.png";
		console.log($('#password').val());
		var empID = $('#empID').val();
		var fname = $('#fname').val();
		var lname = $('#lname').val();
		var mname = $('#mname').val();
		var contact_number = $('#contact_number').val();
		var username = $('#username').val();
		var password = $('#password').val();
		var isActive = $('#isActive').val();
		var userType = $('#userType').val();
		var date = $('#date').val();
		var url = "<?=base_url()?>Administrators/"+$('#option').val();
		if(fname != "" && lname != "" && mname != "" && contact_number != "" && username != ""){
			if(fname.length >= 2 && lname.length >= 2 && mname.length >= 2 && contact_number.length >= 11 && username.length >= 4){
				$.ajax({
					url:url,
					method:"POST",
					data:new FormData(this),
					contentType:false,
					processData:false,
					success:function(data){
						console.log(data);
						if(data == "created"){
							$('#user-form')[0].reset();
							$('#edit-data').modal('hide');
							dataTables.ajax.reload();  
							$context = 'success';
							$message = "User created successfully.";
							$position = 'top-right';
							toastr.remove();
							toastr[$context]($message, '' , { position: $position });
							prevPass = null;
						}
						else if(data == "successsuccess admin"){
							location.reload();  
							$('#user-form')[0].reset();
							$('#edit-data').modal('hide');
							prevPass = null;
						}
						else if(data == "person"){
							$context = 'error';
							$message = 'Not created. '+fname+' '+lname+' is already a user.';
							$position = 'top-right';
							toastr.remove();
							toastr[$context]($message, '' , { position: $position });
						}
						else if(data == "username"){
							$context = 'error';
							$message = "Not created username "+username+" is already taken. Try again!";
							$position = 'top-right';
							toastr.remove();
							toastr[$context]($message, '' , { position: $position });
						}
						else{
							$('#user-form')[0].reset();
							$('#edit-data').modal('hide');
							dataTables.ajax.reload();  
							$context = 'success';
							$message = 'User Successfully Updated!';
							$position = 'top-right';
							toastr.remove();
							toastr[$context]($message, '' , { position: $position });
							prevPass = null;
						}
					}
				});
			}else{
				$context = 'error';
				$message = 'Every field has a character minimum requirement	!';
				$position = 'top-right';
				toastr.remove();
				toastr[$context]($message, '' , { position: $position });
			}
		}else{
			$context = 'error';
			$message = 'No field should be left empty.';
			$position = 'top-right';
			toastr.remove();
			toastr[$context]($message, '' , { position: $position });
		}
	});

	$('#isActive').change(function(){
		cb = $(this);
		if(cb.val() == "0"){
			cb.val(1)
		}else{
			cb.val(0)
		}
	});

	$(document).on('click','.edit-data', function(){
		var empID = $(this).attr("id");
		console.log(empID);
		$('#password').hide();
		$('#password-label').hide();
		$.ajax({
			url:"<?= base_url()?>Administrators/fetchUser",
			method: "POST",
			data:{empID:empID},
			dataType:'json',
			success:function(data){
				$('#myModal').modal('show');
				$('#empID').val(data.empID);
				$('#fname').val(data.fname);
				$('#lname').val(data.lname);
				$('#mname').val(data.mname);
				$('#contact_number').val(data.contact_number);
				$('#username').val(data.username);
				$('#password').val(data.password);
				$('#userType').val(data.userType);
				$('#isActive').val(data.isActive);
				$('#date').val(data.date);
				// $('#user_uploaded_image').html(data.img);
				if(data.isActive == "1"){
					$('#isActive').prop('checked',true).change();
				}else{
					$('#isActive').prop('checked',false).change();
				}
				if($('#password').val() == "123"){
					$('#resetPass').attr("disabled", "disabled");
					$('#resetWord').text("Password has been reset");	
					$('#resetWord').removeClass("label label-warning");	
					$('#resetWord').addClass("label label-info");
				}else{
					$('#resetWord').text("Reset Password");	
					$('#resetWord').removeClass("label label-info");	
					$('#resetWord').addClass("label label-default");
					$('#resetPass').removeAttr("disabled");
				}
				$('#action').val('Update');
				$('#resetPass').show();
				$('#resetWord').show();
				$('#option').val('updateUser');
				$('#modalTitle').text('Update User');
				console.log(empID);
			}
		});
	});
	// END OF USERS
	//--Reset Password Acion--
	var prevPass;
	$('#resetPass').on('click',function(){
		console.log($('#password').val());
		if($('#password').val() != "123"){
			prevPass = $('#password').val();
		}
		if($('#resetWord').text() == "Reset Password"){
			$('#resetWord').text("Undo Reset");	
			$('#resetWord').removeClass("label label-default");	
			$('#resetWord').addClass("label label-warning");	
			$('#password').val("123");
		}
		else if($('#resetWord').text() == "Undo Reset"){
			$('#resetWord').text("Reset Password");
			$('#resetWord').removeClass("label label-warning");	
			$('#resetWord').addClass("label label-default");	
			$('#password').val(prevPass);
		}
	});
	//--Create New User Action--
	$('#createUser').on('click',function(){
		$('#action').val('Create');
		$('#fname').val("");
		$('#lname').val("");
		$('#mname').val("");
		$('#contact_number').val("");
		$('#username').val("");
		$('#userType').val("Employee");
		$('#isActive').prop('checked',true).change();
		$('#password').hide();
		$('#password-label').hide();
		$('#resetPass').hide();
		$('#resetWord').hide();
		$('#option').val('createUser');
		$('#modalTitle').text('Create New User');
		console.log('Creating User.');
	});
	// END OF USER PAGE

	//START OF CASE PAGE
	$(document).on('submit','#add_case_form',function(event){
		event.preventDefault();
		var profileID = $('#profileID').val();
		var caseID = $('#caseID').val();
		var ctitle = $('#ctitle').val();
		var clupon = $('#clupon').val();
		var cdate = $('#cdate').val();
		var cwhome = $('#cwhome').val();
		var cstatus = $('#cstatus').val();
		var cdescription = $('#cdescription').val();
		var url = "<?=base_url()?>Administrators/"+$('#add_case_action').val();
		console.log(url)
		console.log(caseID)
		if(ctitle == "" || clupon == "" || cdate == "" || cwhome == "" || cstatus == "" || cdescription == ""){
			$('#error_message').html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><i class="fa fa-info-circle"></i> There are some required field(s) that are not filled yet.</div>');
		}else{
			if(ctitle.length < 5 || clupon.length < 3 || cwhome.length < 3 || cdescription.length < 5){
				$('#error_message').html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><i class="fa fa-info-circle"></i> Each field has a character minimum requirement.</div>');
			}else{
				$.ajax({
					url:url,
					method:"POST",
					data:new FormData(this),
					contentType:false,
					processData:false,
					success:function(data){
						if(data == "error"){
							$('#error_message').html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button><i class="fa fa-info-circle"></i> Error has occured. Please refresh and try again.</div>');
						}else{
							window.location.href = data;
						}
					}
				})
			}
		}
	});

	$(document).on('click','.remove_button',function(){
		var caseID = $(this).attr("id");
		var profileID = $("#profile_ID").val();
		$('#dialog_body').html('This action will permanently delete this case to your records.');
		$('#confirm').on('click',function(){
			$.ajax({
				url: "<?= base_url()?>Administrators/removeCase",
				method:"POST",
				data:{profileID:profileID,caseID:caseID},
				success:function(data){
					console.log(profileID)
					window.location.href = data;
				}
			})
		})
	})

	//END OF CASE PAGE

	//Confirmation Modal
	$(document).on('click','.dialog_background',function(){
		$('#confirm-removal')[0].close();
	});
	$(document).on('click','.remove_confirmation',function(){
		var profileID = $(this).attr("id");
		$('#confirm-removal')[0].showModal();
		$('#dialog_body').html('Are you sure you want to remove this profile? ');
		$('#confirm').unbind().on('click',function(){
			var message = "Profile removed successfully.";
			var dataTables = dataTables1;
			removeAddProfile(profileID,message,dataTables)
		});
	});
	$(document).on('click','.add_confirmation',function(){
		var profileID = $(this).attr("id");
		$('#confirm-removal')[0].showModal();
		$('#dialog_body').html('Are you sure you want to add this profile? ');
		$('#confirm').unbind().on('click',function(){
			var message = "Profile added successfully.";
			var dataTables = dataTables2;
			removeAddProfile(profileID,message,dataTables)
		});
	});

	function removeAddProfile(profileID,message,table){
		console.log(profileID);
		console.log(message);
		$.ajax({
			url:"<?= base_url()?>Administrators/disableEnableProfile",
			method:"POST",
			data:{profileID:profileID},
			success:function(data){
				if(data == "success"){
					$context = 'success';
					$message = message;
					$position = 'top-right';
					toastr.remove();
					toastr[$context]($message, '' , { position: $position });
					table.ajax.reload();  
				}else{
					$context = 'error';
					$message = "Error occured. Update failed.";
					$position = 'top-right';
					toastr.remove();
					toastr[$context]($message, '' , { position: $position });
				}
			}
		});
	}
	
	$(document).on('click','.delete_confirmation',function(){
		$('#confirm-removal')[0].showModal();
		var profileID = $(this).attr("id");
		$('#dialog_body').html('This will permanently delete profile from record, are you sure to proceed? ');
		$('#confirm').unbind().on('click',function(){
			$.ajax({
				url:"<?= base_url()?>Administrators/deleteProfile",
				method:"POST",
				data:{profileID:profileID},
				success:function(data){
					console.log(data);
					console.log(profileID);
					if(data == "success"){
						dataTables2.ajax.reload();  
						$context = 'success';
						$message = "Profile has been deleted successfully.";
						$position = 'top-right';
						toastr.remove();
						toastr[$context]($message, '' , { position: $position });
					}else{
						$context = 'error';
						$message = "Error occured. Deleting failed.";
						$position = 'top-right';
						toastr.remove();
						toastr[$context]($message, '' , { position: $position });
					}
				}
			});
		});
	});

	$(document).on('click','.remove_button',function(){
		$('#confirm-removal')[0].showModal();
	});

	$('#cancel').on('click',function(){
		$('#confirm-removal')[0].close();
	});

});

	</script>
		</body>
	<!-- END BODY -->
</html>