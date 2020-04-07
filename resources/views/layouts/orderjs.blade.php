<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>


<script>

$(document).ready(function () {

  $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

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

      $('.medicine').select2({
          tags: true,
          theme: "classic",
      })

      $('.user').select2({
          tags: true,
          theme: "classic",
      })

      $('.type').select2({
          tags: true,
          theme: "classic",
      })

});

 </script>

 <script src="/js/order.js"></script>
