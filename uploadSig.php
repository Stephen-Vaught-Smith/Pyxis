<?php

include 'DB.php';
include 'php_image_magician.php';

//Turn off error reporting
ini_set('display_errors', 'Off');

//Function for updating signature file in database
//Code for adding uploaded file to SQL database adapted from http://www.sevenkb.com/php/how-to-insert-upload-image-into-mysql-database-using-php-and-how-to-display-an-image-in-php-from-mysql-database/
function updateSig($signature) {	
	
	$db = new DB();		
	
	//insert newuser
	$userData = array(
		'name' => $_POST['inputName3'],
		'email' => $_POST['inputEmail3'],
		'phone' => $_POST['inputPhone'],
		'password' => $_POST['inputPassword3']
	);
	$insert = $db->insert("users",$userData);	
	
	if($insert){		
		
		//Prepare Update statement
		$stmt = $db->db->prepare("insert into user_signature (Signature, UserID) values (?, ?)");
		 
		//Bind parameters
		$stmt->bindParam(1, $signature, PDO::PARAM_LOB);		
		//echo($_POST['userid']);
		$stmt->bindParam(2, $insert['id']);
		
		//Execute Update statement
		if ($stmt->execute()) {
			echo 'User data has been added successfully.<br/>';
			
		}else{
			echo 'Some problem occurred, please try again.<br/>';
		}
		
	}else{
		echo 'Some problem occurred, please try again.<br/>';
	}
	echo '<a href="createAccount.html" class="btn btn-md btn-primary" role="button">Back</a>';
	
}

//If drawn signature submitted by POST
if (isset($_POST['signature'])) {
	
	//Get the signature binary data -- processing steps adapted from https://github.com/szimek/signature_pad 
	$rawSig = $_POST['signature'];
	$encoded_sig = explode(",", $rawSig)[1];
	$sig = base64_decode($encoded_sig);
	
	//Temp file name
	$tempFilename = 'tempSig.png';
				
	//create image from string
	$image = imagecreatefromstring($sig);
	
	//Correct for .png transparency - adapted from http://stackoverflow.com/questions/11364160/png-black-background-when-upload-and-resize-image
	imagecolortransparent($image, imagecolorallocatealpha($image, 0, 0, 0, 127));
	imagealphablending($image, false);
	imagesavealpha($image, true);
	
	//Save temp image
	imagepng($image, $tempFilename, 0);
	
	//Resize temp image using PHP Image Magician: http://phpimagemagician.jarrodoberto.com/
	$sigFile = new imageLib($tempFilename);
	$sigFile->resizeImage(250, 75, 'portrait');
	$sigFile->saveImage($tempFilename, 100);
		
	//Get the resized temp image's binary data
	$signature = fopen($tempFilename, 'rb');			
						
	//Update the signature in database using function
	updateSig($signature);
	
	//Delete the temp file
	unlink($tempFilename);

}

//Otherwise attempt to process uploaded file
else {

	// File upload and error checking code from chapter 19 of "PHP and MySQL Web Development"
	// by Luke Welling and Laura Thomson
	if ($_FILES['signature']['error'] > 0) {
		echo 'Error: ';
		switch ($_FILES['signature']['error']) {
			case 1: echo 'File exceeded upload_max_filesize';
						break;
			case 2: echo 'File exceeded max_file_size';
						break;
			case 3: echo 'File only partially uploaded';
						break;
			case 4: echo 'No file uploaded';
						break;
			case 6: echo 'Cannot upload file: No temp directory specified';
						break;
			case 7: echo 'Upload failed: Cannot write to disk';
						break;
		}
		exit;
	}

	//Check if file has correct MIME type
	if ($_FILES['signature']['type'] != 'image/png') {
		echo 'Error: Incorrect file type. Must be a .png file.';
		exit;
	}

	if (is_uploaded_file ($_FILES['signature']['tmp_name'])) {
							
		//Temp file name
		$tempFilename = 'tempSig.png';
		
		//read binary data from image file
		$imgString = file_get_contents($_FILES['signature']['tmp_name']);
		
		//create image from string
		$image = imagecreatefromstring($imgString);
		
		//Correct for .png transparency - adapted from http://stackoverflow.com/questions/11364160/png-black-background-when-upload-and-resize-image
		imagecolortransparent($image, imagecolorallocatealpha($image, 0, 0, 0, 127));
		imagealphablending($image, false);
		imagesavealpha($image, true);
		
		//Save temp image
		imagepng($image, $tempFilename, 0);
		
		//Resize temp image using PHP Image Magician: http://phpimagemagician.jarrodoberto.com/
		//$sigFile = new imageLib($tempFilename);
		//$sigFile->resizeImage(250, 75, 'portrait');
		//$sigFile->saveImage($tempFilename, 100);
			
		//Get the resized temp image's binary data
		$signature = fopen($tempFilename, 'rb');			
							
		//Update the signature in database using function
		updateSig($signature);
		
		//Delete the temp file
		unlink($tempFilename);
		
	}

	else {
		echo "File not uploaded";
	}
}

?>
