// Attributes 
var aboutDisplay = '';
var quoteDisplay = '';
var tab1 = '#tabsOne';
var tab2 = '#tabsTwo';
var front = '';
var certificates = '';
var studyAbroadResource = '';
var advising = '';
var LabTutorInfo = '';
var studentAmbassor  = '';
var forms = '';
var coopEnrollResource = '';
var frontModal = '';
var minors = '';
var introJSON = '';
var statJSON = '';
var abroad = '';
var services = '';
var info = '';
var ambassadors = '';
var forms = '';
var coop = '';
var allEmployments = '';
var interestAreaDiv = '';
var facultyInterestDiv = '';
const GET = "GET";

//Call ajax 
function AjaxFunction() {
    return getMinorAJAX();
}

//This will display everything you can view on the internet
$(document).ready(function(){

    AjaxFunction();
    
    // Tabs 
    $( "#tabs" ).tabs();
    $("#people-tabs").tabs();

    // Accordian 
    $( "#accordTo" ).accordion({
        active: false,
        collapsible: true
    });

     // About
    ajax('get', {path:"/about/"}, '#aboutDisplay')
        .done(function(jsonAjax)
              {
        $("#aboutDisplay").append('<div id="DivAbout" class="alt">' +
                            '<p id="Titleabout">' + jsonAjax.title + '</p>' +
                            '<p id="DescAbout">' + jsonAjax.description + '</p>' +
                        '</div>');
        $("#quoteDisplay").append('<div id="DivQuote" class="alt"> '+
                        '<p id="quote"><span class="quotes">"</span>' + jsonAjax.quote  + '<span class="quotes">"</span></p>' +
                        '<p id="author-quote"> - ' + jsonAjax.quoteAuthor + '</p>' +
                    '</div>');
    });

// Tabs for undergraduation and graduation degree only
    $( "#Tabs" ).tabs();
    $("#TabsPeople").tabs();
    ajax('get', {path:"/degrees/"}, '#degrees').done(function(jsonAjax){

        // Undergraduate
        var undergrdegree = jsonAjax.undergraduate;
        var grdegree = jsonAjax.graduate;
        $.each(undergrdegree, function(){
            
            // Front Modal only but once clicked on back will load.   
            $(tab1).append('<a href="#linkModal" rel="modal:open" class="ModelAnchor">' +
                                '<div class="undergraduateDegBoxes" dataDegree="'+ this.degreeName +'">'+
                                    '<p class="titleDeg">' + this.title + '</p>' +
                                    '<p class="DescDegree">' + this.description + '</p>' +
                                    '<i class="fas fa-hand-pointer"></i>' +
                                '</div>' +
                            '</a>');
       });


       // Graduate
       $.each(grdegree, function(){
            
            if(this.title){
                
                // When user clicked on TAB will be display front modal 
                $(tab2).append('<a href="#linkModal" rel="modal:open" class="ModelAnchor">' +
                                    '<div class="graduateDegBoxes" dataDegree="'+ this.degreeName +'">'+
                                        '<p class="titleDeg">' + this.title + '</p>' +
                                        '<p class="DescDegree">' + this.description + '</p>' +
                                        '<i class="fas fa-hand-pointer"></i>' +
                                    '</div>' +
                                '</a>'); 
            }  
            else{
               
                // Certificates section only
                var cert = '<div id="certificates-container">' +
                        '<h1>' + this.degreeName + '</h1><i class="fas fa-award"></i>';
                
                $.each(this.availableCertificates, function(index, elem){
                    cert += '<p>' + elem + '</p>';
                });
                
                cert += '</div>';
                $('#degrees').append(cert);
            }
       });

        // Get the information for this object
        $('.undergraduateDegBoxes').on('click', function(){
            DegreeBackModal(undergrdegree,$(this).attr('dataDegree'));
        });

        $('.graduateDegBoxes').on('click', function(){
            DegreeBackModal(grdegree, $(this).attr('dataDegree'));
        });
    });

});



