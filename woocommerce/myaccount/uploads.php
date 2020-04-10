<?php define('WP_USE_THEMES', false); ?>
<?php require_once('../../../../../wp-load.php');  ?>
<?php get_header(); ?>


<?php 
	$outputText = '
		<section class="page_404">
			<div class="container">
				<div class="content">
					<article id="post-0" class="post not-found">
						<header class="entry-header">
							<h1 class="entry-title">Your image has been uploaded.</h1>
						</header>
		
						<div class="entry-content">
							<p>You will be redirected in <span id="seconds">5</span> seconds</p>
							<p>Click <a href="/profile">here</a> to skip the wait...</p>
						</div>
					</article>
				</div>
			</div>
		</section>
	';
	
	$errText = '
		<section class="page_404">
			<div class="container">
				<div class="content">
					<article id="post-0" class="post not-found">
						<header class="entry-header">
							<h1 class="entry-title">There was a problem uploading your image.</h1>
						</header>
		
						<div class="entry-content">
							<p>You will be redirected in <span id="seconds">5</span> seconds</p>
							<p>Click <a href="/profile">here</a> to skip the wait...</p>
						</div>
					</article>
				</div>
			</div>
		</section>
	';
?>

<?php
	$target_dir = "uploads/";
	$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
	$uploadOk = 1;
	$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
	// Check if image file is a actual image or fake image
	if(isset($_POST["submit"])) {
	    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
	    if($check !== false) {
	        $uploadOk = 1;
	    } else {
	        $uploadOk = 0;
	    }
	}
	// Check if file already exists
	if (file_exists($target_file)) {
	    $uploadOk = 0;
	}
	// Check file size
	if ($_FILES["fileToUpload"]["size"] > 2000000) {
	    $uploadOk = 0;
	}
	// Allow certain file formats
	if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
	&& $imageFileType != "gif" ) {
	    $uploadOk = 0;
	}
	// Check if $uploadOk is set to 0 by an error
	if ($uploadOk == 0) {
		echo $errText;
		// if everything is ok, try to upload file
	} else {
	    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
	        $profImage = 'http://' . $_SERVER['HTTP_HOST'] . '/wp-content/themes/bishopranch/woocommerce/myaccount/' . $target_file;
	        global $current_user;
			get_currentuserinfo();
			update_field( 'field_546a46ae77036', $profImage, $current_user);
			echo $outputText;
	    } else {
	    	//echo $errText;
	    }
	}
?>

<script type="text/javascript">
	jQuery(document).ready(function($){
		
		var i = 5, 
		timer = setInterval(function(){
			if(i > 0){
				i--;
				var secondsCount = document.getElementById("seconds");
				secondsCount.innerHTML = i.toString();
			}
		}, 1000);
		
		setTimeout(function(){
			window.location.replace("/profile");
		}, 5000);
	});
</script>

<?php get_footer(); ?>