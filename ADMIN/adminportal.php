<?php

// Username is root
$user = 'root';
$password = '';

// Database name is geeksforgeeks
$database = 'vote';

// Server is localhost with
// port number 3306
$servername='localhost:3306';
$mysqli = new mysqli($servername, $user,
				$password, $database);

// Checking for connections
if ($mysqli->connect_error) {
	die('Connect Error (' .
	$mysqli->connect_errno . ') '.
	$mysqli->connect_error);
}

// SQL query to select data from database
//$sql1 = " SELECT * FROM candidateregistration";
//$sql2 = " SELECT * FROM voterregistration";

//$result1 = $mysqli->query($sql1);
//$result2 = $mysqli->query($sql2);
$mysqli->close();
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="adminportalcss.css">
        <link rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Portal</title>
        <link rel="icon" type="image/x-icon" href="favicon.png">
    </head>
    <style>
        
table {
    font-size: large;
    border: 1px solid black;
}

td {
    background-color: #dad3f8;
    border: 1px solid black;
}

th,td {
    font-weight: bold;
    border: 1px solid black;
    padding: 10px;
    text-align: center;
}
td {
    font-weight: lighter;
}

        </style>
    <body>
        <div class="container">
            <div class="topic">ADMIN PORTAL</div>
            <div class="content">
        
            <!--GOOGLE TRANSLATOR-->
        <div id="google_translate_element"></div>