//Back modal for Degree
function DegreeBackModal(BackModal, dataBack){
//     get the requested object
    var dataJ = getAttributesByName(BackModal, 'degreeName', dataBack);

    var back = "";

    // check for #linkModal (one main modal used for all)
    if( $('.modalflag').length > 0 ){
        Modal(); // clear modal since there's content already

        // append new content
        back = '<h2>' + dataJ.title + '</h2>' +
                        '<p class="concentration-subheading">Concentrations:</p>' +
                        '<ul class="concentration-list">';
    }
    else{
        // CASE that the modal doesn't exist yet
        // Create new back
        back = back + '<div id="linkModal" class="modal modalflag">' +
                        '<h2>' + dataJ.title + '</h2>' +
                        '<p class="concentration-subheading">Concentrations:</p>' +
                        '<ul class="concentration-list">';
    }
    
    
    $.each(dataJ.concentrations, function(index , elem){
        back += '<li>' + elem + '</li>'; 
    });


    // Check again to know which closing tags and where to append
    if( $('.modalflag').length > 0 ){
        back += '</div>';
        $('#linkModal').append(back);
    }
    else{
        back += '</ul></div>';
        $('body').append(back); // stuff after - back
    }  
    
}


//Minors
function getMinorAJAX() {
    ajax(GET, {path: "/minors" }, '#minors').done(function(jsonMINOR) {
        
        minorsJSON = jsonMINOR.UgMinors;
        $.each(minorsJSON, function(){
            $('#minor').append('<a href="#linkModal" rel="modal:open" id="minorsAnchor">'
                + '<div class="eacMinor" dataMinorName="'
                + this.name + '">' + '<p class="degreeName">' + this.title 
                + '</p>' + '</div>' + '</a>');
            $('#minors-box-container').append(frontModal); 
        }); 
        $('.eacMinor').on('click', function(){
            MinorsBackModal(minorsJSON, $(this).attr('dataMinorName'));
        });
    });
       return getEmployemntTableAJAX();
}


 //Minors Back Modal
    function MinorsBackModal(BackModal, dataBack){
    // Get object requested
    var dataJSON = getAttributesByName(BackModal, 'name', dataBack);


        if( $('.modallength').length > 0 ){

            Modal();

            // Backmodal
            var backModal = '<h2>' + dataJSON.title + '</h2>' +
                                '<p class="minor-description">' + dataJSON.description + "</p>" +
                                '<h3> Courses: </h3>' +
                                '<ul class="minor-courses">';

            // courses array
            $.each(dataJSON.courses, function(index , elem){
                backModal = backModal + '<li>' + elem + '</li>';
            });


            if(dataJSON.note){
                backModal = backModal + '</ul><p class="minor-note">*'+ dataJSON.note +'</p>';
            }
            else{
                backModal = backModal + '</ul>';
            }

            $('#linkModal').append(backModal); // append back modal to the MAIN modal
        }
        else{
            var backModal = '<div id="linkModal" class="modal modallength">' +
                                '<h2>' + dataJSON.title + '</h2>' +
                                '<p class="minor-description">' + dataJSON.description + "</p>" +
                                '<h3> Courses: </h3>' +
                                '<ul class="minor-courses">';


            $.each(dataJSON.courses, function(index , elem){
                backModal += '<li>' + elem + '</li>';
            });


            if(dataJSON.note){
                backModal += '</ul><p class="minor-note">*'+ dataJSON.note +'</p></div>';
            }
            else{
                backModal += '</li></div>';
            }

            $('body').append(backModal); // append back modal to the dom
        }
    }


 
//Coop and professor employemnt table
function getEmployemntTableAJAX(){
        ajax('get', {path:"/employment/"}, "#WorkLocations").done(function(jsonAjax){ 
        //Tab for coop and professor title
        $('#coopTableT').append(jsonAjax.coopTable.title);
        $('#employmentTableT').append(jsonAjax.employmentTable.title);
            
        var coopTabl = jsonAjax.coopTable.coopInformation;
        var profEmpl = jsonAjax.employmentTable.professionalEmploymentInformation;

        var coopTa = '<table id="cooptableDegree">'+'<tr>'+'<th>Degree</th>'+'<th>Employer</th>' +'<th>Location</th>'+'<th>Term</th>' + '</tr>'; 
        
        var employTable = '<table id="employment-table">'+ '<tr>'+'<th>Degree</th>'+'<th>Employer</th>' +'<th>Location</th>';
        $.each(coopTabl, function(){
            coopTa = coopTa + '<tr>' +'<td>' + this.degree +'</td>'+'<td>' + this.employer + '</td>' +'<td>' + this.city +'</td>' +'<td>' + this.term + '</td>' +'</tr>';
        });
            coopTa = coopTa + '</table>';
       
        $('#cooptableDegree-content').append(coopTa);

       
        $.each(profEmpl, function(){
            employTable = employTable + '<tr>' + '<td>' + this.degree + '</td>' +'<td>' + this.employer + '</td>' +'<td>' + this.city + '</td>' +'<td>' + this.title + '</td>' +
                '<td>' + this.startDate + '</td>' +'</tr>';
        });
        employTable = employTable + '</table>';
        
        $("#employmentTablCont").append(employTable);
    });
    return getEmploymentAJAX();
}



