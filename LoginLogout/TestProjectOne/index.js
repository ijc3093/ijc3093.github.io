// Global variables
var json; // Points to the json data fetched from ajax call
var userHistory; // Keeps track of the values selected on selects
var body; // Holds the body of dom

var radioValue = 0;
var checkboxValue = 0;
var optionValue = 0;
var carPrice = 0;

//New Car Amount
var newCarAmounts = [
    //Ford
    ["2001--Mustang", 10999.99],
    ["2005--Mustang", 15999.99],
    ["2010--Mustang", 17999.99],
    ["2015--Mustang", 19999.99],
    ["2018--Mustang", 25099.99],
    
    ["2001--Shelby", 15000],
    ["2005--Shelby", 30000],
    ["2010--Shelby", 35000],
    ["2015--Shelby", 80000],
    ["2018--Shelby", 100000],
    
    //Dodge
    ["2008--Challenger", 10999],
    ["2014--Challenger", 19099],
    ["2015--Challenger", 25999],
    
    ["2008--Charger", 7099],
    ["2014--Charger", 19999],
    ["2015--Charger", 23449],
    
    ["2003--Viper", 28999],
    ["2019--Viper", 150999],
    
    //Chevrotte
    ["2010--Camaro", 14499],
    ["2012--Camaro", 19000],
    ["2014--Camaro", 24000],
    ["2018--Camaro", 30000],
    
    ["2005--Corvette", 29000],
    ["2017--Corvette", 145999],
    
    //Motorcycle
    ["2020Street", 17999],
    ["Newron", 16000],
    ["Harley-Davidson", 17999],
    
    ["Novus", 13000],
    ["Tarus", 13499],
    ["Taeform", 13999],
    
    ["CVO", 18999],
    ["Chopper", 17999],
    ["Nash", 14999],
    
    //Truck
    ["2018--Ram", 20999],
    ["2012--Recalls", 23999],
    ["2019--Hennessey", 29999],
    ["2019--ChevySilverado", 25999],
    
    ["2008--TruckFord", 7999],
    ["2010--TruckFord", 11999],
    ["2017--TruckFord", 18999],
    ["2018--TruckFord", 20999]
];

//Used Car Amount
var usedCarAmounts = [
    
    //Ford
    ["2001--Mustang", 8999.99],
    ["2005--Mustang", 13999.99],
    ["2010--Mustang", 16999.99],
    ["2015--Mustang", 17999.99],
    ["2018--Mustang", 18099.99],
    
    ["2001--Shelby", 10000],
    ["2005--Shelby", 25000],
    ["2010--Shelby", 27000],
    ["2015--Shelby", 29000],
    ["2018--Shelby", 31000],
    
    //Dodge
    ["2008--Challenger", 8999],
    ["2014--Challenger", 18099],
    ["2015--Challenger", 16999],
    
    ["2008--Charger", 5099],
    ["2014--Charger", 14999],
    ["2015--Charger", 16449],
    
    ["2003--Viper", 23999],
    ["2019--Viper", 100999],
    
    //Chevrotte
    ["2010--Camaro", 9999],
    ["2012--Camaro", 15000],
    ["2014--Camaro", 17000],
    ["2018--Camaro", 20000],
    
    ["2005--Corvette", 10000],
    ["2017--Corvette", 90999],
    
    //Motorcycle
    ["2020Street", 9999],
    ["Newron", 15000],
    ["Harley-Davidson", 17000],
    
    ["Novus", 10000],
    ["Tarus", 11999],
    ["Taeform", 12999],
    
    ["CVO", 90999],
    ["Chopper", 90999],
    ["Nash", 90999],
    
    //Truck
    ["2018--Ram", 18999],
    ["2012--Recalls", 13999],
    ["2019--Hennessey", 25999],
    ["2019--ChevySilverado", 23999],
    
    ["2008--TruckFord", 4999],
    ["2010--TruckFord", 9999],
    ["2017--TruckFord", 14999],
    ["2018--TruckFord", 18999]
    
    
];

