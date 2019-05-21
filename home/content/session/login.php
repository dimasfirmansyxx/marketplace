<div class="htc__login__register bg__white ptb--130" style="background: rgba(0, 0, 0, 0) url(images/bg/5.jpg) no-repeat scroll center center / cover ;">
    <div class="container">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <ul class="login__register__menu" role="tablist">
                    <li role="presentation" class="login active" id="BtnToLogin"><a href="#login"  style="font-size: 15pt" role="tab" data-toggle="tab">Login</a></li>
                    <li role="presentation" class="register" id="BtnToRegist"><a href="#register" style="font-size: 15pt" role="tab" data-toggle="tab">Register</a></li>
                </ul>
            </div>
        </div>
        
        <!-- Start Login Register Content -->
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="htc__login__register__wrap">
                    <!-- Start Single Content -->
                    <div id="login" role="tabpanel" class="single__tabs__panel tab-pane fade in active">
                        <div class="text-center">
                            <h2>LOGIN</h2>
                            <br>
                            <div class="alert alert-success" role="alert" id="AlertLoginSuccess" style="display: none;">
                                Login Success. Please Wait...
                            </div>
                            <div class="alert alert-danger" role="alert" id="AlertLoginFailed" style="display: none">
                                Login Failed. Password didn't match
                            </div>
                        </div>
                        <form class="login" method="post" id="LoginForm">
                            <input type="text" placeholder="Email" id="EmailLoginForm" required>
                            <input type="password" placeholder="Password" id="PasswordLoginForm" required>
                            <div class="htc__login__btn mt--30">
                                <button type="submit" class="btn btn-secondary btn-lg" id="BtnLoginForm">
                                    LOGIN
                                </button>
                            </div>
                        </form>
                    </div>

                    <div id="register" role="tabpanel" class="single__tabs__panel tab-pane fade">
                        <div class="text-center">
                            <h2>REGISTER</h2>
                            <div class="alert alert-success" role="alert" id="AlertRegistSuccess" style="display: none;">
                                Registration Success. Continue to login
                            </div>
                            <div class="alert alert-danger" role="alert" id="AlertRegistFailed" style="display: none">
                                Registration Failed. Password didn't match
                            </div>
                        </div>
                        <form class="login" method="post" id="RegistForm">
                            <input type="text" placeholder="Name" name="Nama" required id="NameRegistForm">
                            <input type="email" placeholder="Email" name="email" required id="EmailRegistForm">
                            <input type="text" name="username" placeholder="Username" required id="UsernameRegistForm">
                            <input type="password" placeholder="Password" name="password" required id="PasswordRegistForm">
                            <div class="htc__login__btn">
                                <button type="submit" class="btn btn-secondary btn-lg" id="BtnRegistForm">
                                    REGISTER
                                </button>
                            </div>
                        </form>
                    </div>
                    <!-- End Single Content -->
                </div>
            </div>
        </div>
        <!-- End Login Register Content -->
    </div>
</div>

<script>
    $(document).ready(function(){

        var baseurl = "<?= $baseurl ?>";

        $("#LoginForm").on("submit",function(e){
            e.preventDefault();
            $("#EmailLoginForm").attr("disabled","disabled");
            $("#PasswordLoginForm").attr("disabled","disabled");
            $("#BtnLoginForm").attr("disabled","disabled");
            $("#BtnLoginForm").html("LOGGING ...");
        });

        $("#RegistForm").on("submit",function(e){
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

            console.log(1);

            $.ajax({
                url : baseurl + "/core/functions.php?cmd=addUser",
                data : { name : name, email : email, username : username, password : password },
                type : "post",
                dataType : "json",
                success : function(result){
                    console.log(2);
                    if ( result == "0" ) {
                        $("#AlertRegistFailed").css("display","none");
                        $("#AlertRegistSuccess").css("display","block");
                        $("#BtnToLogin").click();
                    } else if ( result == "2" ) {
                        alert("Kesalahan pada Server");
                    } else {
                        $("#AlertRegistSuccess").css("display","none");
                        $("#AlertRegistFailed").css("display","block");
                        $("#AlertRegistFailed").html("Registration Failed. " + result)
                    }
                }
            });
        });

    });
</script>