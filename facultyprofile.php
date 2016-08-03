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
*   Created On: 24 Jun, 2015, 10:05:28 AM
*   Author: Muhammed Salman Shamsi
*/
require_once 'functions/header.php';
if($_POST){
updateFacultyProfile();}
if($loggedin)
{
    if($_SESSION['grid']==='3'||$_SESSION['grid']==='2'||$_SESSION['grid']==='5'){
echo <<<_END
    <div id="left">        
_END;
echo '<div class="info-box"><div class="full-title-redgrad slidebutton">Important Guidelines<span class="arrow-up"></span></div>'
        . '<ul class="slidebox">'
            .'<li>'.$checkmark." All Fields are Manadatory.</li>"
            .'<li>'.$checkmark." Please Enter 0 or N/A if Fields are not applicable.</li>"
        . "</ul>"
        . "</div>";
$result=  queryMysql("select fp.*,name from FacultyProfile fp natural join Faculty f where fp.fac_id='".$_SESSION['fac_id']."'");       
echo <<<_END

   </div>
    <div id="right">    
      <form id="form1" method="post" enctype="multipart/form-data" action="facultyprofile.php">
        
          <fieldset class="form">
            <legend class="fit-title-blackgrad">Faculty Profile</legend>
_END;
while ($row = mysql_fetch_array($result)) {
echo <<<_END
            <div>
                <label class="form-label">Faculty/Staff ID</label>
                
                <input class="form-input" type="text" value="$row[fac_id]"name="fpfacid" readonly="true" required >
            </div>
            <div>
                <label class="form-label">Faculty/Staff Name</label>
                
                    <input class="form-input" type="text" value="$row[name]"name="fpname" readonly="true" required >
            </div>
            <div>
                <label class="form-label">UG Qualification with Grade</label>
                <input class="form-input" type="text"  value="$row[ug]" name="fpug" placeholder="Ex: B.E. with First Class" required >
            </div>
            <div>
                <label class="form-label">PG Qualification with Grade</label>
                <input class="form-input" type="text" value="$row[pg]" name="fppg" placeholder="Ex: M.E. with First Class" required >
            </div>
            <div>
                <label class="form-label">Ph.D Qualification with Topic</label>
                <input class="form-input" type="text" value="$row[phd]" name="fpphd" placeholder="Ex: Ph.D in Computer Automated System" required >
            </div>
            <div>
                <label class="form-label">Teaching Experience(In Years)</label>
                <input class="form-input" type="number" value="$row[exp_teach]" name="fptexp" min="0" step="any" required >
            </div>
            <div>
                <label class="form-label">Industry Experience(In Years)</label>
                <input class="form-input" type="number" value="$row[exp_ind]" name="fpiexp" min="0" step="any" required >
            </div>
            <div>
                <label class="form-label">Paper Published National</label>
                <input class="form-input" type="number" value="$row[paper_national_pub]" name="fppaper_pub_nat" min="0" step="1" required >
            </div>
            <div>
                <label class="form-label">Paper Published International</label>
                <input class="form-input" type="number" value="$row[paper_international_pub]" name="fppaper_pub_int" min="0" step="1" required >
            </div>
            <div>
                <label class="form-label">Paper Presented National</label>
                <input class="form-input" type="number" value="$row[paper_national_presen]"name="fppaper_presen_nat" min="0"  step="1" required >
            </div>
            <div>
                <label class="form-label">Paper Presented International</label>
                <input class="form-input" type="number" value="$row[paper_international_presen]" name="fppaper_presen_int" min="0" step="1" required >
            </div>
            <div>
                <label class="form-label">Phd Project Guided</label>
                <input class="form-input" type="number" value="$row[proj_guide_phd]" name="fpphd_guide_proj" min="0" step="1" required >
            </div>
            <div>
                <label class="form-label">Master Level Project Guided</label>
                <input class="form-input" type="number" value="$row[proj_guide_master]" name="fpmaster_guide_proj" min="0" step="1" required >
            </div>
            <div>
            <label class="form-label">Books / IPRs / Patents</label>
            
                <textarea class="form-input" placeholder="Each Entry Seprated by Semicolon ;" rows=3 cols=23 required name="fpbooks_ipr" wrap="soft" >$row[book_ipr_patent]</textarea>  
            
            </div>
            <div>
                <label class="form-label">Professional Memberships</label>
                
                    <textarea class="form-input" placeholder="Ex: ISTE;IEEE;CSI" rows=3 cols=23 required name="fpprof_member" wrap="soft" >$row[prof_member]</textarea>
             
            </div>
            <div>
                <label class="form-label">Consultancy Activities</label>
                
                    <textarea class="form-input" placeholder="Each Entry Seprated by Semicolon ;" rows=3 cols=23 required name="fpconsultancy" wrap="soft" >$row[consultancy]</textarea>
             
            </div>
            <div>
                <label class="form-label">Awards</label>
                
                    <textarea class="form-input" placeholder="Each Entry Seprated by Semicolon ;" rows=3 cols=23 required name="fpawards" wrap="soft" >$row[awards]</textarea>
                </label>
            </div>
            <div>
                <label class="form-label">Grants Fetched</label>
                
                    <textarea class="form-input" placeholder="Each Entry Seprated by Semicolon ;" rows=3 cols=23 required name="fpgrants" wrap="soft" >$row[grants]</textarea>
            </div>
            <div>
                <label class="form-label">Interaction with Professional Institutions</label>
                <textarea class="form-input" placeholder="Each Entry Seprated by Semicolon ;" rows=3 cols=23 required name="fpprof_inter" wrap="soft" >$row[prof_interaction]</textarea>
            </div>
            <div>
                <label class="form-label">Your Photo (3.5cm x 4.5cm)</label>    
_END;
                    displayImage($row[image_id]);
echo <<<_END
            </div>
_END;
}
echo <<<_END
            <div>
                <label class="form-label">
                    <input class="form-check" type="checkbox" id="photocheck" name="photocheck" value="1"/>
                    Check to Update Photo
                </label>     
            </div>
            <div>
                <label class="form-label">Photo[ Max Size 3 MB]</label>    
                <input class="form-input" id="fpphoto" type="file" name="image" required="true" disabled="true"/>
            </div>
            <button class="button form-button" id="fpupdate" name="fpupdate" onclick="submitForm('facultyprofile.php')">Update</button>
            <button class="button form-button" id="fpview" name="fpview">View in Printable Format</button>
            
          </fieldset>
          <input type="hidden" id="fac_id" name="fac_id" value="$_SESSION[fac_id]" />
            
     </form>  
     </div>
_END;
 }
  else {
      echo '<span class="error">Access Denied! You are not authorized to view this section</span>';
      
  }
}
 else echo'<span class="error">Please sign up and/or login to use the system</span>';
 
 
 require_once 'functions/footer.php';  
