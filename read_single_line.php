<!DOCTYPE html>
<html>
<body>

<?php
$myfile = fopen("webdictionary.txt", "r") or die("Unable to open file!");
while(!feof($myfile)){
//echo fgets($myfile)."<br>"; อ่านเป็นบรรทัด
echo fgetc($myfile)."<br>"; //อ่านทีละบรรทัด
}
fclose($myfile);
?>

</body>
</html>