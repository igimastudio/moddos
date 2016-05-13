$(document).ready(function(){
    $('#avatar-save').click(function(e){
		$('form[name=form1]').submit();
		e.preventDefault();

	});
});