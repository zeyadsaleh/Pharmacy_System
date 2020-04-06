<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>


<script>

$(document).ready(function () {
    $('#orders-table').DataTable({
          processing: true,
          serverSide: true,
          ajax: '{!! route('orders.index') !!}',
          columns: [
              {data: 'id', name: 'id'},
              {data: 'user_id', name: 'user_id'},
              {data: 'delivering_address', name: 'delivering_address'},
              {data: 'created_at', name: 'created_at'},
              {data: 'doctor_id', name: 'doctor_id'},
              {data: 'is_insured', name: 'is_insured'},
              {data: 'status', name: 'status'},
              {data: 'created_by', name: 'created_by'},
              {data: 'pharmacy_id', name: 'pharmacy_id'},
              {data: 'action', name: 'action'},
          ],
      });

      $('#medicine').on('keyup',function() {
            var query = $(this).val();
            $.ajax({
                url:'{!! route('orders.create') !!}',
                type: "GET",
                data: {'medicine':query},
                success: function (data) { $('#medicine_list').html(data)},
            });
        });

        $(document).on('click', 'span', function(){
            var value = $(this).text();
            $('#medicine').val(value);
            $('#medicine_list').html("");
        });
    });

 </script>


<script src="js/order.js"></script>
