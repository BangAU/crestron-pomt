<?php 
    include "header-login.php";   

?>
<body>

    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php print $LPname;?> Admin - Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form" action="login_validate.php" method="post" id="loginform">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus data-rule-required="true" data-msg-required="Please enter your E-mail" data-msg-email="Please enter a valid email address">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="" data-rule-required="true" data-msg-required="Please enter your Password">
                                </div>
                                
                                <?php
                                if(isset($_REQUEST['invalid'])){
                                    if($_REQUEST['invalid']==1) {
                                ?> 

                                <div class="form-group has-error">
                                <label class="control-label" for="inputError">Username OR Password is invalid</label>
                                </div>

                                <?php
                                    }
                                }   
                                ?> 
                                  
                                <!-- Change this to a button or input when using this as a form -->
                                <button class="btn btn-lg btn-success btn-block">Login</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php 
	include "js-include.php";
?>
</body>
</html>
