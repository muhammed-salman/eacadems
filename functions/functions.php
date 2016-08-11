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
*   Author: MUhammed Salman Shamsi
*/
//echo __ROOT__.'/functions/connect.php';
//require_once(__ROOT__.'/functions/connect.php'); 
require_once 'functions/connect.php';

function createTable($name, $query)
{
    queryMysql("CREATE TABLE IF NOT EXISTS $name($query)");
    echo "Table '$name' created or already exists.";
}


function queryMysql($query)
{
    global $cn;
    $result=  mysql_query($query,$cn);
    if(!$result)
    {
        echo'<center><span class="error">Failed to execute query'.$query.'\nMysql Error: '.mysql_error().'</span></center>';
        die();
    }
    
    return $result;
}

function destroySession()
{
    $_SESSION=  array();
    if(session_id()!=""||isset($_COOKIE[session_name()]))
        setcookie (session_name (), '', time()-259200, '/');
    session_destroy();
}

function sanitizeString($var)
{
    global $cn;
    $var =  strip_tags($var);
    $var=  htmlentities($var);
    $var= stripcslashes($var);
    return mysql_real_escape_string($var,$cn);
}

function loadDept($type='none')
{
    if($type=='none'){    
        $sql_query = "select * from Department where type!='N/A'";}
    elseif ($type==1) {
        $sql_query = "select * from Department where type='TEACHING'";}
    elseif ($type==2) {
        $sql_query = "select * from Department where type='NON TEACHING'";}

    $result= queryMysql($sql_query);
    if(mysql_num_rows($result)==0){
        echo '<option value="">No Records!</option>';
    }
    echo "<option value=''>------</option>";
    while($row = mysql_fetch_array($result)){
        echo "<option value='".$row["dept_id"]."'>".$row["name"]."</option>";
    }
}

function loadFaculty($deptflag=0)
{
    if($deptflag==0){    
    $sql_query = "select * from Faculty";
    }
    else{
        $sql_query="select * from Faculty where dept in (select dept from Faculty where fac_id='".$_SESSION['fac_id']."')";
    }

    $result= queryMysql($sql_query);

    if(mysql_num_rows($result)==0){
        echo '<option value="">No Records!</option>';
    }

    echo "<option value=''>------</option>";
    while($row = mysql_fetch_array($result)){
        echo "<option value='".$row["fac_id"]."'>".$row["name"]."</option>";
    }
} 

function loadSem()
{
    $sql_query = "select sem from ClassSem";

    $result= queryMysql($sql_query);

    if(mysql_num_rows($result)==0){
        echo '<option value="">No Records!</option>';
    }

    echo "<option value=''>------</option>";
    while($row = mysql_fetch_array($result)){
        echo "<option value='".$row["sem"]."'>".$row["sem"]."</option>";
    }
}

function loadTimeSlot()
{
    $sql_query = "select * from TimeSlot";

    $result= queryMysql($sql_query);

    if(mysql_num_rows($result)==0){
        echo '<option value="">No Records!</option>';
    }

    echo "<option value=''>------</option>";
    while($row = mysql_fetch_array($result)){
        echo "<option value='".$row["timeslot_id"]."'>".$row["start_time"]."--".$row["end_time"]."</option>";
    }
}

function loadCourse()
{
    $sql_query = "select course_id,title from Course";

    $result= queryMysql($sql_query);

    if(mysql_num_rows($result)==0){
        echo '<option value="">No Records!</option>';
    }

    echo "<option value=''>------</option>";
    while($row = mysql_fetch_array($result)){
        echo "<option value='".$row["course_id"]."'>".$row["title"]."</option>";
    }
} 


function loadClassRoom()
{
    $sql_query = "select * from ClassRoom";

    $result= queryMysql($sql_query);

    if(mysql_num_rows($result)==0){
        echo '<option value="">No Records!</option>';
    }

    echo "<option value=''>------</option>";
    while($row = mysql_fetch_array($result)){
        echo "<option value='".$row["class_id"]."'>".$row["classroom"]."</option>";
    }
}


function loadTeachesCourse($type='none',$year='none')
{
    if($type==='none' && $year==='none'){    
        $sql_query = "select distinct(c.course_id),c.title from Course c,Teaches t where c.course_id=t.course_id and fac_id='".$_SESSION['fac_id']."'";
    }
    elseif($type!=='none' && $year==='none'){
        $sql_query = "select distinct(c.course_id),c.title from Course c,Teaches t where c.course_id=t.course_id and fac_id='".$_SESSION['fac_id']."' and THorPR=".$type;
    }
    elseif ($type==='none' && $year!=='none') {
        $sql_query = "select distinct(c.course_id),c.title from Course c,Teaches t where c.course_id=t.course_id and fac_id='".$_SESSION['fac_id']."' and year='".$year."'";
    }
    elseif($type!=='none' && $year!=='none'){
        $sql_query = "select distinct(c.course_id),c.title from Course c,Teaches t where c.course_id=t.course_id and fac_id='".$_SESSION['fac_id']."' and THorPR=".$type." and year='".$year."'";
    }

    $result= queryMysql($sql_query);

    if(mysql_num_rows($result)==0){
        echo '<option value="">No Records!</option>';
    }
    echo "<option value=''>------</option>";
    while($row = mysql_fetch_array($result)){
        echo "<option value='".$row["course_id"]."'>".$row["title"]."</option>";
    }
} 

function loadTeachCourse($type='none',$year='none')
{
    if($type==='none' && $year==='none'){    
        $sql_query = "select distinct(c.course_id),c.title from Course c,Teaches t where c.course_id=t.course_id";
    }
    elseif($type!=='none' && $year==='none'){
        $sql_query = "select distinct(c.course_id),c.title from Course c,Teaches t where c.course_id=t.course_id and THorPR=".$type;
    }
    elseif ($type==='none' && $year!=='none') {
        $sql_query = "select distinct(c.course_id),c.title from Course c,Teaches t where c.course_id=t.course_id and year='".$year."'";
    }
    elseif($type!=='none' && $year!=='none'){
        $sql_query = "select distinct(c.course_id),c.title from Course c,Teaches t where c.course_id=t.course_id and THorPR=".$type." and year='".$year."'";
    }

    $result= queryMysql($sql_query);

    if(mysql_num_rows($result)==0){
        echo '<option value="">No Records!</option>';
    }

    echo "<option value=''>------</option>";
    while($row = mysql_fetch_array($result)){
        echo "<option value='".$row["course_id"]."'>".$row["title"]."</option>";
    }
}

function loadTeachesYear()
{
    $sql_query = "select distinct year from Teaches where fac_id='".$_SESSION['fac_id']."' order by year";

    $result= queryMysql($sql_query);

    if(mysql_num_rows($result)==0){
        echo '<option value="">No Records!</option>';
    }

    echo "<option value=''>------</option>";
    while($row = mysql_fetch_array($result)){
        echo "<option value='".$row["year"]."'>".$row["year"]."</option>";
    }
}

function loadTakesyear()
{
    $sql_query = "select distinct year from Takes order by year";

    $result= queryMysql($sql_query);

    if(mysql_num_rows($result)==0){
        echo '<option value="">No Records!</option>';
    }

    echo "<option value=''>------</option>";
    while($row = mysql_fetch_array($result)){
        echo "<option value='".$row["year"]."'>".$row["year"]."</option>";
    }    
}

function loadYear($start_year, $end_year = null) {
 
        // curret year as end year
        $end_year = is_null($end_year) ? date('Y') : $end_year;
        // range of years
        $r = range($start_year, $end_year);
        echo "<option value=''>------</option>";
        foreach( $r as $year )
        {
            echo "<option value='".$year."'>".$year."</option>";
        }
      
}

function loadMonths($start_month,$end_month=null) {
 
         // curret month as end month
        $end_month= is_null($end_month) ? date('m') : $end_month;
        // range of months
        $r = range($start_month,$end_month);
        echo "<option value=''>------</option>";
        foreach( $r as $month )
        {
            echo "<option value='".$month."'>".date('F', strtotime(date('Y')."-$month-01"))."</option>";
        }
}

function loadGroup()
{
    
    $sql_query = "select * from `Group` where group_id!=3 order by gname";

    $result= queryMysql($sql_query);

    if(mysql_num_rows($result)==0){
        echo '<option value="">No Records!</option>';
    }

    echo "<option value=''>------</option>";
    while($row = mysql_fetch_array($result)){
        echo "<option value='".$row['group_id']."'>".$row['gname']."</option>";
    }    
}

