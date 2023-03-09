<?php include("header.php"); ?>

<div class="d-flex justify-content-center align-items-center mt-5 login-register-form">
    <div class="card">
        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
            <li class="nav-item text-center">
                <a class="nav-link btl <?php if($pageType == "login"){echo "active";} ?>" d="home-tab" data-bs-toggle="tab" href="#home" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">Login</a>
            </li>
            <li class="nav-item text-center">
                <a class="nav-link btr <?php if($pageType == "register"){echo "active";} ?>" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false" href="#pills-profile">Register</a>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade <?php if($pageType == "login"){echo "show active";} ?>" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="form px-4 pt-5">
                    <input id="login_email" type="email" name="email" class="form-control" placeholder="Email">
                    <input id="login_password" type="password" name="password" class="form-control" placeholder="Password">
                    <button id="loginButton" class="btn btn-dark btn-block" onclick="login();">Login</button>
                </div>
            </div>
            <div class="tab-pane fade <?php if($pageType == "register"){echo "show active";} ?>" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="form px-4">
                    <input type="text" id="reg_Name" name="Name" class="form-control" placeholder="Name">
                    <input type="email" id="reg_email" name="Email" class="form-control" placeholder="Email">
                    <input type="password" id="reg_password" name="Password" class="form-control" placeholder="Password">
                    <input type="password" id="reg_confirmpassword" name="reg_confirmpassword" class="form-control" placeholder="Re Enter Password">
                    <button id="registerButton" class="btn btn-dark btn-block" onclick="register();">Register</button>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include("scripts.php"); ?>

<script>
    
    function login(){
        
        var login_email = $("#login_email").val();
        var login_password = $("#login_password").val();
        var msg = "";
        var error = 0;
        var emailRegex = "";

        if(login_email == ""){
            
            msg = "Please enter the email address.";
            error = 1;
            
            showError(msg, error);
            return false;

        }else if(login_email != "" && login_email != "null" && login_email != "undefined" && !validateEmail(login_email)){

            msg = "Please enter valid email address.";
            error = 1;
            
            showError(msg, error);
            return false;
            
        }else if(login_password == ""){

            msg = "Please enter the password.";
            error = 1;
            
            showError(msg, error);
            return false;

        }else{
            
            var loaderElmId = "loginButton";
            var preLoaderContent = $("#loginButton").html();
            showLoader(loaderElmId);

            var path = "login";
            var data = {
                "email":login_email,
                "password":login_password     
            };

            setTimeout(function(){

                callAjax(data, path, function(resp){
                    console.log("resp");
                    console.log(resp);
                
                    if(resp.C == 100){
                        //redirect to home page/dashboard
                        window.location.href = '<?php echo site_url("companies"); ?>';

                    }else{

                        msg = "Entered invalid email or password.";
                        error = 1;
                        
                        showError(msg, error);
                    }


                    hideLoader(loaderElmId, preLoaderContent);
                });

            }, 1000);
            
        
        }

    }

    function register(){

        var reg_Name = $("#reg_Name").val();
        var reg_email = $("#reg_email").val();
        var reg_phone = $("#reg_phone").val();
        var reg_password = $("#reg_password").val();
        var reg_confirmpassword = $("#reg_confirmpassword").val();
        var msg = "";
        var error = 0;
        var emailRegex = "";

        if(reg_Name == ""){

            msg = "Please enter the name.";
            error = 1;
            
            showError(msg, error);
            return false;

        }else if(reg_email == ""){
            
            msg = "Please enter the email address.";
            error = 1;
            
            showError(msg, error);
            return false;

        }else if(reg_email != "" && reg_email != "null" && reg_email != "undefined" && !validateEmail(reg_email)){

            msg = "Please enter valid email address.";
            error = 1;
            
            showError(msg, error);
            return false;
            
        }else if(reg_password == ""){

            msg = "Please enter the password.";
            error = 1;
            
            showError(msg, error);
            return false;

        }else if(reg_confirmpassword == ""){
            msg = "Please enter the confirm password.";
            error = 1;
            
            showError(msg, error);
            return false;
        }else if(reg_password != reg_confirmpassword){
            msg = "Confirm password does not match with password.";
            error = 1;
            
            showError(msg, error);
            return false;
        }else{
            
            var loaderElmId = "registerButton";
            var preLoaderContent = $("#registerButton").html();
            showLoader(loaderElmId);

            var path = "register";
            var data = {
                "name":reg_Name,
                "email":reg_email,
                "password":reg_password,     
                "confirmpassword":reg_confirmpassword     

            };

            setTimeout(function(){

                callAjax(data, path, function(resp){
                    console.log("resp");
                    console.log(resp);
                
                    if(resp.C == 100){
                        //redirect to home page/dashboard
                        window.location.href = '<?php echo site_url("companies"); ?>';
                        
                    }else{

                        msg = "Entered invalid email or password.";
                        error = 1;
                        
                        showError(msg, error);
                    }

                    hideLoader(loaderElmId, preLoaderContent);
                });

            }, 1000);
            
        
        }
    }

</script>

<?php include("footer.php"); ?>