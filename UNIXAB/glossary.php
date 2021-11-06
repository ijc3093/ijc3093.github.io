<?php 
    $active = "glossary";
    include('header.php');
?>
<div id="content" class="container">
    <h2>Glossary </h2>  
    <h3>Basic Unix Commands</h3>       
    <p>This is a list of the most basic UNIX commands and a brief description of what they do. Knowledge of these commands should help you in navigating your Unix system, verify current status, and manage directories and files.</p>
    <div id="pageContent">
        <h4>User Commands</h4>
        <ul>
            <li>
                <b><a href="content.php?command=id">id</b>&#58;</a>  print user identity
            </li>    
            <li>
                <b><a href="content.php?command=passwd">passwd</b>&#58;</a> change the user&#39;s password
            </li>
            <li>
                <b><a href="content.php?command=who">who</b>&#58;</a> verify the current user who is logged in to the system
            </li>
        </ul>
        <h4>Directory Management</h4>
        <ul>
            <li>
                <b><a href="content.php?command=cd">cd</b>&#58;</a> change directory
            </li>
            <li>
                <b><a href="content.php?command=pwd">pwd</b>&#58;</a> confirm the current directory
            </li>
            <li>
                <b><a href="content.php?command=mkdir">mkdir</b>&#58;</a> make new directory
            </li>
            <li>
                <b><a href="content.php?command=rmdir">rmdir</b>&#58;</a> remove directories from the Unix system
            </li>
        </ul>
        <h4>File Operations</h4>
        <ul>
            <li>
                <b><a href="content.php?command=ls">ls</b>&#58;</a> lists the files and directories
            </li>
            <li>
                <b><a href="content.php?command=cp">cp</b>&#58;</a> copy files
            </li>
            <li>
                <b><a href="content.php?command=rm">rm</b>&#58;</a> remove files and directories
            </li>
            <li>
                <b><a href="content.php?command=mv">mv</b>&#58;</a> move or rename files and directories
            </li>
        </ul>
        <h4>System Status</h4>
        <ul>
            <li>
                <b><a href="content.php?command=hostname">hostname</b>&#58;</a> to display or set the hostname
            </li>    
            <li>
                <b><a href="content.php?command=uptime">uptime</b>&#58;</a> display system uptime
            </li>
            <li>
                <b><a href="content.php?command=uname">uname</b>&#58;</a> printout the Unix system information
            </li>
        </ul>
    </div>
</div>        
<?php include('footer.php');?>