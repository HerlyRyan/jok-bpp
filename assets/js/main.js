
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();   
});

// Call the dataTables jQuery plugin
$(document).ready(function() {
  $('#dataKategori').DataTable();
  $('#dataRekanan').DataTable();
  $('#dataSupplier').DataTable();
  $('#dataBarang').DataTable();
  $('#dataBarangMasuk').DataTable();
  $('#dataBarangKeluar').DataTable();
});

$('#myModal').on('shown.bs.modal', function () {
  $('#myInput').trigger('focus')
})
