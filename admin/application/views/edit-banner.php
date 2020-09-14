	<div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-sm-8">
			<h2>Edit Home Banner</h2>
			<ol class="breadcrumb">
				<li>
					<a href="<?php echo base_url();?>">Dashboard</a>
				</li>
				<li>
					<a href="<?php echo base_url();?>index.php/home/banners">Home Banners</a>
				</li>
				<li class="active">
					<strong>Edit Home Banner</strong>
				</li>
			</ol>
		</div>
		<div class="col-sm-4 pull-right">
			<h2>
				<a href="<?php echo base_url()?>index.php/home/banners" class="btn btn-w-m btn-default pull-right">Back to List</a>
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
								
								<form method="POST" action="<?php echo base_url()?>index.php/home/updatebanners" class="form-horizontal" enctype="multipart/form-data">
									<div class="form-group">
										<label class="col-sm-2 control-label">Main Title</label>
										<div class="col-sm-3">
											<input type="text" name="main_title" id="main_title" class="form-control" value="<?php echo @$info[0]->main_title;?>"/>
										</div>
										<label class="col-sm-1 control-label">Color</label>
										<div class="col-sm-2">
											<input type="text" name="mColorcode" id="mColorcode" class="form-control jscolor" value="<?php echo @$info[0]->mColorcode;?>"/>
										</div>
										<div class="col-sm-2">
											<select name="mAlign" id="mAlign" class="form-control">
												<option value="" >Select Align</option>
												<option value="center" <?php if(@$info[0]->mAlign == 'center'){echo "selected";} ?>>Center</option>
												<option value="right" <?php if(@$info[0]->mAlign == 'right'){echo "selected";} ?>>Right</option>
												<option value="left" <?php if(@$info[0]->mAlign == 'left'){echo "selected";} ?>>Left</option>
											</select>
										</div>
										<div class="col-sm-2">
											<select name="mFontsize" id="mFontsize" class="form-control">
												<option value="">Font Size</option>
												<?php 
												for ($m=12; $m < 35; $m++) 
												{ 	
													$mFont = '';
													if(@$info[0]->mFontsize == @$m)
													{
														$mFont = "selected";
													}			
												?>
													<option value="<?php echo @$m; ?>" <?php echo @$mFont; ?>><?php echo @$m; ?></option>
												<?php 
												}
												?>
										</select>
										</div>
									</div>
									<div class="hr-line-dashed"></div>
									<div class="form-group">
										<label class="col-sm-2 control-label">Sub Title</label>
										<div class="col-sm-3">
											<input type="text" name="sub_title" id="sub_title" class="form-control" value="<?php echo @$info[0]->sub_title;?>"/>
										</div>
										<label class="col-sm-1 control-label">Color</label>
										<div class="col-sm-2">
											<input type="text" name="sColorcode" id="sColorcode" class="form-control jscolor" value="<?php echo @$info[0]->sColorcode;?>"/>
										</div>
										<div class="col-sm-2">
											<select name="sAlign" id="sAlign" class="form-control">
												<option value="" >Select Align</option>
												<option value="center"  <?php if(@$info[0]->sAlign == 'center'){echo "selected";} ?>>Center</option>
												<option value="right"  <?php if(@$info[0]->sAlign == 'right'){echo "selected";} ?>>Right</option>
												<option value="left" <?php if(@$info[0]->sAlign == 'left'){echo "selected";} ?>>Left</option>
											</select>
										</div>
										<div class="col-sm-2">
											<select name="sFontsize" id="sFontsize" class="form-control">
												<option value="">Font Size</option>
												<?php 
												for ($s=12; $s < 35; $s++) 
												{ 	
													$sFont = '';
													if(@$info[0]->sFontsize == @$s)
													{
														$sFont = "selected";
													}			
												?>
													<option value="<?php echo @$s; ?>" <?php echo @$sFont; ?>><?php echo @$s; ?></option>
												<?php 
												}
												?>
										</select>
										</div>
									</div>
									<div class="hr-line-dashed"></div>
									<div class="form-group">
										<label class="col-sm-2 control-label">Upload Banner Image</label>
										<div class="col-sm-8">
											<input type="file" accept="image/*" name="mainImage" id="mainImage" class="form-control" onchange="bannerImage()">
											<span id="cond" style="color: red;font-size:13px;">*For Home Page Width should be 1920 X 692px.</span><br><br>
											
										</div>
									</div>
									
									<div class="form-group">
										<label class="col-sm-2 control-label"></label>
										<div class="col-sm-8">
											<img style="width:300px;" src="<?php echo base_url();?>uploads/banners/<?php echo @$info[0]->banner_img;?>">
										</div>
									</div>
									<div class="hr-line-dashed"></div>									
									
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
<script src="<?php echo base_url()?>externals/js/jscolor.js"></script>			
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
				   if (width < 1910 || width >  1930){
					alert("width should be 1920Px");
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
