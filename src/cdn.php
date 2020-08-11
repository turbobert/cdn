<h1>Upload Drag/Drop Max 250 MB</h1>
<form enctype="multipart/form-data" method="POST" >
    <span style="display: none;" id="pleasewait">Please wait...</span>
    <input name="cdn_upload" onchange="document.getElementById('pleasewait').style.display = 'block'; this.style.display = 'none'; submit();" type="file" style="margin-left: 5%; margin-right: 5%; padding: 10px; border: 2px red dashed; width:90%; height:70%; background: white;" />
    <!-- <input type="submit" style="margin: 10px;" /> -->
</form>

<?php

//Array
//(
//    [cdn_upload] => Array
//        (
//            [name] => logo.png
//            [type] => image/png
//            [tmp_name] => /tmp/phpAxeSSq
//            [error] => 0
//            [size] => 270891
//        )
//
//)
//FILES


if (array_key_exists("cdn_upload", $_FILES)) {
    $f = $_FILES["cdn_upload"];
    $n = $f["name"];
    $h = hash_file("sha256", $f["tmp_name"]);
    $cdn_filename = "/files/var/cdn/" . $h;
    move_uploaded_file($f["tmp_name"], $cdn_filename);
    $fh = fopen($cdn_filename . ".name", "w");
    fwrite($fh, $f["name"]);
    fclose($fh);
    echo "Upload <code>$n</code> successful as <code>$h</code>.<br>\n";
    echo "<a href='https://192.168.178.31/cdn-get.php?h=$h'>link</a>\n";
    echo "<input type=button onclick=\"navigator.clipboard.writeText('https://192.168.178.31/cdn-get.php?h=$h');\" value=\"COPY\" style=\"padding: 10px;\" />\n";
}