function loadUserId()
{
    
    $sql_query = "select userid from `Access` order by userid";

    $result= queryMysql($sql_query);

    if(mysql_num_rows($result)==0){
        echo '<option value="">No Records!</option>';
    }
    echo "<option value=''>------</option>";
    while($row = mysql_fetch_array($result)){
        echo "<option value='".$row['userid']."'>".$row['userid']."</option>";
    }    
}

function insertStudent(){
    require_once 'functions/connect.php';
    if($_POST){

    if(isset($_POST['srollno'])&& isset($_POST['sname'])&& isset($_POST['saddress'])
        && isset($_POST['ssem'])&& isset($_POST['sdoa'])&& isset($_POST['sdob'])
        && isset($_POST['sphoneno'])&& isset($_POST['sdept'])&& isset($_POST['semail'])
        && isset($_POST['spphoneno'])&& isset($_POST['syear'])
        && isset($_POST['sbatch'])&& isset($_POST['sraddress'])&& isset($_POST['sgender'])){
    
        $rollno= strtoupper(sanitizeString(trim($_POST['srollno'])));
        $sname=  strtoupper(sanitizeString(trim($_POST['sname'])));
        $saddress= strtoupper(sanitizeString(trim($_POST['saddress'])));
        $sraddress= strtoupper(sanitizeString(trim($_POST['sraddress'])));
        $ssem=strtoupper(sanitizeString($_POST['ssem']));
   
        $sdoa=trim($_POST['sdoa']);
        $sdoa=date('Y-m-d',strtotime(str_replace('/','.',$sdoa)));
   
        $sdob=trim($_POST['sdob']);
        $sdob=date('Y-m-d',strtotime(str_replace('/','.',$sdob)));
   
        $sphoneno=  sanitizeString(trim($_POST['sphoneno']));
        $sdept=strtoupper(sanitizeString($_POST['sdept']));
        $semail=  strtolower(sanitizeString(trim($_POST['semail'])));
        $spphoneno=  sanitizeString(trim($_POST['spphoneno']));
        $syear=sanitizeString($_POST['syear']);
        $sbatch=sanitizeString($_POST['sbatch']); 
        $sgender=sanitizeString($_POST['sgender']); 
 
        $query="INSERT INTO Student VALUES".
           "('$rollno','$sname','$saddress','$sraddress','$ssem','$sdoa','$sdob','$sphoneno','$sdept','$semail','$spphoneno','$syear','$sbatch','$sgender')";
    
        //echo ''.$query;
        if(!mysql_query($query))
            echo "<center><span class='error'>INSERT Failed : ".  mysql_error()."</span></center>";
        else {
            echo '<div class="success">You are Successfully Registered</div>';   
        }
        $multi_sql_query="";
                           
        $query="select course_id from Course where dept='".$sdept."' AND sem='".$ssem."'";
        $result= queryMysql($query);
        while($row = mysql_fetch_array($result)){
            $scourse_id=$row['course_id'];
            $multi_sql_query.="INSERT INTO Takes VALUES('$rollno','$scourse_id','$syear');";  
        }
        
        $query="select course_id from Course where IA is not null and IA!=0 and IA!='' and dept='".$sdept."' AND sem='".$ssem."'";
        $result= queryMysql($query);
        
        while($row = mysql_fetch_array($result)){
            $scourse_id=$row['course_id'];
            $multi_sql_query.="INSERT INTO Test VALUES('$rollno','$scourse_id','$syear',NULL,NULL);";
        }
        
        global $db_host,$db_name,$db_user,$db_password;            
        $link = mysqli_connect($db_host,$db_user,$db_password,$db_name);
    
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            echo '<div class="error">You are not registered. Please contact System Administrator.</div>';
            exit();
        }
       
                    /* execute multi query */
            
     //               echo ''.$multi_sql_query;
                
       if (mysqli_multi_query($link, $multi_sql_query)) {
            echo '<div class="success">Record Successfully Inserted for Roll no:-'.$rollno.'</div>';
            echo '<script language="javascript">';
            echo 'alert("You are Successfully Registered!\n'.
            'Please wait while you are redirected to Student details page")';
             echo '</script>';
             header("Refresh: 0; url=studentdetails.php");
        }
       else {
            echo "<div class='error'>INSERT/UPDATE Failed : ". mysqli_error($link)."</div>";
            die();
        }
        exit;
                
                    /* close connection */
        mysqli_close($link);
            
        }
    }
}

function insertStudentDetails(){
    
    if($_POST){

    if(isset($_POST['sdrollno'])&& isset($_POST['sdstudy'])&& isset($_POST['sdhealth'])
        && isset($_POST['sdclasses'])
        && isset($_POST['sdsource'])&& isset($_POST['sddrop'])&& isset($_POST['sdcampus'])
        && isset($_POST['sdtravel'])&& isset($_POST['sdfamily'])&& isset($_POST['sdincome'])
        && isset($_POST['sdfatheredu'])&& isset($_POST['sdmotheredu'])&& isset($_POST['sdfaoccup'])
        && isset($_POST['sdmoccup'])&& isset($_POST['sdchallenge'])&& isset($_POST['sdcast'])
        && isset($_POST['sdlang'])&& isset($_POST['sdorphan'])&& isset($_POST['sdkt'])
        && isset($_POST['sdssc'])&& isset($_POST['sdhsc'])&& isset($_POST['sdmedium'])
        && isset($_POST['sdadmission'])){

        $rollno= strtoupper(sanitizeString(trim($_POST['sdrollno'])));
        $sdstudy= strtoupper(sanitizeString(trim($_POST['sdstudy'])));
        $sdhealth= strtoupper(sanitizeString(trim($_POST['sdhealth'])));
        $sdclasses= strtoupper(sanitizeString(trim($_POST['sdclasses'])));
        $sdsource= strtoupper(sanitizeString(trim($_POST['sdsource'])));
        $sddrop= strtoupper(sanitizeString(trim($_POST['sddrop'])));
        $sdcampus= strtoupper(sanitizeString(trim($_POST['sdcampus'])));
        $sdtravel= strtoupper(sanitizeString(trim($_POST['sdtravel'])));
        $sdfamily= strtoupper(sanitizeString(trim($_POST['sdfamily'])));
        $sdincome= strtoupper(sanitizeString(trim($_POST['sdincome'])));
        $sdfatheredu= strtoupper(sanitizeString(trim($_POST['sdfatheredu'])));
        $sdmotheredu= strtoupper(sanitizeString(trim($_POST['sdmotheredu'])));
        $sdfaoccup= strtoupper(sanitizeString(trim($_POST['sdfaoccup'])));
        $sdmoccup= strtoupper(sanitizeString(trim($_POST['sdmoccup'])));
        $sdchallenge= strtoupper(sanitizeString(trim($_POST['sdchallenge'])));
        $sdcast= strtoupper(sanitizeString(trim($_POST['sdcast'])));
        $sdlang= strtoupper(sanitizeString(trim($_POST['sdlang'])));
        $sdorphan= strtoupper(sanitizeString(trim($_POST['sdorphan'])));
        $sdkt= strtoupper(sanitizeString(trim($_POST['sdkt'])));
        $sdssc= strtoupper(sanitizeString(trim($_POST['sdssc'])));
        $sdhsc= strtoupper(sanitizeString(trim($_POST['sdhsc'])));
        $sdmedium= strtoupper(sanitizeString(trim($_POST['sdmedium'])));
        $sdadmission= strtoupper(sanitizeString(trim($_POST['sdadmission'])));
        
        $query="INSERT INTO StudentDetails VALUES".
           "('$rollno','$sdstudy','$sdhealth','$sdclasses','$sdsource','$sddrop','$sdcampus',"
                . "'$sdtravel','$sdfamily','$sdincome','$sdfatheredu','$sdmotheredu','$sdfaoccup',"
                . "'$sdmoccup','$sdchallenge','$sdcast','$sdlang','$sdorphan','$sdkt','$sdssc','$sdhsc',"
                . "'$sdmedium','$sdadmission')";
    
        //echo ''.$query;
        if(!mysql_query($query))
            echo "<center><span class='error'>INSERT Failed : ".  mysql_error()."</span></center>";
        else {
            echo '<div class="success">Yours Details are Successfully Submitted</div>';   
            echo '<script language="javascript">';
            echo 'alert("You Details are Successfully Submitted!\n'.
            'Please wait while you are redirected to Index page")';
             echo '</script>';
             header("Refresh: 0; url=index.php");
        }
         
    }
  }
}

