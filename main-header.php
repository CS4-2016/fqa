 <head>
     <link rel="stylesheet" href="css/bootstrap.min.css">
     <link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/index.css">

<link rel="stylesheet" href="css/drolex-filestyle.css">

</head>

<!-- Main Header -->
  <header class="main-header">

    <!-- Logo -->
<?php
    if($_SESSION['position']=='QA'){
        echo '<a href="qa-index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span  class="logo-mini"><img  class="logo" src="img/minilogo.png"></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"> <img class="logo" src="img/logo.png"></span>
    </a>';
    }else if($_SESSION['position']=='HRD'){
        echo '<a href="hrd-index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span  class="logo-mini"><img  class="logo" src="img/minilogo.png"></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"> <img class="logo" src="img/logo.png"></span>
    </a>';
    }else if($_SESSION['position']=='Dean' || $_SESSION['position']=='Chair' || $_SESSION['position']=='VPA'){
        echo '<a href="acad-index.php" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span  class="logo-mini"><img  class="logo" src="img/minilogo.png"></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"> <img class="logo" src="img/logo.png"></span>
    </a>';
    }
?>


    <!-- Header Navbar -->
    <nav class="navbar navbar-static-top" role="navigation">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
      </a>
      <!-- Navbar Right Menu -->
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
       
          <!-- User Account Menu -->
          <li class="dropdown user user-menu">
            <!-- Menu Toggle Button -->
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <!-- The user image in the navbar-->
              
              <!-- hidden-xs hides the username on small devices so only the image appears. -->
              <span class="hidden-xs"><?php echo $_SESSION['login'];  ?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- The user image in the menu -->
             
              <!-- Menu Body -->
             
              <!-- Menu Footer-->
              <li class="user-footer">
                <div class="pull-left">
                  <a href="view-profile.php" class="btn btn-primary">Profile</a>
                </div>
                <div class="pull-right">
                  <a href="signout.php" class="btn btn-danger">Sign out</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>