// Employment informational
function getEmploymentAJAX(){       
            ajax('get', {path:"/employment/"}, "#employmentDisplay").done(function(jsonAjax){
        var degreeStat = jsonAjax.degreeStatistics.statistics;
        // Employment display
        var employmentSect = '<div id="employmentContent">' +
                                '<p class="sectHeading">' + jsonAjax.introduction.title + '</p>' +
                                '<h3>' + jsonAjax.introduction.content[0].title + '</h3>' +
                                '<p>' + jsonAjax.introduction.content[0].description + '</p>' +
                            '</div>';

        // Statistics Display
        $.each(degreeStat, function(){
            var employmentSect2 = '<div id="statistics-boxes">' +
                                '<h2>' + this.value + '</h2>' +
                                '<p>' + this.description + '</p>'+
                            '</div>';
            employmentSect = employmentSect + employmentSect2;
        });

        // Employers shown
        var employersSection = '<div id="DIVemployers">' +
                            '<h3>' + jsonAjax.employers.title + '</h3>';
        
        $.each(jsonAjax.employers.employerNames, function(pageEmp, elemEmp){
            var employersSection2 = '<span class="employerNamesSpan">' + elemEmp + '</span>'+ '</div>';
            employersSection = employersSection + employersSection2;
        }); 
        // Careers display
        var careersSection = '<div id="DIVcareers">' +
                        '<h3>' + jsonAjax.careers.title + '</h3>';
        
        $.each(jsonAjax.careers.careerNames, function(pageEmp, elemEmp){
            var careersSection2 = '<span class="careersNamesSpan">';
            careersSection = careersSection + careersSection2 + elemEmp + '</span>';
        });
        careersSection = careersSection + '</div>';  

                      
        // AppendChild of employemnt display to dom
        $('#employmentDisplay').append(employmentSect);
        $('#coopSectION').append('<div id="coop-content">' +
                            '<h3 style="padding-top: 1em;">' + jsonAjax.introduction.content[1].title + 
                        '</h3>' + '<p>' + jsonAjax.introduction.content[1].description 
                        + '</p>' + '</div>');
        $('#employersSection').append(employersSection);
        $('#careersSection').append(careersSection);
    });
            
            return getpeopleAJAX()
}
       

//People section Display
function getpeopleAJAX(){
        ajax('get',{path:'/people/'}, "#people")
			.done(function(json){
            
        // Title
        console.log(json);
        $('div#people people.Heading').append(json.title);
        $('div#people people.sub').append(json.subTitle);
        var subClick = '<p class ="sub-heading">Click on any of these links into access to our people.</p>';
        
                var currentRow = 0;
                
                tableElement = $("<table>", {"id": "myTable", "style": "width:100%"});
                tableElement2 = $("<table>", {"id": "myTable2", "style": "width:100%"});
                $("#dialogClickList").append(tableElement);
                $("#dialogClickList2").append(tableElement2);
                
                // Our faculty
				$.each(json.faculty,function(i, item){
                    var nextElement = $("<tr>", {"id": "myTr" + currentRow});
                    
                    var myTa = $("#myTable").append(nextElement);
                    if (i == 0)
                    {
                        nextElement;
                        myTa;
                    }
                    
                    nextElement = $("<td>");
                    nextElement.text(item.name);
                    var nextEle = $(myTable).append(nextElement);
                    nextEl = $("<tr>", {"id": "myTr" + currentRow});
                    var nextE = $(myTable).append(nextElement);
                    nextElement.click(function(){getName(json.faculty, item.name);});
                    $("#myTr" + currentRow).append(nextElement);
                    if ((i + 1) % 10 === 0)
                    {
                        nextElement = $("</tr>");
                        nextE;
                        nextEl;
                        nextEle;
                        currentRow++;
                    }
				});
                nextElement = $("</table>");
                
                $("#myTable").append(nextElement);
        
        
        
                //Staff
                var currentRow2 = 0;
                var nextElement2 = $("<tr>", {"id": "myTr2" + currentRow2});
                var myT = $("#myTable2").append(nextElement2);
                $.each(json.staff,function(i, item){
                    if (i == 0)
                    {
                        nextElement2;
                        myT;
                    }

                    nextElement2 = $("<td>");
                    nextElement2.text(item.name);
                    var nextEle2 = $(myTable2).append(nextElement2);
                    nextEl2 = $("<tr>", {"id": "myTr2" + currentRow2});
                    var nextE2 = $(myTable2).append(nextElement2);
                    nextElement2.click(function(){getName(json.staff, item.name);});
                    $("#myTr2" + currentRow2).append(nextElement2);
                    if ((i + 1) % 10 === 0)
                    {
                        nextElement2 = $("</tr>");
                        nextE2;
                        nextEl2;
                        nextEle2;
                        currentRow2++;
                    }
				});
                nextElement2 = $("</table>");
                $("#myTable2").append(nextElement2);
			});
    
            $("#dialogClick").dialog({
            autoOpen: false,
            width: 600,
            buttons: [
                {
                    text: "OK",
                    icons: {
                        primary: "ui-icon-heart"
                    },
                    click: function() {
                        $( "#dialogClick" ).dialog( "close" );
                    }
                }
            ]
        });
        return getResearchInterestAreasAJAX();
    } 
       