function insertFacultyStaff(){
    if($_POST){

        if(isset($_POST['cfsfacid'])&& isset($_POST['cfsname'])&& isset($_POST['cfsjob'])
            && isset($_POST['cfspaddress'])&& isset($_POST['cfsraddress'])&& isset($_POST['cfsdob'])
            && isset($_POST['cfsphonenop'])&& isset($_POST['cfsphonenos'])&& isset($_POST['cfsdept'])
            && isset($_POST['cfsemail'])&& isset($_POST['cfsqual'])&& isset($_POST['cfsexp'])
            && isset($_POST['cfsdoj'])&& isset($_POST['cfssalary'])&& isset($_POST['cfareas'])
            && isset($_FILES['image'])){
    
            $cfsfacid= strtoupper(sanitizeString(trim($_POST['cfsfacid'])));
            $cfsname=  strtoupper(sanitizeString(trim($_POST['cfsname'])));
            $cfspaddress= strtoupper(sanitizeString(trim($_POST['cfspaddress'])));
            $cfsraddress= strtoupper(sanitizeString(trim($_POST['cfsraddress'])));
            $cfsjob=$_POST['cfsjob'];
   
            $cfsdoj=trim($_POST['cfsdoj']);
            $cfsdoj=date('Y-m-d',strtotime(str_replace('/','.',$cfsdoj)));
   
            $cfsdob=trim($_POST['cfsdob']);
            $cfsdob=date('Y-m-d',strtotime(str_replace('/','.',$cfsdob)));
   
            $cfsphonenop=  sanitizeString(trim($_POST['cfsphonenop']));
            $cfsphonenos=  sanitizeString(trim($_POST['cfsphonenos']));
            $cfsdept=$_POST['cfsdept'];
            $cfsemail=  strtolower(sanitizeString(trim($_POST['cfsemail'])));
            $cfsqual=$_POST['cfsqual']; 
            $cfsexp=trim($_POST['cfsexp']);
            $cfssalary=  sanitizeString(trim($_POST['cfssalary']));
            $cfareas= strtoupper(sanitizeString(trim($_POST['cfareas'])));
   
            $query="INSERT INTO Faculty VALUES".
                "('$cfsfacid','$cfsname','$cfsjob','$cfspaddress','$cfsraddress','$cfsphonenop','$cfsphonenos','$cfsemail','$cfsqual','$cfsexp','$cfsdoj','$cfsdob','$cfssalary','$cfsdept','$cfareas')";
            queryMysql($query);
   
            $img_id=saveimage($cfsfacid);
            //$result=  queryMysql("select max(image_id) as id from Images");
             //while($row=  mysql_fetch_array($result)){$img_id=$row['id'];}
            $query="INSERT INTO FacultyProfile VALUES".
                "('$cfsfacid','','','','','','','','','','','','','','','','','','$img_id')";
            queryMysql($query);
            //echo ''.$query;
            //echo '<div class="success">You are Successfully Registered</div>';   
            echo '<script language="javascript">';
                echo 'alert("Record Successfully Inserted!\n'.
                'You will be redirected to Faculty \\ Staff creation page.")';
            echo '</script>';
            header("Refresh: 0; url=createfacultystaff.php");                
        }
    }
}

function insertPracPlan()
{
    
    if($_POST){
        ob_start();
        if(isset($_POST['ppyear'])&& isset($_POST['ppsub'])&& isset($_POST['ppexp'])){    
        
            $ppyear=$_POST['ppyear'];
            $ppsub=$_POST['ppsub'];
            $ppexp=trim($_POST['ppexp']);
            $fac_id=$_POST['ffac_id'];
            $expCount=$ppexp;
            $errflag=0;
        
            while($expCount>=1){
                $query="SELECT batch FROM Teaches where fac_id='".$fac_id."'and course_id='".$ppsub."' and year='".$ppyear."' and THorPR=0 and batch!=0";
                $result=  queryMysql($query);
                if(mysql_num_rows($result)==0){
                    echo '<center><span class="error">No Records Found!'
                    . 'You are not assigned any batch of this subject for the given year.</span></center>';
                    die();
                }
                while($row=  mysql_fetch_array($result)){    
                    $query="INSERT INTO PracPlan VALUES('$ppsub','$ppyear','$expCount','$row[batch]',NULL,NULL,NULL)";    
 
                    if(!mysql_query($query)){
                        echo "<center><span class='error'>INSERT Failed : ".  mysql_error()."</span></center>";
                        $errflag=1;}
                    else {
                        echo '<span class="success">Record Successfully Inserted</span>';   
                    }
                }
                $expCount--;
            }
            if($errflag==0){
                echo '<script language="javascript">';
                    echo 'alert("Practical Plan Successfully Created!\n'.
                        'Please wait while you are redirected to Practical Plan Update page")';
                echo '</script>';
                header("Refresh: 0; url=filterpp.php");
            }
            else {
                echo '<script language="javascript">';
                echo 'alert("Practical Plan Creation Unsuccessful!\n'.
                    'You will be redirected to Practical Plan Creation page.")';
                echo '</script>';
                header("Refresh: 0; url=createpp.php");
            }
        }
    }
}    

function insertDept()
{
    if($_POST)
    {


        if(isset($_POST['dept_id'])&& isset($_POST['dname'])&& isset($_POST['dhod'])
            && isset($_POST['dintake'])&& isset($_POST['destd'])&& isset($_POST['type']))
        {

            $dept_id= strtoupper(sanitizeString(trim($_POST['dept_id'])));
            $dname= strtoupper(sanitizeString(trim($_POST['dname'])));
            $dhod=  strtoupper(sanitizeString(trim($_POST['dhod'])));
            $dintake=  sanitizeString(trim($_POST['dintake']));
            $destd=  sanitizeString(trim($_POST['destd']));
            $type=  sanitizeString($_POST['type']);
            if($dhod!="NULL"){
                $query="INSERT INTO Department VALUES('$dept_id','$dname','$dhod','$dintake','$destd','$type')";
            }
            else{   
                $query="INSERT INTO Department VALUES('$dept_id','$dname',NULL,'$dintake','$destd','$type')";
            }
  
            if(!mysql_query($query))
                echo "<center><span class='error'>INSERT Failed : ".  mysql_error()."</span></center>";
            else {
                echo '<div class="success">Record Successfully Inserted</div>';
                echo '<script language="javascript">';
                    echo 'alert("Record Successfully Created!\n'.
                    'You will be redirected to Department create page.")';
                echo '</script>';
                header("Refresh: 0; url=deptcreate.php");
            }
        }
    }
}

function insertClass()
{
    if($_POST)
    {


        if(isset($_POST['class_id'])&& isset($_POST['class'])){

            $class_id= strtoupper(sanitizeString(trim($_POST['class_id'])));
            $class= strtoupper(sanitizeString(trim($_POST['class'])));
            
            $query="INSERT INTO ClassRoom VALUES('$class_id','$class')"; 
            queryMysql($query);
            
            echo '<div class="success">Record Successfully Inserted</div>';
                echo '<script language="javascript">';
                    echo 'alert("Record Successfully Created!\n'.
                    'You will be redirected to Classroom create page.")';
                echo '</script>';
            header("Refresh: 0; url=createclassroom.php");
            
        }
    }
}

function insertCourse()
{
    if($_POST){

        if(isset($_POST['cid'])&& isset($_POST['ctitle'])&& isset($_POST['cabbrv'])&& isset($_POST['csem'])
        && isset($_POST['cobj'])&& isset($_POST['cout'])&& isset($_POST['crev'])
        && isset($_POST['cpr'])&& isset($_POST['cor'])&& isset($_POST['cth'])
        && isset($_POST['ctw'])&& isset($_POST['cia'])&& isset($_POST['cthcr'])
        && isset($_POST['cprcr'])&& isset($_POST['ctutcr'])&& isset($_POST['cdept'])
        && isset($_POST['cthhrs'])&& isset($_POST['cprhrs'])&& isset($_POST['ctuthrs'])){

            $cid= strtoupper(sanitizeString(trim($_POST['cid'])));
            $ctitle= strtoupper(sanitizeString(trim($_POST['ctitle'])));
            $cabbrv= strtoupper(sanitizeString(trim($_POST['cabbrv'])));
            $csem=$_POST['csem'];
            $cobj=sanitizeString(trim($_POST['cobj']));
            $cout=sanitizeString(trim($_POST['cout']));
            $cpr=trim($_POST['cpr']);
            $cor=trim($_POST['cor']);
            $cth=trim($_POST['cth']);
            $ctw=trim($_POST['ctw']);
            $cia=trim($_POST['cia']);
            $ctotalIM=$cpr+$cor+$cth+$ctw+$cia;
            $cthcr=trim($_POST['cthcr']);
            $cprcr=trim($_POST['cprcr']);
            $ctutcr=trim($_POST['ctutcr']);
            $ctotalIC=$cthcr+$cprcr+$ctutcr;
            $cthhrs=trim($_POST['cthhrs']);
            $cprhrs=trim($_POST['cprhrs']);
            $ctuthrs=trim($_POST['ctuthrs']);
            $ctotalHrs=$cprhrs+$cthhrs+$ctuthrs;
            $cdept=$_POST['cdept'];
            $crev="REV ".$_POST['crev'];
   
            $query="INSERT INTO Course VALUES".
                "('$cid','$ctitle','$cabbrv','$csem','$cobj','$cout','$cpr','$cor','$cth','$ctw','$cia',"
                . "'$ctotalIM','$cthcr','$cprcr','$ctutcr','$ctotalIC','$cthhrs','$cprhrs','$ctuthrs',"
                . "'$ctotalHrs','$cdept','$crev')";
    
  
            if(!mysql_query($query))
                echo "<center><span class='error'>INSERT Failed : ".  mysql_error()."</span></center>";
            else {
                echo '<div class="success">Record Successfully Inserted</div>';           
                echo '<script language="javascript">';
                    echo 'alert("Record Successfully Created!\n'.
                    'You will be redirected to Course Creation page.")';
                echo '</script>';
                header("Refresh: 0; url=createcourse.php");
        
            }
        }

    }
}

