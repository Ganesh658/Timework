<style>
.center{
	text-align:center;
}
</style>
<link rel="stylesheet" href="<?php echo base_url();?>externals/css/chosen.css">
<link href="<?php echo base_url()?>externals/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">
<link href="<?php echo base_url()?>externals/css/plugins/dataTables/dataTables.responsive.css" rel="stylesheet">
<link href="<?php echo base_url()?>externals/css/plugins/dataTables/dataTables.tableTools.min.css" rel="stylesheet">
	<div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-sm-6">
			<h2>Enquiries</h2>
			<ol class="breadcrumb">
				<li>
					<a href="<?php echo base_url()?>">Dashboard</a>
				</li>
				<li class="active">
					<strong>Enquiries</strong>
				</li>
			</ol>
		</div>
		<div class="col-sm-6">
			
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
										<th class="center">Name</th>
										<th class="center">Email</th>
										<th class="center">Mobile</th>
										<th class="center">Subject</th>
										<th class="center">Message</th>
										<th class="center">Date</th>										
										<th class="center">Actions</th>
									</tr>
								</thead>
								<tbody>
								<?php
								if(@sizeOf($banners) > 0)
								{
									for($i=0;$i<sizeOf($banners);$i++)
									{
								?>
									<tr class="gradeX">
										<td class="center"><?php echo ($i+1)?></td>
										
										
										<td class="center"><?php echo @$banners[$i]['first_name']." ".@$banners[$i]['last_name'];?></td>
										<td class="center"><?php echo @$banners[$i]['user_email'];?></td>
										<td class="center"><?php echo @$banners[$i]['user_mobile'];?></td>
										<td class="center"><?php echo @$banners[$i]['user_subject'];?></td>
										<td class="center"><?php echo @$banners[$i]['user_query'];?></td>
										<td class="center" style="width: 10%;"><?php echo @date("Y-m-d",strtotime($banners[$i]['created_date']));?></td>
										<td class="center">
											<a href="<?php echo base_url()?>index.php/home/deleteenquiry/<?php echo @$banners[$i]['id'];?>" class='deleteItem'><i class="fa fa-trash"></i></a>
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
<script src="<?php echo base_url();?>externals/js/chosen.jquery.js" type="text/javascript"></script>
<script type="text/javascript">
	var config = {
  '.chosen-select'           : {},
  '.chosen-select-deselect'  : {allow_single_deselect:true},
  '.chosen-select-no-single' : {disable_search_threshold:10},
  '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
  '.chosen-select-width'     : {width:"95%"}
}
for (var selector in config) {
  $(selector).chosen(config[selector]);
}
</script>
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

});

function fnClickAddRow() {
	$('#editable').dataTable().fnAddData( [
		"Custom row",
		"New row",
		"New row",
		"New row",
		"New row" ] );

}
$('#journalval').change(function(){
	var journalval = $(this).val();
	window.location.href='<?php echo base_url(); ?>index.php/home/enquiries/'+journalval;
});
</script>