<?php

require 'config.php'; 


function get_random_thumbnails(){

	$list_params = [
		'path' => PHOTOS_FOLDER,
		'recursive' => true,
		'include_media_info' => false,
		'include_deleted' => false,
		'include_has_explicit_shared_members' => false,
	];

	$photos = array();

	$folders = get_from_dropbox( $list_params, '/files/list_folder', DROPBOX_TOKEN );

	foreach ($folders->entries as $item)
	{

		$file_as_array = (array) $item;

		if($file_as_array['.tag'] === 'file' && endsWith($file_as_array['path_lower'], '.jpg'))
		{
			array_push($photos, $file_as_array['id']);
		}

	}

	$num_photos = count($photos);
	if($num_photos !== 0)
	{
		$rand_array = array_rand($photos, 10);
		$new_photos = random_photo_select($photos, $rand_array);

		//Create filenames for each of th
		foreach ($new_photos as $key => $value)
		{
			# code...
		}

		//OLD ARRAY RAND
		// $rand_index = array_rand($photos, 1);
		// $rand_photo = $photos[$rand_index];

		// //Create Image from Dropbox Content	
		// header('Content-Type: image/jpeg');
		// $download = download_full_file_dropbox($rand_photo, DROPBOX_TOKEN);
	}
	else
	{
		echo "Sorry no files were found :("; 
	}

	return false;
}




//================ API Functions ================
/** Dropbox uses POST for requests that really should be GET, so we just pass this function through. */
function get_from_dropbox( $params, $endpoint, $access_token ) {
	return send_to_dropbox( $params, $endpoint, $access_token );
}

/** Sends data to Dropbox. */
function send_to_dropbox( $params, $endpoint, $access_token ) {

	$params = json_encode( $params );
	$endpoint = (
		false === strpos( $endpoint, 'dropboxapi.com' ) ?
		'https://api.dropboxapi.com/2' . $endpoint :
		$endpoint
	);
	$headers = [
		'Content-Type: application/json',
		'Content-Length: ' . strlen( $params ),
		'Authorization: Bearer ' . $access_token,
	];

	$ch = curl_init();
	curl_setopt( $ch, CURLOPT_URL, $endpoint );
	curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, 'POST' );
	curl_setopt( $ch, CURLOPT_POSTFIELDS, $params );
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
	curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
	curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers );
	$result = curl_exec( $ch );

	if ( false === $result ) {
		echo "Send To Dropbox CURL function failed....";
		curl_error( $ch ); // Send errors to Slack
		curl_close( $ch );
		exit();
	}

	curl_close( $ch );
	$result = json_decode( $result );

	return $result;

} 

/** Download thumbnail files from Dropbox. */
function download_thumbnails_dropbox(){

}

/** Download full image file from Dropbox. */
function download_full_file_dropbox( $path, $access_token ) {

	$json_path = json_encode(array('path'=>$path));

	$endpoint = 'https://content.dropboxapi.com/2/files/download';
	$headers = [
		'Authorization: Bearer ' . $access_token,
		'Dropbox-API-Arg:' . $json_path
	];

	$ch = curl_init();
	curl_setopt( $ch, CURLOPT_URL, $endpoint );
	curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, 'POST' );
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
	curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
	curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers );
	curl_setopt($ch, CURLOPT_VERBOSE, 0);
	$result = curl_exec( $ch );

	if ( false === $result ) {
		echo "Download From Dropbox CURL function failed";
		curl_error( $ch ); // Send errors to Slack
		curl_close( $ch );
		exit();
	}
	curl_close( $ch );

	return $result;

} // Function download_from_dropbox


//================ Helper Functions ================
function random_photo_select($photos, $random_keys_array){
	$random_select_array = array();

	foreach ($random_keys_array as $key) {
		array_push($random_select_array, $photos[$key]);
	}

	return $random_select_array;
}

function endsWith($haystack, $needle) {
    // search forward starting from end minus needle length characters
    return $needle === "" || (($temp = strlen($haystack) - strlen($needle)) >= 0 && strpos($haystack, $needle, $temp) !== false);
}