// Our research 
function getResearchInterestAreasAJAX(){
    ajax(GET, {path:"/research/"}, '#research').done(function(jsonAjax){
       
         var byIn = jsonAjax.byInterestArea;
         var byF = jsonAjax.byFaculty;
         interest =  '<div id="InterestAreaContainer">' +
                                    '<h2>By Interest Area</h2>';
         var subClick = '<p class ="sub-heading">Click on any of these links into access to our resources.</>';
                                
         facultyInter = '<div id="FacultyInterestContainer">' +
                                    '<h2>By Faculty</h2>';

        // By Interest area
        $.each(byIn, function(){
            // Modal for interest Area Box
            var frontModal = '<a href="#linkModal" rel="modal:open" id="interestAnchorModal">'+
                                '<div class="interestAreaBox" data-area-name="'+ this.areaName +'">' + 
                                    '<p>' + this.areaName + '</p>' +
                                '</div>' +
                            '</a>';
            var frontInter = '';
            interest = interest + frontModal;
        });


        // By Faculty
        $.each(byF, function(){
            var frontModal = '<a href="#linkModal" rel="modal:open" id="interestAnchorModal">' + 
                                '<div class="InterestFacultyBox"  facultyNameDate="' + this.username + '">' + 
                                    '<p>' + this.facultyName + '</p>' +
                                '</div>' +
                            '</a>';
            facultyInter = facultyInter + frontModal;
        });

        $('#research').append(subClick);
        $('#research').append(interest);
        $('#research').append(facultyInter);
        

        // On click event to then make the back modal
        $('.interestAreaBox').on('click', function(){
            InterestBackModal(byIn, 'areaName', $(this).attr('data-area-name'));
        });
        // On click event to then make the back modal
        $('.InterestFacultyBox').on('click', function(){
            InterestBackModal(byF, 'username', $(this).attr('facultyNameDate'));
        });
        return getResourcesAJAX();

    });
}

//Enrollment Back Modal
function EnrollmentBackModal(dataJ){
    var back = '';
    var modalCheck = false;
    if( $('.modallength').length > 0){
        Modal();
        modalCheck = true;
        back = back + '<h2>' + dataJ.title +'</h2>';
    }
    else{
        back = back + '<div id="linkModal" class="modal modallength">' +
                        '<h2>' + dataJ.title +'</h2>';
    }

    // Enrollment content
    $.each(dataJ.enrollmentInformationContent, function(){
        back = back +'<div class="enrollment-info">' +
                        '<h3>' + this.title + '</h3>' +
                        '<p>' + this.description + '</p>' +
                    '</div>';
    });

    // LINK
   back = back + '<a href="'+dataJ.RITJobZoneGuidelink+'" target="_blank">' +
                    '<p id="enrollment-job-zone-link">RIT Job Zone Guide</p>' +
                '</a>';


    if(modalCheck == true){
        $('#linkModal').append(back);
    }
    else{
        back = back + '</div>';
        $('body').append(back);
    }
}


