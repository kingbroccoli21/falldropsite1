
$(document).ready(function(){
$(".col").hover(function(){
	$(this).css("background-color", "white");
}, function(){
	$(this).css("background-color", "#BD1D3");
});
});
$(document).ready(function(){
    $('a#$logoutAction').click(function(){
        if(confirm('Are you sure to logout?')) {
            return true;
        }

        return false;
    });
});