$( document ).ready(function() {
    console.log( "doc" );
    window.addEventListener("contextmenu",function(event){
        event.preventDefault();
        var contextElement = document.getElementById("rightclick-menu");
        contextElement.style.top = event.offsetY + "px";
        contextElement.style.left = event.offsetX + "px";
        contextElement.classList.add("active");
      });
      window.addEventListener("click",function(){
        document.getElementById("rightclick-menu").classList.remove("active");
      });
});




