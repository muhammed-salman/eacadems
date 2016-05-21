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
*   Created On: 30 May, 2015, 2:44:51 PM
*   Author: Muhammed Salman Shamsi
*/
require_once 'functions/header.php';
        
if($loggedin){
    if($_SESSION['grid']==='3'||$_SESSION['grid']==='5'||$_SESSION['grid']==='2'){
        
    insertCASheets();
echo '<div id="left">';    
echo '<div class="info-box"><div class="full-title-redgrad">Important Guidelines</div>'
    . '<ul>'
        .'<li>'.$checkmark.' Only the components which are checked are included in termwork.</li>'
        .'<li>'.$checkmark.' Weightage Should be as per the university strictly.</li>'
        .'<li>'.$checkmark.' Total Count means the total number of experiments/assignment/twcomponent you are going to take.</li>'
        .'<li>'.$checkmark.' If count is given in the syllabus than that has to be followed strictly.</li>'
        .'<li>'.$checkmark.' Before updating / viewing a sheet it has to be created first.</li>'
        .'<li>'.$checkmark.' A sheet can be created only once.</li>'
        .'<li>'.$checkmark.' On update page marks should be assigned out of weightage of respective component.</li>'
        .'<li>'.$checkmark.' The respective weightage is given in the bracket after the component name.</li>'
        .'<li>'.$checkmark.' Once you have put up the marks and updated the sheet, the same cannot be modified later.</li>'
    . '</ul>'
    . '</div>';
        
echo <<<_END
   </div>
    <div id="right">
   <form method="post" id="form1">
          
            <fieldset class="form">
                <legend class="fit-title-blackgrad">Continous Assesment Criteria</legend>
                <div>
                    <label class="form-label">Select Course</label>
                    
                        <select name="cacourse" id="cacourse" class="form-input teachcourse" required>
_END;
                            loadTeachesCourse('0',academic_year());
echo <<<_END
                        </select>
                </div>
                         <input class="form-input" type="hidden" name="cayear" id="cayear"  required value="
_END;
                        echo academic_year();
echo <<<_END
" readonly="true" />
                <div>
                   <button class="form-button button" name="viewca" id="viewca" onclick="submitForm('viewca.php')">View CA</button>
                   <button class="form-button button" name="updateca" id="updateca" onclick="submitForm('updateca.php')">Update CA</button>
                </div>
        
                <div>
                    <input class="form-check" type="checkbox" id="twcreatecheck" name="twcreatecheck"/>    
                    <label class="form-label">Check only if you want to create Continous Assesment Sheets</label>
                </div>
                <div class="hide">
_END;
                 $result=  queryMysql("select * from TwComponents");
                 while ($row = mysql_fetch_array($result)) {
                     echo '<div>';
                     echo '<span class="form-label"><input type="checkbox" class="twcheck form-check" name="'.$row['compo_id'].'" value="'.$row['compo_id'].'" disabled="true">'
                             . ' <label class="form-label">'.$row['components'].'</label></span>';
                     echo '<span class="form-input">'
                     . '<input type="number" disabled="true" class="twweight form-input" min="5" max="40"  placeholder="Weightage" name="weight_'.$row["compo_id"].'" />';
                     echo '<input type="number" disabled="true" class="twcount form-input" min="1" max="25" placeholder="Total Count" name="compo_nos_'.$row["compo_id"].'"/>';
                     echo '</span>'
                     . '</div>';
                 }
echo <<<_END
                </div>
                <div>
                    <button class="button form-button" name="createca" id="createca" onclick="submitForm('CA.php')">Create CA Sheets</button>
                </div>        
            </fieldset>
                <input type="hidden" name="title" id="title" value=""/>
_END;
                            echo '<input type="hidden" name="ffac_id" id="ffac_id" value="'.$_SESSION['fac_id'].'">';
echo <<<_END
   
          
        </form>
      </div>
_END;
}
else {
      echo '<span class="error">Access Denied! You are not authorized to view this section</span>';    
}

}

 else echo'<span class="error">Please sign up and/or login to use the system';
    require_once 'functions/footer.php';
?>