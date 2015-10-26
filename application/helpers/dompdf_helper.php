<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
function pdf_create($html, $filename='', $stream=TRUE) 
{
    require_once("dompdf/dompdf_config.inc.php");

    $dompdf = new DOMPDF();
    $dompdf->load_html($html);
    $dompdf->render();
    if ($stream) {
        //$dompdf->stream($filename.".pdf");
        echo $dompdf->stream($filename.".pdf",array("Attachment" => false));
    } else {
        return $dompdf->output();
        
    }
}
function pdf_legal($html, $filename='', $stream=TRUE) 
{
    require_once("dompdf/dompdf_config.inc.php");

    $dompdf = new DOMPDF();
    $dompdf->set_paper("Legal", "portrait");
    $dompdf->load_html($html);
    $dompdf->render();
    if ($stream) {
        //$dompdf->stream($filename.".pdf");
        echo $dompdf->stream($filename.".pdf",array("Attachment" => false));
    } else {
        return $dompdf->output();
        
    }
}
?>