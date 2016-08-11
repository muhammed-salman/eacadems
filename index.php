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

require_once 'functions/header.php';

if($loggedin){
    
            $query="select count(*) as s1 from Student where sem='I' and dept=(select dept from Faculty where fac_id='".$_SESSION['fac_id']."')";
            $result=  queryMysql($query);
            while ($row = mysql_fetch_array($result)) {
                $s1=$row['s1'];
            }
            $query="select count(*) as s2 from Student where sem='II' and dept=(select dept from Faculty where fac_id='".$_SESSION['fac_id']."')";
            $result=  queryMysql($query);
            while ($row = mysql_fetch_array($result)) {
                $s2=$row['s2'];
            }
            $query="select count(*) as s3 from Student where sem='III' and dept=(select dept from Faculty where fac_id='".$_SESSION['fac_id']."')";
            $result=  queryMysql($query);
            while ($row = mysql_fetch_array($result)) {
                $s3=$row['s3'];
            }
            $query="select count(*) as s4 from Student where sem='IV' and dept=(select dept from Faculty where fac_id='".$_SESSION['fac_id']."')";
            $result=  queryMysql($query);
            while ($row = mysql_fetch_array($result)) {
                $s4=$row['s4'];
            }
            $query="select count(*) as s5 from Student where sem='V' and dept=(select dept from Faculty where fac_id='".$_SESSION['fac_id']."')";
            $result=  queryMysql($query);
            while ($row = mysql_fetch_array($result)) {
                $s5=$row['s5'];
            }
            $query="select count(*) as s6 from Student where sem='VI' and dept=(select dept from Faculty where fac_id='".$_SESSION['fac_id']."')";
            $result=  queryMysql($query);
            while ($row = mysql_fetch_array($result)) {
                $s6=$row['s6'];
            }
            $query="select count(*) as s7 from Student where sem='VII' and dept=(select dept from Faculty where fac_id='".$_SESSION['fac_id']."')";
            $result=  queryMysql($query);
            while ($row = mysql_fetch_array($result)) {
                $s7=$row['s7'];
            }
            $query="select count(*) as s8 from Student where sem='VIII' and dept=(select dept from Faculty where fac_id='".$_SESSION['fac_id']."')";
            $result=  queryMysql($query);
            while ($row = mysql_fetch_array($result)) {
                $s8=$row['s8'];
            }
            
            echo '<div id="left">';
             echo '<div class="info-box">'
                . '<span class="full-title-blackgrad slidebutton">Registered Students<span class="arrow-up"></span></span>'
                     . '<ul id="stCount" class="slidebox">'
                     . '<li>Sem &nbsp;&nbsp;I : '.$s1.'</li>'
                     . '<li>Sem &nbsp;&nbsp;&nbsp;II : '.$s2.'</li>'
                     . '<li>Sem &nbsp;III : '.$s3.'</li>'
                     . '<li>Sem &nbsp;&nbsp;IV : '.$s4.'</li>'
                     . '<li>Sem &nbsp;&nbsp;&nbsp;V : '.$s5.'</li>'
                     . '<li>Sem &nbsp;&nbsp;VI : '.$s6.'</li>'
                     . '<li>Sem &nbsp;VII : '.$s7.'</li>'
                     . '<li>Sem VIII : '.$s8.'</li>'
                     . '</ul>'
                . '</div>'
            . '<div class="info-box"><div class="full-title-redgrad slidebutton">Important Guidelines<span class="arrow-up"></span></div>'
                     . '<ul class="slidebox">'
            .'<li>'.$checkmark.' Please Verify the data before submitting the form</li>'
            .'<li>'.$checkmark.' In most of the cases modification is not possible. So be cautious.</li>'        
            .'<li>'.$checkmark.' All the Faculty are advised to fill Attendence daily without fail</li>'
            .'<li>'.$checkmark.' Routine change of password is advised.</li>'
            .'<li>'.$checkmark.' Password must contain atleast one combination of each lower & upper case alphabets'
                    . ',digits and special characters</li>'        
                    . '</div></div>';
            echo '<div id="right">';
           echo '<div class="link_container">';
               
             if($_SESSION['grid']==='3'||$_SESSION['grid']==='7'||$_SESSION['grid']==='8'){ 
                echo '<a href="studentregister.php" ><img src="icons/student.png" ><br>Register Student</a>';
             }
             if($_SESSION['grid']==='3'||$_SESSION['grid']==='7'||$_SESSION['grid']==='8'){ 
                echo '<a href="updatestudent.php" ><img src="icons/updatestudent.png" ><br>Update Student</a>';
             }
             if($_SESSION['grid']==='3'||$_SESSION['grid']==='2'||$_SESSION['grid']==='9'){                 
                 echo '<a href="createfacultystaff.php"><img src="icons/professor.png" ><br>Register Staff</a>';
             }
             if($_SESSION['grid']==='3'||$_SESSION['grid']==='1'||$_SESSION['grid']==='9'){
                echo '<a href="deptcreate.php"><img src="icons/department.png" ><br>Create Department</a>';
             }
             if($_SESSION['grid']==='3'||$_SESSION['grid']==='1'||$_SESSION['grid']==='7'){
                echo '<a href="createclassroom.php"><img src="icons/class.png" ><br>Create Classroom</a>';
             }
             if($_SESSION['grid']==='3'||$_SESSION['grid']==='9'){
                echo '<a href="createuser.php"><img src="icons/user.png" ><br>User Account</a>';
             }
             if($_SESSION['grid']==='3'||$_SESSION['grid']==='7'){
                echo '<a href="createcourse.php"><img src="icons/course.png" ><br>Make Course</a>';
             }
             if($_SESSION['grid']==='3'||$_SESSION['grid']==='7'){
                echo '<a href="createtimetable.php"><img src="icons/timetable.png" ><br>Create Schedule</a>';
             }
             if($_SESSION['grid']==='3'||$_SESSION['grid']==='7'||$_SESSION['grid']==='5'||
                     $_SESSION['grid']==='4'||$_SESSION['grid']==='2'||$_SESSION['grid']==='1'){
                echo '<a href="loadtimetable.php"><img src="icons/viewtime.png" ><br>Classwise Schedule</a>';
             }
             if($_SESSION['grid']==='3'||$_SESSION['grid']==='7'||$_SESSION['grid']==='2'){
                echo '<a href="assigncourse.php"><img src="icons/load.png" ><br>Load Assignment</a>';
             }
             if($_SESSION['grid']==='3'||$_SESSION['grid']==='7'||$_SESSION['grid']==='2'||$_SESSION['grid']==='6'){
                echo '<a href="filterpromote.php"><img src="icons/promote.png" ><br>Promote / Detain</a>';
             }
             if($_SESSION['grid']==='5'||$_SESSION['grid']==='2'){
                echo '<a href="test.php"><img src="icons/testmarks.png" ><br>Test Marks</a>';
             }
             if($_SESSION['grid']==='3'||$_SESSION['grid']==='6'){
                echo '<a href="grade.php"><img src="icons/grade.png" ><br>Semester Marks</a>';
             }
             if($_SESSION['grid']==='5'||$_SESSION['grid']==='2'){
                echo '<a href="filteratt.php"><img src="icons/attendence.png" ><br>Mark Attendence</a>';
             }
             if($_SESSION['grid']==='5'||$_SESSION['grid']==='2'){
                echo '<a href="createpp.php"><img src="icons/planning.png" ><br>Create Practical</a>';
             }
             if($_SESSION['grid']==='5'||$_SESSION['grid']==='2'){
                echo '<a href="filterpp.php"><img src="icons/updateplan.png" ><br>Manage Practical</a>';
             }
             if($_SESSION['grid']==='5'||$_SESSION['grid']==='2'){
                echo '<a href="tlo.php"><img src="icons/tlo.png" ><br>Manage TLO</a>';
             }
             if($_SESSION['grid']==='5'||$_SESSION['grid']==='2'){
                echo '<a href="CA.php"><img src="icons/ca.png" ><br>Continuous Assesment</a>';
             }
             if($_SESSION['grid']==='3'||$_SESSION['grid']==='7'){
                echo '<a href="createsy.php"><img src="icons/syllabus.png" ><br>Create Syllabus</a>';
             }
             if($_SESSION['grid']==='3'||$_SESSION['grid']==='5'||$_SESSION['grid']==='7'||$_SESSION['grid']==='2'){
                echo '<a href="filtersyllabus.php"><img src="icons/viewsyllabus.png" ><br>Manage Syllabus</a>';
             }
             if($_SESSION['grid']==='3'||$_SESSION['grid']==='5'||$_SESSION['grid']==='2'||
                     $_SESSION['grid']==='7'||$_SESSION['grid']==='1'||$_SESSION['grid']==='9'){
                echo '<a href="filterstudinfo.php"><img src="icons/info.png" ><br>Students Info</a>';
             }
             if($_SESSION['grid']==='5'||$_SESSION['grid']==='2'||
                     $_SESSION['grid']==='7'){
                echo '<a href="filterdefaulter.php"><img src="icons/defaulter.png" ><br>Defaulter List</a>';
             }
             if($_SESSION['grid']==='2'){
                echo '<a href="view.php"><img src="icons/viewcaplan.png" ><br>View CA & Plans</a>';
             }
            if($_SESSION['grid']==='7'||$_SESSION['grid']==='2'){
                echo '<a href="viewtest.php"><img src="icons/viewtest.png" ><br>Class TM</a>';
             }
            if($_SESSION['grid']==='3'||$_SESSION['grid']==='5'||$_SESSION['grid']==='2'){
                echo '<a href="studentrecord.php"><img src="icons/record.png" ><br>Students Records</a>';
             }

             if($_SESSION['grid']==='3'||$_SESSION['grid']==='5'||$_SESSION['grid']==='2' ||$_SESSION['grid']==='7'){
                echo '<a href="attendencesheet.php"><img src="icons/sheet.png" ><br>Attendence Sheet</a>';
             }
             if($_SESSION['grid']==='3'||$_SESSION['grid']==='5'||$_SESSION['grid']==='2'){
                echo '<a href="facultyprofile.php"><img src="icons/profile.png" ><br>Your Profile</a>';
             }
             if($_SESSION['grid']==='3'||$_SESSION['grid']==='2'||$_SESSION['grid']==='1'||$_SESSION['grid']==='9'){
                echo '<a href="facultyrecord.php"><img src="icons/viewprofile.png" ><br>Faculty Profile</a>';
             }
             if($_SESSION['grid']!=='8'){
                echo '<a href="changepass.php"><img src="icons/password.png" ><br>Change Password</a>';
             }
             
             echo '</div></div>';
              
     }
     else {echo'<center><span class="error">Please sign up and/or login to use the system</span><center>';
     header('Refresh:0 ,url=login.php');}

     require_once 'functions/footer.php';
?>