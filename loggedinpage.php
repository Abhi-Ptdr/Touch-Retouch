<?php

    session_start();

    if (array_key_exists("id", $_COOKIE) && $_COOKIE ['id']) {
        
        $_SESSION['id'] = $_COOKIE['id'];
        
    }
    
    if (array_key_exists("id", $_SESSION)) {
        
    //    echo "<p>Logged In! <a href='index.php?logout=1'>Log Out</a></p>";    link moved to the log out button
        
    }else {
        
        header("Location: index.php");   //if not loged in due to any error sent to homepage index.php. 
        
    }
    
    
    
    include("top.php");
    
?>
    
    <nav class="navbar navbar-light bg-light fixed-top">
      
      <a class="navbar-brand" href="#">LrPresets</a>    
        
        <div class="pull-xs-right">
          
          <a href="index.php?logout=1"><button class="btn btn-outline-success my-2 my-sm-0" type="submit">Logout</button></a>
        
        </div>
        
    </nav>
    
    
    <div class="container" id="containerloggedinpage">
        
        
        
        
    </div>
    
    
    
    
    
    
<?php    
    
    include("base.php");

?>