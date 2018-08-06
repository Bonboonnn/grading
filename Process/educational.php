<style>
    .inputs{
    border-radius: 3px;
    border-style: none;
    box-shadow: 0px 0px 1px black;  
    height: 30px;
    margin-top: 5px;
    width:98%;
    text-indent: 5px;
    margin-bottom: 5px;
    }
    .small{
        width:48.5%;
    } 
    .voc_div{
        padding: 2%;
        box-shadow: 0px 0px 1px black;
    }
    #s_id{
        height:600px !important;
        overflow-y:scroll !important;
        
    }
    #s_id::-webkit-scrollbar{
            background-color: transparent;
        }
     #s_id::   scrollbar{
            background-color: transparent;
        }
</style>
<ul class="nav nav-tabs">
    <li class="active"><a id='elem' href="#elementary" data-toggle="tab">Elementary</a></li>
    <li><a id='sec' href="#secondary" data-toggle="tab">Secondary</a></li> 
    <li><a id='voca' href="#vocational" data-toggle="tab">Vocational</a></li> 
    <li><a id='coll' href="#college" data-toggle="tab">College</a></li> 
    <li><a id="gradz" href="#graduate" data-toggle="tab">Graduate</a></li> 
</ul>
<center>
    <form id="school_background" method="post" action="../employee-educ-proc.php" >
        <div id="s_id">
            <div style="" id="row1" class="tab-content" > 
                <div class="active tab-pane" id="elementary">
                    <h2>Elementary</h2><br>
                    <label>
                        Name Of School
                        (Write in full)
                    </label><br>
                    <input type="text" class="inputs" placeholder="Name Of School (Write in full)" name="elem_school_name">
                    <label>
                        Basic Educational/Degree/Course
                        (Write in full)
                    </label><br>
                    <input type="text" class="inputs" placeholder="Basic Educational/Degree/Course" name="elem_degree">
                    <label> 
                        Period Of Attendance
                    </label><br>
                    <label style="float:left;margin-left:1%">From:</label>
                    <label>To:</label>
                    <br>
                    <select type="text" class='inputs datez small' placeholder="YYYY" name="from"></select> 
                    <select type="text" class='inputs datez small' placeholder="YYYY" name="to"></select>
                    <label>
                        Highest Level/ Units earned
                        (if not graduate)
                    </label><br>
                    <input type="text" class="inputs" placeholder="Highest Level/ Units earned(if not graduate)" name="elem_units_earned">
                    <label>
                        Year Graduated
                    </label><br>
                    <select type="text" class='inputs datez' placeholder="YYYY" name="elem_year_grad"></select>
                    <label> 
                               Scholarship/ Academic Honors Received
                            </label><br>    
                    <input type="text" class="inputs" placeholder="Scholarship/ Academic Honors Received" name="elem_honor">
                    <br><br>
                </div>
                
                <div class="tab-pane" id="secondary">
                    <h2>Secondary</h2><br>
                    <label>
                                Name Of School
                                (Write in full)
                    </label><br>
                    <input type="text" class="inputs" placeholder="Name Of School (Write in full)" name="sec_school">
                    <label>
                        Basic Educational/Degree/Course
                        (Write in full)
                    </label><br>
                    <input type="text" class="inputs" placeholder="Basic Educational/Degree/Course" name="sec_degree">
                    <label> 
                        Period Of Attendance
                    </label><br>
                    <label style="float:left;margin-left:1%">From:</label>
                    <label>To:</label>
                    <br>
                    <select type="text" class='inputs datez small' placeholder="YYYY" name="sec_from"></select> 
                    <select type="text" class='inputs datez small' placeholder="YYYY" name="sec_to"></select>
                    <label>
                        Highest Level/ Units earned
                        (if not graduate)
                    </label><br>
                    <input type="text" class="inputs" placeholder="Highest Level/ Units earned(if not graduate)" name="sec_unit_earned">
                    <label>
                        Year Graduated
                        
                    </label><br>
                    <select type="text" class='inputs datez' placeholder="YYYY" name="sec_year_grad"></select>
                    <label>
                        Scholarship/ Academic Honors Received
                    </label><br>
                    <input type="text" class="inputs" placeholder="Scholarship/ Academic Honors Received" name="sec_honor">
                    <br><br>
                </div>
                
                <div class="tab-pane" id="vocational">
                    <button class="btn btn_small btn-success" style="float:right" type="button" id="advoc">+</button>
                    <h2>Vocational/Trade course</h2><br>
                    <div id="voc"></div>
                </div>
                
            <div class="tab-pane" id="college">
                <button class="btn btn_small btn-success" style="float:right" type="button" id="adcollege">+</button>
                <h2>College</h2><br>
                <div id="col"></div>
            </div>
                
            <div class="tab-pane" id="graduate">
                <button class="btn btn_small btn-success" style="float:right" type="button" id="adgrad">+</button>
                <h2>Graduate</h2><br>
                <div id="grad_div"></div>
            </div>
            <br>
        </div>
            <input id='sub' style="display:none" type="submit" class="btn btn-primary" style="float:right" value="Submit">
            <input id='res' style="display:none" type="reset" class="btn btn-danger" style="float:right">
        </div>
    </form>
