<?php
$jsonObj=@json_decode($jsonObj);
$categories=@$jsonObj->categories;
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
	padding:5px 10px;
	float:left;
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
			<h2>Categories</h2>
			<ol class="breadcrumb">
				<li>
					<a href="<?php echo base_url()?>">Dashboard</a>
				</li>
				<li class="active">
					<strong>Categories</strong>
				</li>
			</ol>
		</div>
		<div class="col-sm-4 pull-right">
			<!-- <h2>
				<a href="<?php echo base_url()?>index.php/home/createcategories" class="btn btn-w-m btn-primary pull-right">Add Category</a>
			</h2> -->
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
						<form method="POST" id="orderForm" action="<?php echo base_url('index.php/home/updateCatOrderPos');?>">
							<table class="table table-striped table-bordered table-hover " id="editable" >
								<thead>
									<tr>
										<th class="center">S.No</th>
										<th class="center">Category</th>
										<th class="center">Sub Categories</th>
										<th class="center">Position</th>
										<th class="center">Status</th>
										<th class="center">Actions</th>
									</tr>
								</thead>
								<tbody>
								<?php
								if(@sizeOf($categories) > 0)
								{
									for($i=0;$i<sizeOf($categories);$i++)
									{
								?>
									<tr class="gradeX">
										<td class="center"><?php echo ($i+1)?></td>
										<td class="center">
											<?php echo @$categories[$i]->cat_name;?>
										</td>
										
										<td class="center">
										<?php
										if(@$categories[$i]->is_sub == 1)
										{
										?>
											<a href="<?php echo base_url();?>index.php/home/subcategories/<?php echo @$categories[$i]->id?>">View (<?php echo @sizeOf(@$categories[$i]->subCategories);?>)</a>
										<?php
										}
										else
										{
											echo "N/A";
										}
										?>
										</td>
										
										<td class="center">
											<input type="hidden" name="row[]" value="<?php echo @$categories[$i]->id;?>" />
											<input type="hidden" name="no_<?php echo @$categories[$i]->id;?>" id="ind_<?php echo @$i;?>" value="<?php echo @$i;?>" />
											<?php
											if(@$i == 0)
											{

											}
											else
											{
											?>
												<a title="Move Up To The Position" href="javascript:;" class="orderAsc index<?php echo @$i;?>" data-id="<?php echo @$categories[$i]->id;?>" order="<?php echo @$categories[$i]->cat_position;?>" index="<?php echo @$i;?>"><i class="fa fa-arrow-up"></i> &nbsp;</a>
											<?php
											}
											?>
											<a title="Move Down To The Position" href="javascript:;" class="orderDesc index<?php echo @$i;?>" data-id="<?php echo @$categories[$i]->id;?>" order="<?php echo @$categories[$i]->cat_position;?>" index="<?php echo @$i;?>"><i class="fa fa-arrow-down"></i>  &nbsp;</a>
										</td>
										<td class="center">
										<?php
										if(@$categories[$i]->status == 1)
										{
										?>
											<span style="color:green;font-weight: bold;">Enabled</span><br>
											<a style="color:red;font-weight: bold;" href="<?php echo base_url();?>index.php/home/categoryStatusChange/0/<?php echo @$categories[$i]->id?>">Make It Disable</a>
										<?php
										}
										if(@$categories[$i]->status == 0)
										{
										?>
											<span style="color:red;font-weight: bold;">Disabled</span><br>
											<a style="color:green;font-weight: bold;" href="<?php echo base_url();?>index.php/home/categoryStatusChange/1/<?php echo @$categories[$i]->id?>">Make It Enable</a>
										<?php
										}
										?>
										</td>
										<td class="center">
											<a href="<?php echo base_url()?>index.php/home/editcategories/<?php echo @$categories[$i]->id;?>"><i class="fa fa-edit"></i></a> 
											<?php
											if(@$categories[$i]->cat_delete == 1)
											{
											?>
												&nbsp; | &nbsp;
												<a href="<?php echo base_url()?>index.php/home/deletecategories/<?php echo @$categories[$i]->id;?>"><i class="fa fa-trash"></i></a>
											<?php 
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
						</form>
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
});

function fnClickAddRow() {
	$('#editable').dataTable().fnAddData( [
		"Custom row",
		"New row",
		"New row",
		"New row",
		"New row" ] );

}
$(".orderDesc").unbind().on("click",function(){
	var index = $(this).attr('index');
	var nextIndex = parseInt(parseInt(index)+1);
	var rowid = $(this).attr('data-id');
	var current = $("#ind_"+index).val();
	var next = $("#ind_"+nextIndex).val();
	$("#ind_"+index).val(nextIndex);
	$("#ind_"+nextIndex).val(index);
	var Acurrent = $("#ind_"+index).val();
	var Anext = $("#ind_"+nextIndex).val();
	$("form#orderForm").submit();
});
$(".orderAsc").unbind().on("click",function(){
	var index = $(this).attr('index');
	var nextIndex = parseInt(parseInt(index)-1);
	var rowid = $(this).attr('data-id');
	var current = $("#ind_"+index).val();
	var next = $("#ind_"+nextIndex).val();
	$("#ind_"+index).val(nextIndex);
	$("#ind_"+nextIndex).val(index);
	var Acurrent = $("#ind_"+index).val();
	var Anext = $("#ind_"+nextIndex).val();
	$("form#orderForm").submit();
});
</script>