// Check for modern day browsers
function Browser() {
    // Redirect to FireFox download page
    if (!document.getElementById) {
        alert("Please install a modern browser. This page does not support your current browser. You will be redirected...");
        window.location = "https://www.mozilla.org/en-US/firefox/";
    }
    // Proceed to get data.json to load the page
    else {
        getData();
    }
}

// Ajax to load data.json
function getData() {
    var ajax = new XMLHttpRequest();
    ajax.open("GET", "index.json", true);
    ajax.setRequestHeader("content-type", "application/json");
    ajax.onreadystatechange = function () {
        if (ajax.readyState == 4 && ajax.status == 200) {
            var response = JSON.parse(ajax.responseText);
            init(response); // Ajax responses need to be passed into a callback function to persist
            console.log("Response" + response);
        }
    };
   ajax.send();
}

// Sets global variables, and first dropdown
function init(response) {
    json = response;
    userHistory = [];
    body = document.getElementsByTagName('body')[0];
    createDropdown("init");
}

// Dynamically create options
function createDropdown(SelectDropDown) {
    /**
     * Check if the arg passed in is valid, '--Select an Option--' is the default value of data. Don't do anything if the default value is chosen.
     */
    if (SelectDropDown !== "--Select an Option--") {
        // Set variables
        var data = json["data"]; // data options of json
        var text = json["text"]; // text options of json

        var ArrayData = data[SelectDropDown]; // data value
        var textData = text[SelectDropDown]; // text value

        /**
         * Check that there are still data left to populate in dom. All data are stored in arrays, and all image links are stored as strings
         */
        if (ArrayData instanceof Array) {
            // Create div
            var div = document.createElement("div");
            div.id = SelectDropDown;
            div.className = "dropdown";

            // Append p to div
            var p = document.createElement("p");
            var pText = document.createTextNode(textData);
            p.appendChild(pText);
            p.onmouseover = function () {
                this.style.color = "antiquewhite"
            };
            p.onmouseout = function () {
                this.style.color = ""
            };
            div.appendChild(p);

            // Append select to div
            var select = document.createElement("select");
            select.onchange = function () {
                // If another option is checked, remove all other choice paths and clean up userHistory
                while (body.lastChild.id !== this.parentNode.id) {
                    if (body.lastChild.remove === undefined) {  // Check if browser supports .remove(), IE browsers do not
                        if (body.lastChild.id === "result" || body.lastChild.id === "form") { // Check the last child id so we don't pop too much from userHistory
                            body.removeChild(body.lastChild);
                        } 
                        else {
                            body.removeChild(body.lastChild);
                            userHistory.pop();
                        }
                    } // Do the same for non-IE browsers
                    else {
                        if (body.lastChild.id === "result" || body.lastChild.id === "form") {
                            body.lastChild.remove();
                        } 
                        else {
                            body.lastChild.remove();
                            userHistory.pop();
                        }
                    }
                }

                // Add to userHistory
                if (this.value !== "--Select an Option--") {
                    userHistory.push(this.value);
                }

                // Create next drop down
                createDropdown(this.value);
            };
            div.appendChild(select);

            // Get the options
            for (var i = 0, len = ArrayData.length; i < len; i++) {
                var option = document.createElement("option");
                var optionText = document.createTextNode(ArrayData[i]);
                option.appendChild(optionText);
                option.value = ArrayData[i];
                select.appendChild(option);
            }

            // DHTML fade in
            div.style.opacity = 0;
            fadeIn(div);

            // Append div to body
            body.appendChild(div);
        }
        else {
            // Create div
            var div2 = document.createElement("div");
            div2.id = SelectDropDown;
            div2.className = "image";

            // Append image to div
            var image = document.createElement("img");
            image.src = ArrayData;
            div2.appendChild(image);
           
            console.log("Image: " + ArrayData);

            // Append p to div
            var p = document.createElement("p");
            var pText = document.createTextNode(textData);
            p.appendChild(pText);
            div2.appendChild(p);

            // DHTML fade in
            div2.style.opacity = 0;
            fadeIn(div2);
            
            var div3 = document.createElement("div");
            div3.id = "form";
            // Create form
            var form = document.createElement("form");
            form.id = "result";

            // Create radio for NewCar
            var createRadioNewCar = document.createElement("input");
            createRadioNewCar.type = "radio";
            createRadioNewCar.value = "NewCar";
            createRadioNewCar.name = "selectedcar";  
            createRadioNewCar.setAttribute("onclick","setNewCarValue()");
            // appendChild for NewCar
            var pNewcar = document.createElement("p");
            var Newcar = document.createTextNode("New car:");
            pNewcar.appendChild(Newcar);
            pNewcar.appendChild(createRadioNewCar); 
            form.appendChild(pNewcar);
            
            // Create Naviagtion
            var nav = document.createElement('nav');
            var ul = document.createElement('ul');
            var li = document.createElement('li');
            var a = document.createElement('a');
            var linkText = document.createTextNode("Logout");
            a.appendChild(linkText);
            //a.title = "my title text"; http://serenity.ist.rit.edu/~ijc3093/ISTE-340/LoginLogout/log.html
            a.href = "../../LoginLogout/log.html";
            li.appendChild(a);
            ul.appendChild(li);
            nav.appendChild(ul);
            document.body.appendChild(nav);
            
            // Create radio for UsedCar
            var createRadioUsedCar = document.createElement("input");
            createRadioUsedCar.type = "radio";
            createRadioUsedCar.value = "UsedCar";
            createRadioUsedCar.name = "selectedcar";
            //createRadioUsedCar.setAttribute("onclick","setRadioButton(16999)");
            createRadioUsedCar.setAttribute("onclick","setUsedCarValue()");
            //appendChild for UsedCar
            var pUsedCar = document.createElement("p");
            var UsedCar = document.createTextNode("Used car:");
            pUsedCar.appendChild(UsedCar);
            pUsedCar.appendChild(createRadioUsedCar);
            form.appendChild(pUsedCar);
            
            
            //Create Checkbox for tax
            var createCheckboxTax = document.createElement("input");
            createCheckboxTax.type = "checkbox";
            createCheckboxTax.value = "tax"
            createCheckboxTax.name = "R1";
            createCheckboxTax.setAttribute("id", "checkboxVal");
            createCheckboxTax.setAttribute("onclick","checkboxFunc()");
            //appendChild for Checkbox 
            var pCheckBox = document.createElement("p");
            var CheckBox = document.createTextNode("Tax: $400.99 ");
            pCheckBox.appendChild(CheckBox);
            pCheckBox.appendChild(createCheckboxTax);
            form.appendChild(pCheckBox);
           
            // Create inputs for fname
            var fnameInput = document.createElement("input");
            fnameInput.id = "fname";
            fnameInput.type = "text";
            fnameInput.name = "fname";
            // Append inputs to form
            var fnameInputAppend = document.createElement("p");
            var fnameInputText = document.createTextNode("First name: ");
            fnameInputAppend.appendChild(fnameInputText);
            fnameInputAppend.appendChild(fnameInput);
            form.appendChild(fnameInputAppend);
            
            // Create inputs for lname
            var lnameInput = document.createElement("input");
            lnameInput.id = "lname";
            lnameInput.type = "text";
            lnameInput.name = "lname";
            //AppendChild inputs for lname
            var lnameInputAppend = document.createElement("p");
            var lnameInputText = document.createTextNode("Last name: ");
            lnameInputAppend.appendChild(lnameInputText);
            lnameInputAppend.appendChild(lnameInput);
            form.appendChild(lnameInputAppend);
            
            // Create inputs for email
            var emailInput = document.createElement("input");
            emailInput.id = "email";
            emailInput.type = "text";
            emailInput.name = "email";
            //AppendChild inputs for email
            var emailInputAppend = document.createElement("p");
            var emailText = document.createTextNode("Your Email: ");
            emailInputAppend.appendChild(emailText);
            emailInputAppend.appendChild(emailInput);
            form.appendChild(emailInputAppend);
            
            // Cookies or localStorage for all values
            if (ie7) { 
                var PrevFristName = GetCookie("fname");
                var PrevLastName = GetCookie("lname");
                var PrevEmail = GetCookie("email");

                if (PrevFristName !== null) {
                    fnameInput.value = PrevFristName;
                }
                if (PrevLastName !== null) {
                    lnameInput.value = PrevLastName;
                }
                if (PrevEmail !== null) {
                    emailInput.value = PrevEmail;
                }
            }
            else { // localStorage
                var PrevFristName = localStorage.getItem("fname");
                var PrevLastName = localStorage.getItem("lname");
                var PrevEmail = localStorage.getItem("email");

                if (PrevFristName !== null) {
                    fnameInput.value = PrevFristName;
                }
                if (PrevLastName !== null) {
                    lnameInput.value = PrevLastName;
                }
                if (PrevEmail !== null) {
                    emailInput.value = PrevEmail;
                }
            }
            
            //Create Comment
            var commentInput = document.createElement("textarea");
            commentInput.id = commentInput;
            commentInput.type = "comments";
            commentInput.name = "comments";
            commentInput.rows = "8";
            commentInput.cols = "55";
            //AppendChild inputs for lname
            var commentInputAppend = document.createElement("p");
            var commentInputText = document.createTextNode("Message: ");
            commentInputAppend.appendChild(commentInputText);
            commentInputAppend.appendChild(commentInput);
            form.appendChild(commentInputAppend);
            
                // Create button submitt
                var submitButton = document.createElement("input");
                submitButton.id = submitButton;
                submitButton.value = "Submit";
                submitButton.type = "button";
                form.appendChild(submitButton);
            
                if (document.addEventListener) { // click modern browsers
                    submitButton.addEventListener("click", function () {
                        if (validateForm() !== false) {
                            results();
                            form.submit();
                        }
                    });
                    submitButton.addEventListener("mouseover", function() {
                        this.style.backgroundColor = "white";
                    });
                    submitButton.addEventListener("mouseout", function() {
                        this.style.backgroundColor = "";
                    });
                } 
                else {
                    submitButton.attachEvent("onclick", function () { // IE < 9
                        if (validateForm() !== false) {
                            form.submit();
                        }
                    });

                    submitButton.attachEvent("onmouseover", function() {
                        this.style.backgroundColor = "white";
                    });

                    submitButton.attachEvent("onmouseout", function() {
                        this.style.backgroundColor = "";
                    });
                }

            
            //Total show
            var total = document.createElement("div");
            total.setAttribute("id","bottomTotalPrice");
            total.innerHTML = "Total Price For the Car $0";
            //var totalText = document.createTextNode("");

            // Append form to div
            div3.appendChild(total);
            div3.appendChild(form);
            body.appendChild(div2);
            body.appendChild(div3);
            
        }
    }
}


