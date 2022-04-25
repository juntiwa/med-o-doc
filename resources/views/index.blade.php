<script>
   var sregfrom = <?= json_encode($sregfrom,  JSON_HEX_TAG); ?>;
   console.log(sregfrom);
   $('select[value="sregfrom"]').attr('selected', 'selected');
   // old input regtype
   var sregfromold = sregfrom;
   console.log(sregfromold);
   if (sregfromold !== '') {
      $('#sregfrom').val(sregfromold);
      // this will load subcategories once you set the category value
      $("#sregfrom").change();
   }
</script>