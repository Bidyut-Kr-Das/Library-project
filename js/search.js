function callConfirm(name1,id1){
    // alert("hello");
    // const deciderInput = document.querySelector("#decider");
    
    //the deciderInput will decide in php in the main page what input:hidden to show and apply
    
    // deciderInput.value="bookBook";
    const div =document.querySelector(".confirmation");
    const div1 =document.querySelector(".returnConfirmation");
    const name=document.querySelector(".bookName");
    const bookid= document.querySelector("#id1");
    // const  quantity=document.querySelector("#id2");
    bookid.value=id1;
    // quantity.value=quantity1;
    
    name.innerHTML=name1+" ?";
    div.classList.remove("invisible");
    div.classList.add("visible");
    div.classList.add("slide-in-fwd-center");
    div1.classList.add("invisible");
    div1.classList.remove("visible");
    div1.classList.remove("slide-in-fwd-center");
    }
function cancelled(){
    const div =document.querySelector(".confirmation");
    const div1 =document.querySelector(".returnConfirmation");
    
    // div.classList.remove("visible");
    // div.classList.add("invisible");
    div.classList.replace("visible","invisible");
    div.classList.remove("slide-in-fwd-center");
    div1.classList.remove("slide-in-fwd-center");
    // div1.classList.remove("visible");
    // div1.classList.add("invisible");
    div1.classList.replace("visible","invisible");
    
}
function returnConfirm(name1,id1){
    const div1 =document.querySelector(".returnConfirmation");
    const div =document.querySelector(".confirmation");
    

    
    const name=document.querySelector(".bookName1");
    const bookid= document.querySelector("#id2");
    
    bookid.value=id1;
    name.innerHTML=name1+" ?";
    
    // div1.classList.remove("invisible");
    // div1.classList.add("visible");
    div1.classList.replace("invisible","visible");
    div1.classList.add("slide-in-fwd-center");
    div.classList.remove("visible");
    div.classList.add("invisible")
    div.classList.remove("slide-in-fwd-center");
}
function searchBook(){
    let searchedBook=document.querySelector("#SearchBox").value;
    window.location.href="LibraryHomepage.php?search="+searchedBook+"&#secondDivbgImage";
}