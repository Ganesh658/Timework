			</div>
		</div>

	</div>
		
</div>

    <!-- Mainly scripts -->
    


  
<script type="text/javascript">
$('.deleteItem').click(function(){
	var cnfm = confirm("Are You Sure..! Do You Want To Delete This One");
	if(cnfm == true)
	{
		return true;
	}
	else
	{
		return false;
	}
})
$('#formsubmit').submit(function() {
	var country_id = $('#country_id_chosen').val();
	if(country_id == '')
	{
		alert("Please Select Atleast One Country");
		$('#country_id').trigger('chosen:open');
		return false;
	}
	else
	{
		return true;
	}
});
$('#dashCountryId').change(function() {
	var country_id = $(this).val();
	if(country_id == '')
	{
		window.location.href=baseurl+"index.php/admin/home/dashboard/"+country_id;
	}
});
</script>
	
</body>
</html>