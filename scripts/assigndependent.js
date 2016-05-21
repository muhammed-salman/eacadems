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
$(document).ready(function () {

    $("#cdept").change(function (e) {
        e.preventDefault();
        var dept = $(document.getElementById("cdept")).val();
        var sem = $(document.getElementById("csem")).val();
        var year = $(document.getElementById("cyear")).val();
        var dataString = 'dept=' + dept + '&sem=' + sem + '&year=' + year;

        $.ajax({
            type: 'POST',
            url: 'ajax_teach_course_yearsem.php',
            data: dataString,
            cache: false,
            success: function (html)
            {

                $("#ccourse").html(html);

            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
        });
    });


    $("#csem").change(function (e) {
        e.preventDefault();
        var dept = $(document.getElementById("cdept")).val();
        var sem = $(document.getElementById("csem")).val();
        var year = $(document.getElementById("cyear")).val();
        var dataString = 'dept=' + dept + '&sem=' + sem + '&year=' + year;

        $.ajax({
            type: 'POST',
            url: 'ajax_teach_course_yearsem.php',
            data: dataString,
            cache: false,
            success: function (html)
            {

                $("#ccourse").html(html);

            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
        });
    });

    $("#acdept").change(function (e) {
        e.preventDefault();
        var acdept = $(this).val();
        var asem = $(document.getElementById("asem")).val();
        var dataString = 'acdept=' + acdept + '&asem=' + asem;

        $.ajax({
            type: 'POST',
            url: 'ajax_course.php',
            data: dataString,
            cache: false,
            success: function (html)
            {

                $("#acourse").html(html);

            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
        });

    });

    $("#asem").change(function (e) {
        e.preventDefault();
        var asem = $(this).val();
        var acdept = $(document.getElementById("acdept")).val();
        var dataString = 'acdept=' + acdept + '&asem=' + asem;

        $.ajax({
            type: 'POST',
            url: 'ajax_course.php',
            data: dataString,
            cache: false,
            success: function (html)
            {

                $("#acourse").html(html);

            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
        });

    });

    $(".aThorPr").change(function (e) {
        e.preventDefault();
        var aThorPr = $(this).val();
        var acourse = document.getElementById("acourse").value;
        var dataString = 'course_id=' + acourse + '&ThorPr=' + aThorPr;

        $.ajax({
            type: 'POST',
            url: 'ajax_course_hours.php',
            data: dataString,
            cache: false,
            success: function (html)
            {

                $("#ahours").val(html);

            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
        });

    });

    $(".teachyear").change(function (e) {
        e.preventDefault();
        var fyear = $(this).val();
        var ffac_id = $(document.getElementById("ffac_id")).val();
        var dataString = 'fyear=' + fyear + '&ffac_id=' + ffac_id;

        $.ajax({
            type: 'POST',
            url: 'ajax_teaches_course.php',
            data: dataString,
            cache: false,
            success: function (html)
            {

                $(".teachsub").html(html);

            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
        });
    });

    $("#tsub").change(function (e) {
        e.preventDefault();
        var title = document.getElementById("title");
        title.value = this.options[this.selectedIndex].text;
    });

    $("#generatepdf").click(function (e) {
        e.preventDefault();
        var table_clone = $('#pdfTable').clone();
        var tableHtml = table_clone.prop('outerHTML');
        document.getElementById("page").value = tableHtml;
        submitForm('ajax_pdf.php');
    });


    $("input").keyup(function (e) {
        var t1 = document.getElementsByClassName("tmt1");
        var t2 = document.getElementsByClassName("tmt2");
        var agg = document.getElementsByClassName("tmagg");
        var tm1, tm2, tavg, i = 0;

        $(t1).each(function () {

            tm1 = parseInt(t1[i].value);
            if (tm1 < 0 || isNaN(t1[i].value) || tm1 > 20) {
                alert("Please Enter Valid Values");
                t1[i].value = "";
                t1[i].focus();
            }
            if (isNaN(tm1))
                tm1 = 0;

            tm2 = parseInt(t2[i].value);
            if (tm2 < 0 || isNaN(t2[i].value) || tm2 > 20) {
                alert("Please Enter Valid Values");
                t2[i].value = "";
                t2[i].focus();
            }
            if (isNaN(tm2))
                tm2 = 0;

            tavg = Math.ceil((tm1 + tm2) / 2);
            if (tavg < 7)
                agg[i].style.backgroundColor = "red";
            else if (tavg === 7)
                agg[i].style.backgroundColor = "orange";
            else
                agg[i].style.backgroundColor = "white";
            agg[i].value = tavg;
            i++;
        });
    });

    $('#apr').change(function (e) {
        var acheck = document.getElementsByClassName("acheck");
        var i = 0;
        $(acheck).each(function () {
            acheck[i].checked = true;
            acheck[i].disabled = false;
            i++;
        });
        document.getElementById("ab0").value = "0";
    });

    $("#ath").click(function (e) {
        var acheck = document.getElementsByClassName("acheck");
        var i = 0;
        $(acheck).each(function () {
            acheck[i].checked = true;
            acheck[i].disabled = true;
            i++;
        });
        document.getElementById("ab0").value = "1";
    });

    $('#cscourse').change(function (e) {
        e.preventDefault();
        var cscourse = $(this).val();
        var dataString = 'course_id=' + cscourse;

        $.ajax({
            type: 'POST',
            url: 'ajax_course_status.php',
            data: dataString,
            cache: false,
            success: function (html)
            {
                $("#coursestatus").html(html);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
        });

    });

    $(".facstaffdept").change(function (e) {
        e.preventDefault();
        var dept = $(this).val();
        var dataString = 'dept=' + dept;

        $.ajax({
            type: 'POST',
            url: 'ajax_faculty_staff.php',
            data: dataString,
            cache: false,
            success: function (html)
            {

                $(".facstaff").html(html);

            }
        });

    });

    $(".facstaff").change(function (e) {
        e.preventDefault();
        var cufsname = $(this).val();
        var dataString = 'cufsname=' + cufsname;

        $.ajax({
            type: 'POST',
            url: 'checkduplicate.php',
            data: dataString,
            cache: false,
            success: function (html)
            {

                $("#cufserr").html(html);

            }
        });

    });

    $("#user").keyup(function (e) {
        e.preventDefault();
        var user = $(this).val();
        var dataString = 'user=' + user;

        $.ajax({
            type: 'POST',
            url: 'checkusername.php',
            data: dataString,
            cache: false,
            success: function (html)
            {

                $("#usererr").html(html);

            }
        });

    });
    
    $("#sdrollno").change(function (e) {
        e.preventDefault();
        var rollno = $(this).val();
        var dataString = 'rollno='+rollno;

        $.ajax({
            type: 'POST',
            url: 'checkrollno.php',
            data: dataString,
            cache: false,
            success: function (html)
            {

                $("#rollerr").html(html);

            }
        });

    });


    $("#cpass").change(function (e) {
        e.preventDefault();
        var cpass = $(this).val();
        var pass = document.getElementById("pass");
        if (pass.value != cpass)
        {
            $(this).val("");
            $("#cpasserr").html("<font color='red'>Passwords do not match</font>");
        }
        else
        {
            $("#cpasserr").html("<font color='green'>Passwords Match</font>");
        }

    });

    $("#pass").change(function (e) {
        e.preventDefault();
        //var cpass=$(this).val();
        var cpass = document.getElementById("cpass");
        cpass.value = "";
        $(this).focus();
        /*if(pass.value!=cpass)
         {
         $(this).val("");
         $("#cpasserr").html("<font color='red'>Passwords do not match</font>");
         }*/

    });

    $(".teachcourse").change(function (e) {
        e.preventDefault();
        var course_id = $(this).val();
        var fac_id = document.getElementById("ffac_id").value;
        var dataString = 'course_id=' + course_id + '&fac_id=' + fac_id;

        $.ajax({
            type: 'POST',
            url: 'ajax_course_teaches_year.php',
            data: dataString,
            cache: false,
            success: function (html)
            {

                $(".teachcourseyear").html(html);

            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
        });
        var title = document.getElementById("title");
        title.value = this.options[this.selectedIndex].text;

    });

    $("#sphoneno").keyup(function (e) {
        e.preventDefault();
        var phoneno = $(this).val();
        var dataString = 'phoneno=' + phoneno;

        $.ajax({
            type: 'POST',
            url: 'checkphoneno.php',
            data: dataString,
            cache: false,
            success: function (html)
            {

                $("#sphoneerr").html(html);
            }
        });
        var spphone = document.getElementById("spphoneno");
        if (spphone.value == phoneno) {
            $(this).val("");
            //document.getElementById("sphoneerr").innerHTML="<font color='red'>Your and Parents Mobile no cannot be same.</font><br>";
        }

    });

    $("#spphoneno").keyup(function (e) {
        e.preventDefault();
        var phoneno = $(this).val();
        var dataString = 'phoneno=' + phoneno;

        $.ajax({
            type: 'POST',
            url: 'checkpphoneno.php',
            data: dataString,
            cache: false,
            success: function (html)
            {

                $("#spphoneerr").html(html);
            }
        });
        var sphone = document.getElementById("sphoneno");
        if (sphone.value == phoneno) {
            $(this).val("");
            //document.getElementById("spphoneerr").innerHTML="<font color='red'>Your and Parents Mobile no cannot be same.</font><br>";
        }

    });

    $('#twcreatecheck').change(function (e) {
        var twcheck = document.getElementsByClassName("twcheck");
        var twweight = document.getElementsByClassName("twweight");
        var twcount = document.getElementsByClassName("twcount");
        var i = 0;
        if ($(this).is(":checked")) {
            $(document.getElementsByClassName("hide")).attr('class','show');

            $(twcheck).each(function () {
                twcheck[i].disabled = false;
                i++;
            });

            /*            i=0;
             $(twweight).each(function(){
             twweight[i].disabled=false;
             i++;
             });
             
             i=0;
             $(twcount).each(function(){
             twcount[i].disabled=false;
             i++;
             });*/
        }
        else {
            $(document.getElementsByClassName("show")).attr('class','hide');
            i = 0;
            $(twcheck).each(function () {
                twcheck[i].disabled = true;
                i++;
            });

            /*  i=0;
             $(twweight).each(function(){
             twweight[i].disabled=true;
             i++;
             });
             
             i=0;
             $(twcount).each(function(){
             twcount[i].disabled=true;
             i++;
             });*/
        }

    });

    $('.twcheck').change(function (e) {
        var checkval = $(this).val();
        var twweight = document.getElementsByName("weight_" + checkval);
        var twcount = document.getElementsByName("compo_nos_" + checkval);
        if ($(this).is(":checked")) {
            $(twweight).attr('disabled', false);
            $(twcount).attr('disabled', false);
        }
        else
        {
            $(twweight).attr('disabled', true);
            $(twcount).attr('disabled', true);
        }
    });

    $(".ucamarks").keyup(function (e) {
        e.preventDefault();

        if (parseInt($(this).val()) < 0) {
            alert("Please Enter Valid Values");
            $(this).val("");
            $(this).focus();
        }
        var compoid = document.getElementsByClassName("compoid");
        var componos = document.getElementsByClassName("componos");
        var compoweight = document.getElementsByClassName("compoweight");
        var compo_total = document.getElementsByClassName("ctotal");
        var rollno = document.getElementsByClassName("ucarollno");
        var i = 0, weightage = 0;
        $(compoweight).each(function () {
            weightage += parseInt(compoweight[i].value);
            i++;
        });
        for (i = 0; i < rollno.length; i++) {

            var l = 0, ctot = 0;
            while (l < compoid.length) {
                var coid = parseInt(compoid[l].value);
                var count = parseInt(componos[l].value);
                var j = 1, cavg = 0, avgCount = 0;
                while (j <= count) {
                    var marksclass = (rollno[i].value) + "_" + coid + "_" + j + "_marks";
                    var compo_marks = document.getElementById(marksclass);
                    cm = parseInt(compo_marks.value);

                    if (!isNaN(cm)) {
                        cavg += cm;
                        avgCount++;
                    }
                    j++;
                }
                gavg = cavg;
                if (cavg != 0) {
                    cavg = cavg / avgCount;
                }
                var avgclass = (rollno[i].value) + "_" + coid + "_avg";
                var compo_avg = document.getElementById(avgclass);
                compo_avg.value = cavg;
                ctot += gavg / count;
                l++;
            }
            ctot = Math.ceil(ctot);
            compo_total[i].value = ctot;
            passtw = 0.4 * weightage;
            if (ctot < passtw)
                compo_total[i].style.backgroundColor = "red";
            else
                compo_total[i].style.backgroundColor = "white";
        }
    });

    $(".addcheck").change(function (e) {
        e.preventDefault();
        var padd = document.getElementsByClassName("peradd");
        var resadd = document.getElementsByClassName("resiadd");
        if ($(this).is(":checked")) {
            $(resadd).val($(padd).val());
        }
        else
            $(resadd).val("");
        ;
    });

    $("#absentcheck").change(function (e) {
        e.preventDefault();
        var absent = document.getElementsByClassName("absentroll");
        if ($(this).is(":checked")) {
            var i = 0;
            //alert(""+hello);
            $(absent).each(function () {
                absent[i].checked = true;
                i++;
            });
        }
        else {
            var i = 0;
            $(absent).each(function () {
                absent[i].checked = false;
                i++;
            });
        }
    });


    $("#attsheet").click(function (e) {
        e.preventDefault();
        var year = document.getElementById("asyear").value;
        var dept = document.getElementById("asdept").value;
        //var sem = document.getElementById("assem").value;
        var asthpr = document.getElementsByName("asthpr");
        var ffac_id = document.getElementById("ffac_id").value;
        var course_id = $(document.getElementById("assub")).val();
        var title = $(document.getElementById("title")).val();
        
        var i = 0, thpr;
        $(asthpr).each(function () {
            if (asthpr[i].checked == true)
                thpr = asthpr[i].value;
            i++;
        });
        
        if(year == "" || dept == "" || thpr =="" || ffac_id =="" || course_id =="" || title ==""){
            alert("Required Fields Missing!");
            return false;
        }
        
        var dataString = 'dept=' + dept + '&year=' + year + '&thpr=' + thpr + '&fac_id=' + ffac_id + '&course_id=' + course_id + '&title=' + title;

        $.ajax({
            type: 'POST',
            url: 'attsheet.php',
            data: dataString,
            cache: false,
            success: function (html)
            {

                $("#wrapper").html(html);

            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
        });

    });

    $('.attsub').change(function (e) {
        e.preventDefault();
        var title = document.getElementById("title");
        title.value = this.options[this.selectedIndex].text;
    });

    $("#asdept").change(function (e) {
        e.preventDefault();
        var dept = $(document.getElementById("asdept")).val();
        var sem = $(document.getElementById("assem")).val();
        var year = $(document.getElementById("asyear")).val();
        var fac_id = $(document.getElementById("ffac_id")).val();

        var dataString = 'dept=' + dept + '&sem=' + sem + '&year=' + year + '&fac_id=' + fac_id;

        $.ajax({
            type: 'POST',
            url: 'ajax_teaches_course_yearsemdept.php',
            data: dataString,
            cache: false,
            success: function (html)
            {

                $("#assub").html(html);

            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
        });
    });

    $("#assem").change(function (e) {
        e.preventDefault();
        var dept = $(document.getElementById("asdept")).val();
        var sem = $(document.getElementById("assem")).val();
        var year = $(document.getElementById("asyear")).val();
        var fac_id = $(document.getElementById("ffac_id")).val();
        var dataString = 'dept=' + dept + '&sem=' + sem + '&year=' + year + '&fac_id=' + fac_id;

        $.ajax({
            type: 'POST',
            url: 'ajax_teaches_course_yearsemdept.php',
            data: dataString,
            cache: false,
            success: function (html)
            {

                $("#assub").html(html);

            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
        });
    });

    $(".viewtype").change(function (e) {
        e.preventDefault();
        var year = document.getElementById("vyear").value;
        var vthpr = document.getElementsByName("vthpr");
        var course_id = $(document.getElementById("vsub")).val();

        var i = 0, thpr;
        $(vthpr).each(function () {
            if (vthpr[i].checked == true)
                thpr = vthpr[i].value;
            i++;
        });
        var dataString = 'year=' + year + '&thpr=' + thpr + '&course_id=' + course_id;
        // alert(""+dataString);

        $.ajax({
            type: 'POST',
            url: 'ajax_teaches_faculty.php',
            data: dataString,
            cache: false,
            success: function (html)
            {
                $("#vfac").html(html);

            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
        });

    });

    $("#vsub").change(function (e) {
        e.preventDefault();
        document.getElementById("uppcourse").value = $(this).val();
        document.getElementById("tlcourse").value = $(this).val();
        document.getElementById("cacourse").value = $(this).val();
        document.getElementById("title").value = this.options[this.selectedIndex].text;

        var year = document.getElementById("vyear").value;
        var vthpr = document.getElementsByName("vthpr");
        var course_id = $(document.getElementById("vsub")).val();

        var i = 0, thpr;
        $(vthpr).each(function () {
            if (vthpr[i].checked == true)
                thpr = vthpr[i].value;
            i++;
        });
        var dataString = 'year=' + year + '&thpr=' + thpr + '&course_id=' + course_id;
        // alert(""+dataString);

        $.ajax({
            type: 'POST',
            url: 'ajax_teaches_faculty.php',
            data: dataString,
            cache: false,
            success: function (html)
            {
                $("#vfac").html(html);

            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
        });
    });

    $('#vfac').change(function (e) {
        e.preventDefault();
        document.getElementById("uppfac_id").value = $(this).val();
        document.getElementById("ffac_id").value = $(this).val();

    });

    $("#oldpass").change(function (e) {
        e.preventDefault();
        var pass = $(this).val();
        var user = document.getElementById("user").value;
        var dataString = 'user=' + user + '&pass=' + pass;

        $.ajax({
            type: 'POST',
            url: 'checkpass.php',
            data: dataString,
            cache: false,
            success: function (html)
            {
                var msg = null;
                if (html == "false") {
                    msg = "<font color='red'>Wrong Password</font>";
                }
                else {
                    msg = "<font color='green'>Correct Password</font>";
                    document.getElementById("pass").disabled = false;
                    document.getElementById("cpass").disabled = false;
                }
                $("#passerr").html(msg);
            }
        });

    });

    $("#loadtm").click(function (e) {
        e.preventDefault();
        var year = document.getElementById("vtyear").value;
        var sem = document.getElementById("vtsem").value;
        var dept = $(document.getElementById("dept")).val();
        var user = document.getElementById("user").value;

        var dataString = 'year=' + year + '&sem=' + sem + '&dept=' + dept + '&user=' + user;
        // alert(""+dataString);

        $.ajax({
            type: 'POST',
            url: 'classtm.php',
            data: dataString,
            cache: false,
            success: function (html)
            {
                $("#wrapper").html(html);

            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
        });

    });

    $("#srdept").change(function (e) {
        e.preventDefault();
        var dept = $(document.getElementById("srdept")).val();
        var sem = $(document.getElementById("srsem")).val();
        var year = $(document.getElementById("sryear")).val();
        var dataString = 'dept=' + dept + '&sem=' + sem + '&year=' + year;

        $.ajax({
            type: 'POST',
            url: 'ajax_student_roll.php',
            data: dataString,
            cache: false,
            success: function (html)
            {

                $("#srroll").html(html);

            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
        });
    });


    $("#srsem").change(function (e) {
        e.preventDefault();
        var dept = $(document.getElementById("srdept")).val();
        var sem = $(document.getElementById("srsem")).val();
        var year = $(document.getElementById("sryear")).val();
        var dataString = 'dept=' + dept + '&sem=' + sem + '&year=' + year;

        $.ajax({
            type: 'POST',
            url: 'ajax_student_roll.php',
            data: dataString,
            cache: false,
            success: function (html)
            {

                $("#srroll").html(html);

            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
        });
    });
    $("#sryear").change(function (e) {
        e.preventDefault();
        var dept = $(document.getElementById("srdept")).val();
        var sem = $(document.getElementById("srsem")).val();
        var year = $(document.getElementById("sryear")).val();
        var dataString = 'dept=' + dept + '&sem=' + sem + '&year=' + year;

        $.ajax({
            type: 'POST',
            url: 'ajax_student_roll.php',
            data: dataString,
            cache: false,
            success: function (html)
            {

                $("#srroll").html(html);

            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
        });
    });

    $("#recordbtn").click(function (e) {
        e.preventDefault();
        submitForm('studrecord.php');
        var dept = $(document.getElementById("srdept")).val();
        var sem = $(document.getElementById("srsem")).val();
        var year = $(document.getElementById("sryear")).val();
        var rollno = $(document.getElementById("srroll")).val();
        /*if (dept == "" || sem == "" || year == "" || rollno == "")
            alert("Required Field(s) Missing!");
        else {*/
            var dataString = 'dept=' + dept + '&sem=' + sem + '&year=' + year + '&rollno=' + rollno;

            $.ajax({
                type: 'POST',
                url: 'studrecord.php',
                data: dataString,
                cache: false,
                success: function (html)
                {

                    $("#right").html(html);

                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status);
                    alert(thrownError);
                }
            });
        //}
    });
    
    $("#ssearchbtn").click(function (e) {
        e.preventDefault();
        var text = $(document.getElementById("stext")).val();
        /*if (dept == "" || sem == "" || year == "" || rollno == "")
            alert("Required Field(s) Missing!");
        else {*/
            var dataString = 'text='+text;

            $.ajax({
                type: 'POST',
                url: 'studsearch.php',
                data: dataString,
                cache: false,
                success: function (html)
                {

                    $("#search-container").html(html);

                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status);
                    alert(thrownError);
                }
            });
        //}
    });
    
    $("#kloadbtn").click(function (e) {
        e.preventDefault();
        var rollno = $(document.getElementById("kcroll")).val();
        var year = $(document.getElementById("kcyear")).val();
        var sem = $(document.getElementById("kcsem")).val();
        var dept = $(document.getElementById("dept")).val();
        if (rollno == "" || year == "" || sem == "" || dept == "")
            alert("Required Field(s) Missing!");
        else {
            var dataString = 'rollno='+rollno+'&year='+year+"&sem="+sem+"&dept="+dept;

            $.ajax({
                type: 'POST',
                url: 'getTestEntry.php',
                data: dataString,
                cache: false,
                success: function (html)
                {

                    $("#wrapper").html(html);

                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status);
                    alert(thrownError);
                }
            });
        }
    });

    $('.sradio').change(function (e) {
        var i=0,rollno,j=0;
        var sradio=document.getElementsByClassName("sradio");
        var recordbtn=document.getElementById("recordbtn");
        recordbtn.disabled=false;
        $(sradio).each(function () {
            rollno=sradio[j].value;
            var element=document.getElementsByClassName(rollno);
            i=0;
            if ($(sradio[j]).is(":checked")) {
                $(element).each(function () {
                    element[i].disabled=false;
                    element[i].style.backgroundColor="yellow";
                    i++;
                });
            }
            else{
                $(element).each(function () {
                    element[i].disabled=true;
                    element[i].style.backgroundColor="transparent";
                    i++;
                });
            }
            j++;
        });
    });
    
    $('#photocheck').change(function (e) {
        var photo = document.getElementById("fpphoto");
        if ($(this).is(":checked")) {
            photo.disabled = false;
        }
        else
        {
            photo.disabled = true;
        }
    });

    $("#fpview").click(function (e) {
        e.preventDefault();
        var fac_id = $(document.getElementById("fac_id")).val();
        var dataString = 'fac_id=' + fac_id;

        $.ajax({
            type: 'POST',
            url: 'viewfacultyprofile.php',
            data: dataString,
            cache: false,
            success: function (html)
            {

                $("#right").html(html);

            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
        });
    });

    $("#frrecord").click(function (e) {
        e.preventDefault();
        var fac_id = $(document.getElementById("frid")).val();
        //alert(""+fac_id);
        if (fac_id == null || fac_id == "") {
            alert("Please Select Faculty Name");
        }
        else {
            var dataString = 'fac_id=' + fac_id;

            $.ajax({
                type: 'POST',
                url: 'viewfacultyprofile.php',
                data: dataString,
                cache: false,
                success: function (html)
                {

                    $("#right").html(html);

                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status);
                    alert(thrownError);
                }
            });
        }
    });

    $("#promote").click(function (e) {
        e.preventDefault();
        var dept = $(document.getElementById("fpdept")).val();
        var sem = $(document.getElementById("fpsem")).val();
        var year = $(document.getElementById("fpyear")).val();
        if (dept == "" || sem == "" || year == "")
            alert("Please Select all required feilds!");
        else
            submitForm('promote.php');
    });

    $("#detain").click(function (e) {
        e.preventDefault();
        var dept = $(document.getElementById("fpdept")).val();
        var sem = $(document.getElementById("fpsem")).val();
        var year = $(document.getElementById("fpyear")).val();
        if (dept == "" || sem == "" || year == "")
            alert("Please Select all required feilds!");
        else
            submitForm('detain.php');
    });

    $(".datepicker").keydown(function (e) {
        e.preventDefault();
    });


    $("#fsub").change(function (e) {
        e.preventDefault();
        var year = document.getElementById('fyear').value;
        var fac_id = document.getElementById('ffac_id').value;
        var course_id = $(this).val();
        var dataString = "year=" + year + "&course_id=" + course_id + "&fac_id=" + fac_id;

        $.ajax({
            type: 'POST',
            url: 'ajax_course_type.php',
            data: dataString,
            cache: false,
            success: function (html)
            {

                $(".attendtype").html(html);

            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
        });
    });
    $("#fsub").focusout(function(e){
        $(".attendtype").trigger("change");
    });
    
    $(".attendtype").change(function (e) {
        e.preventDefault();
        var year = document.getElementById('fyear').value;
        var course_id = document.getElementById('fsub').value;
        var thpr = $(this).val();
        if (thpr == 1) {
            $("#fbatch").html("<option value='0'>B0</option>");
        }
        else {
            var fac_id = document.getElementById('ffac_id').value;

            var dataString = "year=" + year + "&thpr=" + thpr + "&fac_id=" + fac_id + "&course_id=" + course_id;

            $.ajax({
                type: 'POST',
                url: 'ajax_course_fac_batch.php',
                data: dataString,
                cache: false,
                success: function (html)
                {

                    $("#fbatch").html(html);

                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status);
                    alert(thrownError);
                }
            });
        }
    });

    $("#updateppb").click(function (e) {
        if (confirm("Are you sure you want to update?\nYou will not be able to modify contents later"))
            submitForm('updatepp.php');
    });

    $("#groll").change(function (e) {
        var year = $(document.getElementById("gyear")).val();
        var rollno = $(document.getElementById("groll")).val();
        if (year == "" || rollno == "")
            alert("Required Field(s) Missing!");
        else {
            var dataString = 'year=' + year + '&rollno=' + rollno;

            $.ajax({
                type: 'POST',
                url: 'ajax_roll_takes_course.php',
                data: dataString,
                cache: false,
                success: function (html)
                {

                    $("#gcourse").html(html);

                },
                error: function (xhr, ajaxOptions, thrownError) {
                    alert(xhr.status);
                    alert(thrownError);
                }
            });
        }
    });

    $("#gdept").change(function (e) {
        e.preventDefault();
        var dept = $(document.getElementById("gdept")).val();
        var sem = $(document.getElementById("gsem")).val();
        var year = $(document.getElementById("gyear")).val();
        var dataString = 'dept=' + dept + '&sem=' + sem + '&year=' + year;

        $.ajax({
            type: 'POST',
            url: 'ajax_student_roll.php',
            data: dataString,
            cache: false,
            success: function (html)
            {

                $("#groll").html(html);

            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
        });
    });

    $("#gsem").change(function (e) {
        e.preventDefault();
        var dept = $(document.getElementById("gdept")).val();
        var sem = $(document.getElementById("gsem")).val();
        var year = $(document.getElementById("gyear")).val();
        var dataString = 'dept=' + dept + '&sem=' + sem + '&year=' + year;

        $.ajax({
            type: 'POST',
            url: 'ajax_student_roll.php',
            data: dataString,
            cache: false,
            success: function (html)
            {

                $("#groll").html(html);

            },
            error: function (xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
        });
    });
    /* Table highlight
     var allCells = $("td, th");
     
     allCells.on("mouseover", function() {
     var el = $(this),
     pos = el.index();
     el.parent().find("th, td").addClass("hover");
     allCells.filter(":nth-child(" + (pos+1) + ")").addClass("hover");
     })
     .on("mouseout", function() {
     allCells.removeClass("hover");
     });*/

});
