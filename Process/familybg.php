<style>
    #childdiv{
	margin-top:10px;
	width:100%;
	height:253px;
	box-shadow:0px 0px 1px black;
	overflow-y:auto;
}
.child_table{
	width:100%;
	border-style:solid;
	border-width:1px;
	border-collapse:collapse;
}
.child_table th{
	border-style:solid;
	border-width:0.07em;
} 
</style>
<form id="child_submit" action="../employee-famBG-proc.php" method="post">
    <div style="" id="row1">
        <div class="left"> 
            <label class="labels">Spouse Profile: </label><br>
            <input type="text" class="inputs small inp" placeholder="Surname" required name="ssurname">
            <input type="text" class="inputs small inp" placeholder="First name" required name="sfname">
            <input type="text" class="inputs small inp" placeholder="Last name" required name="smname">
            <input type="text" class="inputs small inp" placeholder="Occupation" required name="soccu">
            <input type="text" class="inputs small inp" placeholder="Employer/Business name" required name="semp">
            <input type="text" class="inputs small inp" placeholder="extension" required name="spextension">
            <input type="text" class="inputs small inp" placeholder="Business address" required name="sb_ad">
            <input type="text" class="inputs small inp" placeholder="Telephone No." required name=stel>
			 			
            <label class="labels">Father Profile: </label><br>
            <input type="text" class="inputs small inp" placeholder="Surname" required name="fsurname">
            <input type="text" class="inputs small inp" placeholder="First name" required name="ffname">
            <input type="text" class="inputs small" placeholder="Last name" required name="flname">
            <input type="text" class="inputs small inp" placeholder="extension" required name="sfextension">
            <br>
            <label class="labels">Mother Profile: </label><br>
            <input type="text" class="inputs small inp" placeholder="Surname" required name="msurname">
            <input type="text" class="inputs small inp" placeholder="First name" required name="mfname">
            <input type="text" class="inputs inp small" placeholder="Last name" required name="mlastname">
            <input type="text" class="inputs small inp" placeholder="extension" required name="smextension">
						
        </div>
		  		   
				   <div class="right">
                       <button class="btn btn_small" style="float:right" type="button" id="plus_children">+</button>
						  <br>
                       <label class="labels">Children:(<span id="child_num">0</span>)</label><br>
                       <div id="childdiv">
                           <table class='child_table'>
                                <thead>
                                    <tr>
                                        <th>
                                            Fullname<span style="color:gray;font-size:0.8em">(Lastname, Firstname MI.)   </span>
										</th>
                                        <th>
											Date Of Birth
										</th>
										<th>
                                            action
										</th>
                                    </tr>
                               </thead>
                               <tbody id="child_tbod">
                               </tbody>
                           </table>
                       </div> 
                       <hr>
                       <center>
                           <input type="button" class="btn btn-danger" value="Reset">
                           <input type="submit" class="btn btn-primary" value="Submit">
                       </center>
		  				
        </div>
    </div>
</form>
<script>
var num=0;
	plus_children.addEventListener("click",()=>{
		var data=
			"<tr class='daw_tr' name='b"+document.getElementsByClassName('daw_tr').length+"'>"+
			"<td><input type='text' class='inputs' placeholder='Fullname' name='child_fullname[]' required></td>"+
			"<td><input type='date' class='inputs' name='child_dob[]' required></td>"+
			"<td><button class='btn btn_supersmall bgdanger' style='float:right' type='button' onclick='remove_child("+document.getElementsByClassName('daw_tr').length+")'>X</button></td>"+
			"</tr>";
			 
		child_tbod.innerHTML+=data;
		num++;
        child_num.innerHTML=num;
	},false);
	function remove_child(x){
		for(var i=0;i<document.getElementsByClassName('daw_tr').length;i++){
			if('b'+x==document.getElementsByClassName('daw_tr')[i].getAttribute('name')){ 
				document.getElementsByClassName('daw_tr')[i].remove();
                num--;
                child_num.innerHTML=num;
			}	
		} 
	} 
    child_submit.onsubmit=(e)=>{
        e.preventDefault();
        var data=new FormData();
        var daw_data="";
        for(var i=0;i<child_submit.getElementsByClassName('inputs').length;i++){ 
            data.append(child_submit.getElementsByClassName('inputs')[i].getAttribute("name"),
                        child_submit.getElementsByClassName('inputs')[i].value);
            if(i%2==0){
                daw_data+="\n";
            }
            daw_data+="$_POST['"+child_submit.getElementsByClassName('inputs')[i].getAttribute("name")+"'];";
            }
                ang_ajax({
                    url:child_submit.getAttribute('action'),
                    method:child_submit.getAttribute('method'),
                    data:data,
                    success:(e)=>{
                        alert(e.target.responseText);
                    } 
                }); 
                
    } 
    function ang_ajax(aja){ 
        var ajax=new XMLHttpRequest;
        ajax.open(aja.method,aja.url);
        ajax.send(aja.data);
        ajax.addEventListener("load",aja.success,false); 
    }
</script>