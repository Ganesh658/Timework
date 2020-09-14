<style>
.center{
	text-align:center;
}
</style>
<?php 
if(@$usertype == 3)
{
	$pageName = 'Candidates List';
}
if(@$usertype == 5)
{
	$pageName = 'Recruiters Registered Users List';
}
?>
<link href="<?php echo base_url()?>externals/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
<link href="<?php echo base_url()?>externals/css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">
<link href="<?php echo base_url()?>externals/css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">
	<div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-sm-10">
			<h2><?php echo @$pageName;?></h2>
			<ol class="breadcrumb">
				<li>
					<a href="<?php echo base_url()?>">Dashboard</a>
				</li>
				<li class="active">
					<strong><?php echo @$pageName;?></strong>
				</li>
			</ol>
		</div>
		<div class="col-sm-2 pull-right">
			<h2>
				
			</h2>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="wrapper wrapper-content">
				<div class="row">
					<div class="ibox">                        
						<div class="ibox-content">
						<?php
						if(@$this->session->userdata("success") != '')
						{
						?>
							<div class="alert alert-success alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                <?php
								echo @$this->session->userdata("success");
								@$this->session->unset_userdata("success");
								?>
                            </div>
						<?php
						}
						if(@$this->session->userdata("fail") != '')
						{
						?>
							<div class="alert alert-danger alert-dismissable">
                                <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                <?php
								echo @$this->session->userdata("fail");
								@$this->session->unset_userdata("fail");
								?>
                            </div>
						<?php
						}
						?>
							<table class="table table-striped table-bordered table-hover " id="editable" >
								<thead>
									<tr>
										<th class="center">S.No</th>
										<?php 
										if(@$usertype == 5)
										{
										?>
										<th class="center">Business Name</th>
										<th class="center">Business Address</th>
										<?php 
										}
										?>
										<th class="center">Name</th>
										<th class="center">Email</th>
										<th class="center">Mobile</th>
										<th class="center">Password</th>
										<th class="center">Status</th>										
										<th class="center">Actions</th>										
										<th class="center">Registered Date</th>		
							
									</tr>
								</thead>
								<tbody>
								<?php
								if(@sizeOf($users) > 0)
								{
									for($i=0;$i<sizeOf($users);$i++)
									{
								?>
									<tr class="gradeX">
										<td class="center"><?php echo ($i+1)?></td>
										<?php 
										if(@$usertype == 5)
										{
										?>
											<td class="center">
												<?php echo $users[$i]['business_name'];?>
												
											</td>
											<td class="center">
												<?php echo $users[$i]['address'];?>
											</td>
										<?php 
										}
										?>
										<td class="center"><?php echo @$users[$i]['firstname'];?></td>
										<td class="center"><?php echo @$users[$i]['email'];?></td>
										<td class="center"><?php echo @$users[$i]['mobile'];?></td>
										
										<td class="center">
											<?php echo @$users[$i]['shw_pass'];?>
										</td>
										
										<!-- <td class="center">
											<?php
											if(@$users[$i]['status'] == 1)
											{
											?>
												<span style="color:green;font-weight: bold;">Active</span>
											<?php
											}
											else if(@$users[$i]['status'] == 2)
											{
											?>
												<span style="color:blue;font-weight: bold;">In-Active</span>
											<?php
											}
											else
											{
											?>
												<span style="color:red;font-weight: bold;">Pending</span>
											<?php
											}
											?>
										</td> -->
										<td class="center">
											<?php
											if(@$users[$i]['status'] == 1)
											{
											?>
												<span style="color:green;font-weight: bold;">Active</span><br>
												<a style="color:blue;font-weight: bold;" href="<?php echo base_url();?>index.php/home/userStatusChange/2/<?php echo @$users[$i]['id'];?>/<?php echo @$usertype;?>">Make It In-Active</a>
											<?php
											}
											else if(@$users[$i]['status'] == 2)
											{
											?>
												<span style="color:blue;font-weight: bold;">In-Active</span><br>
												<a style="color:green;font-weight: bold;" href="<?php echo base_url();?>index.php/home/userStatusChange/1/<?php echo @$users[$i]['id'];?>/<?php echo @$usertype;?>">Make It Active</a>
											<?php
											}
											else
											{
											?>
												<a style="color:green;font-weight: bold;" href="<?php echo base_url();?>index.php/home/userStatusChange/1/<?php echo @$users[$i]['id']?>/<?php echo @$usertype;?>">Make It Active</a>
											<?php
											}
											?>
										</td>
										<td class="center">
											<!-- <a href="<?php echo base_url()?>index.php/home/edituser/<?php echo @$users[$i]['id'];?>/<?php echo @$usertype;?>"><i class="fa fa-edit"></i></a> &nbsp; | &nbsp; -->
											<a href="<?php echo base_url()?>index.php/home/deleteuser/<?php echo @$users[$i]['id'];?>/<?php echo @$usertype;?>" class='deleteItem'><i class="fa fa-trash"></i></a>
										</td>	
										<td class="center"><?php echo @date("d-m-Y",strtotime($users[$i]['regDate']));?></td>
										
										</tr>
								<?php
									}
								}
								?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- User Info Model Starts-->
 <div class="modal inmodal" id="myModal2" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content animated fadeIn">
            <div class="modal-header" style="padding: 10px;">
                <button type="button" class="close custclose" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Vendor Details</h4>
            </div>
            <form method="POST" action="#" class="form-horizontal" enctype="multipart/form-data" >
                <div class="modal-body" id="results"> </div>
            </form>
        </div>
    </div>
