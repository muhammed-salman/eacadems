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
*   Created On: 26 May, 2015
*   Author: MUhammed Salman Shamsi
*//*
require_once 'functions/header.php';
     if($loggedin)
     {  
echo <<<_END
        
        <form method="post" action="attm.php">
        <center>
        <table cellspacing="10" cellpadding="4" border="0" bgcolor="#00eeee">
            <th colspan="2" align="center">Students Selection</th>
            <tr>
              <td>Select Year</td>
              <td><select name="fatyear" id="fatyear" class="teachyear" size="1" required>
                    <option value="">-----</option>
_END;
                        loadTeachesYear();
echo <<<_END
                  </select><br><br>
              </td>
            </tr>
            <tr>
                <td>Select Subject</td>
                <td><select name="fatsub" id="fatsub" class="teachsub" size="1" required>
                    <option value="">-----</option>
                </td>
            </tr>
            <tr>
              <td>Select Department</td>
              <td><select name="fatdept" id="fatdept" size="1" required>
                    <option value="">-----</option>
_END;
                    loadDept();
echo <<<_END
                  </select><br><br>
              </td>
            </tr>
            <tr>
                <td align="center" colspan="2"><input type="submit" class="button" value="Load"></td>
            </tr>
                    
           </table>
_END;

         echo '<input type="hidden" name="ffac_id" id="ffac_id" value="'.$_SESSION['fac_id'].'">';
     }
     else echo'<br><br>Please sign up and/or login to use the system';

require_once 'functions/footer.php';*/
header("Refresh: 0; url=index.php");
?>


