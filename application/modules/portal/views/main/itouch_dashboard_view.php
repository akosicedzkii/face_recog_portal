
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
        Dashboard
        <small>Main</small>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active">Dashboard</li>
      </ol>
    </section>

    <!-- Main content -->
    <section class="content">
      <!-- Info boxes -->
      <div class="row">
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-aqua"><i class="ion ion-ios-star"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Total Site Login</span>
              <span class="info-box-number"><?php echo $site_login;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-red"><i class="fa fa-user"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Login this Month</span>
              <span class="info-box-number"><?php echo $month_login;?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->

        <!-- fix for small devices only -->
        <div class="clearfix visible-sm-block"></div>

        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-green"><i class="ion ion-ios-eye-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">All Ticket Searched</span>
              <span class="info-box-number"><?php echo $ticket_search?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
        <div class="col-md-3 col-sm-6 col-xs-12">
          <div class="info-box">
            <span class="info-box-icon bg-yellow"><i class="ion ion-ios-glasses-outline"></i></span>

            <div class="info-box-content">
              <span class="info-box-text">Ticket Search Month</span>
              <span class="info-box-number"><?php echo $ticket_month?></span>
            </div>
            <!-- /.info-box-content -->
          </div>
          <!-- /.info-box -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->
 <div class="row">
        <!-- Left col -->
        <div class="col-md-12">
          <!-- MAP & BOX PANE -->
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Monthly Graph</h3>
				  
				<select id="year2" style="width: 10%; height: 100%; margin-top: 1%; margin-left: 1%">
					<option>
						2019
					</option>
					<option>
						2018
					</option>
					<option>
						2017
					</option>
					<option>
						2016
					</option>
					<option>
						2015
					</option>
				</select>
				<button id="btn-search2" class="btn" onclick="btn_search2()"  style="width: 6%; height: 100%; padding: 5px;"> <i class="fa fa-search"></i></button>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="row">
                <div class="col-md-12 col-sm-12">
                  <div class="pad">
                    <!-- Map will be created here -->
						<div id="container2" style="width:100%; height:400px; margin-top: 2%;">
                  </div>
				 
                </div>
                <!-- /.col -->
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
       

        </div>
        <!-- /.col -->

       
      </div>
      </div>
	  
      <!-- /.row -->
      <!-- Main row -->
      <div class="row">
        <!-- Left col -->
        <div class="col-md-12">
          <!-- MAP & BOX PANE -->
          <div class="box box-success">
            <div class="box-header with-border">
              <h3 class="box-title">Yearly Graph</h3>
				 <select id="year" style="width: 10%; height: 100%; margin-top: 1%; margin-left: 2%">
					<option> 2019 </option>
					<option> 2018 </option>
					<option> 2017 </option>
					<option> 2016 </option>
				</select>
				<select id="month" style="width: 10%; height: 100%; margin-top: 1%;">
					<option>January</option>
					<option>February</option>
					<option>March</option>
					<option>April</option>
					<option>May</option>
					<option>June</option>
					<option>July</option>
					<option>August</option>
					<option>September</option>
					<option>October</option>
					<option>November </option>
					<option>December</option>
				</select>
				<button id="btn-search" class="btn" onclick="btn_search()"  style="width: 6%; height: 100%; padding: 5px;"> <i class="fa fa-search"></i></button>
              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <!-- /.box-header -->
            <div class="box-body no-padding">
              <div class="row">
                <div class="col-md-12 col-sm-12">
                  <div class="pad">
                    <!-- Map will be created here -->
						<div id="container" style="width:100%; height:400px; margin-top: 2%;">
                  </div>
				   <div style=" height: 250px; margin-left: 5%; font-size: 20px">
					Active Users/Month: <a id="active_user"></a><br>
					Average Users/Day: <a id="user_per_day"></a><br>
					Average Ticket Search Hits/Day: <a id="average_ticket"></a>
					</div>
                </div>
                <!-- /.col -->
                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->
       

        </div>
        <!-- /.col -->

       
        <!-- /.col -->
      </div>
      </div>
	  
      <div class="row">
            <div class="col-md-6">
          <div class="box box-primary">
            <div class="box-header with-border">
              <h3 class="box-title">Recently Searched Ticket</h3>

              <div class="box-tools pull-right">
                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                </button>
                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
              </div>
            </div>
            <div class="box-body">
              <ul class="products-list product-list-in-box">
              <?php 
                      if($tickets != null)
                      {
                        $count = 0;
                        foreach($tickets as $row)
                        {
                          if($count==5)
                          {
                            break;
                          }
                            ?>
                               <li class="item" data-toggle="tooltip"  title="<?php echo ucfirst($row->description);?>">
                                <div class="product-info">
                                  <a href="javascript:void(0)"  class="product-title"><?php echo ucfirst($row->refno);?>
                                   
                                  <span class="product-description">
                                        <?php echo substr(ucfirst($row->description),0,80);?>
                                      </span>
                                </div>
                              </li>
                            <?php
                            $count++;
                        }
                      }
                      ?>
                
              </ul>
            </div>
            <div class="box-footer text-center">
            <?php 
              if (in_array("products", $menu)) {
              ?>
                  <a href="<?php echo base_url("portal/main/products");?>" class="uppercase">View All Blogs</a>
              <?php }?>
            </div>
          </div>
            </div>

            <div class="col-md-6">
              <div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title">Latest Members</h3>

                  <div class="box-tools pull-right">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i>
                    </button>
                  </div>
                </div>
                <div class="box-body no-padding">
                  <ul class="users-list clearfix">
                      <?php 
                      if($users != null)
                      {
                        $count = 0;
                        foreach($users as $row)
                        {
                          if($count==8)
                          {
                            break;
                          }
                            ?>
                                <li>
                                <a class="users-list-name" data-toggle="tooltip" title="<?php echo ucwords(str_replace("  "," ",$row->first_name. " " .$row->last_name));?>" href="#"><?php echo ucwords(str_replace("  "," ",$row->first_name. " " .$row->last_name));?></a>
                                <span class="users-list-date"><?php echo date("Y-m-d",strtotime($row->date_created));?></span>
                                </li>
                            <?php
                            $count++;
                        }
                      }
                      ?>
                  </ul>
                </div>
                <div class="box-footer text-center">
                    <?php 
                        if (in_array("itouch_users", $menu)) {
                        ?>
                          <a href="<?php echo base_url("portal/main/itouch_users");?>" class="uppercase">View All Users</a>
                    <?php }?>
                </div>
              </div>
            </div>
          </div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
