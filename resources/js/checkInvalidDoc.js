const title = document.querySelector('#title');
const endMonth = document.querySelector('#endMonth');
const endYear = document.querySelector('#endYear');
const submitDoc = document.querySelector('#submitDoc');
submitDoc.addEventListener('click', () => {
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