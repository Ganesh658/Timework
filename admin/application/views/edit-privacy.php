<link href="<?php echo base_url()?>externals/css/plugins/summernote/summernote.css" rel="stylesheet">
<link href="<?php echo base_url()?>externals/css/plugins/summernote/summernote-bs3.css" rel="stylesheet">
<div class="row wrapper border-bottom white-bg page-heading">
	<div class="col-sm-8">
		<h2>Edit Content</h2>
		<ol class="breadcrumb">
			<li>
				<a href="<?php echo base_url();?>">Dashboard</a>
			</li>
			<li>
				<a href="<?php echo base_url();?>index.php/home/privacy">Privacy Policies</a>
			</li>
			<li class="active">
				<strong>Edit Content</strong>
			</li>
		</ol>
	</div>
	<div class="col-sm-4 pull-right">
		<h2>
			<a href="<?php echo base_url()?>index.php/home/privacy" class="btn btn-w-m btn-default pull-right">Back to List</a>
		</h2>
	</div>
</div>
<div class="row">
	<div class="col-lg-12">
		<div class="wrapper wrapper-content">
			<div class="row">
				<div class="col-lg-12">
					<div class="ibox">
						
						<div class="ibox-content">
							
							<form method="POST" action="<?php echo base_url()?>index.php/home/updateprivacy" class="form-horizontal" enctype="multipart/form-data">
							
								<div class="form-group">
									<label class="col-sm-2 control-label">Title</label>
									<div class="col-sm-8">
										<input type="text" name="cms_title" id="cms_title" class="form-control" required value="<?php echo @$info[0]->cms_title;?>"/>
									</div>
								</div>
								<div class="hr-line-dashed"></div>
								
								<div class="form-group">
									<label class="col-sm-2 control-label">Short Description</label>
									<div class="col-sm-8">
										<textarea name="long_desc" id="long_desc" class="form-control txtcls" required><?php echo @$info[0]->long_desc;?></textarea>
									</div>
								</div>
								<div class="hr-line-dashed"></div>
							
								<!--<div class="form-group">
									<label class="col-sm-4 control-label">Upload Banner Image</label>
									<div class="col-sm-8">
										<input type="file" accept="image/*" name="mainImage" id="mainImage" class="form-control" onchange="bannerImage()">
										<span id="cond" style="color: red;font-size:13px;">*Width and Height should same(Recommended: 75 X 75 px).</span>
									</div>
								</div>
								<div class="form-group">
									<label class="col-sm-4 control-label"></label>
									<div class="col-sm-8">
										<img src="<?php //echo base_url();?>uploads/features/<?php //echo @$info[0]->cms_img;?>">
									</div>
								</div>
								<div class="hr-line-dashed"></div>-->								
								
								<div class="form-group">
									<div class="col-sm-4 col-sm-offset-2">
										<!--<button class="btn btn-white" type="reset">Reset</button>-->
										<input type="hidden" name="bannersid" id="bannersid" value="<?php echo @$bannerid;?>">
										<input type="hidden" name="hiddenmainImage" id="hiddenmainImage" value="<?php echo @$info[0]->banner_img;?>">
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
				  if (height != width){
					alert("width and height should be same");
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
