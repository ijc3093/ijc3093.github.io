<?php 
    $active = "feedback";
    include('header.php');
    include('sqlconnection.php');
?>


<div id="content" class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <h3>Let us know how we can improve!</h3>   
            <?php
                if(isset($_POST['name'])){
                    if($_POST['name']=="" && $_POST['feedback']==""){
                    echo '<p style="color:red;"> Name and Feedback are both required fields</p>';
                    }else{
                        $stmt = $conn->prepare("INSERT INTO Feedback (name, feedback) VALUES (?,?);");
                        $stmt->bind_param("ss", $_POST['name'], $_POST['feedback']);
                        $stmt->execute();
                        $stmt->close();
                        echo '<p style="color:green;"> Thank you for your feedback!</p>';
                    }
                }
            ?> 
            <form action="" method="post">
                Name:<br>
                <input type="text" name="name"><br><br>
                Feedback:<br>
                <textarea placeholder="Remember, be nice!" rows="6" cols="55" name="feedback"></textarea>
                <button type="submit" value="submit">Submit</button>
            </form>
        </div> 
    </div>
</div>
<?php include('footer.php');?>