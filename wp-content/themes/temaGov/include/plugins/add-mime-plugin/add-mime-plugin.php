<?php
// Procedure for adding the mime types and file extensions to WordPress.
function add_allow_upload_extension( $mimes ) {

        $mime_type_values = getEstensioniAccettate();

    foreach ($mime_type_values as $estensione => $mime){

        $mimes[trim($estensione)] = trim(str_replace("　", " ", $mime ));
    }

    return $mimes;
}

// Register the Procedure process to WordPress.

add_filter( 'upload_mimes', 'add_allow_upload_extension');
//

// Exception for WordPress 4.7.1 file contents check system using finfo_file (wp-include/functions.php)
// In case of custom extension in this plugins' setting, the WordPress 4.7.1 file contents check system is always true.
function add_allow_upload_extension_exception( $file, $filename, $mimes ) {

    $ext = $type = $proper_filename = false;
    if(isset($file['ext'])) $ext = $file['ext'];
    if(isset($file['type'])) $ext = $file['type'];
    if(isset($file['proper_filename'])) $ext = $file['proper_filename'];
    if($ext != false && $type != false) return $file;

    list($f_name,$f_ext) = explode(".", $mimes);

        $mime_type_values = getEstensioniAccettate();
    $flag = false;
    foreach ($mime_type_values as $estensione => $mime){

        if(trim($estensione) === $f_ext){
            $ext = $f_ext;
            $type = trim(str_replace("　", " ", $mime));
            $flag = true;
            break;
        }
    }
    if($flag){
        return compact( 'ext', 'type', 'proper_filename' );
    }
    else
        return $file;
}

add_filter( 'wp_check_filetype_and_ext', 'add_allow_upload_extension_exception',10,3);
//
function getEstensioniAccettate(){
    return $estensioniAccettate = [
        'jpe' => 'image/jpeg',
        'jpg' => 'image/jpeg',
        'jpeg' => 'image/jpeg',
        'png' => 'image/png',
        'gif' => 'image/gif',
        'm4b' => 'audio/mpeg',
        'm4a' => 'audio/mpeg',
        'mp3' => 'audio/mpeg',
        'qt' => 'video/quicktime',
        'mov' => 'video/quicktime',
        'avi' => 'video/avi',
        'wmv' => 'video/x-ms-wmv',
        'mid' => 'audio/midi',
        'midi' => 'audio/midi',
        'wav' => 'audio/x-wav',
        'mpeg' => 'video/mpeg',
        'pdf' => 'application/pdf',
        'wie' => 'application/json',
        'xml' => 'application/xml',
        'doc' => 'application/msword',
        'docx' => 'application/msword',
        'zip' => 'application/zip',
        'rar' => 'application/x-rar-compressed',
        'rtf' => 'application/rtf',
        'xlsx' => 'application/msexcel',
        'xls' => 'application/msexcel',
        'pps' => 'application/mspowerpoint',
        'ppt' => 'application/mspowerpoint',
        'ppsx' => 'application/mspowerpoint',
        'pptx' => 'application/mspowerpoint',
        'csv' => 'text/csv',
        'xml' => 'text/xml',
        'dwg' => 'application/acad',
        'odp' => 'application/vnd.oasis.opendocument.presentation',
		'jfif'=> 'image/jpeg',
		'svg' => 'image/svg+xml',
		'p7m' => 'application/pkcs7-mime',
		'webp' => 'image/webp',
    ];
}
