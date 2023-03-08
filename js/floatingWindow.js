function callConfirmBook(name,author,bookid,Id1){
    const bookname= document.querySelector("#bookName");
    const bookAuthor= document.querySelector("#bookAuthor");
    const bookId= document.querySelector("#BookId");
    const Id= document.querySelector("#id1");
    const mainbox=document.querySelector(".mainBox");


    Id.value=Id1;
    bookname.innerHTML=name;
    bookAuthor.innerHTML=author;
    bookId.innerHTML=bookid;

    mainbox.classList.replace("invisible", "visible");
    // mainbox.classList.add("slide-in-fwd-center");
}

//function for cross button in the floating window--------------------------------------------------------------->


function cross(){
    const mainBox= document.querySelector(".mainBox");
    mainBox.classList.replace("visible","invisible");
}

//disabled button if checkbox not checked------------------------------------------------------------------->


function acceptTnC(){
    const checkbox= document.getElementById("checkbox");
    const confirmbtn= document.getElementById("confirmbtn");
    if(checkbox.hasAttribute("checked")){
        confirmbtn.setAttribute("disabled","");
        checkbox.removeAttribute("checked");
    }else{
        confirmbtn.removeAttribute("disabled","");
        checkbox.setAttribute("checked","");
    }
    
}