</center>
<script>  
    school_background.onsubmit=(e)=>{ 
        e.preventDefault();
        var data=new FormData();
        var daw_data=""; 
        var proceed_to_submit=true;
        for(var i=0;i<school_background.getElementsByClassName('inputs').length;i++){ 
            data.append(school_background.getElementsByClassName('inputs')[i].getAttribute("name"),
                       school_background.getElementsByClassName('inputs')[i].value);
            daw_data+="$"+school_background.getElementsByClassName('inputs')[i].getAttribute("name")
                +"=$_POST['"+school_background.getElementsByClassName('inputs')[i].getAttribute("name")+"'];\n";
        var txt=0;
            for(var j=0;j< school_background.getElementsByClassName('inputs')[i].value.length;j++){ 
                if( school_background.getElementsByClassName('inputs')[i].value[j]!=" "&& school_background.getElementsByClassName('inputs')[i].value[j]!=""){
                    txt++; 
                }
            }  
            if(txt<1){
                school_background.getElementsByClassName('inputs')[i].style.backgroundColor="rgba(83,0,0,0.8)"; 
                school_background.getElementsByClassName('inputs')[i].style.color="#ffffff";
                school_background.getElementsByClassName('inputs')[i].value="";
                proceed_to_submit=false;
            }
            else{
                school_background.getElementsByClassName('inputs')[i].style.backgroundColor="white";
                school_background.getElementsByClassName('inputs')[i].style.color="#000000";
            }    
        }
        console.log(daw_data);
        ang_ajax({
            url:school_background.getAttribute('action'),
            method:school_background.getAttribute('method'),
            data:data,
            success:(e)=>{
                console.log(e.target.responseText);
            } 
        });
    }
    function ang_ajax(aja){ 
        var ajax=new XMLHttpRequest;
        ajax.open(aja.method,aja.url);
        ajax.send(aja.data);
        ajax.addEventListener("load",aja.success,false); 
    }
    elem.addEventListener('click',()=>{
        res.style.display='none';
        sub.style.display='none';
    });
    sec.addEventListener('click',()=>{
        res.style.display='none';
        sub.style.display='none';
    });
    voca.addEventListener('click',()=>{
        res.style.display='none';
        sub.style.display='none';
    });
    coll.addEventListener('click',()=>{
        res.style.display='none';
        sub.style.display='none';
    });
    gradz.addEventListener('click',()=>{
        res.style.display='inline';
        sub.style.display='inline';
    });
    advoc.addEventListener("click",()=>{
        var voc_form=[
        "<div class='voc_div' name='voc_"+document.getElementsByClassName('voc_div').length+"'>"+
            ' <hr><button class="btn btn_small btn-danger" style="float:right" type="button" onclick=remove_voc('+document.getElementsByClassName('voc_div').length+')>X</button>',
            '<label>',
            'Name Of School',
            '(Write in full)',
            '</label><br>',
            '<input type="text" class="inputs" placeholder="Name Of School (Write in full)" name="voc_name_school[]">',
            '<label>',
            'Basic Educational/Degree/Course',
            '(Write in full)',
                '</label><br>',
            '<input type="text" class="inputs" placeholder="Basic Educational/Degree/Course" name="voc_degree_course[]">',
            '<label>' ,
            'Period Of Attendanc',
            '</label><br>',
            '<label style="float:left;margin-left:1%">From:</label>',
            '<label>To:</label>',
            '<br>',
            '<select type="text" class="inputs datez small" placeholder="YYYY" required name="voc_from[]"><option value="Present">--</option>'+
                    document.getElementsByClassName('datez')[0].innerHTML
                +'</select> ',
            '<select type="text" class="inputs datez small" placeholder="YYYY" required name="voc_to[]"><option value="Present">--</option>'+
                    document.getElementsByClassName('datez')[0].innerHTML
                +'</select>',
            '<label>',
            'Highest Level/ Units earned',
            '(if not graduate)',
            '</label><br>',
            '<input type="text" class="inputs" placeholder="Highest Level/ Units earned(if not graduate)"  name="voc_units_earned[]">',
            '<label>',
            'Year Graduated',

            '</label><br>',
            '<select type="text" class="inputs datez" placeholder="YYYY" name="voc_year_grad[]"><option value="Present">--</option>'+
                    document.getElementsByClassName('datez')[0].innerHTML
                +'</select>',
            '<label>',
            'Scholarship/ Academic Honors Received',
        '</label><br>',
            '<input type="text" class="inputs" placeholder="Scholarship/ Academic Honors Received" name="voc_honor[]">',   
            '<hr"></div>'
        ].join(" ");
       $('#voc').append(voc_form); 
       stripez("voc_div");
    },false);
    function stripez(level){
        var x=1;
        for(var i=0;i<document.getElementsByClassName(level).length;i++){
			 if(x%2==0){
                 document.getElementsByClassName(level)[i].style.backgroundColor="#aaaaaa";
                 
             }else{
                   document.getElementsByClassName(level)[i].style.backgroundColor="";
             }   
            x++;
		} 
    }
    
   adcollege.addEventListener("click",()=>{ 
        var col_form=[
        "<div class='col_div' name='col_"+document.getElementsByClassName('col_div').length+"'>"+
            ' <hr><button class="btn btn_small btn-danger" style="float:right" type="button" onclick=remove_col('+document.getElementsByClassName('col_div').length+')>X</button>',
            '<label>',
            'Name Of School',
            '(Write in full)',
            '</label><br>',
            '<input type="text" class="inputs" placeholder="Name Of School (Write in full)"  name="col_name_school[]">',
            '<label>',
            'Basic Educational/Degree/Course',
            '(Write in full)',
                '</label><br>',
            '<input type="text" class="inputs" placeholder="Basic Educational/Degree/Course" name="col_degree_course[]">',
            '<label>' ,
            'Period Of Attendanc',
            '</label><br>',
            '<label style="float:left;margin-left:1%">From:</label>',
            '<label>To:</label>',
            '<br>',
            '<select type="text" class="inputs datez small" placeholder="YYYY" required name="col_from[]"><option value="Present">--</option>'+
                    document.getElementsByClassName('datez')[0].innerHTML
                +'</select> ',
            '<select type="text" class="inputs datez small" placeholder="YYYY" required name="col_to[]"><option value="Present">--</option>'+
                    document.getElementsByClassName('datez')[0].innerHTML
                +'</select>',
            '<label>',
            'Highest Level/ Units earned',
            '(if not graduate)',
            '</label><br>',
            '<input type="text" class="inputs" placeholder="Highest Level/ Units earned(if not graduate)"  name="col_units_earned[]">',
            '<label>',
            'Year Graduated',

            '</label><br>',
            '<select type="text" class="inputs datez" placeholder="YYYY" name="col_year_grad[]"><option value="Present">--</option>'+
                    document.getElementsByClassName('datez')[0].innerHTML
                +'</select>',
            '<label>',
            'Scholarship/ Academic Honors Received',
        '</label><br>',
            '<input type="text" class="inputs" placeholder="Scholarship/ Academic Honors Received" name="col_honor[]">',

        '<hr"></div>'
        ].join(" ");
       $('#col').append(col_form);  
       stripez("col_div");
    },false);  
    //graduate
    
   adgrad.addEventListener("click",()=>{ 
        var grad_form=[
        "<div class='grad_div' name='grad_"+document.getElementsByClassName('grad_div').length+"'>"+
        ' <hr><button class="btn btn_small btn-danger" style="float:right" type="button" onclick=remove_grad('+document.getElementsByClassName('grad_div').length+')>X</button>',
        '<label>',
        'Name Of School',
        '(Write in full)',
        '</label><br>',
        '<input type="text" class="inputs" placeholder="Name Of School (Write in full)" name="grad_name_school[]">',
            '<label>',
            'Basic Educational/Degree/Course',
            '(Write in full)',
                '</label><br>',
            '<input type="text" class="inputs" placeholder="Basic Educational/Degree/Course" name="grad_degree_course[]">',
            '<label>' ,
            'Period Of Attendanc',
            '</label><br>',
            '<label style="float:left;margin-left:1%">From:</label>',
            '<label>To:</label>',
            '<br>',
            '<select type="text" class="inputs datez small" placeholder="YYYY" required name="grad_from[]"><option value="Present">--</option>'+
                    document.getElementsByClassName('datez')[0].innerHTML
                +'</select> ',
            '<select type="text" class="inputs datez small" placeholder="YYYY" required name="grad_to[]"><option value="Present">--</option>'+
                    document.getElementsByClassName('datez')[0].innerHTML
                +'</select>',
            '<label>',
            'Highest Level/ Units earned',
            '(if not graduate)',
            '</label><br>',
            '<input type="text" class="inputs" placeholder="Highest Level/ Units earned(if not graduate)" name="grad_units_earned[]">',
            '<label>',
            'Year Graduated',

            '</label><br>',
            '<select type="text" class="inputs datez" placeholder="YYYY" name="grad_year_grad[]"><option value="Present">--</option>'+
                    document.getElementsByClassName('datez')[0].innerHTML
                +'</select>',
            '<label>',
            'Scholarship/ Academic Honors Received',
        '</label><br>',
            '<input type="text" class="inputs" placeholder="Scholarship/ Academic Honors Received" name="grad_honor[]">',
    '<hr"></div>'
        ].join(" ");
       $('#grad_div').append(grad_form);  
       stripez("grad_div");
    },false);   
    window.onload=()=>{
        var d=new Date();
        d=d.getFullYear();
        var dates="";
        var dd=1970;
        while(d>dd){
            dates+="<option value="+d+">"+d+"</option>";
            d--; 
        }
        for (var i=0;i<document.getElementsByClassName('datez').length;i++){
            document.getElementsByClassName('datez')[i].innerHTML=dates;
        }
    }
    function remove_voc(x){ 
       for(var i=0;i<document.getElementsByClassName('voc_div').length;i++){
			if('voc_'+x==document.getElementsByClassName('voc_div')[i].getAttribute('name')){ 
				document.getElementsByClassName('voc_div')[i].remove();  
                stripez('voc_div'); 
			}	
		} 
    }
    function remove_col(x){ 
       for(var i=0;i<document.getElementsByClassName('col_div').length;i++){
			if('col_'+x==document.getElementsByClassName('col_div')[i].getAttribute('name')){ 
				document.getElementsByClassName('col_div')[i].remove();  
                stripez('col_div'); 
			}	
		} 
    }
    function remove_grad(x){ 
       for(var i=0;i<document.getElementsByClassName('grad_div').length;i++){
			if('grad_'+x==document.getElementsByClassName('grad_div')[i].getAttribute('name')){ 
				document.getElementsByClassName('grad_div')[i].remove();  
                stripez('grad_div'); 
			}	 
		} 
    }
</script>