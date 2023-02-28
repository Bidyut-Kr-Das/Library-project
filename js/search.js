function callConfirm(name1,id1){
    // alert("hello");
    const div =document.querySelector(".confirmation");
    const name=document.querySelector(".bookName");
    const bookid= document.querySelector("#id1");
    // const  quantity=document.querySelector("#id2");
    bookid.value=id1;
    // quantity.value=quantity1;

    name.innerHTML=name1+" ?";
    div.classList.add("slide-in-fwd-center");
    }
function cancelled(){
    const div =document.querySelector(".confirmation");
    div.classList.remove("slide-in-fwd-center");

}
function searchBook(){
    let searchedBook=document.querySelector("#SearchBox").value;
    window.location.href="LibraryHomepage.php?search="+searchedBook+"&#secondDivbgImage";
}