/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!******************************************!*\
  !*** ./resources/js/checkInvalidUser.js ***!
  \******************************************/
// เพิ่มผู้ใช้งาน
var sapid0 = document.querySelector('#sapid0');
var sapidIndex = document.querySelector('#sapid--index--');
var permission0 = document.querySelector('#permission0');
var permissionIndex = document.querySelector('#permission--index--');
var saveButton = document.querySelector('#saveButton');
saveButton.addEventListener('click', function () {
  if (sapid0.validity.valueMissing) {
    sapid0.setCustomValidity('กรุณากรอกรหัสนักงาน');
  } else {
    sapid0.setCustomValidity('');
  }

  if (sapidIndex.validity.valueMissing) {
    sapidIndex.setCustomValidity('กรุณากรอกรหัสนักงาน');
  } else {
    sapidIndex.setCustomValidity('');
  }

  if (permission0.validity.valueMissing) {
    permission0.setCustomValidity('กรุณาเลือกสิทธิ์ของผู้ใช้งาน');
  } else {
    permission0.setCustomValidity('');
  }

  if (permissionIndex.validity.valueMissing) {
    permissionIndex.setCustomValidity('กรุณาเลือกสิทธิ์ของผู้ใช้งาน');
  } else {
    permissionIndex.setCustomValidity('');
  }
});
/******/ })()
;