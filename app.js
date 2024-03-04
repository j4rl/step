document.addEventListener("DOMContentLoaded",function(){
    //Stuff
    borg=document.getElementById("borg");
    borg.addEventListener("click",toggleMenu);
    function toggleMenu(){    
        menu=document.querySelector("nav");
        if(menu.style.right=="0px"){
            menu.style.right='-40ch';
        }else{
            menu.style.right="0px";
        }
    }

    
});