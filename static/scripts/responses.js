function getBotResponse(input) {

    if (input == "1") {
        return "<b>Methods to register as a voter:</b><br>1. Open your metamask account<br>2. It must contain some ethers for gas fees.<br>3. Go to the Voter Portal.<br>4. Click REGISTER YOURSELF section.<br>5. Enter your name as per Aadhaar Card(Case Sensitive)<br>6. Enter your voter no. & aadhaar no.<br>7. Click on SUBMIT button & you are good to go :)";
    }
    else if (input == "2") {
        return "<b>Possible Metmask Problems:</b><br>1. Enter your private key properly<br>2. Enter the correct password<br>3. Connect Metmask wallet with current website";
    }
    else if (input == "3") {
        return "Changing voter registration address is <b>not allowed</b>. But if it is necessary, contact with admin";
    }
    else if (input == "4") {
        return "<b>Absolutely Yes!</b> Repeat the OTP verification process and the GIVE Vote PORTAL will open again";
    }
    else if (input == "5") {
        return "<b>Possible Voter Registration Issues:</b><br>1. Maybe you are not above 18.<br>2. Maybe there is not enough gas fees.";
    }
    else if (input == "6") {
        return "<b>Please Provide relevant details below.</b>";
    }
    else if (input == "hi") {
        return "hello :)";
    }
    else if (input == "hello") {
        return "hi there!";
    }
    else if (input == "bye") {
        return "have a great day";
    }
    else if (input == "what is your name") {
        return "i am mr. chatbot";
    }
    else if (input == "who are you") {
        return "i am mr. chatbot";
    }
    else if (input == "can you help me") {
        return "sure. please select the relevant options from above.";
    }
    else if (input == "help") {
        return "sure. please select the relevant options from above.";
    }
    else {
        return "Sorry, cannot undertand!";
    }
}