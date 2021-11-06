<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Unix Tutorial</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link rel="stylesheet" type="text/css" media="screen" href="assets/css/styles.css" /> -->  
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link rel="shortcut icon" type="image/png" href="assets/img/unixLogoFinal123.png">
</head>
<body>
  <!-- Bootstrap Navigation with custom style overrides -->
<nav class="navbar navbar-expand-lg navbar-light" id="navigation" >
  <a class="navbar-brand" href="index.php"><img src="assets/img/unixLogoFinal.png" width="170" class="d-inline-block align-top" alt=""></a>
  <button class="navbar-toggler" id="custom-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link <?php if($active=='content'){echo 'active';}?>" href="content.php?command=id">Tutorial</a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php if($active=='quiz'){echo 'active';}?>" href="quiz.php">Quiz</a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php if($active=='glossary'){echo 'active';}?>" href="glossary.php">Glossary</a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php if($active=='about'){echo 'active';}?>" href="about.php">About</a>
      </li>
      <li class="nav-item">
        <a class="nav-link <?php if($active=='feedback'){echo 'active';}?>" href="feedback.php">Feedback</a>
      </li>
    </ul>
  </div>
</nav>
