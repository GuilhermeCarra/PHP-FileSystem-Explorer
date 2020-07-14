<?php

switch ($_POST['operation']) {
    case 'showFolder':
        showFolder();
        break;
    case 'newFolder':
        newFolder();
        break;
    case 'rename':
        renameFile();
        break;
    case 'delete':
        deleteFile();
        break;
}

function showFolder() {

    // Getting all folders names
    $dirs = array_filter(scandir($_POST["actualDir"]), function($item) {
        return is_dir($_POST["actualDir"] ."/". $item);
    });
    $dirs = array_diff($dirs, array('.', '..'));


    // Getting all files names
    $files = array_filter(scandir($_POST["actualDir"]), function($item) {
        return !is_dir($_POST["actualDir"] ."/". $item);
    });

    // Getting all files sizes
    $filesSize = array();
    $filesArray = scandir($_POST["actualDir"]);
    foreach($filesArray as $item) {
        if (!is_dir($_POST["actualDir"] ."/". $item)){
            $bytes = filesize($_POST["actualDir"].$item);
            $filesSize[] = bytesConvert($bytes);
        }
    }

    // Reorder arrays values
    $dirs = array_values($dirs);
    $files = array_values($files);
    $filesSize = array_values($filesSize);

    $content = array(json_encode($dirs),json_encode($files),json_encode($filesSize));

    echo json_encode($content);

}

function newFolder() {
    $path = $_POST["actualDir"] . $_POST["folderName"];;
    mkdir($path);
}

function renameFile() {

}

function deleteFile() {

}

function bytesConvert($bytes) {
    if ($bytes >= 1073741824) {
        $bytes = number_format($bytes / 1073741824, 2) . ' GB';
    }
    elseif ($bytes >= 1048576) {
        $bytes = number_format($bytes / 1048576, 2) . ' MB';
    }
    else {
        $bytes = number_format($bytes / 1024, 2) . ' KB';
    }
    return $bytes;
}

?>