<script src="https://code.highcharts.com/highcharts.js"></script>
<script>
$(document).ready(function(){


btn_search();

});




function btn_search(){
    //--getting the value of the month and year
    var month = document.getElementById("month").value;
    var year = document.getElementById("year").value;
    //- Converting months to number format
    var months = {
    'January' : '01',
    'February' : '02',
    'March' : '03',
    'April' : '04',
    'May' : '05',
    'June' : '06',
    'July' : '07',
    'August' : '08',
    'September' : '09',
    'October' : '10',
    'November' : '11',
    'December' : '12'
    }

    var days_in_month = get_days(months[month],2019);


     $.ajax({
        type: "POST",
        url: '<?php echo base_url()."portal/itouch_dashboard/monthly_logs"?>',
        data: {month : month, year : year, day : days_in_month},
        success: function(data){
        
            var datas = JSON.parse(data);
            //---passing the data into the chart function
            chart_data(datas,month,year);
            //--displaying the data in the HTML
            document.getElementById("active_user").innerHTML = datas['active_user'];
            var average_user = datas['average_user']['username']/days_in_month;
            document.getElementById("user_per_day").innerHTML = average_user.toFixed(3);
            var average_ticket = datas['average_ticket']['ticket']/days_in_month;
            document.getElementById("average_ticket").innerHTML = average_ticket.toFixed(3);
        }
    });
}

function get_days(month,year){
        //getting the number of days in a month
        return new Date(year, month, 0).getDate();
}


