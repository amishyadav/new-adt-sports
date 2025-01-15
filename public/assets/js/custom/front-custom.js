/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!****************************************************!*\
  !*** ./resources/assets/js/custom/front-custom.js ***!
  \****************************************************/
function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();

    reader.onload = function (e) {
      $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
      $('#imagePreview').hide();
      $('#imagePreview').fadeIn(650);
    };

    reader.readAsDataURL(input.files[0]);
  }
}

$("#imageUpload").change(function () {
  readURL(this);
});
/******/ })()
;