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
*   Created On: 24 Jun, 2015, 3:23:08 PM
*   Author: Muhammed Salman Shamsi
*/
require_once 'functions/subheader.php';
    
if($_POST){
    if(isset($_POST['fac_id'])){
$result=  queryMysql("select fp.*,f.*,d.name as dept_name from FacultyProfile fp natural join Faculty f join Department d on d.dept_id=f.dept where fp.fac_id='".$_POST['fac_id']."'");       
echo <<<_END
      <form method="post" id="form1">
        <center>
          <table id="pdfTable" cellspacing="0" cellpadding="2" border="1" bgcolor="transparent">
            <th colspan="5" align="center">Faculty Profile</th>
_END;
$srCount=1;
while ($row= mysql_fetch_array($result)) {
echo <<<_END
            
            <tr>
                <td>$srCount</td>
                <td>Faculty/Staff ID</td>
                <td align="center">$row[fac_id]</td>
                <td align="center" colspan="2" rowspan="4">
_END;
                    displayImage($row[image_id]);
                    $srCount++;
echo <<<_END
                </td>
            </tr>
            <tr>
                <td>$srCount</td>    
                <td>Faculty/Staff Name</td>
                <td align="center">$row[name]</td>
            </tr>
_END;
$srCount++;
echo <<<_END
            <tr>
                <td>$srCount</td>    
                <td>Designation</td>
                <td align="center">$row[job_type]</td>
            </tr>
_END;
$srCount++;
echo <<<_END

            <tr>
                <td>$srCount</td>    
                <td>Department</td>
                <td align="center">$row[dept_name]</td>
            </tr>
_END;
$srCount++;
echo <<<_END
        
            <tr>
                <td rowspan="2">$srCount</td>
                <td rowspan="2">Qualification<br>with Class / Grade</td>
                <td align="center">UG</td>
                <td align="center">PG</td>
                <td align="center">Ph.D</td>
            </tr>
            <tr>
                <td align="center">$row[ug]</td>
                <td align="center">$row[pg]</td>
                <td align="center">$row[phd]</td>
            </tr>
_END;
$srCount++;
echo <<<_END

            <tr>
                <td>$srCount</td>
                <td>Permanent Address</td>
                <td align="center" colspan="3">$row[per_address]</td>
            </tr>
_END;
$srCount++;
echo <<<_END

            <tr>
                <td>$srCount</td>
                <td>Residential Address</td>
                <td align="center" colspan="3">$row[res_address]</td>
            </tr>
_END;
$srCount++;
echo <<<_END

            <tr>
                <td>$srCount</td>
                <td>Phone / Mobile Number</td>
                <td align="center">Primary: $row[phonenop]</td>
                <td align="center">Secondary: $row[phonenos]</td>
                <td align="center">-</td>
            </tr>
_END;
$srCount++;
echo <<<_END
            <tr>
                <td rowspan="2">$srCount</td>
                <td rowspan="2">Total Experience<br>(In Years)</td>
                <td>Teaching Experience<br>(In Years)</td>
                <td colspan="2">Industry Experience<br>(In Years)</td>
            </tr>
            <tr>
                <td align="center">$row[exp_teach]</td>
                <td align="center" colspan="2">$row[exp_ind]</td>
            </tr>
_END;
$srCount++;
echo <<<_END

            <tr>
                <td rowspan="2">$srCount</td>
                <td rowspan="2">Paper Published in Journals</td>
                <td>National</td>
                <td colspan="2">International</td>
            </tr>
            <tr>
                <td align="center">$row[paper_national_pub]</td>
                <td align="center" colspan="2">$row[paper_international_pub]</td>
            </tr>
_END;
$srCount++;
echo <<<_END

            <tr>
                <td rowspan="2">$srCount</td>
                <td rowspan="2">Paper Presented in Conferences</td>
                <td>National</td>
                <td colspan="2">International</td>
            </tr>   
            <tr>
                <td align="center">$row[paper_national_presen]</td>
                <td align="center" colspan="2">$row[paper_international_presen]</td>
            </tr>
_END;
$srCount++;
echo <<<_END

            <tr>
                <td rowspan="2">$srCount</td>
                <td rowspan="2">Project Guided</td>
                <td>Ph.D</td>
                <td colspan="2">Master Level</td>
            </tr>
            <tr>
                <td align="center">$row[proj_guide_phd]</td>
                <td align="center" colspan="2">$row[proj_guide_master]</td>
            </tr>
_END;
$srCount++;
echo <<<_END

            <tr>
                <td>$srCount</td>
                <td>Area of Interest</td>
                <td align="center" colspan="3">$row[areas]</textarea>  
            </tr>
_END;
$srCount++;
echo <<<_END

            <tr>
                <td>$srCount</td>
                <td>Books Published / IPR /Patents</td>
                <td align="center" colspan="3">$row[book_ipr_patent]</td>  
            </tr>
_END;
$srCount++;
echo <<<_END

            <tr>
                <td>$srCount</td>
                <td>Professional Membership</td>
                <td align="center" colspan="3">$row[prof_member]</td>
            </tr>
_END;
$srCount++;
echo <<<_END

            <tr>
                <td>$srCount</td>
                <td>Consultancy Activities</td>
                <td align="center" colspan="3">$row[consultancy]</td>
            </tr>
_END;
$srCount++;
echo <<<_END

            <tr>
                <td>$srCount</td>
                <td>Awards</td>
                <td align="center" colspan="3">$row[awards]</td>
            </tr>
_END;
$srCount++;
echo <<<_END

            <tr>
                <td>$srCount</td>
                <td>Grants Fetched</td>
                <td align="center" colspan="3">$row[grants]</td>
            </tr>
_END;
$srCount++;
echo <<<_END

            <tr>
                <td>$srCount</td>
                <td>Interaction with <br>Professional Institutions</td>
                <td align="center" colspan="3">$row[prof_interaction]</td>
            </tr>
            </table>
                   <input type="button" width="100%" class="button" name="generatepdf" id="generatepdf" value="Generate PDF"/>
                   <input type="hidden" id="filename" name="filename" value="FacultyProfile-$_POST[fac_id]"/>
                   <input type="hidden" id="page" name="page" value=""/>
                   <input type="hidden" id="orientation" name="orientation" value="P"/>
                   <input type="hidden" id="style" name="style" value="4"/>

        </center>    
     </form>

_END;
 }
}
else
    echo '<br><br><center><span class="error">Something Unsual!</span></center>';
}
else{ 
    header('Location:   index.php');
}
  
