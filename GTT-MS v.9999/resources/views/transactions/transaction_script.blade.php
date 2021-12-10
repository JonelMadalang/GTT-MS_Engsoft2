<script>
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $(document).on('click','#editData',function(){
            console.log("asdsa");

        });

        $('body').on('click','#updateStatsBtn',function(){
            $('#updateModal').modal('show');
            $('#ModalTitle').html("Update Status");

            data_id = $(this).attr('data_id');
            //console.log(data_id);

            $.get("{{route('transactions.index')}}" + '/' + data_id + '/edit', function(data){
                //console.log(data.status);
                $('#id').val(data.id);
                $('#status').val(data.status);
                $('#remarks').val(data.remarks);

            });

        });

        $('#saveUpdate').click(function(){
            $.ajax({
                data: $('#statusForm').serialize(),
                url: "{{route('transactions.store')}}",
                type: "POST",

                success: function(data){
                    $('#updateModal').modal('hide');
                    Swal.fire({
                    icon: 'success',
                    title: 'Transaction has been updated',
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

        $(document).ready( function () {
            $('#transaction-tbl').DataTable();
        } );


        $(document).ready( function () {
            $('#user_transac_tbl').DataTable();
        } );

        $(document).ready( function () {
            $('#user_bonds').DataTable();
        } );



        // $(document).on('click','#saveUserTransac',function(){
            
        //     $.ajax({
        //         data: $('#userTransacForm').serialize(),
        //         url: "{{route('userTransactions.store')}}",
        //         type: "POST",

        //         success: function(data){
        //             Swal.fire({
        //             icon: 'success',
        //             title: 'Transaction has been updated',
        //             })

        //             setTimeout(function(){// wait for 5 secs
        //             location.reload(); // then reload the page.
        //             }, 1500); 
        //         },

        //         error: function(data){
        //             console.log("Error", data);
        //         }
        //     });

        // });


        


       

        
    });
</script>