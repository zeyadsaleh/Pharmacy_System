var delBtn = document.querySelectorAll(".del");

console.log(delBtn);

delBtn.forEach((v,i)=> {
  v.addEventListener("click", () => {
    let index = i;
    myFunction;
})
});

function myFunction() {
  var ans = confirm("Do you want to Delete it?");
  if(ans){
    document.getElementById("delet").submit();
}};

console.log("hello");

    $(document).ready(function () {
      $('#medicine').on('keyup',function() {
            var query = $(this).val();
            $.ajax({
                url:'{!! route('orders.create') !!}',
                type:"GET",
                data:{'medicine':query},
                success:function (data) {
                    $('#medicine_list').html(data);
                }
            })
        });

        $(document).on('click', 'li', function(){
            var value = $(this).text();
            $('#medicine').val(value);
            $('#medicine_list').html("");
        });
    });
