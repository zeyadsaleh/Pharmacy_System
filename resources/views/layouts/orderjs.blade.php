<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>


<script>

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
function deleteOrder(id) {

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.value) {
                $.ajax({
                    type: "post",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "_method": "DELETE"
                    },
                    url: "{{ url('') }}" + "/orders/"+id,
                    success: function (data) {
                        var table = $('#orders-table').dataTable(); 
                        table.fnDraw(false);
                        Swal.fire(
                            'Deleted!',
                            'Your record has been deleted.',
                            'success'
                        )
                    },
                    error: function (data) {
                        console.log('Error:', data);
                        Swal.fire(
                            'Not Deleted!',
                            'Your record can\'t be deleted',
                            'error'
                        )
                    }
                });
        }
    })
}
 </script>
