// Collapsible
var coll = document.getElementsByClassName("collapsible");

for (let i = 0; i < coll.length; i++) {
    coll[i].addEventListener("click", function () {
        this.classList.toggle("active");

        var content = this.nextElementSibling;

        if (content.style.maxHeight) {
            content.style.maxHeight = null;
        } else {
            content.style.maxHeight = content.scrollHeight + "px";
        }

    });
}

function getTime() {
    let today = new Date();
    hours = today.getHours();
    minutes = today.getMinutes();

    if (hours < 10) {
        hours = "0" + hours;
    }

    if (minutes < 10) {
        minutes = "0" + minutes;
    }

    let time = hours + ":" + minutes;
    return time;
}

// Gets the first message
function firstBotMessage() {
    let firstMessage = "Hi, How's it going?"
    document.getElementById("botStarterMessage").innerHTML = '<p class="botText"><span>' + firstMessage + '</span></p>';

    let time = getTime();

    $("#chat-timestamp").append(time);
    document.getElementById("userInput").scrollIntoView(false);
}

function secondBotMessage() {
    let second = "Please enter the relevant number from below.";
    document.getElementById("botStarterMessage2").innerHTML = '<p class="botText"><span>' + second + '</span></p>';
}
function thirdBotMessage() {
    let third = "1. How to register as a Voter?<br>2. Facing Metamask Problems<br>3. How to change voter registration address?<br>4. Can Voter give vote after timer expires?<br>5. Facing problem in voter registrtation<br>6. Contact Admin";
    document.getElementById("botStarterMessage3").innerHTML = '<p class="botText"><span>' + third + '</span></p>';
}

firstBotMessage();
secondBotMessage();
thirdBotMessage();

// Retrieves the response
function getHardResponse(userText) {
    let botResponse = getBotResponse(userText);
    let botHtml = '<p class="botText"><span>' + botResponse + '</span></p>';
    $("#chatbox").append(botHtml);
    document.getElementById("chat-bar-bottom").scrollIntoView(true);
}

//Gets the text text from the input box and processes it
function getResponse() {
    let userText = $("#textInput").val();

    if (userText == "") {
        userText = "Blank Message";
    }
    else if (userText == '6') {
        let uname = document.getElementById('uname');
        let email = document.getElementById('email');
        let sbmt = document.getElementById('sbmt');
        let description = document.getElementById('description');
        let phone = document.getElementById('phone');

        let chaticon = document.getElementById('chat-icons');
        let textInput = document.getElementById('textInput');

        setTimeout(() => {
            uname.style.display = 'block';
            email.style.display = 'block';
            sbmt.style.display = 'block';
            description.style.display = 'block';
            phone.style.display = 'block';

            chaticon.style.display = 'none';
            textInput.style.display = 'none';
        }, 1000);
    }

    let userHtml = '<p class="userText"><span>' + userText + '</span></p>';

    $("#textInput").val("");
    $("#chatbox").append(userHtml);
    document.getElementById("chat-bar-bottom").scrollIntoView(true);

    setTimeout(() => {
        getHardResponse(userText);
    }, 700)

}

// Handles sending text via button clicks
function buttonSendText(sampleText) {
    let userHtml = '<p class="userText"><span>' + sampleText + '</span></p>';

    $("#textInput").val("");
    $("#chatbox").append(userHtml);
    document.getElementById("chat-bar-bottom").scrollIntoView(true);

    //Uncomment this if you want the bot to respond to this buttonSendText event
    setTimeout(() => {
        getHardResponse(sampleText);
    }, 700)
}

function sendButton() {
    getResponse();
}

// Press enter to send a message
$("#textInput").keypress(function (e) {
    if (e.which == 13) {
        getResponse();
    }
});