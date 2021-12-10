<script>
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });



        $('body').on('click','#addTaxi',function(){
            $("#addTaxiForm")[0].reset();
            $('#addTaxiModal').modal('show');
            $('#ModalTitle').html("Add Taxi");

        

        });

        $('#SaveButton').click(function(){
            $.ajax({
                data: $('#addTaxiForm').serialize(),
                url: "{{route('taxi.store')}}",
                type: "POST",

                success: function(data){
                    $('#addTaxiModal').modal('hide');
                    Swal.fire({
                    icon: 'success',
                    title: 'Taxi has been saved',
                    })

                    setTimeout(function(){// wait for 5 secs
                    location.reload(); // then reload the page.
                    }, 1500); 
                    
                },

                error: function(data){
                    console.log("Error", data);
                }
            });

        });

        $('body').on('click','#editTaxiBtn',function(){
            $('#addTaxiModal').modal('show');
            $('#ModalTitle').html("Edit Taxi");

            data_id = $(this).attr('data_id');
            //console.log(data_id);
            $.get("{{route('taxi.index')}}" + '/' + data_id + '/edit', function(data){
                $('#id').val(data.id);
                $('#model').val(data.model);
                $('#plate_number').val(data.plate_number);
                $('#boundary').val(data.boundary);
                

            });

        });

        $(document).ready( function () {
            $('#taxi_tbl').DataTable();
        } );


        $('body').on('click','#deleteTaxiBtn',function(){

            id = $(this).attr('data_id');

            var token = $("meta[name='csrf-token']").attr("content");

            Swal.fire({
            title: 'Are you sure?',
            text: "Delete Taxi?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes'
            }).then((result) => {
            if (result.isConfirmed) {

                $.ajax({
                    url: "{{route('taxi.index')}}" + '/' + id ,
                    type: 'DELETE',

                    success:function(data){    
                        
                    }
                });

                Swal.fire(
                'Deleted!',
                'Taxi has been deleted.',
                'success'
                )

                setTimeout(function(){// wait for 5 secs
                    location.reload(); // then reload the page.
                    }, 1500); 
            }
            })


        });

    });
</script>