<?php
session_start();
$hostname = session_id();
$filename =  $hostname."-".time().'.jpeg';
$filepath = '../webcamImage/';
if(!is_dir($filepath))
mkdir($filepath);
if(isset($_FILES['webcam'])){
move_uploaded_file($_FILES['webcam']['tmp_name'], $filepath.$filename);

echo $filepath.$filename;
}