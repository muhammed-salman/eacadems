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
*   Created On: 10 September, 2015, 12:47:20 PM
*   Author: Muhammed Salman Shamsi
*/
require_once 'functions/subheader.php';
    if($_POST){             
        if(isset($_POST['rollno'])&& isset($_POST['year'])&& isset($_POST['sem'])&& isset($_POST['dept'])) {
            $rollno=$_POST['rollno'];
            $year=$_POST['year'];
            $sem=$_POST['sem'];
            $dept= $_POST['dept'];
            $query="select course_id,abbrv,tw,ia from Course where sem='$sem' and dept='$dept'";
            //echo $query;
            $result=  queryMysql($query);
            echo '<form action="ktentry.php" method="post">'
                . '<table>'
                . '<tr>'
                    . '<th class="heading_large_box_1">Course</th>'
                    . '<th class="heading_large_box_1">KT</th>'
                    . '<th class="heading_large_box_1">Attendance</th>'
                    . '<th class="heading_large_box_1">Grade</th>'
                    . '<th class="heading_large_box_1">TW Marks</th>'
                    . '<th class="heading_large_box_1">TEST Marks</th>'
                    . '</tr>';
            if(mysql_num_rows($result)==0)
                echo '<span id="error">No Records Found</span>';
            else {
                while ($row = mysql_fetch_array($result)) {
                    
                    echo '<tr>'
                    . '<td>'.$row[abbrv].'</td>'
                    . '<td>'
                        . '<select name="kt_'.$row[course_id].'" required>'
                            . '<option value="">------</option>'
                            . '<option value="YES">YES</option>'
                            . '<option value="NO">NO</option>'
                        .'</select>'    
                    . '</td>'
                    . '<td>'
                        . '<select name="att_'.$row[course_id].'" required>'
                            . '<option value="">------</option>'
                            . '<option value="EXCELLENT">86 to 100</option>'
                            . '<option value="GOOD">75 to 85</option>'
                            . '<option value="AVERAGE">60 to 74</option>'
                            . '<option value="POOR">0 to 59</option>'
                        .'</select>'
                    . '</td>'
                    . '<td>'
                        . '<select name="grade_'.$row[course_id].'" required>'
                            . '<option value="">------</option>'
                            . '<option value="O">70 and Above</option>'
                            . '<option value="A">60 to 69</option>'
                            . '<option value="B">55 to 59</option>'
                            . '<option value="C">50 to 54</option>'
                            . '<option value="D">45 to 49</option>'
                            . '<option value="E">40 to44</option>'
                            . '<option value="F">Less than 40</option>'
                        .'</select>'
                    . '</td>'
                    . '<td><input type="number" name="tw_'.$row[course_id].'" min="0" max="'.$row[tw].'" required/></td>'
                    . '<td><input type="number" name="test_'.$row[course_id].'" min="0" max="'.$row[ia].'" required/></td>'
                    . '</tr>';
                }
                echo '<tr><td></td><td></td><td></td>'
                   . '<td><input type="submit" name="submit-btn" class="button form-button" id="#stud-kt-entry-btn" value="Submit"></td>'
                   . '<td></td><td></td></tr>';
            }
            echo '</table>'
            .'<input type="hidden" name="rollno" value="'.$rollno.'"/>'
            .'<input type="hidden" name="year" value="'.$year.'"/>'
            .'<input type="hidden" name="dept" value="'.$dept.'"/>'
            .'<input type="hidden" name="sem" value="'.$sem.'"/>'
            . '</form>';
        }
    }
?>