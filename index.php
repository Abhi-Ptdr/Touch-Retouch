<?php

    session_start();

    $error = "";    

    if (array_key_exists("logout", $_GET)) {
        
        unset($_SESSION);
        setcookie("id", "", time() - 60*60);
        $_COOKIE["id"] = "";  
        
    } else if ((array_key_exists("id", $_SESSION) AND $_SESSION['id']) OR (array_key_exists("id", $_COOKIE) AND $_COOKIE['id'])) {
        
        header("Location: loggedinpage.php");
        
    }

    if (array_key_exists("submit", $_POST)) {
        
        
        include("connection.php");
        
        
        if (!$_POST['email']) {
            
            $error .= "An email address is required<br>";
            
        } 
        
        if (!$_POST['password']) {
            
            $error .= "A password is required<br>";
            
        } 
        
        if ($error != "") {
            
            $error = "<p>There were error(s) in your form:</p>".$error;
            
        } else {
            
            if ($_POST['signUp'] == '1') {
            
                $query = "SELECT id FROM `users` WHERE email = '".mysqli_real_escape_string($link, $_POST['email'])."' LIMIT 1";

                $result = mysqli_query($link, $query);

                if (mysqli_num_rows($result) > 0) {

                    $error = "That email address is taken.";

                } else {

                    $query = "INSERT INTO `users` (`email`, `password`) VALUES ('".mysqli_real_escape_string($link, $_POST['email'])."', '".mysqli_real_escape_string($link, $_POST['password'])."')";

                    if (!mysqli_query($link, $query)) {

                        $error = "<p>Could not sign you up - please try again later.</p>";

                    } else {

                        $query = "UPDATE `users` SET password = '".md5(md5(mysqli_insert_id($link)).$_POST['password'])."' WHERE id = ".mysqli_insert_id($link)." LIMIT 1";

                        mysqli_query($link, $query);

                        $_SESSION['id'] = mysqli_insert_id($link);

                        if ($_POST['stayLoggedIn'] == '1') {

                            setcookie("id", mysqli_insert_id($link), time() + 60*60*24*365);

                        } 

                        header("Location: loggedinpage.php");

                    }

                } 
                
            } else {
                    
                    $query = "SELECT * FROM `users` WHERE email = '".mysqli_real_escape_string($link, $_POST['email'])."'";
                
                    $result = mysqli_query($link, $query);
                
                    $row = mysqli_fetch_array($result);
                
                    if (isset($row)) {
                        
                        $hashedPassword = md5(md5($row['id']).$_POST['password']);
                        
                        if ($hashedPassword == $row['password']) {
                            
                            $_SESSION['id'] = $row['id'];
                            
                            if ($_POST['stayLoggedIn'] == '1') {

                                setcookie("id", $row['id'], time() + 60*60*24*365);

                            } 

                            header("Location: loggedinpage.php");
                                
                        } else {
                            
                            $error = "That email/password combination could not be found.";
                            
                        }
                        
                    } else {
                        
                        $error = "That email/password combination could not be found.";
                        
                    }
                }
            
        }
        
        
    }


?>




