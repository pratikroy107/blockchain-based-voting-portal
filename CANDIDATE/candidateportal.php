<?php

$user = 'root';
$password = '';

$database = 'vote';

$servername='localhost:3306';
$mysqli = new mysqli($servername, $user,
				$password, $database);
if ($mysqli->connect_error) {
	die('Connect Error (' .
	$mysqli->connect_errno . ') '.
	$mysqli->connect_error);
}

$mysqli->close();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="candidateportalcss.css">
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Candidate Portal</title>
        <link rel="icon" type="image/x-icon" href="favicon.png">
    </head>
    <body>
        <div class="container">

            <!--GOOGLE TRANSLATOR-->
        <div id="google_translate_element"></div>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<script type="text/javascript">
function googleTranslateElementInit() {
new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
}
</script>
<!--GOOGLE TRANSLATOR END-->

            <div class="topic">CANDIDATE PORTAL</div>
            <div class="content">
                <input type="radio" name="slider" checked id="canregis">
                <input type="radio" name="slider" id="vstatus">
                <input type="radio" name="slider" id="dcandid">
                <input type="radio" name="slider" id="vresult">

                <div class="list">
                    <label for="canregis" class="canregis">
                        <i class="fa-solid fa-right-to-bracket"></i>
                        <span class="title">Register Yourself</span>
                    </label>

                    <label for="vstatus" class="vstatus">
                        <span class="icon"><i class="fa-solid fa-wave-square"></i></span>
                        <span class="title">Voting Status</span>
                    </label>

                    <label for="dcandid" class="dcandid">
                        <span class="icon"><i class="fa-solid fa-people-group"></i></span>
                        <span class="title">Display Candidate List</span>
                    </label>

                    <label for="vresult" class="vresult">
                        <span class="icon"><i class="fa-solid fa-trophy"></i></span>
                        <span class="title">Voting Result</span>
                    </label>

                    <div class="slider"></div>
                </div>
                <div class="text-content">
                    <div class="canregis text">
                        <div class="title">REGISTER AS A CANDIDATE</div>
                        <form action="process-form.php" method="post">
                        <input type="text" id="canregname" name="name"
                            placeholder="Enter your Name: ">
						
                        <input type="text" id="canregparty" name="party"
                            placeholder="Enter your Party name: ">
                        <button id="canregsubmit">SUBMIT</button>
                        </form>
                        <br>
                    </div>
                    <div class="vstatus text">
                        <div class="title">VOTING STATUS: <span
                                id="vstatuscontent"> <b></b></span></div>
                        <br>
                        <p>Voting status refers to the current state of an
                            election, whether it is ongoing, not started, or has
                            ended. It is important to have clear and accurate
                            information about the voting status. Voters need to
                            know whether the voting process has started, is
                            ongoing, or has ended so that they can plan when and
                            where to cast their vote. Clear and accurate
                            information about the voting status ensures that
                            voters are informed and can participate in the
                            election.</p>
                    </div>
                    <div class="dcandid text">
                        <div class="title">CANDIDATE'S LIST</div>
                        <section id="box">
	</section>
                    </div>

                    <div class="vresult text">
                        <div class="title">VOTING RESULT</div>
                        <p id="winnernametext">Winner Name : <span
                                id="winnername"><b>ussssss</b></span>🎉</p>
                        <br><section id="stat"></section>
                        <p id="winningmsg"><b>Congratulations</b> on winning the election! It's
                            a great
                            accomplishment and a true testament to your hard
                            work and dedication.<br>
                            Your victory is not only a triumph for you, but for
                            everyone who has supported you throughout the
                            campaign. It's a moment to celebrate, to reflect on
                            your journey, and to look forward to the future.
                            <br>
                            We wish you all the best as you begin this new
                            chapter in your life. Congratulations once again,
                            and we look forward to seeing all that you will
                            accomplish in the years to come.</p>

                    </div>
                </div>
            </div>
        </div>
        <script src="
            https://cdn.jsdelivr.net/gh/ethereum/web3.js@1.0.0-beta.36/dist/web3.min.js
            ">
        </script>
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            crossorigin="anonymous">
        </script>
		<script src="../VOTER/static/script2.js"></script>

        <script>
		document.getElementById("vstatuscontent").style.fontWeight = "bold";
		document.getElementById("winnernametext").style.fontWeight = "bold";
        var contract;
			web3 = new Web3(web3.currentProvider);
                //var address = "0xc88350D048BfC5B4cf7c6bfea90e9de37B5Cedf8";
                //var abi = ;
var f="Voting has ended";
var f1="Voting is going on!!! DO VOTE";

                contract = new web3.eth.Contract(abi,address);
var r=[];
var par=[];

            contract.methods.candidateDisplay().call({from: '0xcf7350A681D1fFDEAaaF1F72Dd849de0c8a4D1e4'}, function(error, result){
			if(result.length!=0){
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
					console.log(result[0].name);
}
					else{
	document.getElementById("box").innerHTML = "No Candidate is registered yet";
	document.getElementById("box").style.fontWeight = "bold";

}
				});

                contract.methods.votingStat().call({from: '0xcf7350A681D1fFDEAaaF1F72Dd849de0c8a4D1e4'}, function(error, result){
                    document.getElementById("vstatuscontent").innerHTML=result;
                    document.getElementById("winnernametext").innerHTML=result;
					track=result;
					console.log(result);
					if(result.localeCompare(f)==0)
					{
						document.getElementById("winningmsg").style.display = "block";
						contract.methods.getWinnerNames().call({from: '0xcf7350A681D1fFDEAaaF1F72Dd849de0c8a4D1e4'}, function(error, result){
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
					document.getElementById("winnernametext").innerHTML="\n"+r[0];
					console.log(r);
					document.getElementById("winnernametext").innerHTML+=" is the winner of this election";
				}

				});
					
					}
					else {
						if(result.localeCompare(f1)==0){
					contract.methods.partyDisplay().call({from: '0xcf7350A681D1fFDEAaaF1F72Dd849de0c8a4D1e4'}, function(error, result){
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
</script>
    </body>
</html>
