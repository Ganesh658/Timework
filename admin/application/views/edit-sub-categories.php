<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2>Edit Sub Category</h2>
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
				<a href="<?php echo base_url()?>index.php/home/categories/<?php echo @$catId;?>"><?php echo @$catInfo[0]->cat_name;?></a>
			</li>
			<li>
				<a href="<?php echo base_url()?>index.php/home/subcategories/<?php echo @$catId;?>/<?php echo @$catId;?>">Sub Categories</a>
			</li>
			<li class="active">
				<strong>Edit Sub Category</strong>
			</li>
		</ol>
	</div>
	<div class="col-sm-4 pull-right">
		<h2>
			<a href="<?php echo base_url()?>index.php/home/subcategories/<?php echo @$catId;?>" class="btn btn-w-m btn-default pull-right">Back to List</a>
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
							<form method="POST" action="<?php echo base_url()?>index.php/home/updatesubcategories" class="form-horizontal" enctype="multipart/form-data">
							
								<?php 
								if(@$catInfo[0]->cat_type == 2)
								{
								?>						
									<div class="form-group">
										<label class="col-sm-4 control-label">Sub Category Name</label>
										<div class="col-sm-8">
											<input type="text" name="category_name" id="category_name" class="form-control" placeholder="Enter Category Name" required value="<?php echo @$info[0]->cat_name;?>"/>
										</div>
									</div>
									<div class="hr-line-dashed"></div>
									<div class="form-group">
										<label class="col-sm-4 control-label">From</label>
										<div class="col-sm-8">
											<input type="text" name="aFrom" id="aFrom" class="form-control" placeholder="Ex:0" required value="<?php echo @$info[0]->aFrom;?>"/>
										</div>
									</div>
									<div class="hr-line-dashed"></div>
									<div class="form-group">
										<label class="col-sm-4 control-label">To</label>
										<div class="col-sm-8">
											<input type="text" name="aTo" id="aTo" class="form-control" placeholder="Ex:100000" required value="<?php echo @$info[0]->aTo;?>"/>
										</div>
									</div>
									<div class="hr-line-dashed"></div>
								<?php 
								}
								else
								{
								?>
									<div class="form-group">
										<label class="col-sm-4 control-label">Sub Category</label>
										<div class="col-sm-8">
											<input type="text" name="category_name" id="category_name" class="form-control" placeholder="Enter Category Name" required value="<?php echo @$info[0]->cat_name;?>" />
										</div>
									</div>
									<div class="hr-line-dashed"></div>
								<?php
								}
								?>

								<!--<div class="form-group">
									<label class="col-sm-4 control-label">Category Image</label>
									<div class="col-sm-8">
										<input type="file" name="mainImage" id="mainImage" class="form-control" onChange="bannerImage()"/>
									<span id="cond" style="color: red;font-size:13px;">*For Home Page Width should be 85 X 85px.</span>
									</div>
								</div>
								<div class="hr-line-dashed"></div>
							
								<div class="form-group">
									<label class="col-sm-4 control-label"></label>
									<div class="col-sm-8">
										<img src="<?php //echo base_url();?>uploads/categories/<?php //echo @$info[0]->category_icon;?>">
									</div>
								</div>
								<div class="hr-line-dashed"></div>-->							
								
								<div class="form-group">
									<div class="col-sm-4 col-sm-offset-2">
										<!--<button class="btn btn-white" type="reset">Reset</button>-->
										<input type="hidden" name="bannersid" id="bannersid" value="<?php echo @$bannerid;?>">
										<input type="hidden" name="catId" id="catId" value="<?php echo @$catId?>"/>
										<input type="hidden" name="parentId" id="parentId" value="<?php echo @$catId;?>"/>
										<input type="hidden" name="hiddenmainImage" id="hiddenmainImage" value="<?php echo @$info[0]->category_icon;?>">
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
function bannerImage(){
//alert('fdxsghbdf');
	//Get reference of FileUpload.
	var fileUpload = $("#mainImage")[0];
	//Check whether HTML5 is supported.
	if (typeof (fileUpload.files) != "undefined") {
		//Initiate the FileReader object.
		var reader = new FileReader();
		//Read the contents of Image File.
		reader.readAsDataURL(fileUpload.files[0]);
		reader.onload = function (e) {
			//Initiate the JavaScript Image object.
			var image = new Image();
			//Set the Base64 string return from FileReader as source.
			image.src = e.target.result;
			image.onload = function () {
				//Determine the Height and Width.
				var height = this.height;
				var width = this.width;
				  if (height < 75 || height > 95 && width < 75 || width >  95){
					alert("Width and Height 85 X 85px");
					$("#mainImage").val('');
					return false;
				}
				//alert("Uploaded image has valid Height and Width.");
				return true;
			};
		}
	} else {
		alert("This browser does not support HTML5.");
		return false;
	}
}
$("#category_name").blur(function(){
	var enterVal=$(this).val();
	var rowId=$("#bannersid").val();
	var catId=$("#catId").val();
	if(enterVal !='')
	{
		$.ajax({
			type:"POST",
			url:"<?php echo base_url();?>index.php/home/chkCategoryNotIn",
			data:"&enterVal="+enterVal+"&rowId="+rowId+"&catId="+catId,
			async:false,
			success:function(response)
			{
				if(response == 1)
				{
					$('#category_name').val('');
					$('#category_name').css("border","1px solid red");
					$('#category_name').attr("placeholder","Category already exists");
					alert("Category already exists");
					$('#category_name').val('<?php echo @$info[0]->cat_name;?>');
				}
				else
				{
					$('#category_name').css("border","1px solid #ccc");
				}
			}			
		});
	}
	else
	{
		$('#category_name').css("border","1px solid #ccc");
		$('#category_name').attr("placeholder","Enter Category Name");
	}
});
</script>