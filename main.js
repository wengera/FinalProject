/* Author: Alex  Wenger
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
function GetItemJson(id)
{
    
	//add your code here to process ajax requests and handle server's responses
    var request = createXmlHttpRequestObject();
    
    request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            
            var json = $.parseHTML(request.responseText)[6].textContent;
            json = json.trim();
            
            updateDetailBox(JSON.parse(json));
        }
    };
    
    request.open("GET", "getItemDetails?id=" + id, false);
    request.send(id);
    
    
}