function currDiv(n) {
  showimg(slideIndex = n);
}

function showimg(n) {
  var i;
  var x = document.getElementsByClassName("mySlides");
  var dots = document.getElementsByClassName("point");
  if (n > x.length) {
    slideIndex = 1;
  }

  if (n < 1) {
    slideIndex = x.length;
  }

  for (i = 0; i < x.length; i++) {
    x[i].style.display = "none";
  }
  
  for (i = 0; i < dots.length; i++) {
    dots[i].className = dots[i].className.replace("opaque", "");
  }

  x[slideIndex-1].style.display = "block";
  dots[slideIndex-1].className += "opaque";
}


