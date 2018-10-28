<?php
// convert base64 to bytes see wiki about base64 or rfc :)
$data = explode(',', $_POST['dataUrl']);
$b64 = end($data);
$decoded = "";
for ($i=0; $i < ceil(strlen($b64)/256); $i++) {
    $decoded = $decoded . base64_decode(substr($b64,$i*256,256));
}


$uploadfile = 'screenshot_unique_filename.png';
$fp = fopen($uploadfile, 'w');
fwrite($fp, $decoded);
fclose($fp);

header("Content-type:application/json");

echo json_encode(["src" => '/'.$uploadfile]);
exit(0);

