// window.onscroll=function() {hehe()};
const navBar=document.getElementById("navigatonBAr");
// var sticky=navBar.offsetTop;
// function hehe(){
//     if(window.pageYOffset>sticky){
//         navBar.classList.add("sticky");
//     }
//     else{
//         navBar.classList.remove("sticky");
//     }
// }
// function hehe(){
//     var navBar= document.getElementById("navigatonBAr");
//     navBar.classList.add("hello");

// }
const welcome=document.querySelector(".scrollToggle");
const observer =new IntersectionObserver(
    (entries)=>{
        const ent = entries[0];
        // alert("hehe");
        // console.log(ent);
        ent.isIntersecting === false 
        ? navBar.classList.add("sticky")
        :navBar.classList.remove("sticky");
    },
    {
        root: null,
        rootMargin: "",
        threshold:0,
    }
);
observer.observe(welcome);
// document.getElementById("hello").inner