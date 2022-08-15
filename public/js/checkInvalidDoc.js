/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!*****************************************!*\
  !*** ./resources/js/checkInvalidDoc.js ***!
  \*****************************************/
var title = document.querySelector('#title');
var endMonth = document.querySelector('#endMonth');
var endYear = document.querySelector('#endYear');
var submitDoc = document.querySelector('#submitDoc');
submitDoc.addEventListener('click', function () {
  if (title.validity.valueMissing) {
    title.setCustomValidity('กรุณากรอกหัวเรื่อง');
  } else {
    title.setCustomValidity('');
  }

  if (endMonth.validity.valueMissing) {
    endMonth.setCustomValidity('กรุณาเลือกเดือนที่ต้องการ');
  } else {
    endMonth.setCustomValidity('');
  }

  if (endYear.validity.valueMissing) {
    endYear.setCustomValidity('กรุณาเลือกปีที่ต้องการ');
  } else {
    endYear.setCustomValidity('');
  }
});
/******/ })()
;