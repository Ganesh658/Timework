<?php
$jsonObj=@json_decode($jsonObj);
$catId=@$jsonObj->catId;
$mainCategories=@$jsonObj->mainCategories;
$categories=@$jsonObj->categories;
$catInfo=@$jsonObj->catInfo;
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
		<div class="col-sm-8">
			<h2>Sub Categories</h2>
			<ol class="breadcrumb">
				<li>
					<a href="<?php echo base_url()?>">Dashboard</a>
				</li>
				<li>
					<a href="<?php echo base_url()?>index.php/home/categories">
						Categories
					</a>
				</li>
				<li>
					<a href="<?php echo base_url()?>index.php/home/categories"><?php echo @$catInfo[0]->cat_name;?></a>
				</li>
				<li class="active">
					<strong>Sub Categories</strong>
				</li>
			</ol>
		</div>
		<div class="col-sm-4 pull-right">
			<h2>
				<a href="<?php echo base_url()?>index.php/home/categories" class="btn btn-w-m btn-default pull-right">Back to Categories</a>
			</h2>
			<h2>
				<a href="<?php echo base_url()?>index.php/home/createsubcategories/<?php echo @$catId;?>" class="btn btn-w-m btn-primary pull-right" style='margin-right: 2em;'>Add Sub Category</a>
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
							<div class="row">
								<div class="col-sm-12">
									<ul class="spekul">
										<?php
										if(@sizeOf($mainCategories) > 0)
										{
											for($p=0;$p<@sizeOf($mainCategories);$p++)
											{
												if(@$mainCategories[$p]->is_sub == 1)
												{
										?>
										<li><a <?php if(@$catId == @$mainCategories[$p]->id){echo 'style="background-color:#fff;color:#000;"';}?> href="<?php echo base_url();?>index.php/home/subcategories/<?php echo @$mainCategories[$p]->id;?>"><?php echo @$mainCategories[$p]->cat_name;?></a></li>
										<?php
												}
											}
										}
										?>
									</ul>
								</div>
							</div>
							<form method="POST" id="orderForm" action="<?php echo base_url('index.php/home/updateSubCatOrderPos');?>">
							<table class="table table-striped table-bordered table-hover" id="editable">
								<thead>
									<tr>
										<th class="center">S.No</th>
										<!-- <th class="center">Id</th> -->
										<th class="center">Sub Category Name</th>
										<!-- <th class="center">Attributes</th> -->
										<?php 
										if(@$catInfo[0]->cat_type == 2)
										{
										?>	
											<th class="center">Value</th>
										<?php 
										}
										?>
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
										<!-- <td class="center">
											<?php //echo @$categories[$i]->id;?>
										</td> -->
										<td class="center">
											<?php echo @$categories[$i]->cat_name;?>
										</td>
										<!-- <td class="center">
											<a href="<?php echo base_url();?>index.php/home/categoryAttributes/<?php echo @$categories[$i]->id?>/<?php echo @$catId;?>">View</a>
										</td>	 -->									
										<?php 
										if(@$catInfo[0]->cat_type == 2)
										{
										?>	
											<td class="center">
												<?php echo @$categories[$i]->aFrom ." - ".@$categories[$i]->aTo;?>
											</td>
										<?php
										}
										?>
										<td class="center">
											<input type="hidden" name="parentId" value="<?php echo @$catId;?>" />
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
											<a style="color:red;font-weight: bold;" href="<?php echo base_url();?>index.php/home/subcategoryStatusChange/0/<?php echo @$categories[$i]->id?>/<?php echo @$catId;?>">Make It Disable</a>
										<?php
										}
										if(@$categories[$i]->status == 0)
										{
										?>
											<span style="color:red;font-weight: bold;">Disabled</span><br>
											<a style="color:green;font-weight: bold;" href="<?php echo base_url();?>index.php/home/subcategoryStatusChange/1/<?php echo @$categories[$i]->id?>/<?php echo @$catId;?>">Make It Enable</a>
										<?php
										}
										?>
										</td>
										<td class="center">
											<a href="<?php echo base_url()?>index.php/home/editsubcategories/<?php echo @$categories[$i]->id;?>/<?php echo @$catId;?>"><i class="fa fa-edit"></i></a> &nbsp; | &nbsp;
											<a href="<?php echo base_url()?>index.php/home/deletesubcategories/<?php echo @$categories[$i]->id;?>/<?php echo @$catId;?>"><i class="fa fa-trash"></i></a>
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