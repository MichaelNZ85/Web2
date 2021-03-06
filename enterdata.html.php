<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Enter Exercise Data | ExerTracker</title>
    
    <!-- core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet">
    <link href="css/animate.min.css" rel="stylesheet">
    <link href="css/main.css" rel="stylesheet">
    <link href="css/responsive.css" rel="stylesheet">
    
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="shortcut icon" href="images/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="images/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="images/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="images/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="images/ico/apple-touch-icon-57-precomposed.png">
	
	<!-- Date picker code -->
	<link rel="stylesheet" type="text/css" href="css/datepicker.css" />
	<script type="text/javascript" src="js/datepicker.js"></script>
	
	
</head><!--/head-->

<body>

    <header id="header">

        <nav class="navbar navbar-inverse" role="banner">
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <a class="navbar-brand" href="index.html"><img src="images/logo.png" alt="logo"></a>
                </div>
                
                <div class="collapse navbar-collapse navbar-right">
                    <ul class="nav navbar-nav">
                        <li><a href="home.php">Home</a></li>
                        <li class="active"><a href="enterdata.php">Enter Data</a></li>
                        <li><a href="setnewtarget.php">Set New Target</a></li>
                        <li><a href="userdata.php">User Data</a></li>
						<li><a href="userstats.php">User Stats</a></li>
                        <li><a href="calendar.php">Calendar</a></li>
						  <li><a href="comparativestats.php">Comparative Stats</a></li>
                    </ul>
                </div>
            </div><!--/.container-->
        </nav><!--/nav-->
        
    </header><!--/header-->

    <section id="feature" class="transparent-bg">
        <div class="container">
           <div class="center wow fadeInDown">
                <h2>Enter Data</h2>
                
				<?php
					$self = htmlentities($_SERVER['PHP_SELF']);
					echo "<form action='$self' method='POST'>";
				?>
					<table>
						<tr>
							<td>Date:</td><td><input type='text' name='date' id='date' class='datepicker' size='20'></td>
						</tr>
						<tr>
							<td>Type:</td><td><select name='type'>
							<option value='allTypes'>Type of Exercise</option>
							<?php
								foreach($exType as $row)
								{
									echo "<option value=\"$row[exerciseTypeId]\">$row[name]</option>";
								}
							?>	
							</select></td>
						</tr>
						<tr>
							<td colspan="2"><a href='addnewex.php'>Add New Exercise Type</a></td>
						</tr>
						<tr>
							<td>Duration (minutes):</td><td><input type='text' name='duration' placeholder='Duration' size='20'></td>
						</tr>
						<tr>
							<td></td><td><input type='submit' name='enterData' value='Enter Data'></td>
						</tr>
					</table>
				</form>
			
				
            </div><!--/.get-started-->
        </div><!--/.container-->
    </section><!--/#feature-->

    <footer id="footer" class="midnight-blue">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    &copy; 2013 <a target="_blank" href="http://shapebootstrap.net/" title="Free Twitter Bootstrap WordPress Themes and HTML templates">ShapeBootstrap</a>. All Rights Reserved. Website &copy; by Michael Inglis</p>
                </div>
            </div>
        </div>
    </footer><!--/#footer-->

    <script src="js/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/jquery.isotope.min.js"></script>
    <script src="js/main.js"></script>
    <script src="js/wow.min.js"></script>
</body>
</html>