function chart_data(data,month,year){
    //--populate data - - - - - - - - - - - - - 
     
    var datas = data['ticket_search'];
    var active_user_per_day = data['active_user_per_day'];
    var user_per_day = data['user_per_day'];
    
    //--storing the data in an array - - - - -
    var processed_ticket = new Array();
            for (i = 0; i < datas.length; i++) {
                processed_ticket.push(parseInt(datas[i]['date']));
            }
    var processed_user_data = new Array();
            for (i = 0; i < user_per_day.length; i++) {
                processed_user_data.push(parseInt(user_per_day[i]['username']));
            }
    
    
    
    
    var myChart = Highcharts.chart('container', {
        chart: {
            type: 'column',
            zoomType: 'xy'
        },
        title: {
            text: 'Access Log for the month of ' + month + " " + year
        },
        xAxis: {
        	text: 'Month',
        },
        yAxis: {
            title: {
                text: 'Count'
            }
        },
        legend: {
                    layout: 'vertical',
                    align: 'left',
                    x: 110,
                    verticalAlign: 'top',
                    y: 0,
                    floating: true,
                    backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
                },
        series: [{
            name: 'Number of Ticket Search',
            data: processed_ticket
        },{ type: 'line',
            name: 'Users per day',
            data: processed_user_data
        }]
    });
}


$(document).ready(function(){
  
 btn_search2();

});

function btn_search2(){
	var year = document.getElementById("year2").value;
	
	 $.ajax({
  		type: "POST",
        url: '<?php echo base_url()."portal/itouch_dashboard/access_log_per_month"?>',
  		data: {year : year},
  		success: function(data){
            
            var data = JSON.parse(data);
  			chart_data2(data,year);
  		}
	});

}

function chart_data2(data,years){
  var log_out = data['log_out_count'];
  var log_in = data['log_in_count'];
  var query = data['query_count'];
  var myChart = Highcharts.chart('container2', {
        chart: {
            type: 'column',
            zoomType: 'xy'
        },
        title: {
            text: 'Access Logs of ' + years
        },
        xAxis: {
        	text: 'Month',
            categories: ['Jan', 'Feb', 'March', 'April', 'May', 'June','July','August','Sept','Oct','Nov','Dec']
        },
        yAxis: {
            title: {
                text: 'Count'
            }
        },
        legend: {
                    layout: 'horizontal',
                    align: 'left',
                    x: 120,
                    verticalAlign: 'top',
                    y: 1,
                    floating: true,
                    backgroundColor: (Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'
                },
        series: [{
            name: 'Log-out Count',
            data: [parseInt(log_out[0]['log_out_count']), parseInt(log_out[1]['log_out_count']),parseInt(log_out[2]['log_out_count']),parseInt(log_out[3]['log_out_count']),parseInt(log_out[4]['log_out_count']),parseInt(log_out[5]['log_out_count']),
            parseInt(log_out[6]['log_out_count']),parseInt(log_out[7]['log_out_count']),parseInt(log_out[8]['log_out_count']),parseInt(log_out[9]['log_out_count']),parseInt(log_out[10]['log_out_count']),parseInt(log_out[11]['log_out_count'])]
        },{
            name: 'Log-in Count',
            data: [parseInt(log_in[0]['log_in_count']), parseInt(log_in[1]['log_in_count']),parseInt(log_in[2]['log_in_count']),parseInt(log_in[3]['log_in_count']),parseInt(log_in[4]['log_in_count']),parseInt(log_in[5]['log_in_count']),
            parseInt(log_in[6]['log_in_count']),parseInt(log_in[7]['log_in_count']),parseInt(log_in[8]['log_in_count']),parseInt(log_in[9]['log_in_count']),parseInt(log_in[10]['log_in_count']),parseInt(log_in[11]['log_in_count'])]      
        },{
            type: 'line',
            name: 'Query Count',
            data: [parseInt(query[0]['query_count']), parseInt(query[1]['query_count']),parseInt(query[2]['query_count']),parseInt(query[3]['query_count']),parseInt(query[4]['query_count']),parseInt(query[5]['query_count']),
            parseInt(query[6]['query_count']),parseInt(query[7]['query_count']),parseInt(query[8]['query_count']),parseInt(query[9]['query_count']),parseInt(query[10]['query_count']),parseInt(query[11]['query_count'])]
            
        }]
    });
}


</script>
