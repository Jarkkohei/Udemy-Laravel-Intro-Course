function modalOpen(event) {
    event.preventDefault();

    var background = document.createElement('div');
    background.className = "modal-background";

    var width = window.innerWidth;
    var height = window.innerHeight;
    background.style.width = width + "px";
    background.style.height = height + "px";

    document.body.appendChild(background);

    //  Get the first element of the document with the class "modal".
    var modal = document.getElementsByClassName('modal')[0];
    //  Set the modal visible.
    modal.style.display = "block";
    setTimeout(function() {
        //  Position the Modal in the middle of the screen.
        modal.style.top = height / 2 -modal.offsetHeight / 2  + "px";
    }, 10);
}

function modalClose(event) {
    event.preventDefault();

    //  Get the first element of the document with the class "modal".
    var modal = document.getElementsByClassName('modal')[0];

    //  Check if the modal has other than <button>-elements inside it (before the <button>-element).
    while(modal.firstElementChild.tagName !== 'BUTTON') {
        //  Remove the first element inside the modal.
        modal.firstElementChild.remove();
    }
    //  Reset the modals initial styling and hide it and the background.
    modal.style.top = "10%";
    modal.style.display = "none";
    var background = document.getElementsByClassName('modal-background')[0];
    background.remove();
}