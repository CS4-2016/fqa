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
   
          <?php if(isset($_SESSION['note'])) echo $_SESSION['note']; unset($_SESSION['note']); ?>
          <img class="logo" src="img/logo.png">
          <br>
        <?php if(isset($_SESSION['note1'])) echo $_SESSION['note1']; unset($_SESSION['note1']); ?>
               

        </div>

        
      
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