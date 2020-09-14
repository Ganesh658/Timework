<link href="<?php echo base_url()?>externals/css/plugins/summernote/summernote.css" rel="stylesheet">
<link href="<?php echo base_url()?>externals/css/plugins/summernote/summernote-bs3.css" rel="stylesheet">
<?php 
if(@$page_type == 1)
{
	$pageName = "About";
}
if(@$page_type == 2)
{
	$pageName = "CIN";
}
if(@$page_type == 3)
{
	$pageName = "Privacy Policy";
}
if(@$page_type == 4)
{
	$pageName = "Terms and Conditions";
}
if(@$page_type == 6)
{
	$pageName = "FAQ's For Students";
}
if(@$page_type == 7)
{
	$pageName = "FAQ's For Recruiters";
}
if(@$page_type == 8)
{
	$pageName = "Pricing Content";
}
?>
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2>Add <?php echo @$pageName; ?> Content</h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?php echo base_url();?>">Dashboard</a>
			</li>
			<li>
				<a href="<?php echo base_url();?>index.php/home/benchcms/<?php echo @$page_type; ?>"><?php echo @$pageName; ?></a>
			</li>
			<li class="active">
				<strong>Add <?php echo @$pageName; ?> Content</strong>
			</li>
		</ol>
	</div>
	<div class="col-sm-4 pull-right">
		<h2>
			<a href="<?php echo base_url();?>index.php/home/benchcms/<?php echo @$page_type; ?>" class="btn btn-w-m btn-default pull-right">Back to List</a>
		</h2>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="wrapper wrapper-content">
			<div class="row">
				<div class="col-lg-10">
					<div class="ibox">							
						<div class="ibox-content">
							<form method="POST" action="<?php echo base_url()?>index.php/home/updatebenchcms" class="form-horizontal" enctype="multipart/form-data">
								<?php 
								if(@$page_type == '1' || @$page_type == '2' || @$page_type == '3' || @$page_type == '4'  || @$page_type == '6' || @$page_type == '7'  || @$page_type == '8')
								{
									$page_name = "Title";
									$requireds = "";
								}
								else
								{
									$page_name = "Page Name";
									$requireds = "required";
								}
								?>
								<div class="form-group">
									<label class="col-sm-2 control-label"><?php echo @$page_name; ?></label>
									<div class="col-sm-8">
										<input type="text" name="cms_title" id="cms_title" class="form-control" <?php echo @$requireds; ?> value="<?php echo @$info[0]->cms_title;?>">
									</div>
								</div>
								<div class="hr-line-dashed"></div>
								
								<?php 
								if(@$page_type == '1' || @$page_type == '2' || @$page_type == '3' || @$page_type == '4'  || @$page_type == '6' || @$page_type == '7' || @$page_type == '8')
								{
									if(@$page_type != '3' && @$page_type != '4' && @$page_type != '6' && @$page_type != '7' && @$page_type != '8')
									{
								?>	
										<div class="form-group">
											<label class="col-sm-2 control-label">Upload Image</label>
											<div class="col-sm-8">
												<input type="file" accept="image/*" name="mainImage" id="mainImage" class="form-control" >
											</div>
										</div>
										<?php 
										if(@$info[0]->cms_img != '')
										{
										?>
											<div class="form-group">
												<label class="col-sm-2 control-label"></label>
												<div class="col-sm-8">
													<img style="width:100px;" src="<?php echo base_url();?>uploads/cms/<?php echo @$info[0]->cms_img;?>">
												</div>
											</div>
										<?php 
										}
									?>
										<div class="hr-line-dashed"></div>
									<?php
									}
									?>
									
								
									<div class="form-group">
										<label class="col-sm-2 control-label">Description</label>
										<div class="col-sm-8">
											<textarea name="long_desc" id="long_desc" class="form-control txtcls"  rows="6"><?php echo @$info[0]->long_desc;?></textarea>
										</div>
									</div>
									<div class="hr-line-dashed"></div>
								<?php 
								}
								?>
								<div class="form-group">
									<div class="col-sm-4 col-sm-offset-2">
										<input type="hidden" name="bannersid" id="bannersid" value="<?php echo @$bannerid;?>">
										<input type="hidden" name="page_type" id="page_type" value="<?php echo @$page_type;?>">
										<input type="hidden" name="hiddenmainImage" id="hiddenmainImage" value="<?php echo @$info[0]->cms_img;?>">
										<button class="btn btn-white" type="reset">Reset</button>
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
<script src="<?php echo base_url()?>externals/js/plugins/summernote/summernote.min.js"></script>
  
<script>
$(document).ready(function(){

	$('.txtcls').summernote();

});
var edit = function() {
	$('.click2edit').summernote({focus: true});
};
var save = function() {
	var aHTML = $('.click2edit').code(); //save HTML If you need(aHTML: array).
	$('.click2edit').destroy();
}; 
</script>
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
				if (height < 150 || height > 250 && width < 150 || width >  250)
				{
					alert("*Width and Height should be 200 X 200 px");
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

</script>
