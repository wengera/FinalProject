/* Author: Alex  Wenger, Kevin June
 * Date: 11/29/2018
 * Name: main.js
 * Description: this is the javascript file for the application.
 */

var xmlHttp;  //xmlhttprequest object

//create an XMLHttpRequest object when the web page loads
window.onload = function () {
    console.log("Main loaded");
    xmlHttp = createXmlHttpRequestObject(); 
};

//this function creates a XMLHttpRequest object. It should work with most types of browsers.
function createXmlHttpRequestObject()
{
	// add your code here to create a XMLHttpRequest object compatible to most browsers
    var xmlhttp;
    
    if (window.XMLHttpRequest) {
        // code for modern browsers
        xmlhttp = new XMLHttpRequest();
     } else {
        // code for old IE browsers
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    
    return xmlhttp;
	
}

/*
 * This function makes asynchronous HTTP request using the XMLHttpRequest object.
 * It passes a zip code to a server-side script for processing.
 * This function is invoked by the handlekeyup function when a keystroke is detected.
 */
function GetItemJson(id, user)
{
	//add your code here to process ajax requests and handle server's responses
    var request = createXmlHttpRequestObject();
    
    request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log("Response: " + request.responseText);
            var json = $.parseHTML(request.responseText)[6].textContent;
            json = json.trim();
            
            updateDetailBox(JSON.parse(json));
        }
    };
    
    request.open("GET", "getItemDetails?id=" + id + "&userFlag=" + user, false);
    request.send(id);
    
    
}

function GetTotal(idList)
{
    
    //add your code here to process ajax requests and handle server's responses
    var request = createXmlHttpRequestObject();
    
    var totalPrice = 0;
    var length = idList.length;
    var x = 0;
    while (x < length){
        request.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                
                var json = $.parseHTML(request.responseText)[6].textContent;
                json = json.trim();

                totalPrice += parseInt(JSON.parse(json)["price"]);

            }
        };
        
        
        request.open("GET", "getItemDetails?id=" + idList[x] + "&userFlag=false", false);
        request.send(idList[x]);
        x += 1;
    }
    
    console.log("Total Price: " + totalPrice);
    return totalPrice;
    
}

function TryPurchase(idList)
{
    var totalPrice = GetTotal(idList);
    console.log(document.getElementById("userCoins").innerHTML);
    var userCoins = parseInt(document.getElementById("userCoins").innerHTML);
    console.log("User Coins: " + userCoins + " | " + "Total: " + totalPrice);
    if (totalPrice < userCoins){
        //add your code here to process ajax requests and handle server's responses
        var request = createXmlHttpRequestObject();

        request.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {

                console.log(request.responseText);

            }
        };

        request.open("GET", "updateBank?balance=" + (userCoins - totalPrice), false);
        request.send(idList[x]);
        
        var length = idList.length;
        var x = 0;
        while (x < length){
            request.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    
                    console.log(request.responseText);

                }
            };

            request.open("GET", "addItem?id=" + idList[x], false);
            request.send(idList[x]);
            x += 1;
        }
    }
    
    
}