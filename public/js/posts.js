var addedCategoriesText;
var addedCategoriesIDs;

//  Check every 100ms if the document is loaded.
var docReady = setInterval(function() {
    if(document.readyState != "complete") {
        return;
    }
    //  Stop the checking
    clearInterval(docReady);

    var addCategoryBtn = document.getElementsByClassName('btn')[0];
    //  Get the hidden <input>-element.
    addedCategoriesIDs = document.getElementById('categories');
    addCategoryBtn.addEventListener('click', addCategoryToPost);
    addedCategoriesText = document.getElementsByClassName('added-categories')[0];

    for(var i=0; i < addedCategoriesText.firstElementChild.children.length; i++) {
        addedCategoriesText.firstElementChild.children[i].firstElementChild.addEventListener('click', removeCategoryFromPost);
    }
}, 100);


//  "Add Category" clicked
function addCategoryToPost(event) {
    event.preventDefault();
    var select = document.getElementById('category_select');
    //  Get the currently selected option value from the <select>-element.
    var selectedCategoryId = select.options[select.selectedIndex].value;
    //  Get the text inside the currently selected innerText from the <select>-element.
    var selectedCategoryName = select.options[select.selectedIndex].text;
    //  Get the array of the individual IDs currently added to the post slipt by comma 
    //  and check if the currently added category already exists in the array.
    if(addedCategoriesIDs.value.split(",").indexOf(selectedCategoryId) != -1) {
        return;
    }
    //  Check if the array is empty.
    if(addedCategoriesIDs.value.length > 0) {
        //  Only add the comma if we already have no categoryIds i the array.
        addedCategoriesIDs.value = addedCategoriesIDs.value + "," + selectedCategoryId;
    } else {
        addedCategoriesIDs.value = selectedCategoryId;
    }
    //  Create <li>- and <a>-element.
    var newCategoryLi = document.createElement('li');
    var newCategoryLink = document.createElement('a');
    //  Set the <a>-elements href-property to point nowhere.
    newCategoryLink.href = "#";
    newCategoryLink.innerText = selectedCategoryName;
    //  Attach the "data"-property to the newCategoryLink with the "category_id".
    newCategoryLink.dataset['category_id'] = selectedCategoryId;
    newCategoryLink.addEventListener('click', removeCategoryFromPost);
    //  Set the <a>-element to be inside the <li>-element
    newCategoryLi.appendChild(newCategoryLink);
    addedCategoriesText.firstElementChild.appendChild(newCategoryLi);
    
}


//
function removeCategoryFromPost(event) {
    event.preventDefault();
    event.target.removeEventListener('click', removeCategoryFromPost);
    //  Target the attached "data"-property.
    var categoryId = event.target.dataset['category_id'];
    //  Get the hidden <input>-element values.
    var categoryIDArray = addedCategoriesIDs.value.split(",");
    //  Get the index of the current categoryId in the array.
    var index = categoryIDArray.indexOf(categoryId);
    //  Remove the specific index from the array.
    categoryIDArray.splice(index, 1);
    //  Stitch the array back together with the comma between the elements.
    var newCategoriesIDs = categoryIDArray.join(',');
    addedCategoriesIDs.value = newCategoriesIDs;
    //  Remove the element from the DOM.s
    event.target.parentElement.remove();
}