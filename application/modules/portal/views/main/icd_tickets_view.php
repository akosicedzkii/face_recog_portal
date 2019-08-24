<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<?php $module_name = rtrim($module_name,"s");?>
<section class="content-header">
    <h1>
    <?php echo ucfirst($module_name);?>
    <small>Management</small>
    </h1>
    <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"><?php echo ucfirst($module_name);?></li>
    </ol>
</section>
<button class="btn btn-success btn-circle btn-lg fix-btn" id="addBtn"  data-toggle="tooltip" title="Add New">
    <span class="glyphicon glyphicon-plus"></span>
</button>
<!-- Main content -->
<section class="content">
<div class="box" id="main-list">
    <div class="box-header">
        <h3 class="box-title"><?php echo ucfirst($module_name);?> List</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <table id="icd_ticketsList" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>TicketID</th>
            <th>Description</th>
            <th>Status</th>
            <th>Date Created</th>
			<th>Owner Group</th>
			<th>Severity</th>
			<th>Circuit Number</th>
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

<div class="modal fade" id="icd_ticketsModal" role="dialog"  data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
           
             <h3 class="modal-title">Add icd_tickets</h3>
             <input type="hidden" id="action">
             <input type="hidden" id="icd_ticketsID">
            </div>
            <div class="modal-body">
                <div>
                    <form class="form-horizontal" id="icd_ticketsForm" data-toggle="validator">
                        <div class="box-body">
                            <div class="form-group">
                                <label for="inputicd_ticketsTitle" class="col-sm-2 control-label">Event Name</label>

                                <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputicd_ticketsTitle" placeholder="Event Name" required>
                                <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputDescription" class="col-sm-2 control-label">Description</label>

                                <div class="col-sm-10">
                                <textarea class="form-control" id="inputDescription" placeholder="Description" style="resize:none" required></textarea>
                                <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            
                            <div class="form-group">
                                <label for="inputCoverImage" class="col-sm-2 control-label">Cover Image </label>

                                <div class="col-sm-10">
                                    <center><img id="coverImgPrev" src="#" class='img-thumbnail' style='height:100px;width:200px' onerror="this.src='<?php echo base_url()."assets/images/img_bg.png";?>'"></center>
                                    <input type="hidden" id="inputCoverImage" value="">
                                    <center><a class="btn btn-info" onclick="set_image_loader('inputCoverImage','coverImgPrev');">Select from Gallery</a></center>
                                    <center><div class="help-block with-errors" id="coverError"></div></center>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputContent" class="col-sm-2 control-label">Content</label>

                                <div class="col-sm-10">
                                <textarea class="form-control" id="inputContent" placeholder="Content" style="resize:none" required></textarea>
                                <div class="help-block with-errors" id="ckEditorError"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputicd_ticketsFirstname" class="col-sm-2 control-label">Firstname</label>

                                <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputicd_ticketsFirstname" placeholder="Firstname" required>
                                <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputicd_ticketsMiddlename" class="col-sm-2 control-label">Middlename</label>

                                <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputicd_ticketsMiddlename" placeholder="Middlename" required>
                                <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputicd_ticketsLastname" class="col-sm-2 control-label">Lastname</label>

                                <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputicd_ticketsLastname" placeholder="Lastname" required>
                                <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputicd_ticketsEmailAddress" class="col-sm-2 control-label">Email Address</label>

                                <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputicd_ticketsEmailAddress" placeholder="Email Address" required>
                                <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputicd_ticketsAge" class="col-sm-2 control-label">Age</label>

                                <div class="col-sm-10">
                                <input type="number" class="form-control" id="inputicd_ticketsAge" placeholder="Age" required>
                                <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputicd_ticketsContact" class="col-sm-2 control-label">Contact Number</label>

                                <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputicd_ticketsContact" placeholder="Contact Number" required>
                                <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputicd_ticketsEventDate" class="col-sm-2 control-label">Event Date</label>

                                <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputicd_ticketsEventDate" placeholder="Event Date" required>
                                <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputicd_ticketsEventTime" class="col-sm-2 control-label">Event Time</label>

                                <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputicd_ticketsEventTime" placeholder="Event Time" required>
                                <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputicd_ticketsEventPlace" class="col-sm-2 control-label">Event Place</label>

                                <div class="col-sm-10">
                                <textarea class="form-control" id="inputicd_ticketsEventPlace" placeholder="Event Place" required></textarea>
                                <div class="help-block with-errors"></div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="inputicd_ticketsEventPresent" class="col-sm-2 control-label">Present</label>

                                <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputicd_ticketsEventPresent" placeholder="Present">
                                <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputicd_ticketsPrice" class="col-sm-2 control-label">Price</label>

                                <div class="col-sm-10">
                                <input type="number" class="form-control" id="inputicd_ticketsPrice" placeholder="Price">
                                <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputicd_ticketsEmailList" class="col-sm-2 control-label">Email List</label>

                                <div class="col-sm-10">
                                *use , to add email address
                                <textarea class="form-control" id="inputicd_ticketsEmailList" placeholder="Email List"></textarea>
                                <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="inputStatus" class="col-sm-2 control-label">Status</label>

                                <div class="col-sm-10">
                                <select class="form-control" id="inputStatus" placeholder="Content" style="resize:none" required>
                                    <option value="1">Enable</option>
                                    <option value="0">Disable</option>
                                </select>
                                <div class="help-block with-errors"></div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div id="uploadBoxMain" class="col-md-12">
                                </div>
                            </div>
                        </div>
                    </form>
                    </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="saveicd_tickets"></button>
            </div>
        </div>
    <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>

