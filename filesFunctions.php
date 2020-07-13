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
    $dirs = array_filter(scandir($_POST["actualDir"]), function($item) {
        return is_dir($_POST["actualDir"] ."/". $item);
    });
    $dirs = array_diff($dirs, array('.', '..'));

    $files = array_filter(scandir($_POST["actualDir"]), function($item) {
        return !is_dir($_POST["actualDir"] ."/". $item);
    });

    $dirs = array_values($dirs);
    $files = array_values($files);

    $content = array(json_encode($dirs),json_encode($files));

    echo json_encode($content);

}

function newFolder() {

}

function renameFile() {

}

function deleteFile() {

}

?>