// Validate form and adds to cookies/localStorage
function validateForm() {
    var noErrors = true; // Flag for errors

    var form = document.getElementsByTagName("form")[0]; // Get form
    var inputs = form.getElementsByTagName("input"); // Get all inputs

    // Iterate all inputs in form to hold the input in a variable
    var fnameInput;
    var lnameInput;
    var emailInput;

    for (var i = 0, len = inputs.length; i < len; i++) {
        if (inputs[i].name === "fname") {
            fnameInput = inputs[i];
            fnameInput.style.backgroundColor = "";
        }

        if (inputs[i].name === "lname") {
            lnameInput = inputs[i];
            lnameInput.style.backgroundColor = "";
        }

        if (inputs[i].name === "email") {
            emailInput = inputs[i];
            emailInput.style.backgroundColor = "";
        }
    }

    // Check each input for errors
    if (fnameInput.value.length === 0) {
        fnameInput.style.backgroundColor = "pink";
        noErrors = false;
    }

    if (lnameInput.value.length === 0) {
        lnameInput.style.backgroundColor = "pink";
        noErrors = false;
    }

    if (emailInput.value.length === 0 || emailInput.value.indexOf("@") === -1) {
        emailInput.style.backgroundColor = "pink";
        noErrors = false;
    }

    /**
     * Check the flag's boolean value. The flag's value will determine whether we save the user's form data or not. If the browser is IE 7, we will use cookies. Any other browser, we will use localStorage
     */
    if (noErrors) {
        // Get form values
        var fname = fnameInput.value;
        var lname = lnameInput.value;
        var email = emailInput.value;
        var result = document.getElementById("result").lastElementChild.lastElementChild;

        if (ie7) { // Use cookies
            SetCookie("fname", fname);
            SetCookie("lname", lname);
            SetCookie("email", email);
            SetCookie("result", result);
        } 
        else { // Use localStorage
            localStorage.setItem("fname", fname);
            localStorage.setItem("lname", lname);
            localStorage.setItem("email", email);
            localStorage.setItem("result", result);
        }
    }
    return noErrors;
    
}
//Function for NewCar
function setNewCarValue(){
    
    for(var i = 0; i < newCarAmounts.length; i++){
        if(document.getElementById(newCarAmounts[i][0]))
        {
            radioValue = newCarAmounts[i][1];
            calculateTotal();
            break;
        }
    }
    console.log(radioValue);
}

