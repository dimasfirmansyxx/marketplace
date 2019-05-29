<div class="site-section">
	<div class="container">
		<div class="row">
			
			<div class="col-lg-4"></div>
			<div class="col-lg-4 text-center">
				<h1>REGISTRASI</h1>
				<div class="alert alert-success" role="alert" id="AlertRegistSuccess" style="display: none;">
                    Registration Success. Please Wait...
                </div>
                <div class="alert alert-danger" role="alert" id="AlertRegistFailed" style="display: none;">
                    Registration Failed. <span id="FailedReason"></span>
                </div>
				<form class="text-left" id="FormRegis">
					<div class="form-group">
						<label>Nama</label>
						<input type="text" name="nama" class="form-control" required id="NameRegistForm">
					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="email" name="email" class="form-control" required id="EmailRegistForm">
					</div>
					<div class="form-group">
						<label>Username</label>
						<input type="text" name="username" class="form-control" required id="UsernameRegistForm">
					</div>	
					<div class="form-group">
						<label>Password</label>
						<input type="password" name="password" class="form-control" required id="PasswordRegistForm">
					</div>
					<button class="btn btn-primary btn-block" type="submit" id="BtnRegistForm">Registrasi</button>
					<p>Sudah punya akun ? <a href="<?= $baseurl ?>/home/page/session/login">Login</a></p>
				</form>
			</div>

		</div>
	</div>
</div>

<script>
	$(document).ready(function(){

        var baseurl = "<?= $baseurl ?>";

        $("#FormRegis").on("submit",function(e){
            e.preventDefault();
            var name = $("#NameRegistForm");
            var email = $("#EmailRegistForm");
            var username = $("#UsernameRegistForm");
            var password = $("#PasswordRegistForm");
            name.attr("disabled","disabled");
            email.attr("disabled","disabled");
            username.attr("disabled","disabled");
            password.attr("disabled","disabled");
            $("#BtnRegistForm").attr("disabled","disabled");
            $("#BtnRegistForm").html("REGISTERING ...");

            $.ajax({
                url : baseurl + "/core/functions.php?cmd=userRegistration",
                data : { "name" : name.val(), "email" : email.val(), "username" : username.val(), "password" : password.val() },
                type : "post",
                dataType : "json",
                cache : true,
                success : function(result){
                    if ( result == "0" ) {
                        $("#AlertRegistFailed").css("display","none");
                        $("#AlertRegistSuccess").css("display","block");
                        setInterval(function(){
                        	window.location = baseurl + '/home/page/session/login';
                        },2000);
                    } else if ( result == "2" ) {
                        alert("Kesalahan pada Server");
                    } else {
                        $("#AlertRegistSuccess").css("display","none");
                        $("#AlertRegistFailed").css("display","block");
                        $("#AlertRegistFailed").html("Registration Failed. " + result);
                    }
                    name.removeAttr("disabled");
		            email.removeAttr("disabled");
		            username.removeAttr("disabled");
		            password.removeAttr("disabled");
		            $("#BtnRegistForm").removeAttr("disabled","disabled");
		            $("#BtnRegistForm").html("REGISTRASI");
                }
            });
        });

    });
</script>