<?php
require_once '../../vendor/autoload.php';

function exportPDF ($string_html, $type, $location){

    $current_date = date("YmdHms");
    define('FILE_PATH' , $_SERVER['DOCUMENT_ROOT']."/B7TPMAPI/apis/".$type."/generatedfile/");
    $name = $type.'_generated_'.$current_date.'.pdf';
    $mpdf = new \Mpdf\Mpdf();
    $mpdf->WriteHTML($string_html);
    $mpdf->Output(FILE_PATH.$name, 'F');
    return $name;
    // echo FILE_PATH;
}