function insertGrade()
{
    if($_POST){

        if(isset($_POST['groll'])&& isset($_POST['gcourse'])&& 
            isset($_POST['gyear'])&& isset($_POST['gseat'])
            && isset($_POST['gpr'])&& isset($_POST['gor'])&& isset($_POST['gth'])
            && isset($_POST['gtw'])&& isset($_POST['gia'])){

            $groll= strtoupper(sanitizeString(trim($_POST['groll'])));
            $gcourse= strtoupper(sanitizeString(trim($_POST['gcourse'])));
            $gyear= sanitizeString(trim($_POST['gyear']));
            $gseat= strtoupper(sanitizeString(trim($_POST['gseat'])));
            $gpr=  intval(trim($_POST['gpr']));
            $gor=  intval(trim($_POST['gor']));
            $gth=  intval(trim($_POST['gth']));
            $gtw=  intval(trim($_POST['gtw']));
            $gia=  intval(trim($_POST['gia']));
            $gtotal=0;
            if($gpr==-1)
                $gpr="NULL";
            else
                $gtotal+=$gpr;
            
            if($gor==-1)
                $gor="NULL";
            else
                $gtotal+=$gor;
            
            if($gth==-1)
                $gth="NULL";
            else
                $gtotal+=$gth;
            
            if($gtw==-1)
                $gtw="NULL";
            else
                $gtotal+=$gtw;
            
            if($gia==-1)
                $gia="NULL";
            else
                $gtotal+=$gia;
            
            
            $query="INSERT INTO Grade VALUES".
                "('$groll','$gcourse','$gyear','$gseat',$gth,$gor,$gtw,$gpr,$gia,$gtotal)";
    
            //echo ''.$query;
            queryMysql($query);
                echo '<center><div class="success">Record Successfully Inserted</div></center>';           
                echo '<script language="javascript">';
                    echo 'alert("Record Successfully Created!")';
                echo '</script>';
                header("Refresh: 0; url=grade.php");
        
        }

    }
}

function insertSyllabus()
{
    if($_POST){
        if(isset($_POST['cscourse'])&& isset($_POST['cschap'])){
            $errflag=0;
            $cscourse=$_POST['cscourse'];
            $cschap=trim($_POST['cschap']);
            $i=1;
            while($i<=$cschap){
                $query="insert into Syllabus values('$cscourse','$i',NULL,NULL,NULL)";
                $result=  mysql_query($query);
                if(!result){
                    $errflag=1;
                    echo "<center><span class='error'>INSERT Failed : ".  mysql_error()."</span></center>";
                }
                $i++;
            }
            if($errflag==0){
                echo '<div class="success">Record Successfully Inserted</div>';
            
                echo '<script language="javascript">';
                echo 'alert("Record Successfully Created!\n'.
                    'You will be redirected to syllabus update \\ view page.")';
                echo '</script>';
                header("Refresh: 0; url=filtersyllabus.php");
            }
        }
    }
}

function insertTLO()
{
    if($_POST){
        if(isset($_POST['tlcourse'])&& isset($_POST['tlyear'])){
            $errflag=0;
            $count=0;
            $tlcourse=$_POST['tlcourse'];
            $tlyear=$_POST['tlyear'];
            
            $result=  queryMysql("select max(ch_no) as cnt from Syllabus where course_id='".$tlcourse."'");
            
            while($row=  mysql_fetch_array($result)){
                if($row['cnt']==0){
                    echo '<span class="error">Syllabus entry does not exist. '
                    . 'Please make an entry of subject syllabus first.</span>';
                    die();
                }
                $count=$row['cnt'];    
            }
            
            $i=1;
            
            while($i<=$count){
                $query="INSERT into TLO values('$tlcourse','$i','$tlyear',NULL,NULL,NULL,NULL,NULL,NULL)";
                //echo ''.$query;
                $result=  mysql_query($query);
                if(!result){
                    $errflag=1;
                    echo "<center><span class='error'>INSERT Failed : ".  mysql_error()."</span></center>";
                }
                $i++;
            }
            if($errflag==0){
                echo '<div class="success">Record Successfully Inserted</div>';
            
                echo '<script language="javascript">';
                   echo 'alert("Record Successfully Created!\n'.
                        'You will be redirected to TLO update \\ view page.")';
                echo '</script>';
                header("Refresh: 0; url=tlo.php");
            }
        }
    }
}

function insertCASheets()
{
    if($_POST){
        if(isset($_POST['cacourse'])&& isset($_POST['cayear'])){
            $errflag=0;
            $count=0;
            $cacourse=$_POST['cacourse'];
            $cayear=$_POST['cayear'];
            if($cacourse==""){
                     echo '<span class="error">Please Select Course.</span>';
                     die();   
            }
            
            $result= queryMysql("select * from Course where course_id='".$cacourse."' and TW!=0 and TW is not NULL");
            
            if(mysql_num_rows($result)==0){
                echo '<span class="error">Term Work does not exist for this subject';
                echo 'You cannot proceed further</span>';
                die();
            }
            echo '<span class="info">'
                    . 'This is a database intensive operation.Please wait while CA sheets is created.'
                    . 'Do not close or referesh the window'
                . '</span>';
            $multi_sql_query="";
            $result=  queryMysql("select * from TwComponents");
            
            while($row=  mysql_fetch_array($result)){
                if(isset($_POST["".$row[compo_id].""])){
                 $weightage=trim($_POST["weight_".$row[compo_id].""]);
                 $compo_nos=trim($_POST["compo_nos_".$row[compo_id].""]);
                 if($weightage==""||$compo_nos==""||intval($weightage)<=0||intval($compo_nos)<=0){
                     echo '<span class="error">Weightage / Total Count cannot be empty or 0 or negative value</span>';
                     die();
                 }
                 $multi_sql_query.="Insert into TwCompoWeight values('$row[compo_id]','$cacourse','$cayear','$weightage','$compo_nos');";        
                }
            }
            global $db_host,$db_password,$db_name,$db_user,$db_name;
            $link = mysqli_connect($db_host,$db_user,$db_password,$db_name);
               //check Connection
               if (mysqli_connect_errno()) {
                 printf("Connect failed: %s\n", mysqli_connect_error());
                 exit();
               }
       
                    /* execute multi query */
            
                //    echo ''.$multi_sql_query;
                
               if (mysqli_multi_query($link, $multi_sql_query)) {
                   do{
                       ;//empty stmt
                   }while (mysqli_next_result($link));
                   echo '<span class="success">Record Successfully Inserted</span>';
                }
                else {
                    echo "<span class='error'>INSERT/UPDATE Failed : ". mysqli_error($link)."</span>";
                    die();
                }
                 mysqli_close($link);
                 
                 $multi_sql_query="";
                 $result=  queryMysql("select compo_id,compo_nos from TwCompoWeight where course_id='".$cacourse."' and year='".$cayear."' order by compo_id");
                 while($row=  mysql_fetch_array($result))
                 {
                     $compo_count=$row['compo_nos'];
                     $result2=  queryMysql("select rollno from Takes where course_id='".$cacourse."' and year='".$cayear."'");
                     while($row2=  mysql_fetch_array($result2))
                     {
                         $i=1;
                         while($i<=$compo_count)
                         {
                             $multi_sql_query.="Insert into CA values('$row2[rollno]','$cacourse','$cayear','$row[compo_id]','$i',NULL);";
                             $i++;
                         }  
                     }
                 }
                 //echo ''.$multi_sql_query;
                 global $db_host,$db_password,$db_name,$db_user,$db_name;
                 $link = mysqli_connect($db_host,$db_user,$db_password,$db_name);
            
                if (mysqli_connect_errno()) {
                     printf("Connect failed: %s\n", mysqli_connect_error());
                    exit();
                }
                 if (mysqli_multi_query($link, $multi_sql_query)) 
                {
                 do{
                       ;//empty stmt
                   }while (mysqli_next_result($link));
                 echo '<div class="success">CA Sheets Successfully Created</div>';
                 echo '<script language="javascript">';
                 echo 'alert("CA Sheets Successfully Created!\n'.
                            'You will be redirected to CA update \\ view page.")';
                 echo '</script>';
                 header("Refresh: 0; url=CA.php");
                }
                 else {
                 echo "<span class='error'>INSERT/UPDATE Failed : ". mysqli_error($link)."</span>";
                 die();
                 }
                 
                 exit;
                 /* close connection */
                 mysqli_close($link);
           }
    }
}

