<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>


<script>
    $(document).ready(function() {

if (!String(window.location.href).includes("orders/create")) {

$(function () {

  $.ajax({
      url: '{!! route('orders.index') !!}',
      success: function (data) {
        columnNames = Object.keys(data.data[0]);
        let columns = [];
        for (let colName of columnNames) {
                columns.push({data: colName, name: colName});
        }
    $('#orders-table').DataTable({
          processing: true,
          serverSide: true,
          ajax: '{!! route('orders.index') !!}',
          columns: columns,
        })
      }
    });
    });

}else{
  $(function () {

      $('.medicine').select2({
          tags: true,
          theme: "classic",
          maximumSelectionLength: 5,
      })

      $('.user').select2({
          theme: "classic",
          maximumSelectionLength: 5,
      })

      $('.type').select2({
          theme: "classic",
          maximumSelectionLength: 5,
      })
});
}
 </script>
