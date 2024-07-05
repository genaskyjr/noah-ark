// carousel.js

$(document).ready(function () {
    var totalItems = $(".carousel-item").length;
    console.log("Total Items:", totalItems); // Check if totalItems is correct
  
    var currentIndex = $("div.carousel-item.active").index() + 1;
    console.log("Current Index:", currentIndex); // Check if currentIndex is correct
  
    $("#carouselExampleDark").on("slide.bs.carousel", function (e) {
      currentIndex = $(e.relatedTarget).index() + 1;
      console.log("New Current Index:", currentIndex); // Check if slide event is triggered and currentIndex updates
  
      if (currentIndex === totalItems) {
        $("#carousel-control-next-custom").hide();
      } else {
        $("#carousel-control-next-custom").show();
      }
    });
  
    if (currentIndex === totalItems) {
      $("#carousel-control-next-custom").hide();
    }
  });
  