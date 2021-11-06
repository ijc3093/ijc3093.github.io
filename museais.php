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

        .wrapper{
            width: 650px;
            margin: 0 auto;
        }
        .page-header h2{
            margin-top: 0;
        }
        table tr td:last-child a{
            margin-right: 15px;
        }
    </style>
    <!-- Custom styles for this template -->
    <!-- <link href="dashboard.css" rel="stylesheet"> -->
    <title>Admin</title>
  </head>
  <body>
    <div id="root"></div>
    <nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-md-3 col-lg-2 mr-0 px-3" href="admin.php">Museai RIT</a>
        <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-toggle="collapse" data-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
        <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
              <a class="nav-link" href="museais.php?logout=true">Logout</a>
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
            <!-- MAIN SIDE AREA -->
            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
                    <h1 class="h2">The Manager</h1>
                    <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group mr-2">
                        <?php
                            //Registration
                            if($_SESSION['userRole'] == 3){
                                // echo'<a class="btn btn-primary pull-right class="nav-link" href="insert_museai.php">
                                // <span data-feather="users">
                                // </span>Add New museai
                                // </a>';
                            }
                            else{
                                echo'<a href="insert_museai.php" class="btn btn-sm btn-outline-secondary">Add New Museai</a>';
                            }
                        ?>
                        <button class="btn btn-sm btn-outline-secondary">Share</button>
                        <button class="btn btn-sm btn-outline-secondary">Export</button>
                    </div>
                    <button class="btn btn-sm btn-outline-secondary dropdown-toggle">
                        <span data-feather="calendar"></span>
                        This week
                    </button>
                    </div>
                </div>
                <div>

                                <br>
                                <table class="table table-striped table-dark">
                                            <thead>
                                            <?php
                                                if($_SESSION['userRole'] == 3){
                                                    echo'<tr>
                                                        <th class="text-center">Art ID</th>
                                                        <th class="text-center">Title</th>
                                                        <th class="text-center">Artist</th>
                                                        <th class="text-center">Year</th>
                                                        <th class="text-center">Post Date</th>
                                                        <th class="text-center">Start Date</th>
                                                        <th class="text-center">End Date</th>
                                                        <th class="text-center">Venue</th>
                                                        <th class="text-center">Image</th>
                                                        <th class="text-center">video</th>
                                                        <th class="text-center">Time</th>';
                                                }else{
                                                        echo'
                                                        <th class="text-center">Art ID</th>
                                                        <th class="text-center">Title</th>
                                                        <th class="text-center">Artist</th>
                                                        <th class="text-center">Year</th>
                                                        <th class="text-center">Post Date</th>
                                                        <th class="text-center">Start Date</th>
                                                        <th class="text-center">End Date</th>
                                                        <th class="text-center">Venue</th>
                                                        <th class="text-center">Image</th>
                                                        <th class="text-center">video</th>
                                                        <th class="text-center">Time</th>';

                                                        echo'<th class="text-center">Detail</th>
                                                        <th class="text-center">Edit</th>
                                                        <th class="text-center">Delete</th></tr>';
                                                }
                                            ?>
                                            </thead>

                                            <?php
                                                    $result = $db->get_museais();

                                                    foreach($result as $post){
                                                    echo'<tbody>';
                                                    echo'<tr class="text-center">
                                                        <td>' . $post["idmuseai"] . '</td>
                                                        <td>' . $post["name"] . ' </td>
                                                        <td>' . $post["artist"] . ' </td>
                                                        <td>' . $post["year"] . ' </td>
                                                        <td>' . $post["datepost"] . ' </td>
                                                        <td>' . $post["datestart"] . '</td>
                                                        <td>' . $post["dateend"] . '</td>
                                                        <td>' . ($db->get_Venue($post["venue"]))["name"] . '</td>
                                                        
                                                        <td>' . $post["image"] . ' </td> 
                                                        <td>' . $post["video"] . ' </td>
                                                        <td>' . $post["time"] . '</td>';
                                                        
                                                        //attendee only
                                                        if($_SESSION['userRole'] == 3){
                                                                // echo'<td class="pt-3-half">
                                                                // <span class="table-remove"><label type="button" class="btn btn-success">Edit</label></span>
                                                                // </td>';
                                                        }
                                                        else{

                                                                echo'<td>
                                                                <a type="button" class="btn btn-success" href="Detail.php?id=' . $post["idmuseai"] . '">Detail</a>
                                                                </td>';

                                                                echo'<td>
                                                                <a type="button" class="btn btn-success" href="edit_museai.php?id=' . $post["idmuseai"] . '">Edit</a>
                                                                </td>';
                                                            }


                                                        if($_SESSION['userRole'] == 3){
                                                                // echo'<td class="pt-3-half">
                                                                // <span class="table-remove"><label type="button" class="btn btn-danger btn-rounded btn-sm my-0">Delete</label></span>
                                                                // </td>';
                                                            }
                                                        else{
                                                                echo'<td>
                                                                    <a type="button" class="btn btn-danger btn-rounded btn-sm my-0" href="museais.php?deletemuseai=true&id= ' . $post["idmuseai"] . '">Delete</a>
                                                                    </td>';
                                                            }

                                                        $atteending = false;
                                                        $username = $db->get_Registration_museais($_SESSION['id']);
                                                        foreach($username as $register){
                                                            if($result['idmuseai'] == $post['idmuseai']){   
                                                            //Delete session
                                                                echo 
                                                                    '<li class="nav-item">
                                                                        <a class="nav-link active" href="museais.php?deleteAttendingmuseai=true&id' .$post["idmuseai"] . '">
                                                                            <span data-feather="home"></span>
                                                                                Stop attending on museai<span class="sr-only">(current)</span>
                                                                        </a>
                                                                    </li>';

                                                                    echo'<span class="table-remove">
                                                                    <a class="nav-link active" href="museais.php?attendmuseai=true&id' .$post["idmuseai"] . '">
                                                                        <span data-feather="home"></span>Stop attending on museai<span class="sr-only">(current)</span>
                                                                    </a>
                                                                    <button type="button" class="btn btn-danger btn-rounded btn-sm my-0">Remove</button></span>';
                                                                $atteending = true;
                                                            } 
                                                        }
                                                echo' </tbody>';
                                                }// close get_museais() 
                                            ?>
                                        </table>
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
