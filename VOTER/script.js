document.getElementById("vstatuscontent").style.fontWeight = "bold";
            var contract;
			web3 = new Web3(web3.currentProvider);
                contract = new web3.eth.Contract(abi,address);
				var f="Voting has ended";
				var f1="Voting is going on!!! DO VOTE";
			document.getElementById("vstatuscontent").style.fontWeight = "bold";
		document.getElementById("winnernametext").style.fontWeight = "bold";
var par=[];
let r=[];
let second = 00;
                var timer=true;
                let count = 0;

                contract.methods.votingStat().call({from: '0xCa95906d551E421E75738A9804D5054cf47f23aA'}, function(error, result){
                    document.getElementById("vstatuscontent").innerHTML=result;
                    document.getElementById("winnernametext").innerHTML=result;

					track=result;
					console.log(result);
					if(result.localeCompare(f)==0)
					{
						document.getElementById("winningmsg").style.display = "block";
				contract.methods.getWinnerNames().call({from: '0xCa95906d551E421E75738A9804D5054cf47f23aA'}, function(error, result){
					for(var i=0;i<result.length;i++)
					{
							r[i]=result[i];
					}
					if(r.length>1){
						document.getElementById("winnernametext").innerHTML+= "\nWinners Are: ";

						for(var i=1;i<r.length;i++)
					{
							if(i>1){
							document.getElementById("winnernametext").innerHTML+= " , "+r[i];
							}
							else{
								document.getElementById("winnernametext").innerHTML+=r[i];

							}
					}
				}
				else{
					document.getElementById("winnernametext").innerHTML="\n"+ r[0];
				}
					console.log(r);
					document.getElementById("winnernametext").innerHTML+=" is the winner of this election";

				});
					
					}
					else {
						if(result.localeCompare(f1)==0){
					contract.methods.partyDisplay().call({from: '0xCa95906d551E421E75738A9804D5054cf47f23aA'}, function(error, result){
							console.log(result[1]);
					
						var html="<table border='1|1'>";
				html+="<th>Party Name</th>";
				html+="<th>Voting Percentage(%)</th>";
				 var total=result[1];
				for (var i = 1; i < result[0].length; i++) {
					

    html+="<tr>";
    html+="<td>"+result[0][i].name+"</td>";
	var v=(result[0][i].totalvote/total)*100;
    html+="<td>"+v+"</td>";
	html+="</tr>";
	
				}
				html+="</table>";
document.getElementById("stat").innerHTML = html;
});
			}
						document.getElementById("winningmsg").style.display = "none";

					}
                    
					
});
contract.methods.candidateDisplay().call({from: '0xCa95906d551E421E75738A9804D5054cf47f23aA'}, function(error, result){
	if(result.length!=0){			
       if(document.getElementById("vstatuscontent").innerHTML != "Voting is going on!!! DO VOTE"){
    	document.getElementById("box2").style.fontWeight = "bold";
        document.getElementById("box2").style.fontSize = "25px";

        document.getElementById("box2").innerHTML =document.getElementById("vstatuscontent").innerHTML ;
    }
    else{
        var input = document.createElement('input');
        var button = document.createElement('button');
        input.type = 'text';
        input.id='vst1';
        input.placeholder='Enter your number';
    button.type = 'text';
    button.innerHTML = 'Get OTP';
    button.id = 'btn1';
    let session_id;
    var t1;
    button.onclick = function send() {
        console.log(document.getElementById("vst1").value);
      var b;
      b=web3.eth.getAccounts().then(function(accounts)
{
    return accounts[0];
}).then(function(tx)
{
       console.log(tx);
        contract.methods.checkVoter(document.getElementById("vst1").value).call({from:tx}, function(error, result){
       console.log(result);
       if(result){
let mobileNumber = Number(document.getElementById("vst1").value);
let url = `/api?q=${mobileNumber}`;

fetch(url)

    .then((response) => response.json())

    .then((data) => {
        alert("Verified✅ OTP send successfully");
        t5();

        if (data["Status"] == "Success") {

            session_id = data["Details"];
            console.log(data);
        }

    })

    .catch((err) => {

        alert("Error", err);

    });
}

else{
t1=false;
document.getElementById("box2").innerHTML="Not verified❌";
}

});


})

};
    document.getElementById("box2").appendChild(input);
    document.getElementById("box2").appendChild(button);
    var verified;

    function t5(){
        document.getElementById("box2").removeChild(input);
    document.getElementById("box2").removeChild(button);
            var input1 = document.createElement('input');
        var button1 = document.createElement('button');
        input1.type = 'text';
        input1.id='vst2';
        input1.placeholder='Enter your OTP';

    button1.type = 'text';
    button1.innerHTML = 'Verify';
    button1.id = 'btn2';
    document.getElementById("box2").appendChild(input1);
    document.getElementById("box2").appendChild(button1);
    button1.onclick=function verify()
        {
            let otP=Number(document.getElementById("vst2").value);
            let url = `/api?s=${session_id}&o=${otP}`;
            fetch(url)
            .then((response)=> response.json())
            .then((data)=>{
                if(data["Details"] == "OTP Matched")
                {
                   
                    console.log(data);
                    alert("OTP Matched");
                    document.getElementById("box2").removeChild(input1);
                    document.getElementById("box2").removeChild(button1);
                    t6(true);
                }
                else{
                    alert("OTP Mismatched❌");

                }
            })
            .catch((err)=> console.log(err));
            function t6(a){
            console.log(a);
        if(a){
                var html2="<table border='1|1'>";
                setTimeout(refresh,10000);
                function stopWatch() {
              
    if (timer) {
        count++;
  
        if (count == 100) {
            second++;
            count = 0;
        }
  
        if (second == 60) {
            minute++;
            second = 0;
        }
  
  

        let secString = second;
        let countString = count;
        if (second < 10) {

        document.getElementById("timer").innerHTML = 10-parseInt(secString);
        }
        else{
            document.getElementById("timer").innerHTML = "";
        }
        if(count==1){
        console.log(second);
        }
        if(second<10){
        setTimeout(stopWatch, 10);
        }
    }
}
stopWatch();
                html2+="<th>Candidate Name</th>";
				html2+="<th>Party Name</th>";
				html2+="<th>Vote</th>";
for (var i = 1; i < result.length; i++) {
	if(result[i].registered!=false){
        html2+="<tr>";
        html2+="<td>"+result[i].name+"</td>";
	    html2+="<td>"+result[i].party+"</td>";    
        html2+="<td><button id='gVo' onclick='vOte("+(i)+")'>Vote</button></td>";
        html2+="</tr>";
    }
}

html2+="</table>";
document.getElementById("box2").innerHTML = html2;

function refresh()
{
    document.getElementById("box2").innerHTML="Timeout";
}
        }

        }
    }
   
        
    }
   

}
var html = "<table border='1|1'>";
				html+="<th>Candidate Name</th>";
				html+="<th>Party Name</th>";
for (var i = 1; i < result.length; i++) {
	if(result[i].registered!=false){
    html+="<tr>";
    html+="<td>"+result[i].name+"</td>";
    html+="<td>"+result[i].party+"</td>";    
    html+="</tr>";
	}
}
html+="</table>";
document.getElementById("box").innerHTML = html;

}
					else{
	document.getElementById("box2").innerHTML = "No Candidate is registered yet";
	document.getElementById("box2").style.fontWeight = "bold";
	document.getElementById("box").innerHTML = "No Candidate is registered yet";
	document.getElementById("box").style.fontWeight = "bold";

}

				});

				

           function vOte(a)
            {

                let amt = parseInt(a);
                console.log(amt);
                web3.eth.getAccounts().then(function(accounts)
                {
                    var acc = accounts[0];
                    return contract.methods.putVote(amt).send({from:acc});
                }).then(function(tx)
                {
                    console.log(tx);
                }).catch(function(tx)
                {
                    console.log(tx);
                })
            }