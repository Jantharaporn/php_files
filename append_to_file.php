<?php
/*$filename = "newfile.txt";
$text = "Jantharaporn" . date("Y-m-d H:i:s") . PHP_EOL;

// File_Append = เขียนต่อท้าย
file_put_contents($filename, $text, File_Append);

echo "บันทึกข้อมูลเรียบร้อย";*/


$filename = "newfile.txt";
$text = "Songsin kwamman" . date(" H:i:s") . "\n";

$file = fopen($filename, "a"); // a = appaend
fwrite($file, $text);
fclose($file);

echo "เขียนข้อมูลต่อท้ายไฟล์แล้ว";

?>