<?php
/**
 * Created by PhpStorm.
 * User: MAZK
 * Date: 2022-05-26
 * Time: 7:36 AM
 */

namespace App\helper ;

use App\Models\SettingModel;
use App\Models\TypesModel;
use TCPDF;

class CustomPDFApp extends TCPDF
{
    public $reportTitle = '';
    public $reportNo = '';
    public $reportDate = '';

    public function Header()
    {

        /*$path2 = public_path('cp'); // upload directory
        $fontname = \TCPDF_FONTS::addTTFfont($path2 . '/fonts/Janna.ttf', 'TrueTypeUnicode', '', '32');
        $this->SetFont($fontname, '', 8, '', false);
        // Logo
        $image_file = 'cp/images/logo-1.png';
        $this->Image($image_file,'' ,'' , 40, '', 'PNG', '', 'R', true,100, '', false, false, 0, false, false, false);

        $this->Cell(0, 15,$this->reportTitle, 0, false, 'C', 0, '', 0, false, 'M', 'M');
        $this->Cell(0, 15,$this->reportDate, 0, false, 'L', 0, '', 0, false, 'M', 'M');*/
        $path2 = public_path('cp'); // upload directory
        $fontname = \TCPDF_FONTS::addTTFfont($path2 . '/fonts/JannaBold.ttf', 'TrueTypeUnicode', '', '32');
        $this->SetFont($fontname, '', 10, '', false);
        $hospital = $this->hospital;
        $sick_fund = $this->sick_fund;

        $html = '';
        $html = $html;
        $this->writeHTML($html, true, false, false, false, '');
    }

    // Page footer
    public function Footer()
    {
        $path2 = public_path('cp'); // upload directory
        $fontname = \TCPDF_FONTS::addTTFfont($path2 . '/fonts/JannaBold.ttf', 'TrueTypeUnicode', '', '32');
        $this->SetFont($fontname, '', 9, '', false);

        $html = '';

        $this->writeHTML($html, true, false, false, false, '');


    }

}
