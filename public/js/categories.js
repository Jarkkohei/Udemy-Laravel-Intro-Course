//  Check every 100ms if the documant os loaded.
var docReady = setInterval(function() {
    if(document.readyState != "complete") {
        return;
    }
    //  Stop the checking
    clearInterval(docReady);

    //  Get the <div> with the class "edit" from every category-iteration as an array.
    var editSections = document.getElementsByClassName('edit');

    //  For each category-iterations add the eventlistener for the "Edit" <a>.
    for(var i=0; i < editSections.length;i++) {
        editSections[i].firstElementChild.firstElementChild.children[1].firstChild.addEventListener('click', startEdit);
    }

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

function startEdit(event) {
    event.preventDefault();
    //  Cnahge the text to "Save".
    event.target.innerText = "Save";
    //  Get the previous <li>-element with the <input>-element inside of it.
    var li = event.path[2].children[0];
    //  Set the <input>-elements value to the innerText of <h3>-element (= $category->name )
    li.children[0].value = event.path[4].previousElementSibling.children[0].innerText;
    //  Re-style the <li>-element.
    li.style.display = "inline-block";
    //  Give the "slide-open" animation time to happen before changin the next style.
    setTimeout(function() {
        li.children[0].style.maxWidth = "110px";
    }, 1);

    //  Remove the eventListener.
    event.target.removeEventListener('click', startEdit);
    //  Attach new eventListener
    event.target.addEventListener('click', saveEdit);
}

function saveEdit(event) {
    event.preventDefault();
    //  Get the <li>-element.
    var li = event.path[2].children[0];
    //  Get the value of the first child of the <li>-element as a categoryName.
    var categoryName = li.children[0].value;
    //  Get the categoryId saved into the value of the "data-id" in the <div>-element with the class "category-info".  
    var categoryId = event.path[4].previousElementSibling.dataset['id'];
    //  Validate th e length of the given categoryName.
    if(categoryName.length === 0) {
        alert("Please enter a valid category name");
        return;
    }
    //  Make the Http-request
    ajax("POST", "/admin/blog/categories/update", "name=" + categoryName + "&category_id=" + categoryId, endEdit, [event]);
}

function endEdit(params, success, responseObj) {
    var event = params[0];
    
    if(success) {
        var newName = responseObj.new_name;
        var article = event.path[5];
        //  Flash the articles backgroundColor to #afefac and back to "white" again.
        article.style.backgroundColor = "#afefac";
        setTimeout(function() {
            article.style.backgroundColor = "white";
        }, 300);
        //  get the <h3>-element inside the <div>-element with the class "category-info"
        article.firstElementChild.firstElementChild.innerHTML = newName;
    }
    //  Change the text back to "Edit".
    event.target.innerText = "Edit";
    var li = event.path[2].children[0];
    li.children[0].style.maxWidth = "0px";
    //  Give the "slide-in" animation time to animate.
    setTimeout(function() {
        li.style.display = "none";
    }, 310);
    //  Remove the eventListener.
    event.target.removeEventListener('click', saveEdit);
    //  Reset the original eventListener.
    event.target.addEventListener('click', startEdit);
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