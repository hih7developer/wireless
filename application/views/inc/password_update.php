<!-- Modal -->
<div class="modal fade" id="passwordUpdateModal" tabindex="-1" role="dialog" aria-labelledby="passwordUpdateModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
    <form id=update_password_form action="<?php echo base_url('UserController/update_password_consumer/'.$user->user_id) ?>" method="POST">
      <div class="modal-header">
        <h5 class="modal-title" id="passwordUpdateModalLabel">You can update password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

        <div class="alert alert-danger text-center" style="display: none;" role="alert">
            <strong>danger</strong>
        </div>

        <div class="form-group">
          <label for="">Old Password</label>
          <input type="password" name="prev_ps" id="" class="form-control" value="123456" placeholder="" aria-describedby="helpId" required>
          <small id="helpId" class="text-primary">Your default password is 123456</small>
        </div>

        <div class="form-group">
          <label for="">New Password</label>
          <input type="password" name="new_ps" id="" class="form-control" placeholder="Enter password" aria-describedby="helpId" required>
        </div>
        
        <div class="form-group">
          <label for="">Confirm Password</label>
          <input type="password" name="con_ps" id="" class="form-control" placeholder="Enter password" aria-describedby="helpId" required>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" class="btn btn-primary">Update</button>
      </div>
    </form>
    </div>
  </div>
</div>

<script>
    // setTimeout(() => {
    //     $('#passwordUpdateModal').modal('show');
    // }, 60000*5);

    // $(document).on('submit', '#update_password_form', function(e){

    //     e.preventDefault();

    //     var form = $(this).serialize();
    //     var url = $(this).attr('action');
    //     $.ajax({
    //         url: url,
    //         data: form,
    //         type: 'post',
    //         dataType: 'json',
    //         success:function(data){
    //             console.log(data);

    //             if(data.ps_error){
    //                 $('#update_password_form .alert strong').html(data.ps_error);
    //                 $('#update_password_form .alert').show();
    //                 setTimeout(() => {
    //                     $('#update_password_form .alert').hide();
    //                 }, 2000);
    //             } else {
    //                 $('#passwordUpdateModal').modal('hide');

    //                 Swal.fire(
    //                     'Good job!',
    //                     'Your password updated',
    //                     'success'
    //                 )
    //             }
    //         }
    //     });
    // });
</script>