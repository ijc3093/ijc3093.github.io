<?php
    $active = "index";
    include('header.php');
?>
<div class="container" id="content">
    <div class="row justify-content-center">
        <div class="col-md-6">    
            <div class="text-center">
                <h3>Welcome to Artificial Bricks! </h3>    
            </div>    
            <div class="box"> 
                <p>
                We're glad you found our site, Our goal is to provide beginner and intermediate Unix users with a complete resource for all your Unix needs, 
                suggestions help make this site better, so let us head from you!<br/>
                Now let's get started!     
                </p>
            </div>
            <div class="text-center">
                <a class="btn btn-dark" href="content.php?command=cd">Start Tutorial!</a>
            </div>
        </div>    
    </div>
</div>
<?php include('footer.php');?>