<?php include("top.php"); ?>


  
<!--    <body data-spy="scroll" data-target="#navbar">  covered in top.php        -->
	
		<nav class="navbar navbar-expand-lg navbar-light bg-light fixed-top" id="navbar">
		  <a class="navbar-brand" href="#">LrPresets</a>
		  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		  </button>

		  <div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav mr-auto">
			  <li class="nav-item">
				<a class="nav-link" href="#jombotron">Home <span class="sr-only">(current)</span></a>
			  </li>
			  <li class="nav-item">
				<a class="nav-link" href="#about">About</a>
			  </li>
			  <li class="nav-item">
				<a class="nav-link disabled" href="#footer">Download The App</a>
			  </li>
			</ul>
			<form class="form-inline my-2 my-lg-0">
			  <input class="form-control mr-sm-2" type="email" placeholder="Email">
			  <input class="form-control mr-sm-2" type="password" placeholder="password">
			  <button id="Login" class="btn btn-success my-2 my-sm-0" type="submit">Login</button>
			</form>
		  </div>
		</nav>
		
    		<div id="error"><?php if($error!="") {
    				    
    				    echo '<div class="alert alert-danger" role="alert">'.$error.'</div>';
    				    
    				    } ?>
    		</div>
		
		
		<div class="jumbotron" id="jombotron">
			<h1 class="display-4">Touch Retouch!</h1>
			<p class="lead"><b>Just One Click..</br> Edit Your Pic..</b></p>
			<hr class="my-4">
			<p>Want to Know more? Join our mailing list!</p>
		</div>
		
		<div class="container">
		
			<div id="appSummary">
			
				<h1>Click on Picture TO see the Effect</h1>
				<P class="lead">See the preview, The original and the edited picture On taping them and Download the Presets You like.</p>
			
			</div>
		
		</div>
		
		<div class="container" id="about">
			<div class="card-deck">
			  <div class="card">
				<div class="flip"> 
					<div class="front"> 
						<img class="card-img-top" src="ImagesEdited/Card15.JPG" alt="Card image cap">
					</div> 
					<div class="back">
						<img class="card-img-top" src="ImagesOriginal/Original15.JPG" alt="Card image cap">
					</div> 
				</div>
				<div class="card-body">
				  <h5 class="card-title"><i class="fas fa-mobile-alt"></i> Brown & Orange</h5>
				  <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
				  <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
				</div>
			  </div>
			  
			  <div class="card">
				<div class="flip"> 
					<div class="front"> 
						<img class="card-img-top" src="ImagesEdited/Card14.JPG" alt="Card image cap">
					</div> 
					<div class="back">
						<img class="card-img-top" src="ImagesOriginal/Original14.JPG" alt="Card image cap">
					</div> 
				</div>
				<div class="card-body">
				  <h5 class="card-title"><i class="fab fa-gripfire"></i> Aqua Tone</h5>
				  <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
				  <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
				</div>
			  </div>
			  
			  <div class="card">
				<div class="flip"> 
					<div class="front"> 
						<img class="card-img-top" src="ImagesEdited/Card13.JPG" alt="Card image cap">
					</div> 
					<div class="back">
						<img class="card-img-top" src="ImagesOriginal/Original13.JPG" alt="Card image cap">
					</div> 
				</div>
				<div class="card-body">
				  <h5 class="card-title"><i class="fas fa-water"></i> Black Vintage</h5>
				  <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
				  <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
				</div>
			  </div>
			</div>
		</div>
		
		
		<div class="container" id="about">
			<div class="card-deck">
			  <div class="card">
				<div class="flip"> 
					<div class="front"> 
						<img class="card-img-top" src="ImagesEdited/Card12.JPG" alt="Card image cap">
					</div> 
					<div class="back">
						<img class="card-img-top" src="ImagesOriginal/Original12.JPG" alt="Card image cap">
					</div> 
				</div>
				<div class="card-body">
				  <h5 class="card-title"><i class="fas fa-mobile-alt"></i> Orange & Aqua</h5>
				  <p class="card-text">This card has supporting text below as a natural lead-in to additional content.</p>
				  <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
				</div>
			  </div>
			  
			  <div class="card">
				<div class="flip"> 
					<div class="front"> 
						<img class="card-img-top" src="ImagesEdited/Card11.JPG" alt="Card image cap">
					</div> 
					<div class="back">
						<img class="card-img-top" src="ImagesOriginal/Original11.JPG" alt="Card image cap">
					</div> 
				</div>
				<div class="card-body">
				  <h5 class="card-title"><i class="fab fa-gripfire"></i> Matte Black</h5>
				  <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
				  <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
				</div>
			  </div>
			  
			  <div class="card">
				<div class="flip"> 
					<div class="front"> 
						<img class="card-img-top" src="ImagesEdited/Card10.JPG" alt="Card image cap">
					</div> 
					<div class="back">
						<img class="card-img-top" src="ImagesOriginal/Original10.JPG" alt="Card image cap">
					</div> 
				</div>
				<div class="card-body">
				  <h5 class="card-title"><i class="fas fa-water"></i> Moody Yellow</h5>
				  <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This card has even longer content than the first to show that equal height action.</p>
				  <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
				</div>
			  </div>
			</div>
		</div>
		
		<div class="container" id="signUp">
		
			<!-- Button trigger modal -->
			<button type="button" data-toggle="modal" data-target="#exampleModalCenter">
			  Sign up For More..
			</button>

			<!-- Modal -->
			<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
			  <div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="exampleModalLongTitle">Enter Your Detail</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  <div class="modal-body">

                    <form method="post" id = "signUpForm">
    
                        <p>Interested? Sign up now.</p>
                        
                        <fieldset class="form-group">
                    
                            <input class="form-control" type="email" name="email" placeholder="Your Email">
                            
                        </fieldset>
                        
                        <fieldset class="form-group">
                        
                            <input class="form-control" type="password" name="password" placeholder="Password">
                            
                        </fieldset>
                        
                        <div class="checkbox">
                        
                            <label>
                        
                            <input type="checkbox" name="stayLoggedIn" value=1> Stay logged in
                                
                            </label>
                            
                        </div>
                        
                        <fieldset class="form-group">
                        
                            <input type="hidden" name="signUp" value="1">
                            
                            <input class="btn btn-success" type="submit" name="submit" value="Sign Up!">
                            
                        </fieldset>
                        
                        <p>Already have an account, Log in Instead</p>
                        
                        <p><a href="#" class="toggleForms">Log in</a></p>
                    
                    </form>
                    
                    <form method="post" id = "logInForm">
                        
                        <p>Log in using your username and password.</p>
                        
                        <fieldset class="form-group">
                    
                            <input class="form-control" type="email" name="email" placeholder="Your Email">
                            
                        </fieldset>
                        
                        <fieldset class="form-group">
                        
                            <input class="form-control"type="password" name="password" placeholder="Password">
                            
                        </fieldset>
                        
                        <div class="checkbox">
                        
                            <label>
                        
                                <input type="checkbox" name="stayLoggedIn" value=1> Stay logged in
                                
                            </label>
                            
                        </div>
                            
                            <input type="hidden" name="signUp" value="0">
                        
                        <fieldset class="form-group">
                            
                            <input class="btn btn-success" type="submit" name="submit" value="Log In!">
                            
                        </fieldset>
                        
                        <p>Not have an Account, Sing Up!</p>
                        
                        <p><a href="#" class="toggleForms">Sign up</a></p>
                    
                    </form>
				  
				  </div>
				</div>
			  </div>
			</div>
		
		</div>
		
		
		
		<?php include("base.php"); ?>
		
		
		