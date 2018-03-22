//  Check every 100ms if the documant os loaded.
var docReady = setInterval(function() {
    if(document.readyState != "complete") {
        return;
    }
    //  Stop the checking
    clearInterval(docReady);

    //  ...

    //  Get the first element of the document with a class of 'btn' and add a click-event which fires the 'createNewCategory'-funtion.
    document.getElementsByClassName('btn')[0].addEventListener('click', createNewCategory);
}, 100);

//  Create new category
function createNewCategory(event) {
    event.preventDefault();
    var name = event.target.previousElementSibling.value;
    if(name.length === 0) {
        alert('Please enter a valid category name');
        return;
    }
    ajax("POST", "/admin/blog/category/create", "name=" + name, newCategoryCreated, [name]);
}

//  Callback function triggered by the 'ajax'-funtion.
function newCategoryCreated(params, success, responseObj) {
    //  Reload the page.
    location.reload();
}

//  Deal with the HTTP-protocol
function ajax(method, url, params, callback, callbackParams) {
    var http;

    //  Check the browser compability.
    if(window.XMLHttpRequest) { 
        //  Modern browsers.
        http = new XMLHttpRequest();
    } else {
        //  Legacy browsers.
        http = new ActiveXObject("Microsoft.XMLHTTP");
    }

    //  When the ready state changes.
    http.onreadystatechange = function() {
        if(http.readyState == XMLHttpRequest.DONE) {
            if(http.status == 200) {
                var obj = JSON.parse(http.responseText);
                callback(callbackParams, true, obj);
            } else if(http.status == 400) {
                alert("Category could not be saved. Please try again.");
                callback(callbackParams, false);
            } else {
                var obj = JSON.parse(http.responseText);
                if(obj.message) {
                    alert(obj.message);
                } else {
                    alert("Please check the name");
                }
            }
        }
    }

    //  Open the connection.
    http.open(method, baseUrl + url, true);

    //  Set the headers.
    http.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    http.setRequestHeader('X-Requested-With', 'XMLHttpRequest');

    //  Send the authentication token and eventually trigger the 'http.onreadystate'.
    http.send(params + "&_token=" + token);
}