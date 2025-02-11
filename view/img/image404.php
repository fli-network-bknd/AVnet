<?php

include(dirname(__FILE__) . '/image404Raw.php');

// Load configuration
$configFile = dirname(__FILE__) . '/../../videos/configuration.php';
require_once $configFile;
session_write_close();

// Default image settings
$file = 'video-placeholder-gray.png';
$type = 'image/png';

// Fetch requested image URL
$imageURL = !empty($_GET['image']) ? $_GET['image'] : $_SERVER["REQUEST_URI"];

// Handle Thumbnails
if (preg_match('/videos\/(.*\/)?(.*)_thumbs(V2)?.jpg/', $imageURL, $matches)) {
    $video_filename = $matches[2];
    $jpg = Video::getPathToFile("{$video_filename}.jpg");

    if (file_exists($jpg)) {
        $file = $jpg;
        $type = 'image/jpg';

        if (strpos($imageURL, '_thumbsV2') !== false) {
            $imgDestination = "{$global['systemRootPath']}{$imageURL}";
            if(!file_exists($imgDestination)){
                _error_log("Converting thumbnail: {$jpg} to {$imgDestination}");
                convertThumbsIfNotExists($jpg, $imgDestination);
            }
        }
    } else {
        _error_log("Thumbnail image not found: {$imageURL}");
    }
// Handle Roku Images
} elseif (preg_match('/videos\/(.*\/)?(.*)_roku.jpg/', $imageURL, $matches)) {
    $video_filename = $matches[2];
    $jpg = Video::getPathToFile("{$video_filename}.jpg");

    if (file_exists($jpg)) {
        $file = $jpg;
        $type = 'image/jpg';

        if (strpos($imageURL, '_roku') !== false) {
            $rokuDestination = "{$global['systemRootPath']}{$imageURL}";            
            if(!file_exists($rokuDestination)){
                _error_log("Converting for Roku: {$jpg} to {$rokuDestination}");
                convertImageToRoku($jpg, $rokuDestination);
            }
        }

    } else {
        _error_log("Roku image not found: {$imageURL}");
    }

} else {
    _error_log("Unmatched image request: {$imageURL}");
}

// If a 404 image needs to be shown, redirect to it
if ($file === 'video-placeholder-gray.png' && empty($_GET['notFound'])) {
    header("Location: " . getCDN() . "view/img/image404.php?notFound=1");
    exit;
}

// Serve the final image
header("HTTP/1.0 404 Not Found");
header('Content-Type:' . $type);
header('Content-Length: ' . filesize($file));
readfile($file);

?>
