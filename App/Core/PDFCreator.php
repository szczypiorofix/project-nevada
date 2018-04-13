<?php

namespace Core;

use Dompdf\Dompdf;

class PDFCreator {

    private function __construct() {}

    public static function make($content, $title) {
        require(DIR_VENDORS."Dompdf/autoload.inc.php");
        
        $dompdf = new Dompdf();
        $dompdf->loadHtml('<html><head><meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <style>* {font-family: "DejaVu Serif, sans-serif;"}</style></head><body>'.$content.'</body></html>');

        $dompdf->set_option('defaultFont', 'DejaVu Serif');
        $dompdf->set_option('defaultMediaType', 'all');
        $dompdf->set_option('isFontSubsettingEnabled', true);
        $dompdf->setPaper('A4', 'landscape');
        $dompdf->render();
        
        //$filePath = 'pdf/'.$fileName;
        //file_put_contents($filePath, $dompdf->output());

        $fileName = 'article-'.$title.'.pdf';
        $pdf = $dompdf->output();
        
        header('Content-Description: File Transfer');
        header('Content-Type: application/pdf');
        header('Content-Disposition: attachment; filename= '.$fileName);
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: '.strlen($pdf));
        //readfile($fileName);
        echo $pdf;
        exit;
    }
}
