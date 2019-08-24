<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
    <?php echo "Face Recognition Tool";?>
    <small>Management</small>
    </h1>
    <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"><?php echo ucfirst($module_name);?></li>
    </ol>
</section>
<section class="content">
<div class="box" id="main-list">
    <div class="box-header">
        <h3 class="box-title"><?php echo "Face Recognition Tool";?> List</h3>
        <button class="btn btn-warning btn-circle btn-lg pull-right" id="trainClass"  data-toggle="tooltip" title="Train">
            <span class="glyphicon glyphicon-list"></span>
        </button>
		
		<button class="btn btn btn-circle btn-lg pull-right" id="identifyClass"  data-toggle="tooltip" title="Identify">
            <span class="glyphicon glyphicon-search"></span>
        </button>
		
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <table id="userList" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <!--<th>Image</th>-->
            <th>Name</th>
            <th>Date Created</th>
            <th>Created By</th>
            <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        
        </tbody>
        </table>
    </div>
    <!-- /.box-body -->
    </div>
    <!-- /.box -->

</section>
<!-- /.content -->
</div>


<!-- /.modal -->
<div class="modal fade" id="indetifyModal" role="dialog"  data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
           
             <h3 class="modal-title">Identify Face</h3>
            </div>
            <div class="modal-body">
                 <form class="form-group">

					<div class="row">
						<div class="col-md-6">
							<form class="form-horizontal" id="classForm" data-toggle="validator">
							<label for="inputImage" class="control-label">Image</label>
							<input type="file" accept="image/*;capture=camera" class="form-control" id="inputImage2" required>
								<img id="blah" src="<?php echo base_url("assets/default.png");?>" alt="your image" style="max-height:200px;"/>
					
                        <div class="box-body">
                        <div class="form-group">
                            <label for="inputClassName" class="col-sm-4 control-label">Class Name</label>

                            <div class="col-sm-8">
                            <input type="text" class="form-control" id="inputClassName" data-minlength="5" name="inputClassName" placeholder="Class Name" required>
                            <div class="help-block with-errors"></div>
                            </div>
                        </div>
						 <div class="form-group">
                            <label for="inputClassName" class="col-sm-4 control-label">Branch Store</label>

                            <div class="col-sm-8">
                            <input type="text" class="form-control" id="branch_store" data-minlength="5" name="branch_store" placeholder="Branch Store" required>
                            <div class="help-block with-errors"></div>
                            </div>
                        </div>
						 <div class="form-group">
                            <label for="inputClassName" class="col-sm-4 control-label">Case Number</label>

                            <div class="col-sm-8">
                            <input type="text" class="form-control" id="case_number" data-minlength="5" name="case_number" placeholder="Class Name" required>
                            <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <!--<div class="form-group">
                            <label for="inputImage" class="col-sm-4 control-label">Class Image</label>

                            <div class="col-sm-8">
                            <input type="file" class="form-control" id="inputImage" required>
                            <div class="help-block with-errors"></div>
                            </div>
                        </div>-->
                        <div class="form-group">
                            <div id="uploadBoxMain" class="col-md-12">
                            </div>
                        </div>
                        </div>
							<div class="help-block with-errors"></div>
						</div>
						<div class="col-md-6">
                        
							<div  id="image_proof">
								<div>
									<br>
									<br>
									<label for="inputImage" class="control-label">Output</label>
									<br>
										<img id="blah2" src="<?php echo base_url("assets/default.png");?>" alt="your image" style="max-height:200px;"/>
									<br>
									Name:
									<div id="name"></div>
									Branch Store:
									<div id="branch_store_details"></div>
									Case Number:
									<div id="case_number_details"></div>
									<br>
								</div>
							</div>
                            
                            <h1 class="callout callout-danger" id="fraud_sign">Fraudster</h1>
							<input type="hidden" id="edit_id">
							<button id="tag_btn" class="btn btn-danger">Tag as Fraud</button>
							<button id="untag_btn" class="btn btn-primary">Untag as Fraud</button>
							
						</div>
					
                    </form>
					
				</div>
				<div>
					<div id="returns">
					</div>
				</div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="saveUser">Save Class</button>
            <button type="button" class="btn btn-success" id="identifyFace">Identify</button>
            </div>
        </div>
    <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script>
    $("#fraud_sign").hide();
    $("#untag_btn").hide();
    $("#tag_btn").hide();
    $("#fraud_sign").hide();
    var inputRoleConfig = {
        dropdownAutoWidth : true,
        width: 'auto',
        placeholder: "--- Select Item ---"
    };

    var main = function(){
        $("#inputBirthday").datepicker({
            format: 'yyyy-mm-dd'
            });
        var table = $('#userList').DataTable({  
            'autoWidth'   : true,
            "processing" : true,
            "serverSide" : true, responsive: true,
            "ajax" : "<?php echo base_url()."portal/face_recognition/get_face_recognition_list";?>",
            "initComplete": function(settings,json){
                $('[data-toggle="tooltip"]').tooltip()
            }
            , "order": [[ 0, 'desc' ]]
        });
        $("#addBtn").click(function(){
            $("#userModal .modal-title").html("Add");
            $("#action").val("add");
            $("#inputUsername").attr("data-remote","<?php echo base_url()."portal/users/check_username_exist?method=add";?>");
            $(".add").show();     
            $('#userForm').validator();
            $("#userModal").modal("show");
        });

        $("#saveUser").click(function(){
            $("#classForm").submit();
        });
        $("#tag_btn").click(function(){
            var btn = $(this);
            data = { "edit_id":$("#edit_id").val() };
            $.ajax({
                        url: "<?php echo base_url()."portal/face_recognition/tag_fraud";?>",
                        type: "POST",
                        data: data,
                        success: function(data){
                            if(data)
                            {
                                //alert("Data Save: " + data);
                                btn.button("reset");
                                toastr.warning("Person tagged as fraud");
                            }
                            else
                            {
                                toastr.warning("there is an error");
                            }
                        },
                        error: function (request, status, error) {
                            alert(request.responseText);
                        }
                });
                return false;
        });
        $("#untag_btn").click(function(){
            var btn = $(this);
            data = { "edit_id":$("#edit_id").val() };
            $.ajax({
                        url: "<?php echo base_url()."portal/face_recognition/untag_fraud";?>",
                        type: "POST",
                        data: data,
                        success: function(data){
                            if(data)
                            {
                                //alert("Data Save: " + data);
                                btn.button("reset");
                                toastr.warning("Person untagged as fraud");
                            }
                            else
                            {
                                toastr.warning("there is an error");
                            }
                        },
                        error: function (request, status, error) {
                            alert(request.responseText);
                        }
                });
                return false;
        });
		$("#identifyClass").click(function(){
            clearForm("#indetifyModal");
			$("#indetifyModal").modal("show");
		});
        $("#trainClass").click(function(){
             var btn = $(this);
             btn.button("loading");
              $.ajax({
                        url: "<?php echo base_url()."portal/face_recognition/train";?>",
                        success: function(data){
                            //alert("Data Save: " + data);
                            btn.button("reset");
                            toastr.warning(data);
                        },
                        error: function (request, status, error) {
                            alert(request.responseText);
                        }
                });
        });
        $("#classForm").validator().on('submit', function (e) {
           
            var btn = $("#saveUser");
            var action = $("#action").val();
            btn.button("loading");
            if (e.isDefaultPrevented()) {
                btn.button("reset"); 
            } else {
                e.preventDefault();
                var fd = new FormData();
                var files = $('#inputImage2')[0].files[0];
                fd.append('inputImage',files);
                var class_name = $("#inputClassName").val();
                var branch_store = $("#branch_store").val();
                var case_number = $("#case_number").val();
                var edit_id = $("#edit_id").val();
                fd.append('class_name',class_name);
                fd.append('branch_store',branch_store);
                fd.append('case_number',case_number);
                fd.append('edit_id',edit_id);
                var url = "<?php echo base_url()."portal/face_recognition/add_class";?>";
                var message = "New Face Class successfully added";
                if(action == "edit")
                {
                    url =  "<?php echo base_url()."portal/face_recognition/edit_class";?>";
                    message = "Face Class successfully updated";
                }

                $('#uploadBoxMain').html('<div class="progress"><div class="progress-bar progress-bar-aqua" id = "progressBarMain" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 0%"><span class="sr-only">20% Complete</span></div></div>');
                $.ajax({
                    data: fd,
                    type: "post",
                    url: url ,
                    contentType: false,
                    processData: false,
                    xhr: function(){
                        //upload Progress
                        var xhr = $.ajaxSettings.xhr();
                        if (xhr.upload) {
                            xhr.upload.addEventListener('progress', function(event) {
                                var percent = 0;
                                var position = event.loaded || event.position;
                                var total = event.total;
                                if (event.lengthComputable) {
                                    percent = Math.ceil(position / total * 100);
                                }
                                //update progressbar
                                
                                $('#progressBarMain').css('width',percent+'%').html(percent+'%');
                                                                
                            }, true);
                        }
                        return xhr;
                    },
                    mimeType:"multipart/form-data"
                }).done(function(data){ 
                    if(!data)
                    {
                        btn.button("reset");
                        toastr.error(data);
                        $('#uploadBoxMain').html('<div id="progressOverlay"><div class="progress progress-striped"><div class="bar" id="progressBar" style="width: 0%;">0%</div></div></div>');       

                    }
                    else
                    { 
                        btn.button("reset");
                        if(action == "edit")
                         {
                             table.draw("page");
                         }
                         else
                         {
                             table.draw();
                         }
                         toastr.success(message);
                         $("#userForm").validator('destroy');
                         $("#userModal").modal("hide");
                         $(".select2-inputRole-container").attr("html", "--- Select Item ---"); 
                         $(".select2-inputRole-container").attr("title", "--- Select Item ---"); 
                         $("#inputRole").select2("val", "null");
                         $('#uploadBoxMain').html('');   
                         $("#userForm").modal("hide");      
                    }
                });

            }
               return false;
        });

        $("#identifyFace").click(function(){
			var btn = $(this);
            btn.button("loading");
            $("#fraud_sign").hide();
			//alert(identify());
           /*if(identify() == "hit")
		   {
			   
		   }
		   else
		   {
			
			   
		   }*/
		   var files = $('#inputImage2')[0].files[0];
            var fd = new FormData();
			fd.append('inputImage',files);
			var class_name = $("#inputClassName").val();
			var branch_store = $("#branch_store").val();
			var case_number = $("#case_number").val();
			if(class_name == "" || branch_store == "" || case_number == "" || files == null)
			{
				toastr.warning("Please fillup all fields");
				btn.button("reset");
				return false;
			}
            $.ajax({
                        data: fd,
                        type: "post",
                        url: "<?php echo base_url()."portal/face_recognition/identify";?>",
						 contentType: false,
						processData: false,
                        success: function(data){
							if(data != "unknown")
							{
								data = JSON.parse(data);
							
								console.log(data)
								result_jv = ""
								console.log(data.result.length);
								for (var i = 0; i < data.result.length; i++) { 
									result_jv = '<div><br><br><label for="inputImage" class="control-label">Output</label><br><img id="blah2" src="<?php echo base_url("uploads/dataset/");?>'+data.result[i].id+"/"+data.result[i].filename +'" alt="your image" style="max-height:200px;"/><br>Name:									<div id="name">'+data.result[i].class_name+'</div>									Branch Store:									<div id="branch_store_details">'+data.result[i].branch_store+'</div>									Case Number:									<div id="case_number_details">'+data.result[i].case_number+'</div>									<br>								</div>'
								}
								$("#image_proof").html(result_jv);
								btn.button("reset");
								//alert(data)
								/*$("#blah2").attr("src","<?php echo base_url("uploads/dataset/");?>" + data.id +"/" + data.filename)
								$("#name").html(data.name);
								$("#case_number_details").html(data.case_number);
								$("#branch_store_details").html(data.branch_store);
								$("#tag_btn").show();*/
								$("#edit_id").val(data.result[0].face_id)
                                $("#untag_btn").show();
                                $("#tag_btn").show();
                                if(data.is_fraud == "1")
                                {
                                    $("#fraud_sign").show();
                                }else{
                                    $("#fraud_sign").hide();
                                }
								btn.button("reset");
								//$("#deleteUserModal").modal("hide");
								//toastr.error('User ' + deleteItem + ' successfully deleted');
							}
							else
							{
								
								//btn.button("reset");
								$("#blah2").attr("src","<?php echo base_url("assets/default.png");?>");
								$("#name").html("Unknown");
								toastr.success("Saving New Face Class");
							    $("#classForm").submit();
								toastr.success("Training New Face Class");
							    $.ajax({
										url: "<?php echo base_url()."portal/face_recognition/train";?>",
										success: function(data){
											//alert("Data Save: " + data);
											toastr.warning(data);
										},
										error: function (request, status, error) {
											alert(request.responseText);
										}
								});
								btn.button("reset");
							}
                            
                        },
                        error: function (request, status, error) {
                            alert(request.responseText);
                        }
                });
        });
        function clearForm(form)
        {
            $(":input", form).each(function()
            {
            var type = this.type;
            var tag = this.tagName.toLowerCase();
                if (type == 'text')
                {
                this.value = "";
                }
                else if(type =='file')
                {
                    this.value = "";
                }
            });
            $("#blah2").attr("src","<?php echo base_url("assets/default.png");?>");
            $("#blah").attr("src","<?php echo base_url("assets/default.png");?>");
        };
		function readURL(input) {

		  if (input.files && input.files[0]) {
			var reader = new FileReader();

			reader.onload = function(e) {
			  $('#blah').attr('src', e.target.result);
			  //fortesting
			  $("#blah2").attr("src","<?php echo base_url("assets/default.png");?>");
			$("#name").html("");
			}

			reader.readAsDataURL(input.files[0]);
		  }
		}

		$("#inputImage2").change(function(e) {
			//fortesting
            var fileName = e.target.files[0].name;
			   $("#inputClassName").val(fileName);
			 $("#branch_store").val(fileName);
			 $("#case_number").val(fileName);
		  readURL(this);
		   //$("#classForm").submit();
		});
        $('#userModal').on('hidden.bs.modal', function (e) {
            $(this)
                .find("input,textarea,select")
                .val('')
                .end()
                .find("input[type=checkbox], input[type=radio]")
                .prop("checked", "")
                .end();
        });
        $('#inputStatus').select2(inputRoleConfig);
        $('#inputRole').select2(inputRoleConfig);
        function resetForm($form) {
            $form.find('input:text, input:password, input:file, textarea').val('');
            $form.find('input:radio, input:checkbox')
                .removeAttr('checked').removeAttr('selected');
        }
      
    };
    function _edit(id)
    {
        $("#userModal .modal-title").html("Edit <?php echo rtrim(ucfirst($module_name),"s");?>");
        $(".add").hide();    
        $('#userForm').validator();    
        $("#action").val("edit");
        $("#inputUsername").attr("data-remote","<?php echo base_url()."portal/users/check_username_exist?method=edit&user_id=";?>" + id);
        var data = { "id" : id }
        $.ajax({
                data: data,
                type: "post",
                url: "<?php echo base_url()."portal/users/get_user_data";?>",
                success: function(data){
                    data = JSON.parse(data);
                    $("#userID").val(data.user_account.id);
                    $("#inputUsername").val(data.user_account.username);
                    $("#inputPassword").val("this is not the real password");
                    $("#inputPassword2").val("this is not the real password");
                    $("#inputFirstname").val(data.user_profile.first_name);
                    $("#inputMiddlename").val(data.user_profile.middle_name);
                    $("#inputLastname").val(data.user_profile.last_name);
                    $("#inputEmail").val(data.user_profile.email_address);
                    $("#inputContact").val(data.user_profile.contact_number);
                    $("#inputAddress").val(data.user_profile.address);
                    $("#inputBirthday").val(data.user_profile.birthday);
                    $("#inputRole").select2(inputRoleConfig).val(data.user_account.role_id).trigger("change");
                    $("#inputStatus").select2(inputRoleConfig).val(data.user_account.status).trigger("change");
                    $("#userModal").modal("show");
                },
                error: function (request, status, error) {
                    alert(request.responseText);
                }
        });
    }
    function _delete(id,item)
    {
        $("#deleteUserModal .modal-title").html("Delete");
        $("#deleteItem").html(item);
        $("#deleteKey").val(id);
        $("#deleteUserModal").modal("show");
    }
    $(document).ready(main);
</script>