<!-- /.modal -->
<div class="modal fade" id="deleteicd_ticketsModal"  role="dialog"  data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
           
             <h3 class="modal-title">Delete icd_tickets</h3>
            </div>
            <div class="modal-body">
                <input type="hidden" id="deleteKey">
                <center><h4>Are you sure to delete <label id="deleteItem"></label></h4></center>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-danger" id="deleteicd_tickets">Delete</button>
            </div>
        </div>
    <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- /.modal -->
<div class="modal fade" id="mediaGalleryModal"   role="dialog"  data-backdrop="static">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
           
             <h3 class="modal-title">icd_tickets Cover Image Gallery</h3>
            </div>
            <div class="modal-body">
                <form id="galleryFormUpload" method="post" action="<?php echo base_url()."portal/media/add_media"?>" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-8">
                            <input type="hidden" id="var_holder" value="">
                            <input type="hidden" id="file_holder" value="">
                            <input type="hidden" name="module" value="icd_tickets">
                            <input type="hidden" name="allowed_files" value="png|jpeg|jpg|gif">
                            <input type="hidden" name="file_type" value="image">
                            <input type="file" name="media_file" id="media_file" accept="*" class="form-control" required>
                        </div>
                        <div class="col-sm-4">
                            <button class="btn btn-success" id="startUpload">Start Upload</button></center>  
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div id="uploadBox">
                            </div>
                        </div>
                    </div>
                </form>
                <center>
                    <table id="imageGalleryTable" class="table table-bordered table-striped display nowrap" cellspacing="0" width="100%">
                        <thead>
                        <tr>
                            <th width="100px"></th>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Date Created</th>
                            <th>Created By</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </center>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-info" id="selectImage">Select</button>
            </div>
        </div>
    <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- /.modal -->
<div class="modal fade" id="imgPreviewModal"  role="dialog"  data-backdrop="static">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
           
             <h3 class="modal-title">Cover Image Preview</h3>
            </div>
            <div class="modal-body">
                <center><img src="" id="imgPreview" style="width:100%;"></center>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
            </div>
        </div>
    <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<!-- /.modal -->
