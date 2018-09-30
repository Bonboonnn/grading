<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>E-Grading</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">  
    <title>Document</title>
</head>
    <?php 
        function themePrimary() {
            echo 'deepskyblue'; // change theme color
        }
    ?>
    <style>
        body {
            background-color: whitesmoke;
            margin: 0;
            padding: 0;
            width:100%;
            overflow-x: hidden;
        }
        * {
            font-family: century gothic;
        }
        button,select {
            border-radius: 5px;
            box-shadow:-2px 2px 4px 0 gray;
            border-width: 1px !important;
        }
        select {
            border-style: none;
        }
        input {
            text-indent: 8px;
        }
        button:focus, select:focus {
            outline-style: none !important;
        }
        .content {
            width: 100vw;
            overflow-x: hidden;
        }
        #nav {
            width: 100%;
            height: 60px;
            background-color: white;
            border-bottom-style: solid;
            border-bottom-color: <?php echo themePrimary(); ?>;
            border-bottom-width: 1px;
            display: flex;
            flex-direction: row;
            position: fixed;
            top: 0px;
            left: 0px;
            z-index: 99;
            box-shadow:-2px 2px 4px 0 gray;
        }
        #title {
            font-size: 1.3em;
            padding-top: 15px;
            padding-left: 8px;
            width: 260px;

        }
        #content {
            position: absolute;
            width: 100%;
            top: 60px;
            left: 0px;
        }
        #gradeWrapper  table{
            width: 100%;
            border-collapse: collapse;
        }
        #gradeWrapper table tr,th,td { 
            color: #555555;
            padding: 10px;  
            text-align: center;

        } 
        th {
            padding-top: 10px;
            color: white;
            padding-bottom: 15px;
            color: #555555;
        }
        #tableWrapper table th {
            background-color: white;
        }
        #gradeWrapper,#homeWrapper{
            width: 90%;
            background-color: white;
            padding: 8px;
            padding-top: 16px;
            margin-top: 10px;
            margin: auto;
            margin-top: 10px;
            border-radius: 5px;
        }
        .year {
            padding: 8px;
            border-radius: 8px;
            width: 100%;
        }
        .flex {
            margin-bottom: 8px;
            display: flex;
            flex-direction: row;
        }
        #print {
            margin-left: 8px;
            border-radius: 8px;
            font-weight: bold;
            border-style: none;
            background-color: <?php echo themePrimary(); ?>;
            cursor: pointer;
            color: white;
        }
        #account {
            width:100%;text-align: right;padding-top: 12px;padding-right: 8px;
        }
        #account button {
            height: 35px;
            border-style: solid;
            background-color: transparent;
            border-color: <?php echo themePrimary(); ?>;
            border-radius: 10px;
            cursor: pointer;
        }
        #account button:hover {
            background-color: <?php echo themePrimary(); ?>;
            color: white;
        }
        .year-sem {
            display: none;
        }
        .year-semesterz {
            font-size: 1.2em;
            font-weight: bold;
            background-color:whitesmoke;
        }
        #footer {
            width: 100%;
            position: fixed;
            bottom: 0px;
            height: 50px;
            background-color: white;
            display: flex;
            flex-direction: row;
            display: none;
            z-index: 99;
        }
        #footer button {
            margin: 8px;
            border-radius: 8px;
            min-width: 80px;
            background-color: transparent;
            border-style: solid;
            border-color: <?php echo themePrimary(); ?>;
        }
        #footer button:hover {
            background-color: <?php echo themePrimary(); ?>;
            color: white;
            cursor: pointer;
        }
        #modal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.1);
            display: none;
            z-index: 100;
        }
        .modal-content {
            width: 200px;
            min-height: 200px;
            background-color: white;
            position:absolute;
            left: calc(50% - 100px);
            top:calc(50% - 100px);
            border-radius: 5px;
            transition: 0.6s;
            transform: scale(0);
            opacity: 0;
            box-shadow:-2px 2px 4px 0 gray;
        }
        .modal-content.showed {
            opacity: 1;
            transform: scale(1);
        }
        #changePassword, #logout {
            display: block;
            width: 90%;
            margin: auto;
            padding:10px;
            margin-top:20px;
            border-radius: 8px;
            background-color: transparent;
            border-style: solid;
            cursor: pointer;    
        }
        #changePassword {
            margin-top: 50px;
            border-color:<?php echo themePrimary(); ?>;
        }
        #changePassword:hover {
            background-color: <?php echo themePrimary(); ?>;
            color: white;
        }
        #logout {
            border-color: crimson;
        }
        #logout:hover {
            background-color: crimson;
            color: white;
        }
        #homeWrapper table,
        #homeWrapper th,
        #homeWrapper td,
        #homeWrapper tr {
            border-style: none !important;
            text-align: left !important;
            border-collapse: unset !important;
            border-spacing: 15px;
        }
        #homeWrapper table{
            width: 100%;
            text-align: left !important;
            border-collapse: unset !important;
        }
        #homeWrapper table td {
            border-radius: 10px;
        }
        #homeWrapper table td {
            padding: 8px !important;
            text-align: center!important;
            box-shadow:-2px 2px 4px 0 gray;
        }
        .profile-label {
            width: auto;
            font-weight: bold;
            width: 120px;
        }
        .profile {
            font-size: 1.5em;
            text-align: center !important;
            background-color: <?php echo themePrimary(); ?>;
            font-weight: bold;
        }
        .home.active,
        .grades.active {
            background-color: <?php echo themePrimary(); ?> !important;
            color: white;
        }
        #gradeWrapper {
            position: absolute;
            top: 30px;
            left: calc(5% - 8px);
            transition: 0.8s;
            opacity: 0;
            width: 90% !important;
            margin: 0 !important;
            display:none;
            box-shadow:-2px 2px 4px 0 gray;
        }
        #homeWrapper{
            transition: 0.8s;
            position: absolute;
            top: 30px;
            left: calc(5% - 8px);
            opacity: 0;
            width: 90% !important;
            margin: 0 !important;
            display:none;
            box-shadow:-2px 2px 4px 0 gray;
        }
        #gradeWrapper.showed {
            opacity: 1;
        }
        #homeWrapper.shows {
            opacity: 1;
        }
        #changePassModal {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 100;
            background-color: rgba(0,0,0,0.1);
            display: none;
        }
        .changepass-modal {
            width: 250px;
            min-height: 230px;
            background-color: white;
            position: absolute;
            top: calc(50% - 150px);
            left:calc(50% - 125px);
            border-radius: 8px;
            box-shadow: 0 0 4px gray;
            transition: 0.6s;
            transform: scale(0);
            opacity: 0;
            box-shadow:-2px 2px 4px 0 gray;
        }
        .changepass-modal.showz {
            transform: scale(1);
            opacity: 1;
        }
        .inputs {
            width: 90%;
            display: block;
            margin: auto;
            margin-top: 10px;
            border-style: none;
            height: 30px;
            background-color:whitesmoke;
            border-radius:25px;
        }

        .inputs:focus { 
            transition:1s;
            background-color:white;
            box-shadow:-2px 2px 4px 0 gray;
        }
        .changepass-title{
            padding: 8px;
            background-color: <?php echo themePrimary(); ?>;
            text-align: center;
            color: white;
            border-top-left-radius: 8px;
            border-top-right-radius: 8px;
        }
        #changed {
            display: block;
            width: 90%;
            margin: auto;
            height: 40px;
            margin-top: 10px;
            border-radius: 8px;
            background-color: transparent;
            border-style: solid;
            border-color: <?php echo themePrimary(); ?>;
        }
        #changed:hover {
            background-color: <?php echo themePrimary(); ?>;
            color: white;
        }
        input:focus {
            outline-style: none !important;
        }


        .spinner::before {
            content: '';
            box-sizing: border-box;
            position: fixed;
            top:calc(50% - 25px);
            left:calc(50% - 25px);
            width:50px;
            height:50px;
            z-index: 999;
            background-color: white;
            border-radius: 100%;
            box-shadow:-2px 2px 4px 0 gray;
        }
        .spinner::after {
            content: '';
            box-sizing: border-box;
            position: fixed;
            top:calc(50% - 20px);
            left:calc(50% - 20px);
            width:40px;
            height:40px;
            z-index: 999;
            border-radius: 100%;
            border-style: solid;
            border-width: 4px;
            border-color:<?php echo themePrimary(); ?>;
            border-right-color: #ccc;
            border-bottom-color: #ccc;
            animation-name: rotate;
            animation-duration: 1s;
            animation-iteration-count: infinite;
            animation-delay: 0;
            animation-direction: normal;
            animation-fill-mode: forwards;
        }
        @keyframes rotate {
            0% {
                transform: rotate(0deg);
            }
            50% {
                transform: rotate(180deg);
            }
            100% {
                transform: rotate(360deg);
            }
        }

        .small-g {
            display: none;
        }

        .sy {
            background-color:<?php themePrimary(); ?>;
            color: #fff;
            border-bottom-style:solid;
            border-bottom-color: rgba(0,0,0,0.2);
            border-bottom-width: 2px;
            text-align:left;
            border-top-right-radius: 25px;
        }
        .sem {
            text-align:left;
        }
        .print {
            display:none;
        }
        @media screen and (max-width:500px) {
            #content,#gradeWrapper,#homeWrapper {
                margin-bottom: 60px !important;
            }
            .small-g {
                display:table-row;
            }
            .small-g td {
                text-align:center;
                color:white;
            }

            .small-g td:first-child {
                background-color: slategray ;
            }
            
            .small-g td:last-child {
                background-color: orange;
            }

            .large-g {
                display:none;
            }
            #gradeWrapper td, #gradeWrapper th {
                padding: 5px;
            } 
            th {
                font-size:0.9em;
            }
            .large {
                display: none;
            }
            #footer {
                display: flex;
            }
        }
    </style>
    <style media="print">
        .flex {
            display: none;
        }
        .print {
            display: table-row;
        }
        #gradeWrapper {
            position: relative;
            padding: 0; 
            box-shadow: none !important;
            margin: 0 !important; 
        }
        table {
            width:100%;
        }
        
        #gradeWrapper table tr,th,td { 
            border-style: solid;
            border-width: 1px;
            border-color: #ccc;
        }
             #nav {
                 box-shadow: none !important;
             }
        .year-sem {
            display: table-cell;
        }
        .not-print {
            display: none;
        }
    </style>
