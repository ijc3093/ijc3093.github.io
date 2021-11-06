<?php

include('header.php');

  include('DB_Management.php');
  
  $db = new DB();
  
  date_default_timezone_set("America/New_York");
  //Do not delete this....
  if(isset($_POST['insertmuseai'])){
    $maxsize = 5929344; // 5MB        
    //$maxsize = 5929344;                   

    $file_name_video = $_FILES['file']['name'];
    $name = $_FILES['file']['name'];
    $location_image = "videos/".$file_name_video;
    $location_video = "videos/".$file_name_video;
    $date_post = date("Y-m-d");
    $time_post = date("h:i:sa");
    // Select file type
    $videoFileType = strtolower(pathinfo($location_video,PATHINFO_EXTENSION));

    // Valid file extensions
    $extensions_arr = array("mp4","avi","3gp","mov","mpeg");

    // Check extension
    if( in_array($videoFileType,$extensions_arr) ){
        
        // Check file size
        if(($_FILES["file"]["size"] = 0) || ($_FILES['file']['size'] >= $maxsize)) {
            echo "File too large. File must be less than 5MB.";
        }else{
            // Upload
            if(move_uploaded_file($_FILES['file']['tmp_name'],$location_video)){
                // Insert record
                // $query = "INSERT INTO videos(name,location) VALUES('".$name."','".$target_file."')";

                $db->insert_museai(
                  $_POST['name'], 
                  $_POST['artist'],
                  $_POST['year'],
                  $date_post,
                  $_POST['datestart'], 
                  $_POST['dateend'], 
                  $_POST['NumberAllowed'], 
                  $_POST['dropdown'],
                  $_POST['description'], 
                  $_POST['image'], 
                  $location_image,
                  $_POST['video'],
                  $location_video,
                  $time_post,
                  $_SESSION['userRole']
                );
            }
        }

    }else{
        echo "Invalid file extension.";
    }

}

  // does sanitization second
  function sanitize_input( $value){
    $value = trim($value);
    $value = stripslashes($value);
    $value = htmlspecialchars($value);
    return $value;
  }

  //logout button
  if(isset($_GET['logout'])){
    logout();
  }

  //destory the session to the login local (index)
  function logout(){
   // session_destory();
    //header("location: http://serenity.ist.rit.edu/~ijc3093/ISTE-341/Project1/login.php");
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
    <meta
      name="description"
      content="Web site created using create-react-app"
    />
    <link rel="apple-touch-icon" href="%PUBLIC_URL%/logo192.png" />
    <!--
      manifest.json provides metadata used when your web app is installed on a
      user's mobile device or desktop. See https://developers.google.com/web/fundamentals/web-app-manifest/
    -->
    <link rel="manifest" href="%PUBLIC_URL%/manifest.json" />
    
      
      <link href="./assets/dist/css/bootstrap.min.css" rel="stylesheet">

            <style>
              .bd-placeholder-img {
                font-size: 1.125rem;
                text-anchor: middle;
                -webkit-user-select: none;
                -moz-user-select: none;
                -ms-user-select: none;
                user-select: none;
              }

              @media (min-width: 768px) {
                .bd-placeholder-img-lg {
                  font-size: 3.5rem;
                }
              }
            </style>
    <!-- Custom styles for this template -->
    <link href="dashboard.css" rel="stylesheet">
    <title>museais</title>
  </head>
  <body>
    
    <div id="root"></div>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="#">Add museais</a>
          <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
          <ul class="navbar-nav px-3">
              <li class="nav-item text-nowrap">
                <a class="nav-link" href="insert_museai.php?logout=true">Logout</a>
              </li>
          </ul>
        </nav>
            <div class="container-fluid">
              <div class="row">
                <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
                  <div class="sidebar-sticky pt-3">
                    <ul class="nav flex-column">
                      <?php 
                            echo '<li class="nav-item">
                                <a class="nav-link" href="admin.php">
                                <span data-feather="file"></span>
                                Admin 
                                </a>
                            </li>';
                            
                      ?>
                      <li class="nav-item">
                        <a class="nav-link" href="museais.php">
                          <span data-feather="shopping-cart"></span>
                          Manager
                        </a>
                      </li>
                      <li class="nav-item">
                        <a class="nav-link" href="registrations.php">
                          <span data-feather="users"></span>
                          Registrations 
                        </a>
                      </li>
                      
                    </ul>
                  </div>
                </nav>
                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                  <div class="col-md-8 order-md-1"><br><br>

                  <div>
                          <h2>Add New museais</h2>
                          <br>          
                  </div>
                  <div class="col-lg-8 push-lg-4 personal-info"> 
                  <?php 
                            
                            $result = $db->get_Venues();
                              //var_dump($result);
                            echo'<form enctype="multipart/form-data" action="insert_museai.php"  method="post" role="form" id="createAccountFor" > 
                                <div class="form-group row">';

                                    // Name
                                    echo'<label class="col-lg-3 col-form-label form-control-label">Name</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" type="text" name="name" placeholder="" value="" required /><br>
                                    </div>';
                                    
                                    //Artist
                                    echo'
                                    <label class="col-lg-3 col-form-label form-control-label">Artist</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" name="artist" placeholder="" value="" required /><br>
                                    </div>';

                                    //Year
                                    echo'
                                    <label class="col-lg-3 col-form-label form-control-label">Year</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" name="year" placeholder="" value="" required /><br>
                                    </div>';

                                    //Start Date
                                    echo'
                                    <label class="col-lg-3 col-form-label form-control-label">Start Date</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" name="datestart" placeholder="" value="" required /><br>
                                    </div>';


                                    //End Date
                                    echo'<label class="col-lg-3 col-form-label form-control-label">End Date</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" name="dateend" placeholder="" value="" required /><br>
                                    </div>';
    
    
                                    //Number Allowed
                                    echo'<label class="col-lg-3 col-form-label form-control-label">Number Allowed</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" name="NumberAllowed" placeholder="" value="" required/><br>
                                    </div>';
    
    
                                    //Description
                                    echo'<label class="col-lg-3 col-form-label form-control-label">Description</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" name="description" placeholder="" value="" required/><br>
                                    </div>';

                                    //Capacity
                                    echo'<label class="col-lg-3 col-form-label form-control-label">Capacity</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" name="capacity" placeholder="" value="" required/><br>
                                    </div>';
    
                                    // image
                                    echo'<label class="col-lg-3 col-form-label form-control-label">Image</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" name="image" placeholder="" value="" required/><br>
                                    </div>';
    
                                    echo'<label class="col-lg-3 col-form-label form-control-label">Upload Image</label>
                                    <div class="col-lg-9">
                                        <input name="file" type="file"  required="required" class="form-control"/><br>
                                    </div>';
    
                                    //video
                                    echo'<label class="col-lg-3 col-form-label form-control-label">Video</label>
                                    <div class="col-lg-9">
                                        <input class="form-control" name="video" placeholder="" value="" required/><br>
                                    </div>';
    
                                    echo'<label class="col-lg-3 col-form-label form-control-label">Upload Video</label>
                                    <div class="col-lg-9">
                                        <input name="file" type="file"  required="required" class="form-control"/><br>
                                    </div>';
    
                                    echo'<label class="col-lg-3 col-form-label form-control-label">Venue</label>';
                                      $venue = '<select name="dropdown">';
                                      foreach($result as $post){
                                        $venue .= "<option value ='" .$post['idvenue'] . "'>" . $post['name'] . "</option>";
                                      }
                                      $venue .= '</select>';
                                      echo $venue;
                                    echo'</div>';
                                    // echo  '<button class="btn btn-primary btn-lg btn-block" type="submit" name="insertmuseai">Save</button>
                                    // <hr class="mb-4">';  
                                    
                                    echo  '<button class="btn btn-primary" type="submit" name="insertmuseai">Submit</button>'; 
                        echo '<hr/></form>';  
                        ?>
                    </div>
                  </div>
                </main>
              </div>
            </div>
  </body>
</html>