<div class="modal fade" id="deleteImageModal"  role="dialog"  data-backdrop="static">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
           
             <h3 class="modal-title">Delete this image?</h3>
            </div>
            <div class="modal-body">
                <input type="hidden" id="deleteImage">
                <center><img src="" id="imgPreviewDel" style="width:100%;"></center>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-danger" id="deleteImageBtn">Delete</button>
            </div>
        </div>
    <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<script>

    var inputRoleConfig = {
        dropdownAutoWidth : true,
        width: 'auto',
        placeholder: "--- Select Item ---"
    };
    $("#inputicd_ticketsEventDate").datepicker({
            
        autoclose: true,format: 'yyyy-mm-dd'
            });
    $("#inputicd_ticketsEventTime").clockpicker({
        align: 'left',
        autoclose: true,
        'default': 'now',
        donetext : "Done"
    });
    var editor = CKEDITOR.replace('inputContent');

    var main = function(){
        var table = $('#icd_ticketsList').DataTable({
            "pagingType": "full_numbers",
            "paging": true,
            "lengthMenu": [10, 25, 50, 75, 100],    
            'autoWidth'   : true,
            "processing" : true,
            "serverSide" : true,
            "ordering": false,
            "ajax" : "<?php if($this->session->userdata("USERTYPE")!=0){ echo base_url()."portal/icd_tickets/get_icd_tickets_list"; }else{ echo base_url()."portal/icd_tickets/get_my_icd_tickets_list";}?>",
            "initComplete": function(settings,json){
                $('[data-toggle="tooltip"]').tooltip()
            }
            ,"columnDefs": [
            { "width": "20%",  "targets": [ 1 ] }
        ]
        });
        $("#addBtn").click(function(){
            $("#icd_ticketsModal .modal-title").html("Add <?php echo ucfirst($module_name);?>");
            $("#action").val("add");
            $("#inputCoverImage").attr("required","required");
            $('#icd_ticketsForm').validator();
            $("#icd_ticketsModal").modal("show");
            $("#saveicd_tickets").html("Save and Send Invitation");
        });

        $("#saveicd_tickets").click(function(){
            $("#icd_ticketsForm").submit();
        });


        var image_correct = true;
        var image_error = "";
        $("#icd_ticketsForm").validator().on('submit', function (e) {
            var btn = $("#saveicd_tickets");
            var action = $("#action").val();
            btn.button("loading");
            if (e.isDefaultPrevented()) {
                btn.button("reset"); 
            } else {
                e.preventDefault();
                var title = $("#inputicd_ticketsTitle").val();
                var description = $("#inputDescription").val();
                var content = editor.getData();;
                var status = $("#inputStatus").val();
                var icd_tickets_id = $("#icd_ticketsID").val();
                var first_name = $("#inputicd_ticketsFirstname").val();
                var middle_name = $("#inputicd_ticketsMiddlename").val();
                var last_name = $("#inputicd_ticketsLastname").val();
                var age = $("#inputicd_ticketsAge").val();
                var contact_number = $("#inputicd_ticketsContact").val();
                var event_date = $("#inputicd_ticketsEventDate").val();
                var event_time = $("#inputicd_ticketsEventTime").val();
                var event_place = $("#inputicd_ticketsEventPlace").val();
                var present = $("#inputicd_ticketsEventPresent").val();
                var price = $("#inputicd_ticketsPrice").val();
                var email_list = $("#inputicd_ticketsEmailList").val();
                var email_address = $("#inputicd_ticketsEmailAddress").val();

                var formData = new FormData();
                formData.append('id', icd_tickets_id);
                formData.append('title', title);
                formData.append('description', description);
                formData.append('content', content);
                formData.append('first_name', first_name);
                formData.append('middle_name', middle_name);
                formData.append('last_name', last_name);
                formData.append('age', age);
                formData.append('contact_number', contact_number);
                formData.append('event_date', event_date);
                formData.append('event_time', event_time);
                formData.append('event_place', event_place);
                formData.append('present', present);
                formData.append('price', price);
                formData.append('email_list', email_list);
                formData.append('email_address', email_address);

                if(title == "" || description == "")
                {
                    btn.button("reset"); 
                    return false;
                }
                formData.append('status', status);
                // Attach file
                formData.append('cover_image', $('#inputCoverImage').val());
                var messageLength = content.replace(/<[^>]*>/gi, '').trim().length;
                var img = document.getElementById('coverImgPrev'); 
                //or however you get a handle to the IMG
                var width = img.naturalWidth;
                var height = img.naturalHeight;
                if($('#inputCoverImage').val() == "")
                {   
                    img_error = "<span style='color:red;'>Banner image is required</span>";   
                    btn.button("reset");
                    $("#coverError").html(img_error);
                    return false;
                }
                /*if(width != "582" || height != "498")
                {                  
                    img_error = "<span style='color:red;'>Invalid cover size use 582x498</span>";   
                    btn.button("reset");
                    $("#coverError").html(img_error);
                    return false;
                }
                else
                {
                    $("#coverError").html("");  
                }*/

                if( !messageLength ) {
                    $("#ckEditorError").html("<span style='color:red;'>Please fill out this field.</span>");
                    btn.button("reset"); 
                    return false;
                }else{
                    $("#ckEditorError").html("");
                }

                var url = "<?php echo base_url()."portal/icd_tickets/add_icd_tickets";?>";
                var message = "New icd_tickets successfully added";
                if(action == "edit")
                {
                    url =  "<?php echo base_url()."portal/icd_tickets/edit_icd_tickets";?>";
                    message = "icd_tickets successfully updated";
                }
               
               
                $('#uploadBoxMain').html('<div class="progress"><div class="progress-bar progress-bar-aqua" id = "progressBarMain" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 0%"><span class="sr-only">20% Complete</span></div></div>');
                $.ajax({
                    data: formData,
                    type: "post",
                    processData: false,
                    contentType: false,
                    cache: false,
                    url: url ,
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
                    }
                    else
                    {
                         //alert("Data Save: " + data);
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
                         editor.setData('');
                         $("#icd_ticketsForm").validator('destroy');
                         $("#icd_ticketsModal").modal("hide"); 
                         $('#uploadBoxMain').html('');      
                    }
                });

            }
               return false;
        });

        $("#deleteicd_tickets").click(function(){
            var btn = $(this);
            var id = $("#deleteKey").val();
            var deleteItem = $("#deleteItem").html();
            var data = { "id" : id };
            btn.button("loading");

            $.ajax({
                        data: data,
                        type: "post",
                        url: "<?php echo base_url()."portal/icd_tickets/delete_icd_tickets";?>",
                        success: function(data){
                            //alert("Data Save: " + data);
                            btn.button("reset");
                            table.draw("page");
                            $("#deleteicd_ticketsModal").modal("hide");
                            toastr.error('icd_tickets ' + deleteItem + ' successfully deleted');
                        },
                        error: function (request, status, error) {
                            alert(request.responseText);
                        }
                });
        });

        $('#icd_ticketsModal').on('hidden.bs.modal', function (e) {
            $(this)
                .find("input,textarea,select")
                .val('')
                .end()
                .find("input[type=checkbox], input[type=radio]")
                .prop("checked", "")
                .end();
            editor.setData("");
            $("#inputStatus").val('1').trigger('change');
            $('#inputCoverImage').val("");
            $('#coverImgPrev').attr("src","");
            $("#icd_ticketsForm").validator('destroy');
        });

        $('#inputStatus').select2(inputRoleConfig);
        function resetForm($form) {
            $form.find('input:text, input:password, input:file, textarea').val('');
            $form.find('input:radio, input:checkbox')
                .removeAttr('checked').removeAttr('selected');
        }
    };
    function _edit(id)
    {
        $("#icd_ticketsModal .modal-title").html("Edit <?php echo ucfirst($module_name);?>");
        $(".add").hide();    
        $('#icd_ticketsForm').validator();    
        $("#action").val("edit");
        $("#inputCoverImage").removeAttr("required");
        $("#inputicd_ticketsname").attr("data-remote","<?php echo base_url()."icd_tickets/check_icd_ticketsname_exist?method=edit&icd_tickets_id=";?>" + id);
        var data = { "id" : id }
        $.ajax({
                data: data,
                type: "post",
                url: "<?php echo base_url()."portal/icd_tickets/get_icd_tickets_data";?>",
                success: function(data){
                    data = JSON.parse(data);
                    $("#inputicd_ticketsTitle").val(data.icd_tickets.title);
                    $("#inputDescription").val(data.icd_tickets.description);
                    editor.setData(data.icd_tickets.content);
                    $("#inputStatus").val(data.icd_tickets.status).trigger('change');
                    $('#inputCoverImage').val(data.icd_tickets.cover_image_id);
                    
                    $("#inputicd_ticketsFirstname").val(data.icd_tickets.first_name);
                    $("#inputicd_ticketsMiddlename").val(data.icd_tickets.middle_name);
                    $("#inputicd_ticketsLastname").val(data.icd_tickets.last_name);
                    $("#inputicd_ticketsAge").val(data.icd_tickets.age);
                    $("#inputicd_ticketsContact").val(data.icd_tickets.contact_number);
                    $("#inputicd_ticketsEventDate").val(data.icd_tickets.event_date);
                    $("#inputicd_ticketsEventTime").val(data.icd_tickets.event_time);
                    $("#inputicd_ticketsEventPlace").val(data.icd_tickets.event_place);
                    $("#inputicd_ticketsEventPresent").val(data.icd_tickets.present);
                    $("#inputicd_ticketsPrice").val(data.icd_tickets.price);
                    $("#inputicd_ticketsEmailList").val(data.icd_tickets.guest_email_address);
                    $("#inputicd_ticketsEmailAddress").val(data.icd_tickets.email_address);

                    $('#coverImgPrev').attr("src","<?php echo base_url()."/uploads/icd_tickets/"; ?>" + data.icd_tickets.cover_image);
                    $("#icd_ticketsID").val(data.icd_tickets.id);
                    $("#icd_ticketsModal").modal("show");
                    $("#saveicd_tickets").html("Save Invitation");
                },
                error: function (request, status, error) {
                    alert(request.responseText);
                }
        });
    }
    function _delete(id,item)
    {
        $("#deleteicd_ticketsModal .modal-title").html("Delete <?php echo rtrim(ucfirst($module_name),"s");?>");
        $("#deleteItem").html(item);
        $("#deleteKey").val(id);
        $("#deleteicd_ticketsModal").modal("show");
    }
    
    function img_preview(img_src)
    {
        $("#imgPreview").attr("src","<?php echo base_url()."uploads/icd_tickets/"?>"+img_src);
        $("#imgPreviewModal").modal("show");
    }

    
    function set_image_loader(var_holder,file_holder)
    {
        $("#var_holder").val(var_holder);
        $("#file_holder").val(file_holder);
        $("#mediaGalleryModal").modal("show");
    }

    var new_table = $('#imageGalleryTable').DataTable({  
            "language": {                
                "infoFiltered": ""
            },
            "processing" : true,
            "serverSide" : true,
            "searching" : false,
            "pageLength": 10, "bLengthChange": false,
            "ajax" : "<?php echo base_url()."portal/media/get_media_list?module=icd_tickets";?>",
            "initComplete": function(settings,json){
                $('[data-toggle="tooltip"]').tooltip()
            }
            ,"columnDefs": [
            { "visible": false,  "targets": [ 1 ] }
        ], "order": [[ 0, 'desc' ]]
        });

    $('#galleryFormUpload').ajaxForm( {
            dataType : 'json',
            beforeSubmit: function() {
                $("#startUpload").button("loading");
                $('#uploadBox').html('<div class="progress"><div class="progress-bar progress-bar-aqua" id = "progressBar" role="progressbar" aria-valuenow="20" aria-valuemin="0" aria-valuemax="100" style="width: 0%"><span class="sr-only">20% Complete</span></div></div>');
            },
            uploadProgress: function ( event, position, total, percentComplete ) {
                if (percentComplete == 100) {
                    $('#progressBar').css('width',percentComplete+'%').html('Processing...');
                } else {
                    $('#progressBar').css('width',percentComplete+'%').html(percentComplete+'%');
                }
            },
            success: function(data){
                
                if(!data)
                {
                    $("#startUpload").button("reset");
                    toastr.error(data);
                }
                else
                {   
                    $("#startUpload").button("reset");
                    new_table.draw();
                    toastr.success("Upload Complete");
                    $('#uploadBox').html('<div id="progressOverlay"><div class="progress progress-striped"><div class="bar" id="progressBar" style="width: 0%;">0%</div></div></div>');       
                    $("#media_file").val('');     
                    $('#uploadBox').html("");
                }
            
            },
            error: function (request, status, error) {
                $("#startUpload").button("reset");
                toastr.error(request.responseText);
            }
    });

    $("#selectImage").click(function(){
        $("#"+$("#var_holder").val()).val($('input[name=selected_image]:checked').val());
        $("#"+$("#file_holder").val()).attr("src",$('input[name=selected_image]:checked').attr("data"));
        $("#mediaGalleryModal").modal("hide"); 
        new_table.draw();
    });

    function _delete_media(id,file_name)
    {
        $("#imgPreviewDel").attr("src",file_name);
        $("#deleteImage").val(id);
        $("#deleteImageModal").modal("show");
    }

    $("#deleteImageBtn").click(function(){
        var btn = $(this);
        var id = $("#deleteImage").val();
        var data = { "id" : id };
        btn.button("loading");

        $.ajax({
                data: data,
                type: "post",
                url: "<?php echo base_url()."portal/media/delete_media";?>",
                success: function(data){
                    //alert("Data Save: " + data);
                    btn.button("reset");
                    new_table.draw('page');
                    $("#deleteImageModal").modal("hide");
                    toastr.error('Image successfully deleted');
                },
                error: function (request, status, error) {
                    alert(request.responseText);
                }
        });
    });

    $(document).ready(main);

</script>