<body onclick="targetz(event)" class='spinner'>
    <div id="nav">
        <div id="title">E-Grading</div>
        <div id="account" class="not-print">
            <button class='large home' onclick="go('home')">Home</button>
            <button class='large grades' onclick="go('grades')">Grades</button>
            <button onclick="account()">Account</button>
        </div>
    </div>
        <div id="content">  
            <div id="gradeWrapper">
                <div class='flex'>
                        <select onchange="gradesByYear()" class='year' id="year">
                        </select>
                        <button onclick="print()" id="print" class="large">Print</button>
                </div>
                <table>
                        <thead>
                            <tr class="print">
                                <th>Subject Code</th>
                                <th>Prelim</th>
                                <th>MidTerm</th>
                                <th>Final</th>
                                <th class='large-g'>Final Grade</th>
                                <th class='large-g'>Remarks</th>
                                <th class='year-sem'>Year</th>
                                <th class='year-sem'>Semester</th>
                            </tr>
                        </thead>
                        <tbody id="gWrapper">
                        </tbody>
                    </table>
            </div>

            <div id="homeWrapper">
               <table>
                   <tbody>
                    <tr class="profile">
                        <td class="profile-label">Profile</td>
                        <td></td>
                    </tr>
                    <tr>
                        <td class="profile-label">Student ID.</td>
                        <td id="studentID">...</td>
                    </tr>
                    <tr>
                        <td class="profile-label">First Name</td>
                        <td id="studentFname">...</td>
                    </tr>
                    <tr>
                        <td class="profile-label">Middle Name</td>
                        <td id="studentMname">...</td>
                    </tr>
                    <tr>
                        <td class="profile-label">Last Name</td>
                        <td id="studentLname">...</td>
                    </tr>
                    <tr>
                        <td class="profile-label">Course</td>
                        <td id="studentCourse">...</td>
                    </tr>
                    <tr>
                        <td class="profile-label">Year Level</td>
                        <td id="studentYearLevel">...</td>
                    </tr>
                    </tbody>
               </table>
            </div>
            </div>
            <div id="footer" class='smallz'>
               <button onclick="go('home')" class="home">Home</button>
               <div style='width:100%'></div>
               <button onclick="go('grades')" class="grades">Grades</button>
            </div>
        </div>
        <div class='account-modal' id="modal">
            <div class="modal-content">
                <button id="changePassword" onclick="showChangePassword()">Change Password</button>
                <button id="logout" onclick="go('logout')">Logout</button>
            </div>
        </div>
    <div id="changePassModal">
        <div class="changepass-modal">
            <form onsubmit="changePassword(event)">
                <div class="changepass-title">Change Password</div>
                <input class="inputs" name="oldpass" id="oldPass" type="password" placeholder="Old Password" required>
                <input class="inputs" name="newPass" id="newPass" type="password" placeholder="New Password" required>
                <input class="inputs" name="retypeNewPass" id="retypeNewPass" type="password" placeholder="Retype New Password" required>
                <button id="changed">Change</button>
            </form>
        </div>
    </div>
