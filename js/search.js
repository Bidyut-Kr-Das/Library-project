function searchBook(){
    let searchedBook=document.querySelector("#SearchBox").value;
    window.location.href="LibraryHomepage.php?search="+searchedBook+"&#secondDivbgImage";
}
var firstClick = true;
function isSearching(){
    let searchedBook = document.querySelector("#SearchBox");
    let clearicon1= document.querySelector(".clearIcon");

    searchedBook.style.borderRadius = "0";
    if(firstClick) {
        clearicon1.classList.add("moveRight");
        firstClick=false;
    }
    else{
        clearicon1.classList.replace("moveLeft","moveRight");
    
    }
    clearicon1.style.visibility="visible";

}
function clearIcon(){
    let searchedBook=document.querySelector("#SearchBox");
    let clearicon1= document.querySelector(".clearIcon");

    searchedBook.value="";
    // searchedBook.style.borderRadius="2rem";
    searchedBook.style.borderTopLeftRadius="2rem"; 
    searchedBook.style.borderBottomLeftRadius="2rem"; 
    // clearicon1.style.animation="moveLeft 0.5s ease-in-out";
    clearicon1.classList.replace("moveRight","moveLeft");
    clearicon1.style.visibility="hidden";
}
function returnWindow(id){
    window.location.href="LibraryHomepage.php?returnactivation="+id+"&#secondDivbgImage";
}

function returnVisible(){
        let display=document.querySelector(".mainBox2");
        // display.style.visibility="visible";
        display.classList.remove("invisible");
}
function returnInvisible(){
    let display=document.querySelector(".mainBox2");
    display.classList.add("invisible");
}
function myFunction() {
    var x = document.getElementById("snackbar");
    x.className = "show";
    setTimeout(function () {
        x.className = x.className.replace("show", "");
    }, 3000);
}