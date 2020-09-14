<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2>Edit Category</h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?php echo base_url();?>">Dashboard</a>
			</li>
			<li>
				<a href="<?php echo base_url();?>index.php/home/categories">Categories</a>
			</li>
			<li class="active">
				<strong>Edit Category</strong>
			</li>
		</ol>
	</div>
	<div class="col-sm-4 pull-right">
		<h2>
			<a href="<?php echo base_url()?>index.php/home/categories" class="btn btn-w-m btn-default pull-right">Back to List</a>
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
							<form method="POST" action="<?php echo base_url()?>index.php/home/updatecategories" class="form-horizontal" enctype="multipart/form-data">
								<div class="form-group">
									<label class="col-sm-4 control-label">Category</label>
									<div class="col-sm-8">
										<input type="text" name="category_name" id="category_name" class="form-control" placeholder="Enter Category Name" value="<?php echo @$info[0]->cat_name;?>" required />
									</div>
								</div>
								<div class="hr-line-dashed"></div>
								<div class="form-group">
									<label class="col-sm-4 control-label">Select Type</label>
									<div class="col-sm-8">
										<select name="cat_type" id="cat_type" class="form-control" required>
											<option value="1" <?php if(@$info[0]->cat_type == 1){echo 'selected="selected"';}?>>Textbox</option>
											<option value="2" <?php if(@$info[0]->cat_type == 2){echo 'selected="selected"';}?>>Price</option>
										</select>
									</div>
								</div>
								<div class="hr-line-dashed"></div>
								<div class="form-group" style="display: none;">
									<label class="col-sm-4 control-label">Is Sub-Categories Available</label>
									<div class="col-sm-8">
										<select name="is_sub" id="is_sub" class="form-control" required>
											<option value="0" <?php if(@$info[0]->is_sub == 0){echo 'selected="selected"';}?>>No</option>
											<option value="1" <?php if(@$info[0]->is_sub == 1){echo 'selected="selected"';}?>>Yes</option>
										</select>
									</div>
								</div>
								
								<div class="form-group">
									<div class="col-sm-4 col-sm-offset-2">
										<!--<button class="btn btn-white" type="reset">Reset</button>-->
										<input type="hidden" name="bannersid" id="bannersid" value="<?php echo @$bannerid;?>">
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
	var fileUpload = $("#cat_main_img")[0];
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
				  if (height < 250 || height > 350 && width < 250 || width > 350){
					alert("Width and Height 300 X 300px");
					$("#cat_main_img").val('');
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
	if(enterVal !='')
	{
		$.ajax({
			type:"POST",
			url:"<?php echo base_url();?>index.php/home/chkCategoryNotIn",
			data:"&enterVal="+enterVal+"&rowId="+rowId,
			async:false,
			success:function(response)
			{
				if(response == 1)
				{
					$('#category_name').val('');
					$('#category_name').css("border","1px solid red");
					$('#category_name').attr("placeholder","Category already exists");
					alert("Category already exists");
					$('#category_name').val('');
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