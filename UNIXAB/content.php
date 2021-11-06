<?php 
    $active = "content";
    include('header.php');
    include('sqlconnection.php');
    if(isset($_GET['command'])){
        $stmt = $conn->prepare("SELECT * FROM  Content WHERE command = ?;");
        $stmt->bind_param("s", $_GET['command']);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $stmt->close();
    }else{
        echo '<script> window.location.replace("error.php");</script>';
    }
?>

<div id="content" class="container">
    <div class="text-center">
        <h3><?php echo $row['section'];?></h3>
        <h3><?php echo $row['title'];?></h3>
    </div>
    <div class="row">
        <div class="col-md-6">
        <h4>Command Description</h4>    
            <div class="box">    
                <p><?php echo $row['description'];?></p>
            </div>
            <h4>Command Options</h4>
            <div class="box">
                <?php echo $row['options'];?>
            </div>
            <div class="text-center">
                <a class="btn btn-dark" href="glossary.php">Learn more!</a>
            </div>
        </div> 
        <div class="col-md-6">
            <h4>Motivation!</h4>
            <div>
                <figure>
                    <img src="assets/img/cat.jpg" alt="Hang in there!"/>
                    <figcaption> It gets tough sometimes but you can do it!</figcaption>
                </figure>
            </div>
        </div>
    </div>
</div>

<?php include('footer.php');?>