</body>
<script src="../../../plugins/jQuery/jquery-2.2.3.min.js"></script>
<script>
    let page = 'home';
    let studentData;
    let studentInfo;
    let studentGrade;

    function account() {
        modal.style.display='block';
        setTimeout(()=>{
            modal.getElementsByClassName('modal-content').item(0).classList.toggle('showed');
        },10);
    }

    function targetz(event) {
       if(event.target.id == 'modal') {
            modal.getElementsByClassName('modal-content').item(0).classList.remove('showed');
            setTimeout(()=>{
                modal.style.display='none';
            },600);
       } else if(event.target.id == 'changePassModal') {
            changePassModal.getElementsByClassName('changepass-modal').item(0).classList.remove('showz');
            setTimeout(()=>{
                changePassModal.style.display='none';
            },600);
       }
    }
    function showChangePassword() {
        changePassModal.style.display='block';
        setTimeout(()=>{
            changePassModal.getElementsByClassName('changepass-modal').item(0).classList.toggle('showz');
        },10);
    }

    function changePassword(e) {
        e.preventDefault();
        if (newPass.value == retypeNewPass.value) {
            /* $.ajax({
                url:'',
                method:'post',
                data:{oldPass:oldPass.value,newPass:newPass},
                success:(e)=>{
                    if('success') {
                        changePassModal.getElementsByClassName('changepass-modal').item(0).classList.remove('showz');
                        setTimeout(()=>{
                            changePassModal.style.display='none';
                        },600);
                        oldPass.value = "";
                        newPass.value = "";
                        retypeNewPass = "";
                    } else {
                        alert('Incorrect Old Password');
                    }
                }
            });*/
        } else {
            alert('Incorrect Retype Password');
        }
    }

    function go(req) {
        if(req=='home') {
            homeWrapper.style.display='block';
            gradeWrapper.classList.remove('showed');
                document.querySelector('body').classList.add('spinner');
            window.setTimeout(() => {
                homeWrapper.classList.add('shows');
                gradeWrapper.style.display='none';
                document.querySelector('body').classList.remove('spinner');
            }, 800);
            for(let el  of document.getElementsByClassName('home')) {
                el.classList.add('active');
            }
            for(let el  of document.getElementsByClassName('grades')) {
                el.classList.remove('active');
            }
        } else if(req=='grades') {
            gradeWrapper.style.display='block';
            homeWrapper.classList.remove('shows');
            document.querySelector('body').classList.add('spinner');
            window.setTimeout(() => {
                homeWrapper.style.display='none';
                gradeWrapper.classList.add('showed');
                document.querySelector('body').classList.remove('spinner');
            }, 800);

            for(let el  of document.getElementsByClassName('grades')) {
                el.classList.add('active');
            }
            for(let el  of document.getElementsByClassName('home')) {
                el.classList.remove('active');
            }
        } else if(req == 'logout') {
            if (confirm('Are you sure You want to logout?')) {
                window.location = '';
            }
        }
    }

    function get_student_details () {
        document.querySelector('body').classList.add('spinner');
        $.ajax({
            method: "GET",
            url: "student_infos",
            data: {student_idno: "test1"},
            success: function(e) {
                initializeData(e);
                groupSchoolYear();
                go(page);
            }
        });
    } 

    function initializeData(e) {
        studentData = JSON.parse(e);
        studentInfo = studentData.student_info[0];
        studentGrade = studentData.student_grade;
        studentID.innerHTML = studentInfo.studentIdno;
        studentFname.innerHTML = studentInfo.student_fname;
        studentLname.innerHTML = studentInfo.student_lname;
        studentMname.innerHTML = studentInfo.student_mname;
        studentCourse.innerHTML = studentInfo.description;
        studentYearLevel.innerHTML = studentInfo.yearLevel;
    }

    function groupSchoolYear() {
        let school = [];
        studentGrade.forEach(val => {
            if(school.length == 0) {
                school.push({
                    schoolyear_id:val.schoolyear_id,
                    schoolYear:val.schoolYear
                });
            } else {
                if(!school.find(f => val.schoolYear == f.schoolYear)) {
                    school.push({
                        schoolyear_id:val.schoolyear_id,
                        schoolYear:val.schoolYear
                    });
                }
            }
        }); 
        school.sort((s1,s2) => {
            return s2.schoolYear.split('-')[0] - s1.schoolYear.split('-')[0] ; 
        });
        let opt = `<option value="">Select Year</option>`;
        school.forEach(val => {
            opt += `<option value="${val.schoolYear}">${val.schoolYear}</option>`;
        });
        year.innerHTML = opt;
        gradesByYear();
    }

    function gradesByYear() {
        let grades = []; 
        grades = studentGrade.filter(val => {
                if(year.value == ''){
                    return true;
                }
                return val.schoolYear == year.value;
            });
        grades = grades.sort((s1, s2) => {
            return s2.semester.charCodeAt(0) - s1.semester.charCodeAt(0); 
        });
        grades = grades.sort((s1, s2) => {
            return s2.schoolYear.split('-')[0] - s1.schoolYear.split('-')[0] ; 
        });


        let tr = ``;
        let schoolYear = 0;
        let semester = '';
        grades.forEach(val => {
            let sy = `
                         <tr class="small-g" >
                            <td colspan="6" style="background-color:transparent">
                            </td>
                        </tr>
                          <tr>
                            <td colspan="6" class="sy not-print year-semesterz">
                                ${val.schoolYear}
                            </td>
                        </tr>`;
            let sem = ` <tr>
                            <td colspan="6" class="sem not-print year-semesterz">
                                 ${val.semester}
                            </td>
                        </tr>
                        <tr class="not-print">
                            <th>Subject Code</th>
                            <th>Prelim</th>
                            <th>MidTerm</th>
                            <th>Final</th>
                            <th class='large-g'>Final Grade</th>
                            <th class='large-g'>Remarks</th>
                            <th class='year-sem'>Year</th>
                            <th class='year-sem'>Semester</th>
                        </tr>`;
            let syTRUE  = false;
            let semTRUE  = false;
            if(schoolYear != val.schoolYear) {
                syTRUE = true;
                schoolYear = val.schoolYear;
                semester = '';
            }
             if(semester != val.semester) {
                semTRUE = true;
                semester = val.semester;
            }
            tr += ` ${syTRUE ? sy : ''}
                    ${semTRUE ? sem : ''}
                    <tr>
                        <td>${val.subjectName}</td>
                        <td>${val.prelim}</td>
                        <td>${val.midterm}</td>
                        <td>${val.final}</td>
                        <td class='large-g'>${val.finalGrade}</td>
                        <td class='large-g'>${val.remarks}</td>
                        <th class='year-sem'>${val.schoolYear}</th>
                        <th class='year-sem'>${val.semester}</th>
                    </tr>
                    <tr class='small-g'>
                        <td colspan='2'>${val.finalGrade}</td>
                        <td colspan='2'>${val.remarks}</td>
                    </tr>`;
        });

        gWrapper.innerHTML = tr;
    }

    get_student_details();
</script>
</html>