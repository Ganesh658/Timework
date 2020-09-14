<?php
$jsonObj=@json_decode($jsonObj);
$results = @$jsonObj->results;
$page_type = @$jsonObj->page_type;
?>
<style>
.center{
	text-align:center;
}
ul.spekul{
	margin-bottom:5%;
	padding:0;
}
ul.spekul li{
	list-style:none;
	padding:5px;
	float:left;
	margin-bottom: 2%;
}
ul.spekul li a{	
	background-color:#428bca;
	border:1px solid;
	padding:5px 10px;
	color:#fff;
}
</style>
<link href="<?php echo base_url()?>externals/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
<link href="<?php echo base_url()?>externals/css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">
<link href="<?php echo base_url()?>externals/css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">
	<div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-sm-4">
			<h2>Candidate Posts</h2>
			<ol class="breadcrumb">
				<li>
					<a href="<?php echo base_url()?>">Dashboard</a>
				</li>
				<li class="active">
					<strong>Candidate Posts</strong>
				</li>
			</ol>
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
						<div class="row">
							<div class="col-sm-12">
								<ul class="spekul">
									<li>
										<a <?php if(@$jsonObj->page_type == 0){echo 'style="background-color:#fff;color:#000;"';}?> href="<?php echo base_url();?>index.php/home/candidateposts/0">Pending Posts</a>
									</li>
									<li>
										<a <?php if(@$jsonObj->page_type == 1){echo 'style="background-color:#fff;color:#000;"';}?> href="<?php echo base_url();?>index.php/home/candidateposts/1">Approved Posts</a>
									</li>
								</ul>
							</div>
						</div>
							<table class="table table-striped table-bordered table-hover " id="editable" >
								<thead>
									<tr>
										<th class="center">S.No</th>
										<th class="center">Job Title</th>
										<th class="center">Job Skills</th>
										<th class="center">Employment Type</th>									
										<th class="center">Details</th>
										<th class="center">Posted Date</th>
										<th class="center" style="width: 15%;">Actions</th>
									</tr>
								</thead>
								<tbody>
								<?php
								if(@sizeOf($results) > 0)
								{
									for($i=0;$i<sizeOf($results);$i++)
									{
								?>
									<tr class="gradeX">
										<td class="center"><?php echo ($i+1)?></td>
										<td class="center"><?php echo @$results[$i]->job_title?></td>
										<td class="center"><?php echo @$results[$i]->job_skills?></td>
										<td class="center"><?php echo @$results[$i]->employment_type?></td>
										<td class="center">
											<a href="<?php echo base_url();?>index.php/home/viewCandidatePosts/<?php echo @$jsonObj->page_type; ?>/<?php echo @$results[$i]->id?>/1" class='btn btn-success'>
												View
											</a>
										</td>
										<td class="center"><?php echo @$results[$i]->timeago?></td>
										<td class="center">
											<?php
											if(@$results[$i]->status == 0)
											{
											?>
												<a style="color: #fff;font-weight: bold;" href="<?php echo base_url();?>index.php/home/approveposts/<?php echo @$results[$i]->id?>/2" class='btn btn-primary'>Approve Post</a>
											<?php 
											}
											else
											{
												echo "Approved";
											}
											?>
										</td>
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
</script>