<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
    <?php 
	$module_name = "iTOUCH Users";
	echo ucfirst($module_name);?>
    <small>Management</small>
    </h1>
    <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"><?php echo ucfirst($module_name);?></li>
    </ol>
</section>
<!--<button class="btn btn-danger btn-circle btn-lg fix-btn" id="clear"  data-toggle="tooltip" title="Clear Logs">
    <span class="glyphicon glyphicon-trash"></span>
</button> -->
<!-- Main content -->
<section class="content">
<div class="box" id="main-list">
    <div class="box-header">
        <h3 class="box-title"><?php echo ucfirst($module_name);?> List</h3>    
        <!--<button class="btn btn-info pull-right" id="downloadLogs"  data-toggle="tooltip" title="Download">Download Logs</button>-->
    </div>
    <!-- /.box-header -->
    <div class="box-body">
        <table id="itouch_usersList" class="table table-bordered table-striped">
        <thead>
        <tr>
            <th>ID</th>
            <th>Email</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Division</th>
            <th>Department</th>
            <th>Tower</th>
            <th>Status</th>
            <th>Date Registered</th>
            <!--<th>Actions</th>-->
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
<div class="modal fade" id="deleteLogsModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
           
             <h3 class="modal-title">Delete All Logs</h3>
            </div>
            <div class="modal-body">
                <center><h4>Are you sure to delete all Logs?</h4></center>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-danger" id="deleteLogs">Delete</button>
            </div>
        </div>
    <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->

<!-- /.modal -->
<div class="modal fade" id="itouch_usersDetailsModal">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
           
             <h3 class="modal-title">Log Details</h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-2">
                        <label>Date Created:</label>
                    </div>
                    <div class="col-md-10">
                        <p id="date_created"></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <label>Module:</label>
                    </div>
                    <div class="col-md-10">
                        <p id="module"></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <label>Log:</label>
                    </div>
                    <div class="col-md-10">
                        <p id="log"></p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <label>Details:</label>
                    </div>
                    <div class="col-md-10">
                        <pre id="details" style=" white-space: pre-wrap;  white-space: -moz-pre-wrap; white-space: -pre-wrap; white-space: -o-pre-wrap;word-wrap: break-word;"></pre>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-2">
                        <label>Created By:</label>
                    </div>
                    <div class="col-md-10">
                        <p id="created_by"></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            </div>
        </div>
    <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->


<!-- /.modal -->
<div class="modal fade" id="downloadLogsModal" role="dialog"  data-backdrop="static">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
           
             <h3 class="modal-title">Download Logs</h3>
            </div>
            <div class="modal-body">
                <center>
                        <div class="form-group">
                            <label>Date range:</label>

                            <div class="input-group">
                                <button type="button" class="btn btn-default pull-right" id="daterange-btn">
                                    <span>
                                    <i class="fa fa-calendar"></i> Date range picker
                                    </span>
                                    <i class="fa fa-caret-down"></i>
                                </button>
                            </div>
                        </div>
                </center>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-primary" id="downloadBtn">Download Logs</button>
            </div>
        </div>
    <!-- /.modal-content -->
    </div>
<!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<script>
    var startDateDownload;
    var endDateDownload;

    $('#daterange-btn').daterangepicker(
      {
        ranges   : {
          'Today'       : [moment(), moment()],
          'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
          'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
          'Last 30 Days': [moment().subtract(29, 'days'), moment()],
          'This Month'  : [moment().startOf('month'), moment().endOf('month')],
          'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
        },
        startDate: moment().subtract(29, 'days'),
        endDate  : moment()
      },
      function (start, end) {
        startDateDownload = start.format('YYYY-MM-DD');
        endDateDownload = end.format('YYYY-MM-DD');
        console.log(startDateDownload + endDateDownload);
        $('#daterange-btn span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
      }
    );
    var table = $('#itouch_usersList').DataTable({ 
        "order": [[ 0, "desc" ]] ,
        'autoWidth'   : true,
        "processing" : true,
        "serverSide" : true, 
        "ajax" : "<?php echo base_url()."portal/itouch_users/get_itouch_users_list";?>",
        "initComplete": function(settings,json){
            $('[data-toggle="tooltip"]').tooltip()
        }
        ,"columnDefs": [
        { "width": "20%",  "targets": [ 1 ] }
    ]
    });

    var main = function(){
       
       
        $("#clear").click(function(){
            $("#deleteLogsModal").modal("show");
        });

        $("#deleteLogs").click(function(){
            $("#deleteLogs").button("loading");
            var values = {"action" : "delete"}
            $.ajax({
                url: "<?php echo base_url();?>portal/itouch_users/delete_all_itouch_users",
                type: "post",
                data: values ,
                success: function (response) {
                    toastr.success("All itouch_users successfully deleted");
                    $("#deleteLogsModal").modal("hide");
                    table.draw();
                    $("#deleteLogs").button("reset");
                    //window.location = "";
                },
                error: function(jqXHR, textStatus, errorThrown) {
                console.log(textStatus, errorThrown);
                $("#deleteLogs").button("reset");
                }


            });
        });
        $("#downloadLogs").click(function(){
            $("#downloadLogsModal").modal("show");
        });
        $("#downloadBtn").click(function(){
            window.open ("<?php echo base_url()."portal/itouch_users/download?fromDate="?>" + startDateDownload + "&toDate=" + endDateDownload,"_blank") ;
        });
    }

    function _view(id)
    {
        var values = { "id": id };
        $.ajax({
            url: "<?php echo base_url();?>portal/itouch_users/get_log_details",
            type: "post",
            data: values ,
            success: function (response) {
                data = JSON.parse(response);
                $("#log").html(data.log.log);
                $("#details").html(data.log.details);
                $("#date_created").html(data.log.date_created);
                $("#created_by").html(data.log.created_by);
                $("#module").html(data.log.module);
                $("#itouch_usersDetailsModal").modal("show");
            },
            error: function(jqXHR, textStatus, errorThrown) {
            console.log(textStatus, errorThrown);
            $("#deleteLogs").button("reset");
            }


        });
    }
    $(document).ready(main);

</script>