function insertUser(){

    if($_POST){
        if(isset($_POST['user'])&& isset($_POST['cufsname'])&& isset($_POST['pass'])&& isset($_POST['cpass'])&& isset($_POST['cutype'])){
            $user= strtolower(sanitizeString(trim($_POST['user'])));
            $facs_id= strtoupper(sanitizeString(trim($_POST['cufsname'])));
            $pass=  sanitizeString($_POST['pass']);
            $cpass=  sanitizeString($_POST['cpass']);
            $cutype=  sanitizeString(trim($_POST['cutype']));   
            $creation=date("Y-m-d H:i:s",time());
        
            if($cpass!=$pass){
                echo '<span class="error">Passwords does not match</span>';
                die();
            }
            else{
                $s1="su*!#er";
                $s2="ts&a@s#";
                $token = hash('ripemd128', "$s1$pass$s2");
                $query="Insert into Access values('$user','$token','$facs_id','$creation','$cutype')";
                $result=  queryMysql($query);
                if($result){
                    echo '<div class="success">User Successfully Created</div>';
                    echo '<script language="javascript">';
                        echo 'alert("User Successfully Created!\n'.
                        'You will be redirected to index page.")';
                    echo '</script>';
                    header("Refresh: 0; url=index.php");
                }
            
            }
                     
        }
    }
}

function assignCourse()
{
    if($_POST){
        if(isset($_POST['ahours'])&& isset($_POST['afaculty'])&& isset($_POST['ayear'])&& isset($_POST['acourse'])){

        $afaculty=$_POST['afaculty'];
        $ayear=$_POST['ayear'];
        $acourse=$_POST['acourse'];
        $abit=$_POST['abit'];
        $ahours=trim($_POST['ahours']);
        if($abit==0){
            if(isset($_POST['ab1']))
                $query.="INSERT INTO Teaches VALUES('$afaculty','$acourse','$ayear','$abit','1','$ahours');";
            if(isset($_POST['ab2']))
                $query.="INSERT INTO Teaches VALUES('$afaculty','$acourse','$ayear','$abit','2','$ahours');";
            if(isset($_POST['ab3']))
                $query.="INSERT INTO Teaches VALUES('$afaculty','$acourse','$ayear','$abit','3','$ahours');";
            if(isset($_POST['ab4']))
                $query.="INSERT INTO Teaches VALUES('$afaculty','$acourse','$ayear','$abit','4','$ahours');";
        }    
        else {
            $query="INSERT INTO Teaches VALUES('$afaculty','$acourse','$ayear','$abit','0','$ahours')";
        }
    
        global $db_host,$db_password,$db_name,$db_user,$db_name;
        $link = mysqli_connect($db_host,$db_user,$db_password,$db_name);
            
        if (mysqli_connect_errno()) {
            printf("Connect failed: %s\n", mysqli_connect_error());
            exit();
        }
       
                    /* execute multi query */
            
        //echo ''.$query;
                
        if (mysqli_multi_query($link, $query)) {
            echo '<div class="success">Record Successfully Inserted</div>';
            echo '<script language="javascript">';
                echo 'alert("Course Successfully Assigned!\n'.
                'Please wait while you are redirected to Course Assignment page")';
             echo '</script>';
             header("Refresh: 0; url=assigncourse.php");
        }
        else {
            echo "<span class='error'>INSERT/UPDATE Failed : ". mysqli_error($link)."</span>";
            die();
        }
        exit;
                
                    /* close connection */
        mysqli_close($link);
    
        }

    }
}


function assignCourseSlot()
{
    if($_POST){


        if(isset($_POST['cslot'])&& isset($_POST['csem'])&& isset($_POST['ccourse'])
            && isset($_POST['cdept'])&& isset($_POST['croom'])&& isset($_POST['cyear'])
            && isset($_POST['cday'])&& isset($_POST['cthpr']) ){

            $cslot=$_POST['cslot'];
            $csem=$_POST['csem'];
            $ccourse=$_POST['ccourse'];
            $cdept=$_POST['cdept'];
            $croom=$_POST['croom'];
            $cyear=$_POST['cyear'];
            $cday=$_POST['cday'];
            $cthpr=$_POST['cthpr'];
    
            $query="INSERT INTO TimeTable VALUES('$cslot','$csem','$ccourse','$cdept','$croom','$cyear','$cday','$cthpr')";
            queryMysql($query);    
     
            if(intval($cthpr)==0){
                $cslot=  intval($cslot)+1;
                $query="INSERT INTO TimeTable VALUES('$cslot','$csem','$ccourse','$cdept','$croom','$cyear','$cday','$cthpr')";
                queryMysql($query);
            }   
     
            echo '<div class="success">Record Successfully Inserted</div>';   
            echo '<script language="javascript">';
                echo 'alert("Slot Successfully Assigned!\n'.
                'You will be redirected to Time Table Creation Page.")';
            echo '</script>';
            header("Refresh: 0; url=createtimetable.php");
        
    
        }

    }
}

function markAttendence()
{
    if($_POST){
       if(isset($_POST['acourse_id'])&& isset($_POST['afdol'])&& isset($_POST['ayear'])
               && isset($_POST['athorpr'])&& isset($_POST['aslot'])&& isset($_POST['abatch'])){
           $acourse_id= $_POST['acourse_id'];
           $afdol=$_POST['afdol'];
           $ayear=$_POST['ayear'];
           $athorpr=intval($_POST['athorpr']);
           $aslot=  intval($_POST['aslot']);
           $abatch=  intval($_POST['abatch']);
           
           $errflag=0;
           if($athorpr==0)
               $insCount=2;
           else
               $insCount=1;
           
           if (is_array($_POST['rollno'])) {
               
            foreach($_POST['rollno'] as $value){
                 $i=1;
                 while($i<=$insCount){
                    $query="INSERT INTO Absentee VALUES('$value','$acourse_id','$afdol','$ayear','$athorpr','$aslot','$abatch')";
                    if(!mysql_query($query)){
                         echo "<center><span class='error'>INSERT Failed : ".  mysql_error()."</span></center>";
                        $errflag=1;}
                    /*else {
                        echo '<div class="success">Record Successfully Inserted for '.$value.'</div>';   
                    }*/
                    $aslot++;
                    $i++;
                 }
                 if($athorpr==0)
                    $aslot-=2;
                 else
                    $aslot--;
            }
          }
             
          else {
                  if(isset($_POST['rollno'])){
                    $value = $_POST['rollno'];
                    $i=1;
                    while($i<=$insCount){
                 
                        $query="INSERT INTO Absentee VALUES('$value','$acourse_id','$afdol','$ayear','$athorpr','$aslot','$abatch')";
                        if(!mysql_query($query)){
                            echo "<center><span class='error'>INSERT Failed : ".  mysql_error()."</span></center>";                  $errflag=1;}
                        /*else {
                          echo '<span class="success">Record Successfully Inserted for '.$value.'</span>';   
                        }*/
                        $aslot++;
                        $i++;
                    }
                    if($athorpr==0)
                        $aslot-=2;
                    else
                        $aslot--;                    
                 }
         }
        
        if($errflag==0){
                echo '<script language="javascript">';
                   echo 'alert("Records Successfully Inserted!\n'.
                        'You will be redirected to Attendence Selection and Marking Page.")';
                echo '</script>';
                header("Refresh: 0; url=filteratt.php");
        }    
     }
                
                
              
   }
}

