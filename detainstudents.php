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
*   Created On: 4 Jun, 2015, 4:05:16 PM
*   Author: Muhammed Salman Shamsi
*/
include('../mpdf/mpdf.php');

require_once 'functions/header.php';  

if($loggedin)
{    
if($_POST){
    if(isset($_POST['ddept'])&& isset($_POST['dsem'])&& isset($_POST['dyear'])&& isset($_POST['dssem'])&& isset($_POST['dsyear']) ){
        $ddept=$_POST['ddept'];
        $dsem=$_POST['dsem'];
        $dyear=$_POST['dyear'];
        $dssem=$_POST['dssem'];
        $dsyear=$_POST['dsyear'];
        //$query="select rollno from Student where dept='".$pdept."' AND sem='".$psem."' AND year='".$pyear."'";
          
        if (is_array($_POST['rollno'])) {
               
            foreach($_POST['rollno'] as $value){
                    
                    $multi_sql_query="";
                    $takeserr=0;$testerr=0;$studenterr=0;
                
                    $query="select course_id from Course where dept='".$ddept."' AND sem='".$dssem."'";
                    $result= queryMysql($query);
                    
                    while($row = mysql_fetch_array($result)){
                        $dscourse_id=$row['course_id'];
                        $multi_sql_query.="INSERT INTO Takes VALUES('$value','$dscourse_id','$dsyear');";  
                    }
                    
                    $query="select course_id from Course where IA is not null and IA!=0 and IA!='' and dept='".$ddept."' AND sem='".$dssem."'";
                    $result= queryMysql($query);
                    
                    while($row = mysql_fetch_array($result)){
                        $dscourse_id=$row['course_id'];
                        $multi_sql_query.="INSERT INTO Test VALUES('$value','$dscourse_id','$dsyear',NULL,NULL);";
                    }
                    $multi_sql_query.="update Student set sem='".$dssem."',year='".$dsyear."' where rollno='".$value."';";
                    
                    $link = mysqli_connect("localhost","root","root","College");
    
                    if (mysqli_connect_errno()) {
                        printf("Connect failed: %s\n", mysqli_connect_error());
                        exit();
                    }
       
                    /* execute multi query */
            
                    //echo ''.$multi_sql_query;
                    
                
                    if (mysqli_multi_query($link, $multi_sql_query)) {
                        do{
                            /* store first result set */
                            if ($result = mysqli_store_result($link)) {
                                mysqli_free_result($result);
                            }
                            
                            if (!mysqli_more_results($link)) {
                                break;
                            }
                            if(!mysqli_next_result($link)){
                                echo "<span class='error'>INSERT/UPDATE Failed : ". mysqli_error($link)."</span>";
                                die();
                            }
                           
                        }while(true);
                    }
                    else {
                        echo "<span class='error'>INSERT/UPDATE Failed : ". mysqli_error($link)."</span>";
                        die();
                    }
                    /* close connection */
                    mysqli_close($link);
            }
            echo '<span class="success">Record Successfully Updated </span>';
            header('Refresh: 2; url=filterpromote.php');
        }
    }
    else {
        echo '<br><span class="error">something is not set</span><br>';
    }       
}
 else {
    echo '<br><center><span class="error">POST not done</span></center>';
    header("Refresh: 0; url=index.php");
}

}
 else {
          echo'<br><br><center><span class="error">Please sign up and/or login to use the system</span></center>';
    
}
require_once 'functions/footer.php';
?>