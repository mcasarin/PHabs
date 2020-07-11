<?php
/*
 * Arquivos para chamada da Classe webcam (webcamClass.php)
 */
require_once '../class/webcamClass.php';
$webcamClass=new webcamClass();
echo $webcamClass->showImage();