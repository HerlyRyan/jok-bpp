
$(document).ready(function () {
  $('[data-bs-toggle="tooltip"]').tooltip();
});

// Call the dataTables jQuery plugin
$(document).ready(function () {
  $('.dataTable').DataTable();
});

$('#myModal').on('shown.bs.modal', function () {
  $('#myInput').trigger('focus')
})
