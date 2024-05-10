
$(document).ready(function(){
	$('[data-toggle="tooltip"]').tooltip();
	
	var checkbox = $('table tbody input[type="checkbox"]');
	$("#selectAll").click(function(){
		if(this.checked){
			checkbox.each(function(){
				this.checked = true;                        
			});
		} else{
			checkbox.each(function(){
				this.checked = false;                        
			});
		} 
	});
	checkbox.click(function(){
		if(!this.checked){
			$("#selectAll").prop("checked", false);
		}
	});
});

    $(document).ready(function () {
        $('.delete').click(function () {
            var clubId = $(this).data('club-id');
            var clubNom = $(this).data('club-nom');
            $('#clubIdToDelete').val(clubId);
            $('#clubNameToDelete').text(clubNom);
        });
    });

    