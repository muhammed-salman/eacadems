<?php

/*                                             License
*   The following license governs the use of CollegeERP in academic and educational environments. Commercial use requires a commercial license from Muhammed Salman Shamsi.
*   ACADEMIC PUBLIC LICENSE
*   Copyright (C) 2014 - 2015  Muhammed Salman Shamsi.
*   FOR DETAILED TERMS AND CONDITION SEE LICENSE.TXT FILE
*   NO WARRANTY
*   BECAUSE THE PROGRAM IS LICENSED FREE OF CHARGE, THERE IS NO WARRANTY FOR THE PROGRAM, TO THE EXTENT PERMITTED BY APPLICABLE LAW. EXCEPT WHEN OTHERWISE STATED IN WRITING THE COPYRIGHT HOLDERS AND/OR OTHER PARTIES PROVIDE THE PROGRAM "AS IS" WITHOUT WARRANTY OF ANY KIND, EITHER EXPRESSED OR IMPLIED, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE. THE ENTIRE RISK AS TO THE QUALITY AND PERFORMANCE OF THE PROGRAM IS WITH YOU. SHOULD THE PROGRAM PROVE DEFECTIVE, YOU ASSUME THE COST OF ALL NECESSARY SERVICING, REPAIR OR CORRECTION.
*   IN NO EVENT UNLESS REQUIRED BY APPLICABLE LAW OR AGREED ON IN WRITING WILL ANY COPYRIGHT HOLDER, OR ANY OTHER PARTY WHO MAY MODIFY AND/OR REDISTRIBUTE THE PROGRAM AS PERMITTED ABOVE, BE LIABLE TO YOU FOR DAMAGES, INCLUDING ANY GENERAL, SPECIAL, INCIDENTAL OR CONSEQUENTIAL DAMAGES ARISING OUT OF THE USE OR INABILITY TO USE THE PROGRAM INCLUDING BUT NOT LIMITED TO LOSS OF DATA OR DATA BEING RENDERED INACCURATE OR LOSSES SUSTAINED BY YOU OR THIRD PARTIES OR A FAILURE OF THE PROGRAM TO OPERATE WITH ANY OTHER PROGRAMS), EVEN IF SUCH HOLDER OR OTHER PARTY HAS BEEN ADVISED OF THE POSSIBILITY OF SUCH DAMAGES.
*   END OF TERMS AND CONDITIONS
*   [license text: http://www.omnetpp.org/intro/license]   
*   Created On: 19 Jun, 2015, 11:48:21 AM
*   Author: Muhammed Salman Shamsi
*/

require_once 'functions/functions.php';

echo "<script src='jquery/jquery-1.11.2.js'></script>".
     "<script src='jquery/jquery-ui-1.11.4/jquery-ui.js'></script>".
     "<script src='scripts/assigndependent.js'></script>".
     "<script src='scripts/validate_functions.js'></script>".
     "<script src='scripts/validate.js'></script>".
     "<script src='scripts/misc.js'></script>".
     "<link rel='stylesheet' href='jquery/jquery-ui-themes-1.11.4/themes/smoothness/jquery-ui.css' type='text/css' />".   
    
     "<script>$(function() { $('.datepicker').datepicker({"
        ."      dateFormat    : 'dd/mm/yy',"
        ."      changeMonth: true,"
        ."      changeYear: true,"
        . "     yearRange:  '-30:+0'"
       // . "     yearRange:  '1985:'+(new Date).getFullYear()"
        //."      format     : 'yy/mm/dd'"
        . "});});</script>";
 echo '<script>$(function(){$("#datepicker").datepicker();});</script>';
 echo '</div>';
$checkmark='<span class="checkmark"><div class="checkmark_circle"></div><div class="checkmark_stem"></div>
    <div class="checkmark_kick"></div></span>';