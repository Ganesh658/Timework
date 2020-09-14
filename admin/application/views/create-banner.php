<style type="text/css">
	input[type="button" i]:disabled, input[type="submit" i]:disabled, input[type="reset" i]:disabled, input[type="file" i]:disabled::-webkit-file-upload-button, button:disabled, select:disabled, optgroup:disabled, option:disabled, select[disabled] > option {
    color: #ccc;
}
</style>
	<div class="row wrapper border-bottom white-bg page-heading">
		<div class="col-sm-8">
			<h2>Add Banner</h2>
			<ol class="breadcrumb">
				<li>
					<a href="<?php echo base_url();?>">Dashboard</a>
				</li>
				<li>
					<a href="<?php echo base_url();?>index.php/home/banners">Banners</a>
				</li>
				<li class="active">
					<strong>Add Banner</strong>
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
								
								<form method="POST" action="<?php echo base_url()?>index.php/home/savebanners" class="form-horizontal" enctype="multipart/form-data">
									<?php
								$banArray=array();
								if(@sizeOf($banners) > 0)
								{
									for($b=0;$b<@sizeOf($banners);$b++)
									{
										$banArray[$b]=$banners[$b]->page_type;
									}
								}
								//print_r($banArray);
								?>
								<div class="form-group">
									<label class="col-sm-4 control-label">Page</label>
									<div class="col-sm-8">
										<select name="page_type" id="page_type" class="form-control" required>
											<option value="">Select Page</option>
											<option  value="1">Home Page</option>
											<option <?php if(@in_array(2,$banArray)){echo "disabled=disabled";}?> value="2">About Us</option>
											<option <?php if(@in_array(3,$banArray)){echo "disabled";}?> value="3">Contact</option>
											<option <?php if(@in_array(4,$banArray)){echo "disabled";}?> value="4">Faqs For Candidates</option>
											<option <?php if(@in_array(5,$banArray)){echo "disabled";}?> value="5">Faqs  For Recruiters</option>										
											<option <?php if(@in_array(6,$banArray)){echo "disabled";}?> value="6">Registration</option>
											<option <?php if(@in_array(7,$banArray)){echo "disabled";}?> value="7">Login</option>
										</select>
									</div>
								</div>
								<div class="hr-line-dashed"></div>
									<div class="form-group">
										<label class="col-sm-2 control-label">Main Title</label>
										<div class="col-sm-3">
											<input type="text" name="main_title" id="main_title" class="form-control" value=""/>
										</div>
										<label class="col-sm-1 control-label">Color</label>
										<div class="col-sm-2">
											<input type="text" name="mColorcode" id="mColorcode" class="form-control jscolor" value=""/>
										</div>
										<div class="col-sm-2">
											<select name="mAlign" id="mAlign" class="form-control">
												<option value="" >Select Align</option>
												<option value="center" >Center</option>
												<option value="right" >Right</option>
												<option value="left">Left</option>
											</select>
										</div>
										<div class="col-sm-2">
											<select name="mFontsize" id="mFontsize" class="form-control">
												<option value="">Font Size</option>
												<option value="12" >12</option>
												<option value="13" >13</option>
												<option value="14" >14</option>
												<option value="15" >15</option>
												<option value="16" >16</option>
												<option value="17" >17</option>
												<option value="18" >18</option>
												<option value="19" >19</option>
												<option value="20" >20</option>
												<option value="21" >21</option>
												<option value="22" >22</option>
												<option value="23" >23</option>
												<option value="24" >24</option>
												<option value="25" >25</option>
												<option value="26" >26</option>
												<option value="27" >27</option>
												<option value="28" >28</option>
												<option value="29" >29</option>
												<option value="30" >30</option>
												<option value="31" >31</option>
												<option value="32" >32</option>
												<option value="33" >33</option>
												<option value="34">34</option>
										</select>
										</div>
									</div>
									<div class="hr-line-dashed"></div>
									<div class="form-group">
										<label class="col-sm-2 control-label">Sub Title</label>
										<div class="col-sm-3">
											<input type="text" name="sub_title" id="sub_title" class="form-control" value=""/>
										</div>
										<label class="col-sm-1 control-label">Color</label>
										<div class="col-sm-2">
											<input type="text" name="sColorcode" id="sColorcode" class="form-control jscolor" value=""/>
										</div>
										<div class="col-sm-2">
											<select name="sAlign" id="sAlign" class="form-control">
												<option value="" >Select Align</option>
												<option value="center" >Center</option>
												<option value="right" >Right</option>
												<option value="left">Left</option>
											</select>
										</div>
										<div class="col-sm-2">
											<select name="sFontsize" id="sFontsize" class="form-control">
												<option value="">Font Size</option>
												<option value="12" >12</option>
												<option value="13" >13</option>
												<option value="14" >14</option>
												<option value="15" >15</option>
												<option value="16" >16</option>
												<option value="17" >17</option>
												<option value="18" >18</option>
												<option value="19" >19</option>
												<option value="20" >20</option>
												<option value="21" >21</option>
												<option value="22" >22</option>
												<option value="23" >23</option>
												<option value="24" >24</option>
												<option value="25" >25</option>
												<option value="26" >26</option>
												<option value="27" >27</option>
												<option value="28" >28</option>
												<option value="29" >29</option>
												<option value="30" >30</option>
												<option value="31" >31</option>
												<option value="32" >32</option>
												<option value="33" >33</option>
												<option value="34">34</option>
										</select>
										</div>
									</div>
									<div class="hr-line-dashed"></div>								
									<div class="form-group">
										<label class="col-sm-2 control-label">Upload Banner Image</label>
										<div class="col-sm-6">
											<input type="file" accept="image/*" name="mainImage" id="mainImage" class="form-control" required onchange="bannerImage()">
											<span id="cond" style="color: red;font-size:13px;">*For Home Page Width and Height should be 1920 X 692px.</span><br><br>
										</div>
									</div>
									<div class="hr-line-dashed"></div>
									
									<div class="form-group">
										<div class="col-sm-4 col-sm-offset-2">
											
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