function loadTeachYear()
{
    $sql_query = "select distinct year from Teaches order by year";
    $result= queryMysql($sql_query);
    
    echo "<option value=''>------</option>";
    while($row = mysql_fetch_array($result)){
        echo "<option value='".$row["year"]."'>".$row["year"]."</option>";
    }
}

function loadStudentYear()
{
    $sql_query = "select distinct year from Student order by year";
    $result= queryMysql($sql_query);
    
    echo "<option value=''>------</option>";
    while($row = mysql_fetch_array($result)){
        echo "<option value='".$row["year"]."'>".$row["year"]."</option>";
    }
}

function updateTest()
{
    if($_POST)
    {
        if(isset($_POST['tmyear'])&& isset($_POST['tmsub'])) {
            $tmyear=$_POST['tmyear'];
            $tmsub=$_POST['tmsub'];
            $errflag=0;
        
            $query="select * from Takes natural join Test where year='".$tmyear."' and course_id='".$tmsub."'";
        
            if(!mysql_query($query)){
                echo "<span class='error'>Failed to execute query : ".  mysql_error()."</span>";      
                die();
            }
        
            $result=  mysql_query($query); 
            if(mysql_num_rows($result)==0)
            {   
                $errflag=1;
                echo '<span class="error">No Records Found</span>';
                die();
            }
            else {           
                while($row = mysql_fetch_array($result)){
                if(($row[t1]==NULL || $row[t2]==NULL)
                    &&($_POST["".$row['rollno']."_t1"]!="" || $_POST["".$row['rollno']."_t2"]!="")
                    &&(($row[t1]==NULL && $_POST["".$row['rollno']."_t1"]!="")
                   ||($row[t2]==NULL && $_POST["".$row['rollno']."_t2"]!="" ))){   
                    
                    $sql_query = "update Test set t1=";
                        if($_POST["".$row['rollno']."_t1"]=="")
                            $sql_query .="NULL";
                        else
                            $sql_query .= trim($_POST["".$row['rollno']."_t1"]);
                
                        $sql_query .=", t2=";
                
                        if($_POST["".$row['rollno']."_t2"]=="")
                            $sql_query .="NULL";
                        else
                            $sql_query .=trim($_POST["".$row['rollno']."_t2"]);
                
                        $sql_query .=" where rollno='".$row['rollno']."' and course_id='".$tmsub."' and year='".$tmyear."'";
              
                     //   echo 'T1--'.$_POST["".$row['rollno']."_t1"];
                    //echo ''.$sql_query;
                        $res=  mysql_query($sql_query);
                        if(!$res){   
                            $errflag=1;
                            echo 'Unable to Execute the Query:'.$sql_query.
                            "\nRecieved following error".  mysql_error();
                            die();
                        }
                        /*else {
            
                            echo '<font color="GREEN">Record Successfully Updated for Roll No.'.$row['rollno'].'</span>';
     
                        }*/
                    }
                }
             
            }
            if($errflag==0){
                echo '<center>'
                    . '<div class="success">'
                            . 'Records Successfully Updated</div></center>';
                echo '<script language="javascript">';
                echo 'alert("Record Successfully Updated!\n'.
                    'You will be redirected to Test Update Page.")';
                echo '</script>';
               // header("Refresh: 0; url=tm.php");
            }
        
       }
 
        
    }
}

function updateFacultyProfile(){
 if($_POST){
        
     if(isset($_POST[fpug])&& isset($_POST[fppg])&& isset($_POST[fpphd])&& isset($_POST[fptexp])
             && isset($_POST[fpiexp])&& isset($_POST[fppaper_pub_nat])&& isset($_POST[fppaper_pub_int])
             && isset($_POST[fppaper_presen_nat])&& isset($_POST[fppaper_pub_int])&& isset($_POST[fpphd_guide_proj])
             && isset($_POST[fpmaster_guide_proj])&& isset($_POST[fpbooks_ipr])&& isset($_POST[fpprof_member])
             && isset($_POST[fpconsultancy])&& isset($_POST[fpawards])&& isset($_POST[fpgrants])&& isset($_POST[fpprof_inter])){
         
        if(isset($_POST[photocheck])){
            $id=saveimage($_SESSION[fac_id]);
            queryMysql("Update FacultyProfile set image_id='".$id."' where fac_id='".$_SESSION[fac_id]."'");
        }
        
        $query="UPDATE FacultyProfile SET ug='".sanitizeString($_POST[fpug])."',"
            . " `pg`='".sanitizeString($_POST[fppg])."',"
            . " `phd`='".sanitizeString($_POST[fpphd])."',"
            . " `exp_teach`='".sanitizeString($_POST[fptexp])."',"
            . " `exp_ind`='".sanitizeString($_POST[fpiexp])."',"
            . " `paper_national_pub`='".sanitizeString($_POST[fppaper_pub_nat])."',"
            . " `paper_international_pub`='".sanitizeString($_POST[fppaper_pub_int])."',"
            . " `paper_national_presen`='".sanitizeString($_POST[fppaper_presen_nat])."',"
            . " `paper_international_presen`='".sanitizeString($_POST[fppaper_presen_int])."',"
            . " `proj_guide_phd`='".sanitizeString($_POST[fpphd_guide_proj])."',"
            . " `proj_guide_master`='".sanitizeString($_POST[fpmaster_guide_proj])."',"
            . " `book_ipr_patent`='".sanitizeString($_POST[fpbooks_ipr])."',"
            . " `prof_member`='".sanitizeString($_POST[fpprof_member])."',"
            . " `consultancy`='".sanitizeString($_POST[fpconsultancy])."',"
            . " `awards`='".sanitizeString($_POST[fpawards])."',"
            . " `grants`='".sanitizeString($_POST[fpgrants])."',"
            . " `prof_interaction`='".sanitizeString($_POST[fpprof_inter])."' WHERE `fac_id`='".$_SESSION[fac_id]."'";
     
    //echo ''.$query;
            queryMysql($query);
           /* echo '<center>'
                    . '<div class="success">'
                            . 'Profile Successfully Updated</div></center>';*/
                echo '<script language="javascript">';
                echo 'alert("Profile Successfully Updated!")';
                echo '</script>';            
    }
 }
}
function updatePracPlan()
{
    if($_POST)
    {
        if(isset($_POST[uppyear])&& isset($_POST[uppcourse])&& isset($_POST[uppfac_id])&& isset($_POST[batch])){
                $uppyear=$_POST['uppyear'];
                $uppcourse=$_POST['uppcourse'];
                $uppfac_id=$_POST['uppfac_id'];
                $batch=$_POST['batch'];
                $errflag=0;
                $result=  queryMysql("select * from PracPlan where course_id='".$uppcourse."' and year='".$uppyear."' and batch in ".$batch." order by expno,batch;");
                while($row=mysql_fetch_array($result)){
                            //echo ''.$row2['batch'];
               
                            $upptitle=  sanitizeString(trim($_POST["title_".$row['expno'].""]));
                            $upppd=trim($_POST["pd_".$row['batch'].$row['expno'].""]);
                            $uppdop=trim($_POST["dop_".$row['batch'].$row['expno'].""]);
                         if(($upptitle!="" || $upppd!="" || $uppdop!="")&&
                                 ($row['title']==NULL || $row[pd]==NULL || $row[dop]==NULL)
                                &&(($row['title']==NULL && $upptitle!="")||
                                 ($row['pd']==NULL && $upppd!="")||
                                 ($row['dop']==NULL &&$uppdop!=""))
                                 ){   
                            $query="UPDATE PracPlan SET";
                            //echo 'p1'.$upptitle.'p2'.$upppd.'p3'.$uppdop;
                            if($upptitle=="")
                                $query.=" title=NULL,";
                            else 
                                $query.=" title='".$upptitle."',";
                            
                            if($upppd=="")
                                $query.="pd=NULL,";
                            else{ 
                                $upppd=date('Y-m-d',strtotime(str_replace('/','.',$upppd)));
                                $query.="pd='".$upppd."',";
                            }
                            
                            if($uppdop=="")
                                $query.="dop=NULL";
                            else {
                                $uppdop=date('Y-m-d',strtotime(str_replace('/','.',$uppdop)));
                                $query.="dop='".$uppdop."'";
                            }
                            
                            $query.=" where course_id='".$uppcourse."' and year='".$uppyear."' and expno='".$row[expno]."' and batch='".$row[batch]."'";
                            //echo ''.$query;
                            $resupdatepp=  mysql_query($query);
                            if(!$resupdatepp)    
                            {
                                $errflag=1;
                                echo 'Unable to Execute the Query:'.$query.
                                "\nRecieved following error".  mysql_error();
                                die();
                            }
                            /*else {
            
                                echo '<font color="GREEN">Record Successfully Updated for Exp No: '.$row['expno'].'  Batch: '.$row['batch'].'</span>';
     
                            }*/
                         }
                        }
                    
                
             if($errflag==0){
                echo '<center>'
                    . '<div class="success">'
                            . 'Records Successfully Updated</div></center>';
                /*echo '<script language="javascript">';
                echo 'alert("Records Successfully Updated!\n'.
                    'You will be redirected to Practical Plan Update page.")';
                echo '</script>';
                //header("Refresh: 0; url=filterpp.php");*/
            } 
        }
    }
}

