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
*   Created On: 22 Jul, 2015, 9:30:30 PM
*   Author: Muhammed Salman Shamsi
*/

require_once 'functions/functions.php';
require_once 'functions/subheader.php';

if($_POST)
{
    if($_POST['text']==""){
        echo 'Nothing to Search';
        die();
    }

    $text=  sanitizeString(trim($_POST['text']));
   
    $query="select rollno,name,dept,sem,year from Student where name like '%".$text."%' or rollno like '%".$text."%'";
    $result=mysql_query($query);

if(!$result || mysql_num_rows($result)==0){
        echo 'Sorry your Query does not yeild any results!';
        die();
}
else {
      
        echo '<table id="stud-search-table" cellspacing="10" cellpadding="4" border="0" bgcolor="#00eeee">';
           echo '<tr>';
                    echo '<th align="center" width="8%">Roll No.</th>';
                    echo '<th align="center" width="25%">Name</th>';
                    echo '<th align="center" width="7%">Department</th>';
                    echo '<th align="center" width="5%">Sem</th>';
                    echo '<th align="center" width="15%">Year</th>';
                    echo '<th align="center" width="5%">Select</th>';
                    echo '<th align="center" width="5%" class="recbtn-col">View</th>';
                    
                echo '</tr>';
       while($row=mysql_fetch_array($result)){
           
                echo '<tr>';
                    echo '<td>';
                        echo '<input type="text" name="rollno" id="srroll" class="'.$row[rollno].'" disabled=true style="width:80%;color:black;text-align:center;background:transparent;border:0;" required="true" value="'.$row[rollno].'"/>'; 
                    echo '</td>';
                    echo '<td>';
                        echo '<input type="text" name="name" id="srname" class="'.$row[rollno].'" disabled=true style="color:black;background:transparent;border:0;" required="true" value="'.$row[name].'"/>';
                    echo '</td>';
                    echo '<td><input type="text" name="dept" id="srdept" class="'.$row[rollno].'" disabled=true style="width:50%; color:black;text-align:center;background:transparent;border:0;" required value="'.$row[dept].'" readonly="true">
                    </td>';
                    echo '<td><input type="text" name="sem" id="srsem"  class="'.$row[rollno].'" disabled=true style="width:50%; color:black;text-align:center;background:transparent;border:0;" required value="'.$row[sem].'"/>
                    </td>';
                    echo '<td>
                        <input type="text" name="year" id="sryear" class="'.$row[rollno].'" disabled=true style="color:black;text-align:center;background:transparent;border:0;" required value="'.$row[year].'"/> 
                    </td>';
                    echo '<td align="center"><input type="radio" class="sradio" name="sselect" style="width:50%; vertical-align: middle; margin: 0px;" value="'.$row[rollno].'" required></td>';
                    echo '<td align="center" class="recbtn-col">'
                    . '<input type="button" class="button recordbtn '.$row[rollno].'" name="recordbtn"  disabled=true value="Get Record"/></td>';
                    
                echo '</tr>';  
        }
        echo '</table>';
        /*echo '<div class="left-slide-box  left-fixed-float">'
        . '<input type="button" class="button form-button" disabled="true" title="Please Select one of the option then click" id="recordbtn" name="recordbtn"  value="Get Record"/>'
                . '</div>';*/
   
}

}
