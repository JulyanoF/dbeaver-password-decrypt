<?php
if ($_FILES) {
    $filename = md5(microtime()) . '.json';
    if (!move_uploaded_file($_FILES['credentials']['tmp_name'], $filename)) {
        die('Something wrong is not write');
    }
    $command = "openssl aes-128-cbc -d -K babb4a9f774ab853c96c2d653dfe544a -iv 00000000000000000000000000000000 -in {$filename} | dd bs=1 skip=16 2>/dev/null";
    $output  = shell_exec($command);
    unlink($filename);
    $output = json_encode(json_decode($output), JSON_PRETTY_PRINT);
    echo "<textarea rows=\"20\" cols=\"100\">{$output}</textarea>";
}
?>
<div>Attach your credentials-config.json file (path for Windows: %appdata%\DBeaverData\workspace6\General\.dbeaver)
</div>
<form method="POST" enctype="multipart/form-data">
    <input name="credentials" type="file" accept=".json" />
    <div>
        <button>Decrypt</button>
    </div>
</form>