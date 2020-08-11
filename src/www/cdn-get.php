<?php

$h = $_GET["h"];

$d = "/files/var/cdn";
$name_of_file = "not-existing.txt";

if (($handle = opendir($d))) {
    while (false !== ($item = readdir($handle))) {
        if ($item[0] != ".") {
            if ($h === $item) {
                $name_of_file = file_get_contents($d . "/" . $item . ".name");
                $filename = $d . "/" . $item;
                header("Content-Type: application/octet-stream");
                header("Content-Length: " . filesize($filename));
                header("Content-Disposition: attachment; filename=\"$name_of_file\"");
                $f = fopen($filename, "rb");
                fpassthru($f);
                fclose($f);
                die();
            }
        }
    }
    closedir($handle);
}
