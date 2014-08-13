<?php

require_once('SmartlingUploadClient.php');

$client = new SmartlingUploadClient('Your Smartling projectId here', 'Your Smartling APIKey here');

// See Supported File Types for more details on: https://docs.smartling.com/display/docs/Files+API
$response = $client->uploadFile('yourFile.extension', 'yourFileType');

echo $response;
