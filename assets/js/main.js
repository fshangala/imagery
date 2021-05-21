//Slick
$(".slider").slick({
    infinity: true,
    dots: true,
    slidesToShow: 3,
    slidesToScroll: 1,
    autoplay: true,
    speed: 500,
    responsive: [
        {
            breakpoint: 600,
            settings: {
                slidesToShow: 1,
                slidesToScroll: 1
            }
        }
    ]
});
$(".slick-prev").html("<");
$(".slick-next").html(">");

//side-nav
function open_nav(){
    var nav = document.querySelector(".side-navbar");
    var main = document.querySelector(".main");
    if(nav.style.width == "0%"){
        nav.style.width = "25%";
        main.style.marginLeft = "25%";
    } else {
        nav.style.width = "0%";
        main.style.marginLeft = "0%";
    }
}

function open_nav_sm(){
    var nav = document.querySelector(".side-navbar");
    if(nav.style.display == "none"){
        nav.style.display = "block";
    } else {
        nav.style.display = "none";
    }
}

//modal buttons
var modal_open_buttons = document.querySelectorAll("[data-toggle='modal']");
for(var i = 0; i < modal_open_buttons.length; i++){
    modal_open_buttons[i].addEventListener("click", function(event){
        console.log(event.target.getAttribute("data-target"));
        document.querySelector(event.target.getAttribute("data-target")).style.display = "flex";
    });
}

//close buttons
var modal_close_buttons = document.querySelectorAll(".close");
for(var i = 0; i < modal_close_buttons.length; i++){
    modal_close_buttons[i].addEventListener("click", function(event){
        console.log(event.target.getAttribute("data-target"));
        document.querySelector(event.target.getAttribute("data-target")).style.display = "none";
    });
}
