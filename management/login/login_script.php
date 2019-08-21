<script>
	$(document).ready(function(){

		var baseurl = "<?= $baseurl ?>";

		$("#FormLogin").on("click",function(e){
			e.preventDefault();
            var username = $("#TxtUsername");
            var password = $("#TxtPassword");
            var button = $("#BtnLogin")
            username.attr("disabled","disabled");
            password.attr("disabled","disabled");
            button.attr("disabled","disabled");
            button.html("LOGGING ...");

            $.ajax({
                url : baseurl + "/core/functions.php?cmd=adminLogin",
                data : { "username" : username.val(), "password" : password.val() },
                type : "post",
                dataType : "json",
                cache : true,
                success : function(result){
                    if ( result == "0" ) {
                        $("#AlertLoginFailed").css("display","none");
                        $("#AlertLoginSuccess").css("display","block");
                        setInterval(function(){
                        	window.location = baseurl + '/home/';
                        },2000);
                    } else {
                        $("#AlertLoginSuccess").css("display","none");
                        $("#AlertLoginFailed").css("display","block");
                        $("#LblReason").html(result);
                    }
		            username.removeAttr("disabled");
		            password.removeAttr("disabled");
		            button.removeAttr("disabled","disabled");
		            button.html("Login");
                }
            });
		});

	});
</script>