// Our Resources
function getResourcesAJAX(){
    ajax('get', {path:"/resources/"}, '#resources').done(function(jsonAjax){
        var jsonAjaxTitle = jsonAjax.title;
        var jsonAjaxSubTitle = jsonAjax.subTitle;
        
        $('div#resources p.section-heading').append(jsonAjax.title);
        $('div#resources p.sub-heading').append(jsonAjax.subTitle); 

        // Study abroad
        var abroad = jsonAjax.studyAbroad;
        var studentAboard = jsonAjax.studyAbroad.title;
        $('#resources').append(buildResourcesFrontModal(studentAboard, 'studyAbr'));
        $('#studyAbr').on('click', function(){
            StudyAbroadBackModals(abroad);
        });

        // Student advising
        var studentServic = jsonAjax.studentServices;
        var studServ = jsonAjax.studentServices.title;
        $('#resources').append(buildResourcesFrontModal(studServ, 'advisin'));      
        $('#advisin').on('click', function(){
            AdvisingBackModal(studentServic);
        }); 

        // Our Lab & tutor information
        var tutorsLabI = jsonAjax.tutorsAndLabInformation;
        var tutorAndLab = jsonAjax.tutorsAndLabInformation.title;
        $('#resources').append(buildResourcesFrontModal(tutorAndLab, 'tutorsLabIn'));      
        $('#tutorsLabIn').on('click', function(){
            TutorsBackModal(tutorsLabI);
        });
      
        
        // Our Students ambassador 
        var studentAmbass = jsonAjax.studentAmbassadors;
        var studAbass = jsonAjax.studentAmbassadors.title;
        $('#resources').append(buildResourcesFrontModal(studAbass, 'studentAmbass'));      
        $('#studentAmbass').on('click', function(){
            StudentAmbassadorsBackModal(studentAmbass);
        });

        
        // Our Forms
        var forms = jsonAjax.forms;
        var form = jsonAjax.forms.title;
        $('#resources').append(buildResourcesFrontModal(form, 'forms'));      
        $('#forms').on('click', function(){
            FormsBackModal(forms);
        });
        

        // Coop eronllment
        var coopEnroll = jsonAjax.coopEnrollment;
        var coopEnrol = jsonAjax.coopEnrollment.title;
        $('#resources').append(buildResourcesFrontModal(coopEnrol, 'coopEnroll'));      
        $('#coopEnroll').on('click', function(){
             EnrollmentBackModal(coopEnroll);
        });
        
        return getFooterAJAX();
    });
}


//Resources Front and back Modal that user can click on to display front modal.
function buildResourcesFrontModal(resDataTitle, resourceICON){
    var frontModal = '';
    var iconDraw;
    var studyAb = '<i class="fas fa-plane-departure"></i>';
    var advisi = '<i class="icon-white fas fa-street-view"></i></i>';
    var tutorsLab = '<i class="fas fa-chalkboard-teacher"></i>';
    var studentAmb = '<i class="fas fa-graduation-cap"></i>';
    var formsApply = '<i class="far fa-copy resources-icons"></i>';
    var coopEnrol = '<i class="icon-white fas fa-sign-out-alt"></i>';
   
    switch(resourceICON){
        case "studyAbr":
            iconDraw  = studyAb;
            break;
        case "advisin":
            iconDraw = advisi;
            break;
        case "tutorsLabIn":
            iconDraw = tutorsLab;
            break;
        case "studentAmbass":
            iconDraw = studentAmb;
            break;
        case "forms":
            iconDraw = formsApply;
            break;
        case "coopEnroll":
            iconDraw = coopEnrol;
            break;
    }

    // Only undefined for the 'FORMS' seciton
    if(resDataTitle == undefined){
        frontModal = frontModal + '<a href="#linkModal" rel="modal:open" id="resourcAnchor">' +
                        '<div class="resourcBoxes" id="'+ resourceICON +'">' +
                            '<p class="resourcBoxTitles">Forms</p>' +
                            iconDraw +
                        '</div>'+
                    '</a>';
    }
    else{
        frontModal = frontModal + '<a href="#linkModal" rel="modal:open" id="resourcAnchor">' +
                        '<div class="resourcBoxes" id="'+ resourceICON +'" data-rname="'+ resDataTitle +'">' +
                            '<p class="resourcBoxTitles">' + resDataTitle + '</p>' +
                            iconDraw +
                        '</div>'+
                    '</a>';
    }
    return frontModal;
}

