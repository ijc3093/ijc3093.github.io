var body;
// Check for modern day browsers
function Browser() {
    // Redirect to FireFox download page
    if (!document.getElementById) {
        alert("Please install a modern browser. This page does not support your current browser. You will be redirected...");
        window.location = "https://www.mozilla.org/en-US/firefox/";
    }
    // Proceed to get data.json to load the page
    else {
        init();
    }
}


// Sets global variables, and first dropdown
function init() {
    body = document.getElementsByTagName('body')[0];
    createBody("init"); //Main (Display) for html
}

var attempt = 3; // Variable to count number of attempts.
// Below function Executes on click of login button.
function validate(){
var username = document.getElementById("username").value;
var password = document.getElementById("password").value;

    if ( username == "UsernameGet" && password == "PasswordGet"){
    alert ("Login successfully");
    window.location = "TestProjectOne/index.html"; // Redirecting to other page.
    return false;
    }
        else{
        //CONSOLE.LOG("USERNAME: " + username);
        attempt --;// Decrementing by one.
        alert("You have left "+attempt+" attempt;");
        // Disabling fields after 3 attempts.
            if( attempt == 0){
            document.getElementById("username").disabled = true;
            document.getElementById("password").disabled = true;
            document.getElementById("submit").disabled = true;
            return false;
            }
        }
}

function createBody(){
    
    var div = document.createElement("div");
    div.class = "container";
    // Create form
    var form = document.createElement("form");
    form.id = "form_id";
    form.method = "post";
    form.name = "myform";
    
    //Valid
    var span = document.createElement("span");
    var b = document.createElement("b");
    b.class = "note";
    b.class = "valid";
    var userPassAppendText = document.createTextNode("Username: UsernameGet and Password: PasswordGet ");
    var userPassAppend = document.createElement("p");
    userPassAppend.appendChild(userPassAppendText);
    userPassAppend.appendChild(b);
    form.appendChild(userPassAppend);
    div.appendChild(form);
    
    var username = document.createElement("input");
    username.id = "username";
    username.type ="text";
    username.name ="username";
    var usernameAppend = document.createElement("p");
    var usernameAppendText = document.createTextNode("Username:");
    usernameAppend.appendChild(usernameAppendText);
    usernameAppend.appendChild(username);
    form.appendChild(usernameAppend);
    div.appendChild(form);
    
    
    // Create inputs for fname
    var password = document.createElement("input");
    password.id = "password";
    password.type = "password";
    password.name = "password";
    // Append inputs to form
    var PasswordAppend = document.createElement("p");
    var PasswordInputText = document.createTextNode("Password: ");
    PasswordAppend.appendChild(PasswordInputText);
    PasswordAppend.appendChild(password);
    form.appendChild(PasswordAppend);
    div.appendChild(form);
    
    // Create button submitt
    var submit = document.createElement("input");
    submit.id = "submit";
    submit.value = "Login";
    submit.type = "button";
    submit.setAttribute("onclick","validate()");
    form.appendChild(submit);
    div.appendChild(form);
    
    //Main (Display) for html
    body.appendChild(div);
}

