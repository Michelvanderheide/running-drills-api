<?php

header ('Content-Type: application/json');

// CORS
header("Access-Control-Allow-Origin: *");
 
error_reporting(E_ALL);
ini_set('display_errors', 'On');


require_once '../vendor/autoload.php';
require_once '../config.php';
require_once '../GarantieAppHandler.php';
require_once '../ocr/OcrHandler.php';
require_once '../ocr/TextParser.php';
require_once '../Middleware/AuthMiddleware.php';
require_once '../common/common.php';


use Propel\Runtime\Propel;
$textHandler = new TextParser();

//var_dump("SLBTOTAAL")

$text = '﻿AlecticMAIarkt                                           
                                                         
MEDIA MARKT HENGELD                                      
               Het Plein 130                             
              7559 SR Hengelo                            
  ELKE WERKDAG GEOPEND VAN 10:00 - 22.00                 
              ZA 9.00 - 20.00                            
                                                         
40977676                                                 
Contante verkoop Boeking                                 
 3480.1388457                                            
 TRU.20719 WMS-111 WL    12,99 b                         
 380.1429187                                             
 LEN.100 15 IBD    394,76 b                              
 THUISKOPIEHEFFING    4,24 b                             
 Prijs Incl.heffing    399,00 b                          
                                                         
                                                         
Totaal EUR    411,99                                     
                                                         
                                                         
                                                         
                                                         
                        PASH0UDERB0N                     
                                                         
                                                         
                        Kassanr:              492T02     
                        Winkel:               1890014    
                          i i        __i      fiim       
';





//var_dump(preg_match('/[ti\1][o0][ti\1]aa[l\1i]/i', 'totaal'));

var_dump($textHandler -> parseText($text));
exit;

$handler = new GarantieAppHandler();
$ocrHandler = new OcrHandler();

$handler -> dossier = $handler -> getDossierById(1);



$products = $handler -> getProducts(array("DossierPk" => $handler -> dossier -> getDossierPk()));
exit;

$product = $handler -> getProductById(2);
$filePath = $handler -> getAssetPath($product, "receipt");
$filePath = '/var/www/html/garantie-app/receipt.png';


var_dump($ocrHandler -> startOcrTask($product, $filePath));

//$ocrHandler -> ocrTask = $ocrHandler -> getOcrTaskById(9);
//var_dump($ocrHandler -> parseOcrText($product));

echo "Done";