//Footer Main
function getFooterAJAX() {
    ajax('get', {path:"/footer/"}, '#footer').done(function(jsonAjax){

       // Link
        var hrefLink = '<div id="Links">';
        $.each(jsonAjax.quickLinks, function(){
            hrefLink = hrefLink + '<a href="'+ this.href 
            +'" title="'+ this.title 
            +'" target="blank-footer" id="footerLink">' 
            +'<div id="linkBoxes-footer">' 
            + '<p class="eacLink">' 
            + this.title + '</p>'+'</div>' 
            +'</a>';
        });
        hrefLink = hrefLink + '</div>';

        
        // Social 
        $('#footer-social').append('<div id="social">' 
        +'<h2>' + jsonAjax.social.title 
        + '</h2>' +'<p>' 
        + jsonAjax.social.tweet 
        + '</p>' +'<p>' 
        + jsonAjax.social.by 
        + '</p><br />' 
        +'<a href="'+jsonAjax.social.twitter+'" target="blank-footer">' 
        + '<i class="fab fa-twitter social-links"></i>' 
        +'</a>' +'<a href="'+ jsonAjax.social.facebook 
        +'" target="blank-footer">' 
        +'<i class="fab fa-facebook-f social-links" ></i>'
        +'</a>'+'</div>');
        
        //Href
        $('#footerInfo').append(hrefLink);
        
        // Our copyright 
        $('#footerInfo').append('<div id="copyright">' +'<h3>' 
        + jsonAjax.copyright.title + '</h3>' 
        +'<p>' + jsonAjax.copyright.html + '</p>' +'</div>');
    });

    // Footer for NEWS section
    ajax('get', {path:"/news/"}, '#footer').done(function(jsonAjax){
        var frontModal = '<a href="#linkModal" rel="modal:open">' +'<div id="news" data-news="news">'+'<p id="news-word">News</p>' +'</div>' +'</a>';
        $('#footerInfo-container').append(frontModal); // append to footer

        $('#news').on('click', function(){
            buildNewsBackModal(jsonAjax);
        });
        
    });
}


//Faculty information will be display when user click on. 
function getName(faculty, name) {

        for (const prop in faculty) {
            if (faculty[prop].name == name)
            {
                var divfacultyClick = "<div><ul>";

                divfacultyClick = divfacultyClick + "<li><font color='#18ADEA'><b><u>Title:</u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>" 
                    + faculty[prop].title + "</b></<li>"	
                divfacultyClick = divfacultyClick + "<li><font color='#18ADEA'><b><u>Email:</u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>" 
                    + faculty[prop].email + "</b></<li>"
                divfacultyClick = divfacultyClick + "<li><font color='#18ADEA'><b><u>Office:</u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>" 
                    + faculty[prop].office + "</b></<li><br><br>"	
                divfacultyClick = divfacultyClick + "<img src =" + faculty[prop].imagePath + ">";
                divfacultyClick = divfacultyClick +  "</ul></div>"; 
                $("#dialogClick").html(divfacultyClick);
                $("#dialogClick").dialog( "option", "title", name );
                $( "#dialogClick" ).dialog( "open" )
                break;
            }
        }

    }

//Staff information will be display when user click on.
function getStaffName(staff, name) {
        for (const prop in staff) {
            if (staff[prop].name == name)
            {
                var divstaffClick = "<div><ul>";
                divstaffClick = divstaffClick + "<li><font color='#18ADEA'><b><u>Title:</u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>" + staff[prop].title + "</b></<li>"	
                divstaffClick = divstaffClick + "<li><font color='#18ADEA'><b><u>Email:</u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>" + staff[prop].email + "</b></<li>"
                divstaffClick = divstaffClick + "<li><font color='#18ADEA'><b><u>Office:</u>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</font>" 
                + staff[prop].office + "</b></<li><br><br>"	
                divstaffClick = divstaffClick + "<img src =" + staff[prop].imagePath + ">";
                divstaffClick = divstaffClick +  "</ul></div>"; 
                $("#dialogClick").html(divstaffClick);
                $("#dialogClick").dialog( "option", "title", name );
                $( "#dialogClick" ).dialog( "open" )
                break;
            }
        }

    }





//Resources Front and back Modal. Back will be display when user can click on front modal.
//Clear
function Modal(){
    $.each($('#linkModal').children(), function(){
        $(this).remove();
    });
}

