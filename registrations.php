<?php

    //include('validate.php');
    //var_dump($_GET);

    include('header.php');
    
    //var_dump($_SESSION);
    require('DB_Management.php');
    
    $db = new DB();

  
    if(isset($_GET['delete_museai'])){
      //print_r($_POST);
      $db->delete("attendee_museai", $_GET['id'], "museai");
    }


    if(isset($_GET['delete_Session'])){
        //print_r($_POST);
        $db->delete("attendee_session", $_GET['id'], "session");
    }

    //logout button
    if(isset($_GET['logout'])){
        logout();
    }

    //destory the session to the login local (index)
    function logout(){
        //$_SESSION = array(); // destroy all session data
        session_destroy(); // compelte erase session
        // header("location: http://serenity.ist.rit.edu/~ijc3093/ISTE-341/Project1/login.php");
        header("location: http://localhost/PHP-MYSQL-MUSEAI-AZURE/login.php");
        
        exit();
    }

    if($_SESSION['userRole'] == 3){
     // header("location: http://serenity.ist.rit.edu/~ijc3093/ISTE-341/Project1/museais.php");
      header("location: http://127.0.0.1:8080/museais.php");
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
    <!-- <link href="dashboard.css" rel="stylesheet"> -->
    <title>Registrations</title>
  </head>
  <body>
    <noscript>You need to enable JavaScript to run this app.</noscript>
    <div id="root"></div>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="admin.php">Museai RIT</a>
          <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
          
          <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
            <a class="nav-link" href="registrations.php?logout=true">Logout</a>
            </li>
          </ul>
         
          
        </nav>
            <div class="container-fluid">
              <div class="row">
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

                <!-- MAIN SIDE AREA -->
                <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                    <h1 class="h2">The Registrations</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group mr-2">
                        <a href="insert_user.php" class="btn btn-sm btn-outline-secondary">Add</a>
                        <button class="btn btn-sm btn-outline-secondary">Share</button>
                        <button class="btn btn-sm btn-outline-secondary">Export</button>
                    </div>
                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
                        <span data-feather="calendar"></span>
                        This week
                    </button>
                    </div>
                </div>
                <div class="col-md-8 order-md-1">
                                <br>
                                <br>
                                
                                <div class="col-lg-12 text-lg-center">

                                <!-- museai List -->
                                <h4 class="pull-left">Manager registration for museai</h4>
                                            <!-- <a class="btn btn-primary pull-right class="nav-link" href="insert_museai.php">
                                            <span data-feather="users"></span>Add New museai</a> -->
                                <br>
                                </div>   
                            
                                <!-- Attendee Table -->
                                <table class="table table-bordered table-responsive-md table-striped text-center">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">ID</th>
                                                    <th class="text-center">Name</th>
                                                    <th class="text-center">Start Date</th>
                                                    <th class="text-center">End Date</th>
                                                    <th class="text-center">Attending museais</th>
                                                    <th class="text-center">Stop Attending museai</th>
                                                </tr>
                                            </thead>

                                            <?php
                                                    $result = $db->get_Attendees($_SESSION['id']);
                                                    //var_dump($result);
                                                    echo'<tbody>';
                                                        foreach($result as $post){
                                                            $museais = $db->get_Registration_museais($post["idattendee"]);
                                                            //var_dump($museais);
                                                            foreach($museais as $register){
                                                              echo'<tr>
                                                                  <td class="pt-3-half" contenteditable="true">' . $register["idmuseai"] . 
                                                                  ' </td>'.

                                                                  ' <td class="pt-3-half" contenteditable="true"> ' . $register["name"] . 
                                                                  ' </td> '.

                                                                  '<td class="pt-3-half" contenteditable="true">' . $register["datestart"] . ' </td> '.
                                                                  '<td class="pt-3-half" contenteditable="true">' . $register["dateend"] . '</td>';  


                                                              echo'    
                                                              <td><a class="nav-link active" href="admin.php?Attendingmuseai=true&id' . $register["idmuseai"] . '">
                                                              attending on museai</a></td>';

                                                              echo'    
                                                              <td><a class="nav-link active" href="admin.php?deleteAttendingmuseai=true&id' . $register["idmuseai"] . '">
                                                              Stop attending on museai</a></td>
                                                              </tr>';
                                                            } // close get_Register_museais()
                                                        }// close get_Attendees()  
                                                      echo' </tbody>';
                                            ?>
                                </table> 
                                
                                



                                                            <!-- Session List -->
                                <br>
                                <br>
                                <div class="col-lg-12 text-lg-center">
                                    <!-- Get Registration -->
                                    <h4 class="pull-left">Manage registration for sessions</h4>
                                            <!-- <a class="btn btn-primary pull-right class="nav-link" href="insert_museai.php">
                                            <span data-feather="users"></span>Add New museai</a> -->
                                <br>
                                </div>   
                                
                                <!-- Attendee Table -->
                                <table class="table table-bordered table-responsive-md table-striped text-center">
                                            <thead>
                                                <tr>
                                                    <th class="text-center">ID</th>
                                                    <th class="text-center">Name</th>
                                                    <th class="text-center">Start Date</th>
                                                    <th class="text-center">End Date</th>
                                                    <th class="text-center">Attending Session</th>
                                                    <th class="text-center">Stop Attending Session</th>
                                                </tr>
                                            </thead>

                                            <?php
                                                    $result = $db->get_Attendees($_SESSION['id']);
                                                        // var_dump($result);
                                                        foreach($result as $post){
                                                          // var_dump($post);
                                                            echo'<tbody>';
                                                            $museais = $db->get_Registration_Sessions($post["idattendee"]);
                                                            // var_dump($museais);

                                                            foreach($museais as $register){
                                                                echo' <tr>
                                                                      <td class="pt-3-half" contenteditable="true"> ' . $register["idsession"] . ' 
                                                                      </td>

                                                                      <td class="pt-3-half" contenteditable="true"> ' . $register["name"] . ' </td>
                                                                      <td class="pt-3-half" contenteditable="true"> ' . $register["startdate"] . ' </td>
                                                                      <td class="pt-3-half" contenteditable="true"> ' . $register["enddate"] . ' </td>';  

                                                                // close get_Register_museais()
                                                                
                                                                echo'    
                                                                    <td><a class="nav-link active" href="admin.php?Attendingmuseai=true&id' . $register["idsession"] . '">
                                                                    attending on museai</a></td>';

                                                                echo'    
                                                                    <td><a class="nav-link active" href="admin.php?deleteAttendingmuseai=true&id' . $register["idsession"] . '">
                                                                    Stop attending on museai</a></td>
                                                                    </tr>';
                                                              } 
                                                        }
                                                        echo' </tbody>';// close get_Attendees()  
                                            ?>
                                </table>
                            </div>
                    </div>
                </main>
              </div>
            </div>
  </body>
</html>

