document.addEventListener("DOMContentLoaded",function(){
    //Stuff
    borg=document.getElementById("borg");
    borg.addEventListener("click",toggleMenu);
    function toggleMenu(){    
        menu=document.querySelector("nav");
        if(menu.style.opacity=="1"){
            menu.style.opacity="0";
        }else{
            menu.style.opacity="1";
        }
    }

    
});