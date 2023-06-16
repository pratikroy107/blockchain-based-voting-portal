<!DOCTYPE html>
<html>
  
<head>
    <title>
        Review
    </title>
    <link rel="icon" type="image/x-icon" href="favicon.png">
</head>
  
<body style="text-align:center;">
      
    <h1 style="color:green;">Edited</h1>
    <button style="background-color:light-grey; padding:10px 20px; border-radius:6px;">
		<a style="color:black; font-size:16px; text-decoration:none;"
		href="http://localhost/Final%20Voting/dapp/ADMIN/adminportal.php">Go Back
	</a>
	</button>
      
<?php

$a= $_POST["a"];
$b= $_POST["b"];
$host = "localhost";
$dbname = "vote"; 
$username = "root"; 
$password = ""; 

$conn = mysqli_connect(hostname: $host, username: $username, password: $password, database: $dbname);



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

    let amt="<?php echo"$b"?>";
    let add="<?php echo"$a"?>";
if(amt=="true")
{
 amt=1;
}
else{
    amt=0;
}
console.log(amt);
web3 = new Web3(web3.currentProvider);
//var address = "0x3EF71fC086EA47Aca3aee1916aC5B2DCdDA9507C";
//var abi = ;
contract = new web3.eth.Contract(abi,address);
web3.eth.getAccounts().then(function(accounts)
{
    var acc = accounts[0];
    return contract.methods.reviewVoter(add,Boolean(amt)).send({from:acc});
}).then(function(tx)
{
    console.log(tx);
}).catch(function(tx)
{
    console.log(tx);
})
 </script>

</body>
  
</html>