//Interest Back Modal
function InterestBackModal(BackModal, jsonField, dataBack){
    
    if(jsonField === "areaName"){
        
        var data = getAttributesByName(BackModal, jsonField, dataBack);

        // BackModal
        var back = '';

       
        if( $('.modallength').length > 0 ){
            Modal();
            back = back + '<h1>' + data.areaName + '</h1>' +
                            '<ul class="citation-list">';
        }else{
            back = '<div id="linkModal" class="modal modallength">' +
                            '<h1>'+ data.areaName + '</h1>' +
                            '<ul class="citation-list">';
        }

        
        $.each(data.citations, function(index, elem){
            back += '<li>' + elem + '</li>';
        });
        back = back + '</ul>';


        if( $('.modallength').length > 0 ){
            $('#linkModal').append(back);
        }
        else{
            back = back + '</div>';
            $('body').append(back); 
        }

    }
    else if(jsonField === "username"){ 

        
        var data = getAttributesByName(BackModal, jsonField, dataBack);

        var back = "";

        
        if( $('.modallength').length > 0 ){
            Modal();
            back = back +  '<h1>'+ data.facultyName + '</h1>' +
                            '<ul class="citation-list">';
        }
        else{
            back = '<div id="linkModal" class="modal modallength">' +
                            '<h1>'+ data.facultyName + '</h1>' +
                            '<ul class="citation-list">';
        }

        
        $.each(data.citations, function(index, elem){
            back += '<li>' + elem + '</li>';
        });
        back = back + '</ul>'; 
        

        if( $('.modallength').length > 0 ){
            $('#linkModal').append(back);
        }
        else{
            back += '</div>';
            $('body').append(back); 
        }
    }
}



function buildNewsBackModal(queryField){
    var back = "";
    var modalCheck = false;
    
    
    if( $('.modallength').length > 0 ){
        Modal();
        modalCheck = true;
    }
    else{
        
        back = '<div id="linkModal" class="modal modallength">';
    }


    
    $.each(queryField.older, function(){
        
        back = back + '<p class="news-titles">' + this.title + '</p>' +
                        '<p class="news-timestamp">' + this.date.substring(0,10) + '</p>';

       
        if(this.description != null){
            back = back + '<p>' + this.description + '</p>';
        }
    });

     
    if( modalCheck == true ){
        $('#linkModal').append(back);
    }
    else{
        back = back + '</div>';
        $('body').append(back);
    }
}

//StudyAbroad Back Modals
function StudyAbroadBackModals(dataJ){
    var studyAbr = '';

    if( $('.modallength').length > 0 ){
        Modal();
        studyAbr += '<h2>' + dataJ.title + '</h2>' +
                            '<p class="study-abroad-description">' + dataJ.description + '</p>';
    }else{
        studyAbr += '<div id="linkModal" class="modal modallength">' +
                            '<h2>' + dataJ.title + '</h2>' +
                            '<p class="study-abroad-description">' + dataJ.description + '</p>';
    }

    $.each(dataJ.places, function(){
        studyAbr += '<h3>' + this.nameOfPlace + '</h3>' +
            '<p class="study-abroad-description">' + this.description + '</p>';
    });

    if( $('.modallength').length > 0 ){
        $('#linkModal').append(studyAbr);
    }
    else{   
        studyAbr += '</div>';
        $('body').append(studyAbr);
    }
}

//Advising Back Modal
function AdvisingBackModal(dataJ){
    var studyAbroadBackDisplay = '';
    var check = false;

    if( $('.modallength').length > 0){
        Modal();
        check = true;
        studyAbroadBackDisplay = studyAbroadBackDisplay + '<h2>' + dataJ.title + '</h2>';
    }else{
        studyAbroadBackDisplay = studyAbroadBackDisplay + '<div id="linkModal" class="modal modallength">';
    }

    
    studyAbroadBackDisplay = studyAbroadBackDisplay + '<div id="academic-advisors">' +
                            '<h2>' + dataJ.academicAdvisors.title + '</h2>' +
                            '<p>' + dataJ.academicAdvisors.description + '</p>' +
                            '<a href="'+dataJ.academicAdvisors.faq.contentHref+'" target="_blank" id="advising-faq-link">' +
                                '<h3>' + dataJ.academicAdvisors.faq.title +'</h3>' +
                            '</a>' +
                        '</div>';

    
    studyAbroadBackDisplay = studyAbroadBackDisplay + '<div id="professonal-advisors">' +
                            '<h2>' + dataJ.professonalAdvisors.title + '</h2>';

    $.each(dataJ.professonalAdvisors.advisorInformation, function(){
        studyAbroadBackDisplay = studyAbroadBackDisplay +  '<div id="prof-advisor-info">' +
                                '<h3>' + this.name + '</h3>' +
                                '<p id="advisor-department">' + this.department + '</p>' +
                                '<p><strong>' + this.email + '</strong></p>' +
                            '</div>';
    });
    studyAbroadBackDisplay = studyAbroadBackDisplay + '</div>';



    studyAbroadBackDisplay = studyAbroadBackDisplay + '<div id="faculty-advisors">'+
                            '<h2>' + dataJ.facultyAdvisors.title + '</h2>' +
                            '<p>' + dataJ.facultyAdvisors.description + '</p>' +
                        '</div>';
                        
    
    studyAbroadBackDisplay = studyAbroadBackDisplay + '<div id="ist-minor-advising">' +
                            '<h2>' + dataJ.istMinorAdvising.title + '</h2>';

    $.each(dataJ.istMinorAdvising.minorAdvisorInformation, function(){
        studyAbroadBackDisplay = studyAbroadBackDisplay + '<div class="minor-advisor-info">' +
                                '<h4>' + this.title + '</h4>' +
                                '<p>' + this.advisor + '</p>' +
                                '<p>' + this.email + '</p>' +
                            '</div>';
    });
    studyAbroadBackDisplay = studyAbroadBackDisplay + '</div>';


    if(check == true){
        $('#linkModal').append(studyAbroadBackDisplay);
    }
    else{
        studyAbroadBackDisplay = studyAbroadBackDisplay + '</div>';
        $('body').append(studyAbroadBackDisplay);
    }
}


