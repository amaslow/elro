<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
include_once('class/tcpdf/tcpdf.php');
include_once("class/PHPJasperXML.inc.php");
include_once ('setting.php');

$PHPJasperXML = new PHPJasperXML();
//$PHPJasperXML->debugsql=TRUE;
$PHPJasperXML->arrayParameter = array(
    "Date" => $_GET['Date'],
    "sapNo" => $_GET['sap']);
$PHPJasperXML->xml_dismantle(simplexml_load_file("DoC.jrxml"));

//$PHPJasperXML->load_xml_file("DoC.jrxml");
$PHPJasperXML->transferDBtoArray($server, $user, $pass, $db);
$PHPJasperXML->outpage("I");    //page output method I:standard output  D:Download file


?>
