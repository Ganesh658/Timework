				
			</div>
		</div>

	</div>
		
</div>

    <!-- Mainly scripts -->
    



<script src="<?php echo base_url();?>externals/js/chosen.jquery.js" type="text/javascript"></script>
<script type="text/javascript">
	var config = {
  '.chosen-select'           : {},
  '.chosen-select-deselect'  : {allow_single_deselect:true},
  '.chosen-select-no-single' : {disable_search_threshold:10},
  '.chosen-select-no-results': {no_results_text:'Oops, nothing found!'},
  '.chosen-select-width'     : {width:"95%"}
}
for (var selector in config) {
  $(selector).chosen(config[selector]);
}

</script>  
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
	var country_id = $('#country_id').val();
	if(country_id == null)
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
	if(country_id != '')
	{
		window.location.href=baseurl+"home/dashboard/"+country_id;
	}
});
</script>
	
</body>
</html>
 	
    
   