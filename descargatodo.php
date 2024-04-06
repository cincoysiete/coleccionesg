<?php 
session_start(); 

error_reporting(E_ALL);

function ZipBa($desde, $destino){
    if (extension_loaded('zip') === true) {
        if (file_exists($desde) === true) {
            $zip = new ZipArchive();
            if ($zip->open($destino, ZIPARCHIVE::CREATE) === true){
                $desde = realpath($desde);
                if (is_dir($desde) === true){
                    $files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($desde), RecursiveIteratorIterator::SELF_FIRST);
                    foreach ($files as $file){
                        $file = realpath($file); 
                        if (is_dir($file) === true){
                            $zip->addEmptyDir(str_replace($desde . '/', '', $file . '/'));
                        }else if (is_file($file) === true){
                            $zip->addFromString(str_replace($desde . '/', '', $file), file_get_contents($file));
                        }
                    }
                }
                else if (is_file($desde) === true)
                {
                    $zip->addFromString(basename($desde), file_get_contents($desde));
                }
            }
            return $zip->close();
        }
    }
    return false;
}
function full_copy( $source, $target ) {
    if ( is_dir( $source ) ) {
        @mkdir( $target );
        $d = dir( $source );
        while ( FALSE !== ( $entry = $d->read() ) ) {
            if ( $entry == '.' || $entry == '..' ) {
                continue;
            }
            $Entry = $source . '/' . $entry; 
            if ( is_dir( $Entry ) ) {
                full_copy( $Entry, $target . '/' . $entry );
                continue;
            }
            copy( $Entry, $target . '/' . $entry );
        }
 
        $d->close();
    }else {
        copy( $source, $target );
    }
}

mkdir($_SESSION["elusuario"]."/"."datos");
mkdir($_SESSION["elusuario"]."/"."datos/bases");
mkdir($_SESSION["elusuario"]."/"."datos/upload");
mkdir($_SESSION["elusuario"]."/"."datos/backup");
full_copy( $_SESSION["elusuario"]."/"."bases/", $_SESSION["elusuario"]."/"."datos/bases/");
full_copy( $_SESSION["elusuario"]."/"."upload/", $_SESSION["elusuario"]."/"."datos/upload/");
full_copy( $_SESSION["elusuario"]."/"."backup/", $_SESSION["elusuario"]."/"."datos/backup/");
ZipBa($_SESSION["elusuario"]."/".'datos/', $_SESSION["elusuario"]."/"."copia.zip"); 
header("Content-disposition: attachment; filename=".$_SESSION["elusuario"]."/"."copia.zip");
header("Content-type: application/zip");
readfile($_SESSION["elusuario"]."/"."copia.zip");

?>
