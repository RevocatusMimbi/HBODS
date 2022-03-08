
//var x = jQuery.noConflict();
$(function(){
	$('#words').hide();
	$('#hide').click(function(){ 
		$('#words').hide(1000); 
		$('#info').text('The text is hidden');
		$('#info').hide();
		var txt = $('#info').text();
		//alert(txt);
	});
	$('#show').click(function(){ 
		$('#words').show(1000);
		$('#info').hide(); 
		$('#info').text('The text is now shown');
		var txt = $('#info').text();
		//alert(txt);
	});

});