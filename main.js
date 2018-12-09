/* Author: Alex  Wenger, Kevin June
 * Date: 12/2/2018
 * Name: main.js
 * Description: this is the javascript file for the application.
 */

var xmlHttp;  //xmlhttprequest object

//create an XMLHttpRequest object when the web page loads
window.onload = function () {
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
Gets an item from a user's inventory
 */
function GetItemJson(id, user)
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
    
    request.open("GET", "getItemDetails?id=" + id + "&userFlag=" + user, false);
    request.send(id);
    
    
}


//Returns an item straight from the item table
function GetItemJsonBasic(id)
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
    
    request.open("GET", "getItemDetailsBasic?id=" + id, false);
    request.send(id);
    
    
}

//Returns total price of items in list
function GetTotal(idList)
{
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
    
    return totalPrice;
    
}

//Sells items in list
function SellItems(idList){
    var totalPrice = GetTotal(idList);
    var userCoins = parseInt(document.getElementById("userCoins").innerHTML);
    
    var request = createXmlHttpRequestObject();

    request.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {


        }
    };
    
    request.open("GET", "updateBank?balance=" + (userCoins + totalPrice), false);
    request.send(idList[x]);

    var length = idList.length;
    var x = 0;
    while (x < length){
        request.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {


            }
        };

        request.open("GET", "removeItem?id=" + idList[x], false);
        request.send(idList[x]);
        x += 1;
    }
    
    snackbar("Purchase Successful");

    setTimeout(function(){ location.reload(); }, 2000);
}

//Try to purchase items in list
function TryPurchase(idList)
{
    var totalPrice = GetTotal(idList);
    var userCoins = parseInt(document.getElementById("userCoins").innerHTML);
    if (totalPrice < userCoins){
        
        var request = createXmlHttpRequestObject();

        request.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {


            }
        };

        request.open("GET", "updateBank?balance=" + (userCoins - totalPrice), false);
        request.send(idList[x]);
        
        var length = idList.length;
        var x = 0;
        while (x < length){
            request.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    
                    
                }
            };

            request.open("GET", "addItem?id=" + idList[x], false);
            request.send(idList[x]);
            x += 1;
        }
        snackbar("Purchase Successful");
        
        setTimeout(function(){ location.reload(); }, 2000);
        
    }else{
        snackbar("Insufficient funds.");
    }
    
    
}