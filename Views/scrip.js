document.querySelector(".menu-toggle").addEventListener("click", function () {
  document.querySelector("nav ul").classList.toggle("active");
});

document.getElementById("adress-form").addEventListener("click", function () {
  document.querySelector(".adress-form").style.display = "block";
});

document.getElementById("adress-close").addEventListener("click", function () {
  document.querySelector(".adress-form").style.display = "none";
});

const rightbtn = document.querySelector(".fa-chevron-right");
const leftbtn = document.querySelector(".fa-chevron-left");
const imgNuber = document.querySelectorAll(".slider-concent-left-top img");
console.log(imgNuber.length);
let index = 0;
rightbtn.addEventListener("click", function () {
  index = index + 1;
  if (index > imgNuber.length - 1) {
    index = 0;
  }
  document.querySelector(".slider-concent-left-top").style.right =
    index * 100 + "%";
});
leftbtn.addEventListener("click", function () {
  index = index - 1;
  if (index <= 0) {
    index = imgNuber.length - 1;
  }
  document.querySelector(".slider-concent-left-top").style.right =
    index * 100 + "%";
});
const imgNuberLi = document.querySelectorAll(".slider-concent-left-botton li");
imgNuberLi.forEach(function (image, index) {
  image.addEventListener("click", function () {
    removeactive();
    document.querySelector(".slider-concent-left-top").style.right =
      index * 100 + "%";
    image.classList.add("active");
  });
});
function removeactive() {
  let imgactive = document.querySelector(".slider-concent-left-botton .active");
  imgactive.classList.remove("active");
}
function imgAuto() {
  index = index + 1;
  if (index > imgNuber.length - 1) {
    index = 0;
  }
  removeactive();
  document.querySelector(".slider-concent-left-top").style.right =
    index * 100 + "%";
  imgNuberLi[index].classList.add("active");
}
setInterval(imgAuto, 3000);

// Danh mục
$(document).ready(function () {
  $(".dropdown").hover(
    function () {
      $(this).addClass("show");
      $(this).find(".dropdown-menu").addClass("show");
    },
    function () {
      $(this).removeClass("show");
      $(this).find(".dropdown-menu").removeClass("show");
    }
  );
});

// // Gio hang
// function changeMainImage(imageSrc) {
//   // Thay đổi ảnh chính bằng ảnh được nhấp vào
//   document.getElementById("mainImage").src = imageSrc;
// }

// Form thanh toán
document.getElementById("btnCheckout").addEventListener("click", function () {
  $("#checkoutForm").modal("show");
});