//Function for UsedCar
function setUsedCarValue(){
    
    for(var i = 0; i < newCarAmounts.length; i++){
        if(document.getElementById(usedCarAmounts[i][0]))
        {
            radioValue = usedCarAmounts[i][1];
            calculateTotal();
            break;
        }
    }
    console.log(radioValue);
}


function setRadioButton(_radioValue){
    radioValue = _radioValue;
    calculateTotal();
}

function checkboxFunc(){
     if (document.getElementById("checkboxVal").checked == true){
        checkboxValue = 400.99;
    }
    else{
        checkboxValue = 0;
    }
    calculateTotal();
}

// DHTML fading in animation
function fadeIn(dom) {
    if (parseFloat(dom.style.opacity) < 1.0) {
        dom.style.opacity = parseFloat(dom.style.opacity) + 0.1;

        // Setting a timeout of 50ms, allows the dom to slowly increase the opacity and create a fade in effect
        setTimeout(
            function () { fadeIn(dom); }, 50
        )
    }
}

function hideTotal()
{
    var divobj = document.getElementById('bottomTotalPrice');
    divobj.style.display='none';
}

//All total prices
function calculateTotal()
{
    console.log("Calculate Clicked");
    carPrice = radioValue + checkboxValue;
    //display the result
    var divobj = document.getElementById('bottomTotalPrice');
    divobj.style.display='block';
    //divobj.innerHTML = "Total Price For the Car $"+carPrice;
    divobj.innerHTML = "Total Price For the Car $"+carPrice;

}

//Display result
function results(){
        console.log("Results");
        var fnameInput = document.getElementsByName('fname')[0].value;
        var lnameInput = document.getElementsByName('lname')[0].value;
        var emailInput = document.getElementsByName('email')[0].value;
        var commentInput = document.getElementsByName('comments')[0].value;
        var AllTotal = "Total Price: " + carPrice;
        console.log("Car Prices" + AllTotal);
        
        document.write("<h1> Thank You!</h1>");
        document.write("<p>Now, your data is sent via email.</p>");
        document.write("<h3>Here is your data:</h3>");
        
        document.write(fnameInput + "<br/>");
        document.write(lnameInput + "<br/>");
        document.write(emailInput + "<br/>");
        document.write(commentInput + "<br/>");
        document.write(AllTotal + "<br/>");
        
    }