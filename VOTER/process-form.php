<!DOCTYPE html>
<html>
  
<head>
    <title>
        Voter Registration
    </title>
</head>

<body style="text-align:center;">

    <h1 id="success" style="color:green;"></h1>
	<button style="background-color:light-grey; padding:10px 20px; border-radius:6px;">
		<a style="color:black; font-size:16px; text-decoration:none;"
		href="http://localhost:5000">Go Back
	</a>
	</button>
<?php
$adhar = $_POST["an"];
$von= $_POST["vn"];
$n = $_POST["name"];
$b="true";

$host = "localhost";
$dbname = "vote"; 
$username = "root"; 
$password = ""; 

$conn = mysqli_connect(hostname: $host, username: $username, password: $password, database: $dbname);

if (mysqli_connect_errno()) {
    die("Connection error: " . mysqli_connect_error());
}
$sql1 = "SELECT * FROM voters where adhaarno='$adhar' and votern='$von' and voters.Name='$n'";

$result = $conn->query($sql1);

if ($result->num_rows > 0) {

    while($row = $result->fetch_assoc()) {
        $cn=$row["Contactno"];
        $st=$row["State"];
     }
$name = "Hello";
}
else{
	$name="Bye";
}
?>
<script src="
https://cdn.jsdelivr.net/gh/ethereum/web3.js@1.0.0-beta.36/dist/web3.min.js
">
</script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
crossorigin="anonymous">
</script>
<script src="./static/script2.js"></script>

<script type="text/JavaScript"> 

var contract;
var bool="<?php echo"$name"?>";
console.log(bool);
if(bool=="Hello"){

var n="<?php echo"$n"?>";
var vn="<?php echo"$von"?>";
var an="<?php echo"$adhar"?>";
var st="<?php echo"$st"?>";
var cn="<?php echo"$cn"?>";
web3 = new Web3(web3.currentProvider);

contract = new web3.eth.Contract(abi,address);
web3.eth.getAccounts().then(function(accounts)
{
    var acc = accounts[0];
    return contract.methods.registerVoter(n,vn,an,cn,st).send({from:acc});
}).then(function(tx)
{
	document.getElementById("success").innerHTML="Voter Registered";
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