function updateSyllabus()
{
    if($_POST){
        if(isset($_POST['uscourse'])) {
        //$usrevyear=$_POST['usrevyear'];
        $uscourse=$_POST['uscourse'];
        
        $query="select * from Syllabus where course_id='".$uscourse."'";
        
       if(!mysql_query($query)){
            echo "<span class='error'>Failed to execute query : ".  mysql_error()."</span>";      
            die();
       }
        
        $result=  mysql_query($query); 
        if(mysql_num_rows($result)==0)
        {
            echo '<span class="error">No Records Found</span>';
        }
        else {
            $errflag=0;
            
            while($row = mysql_fetch_array($result)){
                $sql_query="";
             if(!($row['ch_title']!=NULL && $row['topics']!=NULL && $row['hrs']!=NULL)
                     &&($_POST["".$row['ch_no']."_title"]!="" || $_POST["".$row['ch_no']."_topics"]!=""
                     || $_POST["".$row['ch_no']."_hrs"]!="")){
                $sql_query .= "update Syllabus set ch_title=";
                
                if($_POST["".$row['ch_no']."_title"]==""){
                    $sql_query .="NULL";
                }
                else{
                    $sql_query .="'".trim($_POST["".$row['ch_no']."_title"])."'";
                }
           
                if($row['topics']==NULL && $_POST["".$row['ch_no']."_topics"]!=""){
                    $sql_query .=", topics='".trim($_POST["".$row['ch_no']."_topics"])."'";
                    $feildCount++;
                }
           
                if($row['hrs']==NULL && $_POST["".$row['ch_no']."_hrs"]!=""){
                    $sql_query .=", hrs='".trim($_POST["".$row['ch_no']."_hrs"])."'";
                    $feildCount++;
                }
                $sql_query .=" where course_id='".$uscourse."' and ch_no=".$row['ch_no'];
                //echo ''.$sql_query;
                    $res=  mysql_query($sql_query);
                    if(!$res)    
                    {
                        $errflag=1;
                        echo '<span class="error">Unable to Execute the Query:'.$sql_query.
                            "\nRecieved following error".  mysql_error()."</span>";
                        die();
                    }   
                }
            }
             if($errflag==0){
                echo '<center>'
                    . '<div class="success">'
                            . 'Records Successfully Updated</div></center>';
               /* echo '<script language="javascript">';
                echo 'alert("Record Successfully Updated!\n'.
                    'You will be redirected to syllabus update \\ view page.")';
                echo '</script>';
                header("Refresh: 0; url=filtersyllabus.php");*/
            }
        
        }
       }
    }
}

function updateTLO()
{
    if($_POST){
        if(isset($_POST['utyear'])&& isset($_POST['utcourse'])) {
        $utyear=$_POST['utyear'];
        $utcourse=$_POST['utcourse'];
        
        $query="select * from TLO where year='".$utyear."' and course_id='".$utcourse."'";
        
       if(!mysql_query($query)){
            echo "<span class='error'>Failed to execute query : ".  mysql_error()."</span>";      
            die();
       }
        
        $result=  mysql_query($query); 
        if(mysql_num_rows($result)==0)
        {
            echo '<span class="error">No Records Found</span>';
        }
        else {
            $errflag=0;   
            while($row = mysql_fetch_array($result)){
                
                $subtopics=sanitizeString (trim($_POST["".$row['ch_no']."_subtopics"]));
                $subhrs=sanitizeString (trim($_POST["".$row['ch_no']."_subhrs"]));
                $topicoutcomes=sanitizeString (trim($_POST["".$row['ch_no']."_topics_outcomes"]));
                $pcd=sanitizeString (trim($_POST["".$row['ch_no']."_pcd"]));
                $acd=sanitizeString (trim($_POST["".$row['ch_no']."_acd"]));
                $remarks=sanitizeString (trim($_POST["".$row['ch_no']."_remarks"]));
                
                if(($row[subtopics]==NULL||$row[subhrs]==NULL||$row[topics_outcomes]==NULL||
                  $row[pcd]==NULL||$row[acd]==NULL||$row[remarks]==NULL)&&
                    ($subtopics!=""||$subhrs!=""||$topicoutcomes!=""||$pcd!=""||$acd!=""||$remarks!="")    
                    &&(($row[subtopics]==NULL && $subtopics!="")
                    ||($row[subhrs]==NULL && $subhrs!="")
                    ||($row[topics_outcomes]==NULL && $topicoutcomes!="")
                    ||($row[pcd]==NULL && $pcd!="")
                    ||($row[acd]==NULL && $acd!="")
                    ||($row[remarks]==NULL && $remarks!=""))){
                    $sql_query="";
                    $sql_query .= "update TLO set subtopics=";
                    if($subtopics=="")
                        $sql_query .="NULL";
                    else
                        $sql_query .="'".$subtopics."'";
                
                     $sql_query .=", subhrs=";
                
                    if($subhrs=="")
                         $sql_query .="NULL";
                    else
                        $sql_query .="'".$subhrs."'";
                
                     $sql_query .=", topics_outcomes=";
                    if($topicoutcomes=="")
                         $sql_query .="NULL";
                    else
                         $sql_query .="'".$topicoutcomes."'";
                
                     $sql_query .=", pcd=";
                
                    if($pcd=="")
                        $sql_query .="NULL";
                    else
                        $sql_query .="'".$pcd."'";
                
                     $sql_query .=", acd=";
                
                    if($acd=="")
                         $sql_query .="NULL";
                    else
                        $sql_query .="'".$acd."'";
                
                    $sql_query .=", remarks=";
                
                    if($remarks=="")
                     $sql_query .="NULL";
                    else
                     $sql_query .="'".$remarks."'";
                
               
                    $sql_query .=" where course_id='".$utcourse."' and year='".$utyear."' and ch_no=".$row['ch_no'];
                    //echo ''.$sql_query;
                    $res=  mysql_query($sql_query);
                    if(!$res)    
                    {
                        $errflag=1;
                        echo '<span class="error">Unable to Execute the Query:'.$sql_query.
                        "\nRecieved following error".  mysql_error()."</span>";
                        die();
                    }
                    
                }    
            }
            if($errflag==0){
                echo '<center>'
                    . '<div class="success">'
                            . 'Records Successfully Updated</div></center>';
               /* echo '<script language="javascript">';
                echo 'alert("Record Successfully Updated!\n'.
                    'You will be redirected to TLO update page.")';
                echo '</script>';
                //header("Refresh: 0; url=tlo.php");*/
            }
        
        }
       }
    }
}

