<script>
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $('body').on('click','#assignTaxiBtn',function(){
            $('#assignTaxiModal').modal('show');
            $('#ModalTitle').html("Assign Taxi To:");


            data_id = $(this).attr('data_id');
            //console.log(data_id);
            $.get("{{route('drivers.index')}}" + '/' + data_id + '/edit', function(data){
                //console.log(data.name);
                $('#id').val(data.id);
                $('#name').val(data.name);

            });





        });


        $('#assignBtn').click(function(){
            $.ajax({
                data: $('#assignTaxiForm').serialize(),
                url: "{{route('drivers.store')}}",
                type: "POST",

                success: function(data){
                    $('#assignTaxiModal').modal('hide');
                    Swal.fire(
                    'Taxi has been assign!',
                    '',
                    'success'
                    )
                    setTimeout(function(){// wait for 5 secs
                    location.reload(); // then reload the page.
                    }, 1500); 
                },

                error: function(data){
                    console.log("Error", data);
                }
            });

        });

        $('body').on('click','#unassignBtn',function(){

            data_id = $(this).attr('data_id');
            taxi_status = 0;
            //console.log(data_id);
            Swal.fire({
            title: 'Are you sure?',
            text: "Unassign Taxi?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
            }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    url: "{{route('unassignTaxi')}}",
                    method: 'POST',
                    data: {id:data_id,status:taxi_status},
                    success:function(data){    
                        
                    }
                });

                Swal.fire(
                'Unassigned!',
                'Taxi has been unassigned.',
                'success'
                )

                setTimeout(function(){// wait for 5 secs
                    location.reload(); // then reload the page.
                    }, 1500); 
            }
            })
        });

        $(document).ready( function () {
            $('#drivers_tbl').DataTable();
        } );

        $(document).ready( function () {
            $('#nonDrivers-tbl').DataTable();
        } );

    });
</script>