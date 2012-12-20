$(document).ready(function(){
	$('li').click(function(){
		$('li').removeClass("active");
		$(this).addClass("active");
	});
});

$('.carousel').carousel({
  interval: 2000
})
$('.carousel').carousel('cycle')



