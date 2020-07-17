<?php

if(isset($_FILES['file'])) $_POST['operation'] = "upload";

switch ($_POST['operation']) {
    case 'showFolder':
        showFolder();
        break;
    case 'viewFile':
        viewFile();
        break;
    case 'newFolder':
        newFolder();
        break;
    case 'renameFile':
        renameFile();
        break;
    case 'removeFile':
        removeFile();
        break;
    case 'cutFile':
        cutFile();
        break;
    case 'pasteFile':
        pasteFile();
        break;
    case 'search':
        search();
        break;
    case 'readCSV':
        readCSV();
        break;
    case 'upload':
        upload();
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

function viewFile() {
    $file = $_POST["file"];
    $name = basename($file);
    $size = bytesConvert(filesize($file));
    $modified = date("F d Y H:i", filemtime($file));
    $created = date("F d Y H:i", filectime($file));
    $type = filetype($file);
    $fileInfo = array("name"=>$name, "size"=>$size, "type"=>$type, "created"=>$created, "modified"=>$modified);
    $fileInfoJSON = json_encode($fileInfo);
    echo $fileInfoJSON;
}

function newFolder() {
    $path = $_POST["actualDir"] . $_POST["folderName"];;
    mkdir($path);
}

function renameFile() {
    $path = pathinfo($_POST['name']);
    if (!is_dir($_POST['name'])) {
        $newFileName = $path['dirname']."/".$_POST['newName'].".".$path['extension'];
    } else {
        $newFileName = $path['dirname']."/".$_POST['newName'];
    }
    rename($_POST['name'], $newFileName);
}

function removeFile() {
    $path = pathinfo($_POST['name']);
    if ($path['dirname'] == 'Trash') {
        if (is_dir($_POST['name'])){
            rmdir($_POST['name']);
        } else {
            unlink($_POST['name']);
        }
    } else {
        $basename = basename($_POST['name']);
        rename($_POST['name'], 'Trash/'.$basename);
    }
}

function cutFile() {
    mkdir("Cutted/");
    $basename = basename($_POST['name']);
    rename($_POST['name'], 'Cutted/'.$basename);
}

function pasteFile() {
    $path = pathinfo($_POST['name']);
    $cuttedFile = scandir("Cutted/")[2];
    rename('Cutted/'.$cuttedFile, $path['dirname']."/".$cuttedFile);
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

function search() {
    $dir = 'Root/';
    $dirs = array();
    $files = array();
    $filesSize = array();
    $searchWord = strtolower($_POST['searchWord']);
    $allFiles = new RecursiveDirectoryIterator($dir);
    foreach(new RecursiveIteratorIterator($allFiles) as $file) {
        if (is_dir($file)) {
            $folder = str_replace(".", "", $file);
            $actualFile = strtolower(basename($folder));
        } else {
            $actualFile = strtolower(basename($file));
        }
        if(strpos($actualFile, $searchWord) !== false) {
            if (is_dir($file)) {
                $dirs[] = str_replace(".", "", $file);
            } else {
                $files[] = $file->getPathname();
                $filesSize[] = bytesConvert(filesize($file));
            }
        }
    }
    $dirs = array_unique($dirs);
    $dirs = array_values($dirs);
    $files = array_values($files);
    $filesSize = array_values($filesSize);

    $content = array(json_encode($dirs),json_encode($files),json_encode($filesSize));

    echo json_encode($content);
}

function readCSV() {
    $handle = fopen($_POST['file'], "r");
    $printedCSV = "";
    while (($data = fgetcsv($handle, 0, ",")) !== FALSE) {
        $printedCSV .= "<tr>";
        foreach($data as $td) {
            $printedCSV .= "<td>";
            $printedCSV .= $td;
            $printedCSV .= "</td>";
        }
        $printedCSV .= "</tr>";
    }
    fclose($handle);
    echo $printedCSV;
}

function upload() {
    /* Getting file name */
    $filename = $_FILES['file']['name'];

    /* Location */
    $location = $_GET['actualDir'].$filename;
    move_uploaded_file($_FILES['file']['tmp_name'], $location);
}

?>