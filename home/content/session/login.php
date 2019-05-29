<div class="site-section">
	<div class="container">
		<div class="row">
			
			<div class="col-lg-4"></div>
			<div class="col-lg-4 text-center">
				<h1>LOGIN</h1>
				<div class="alert alert-success" role="alert" id="AlertLoginSuccess" style="display: none;">
                    Login Success. Please Wait...
                </div>
                <div class="alert alert-danger" role="alert" id="AlertLoginFailed" style="display: none;">
                    Login Failed. <span id="FailedReason"></span>
                </div>
				<form class="text-left" id="FormLogin">
					<div class="form-group">
						<label>Username</label>
						<input type="text" name="username" class="form-control" required id="UsernameLoginForm">
					</div>
					<div class="form-group">
						<label>Password</label>
						<input type="password" name="password" class="form-control" required id="PasswordLoginForm">
					</div>
					<button class="btn btn-primary btn-block" type="submit" id="BtnLoginForm">Login</button>
					<p>Belum punya akun ? <a href="<?= $baseurl ?>/home/page/session/register">Registrasi</a></p>
				</form>
			</div>

		</div>
	</div>
</div>

<script>
	$(document).ready(function(){

        var baseurl = "<?= $baseurl ?>";

        $("#FormLogin").on("submit",function(e){
            e.preventDefault();
            var username = $("#UsernameLoginForm");
            var password = $("#PasswordLoginForm");
            username.attr("disabled","disabled");
            password.attr("disabled","disabled");
            $("#BtnLoginForm").attr("disabled","disabled");
            $("#BtnLoginForm").html("LOGGING ...");

            $.ajax({
                url : baseurl + "/core/functions.php?cmd=userLogin",
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
                        $("#FailedReason").html(result);
                    }
		            username.removeAttr("disabled");
		            password.removeAttr("disabled");
		            $("#BtnLoginForm").removeAttr("disabled","disabled");
		            $("#BtnLoginForm").html("Login");
                }
            });
        });

    });
</script>