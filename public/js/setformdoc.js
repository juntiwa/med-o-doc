/******/ (() => { // webpackBootstrap
var __webpack_exports__ = {};
/*!************************************!*\
  !*** ./resources/js/setformdoc.js ***!
  \************************************/
function SetTt() {
  // เมื่อกดและให้เป็น 0 เพื่อแสดงช่องกรอกข้อมูล
  window.localStorage.setItem("tt", 0);

  if (window.localStorage.getItem("tt") == 0) {
    $("#inputSearch").slideDown();
  }
}
/******/ })()
;