<script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<script type="text/javascript">
function googleTranslateElementInit() {
new google.translate.TranslateElement({pageLanguage: 'en'}, 'google_translate_element');
}
</script>
<!--GOOGLE TRANSLATOR END-->

                <input type="radio" name="slider" checked id="svote">
                <input type="radio" name="slider" id="vstatus">
                <input type="radio" name="slider" id="dcandid">
                <input type="radio" name="slider" id="dvoter">
                <input type="radio" name="slider" id="vresult">
                <input type="radio" name="slider" id="editcandid">
                <input type="radio" name="slider" id="editvoter">
                <input type="radio" name="slider" id="cregister">
                <input type="radio" name="slider" id="demographic">
                <input type="radio" name="slider" id="sendtoken">
                <div class="list">
                    <label for="svote" class="svote">
                        <i class="fa-solid fa-circle-play"></i>
                        <span class="title">Start/Stop Vote</span>
                    </label>

                    <label for="vstatus" class="vstatus">
                        <span class="icon"><i class="fa-solid fa-wave-square"></i></span>
                        <span class="title">Voting Status</span>
                    </label>

                    <label for="dcandid" class="dcandid">
                        <span class="icon"><i class="fa-solid fa-people-group"></i></span>
                        <span class="title">Display Candidate List</span>
                    </label>

                    <label for="dvoter" class="dvoter">
                        <span class="icon"><i class="fa-solid fa-people-line"></i></span>
                        <span class="title">Display Voter List</span>
                    </label>

                    <label for="vresult" class="vresult">
                        <span class="icon"><i class="fa-solid fa-trophy"></i></span>
                        <span class="title">Voting Result</span>
                    </label>

                    <label for="editcandid" class="editcandid">
                        <span class="icon"><i class="fa-solid
                                fa-rectangle-list"></i></span>
                        <span class="title">Edit Candidate List</span>
                    </label>

                    <label for="editvoter" class="editvoter">
                        <span class="icon"><i class="fa-solid
                                fa-users-rectangle"></i></span>
                        <span class="title">Edit Voter List</span>
                    </label>

                    <label for="cregister" class="cregister">
                        <span class="icon"><i class="fa-solid
                                fa-flag-checkered"></i></span>
                        <span class="title">Complete Registration</span>
                    </label>

                    <label for="demographic" class="demographic">
                        <span class="icon"><i class="fa-solid fa-earth-americas"></i></span>
                        <span class="title">Demographics</span>
                    </label>

                    <label for="sendtoken" class="sendtoken">
                        <span class="icon"><i class="fa-solid fa-ticket"></i></span>
                        <span class="title">Send Token</span>
                    </label>

                    <div class="slider"></div>
                </div>
                <div class="text-content">
                    <div class="svote text">
                        <div class="title">START/STOP VOTE</div>
                        <br>
						
                        <button class="startvotebutton" onclick="startVote()">Start Vote</button>
                        <button class="stopvotebutton" onclick="stopVote()">Stop Vote</button>
                        <br><br>
                        <p>Start and stop voting, also known as opening and
                            closing the polls, refers to the beginning and end
                            of the voting process in an election. This process
                            is crucial for ensuring fair and accurate results.
                            Some reasons why start and stop voting is needed are
                            that if the polls are not opened and closed at
                            specific times, some voters may be able to vote
                            before or after the official voting period. This
                            could lead to unfair advantages for certain
                            candidates or even voter fraud. With a set start and
                            stop time, election officials can accurately record
                            the number of votes cast and ensure that all ballots
                            are counted. This helps to prevent errors or
                            discrepancies in the vote count. Having a set start
                            and stop time helps to increase transparency in the
                            voting process. By making the voting period clear
                            and public, voters can be confident that the
                            election is being conducted fairly.</p>
                    </div>
                    <div class="vstatus text">
                        <div class="title">VOTING STATUS: <span
                                id="vstatuscontent"></span></div>
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
                            election. By knowing the voting status, election
                            officials and political campaigns can encourage
                            voter turnout. If the voting process has not yet
                            started, they can encourage voters to register and
                            prepare to vote. Having clear and accurate
                            information about the voting status helps to
                            increase transparency in the election process. By
                            providing updates on the voting status, election
                            officials can reassure the public that the election
                            is being conducted fairly and that all votes will be
                            counted.</p>
                    </div>
                    <div class="dcandid text">
                        <div class="title">CANDIDATE'S LIST</div>
                        <section id="box">
		
	</section>
                    </div>
                    <div class="dvoter text">
                        <div class="title">VOTER'S LIST</div>
                        
                        <section id="box2">
	
	</section>
                    </div>
                    <div class="vresult text">
                        <div class="title">VOTING RESULT</div>
                        <p id="winnernametext">Winner Name : <br><span
                                id="winnername"><b>ussssss</b></span>🎉</p>
                        <br>
						<section id="stat"></section>
                        <p id="winningmsg"><b>Congratulations</b> on winning the election! It's
                            a great
                            accomplishment and a true testament to your hard
                            work and dedication.<br>
                            Your victory is not only a triumph for you, but for
                            everyone who has supported you throughout the
                            campaign. It's a moment to celebrate, to reflect on
                            your journey, and to look forward to the future.
                            As you take on your new role, we have no doubt that
                            you will continue to demonstrate the same commitment
                            and passion that brought you here. Your leadership
                            will be a source of inspiration for many, and we are
                            confident that you will make a positive impact on
                            those around you.<br>
                            We wish you all the best as you begin this new
                            chapter in your life. Congratulations once again,
                            and we look forward to seeing all that you will
                            accomplish in the years to come.</p>

                    </div>
                    <div class="editcandid text">
                        <div class="title">EDIT CANDIDATE LIST</div>
                        <br>
                        <form action="process.php" method="post">
                            <input type="text" id="candidatecode" name="a"
                                placeholder="Enter hashcode of Candidate">
                            <input type="text" id="candidatebool" name="b"
                            placeholder="Write 'true' for Add/ 'false' for Remove">
                            <button id="editcandidatesubmit">SUBMIT</button>
                            <br>
                        </form>
                    </div>
                    <div class="editvoter text">
                        <div class="title">EDIT VOTER LIST</div>
                        <br>
                        <form action="process2.php" method="post">
                            <input type="text" id="votercode" name="a"
                            placeholder="Enter hashcode of Voter">
                            <input type="text" id="voterbool" name="b"
                            placeholder="Write 'true' for Add/ 'false' for Remove">
                            <button id="editvotersubmit">SUBMIT</button>
                            <br>
                        </form>
                    </div>
                    <div class="cregister text">
                        <div class="title">COMPLETE REGISTRATION</div>
                        <br>
                        <button class="completereg" onclick="stopReg()">Stop Registration Process</button>
                        <br><br>
                        <p>Registering for an election is a crucial step in
                            exercising your right to vote and ensuring that your
                            voice is heard in the democratic process. In many
                            countries, registering to vote is a legal
                            requirement. Failure to do so may result in fines or
                            other penalties. By registering to vote, you can
                            ensure that you meet all the eligibility
                            requirements to participate in the election. Without
                            registering to
                            vote, you will not be able to cast your vote in the
                            upcoming election.
                            <br>
                            In summary, registering to vote is necessary to
                            ensure that you are eligible to vote, that your vote
                            is counted, and that the democratic process is
                            conducted fairly and transparently. By registering
                            to vote, you are taking an active role in shaping
                            the future of your community and your country.</p>
                    </div>
                    <div class="demographic text">
                        <div class="title">DEMOGRAPHICS DETAILS</div>
                        <section id="stat2"></section>
                        <button id="demogr" onclick="showDemoStat()">Show Demographic Details</button>
                    </div>
                    <div class="sendtoken text">
                        <div class="title">SEND TOKENS TO CANDIDATES
                            <br><br>
                            <form action="process3.php" method="post">
                            <input type="text" id="tokencode"
                            placeholder="Enter hashcode of Candidate" name="hash">
                            <input type="text" id="tokenbool"
                            placeholder="Enter amount of Tokens" name="amt">
                            <button id="tokensubmit">SUBMIT</button>
                            </form>

                            <br>
                        </div>

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
            var contract;
            web3 = new Web3(web3.currentProvider);
            //var abi= ;
            //var address = "0x3EF71fC086EA47Aca3aee1916aC5B2DCdDA9507C";
            contract = new web3.eth.Contract(abi,address);
			var f="Voting has ended";
			var f1="Voting is going on!!! DO VOTE";

			document.getElementById("vstatuscontent").style.fontWeight = "bold";
		document.getElementById("winnernametext").style.fontWeight = "bold";
			var r=[];
