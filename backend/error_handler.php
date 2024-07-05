<?php 
function handle_file_upload_error($errorCode) {
    switch ($errorCode) {
        case UPLOAD_ERR_INI_SIZE:
            // The uploaded file exceeds the upload_max_filesize directive in php.ini
            die('The uploaded file exceeds the maximum size allowed.');
            break;
        case UPLOAD_ERR_FORM_SIZE:
            // The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form
            die('The uploaded file exceeds the maximum size allowed.');
            break;
        case UPLOAD_ERR_PARTIAL:
            // The uploaded file was only partially uploaded
            die('The uploaded file was only partially uploaded.');
            break;
        case UPLOAD_ERR_NO_FILE:
            // No file was uploaded
            die('No file was uploaded.');
            break;
        case UPLOAD_ERR_NO_TMP_DIR:
            // Missing a temporary folder
            die('Missing a temporary folder.');
            break;
        case UPLOAD_ERR_CANT_WRITE:
            // Failed to write file to disk
            die('Failed to write file to disk.');
            break;
        case UPLOAD_ERR_EXTENSION:
            // A PHP extension stopped the file upload
            die('A PHP extension stopped the file upload.');
            break;
        default:
            // Unknown error
            die('An unknown error occurred while uploading the file.');
            break;
    }
}

?>