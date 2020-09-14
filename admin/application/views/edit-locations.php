<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2>Edit Locations</h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?php echo base_url()?>">Dashboard</a>
			</li>
			<li>
				<a href="<?php echo base_url()?>index.php/home/states">
					States
				</a>
			</li>
			<li>
				<a href="<?php echo base_url()?>index.php/home/cities/<?php echo @$stateId;?>">
					Cities
				</a>
			</li>
			<li>
				<a href="<?php echo base_url()?>index.php/home/locations/<?php echo @$cityId;?>/<?php echo @$stateId;?>">
					Locations
				</a>
			</li>
			<li class="active">
				<strong>Edit Locations - <span style="color: #1ab394;font-size: 15px;"><?php echo @$catInfo[0]->state_name;?> - <?php echo @$cityInfo[0]->city_name;?></span></strong>
			</li>
		</ol>
	</div>
	<div class="col-sm-4 pull-right">
		<h2>
			<a href="<?php echo base_url()?>index.php/home/locations/<?php echo @$cityId;?>/<?php echo @$stateId;?>" class="btn btn-w-m btn-default pull-right">Back to List</a>
		</h2>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="wrapper wrapper-content">
			<div class="row">
				<div class="col-lg-7">
					<div class="ibox">						
						<div class="ibox-content">
							<form method="POST" action="<?php echo base_url()?>index.php/home/updatelocations" class="form-horizontal" enctype="multipart/form-data" autocomplete='off'>
							
								<div class="form-group">
									<label class="col-sm-4 control-label">Location Name</label>
									<div class="col-sm-8">
										<input type="text" name="location_name" id="location_name" class="form-control" placeholder="Enter Location Name" required value="<?php echo @$info[0]->location_name;?>" autocomplete='off'/>
									</div>
								</div>
								<div class="hr-line-dashed"></div>	
								

								<div class="form-group">
									<div class="col-sm-4 col-sm-offset-2">
										<!--<button class="btn btn-white" type="reset">Reset</button>-->
										<input type="hidden" name="bannersid" id="bannersid" value="<?php echo @$bannerid;?>">
										<input type="hidden" name="stateId" id="stateId" value="<?php echo @$stateId?>"/>
										<input type="hidden" name="cityId" id="cityId" value="<?php echo @$cityId;?>"/>
										<button class="btn btn-primary" type="submit">Save</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
$("#location_name").blur(function(){
	var enterVal=$(this).val();
	var rowId=$("#bannersid").val();
	var catId=$("#catId").val();
	if(enterVal !='')
	{
		$.ajax({
			type:"POST",
			url:"<?php echo base_url();?>index.php/home/chklocationsNotIn",
			data:"&enterVal="+enterVal+"&rowId="+rowId+"&catId="+catId,
			async:false,
			success:function(response)
			{
				if(response == 1)
				{
					$('#location_name').val('');
					$('#location_name').css("border","1px solid red");
					$('#location_name').attr("placeholder","Location Name already exists");
					alert("Location Name already exists");
					$('#location_name').val('<?php echo @$info[0]->cat_name;?>');
				}
				else
				{
					$('#location_name').css("border","1px solid #ccc");
				}
			}			
		});
	}
	else
	{
		$('#location_name').css("border","1px solid #ccc");
		$('#location_name').attr("placeholder","Enter Category Name");
	}
});
</script>