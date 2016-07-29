<!DOCUMENT html5>
<!--WORKFLOW 
    Version 0.1 | July 26 2016
    
    Development: Bruce Cantarim | UX/UI Designer & Full-stack Developer
    Github: http://github.com/brucecantarim
    Email: bruce@cantarim.com 
    
    Notes for upcoming versions:
    - Change bootstrap structure to flexbox
    - Move all functions to functions.php, to clean the html5
    - Move all configurable variables to config.php
    - Make the script configurable (projects, tasks, lists, file types, modules)
    - Create config.php UI
    - Create admin.php UI and add comment function
    - Add SQL option
    - Create user login and hierarchy
    - Create project invite and notification system
-->
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="content-language" content="pt-br">
<meta charset="UTF-8">
<html lang="pt-br">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootswatch/3.3.6/paper/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.min.css" type="text/css">
</head>
<body>
<?php include("config.php"); ?>
<?php include("functions.php"); ?>

<div class="jumbotron">
    <div class="row">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center bg-primary">
            <?php
            // App title
            print "<h1 class='text-primary animated bounceIn' style='color:white;'>WORKFLOW <i class='glyphicon glyphicon-ok'></i></h1><br/>";
            ?>
       </div>
    </div>
</div>

<div class="container">
<?php the_checklist(); ?>
        </div>
        <div>
            <br/><br/><br/>
        </div>
    </div>
</div>

<div class="navbar navbar-fixed-bottom animated slideInUp" style="background-color:whitesmoke;">
    <div class="container-fluid">
        <div class="navbar-nav navbar-right">
            <p class="navbar-text"><a href="http://github.com/brucecantarim"><strong>WORKFLOW</strong></a> - <a href="tel:+4195708767"><i class="glyphicon glyphicon-earphone"></i> 41 9570-8767</a> - <a href="mailto:bruce@cantarim.com"><i class="glyphicon glyphicon-envelope"></i> Email: bruce@cantarim.com</a></p>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.1.0.min.js"   integrity="sha256-cCueBR6CsyA4/9szpPfrX3s49M9vUU5BgtiJj06wt/s="   crossorigin="anonymous"></script>
<script   src="https://code.jquery.com/ui/1.12.0/jquery-ui.min.js"   integrity="sha256-eGE6blurk5sHj+rmkfsGYeKyZx3M4bG+ZlFyA7Kns7E="   crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" type="text/javascript"></script>
</body>