var par=[];
contract.methods.voterDisplay().call({from: '0xCa95906d551E421E75738A9804D5054cf47f23aA' }, function(error, result)
	{
        if(result.length!=0){
	var html = "<table border='1|1'>";
				var html2;
				html+="<th>Voter Name</th>";
				html+="<th>HashCode</th>";
				html+="<th>Registered</th>";
for (var i = 1; i < result.length; i++) {
	

    html+="<tr>";
    html+="<td>"+result[i].name+"</td>";
    html+="<td>"+result[i].voterAddress+"</td>";   
    html+="<td>"+result[i].registered+"</td>"; 
    html+="</tr>";
	
}
html+="</table>";
document.getElementById("box2").innerHTML = html;
					console.log(result[0].name);
}
else{
	document.getElementById("box2").innerHTML = "No Voter is registered yet";
	document.getElementById("box2").style.fontWeight = "bold";

}
				});




contract.methods.candidateDisplay().call({from: '0xCa95906d551E421E75738A9804D5054cf47f23aA'}, function(error, result){
	if(result.length!=0){
		
	var html = "<table border='1|1'>";
				var html2;
				html+="<th>Candidate Name</th>";
				html+="<th>Party Name</th>";
				html+="<th>HashCode</th>";
                html+="<th>Registered</th>";

for (var i = 1; i < result.length; i++) {
	
    html+="<tr>";
    html+="<td>"+result[i].name+"</td>";
    html+="<td>"+result[i].party+"</td>";    
    html+="<td>"+result[i].candidateAddress+"</td>";  
    html+="<td>"+result[i].registered+"</td>";
    html+="</tr>";
	
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

                contract.methods.votingStat().call({from: '0xCa95906d551E421E75738A9804D5054cf47f23aA'}, function(error, result){
                    document.getElementById("vstatuscontent").innerHTML=result;
                    document.getElementById("winnernametext").innerHTML=result;
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
					document.getElementById("winnernametext").innerHTML= "\n"+r[0];
					console.log(r);
					document.getElementById("winnernametext").innerHTML+=" is the winner of this election";
				}

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

            function stopVote()
            {
                web3.eth.getAccounts().then(function(accounts)
                {
                    var acc = accounts[0];
                    return contract.methods.stopVoting().send({from:acc});
                }).then(function(tx)
                {
                    console.log(tx);
                }).catch(function(tx)
                {
                    console.log(tx);
                })
            }

            function showDemoStat()
            {
                web3.eth.getAccounts().then(function(accounts)
{
    return accounts[0];
}).then(function(tx)
{
    var b2=true;
                contract.methods.stateWiseVotingPercentage().call({from:tx}, function(error, result){
                    document.getElementById("demogr").style.display = "none";
                    b2=false;
                console.log(result);
						var html="<table border='1|1'>";
				html+="<th>State Name</th>";
				html+="<th>Voting Percentage(%)</th>";
				for (var i = 1; i < result.length; i++) {
    html+="<tr>";
    html+="<td>"+result[i]['name']+"</td>";
    html+="<td>"+result[i]['votingpercentage']+"</td>";
	html+="</tr>";
				}
				html+="</table>";
document.getElementById("stat2").innerHTML = html;
                
                }); 

                if(b2)
                {
                    document.getElementById("stat2").innerHTML = "You are not authorized to do it";
                    document.getElementById("stat2").style.fontWeight = "bold";
                }
            })

            }

            function startVote()
            {
                web3.eth.getAccounts().then(function(accounts)
                {
                    var acc = accounts[0];
                    return contract.methods.startVoting().send({from:acc});
                }).then(function(tx)
                {
                    console.log(tx);
                }).catch(function(tx)
                {
                    console.log(tx);
                })
            }

           function stopReg()
            {
                web3.eth.getAccounts().then(function(accounts)
                {
                    var acc = accounts[0];
                    return contract.methods.registrationCompleted().send({from:acc});
                }).then(function(tx)
                {
                    console.log(tx);
                }).catch(function(tx)
                {
                    console.log(tx);
                })
            }
           
            
        </script>
    </body>
</html>
