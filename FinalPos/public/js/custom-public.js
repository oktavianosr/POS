/* <!-- 

All Right/liences is Reserved by rjksharma
For Buy this Template contact us https://rjksharma.com/contact

follow us on social media for more projects :)

► YouTube : https://www.youtube.com/@rjksharma
► Facebook : https://www.facebook.com/rjksharma23
► Instagram : https://www.instagram.com/rjksharma_/
► Twitter : https://twitter.com/rjksharma23
► Linkedin : https://www.linkedin.com/in/rjksharma23
► Github : https://github.com/rjksharma 

--> */

(function ($) {
  "use strict";

  // NAVBAR
  $(".navbar-collapse a").on("click", function () {
    $(".navbar-collapse").collapse("hide");
  });

  $(function () { 
    $(".hero-slides").vegas({
      slides: [{ src: "../images/public/hangout.jpg" }, { src: "../images/young-female-barista-wear-face-mask-serving-take-away-hot-coffee-paper-cup-consumer-cafe.jpg" }],
      timer: false, 
      animation: "kenburns",
    });
  });

  // CUSTOM LINK
  $(".smoothscroll").click(function () {
    var el = $(this).attr("href");
    var elWrapped = $(el);
    var header_height = $(".navbar").height() + 60;

    scrollToDiv(elWrapped, header_height);
    return false;

    function scrollToDiv(element, navheight) {
      var offset = element.offset();
      var offsetTop = offset.top;
      var totalScroll = offsetTop - navheight;

      $("body,html").animate(
        {
          scrollTop: totalScroll,
        },
        300
      );
    }
  });
})(window.jQuery);

const form = document.getElementById("form");
const result = document.getElementById("result");

form.addEventListener("submit", function (e) {
  e.preventDefault();
  const formData = new FormData(form);
  const object = Object.fromEntries(formData);
  const json = JSON.stringify(object);
  result.innerHTML = "Pesan Anda Telah Terkirim...";
  fetch("https://api.web3forms.com/submit", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
      Accept: "application/json",
    },
    body: json,
  })
    .then(async (response) => {
      let json = await response.json();
      if (response.status == 200) {
        result.innetHTML = json.message;
      } else {
        console.log(response);
        result.innerHTML = json.message;
      }
    })
    .catch((error) => {
      console.log(error);
      result.innerHTML = "Something Went Wrong!";
    })
    .then(function () {
      form.reset();
      setTimeout(() => {
        result.style.display = "none";
      }, 3000);
    });
});