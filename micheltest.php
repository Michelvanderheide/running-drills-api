<?php

require_once 'vendor/autoload.php';

require_once 'config.php';
require_once 'GarantieAppHandler.php';
require_once 'ocr/OcrHandler.php';
require_once 'ocr/TextParser.php';


$handler = new GarantieAppHandler();

//$product = $handler -> getProductById(4);
//$ocrHandler = new OcrHandler();
//$ocrHandler -> startOcrTask($product, "/home/michel/Downloads/20160302_143701.jpg");

$imagePath = '/var/www/html/garantie-app/logs/test.jpg';
$handler -> resizeImage($imagePath);
