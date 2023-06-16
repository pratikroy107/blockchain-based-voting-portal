<!DOCTYPE html>
<html>
  
<head>
    <title>
        Token Send Portal
    </title>
    <link rel="icon" type="image/x-icon" href="favicon.png">
</head>
  
<body style="text-align:center;">
      
    <h1 id="success" style="color:green;"></h1>
    <button style="background-color:light-grey; padding:10px 20px; border-radius:6px;">
		<a style="color:black; font-size:16px; text-decoration:none;"
		href="http://localhost/Final%20Voting/dapp/ADMIN/adminportal.php">Go Back
	</a>
	</button>
     
<?php

$h= $_POST["hash"];
$a= $_POST["amt"];


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

    let hash="<?php echo "$h"?>";
	let amt="<?php echo "$a"?>";
web3 = new Web3(web3.currentProvider);

contract = new web3.eth.Contract(abi,address);
web3.eth.getAccounts().then(function(accounts)
{
    var acc = accounts[0];
    return contract.methods.mint(hash,amt).send({from:acc});
}).then(function(tx)
{
    document.getElementById("success").innerHTML="Token Sent Successfully✅";
    console.log(tx);
}).catch(function(tx)
{
    document.getElementById("success").innerHTML="Token Sent Unsuccessful❌";
    console.log(tx);
})

 </script>

</body>
  
</html>

