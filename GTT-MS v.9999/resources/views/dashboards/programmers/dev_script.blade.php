<script>
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('body').on('click','#makeAdmin',function(){

            data_id = $(this).attr('data_id');
            role = 1;
            console.log(data_id);

            Swal.fire({
            title: 'Are you sure?',
            text: "Make user an Admin?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
            }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    url: "{{route('programmer.store')}}",
                    method: 'POST',
                    data: {id:data_id,role:role},
                    success:function(data){    
                        
                    }
                });

                Swal.fire(
                'Success',
                '',
                'success'
                )
            }
            })

        });



       

    });
</script>