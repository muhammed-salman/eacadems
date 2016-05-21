<?php

/*                                             License
*   The following license governs the use of Eacadems in academic and educational environments. Commercial use requires a commercial license from Muhammed Salman Shamsi.
*   ACADEMIC PUBLIC LICENSE
*   Copyright (C) 2014 - 2015  Muhammed Salman Shamsi.
*   FOR DETAILED TERMS AND CONDITION SEE LICENSE.TXT FILE
*   NO WARRANTY
*   BECAUSE THE PROGRAM IS LICENSED FREE OF CHARGE, THERE IS NO WARRANTY FOR THE PROGRAM, TO THE EXTENT PERMITTED BY APPLICABLE LAW. EXCEPT WHEN OTHERWISE STATED IN WRITING THE COPYRIGHT HOLDERS AND/OR OTHER PARTIES PROVIDE THE PROGRAM "AS IS" WITHOUT WARRANTY OF ANY KIND, EITHER EXPRESSED OR IMPLIED, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE. THE ENTIRE RISK AS TO THE QUALITY AND PERFORMANCE OF THE PROGRAM IS WITH YOU. SHOULD THE PROGRAM PROVE DEFECTIVE, YOU ASSUME THE COST OF ALL NECESSARY SERVICING, REPAIR OR CORRECTION.
*   IN NO EVENT UNLESS REQUIRED BY APPLICABLE LAW OR AGREED ON IN WRITING WILL ANY COPYRIGHT HOLDER, OR ANY OTHER PARTY WHO MAY MODIFY AND/OR REDISTRIBUTE THE PROGRAM AS PERMITTED ABOVE, BE LIABLE TO YOU FOR DAMAGES, INCLUDING ANY GENERAL, SPECIAL, INCIDENTAL OR CONSEQUENTIAL DAMAGES ARISING OUT OF THE USE OR INABILITY TO USE THE PROGRAM INCLUDING BUT NOT LIMITED TO LOSS OF DATA OR DATA BEING RENDERED INACCURATE OR LOSSES SUSTAINED BY YOU OR THIRD PARTIES OR A FAILURE OF THE PROGRAM TO OPERATE WITH ANY OTHER PROGRAMS), EVEN IF SUCH HOLDER OR OTHER PARTY HAS BEEN ADVISED OF THE POSSIBILITY OF SUCH DAMAGES.
*   END OF TERMS AND CONDITIONS
*   [license text: http://www.omnetpp.org/intro/license]   
*   Author: Muhammed Salman Shamsi
*/

include('../mpdf/mpdf.php');
if($_POST)
{    
    
    if(isset($_POST['page'])&& isset($_POST['filename'])&& isset($_POST['orientation'])&& isset($_POST['style'])){
        $page=$_POST['page'];
        $orient=$_POST['orientation'];
        $filename=$_POST['filename'];
        $style=$_POST['style'];
        $mpdf=new mPDF('c','A4-'.$orient."'");
        $mpdf->showImageErrors = true;
        if($style==1){
            $stylesheet = file_get_contents('style/pdfstyle.css');
            $mpdf->WriteHTML($stylesheet,1);
        }
        if($style==2){
            $stylesheet = file_get_contents('style/pdfstyle2.css');
            $mpdf->WriteHTML($stylesheet,1);
        }
        if($style==3){
            $stylesheet = file_get_contents('style/pdfstyle3.css');
            $mpdf->WriteHTML($stylesheet,1);
        }
        if($style==4){
            $stylesheet = file_get_contents('style/pdfstyle4.css');
            $mpdf->WriteHTML($stylesheet,1);
        }
        $mpdf->WriteHTML($page,2);
        $mpdf->debug=true;
        $mpdf->Output($filename.".pdf",'I');
        exit;
    }
}

?>