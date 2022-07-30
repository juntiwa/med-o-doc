// เพิ่มผู้ใช้งาน
const sapid0 = document.querySelector('#sapid0');
const sapidIndex = document.querySelector('#sapid--index--');
const permission0 = document.querySelector('#permission0');
const permissionIndex = document.querySelector('#permission--index--');
const saveButton = document.querySelector('#saveButton');

saveButton.addEventListener('click', () => {
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