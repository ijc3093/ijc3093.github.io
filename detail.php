<?php
    //var_dump($_GET);

    include('header.php');

   // var_dump($_SESSION);
    
    // $_SESSION = array(); // destroy all session data
    // session_destroy(); // compelte erase session
    include('DB_Management.php');
    $db = new DB();

  //delete data from museai
    if(isset($_GET['deleteAttendingmuseai'])){
        $db->Delete("attendee_museai", $_GET['id'], "museai");
    }

  //delete data from session
    if(isset($_GET['deleteAttendingSession'])){
        $db->Delete("attendee_session", $_GET['id'], "session");
    }

  //delete museai
    if(isset($_GET['deletemuseai'])){
        $db->admin_Delete("museai", $_GET['id'], "idmuseai");
        $db->admin_Delete("session", $_GET['id'], "museai");

        // echo "<script>alert('Delete from museai ');</script>";
    }


  //delete venue
    if(isset($_GET['deleteVenue']) && ($_GET['id']) == 1){
        $db->admin_Delete("venue", $_GET['id'], "idvenue");
        $db->admin_Delete("museai", $_GET['id'], "venue");
    }


    //delete session
    if(isset($_GET['deleteSession'])){
        var_dump($_GET);
        $db->admin_Delete("session", $_GET['id'], "idsession");
    }

    //attending museai
    if(isset($_GET['attendmuseai'])){
        $db->attending_museai($_GET['id'], $_SESSION['username']);
    }

    //attending session
    if(isset($_GET['attendSession'])){
        $db->attending_Session($_GET['id'], $_SESSION['username']);
    }

    //logout button
    if(isset($_GET['logout'])){
        logout();
    }

    //destory the admin to the login local
    function logout(){
        //$_SESSION = array(); // destroy all venue data
        session_destroy(); // compelte erase venue
       // header("location: http://serenity.ist.rit.edu/~ijc3093/ISTE-341/Project1/login.php");
        header("location: http://localhost/PHP-MYSQL-MUSEAI-AZURE/login.php");
        exit();
    }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <link rel="icon" href="%PUBLIC_URL%/favicon.ico" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta name="theme-color" content="#000000" />
    <meta name="description" content="Web site created using create-react-app"/>
    <link rel="apple-touch-icon" href="%PUBLIC_URL%/logo192.png" />
  
    <link rel="manifest" href="%PUBLIC_URL%/manifest.json" />      
    <link href="./assets/dist/css/bootstrap.min.css" rel="stylesheet">
   
    <title>Admin</title>
  </head>
  <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Museai RIT</a>
      <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="admin.php?logout=true">Sign out</a>
        </li>
      </ul>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <!-- NAV SIDE AREA -->
        <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                    <div class="sidebar-sticky pt-3">
                        <ul class="nav flex-column">
                        
                            <?php 

                                    //Admin
                                    if($_SESSION['userRole'] == 2 || $_SESSION['userRole'] == 3){
                                        // echo '<li class="nav-item">
                                        // <label class="nav-link" href="admin.php">
                                        // <span data-feather="file"></span>
                                        // Admin 
                                        // </label>
                                        // </li>';
                                    }else{
                                        echo '<li class="nav-item">
                                        <a class="nav-link" href="admin.php">
                                        <span data-feather="file"></span>
                                        Admin 
                                        </a>
                                        </li>';
                                    }

                                    //museai
                                    if($_SESSION['userRole'] == 3){
                                        // echo '<li class="nav-item">
                                        // <label class="nav-link" href="museais.php">
                                        // <span data-feather="shopping-cart"></span>
                                        // museais
                                        // </label>
                                        // </li>';
                                    }else{
                                        echo '<li class="nav-item">
                                        <a class="nav-link" href="museais.php">
                                        <span data-feather="shopping-cart"></span>
                                        Manager
                                        </a>
                                        </li>';
                                    }

                                    //Registration
                                    if($_SESSION['userRole'] == 3){
                                        // echo'<li class="nav-item">
                                        // <label class="nav-link" href="registrations.php">
                                        // <span data-feather="users"></span>
                                        // Registrations 
                                        // </label>
                                        // </li>';
                                    }
                                    else{
                                        echo'<li class="nav-item">
                                        <a class="nav-link" href="registrations.php">
                                        <span data-feather="users"></span>
                                        Registrations 
                                        </a>
                                        </li>';
                                    }

                                ?>

                        </ul>
                    </div>
            </nav>
        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <?php
                $yesterday = $db->get_museais($_GET['id'])[0];
                $title = $yesterday["name"];
                echo "<div >";
                echo "<h1 class='h2'>".$title."</h1>";
                echo "</div>";
            ?>
            <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-group mr-2">
                <a href="insert_museai.php" class="btn btn-sm btn-outline-secondary">Add</a>
                <button class="btn btn-sm btn-outline-secondary">Share</button>
                <button class="btn btn-sm btn-outline-secondary">Export</button>
              </div>
              <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
                <span data-feather="calendar"></span>
                This week
              </button>
            </div>
          </div>
          <div >
		<div class="card">
			<div class="container-fliud">
				<div class="wrapper row">
					<div class="preview col-md-6">
						
						<div class="preview-pic tab-content">
                            <!-- <img src="upload/dog-puppy.png" class="img-rounded" alt="Cinque Terre" width="750" height="400">  -->

                            <?php
                                $video = $db->get_museais($_GET['id'])[0];
                                $location = $video["location_video"];
                                echo "<div >";
                                echo "<video src='".$location."' controls width='700' height='400' >";
                                echo "</div>";
                            ?>
						  <!-- <div class="tab-pane active" id="pic-1"><img src="http://placekitten.com/500/350" /></div> -->
						  <!-- <div class="tab-pane" id="pic-2"><img src="http://placekitten.com/500/400" /></div> -->
						  <!-- <div class="tab-pane" id="pic-3"><img src="http://placekitten.com/400/252" /></div>
						  <div class="tab-pane" id="pic-4"><img src="http://placekitten.com/400/252" /></div>
						  <div class="tab-pane" id="pic-5"><img src="http://placekitten.com/400/252" /></div> -->
						</div>
						<!-- <ul class="preview-thumbnail nav nav-tabs">
						  <li class="active"><a data-target="#pic-1" data-toggle="tab"><img src="http://placekitten.com/200/126" /></a></li>
						  <li><a data-target="#pic-2" data-toggle="tab"><img src="http://placekitten.com/200/126" /></a></li>
						  <li><a data-target="#pic-3" data-toggle="tab"><img src="http://placekitten.com/200/126" /></a></li>
						  <li><a data-target="#pic-4" data-toggle="tab"><img src="http://placekitten.com/200/126" /></a></li>
						  <li><a data-target="#pic-5" data-toggle="tab"><img src="http://placekitten.com/200/126" /></a></li>
						</ul> -->
						
					</div>
					<div class="details col-md-6">
                    <?php
                        $yesterday = $db->get_museais($_GET['id'])[0];
                        $title = $yesterday["name"];
                        echo "<div >";
                        echo "<h1 class='h2'>".$title."</h1>";
                        echo "</div>";
                    ?>
						<div class="rating">
							<div class="stars">
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star checked"></span>
								<span class="fa fa-star"></span>
								<span class="fa fa-star"></span>
							</div>
							<span class="review-no">41 reviews</span>
						</div>
						<!-- <p class="product-description">Suspendisse quos? Tempus cras iure temporibus? Eu laudantium cubilia sem sem! Repudiandae et! Massa senectus enim minim sociosqu delectus posuere.</p> -->
                        
                        <?php
                            $desc = $db->get_museais($_GET['id'])[0];
                            $description = $desc["description"];
                            echo "<div >";
                            echo "<p class='product-description'>".$description."</p>";
                            echo "</div>";
                        ?>

						<h4 class="price">current price: <span>$180</span></h4>
						<p class="vote"><strong>91%</strong> of buyers enjoyed this product! <strong>(87 votes)</strong></p>
						<h5 class="sizes">sizes:
							<span class="size" data-toggle="tooltip" title="small">s</span>
							<span class="size" data-toggle="tooltip" title="medium">m</span>
							<span class="size" data-toggle="tooltip" title="large">l</span>
							<span class="size" data-toggle="tooltip" title="xtra large">xl</span>
						</h5>
						<h5 class="colors">colors:
							<span class="color orange not-available" data-toggle="tooltip" title="Not In store"></span>
							<span class="color green"></span>
							<span class="color blue"></span>
						</h5>
						<div class="action">
							<button class="add-to-cart btn btn-default" type="button">add to cart</button>
							<button class="like btn btn-default" type="button"><span class="fa fa-heart"></span></button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
            </main>
        </div>
    </div>
</body>
</html>