</div>
<!-- User Info Model End-->
<script src="<?php echo base_url()?>externals/js/plugins/jeditable/jquery.jeditable.js"></script>
<script src="<?php echo base_url()?>externals/js/plugins/dataTables/jquery.dataTables.js"></script>
<script src="<?php echo base_url()?>externals/js/plugins/dataTables/dataTables.bootstrap.js"></script>
<script src="<?php echo base_url()?>externals/js/plugins/dataTables/dataTables.responsive.js"></script>
<script src="<?php echo base_url()?>externals/js/plugins/dataTables/dataTables.tableTools.min.js"></script>
<script>
$(document).ready(function() {
	$('.dataTables-example').dataTable({
		responsive: true,
		"dom": 'T<"clear">lfrtip',
		"tableTools": {
			"sSwfPath": "js/plugins/dataTables/swf/copy_csv_xls_pdf.swf"
		}
	});

	/* Init DataTables */
	var oTable = $('#editable').dataTable();

	/* Apply the jEditable handlers to the table */
	/*oTable.$('td').editable( '../example_ajax.php', {
		"callback": function( sValue, y ) {
			var aPos = oTable.fnGetPosition( this );
			oTable.fnUpdate( sValue, aPos[0], aPos[1] );
		},
		"submitdata": function ( value, settings ) {
			return {
				"row_id": this.parentNode.getAttribute('id'),
				"column": oTable.fnGetPosition( this )[2]
			};
		},

		"width": "90%",
		"height": "100%"
	} );*/


});

function fnClickAddRow() {
	$('#editable').dataTable().fnAddData( [
		"Custom row",
		"New row",
		"New row",
		"New row",
		"New row" ] );

}
$('.userDetails').click(function(){
	var userid = $(this).attr("id");
	if(userid != '')
	{
		$.ajax({
		type:"POST",
		url:'<?php echo base_url(); ?>index.php/home/getVendorInfo/'+userid,
		//data:"city_id="+cityid,"user_id="+page,
		async:false,
		success:function(response)
		{
			$('#myModal2').modal('show');
			$('#results').html('');
			$('#results').html(response);
		}

	});
	}
});
</script>