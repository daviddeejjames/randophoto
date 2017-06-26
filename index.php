<?php 
	//
	// Randophoto Main Page
	//
	$verison_number = 'v1.0.1';
	
	require 'functions.php';

 ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Randophoto</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="dist/css/styles.css?=<?php echo $verison_number; ?>">
    <meta name="theme-color" content="#121212">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="randophoto-page">
	<div class="container">
		<a class="header-link" href="/randophoto">
			<h1 class="page-title text-center">Randophoto</h1>
		</a>
		<div class="loading-content">
			<div class="info-wrap">
				<?php  
					echo "We are choosing <strong>" . NUMBER_OF_PHOTOS . "</strong> photos from within your Dropbox... please wait."
				?>
			</div>
			<div class="loader"></div>
		</div>
		<?php  
			$photos = get_random_thumbnails();

			if($photos)
			{
		?>
				<div class="photos-wrap">
					<?php  
						foreach($photos as $image)
						{
					?>
							<a href="<?php echo $image; ?>" target="_blank" class="image-link col-md-4">
								<div class="image" style="background-image: url('<?php echo $image; ?>');"></div>
							</a>
					<?php
						}
					?>
				</div>
		<?php
			}
			else
			{
		?>
				<p class="alert alert-danger text-center">Sorry we couldn't get any photos for you :<</p>
		<?php
			}
		?>
	</div>
	
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script src="dist/js/scripts.js?=<?php echo $verison_number; ?>"></script>
  </body>
</html>