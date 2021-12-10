<script>
    $(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('body').on('click','#editProfileBtn',function(){
            $('#editProfileModal').modal('show');
            $('#ModalTitle').html("Edit Profile");

            data_id = $(this).attr('data_id');
            //console.log(data_id);

            $.get("{{route('users.index')}}" + '/' + data_id + '/edit', function(data){
                console.log(data.id);
                $('#id').val(data.id);
                $('#drivers_license').val(data.drivers_license);
                $('#mobile_number').val(data.mobile_number);
                $('#address').val(data.address);

            });

        });

        $('#UpdateProfileBtn').click(function(){
            $.ajax({
                data: $('#editProfileForm').serialize(),
                url: "{{route('users.store')}}",
                type: "POST",

                success: function(data){
                    $('#editProfileModal').modal('hide');
                    //location.reload(true);
                    Swal.fire(
                    'Profile has been updated!',
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



        $('#changePasswordAdminForm').on('submit', function(e){
         e.preventDefault();
         $.ajax({
            url:$(this).attr('action'),
            method:$(this).attr('method'),
            data:new FormData(this),
            processData:false,
            dataType:'json',
            contentType:false,
            beforeSend:function(){
              $(document).find('span.error-text').text('');
            },
            success:function(data){
              if(data.status == 0){
                $.each(data.error, function(prefix, val){
                  $('span.'+prefix+'_error').text(val[0]);
                });
              }else{
                $('#changePasswordAdminForm')[0].reset();
                Swal.fire(
                'Success!',
                data.msg,
                'success'
                )
                //alert(data.msg);
              }
            }
         });
    });



    $('#changePasswordUserForm').on('submit', function(e){
         e.preventDefault();
         $.ajax({
            url:$(this).attr('action'),
            method:$(this).attr('method'),
            data:new FormData(this),
            processData:false,
            dataType:'json',
            contentType:false,
            beforeSend:function(){
              $(document).find('span.error-text').text('');
            },
            success:function(data){
              if(data.status == 0){
                $.each(data.error, function(prefix, val){
                  $('span.'+prefix+'_error').text(val[0]);
                });
              }else{
                $('#changePasswordUserForm')[0].reset();
                Swal.fire(
                'Success!',
                data.msg,
                'success'
                )
                //alert(data.msg);
              }
            }
         });
    });


       

    });
</script>