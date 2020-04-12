<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>

<script>

if (!String(window.location.href).includes("orders/create")) {

  $(document).ready(function() {

  $.ajax({
      url: '{!! route('orders.index') !!}',
      success: function (data) {
        columnNames = Object.keys(data.data[0]);
        let columns = [];
        let count = 0;
        for (let colName of columnNames) {
          if(colName == 'status'){
            let flag = true;
                columns.push({
                  data: colName, name: colName,
                  render:function(data){
                    if(data == 'Processing'){
                      if(flag){
                          let html = document.getElementById('box');
                          let box = document.createElement("div");
                          box.style.opacity = "0.8";
                          box.classList='alert alert-warning alert-block text-center p-2 h5';
                          let body = `<button type="button" class="close" data-dismiss="alert">×</button><strong>Some 'New' Order is waiting to be assigned</strong>`;
                            box.innerHTML = body;
                            html.append(box)
                          flag = false;
                        }
                      return '<p class="text-center text-success p-1 h6 border border-success rounded">'+data+'</P>';
                  }else{
                    return '<p class="text-center p-1 h6"><b>'+data+'</b></P>';
                  }
                  }
                });
          }else{
                columns.push({data: colName, name: colName});
              }
        }
    $('#orders-table').DataTable({
          processing: true,
          serverSide: true,
          ajax: '{!! route('orders.index') !!}',
          order: [[ 8 ]],
          columns: columns,
        })
      }
    });
    });
}

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