function updateCA()
{
    
    if($_POST){
        
        
        if(isset($_POST['ucayear'])&& isset($_POST['ucacourse'])&& isset($_POST['ucafac_id'])&& isset($_POST['ucabatch'])) {
            $ucayear=$_POST['ucayear'];
            $ucacourse=$_POST['ucacourse'];
            $ucafac_id=$_POST['ucafac_id'];
            $ucabatch=$_POST['ucabatch'];
            $errflag=0;
            //print_r(count($_POST));
                  $query="select c.*,s.name,s.batch,t.weightage,t.compo_nos from CA c natural join Student s natural join TwCompoWeight t where c.course_id='".$ucacourse."' and c.year='".$ucayear."' and s.batch in ".$ucabatch." order by rollno asc,compo_nos desc,compo_no asc";         
                  $result=  queryMysql($query);
                  if(mysql_num_rows($result)==0){
                    echo '<span class="error">No Records Found</span>';
                    die();
                    }
            
                while ($row = mysql_fetch_array($result)) {
                    $rollno=$row['rollno'];
                    $compoId=$row['compo_id'];
                    $count=$row['compo_no'];
                  if($row['marks']==NULL && $_POST["".$rollno."_".$compoId."_".$count."_marks"]!=""){                                
                    $sql_query="";
                    $sql_query .= "update CA set marks=";
                    if($_POST["".$rollno."_".$compoId."_".$count."_marks"]=="")
                        $sql_query .="NULL";
                    else
                        $sql_query .="'".sanitizeString (trim($_POST["".$rollno."_".$compoId."_".$count."_marks"]))."'";
                
                    $sql_query .=" where rollno='".$rollno."' and course_id='".$ucacourse."' and year='".$ucayear."' and compo_id=".$compoId." and compo_no=".$count;
         
                    //echo ''.$sql_query;
                    
                    $res2=  mysql_query($sql_query);
                    if(!$res2){
                        $errflag=1;
                        echo '<span class="error">Unable to Execute the Query:'.$sql_query.
                         "\nRecieved following error".  mysql_error()."</span>";
                        die();
                    }         
                  }
                }
          
                if($errflag==0){
   /*                 echo '<center>'
                    . '<div class="success">'
                            . 'Records Successfully Updated</div></center>';*/
                   echo '<script language="javascript">';
                    echo 'alert("Record Successfully Updated!\n")';
                    echo '</script>';
                    //header("Refresh: 0; url=updateca.php");
                }
        }
    }
}


function auto_copy_year($year='auto')
{
    if(intval($year) == 'auto'){$year=date('Y');}
    if(intval($year) == date('Y')){echo intval($year);}
    if(intval($year) < date('Y')){echo intval($year).'-'.date('Y');}
    if(intval($year) > date('Y')){echo date('Y');}
}

function academic_year()
{
    $month=date('m');
    if($month>=1 && $month<=6){return 'First Half '.date('Y');}
 else {return 'Second Half '.date('Y');}
}

function prev_academic_year()
{
    $month=date('m');
    if($month>=1 && $month<=6){return 'Second Half '.(date('Y')-1);}
 else {return 'First Half '.date('Y');}
}

function saveimage($facid)
{
    
    if(getimagesize($_FILES['image']['tmp_name'])==FALSE)
    {
        echo "Please Select An Image.";
        die();
    }
    else
    {
       $size = getimagesize($_FILES['image']['tmp_name']);
       $size = $size[3];
       $maxsize = 99999999;
       $image= addslashes($_FILES['image']['tmp_name']);
       $name= addslashes($_FILES['image']['name']);
       $image= file_get_contents($image);
       $image= base64_encode($image);
       if($_FILES['image']['size'] < $maxsize ){
            $qry="insert into Images (image,image_name,fac_id) values ('$image','$name','$facid')";
            //echo ''.$qry;
            $result=mysql_query($qry);
            $resc=  queryMysql("select last_insert_id() as id");
            if($result)
            {
                echo "<br/><div class='success'>Image uploaded.</div>";
                while($row=  mysql_fetch_array($resc)){$id=$row['id'];}
                return $id;
            }
            else
            {
                echo "<br/><span class='error'>Image not uploaded.</span>";
                die(mysql_error());
            }
       }
       else {
           echo '<span class="error">File Size sholuld be less than 970 kb</span>';
       }
    }
}

function displayImage($id)
{
    $qry="select * from Images where image_id='".$id."'";
    $result=mysql_query($qry);
    while($row = mysql_fetch_array($result)){
        echo '<img height="200" width="200" src="data:image/png/jpeg/bmp/gif;base64,' .$row['image']. '" style="width:200px; height:200px; margin:0;"> ';
    }
}

function changePass(){

if($_POST){
    if(isset($_POST['user'])&& isset($_POST['pass'])&& isset($_POST['cpass'])){
        $user= strtolower(sanitizeString(trim($_POST['user'])));
        $pass=  sanitizeString(trim($_POST['pass']));
        $cpass=  sanitizeString(trim($_POST['cpass']));
        
        if($cpass!=$pass){
            echo '<span class="error">Passwords does not match</span>';
            die();
        }
        else
        {
            $s1="su*!#er";
            $s2="ts&a@s#";
            $token= hash('ripemd128', "$s1$pass$s2");
            $query="update Access set pass='".$token."' where userid='".$user."'";
            $result=  queryMysql($query);
            if($result)
            {
                echo '<span class="success">Password Successfully Changed</span>';
                if($_SESSION['grid']!=='3'){
                    echo '<script language="javascript">';
                    echo 'alert("Password Successfully Changed!\n'.
                    'Please Login Again.")';
                    echo '</script>';
                    header("Refresh: 0; url=logout.php");
                }
                else {
                    echo '<script language="javascript">';
                    echo 'alert("Password Successfully Changed!\n")';
                    echo '</script>';
                    header("Refresh: 0; url=changepass.php");
                }
                
            }
            
        }
                     
    }
  }

}
function loadFacultyDept()
{
    $sql_query="select dept from Faculty where fac_id='".$_SESSION['fac_id']."'";

    $result= queryMysql($sql_query);
    while($row = mysql_fetch_array($result)){
        $dept=$row['dept'];
    }
    return $dept;
}

function insertAccessInfo($userid){
    $ipaddr=$_SERVER['REMOTE_ADDR'];
    $ipaddrfwd=$_SERVER['HTTP_X_FORWARDED_FOR'];
    $hwmac="";
    $actime=date("Y-m-d H:i:s",time());
 
    //PRXY
######################################################   
    //win
    #run the external command, break output into lines
    $arp=`arp -a $ipaddr`;
    $lines=explode("\n", $arp);
  
    #look for the output line describing our IP address
    foreach($lines as $line)
    {
        $cols=preg_split('/\s+/', trim($line));
        if ($cols[0]==$ipaddr)
        {
           $hwmac.='W1-'.$cols[1];
        }
    }
    
    //lin
    $arp=`arp -n $ipaddr`;
    $lines=explode("\n", $arp);
    #look for the output line describing our IP address
    foreach($lines as $line)
    {
        $cols=preg_split('/\s+/', trim($line));
        if ($cols[0]==$ipaddr)
        {
           $hwmac.='L1-'.$cols[2];
        }
    }
 
if($ipaddrfwd!=""){    
    //HTTP_FOR
######################################################   
    //win
    #run the external command, break output into lines
    $arp=`arp -a $ipaddrfwd`;
    $lines=explode("\n", $arp);
  
    #look for the output line describing our IP address
    foreach($lines as $line)
    {
        $cols=preg_split('/\s+/', trim($line));
        print_r($cols);
        echo '<br>';
        if ($cols[0]==$ipaddrfwd)
        {
           $hwmac.='W2-'.$cols[1];
        }
    }
    
    
    //lin
    $arp=`arp -n $ipaddrfwd`;
    $lines=explode("\n", $arp);
    #look for the output line describing our IP address
    foreach($lines as $line)
    {
        $cols=preg_split('/\s+/', trim($line));
        echo '<br><br><br>';
        print_r($cols);
        echo '<br>';
        if ($cols[0]==$ipaddrfwd)
        {
           $hwmac.='L2-'.$cols[2];
        }
    }
}
    
    $query="INSERT into AccessInfo values('$userid','$ipaddr','$ipaddrfwd','$hwmac','$actime')";
    queryMysql($query);
}
 
function updateStudent(){
 if($_POST){
            
     if(isset($_POST[usrollno])&& isset($_POST[usname])&& isset($_POST[usaddress])
             && isset($_POST[usraddress])&& isset($_POST[ussem])
             && isset($_POST[usphoneno])&& isset($_POST[uspphoneno])
             && isset($_POST[usemail])&& isset($_POST[usbatch])){
        
        $query="UPDATE Student SET "
            . " name='".sanitizeString($_POST[usname])."',"
            . " address='".sanitizeString($_POST[usaddress])."',"
            . " res_add='".sanitizeString($_POST[usraddress])."',"
            . " sem='".sanitizeString($_POST[ussem])."',"
            . " phoneno=".sanitizeString($_POST[usphoneno]).","
            . " pphoneno=".sanitizeString($_POST[uspphoneno]).","
            . " email='".sanitizeString($_POST[usemail])."',"
            . " batch=".sanitizeString($_POST[usbatch]).""
            . " WHERE rollno='".$_POST[usrollno]."'";
     
    //echo ''.$query;
            queryMysql($query);
            echo '<center>'
                    . '<div class="success">'
                            . 'Student Profile Successfully Updated</div></center>';            
            echo '<script language="javascript">';
            echo 'alert("Student Profile Sucessfully Updated!\n'.
            'Please wait while you are redirected to Index page")';
             echo '</script>';
             header("Refresh: 0; url=index.php");
    }
 }
}

?>
