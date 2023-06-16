<!DOCTYPE html>
<html>
  
<head>
    <title>
        Candidate Registration
    </title>
	<link rel="icon" type="image/x-icon" href="favicon.png">
</head>
  
<body style="text-align:center;">
      
    <h1 id="success" style="color:green;"></h1>
	<button style="background-color:light-grey; padding:10px 20px; border-radius:6px;">
		<a style="color:black; font-size:16px; text-decoration:none;"
		href="http://localhost/Final%20Voting/DAPP/CANDIDATE/candidateportal.php">Go Back
	</a>
	</button>
<?php

$par = $_POST["party"];
$n = $_POST["name"];


$name = "Hello";

?>
<script src="
https://cdn.jsdelivr.net/gh/ethereum/web3.js@1.0.0-beta.36/dist/web3.min.js
">
</script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
crossorigin="anonymous">
</script>
<script src="../VOTER/static/script2.js"></script>
<script type="text/JavaScript"> 

var contract;
var bool="<?php echo"$name"?>";
console.log(bool);
if(bool=="Hello"){
	let name="<?php echo"$n"?>";
	let pn="<?php echo"$par"?>";
web3 = new Web3(web3.currentProvider);
//var address = "0x48F426DA259268DF1959DdD841c626Ce81e588F2";
//var abi = ;
contract = new web3.eth.Contract(abi,address);
web3.eth.getAccounts().then(function(accounts)
{
    var acc = accounts[0];
    return contract.methods.registerCandidate(name,pn).send({from:acc});
}).then(function(tx)
{
	document.getElementById("success").innerHTML="Candidate Registered Successfully";

    console.log(tx);
	
}).catch(function(tx)
{
	document.getElementById("success").innerHTML="Transaction Failure in Metamask";

    console.log(tx);
})
}
else
{
	document.getElementById("success").innerHTML="Transaction Failure in Metamask";
    console.log("Bye");
	
}
 </script>

</body>
  
</html>

