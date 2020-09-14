
<?php
$userdetails=$this->session->userdata("userdetails");
?>

<div class="page-content-wrapper">
                <!-- BEGIN CONTENT BODY -->
<div class="page-content">
                    
                   
	<div class="row" style="position:relative;">					
		<div class="col-md-12">
		<?php
		if(@$this->session->userdata("fail") != '')
		{
			echo $this->session->userdata("fail");
			$this->session->unset_userdata("fail");
		}
		if(@$this->session->userdata("sucess") != '')
		{
			echo $this->session->userdata("sucess");
			$this->session->unset_userdata("sucess");
		}
		?>
			<form method="POST" action="<?php echo base_url()?>index.php/home/update" onSubmit="return checkValid()">
				<div class="form-group">
					<div class="col-md-5">
						<input type="password" class="form-control" name="npassword" id="npassword" placeholder="New Password" required /><br />
						<input type="password" class="form-control" name="cnpassword" id="cnpassword" placeholder="Confirm New Password" required /><br />
						<button type="submit" class="btn btn-success">Update</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<!-- END CONTENT BODY -->
<script>
function checkValid()
{
	var npassword=$("#npassword").val();
	var cnpassword=$("#cnpassword").val();
	if(npassword == cnpassword)
	{
		return true;
	}
	else
	{
		$("#npassword").css({"border":"1px solid #ff0000"});
		$("#cnpassword").attr("placeholder","Passwords not matched");
		$("#cnpassword").css({"border":"1px solid #ff0000"});
		$("#cnpassword").val('');
		return false;
	}
}
</script>		