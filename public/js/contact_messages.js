//  Check every 100ms if the document is loaded.
var docReady = setInterval(function() {
    if(document.readyState != "complete") {
        return;
    }
    //  Stop the checking
    clearInterval(docReady);

    var contactMessages = document.getElementsByClassName('contact-message');

    for(var i = 0; i < contactMessages.length; i++) {
        contactMessages[i].getElementsByTagName('li')[0].firstElementChild.addEventListener('click', modalOpen);
        contactMessages[i].getElementsByTagName('li')[0].firstElementChild.addEventListener('click', modalContent);
        contactMessages[i].getElementsByTagName('li')[1].firstElementChild.addEventListener('click', deleteContactMessage);
    }
    document.getElementById('modal-close').addEventListener('click', modalClose);
}, 100);


//  Inject the actual message into the modal.
function modalContent(event) {
    event.preventDefault();
    
    var subject = event.path[5].firstElementChild.firstElementChild.innerText;
    var sender = event.path[5].lastElementChild.firstElementChild.innerText;
    var message = event.path[5].dataset['message'];
    var modal = document.getElementsByClassName('modal')[0];

    var modalSubject = document.createElement('h1');
    var modalSender = document.createElement('h3');
    var modalMessage = document.createElement('p');

    //  Populate the modals inner elements
    modalSubject.innerText = subject;
    modalSender.innerText = sender;
    modalMessage.innerText = message;

    //  Insert the message to the modal BEFORE the first element currently in the childNodes-list.
    modal.insertBefore(modalMessage, modal.childNodes[0]);
    modal.insertBefore(modalSender, modal.childNodes[0]);
    modal.insertBefore(modalSubject, modal.childNodes[0]);
}


//  
function deleteContactMessage(event) {
    event.preventDefault();

    event.target.removeEventListener('click', deleteContactMessage);
    var messageId = event.path[5].dataset['id'];

    // 
    ajax("GET", "/admin/contact/message/" + messageId + "/delete", null, messageDeleted, [event.path[5]]);
}


//  
function messageDeleted(params, success, responseObj) {
    var article = params[0];
    if(success) {
        article.style.backgroundColor = "#ffc4b";
        setTimeout(function() {
            article.remove();
            location.reload();
        }, 300);
    }
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