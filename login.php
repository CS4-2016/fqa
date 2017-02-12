<!DOCTYPE html>
<?php session_start(); ?>
<?php
  require_once("dbconn.php");
  if(isset($_SESSION['position']))
    $position=$_SESSION['position'];
if(isset($_SESSION['login'])){
 if($position=='Dean'||$position=='Chair'){
    $_SESSION['login']=$email;
    header("Location:academichead-index.php");
  }
  else if($position=='QA'){
    $_SESSION['login']=$email;
    header("Location:qa-index.php"); 
  }
  else if($position=='VPA'){
    $_SESSION['login']=$email;
    header("Location:vpa-index.php"); 
   }
    else if($position=='HRD'){
    $_SESSION['login']=$email;
    header("Location:hrd-index.php"); 
  }
} 
?>

<html>
    <head>
    <meta charset="UTF-8">
    <title>Sign-Up/Login Form</title>
    <link href='http://fonts.googleapis.com/css?family=Titillium+Web:400,300,600' rel='stylesheet' type='text/css'>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/normalize.css">
    <link rel="stylesheet" href="css/styles.css">
    <link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.min.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script>
    $(function() {
        $('p').hide(); 
        $('#type').change(function(){
            if($('#type').val() == 'Dean') {
                $('p').show(); 
            } else if($('#type').val() == 'Chair') {
                $('p').show(); 
            } 
            else{
              $('p').hide(); 
            }
        });
    });
</script>


    </head>
    <body>

        <div class="form">
        <?php 
                           if(!empty($_SESSION['errMsg'])) { ?>
                            <div class="alert alert-danger fade in">
                            <?php echo $_SESSION['errMsg'];?>
                            </div>
                        <?php 
                            unset($_SESSION['errMsg']);
                        } ?>
             <?php 
                           if(!empty($_SESSION['scssMsg'])) { ?>
                            <div class="alert alert-success fade in">
                            <?php echo $_SESSION['scssMsg'];?>
                            </div>
                        <?php 
                            unset($_SESSION['scssMsg']);
                        } ?>
           
      <ul class="tab-group">
        <li class="tab active"><a href="#login">Log In</a></li>
        <li class="tab"><a href="#signup">Sign Up</a></li>
      </ul>
      
      <div class="tab-content">

          <div id="login">   
          <img class="logo" src="img/logo.png">
      <?php if(isset($_SESSION['note'])){echo $_SESSION['note']; unset($_SESSION['note']);} ?>
      <form action="login2.php" method="post">
          
            <div class="field-wrap">
            <label>
              <i class="fa fa-envelope" aria-hidden="true"></i>Email Address<span class="req">*</span>
            </label>
            <input type="email" class="form-control" required autocomplete="off" name="textEmail"/>
          </div>
          
          <div class="field-wrap">   
             <div class="password-show">
              <label>
                  <span class="fa fa-lock" aria-hidden="true"></span> Password<span class="req">*</span>
           </label>
          
            <input type="password" required autocomplete="off" class="showpassword form-control" name="textPassword" />
            <i class="fa fa-eye show-off " id="showPassword"></i>
                 
          </div>
              <a href="forgot.php">Forgot password?</a>
        </div>    
          
          <p class="forgot"><a href="#">Forgot Password?</a></p>
          
          <button class="button button-block"/>Log In</button>
          
          </form>

        </div>

        <div id="signup">   
          <h1>Sign Up</h1>
          
          <form action="register2.php" id="register" method="POST" >    
             
           
              
          <div class="top-row">
            <div class="field-wrap">
              <label>
                <i class="fa fa-user" aria-hidden="true"></i>First Name<span class="req">*</span>
              </label>
              <input type="text" class="form-control" required autocomplete="off" id="fname" name="textFname"/>
            </div>
        
            <div class="field-wrap">
              <label>
                <i class="fa fa-user" aria-hidden="true"></i>Last Name<span class="req">*</span>
              </label>
              <input type="text" class="form-control" required autocomplete="off" id="lname" name="textLname"/>
            </div>
          </div>

          <div class="field-wrap">
            <select name="selectPosition" class="selectPosition form-control" id="type">
              <option selected="true" disabled >&#xf0c0;--Select Postion*--</option>
              <option name="Dean" value="Dean">Dean</option>
              <option name="Chair" value="Chair">Chair</option>
              <option name="VPA" value="VPA">VPA</option>
              <option name="QA" value="QA">QA</option>
              <option name="HRD" value="HRD">HR</option>
            </select>
          </div>

          <div class="field-wrap" id="row_dim">
            <p><select name="selectDept" class="selectPosition form-control" required>
              <option selected="true" disabled >&#xf19d;--Select Department*--</option>
              <option value="CBA">CBA</option>
              <option value="CIHM">CIHM</option>
              <option value="CON">CON</option>
              <option value="CAS">CAS</option>
              <option value="CCIT">CCIT</option>
              <option value="COPS">COPS</option>
              <option value="COE">COE</option>
            </select></p>
          </div>

          <div class="field-wrap">
            <label>
              <i class="fa fa-envelope" aria-hidden="true"></i>Email Address<span class="req">*</span>
            </label>
            <input type="email" class="form-control" required name="textEmail" autocomplete="off"/>
          </div>
          
          <div class="field-wrap">
              <div class="password-show">
            <label>
              <span class="fa fa-lock" aria-hidden="true"></span>Password<span class="req">*</span><small>- Minimum of 8 characters</small>
            </label>
            <input type="password" required autocomplete="off" class="showpassword2 form-control" id="password" name="textPassword" data-val-maxlength="The field FullName must be a string or array type with a maximum length of &#39;255&#39;." data-val-maxlength-max="255" data-val-required="The FullName field is required." pattern=".{8,}"/>
                   <i class="fa fa-eye show-off2" id="showPassword2"></i>
              </div>
          </div>

           <div class="field-wrap">
               <div class="password-show">
            <label>
              <span class="fa fa-lock" aria-hidden="true"></span>Confirm Password<span class="req">*</span>
            </label>
            <input type="password"required autocomplete="off" class="showpassword3 form-control" id="confirm_password" name="textCpassword"/>
                   <i class="fa fa-eye show-off3" id="showPassword3"></i>       
          </div>
              </div>
            
        <div class="field-wrap">
          <label>Captcha</label><br><br>
          <input type="text" placeholder="Enter Code" id="captcha" name="captcha" class="inputcaptcha" required="required">
          <img src="demo_captcha.php" class="imgcaptcha" alt="captcha">
          <img src="img/refresh.png" alt="reload" class="refresh" />
        </div> 
              
          <button type="submit" class="button button-block btn btn-primary" name="B1"/>Get Started</button>
          
          </form>

        </div>
        
      </div><!-- tab-content -->
      
</div> <!-- /form -->
 <!--   <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script> -->
    <script src='js/jquery-2.2.3.min.js'></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="js/index.js"></script>
    <script src="js/show-password.js"></script>
    <script src="js/confirm-pass.js"></script>
    <script language="javascript">
      $(document).ready(function(){

      $(".refresh").click(function () {
          $(".imgcaptcha").attr("src","demo_captcha.php?_="+((new Date()).getTime()));
          
      });


       $('#register').submit(function() {
         
        $.post("captcha.php?"+$("#register").serialize(), { }, function(response){
              if(!(response==1)){
                  //alert("Wrong captcha code!");
                 $(".imgcaptcha").attr("src","demo_captcha.php?_="+((new Date()).getTime()));
                 clear_form();
              }
        });
          });


      });
    </script>
  </body>
</html>