//Tutors Back Modal
function TutorsBackModal(dataJ){
    var back = '';
    if( $('.modallength').length > 0 ){
        Modal();
        back = back + '<h2>' + dataJ.title + '</h2>' +
                        '<p>' + dataJ.description + '</p>' +
                        '<a href="'+dataJ.tutoringLabHoursLink+'" target="_blank">' +
                            '<p id="lab-hours-link">Lab Hours</p>' +
                        '</a>';

        $('#linkModal').append(back);
    }else{
        back = back + '<div id="linkModal" class="modal modallength">' +
                        '<h2>' + dataJ.title + '</h2>' +
                        '<p>' + dataJ.description + '</p>' +
                        '<a href="'+dataJ.tutoringLabHoursLink+'" target="_blank">' +
                            '<p id="lab-hours-link">Lab Hours</p>' +
                        '</a>' +
                    '</div>';
        $('body').append(back);
    }
}

// StudentAmbassadors Back Modal
function StudentAmbassadorsBackModal(dataJ){
    var back = '';
    var modalCheck = false;

    if( $('.modallength').length > 0 ){
        Modal();
        modalCheck = true;
        back = back + '<h2>' + dataJ.title + '</h2>' +
                        '<img src="'+ dataJ.ambassadorsImageSource+'" id="sa-image"  alt="student ambassadors" title="student ambassadors" >';          
    }
    else{
        back = back + '<div id="linkModal" class="modal modallength">' +
                        '<h2>' + dataJ.title + '</h2>' +
                        '<img src="'+ dataJ.ambassadorsImageSource+'" id="sa-image" alt="student ambassadors" title="student ambassadors">';          
    }

    
    $.each(dataJ.subSectionContent, function(){
        back = back + '<div class="sa-subcontent">' +
                        '<h2>' + this.title + '</h2>' +
                        '<p>' + this.description + '</p>' +
                    '</div>';
    });

    
    back = back + '<a href="'+ dataJ.applicationFormLink +'" target="_blank">' +
                    '<div id="sa-apply">Apply</div>' +
                '</a>' +
                '<p id="sa-note">*' + dataJ.note + '</p>';
                    
    if( modalCheck == true){
        $('#linkModal').append(back);
    }   
    else{
        back = back + '</div>';
        $('body').append(back);
    }

}

// Forms Back Modal
function FormsBackModal(dataJ){
    var back = '';
    var modalCheck = false;


    if( $('.modallength').length > 0 ){
        Modal();
        modalCheck = true;
        back = back +  '<h2>Forms</h2>';
    }
    else{
       back = back + '<div id="linkModal" class="modal modallength">' +
                        '<h2>Forms</h2>';
    }

    
    back += '<p class="form-title">Graduate Forms</p>';
    $.each(dataJ.graduateForms, function(){
        back = back + '<span class="graduateForms">' +
                        '<a href="'+ this.href +'" target="_blank">' +
                          '<p class="form-names">' + this.formName + '</p>' +
                        '</a>' +
                    '</span>';
    });

    
    back = back + '<p class="form-title">Undergraduate Forms</p>' +
                    '<a href="'+ dataJ.undergraduateForms[0].href +'" target="_blank">' +
                        '<p class="form-names">' + dataJ.undergraduateForms[0].formName + '</p>' +
                    '</a>';


    if(modalCheck == true){
        $('#linkModal').append(back);
    }
    else{
        back = back + '</div>';
        $('body').append(back);
    }
}




