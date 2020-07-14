<?php include('inc/header.php') ?>
<section class="dasboard_info">
   <div class="container-fluid">
      <div class="dashboard-tab-innr">
         <?php include('inc/dashboard_tab.php') ?>
         <div class="capa-outr">
            <div class="planinf">
               <div class="plasec_one">Admin Profile</div>
            </div>
            <div class="profile_info_sec">
               <div class="personalinfo_sec">
                  <form action="<?php echo base_url('UserController/admin_update/'.$user->user_id) ?>" method="POST"
                     autocomplete="off" enctype="multipart/form-data" class="needs-validation" novalidate>
                     <div class="personalinfo_form cmmn_title">
                        <h2>Personal Info</h2>
                        <!-- Sec 1 -->
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group user">
                                 <label for="s">Name*</label>
                                 <input type="text" name="user[name]" class="form-control"
                                    placeholder="Type name here"  value="<?php echo $user->name ?>" required/>
                                    <div class="invalid-feedback">
                                       Please enter a name.
                                    </div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="s">Email*</label>
                                 <input type="email" name="user[email]" class="form-control"
                                    placeholder="info@gmail.com" autocomplete="no" value="<?php echo $user->email ?>" required />
                                 <div class="invalid-feedback">
                                       Please enter an email.
                                 </div>
                              </div>
                           </div>
                        </div>
                 

                        <!-- Sec 5 -->
                        <div class="pdng35 text-left">
                           <button type="submit" class="btn btn-primary">Update Profile</button>
                           <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                     </div>
                  </form>

                  <hr>
             
               </div>
               <div class="passchange_sec">
                  <div class="cmmn_title">
                     <h2>Change Password</h2>
                  </div>
                  <form action="<?php echo base_url('UserController/upload_password/'.$user->user_id) ?>" name="password_reset" method="POST" >
                     <?php if($this->session->flashdata('ps_error')): ?>
                     <div class="alert alert-danger text-center" style="font-size: 14px;" role="alert">
                        <?php echo $this->session->flashdata('ps_error') ?>
                     </div>
                     <?php endif; ?>
                     <div class="form-group">
                        <input type="password" class="form-control" name="prev_ps" placeholder="Current Password*" required />
                     </div>
                     <div class="form-group">
                        <input type="password" class="form-control" name="new_ps" passwordCheck="passwordCheck" placeholder="New Password*" required />
                        <small id="passwordHelpBlock" class="form-text text-muted text-danger">
                           Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters.
                        </small>
                     </div>
                     <div class="form-group">
                        <input type="password" class="form-control" name="con_ps" placeholder="Confirm Password*" required />
                     </div>
                     <button type="submit" class="btn">Update</button>
                  </form>
           
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<?php include('inc/footer.php') ?>
<!-- Modal -->



<?php include('inc/common_scripts.php') ?>
<script src="<?php echo base_url('assets/js/card.js') ?>"></script>

<?php if($this->session->flashdata('success')): ?>
<script>
   Swal.fire(
       'Good job!',
       '<?php echo $this->session->flashdata('success') ?>',
       'success'
   )
</script>
<?php endif; ?>

<?php if($this->session->flashdata('error')): ?>
<script>
   Swal.fire(
       "Error",
       "<?php echo $this->session->flashdata("error") ?>",
       "error"
   )
</script>
<?php endif; ?>




<script>
    $("input[name='user[email]']").focusout(function(){
        var email = $(this).val();
        if(email != ''){
            $.ajax({
                url: '<?php echo base_url('UserController/email_check/'.$user->user_id) ?>',
                data: {'email' : email},
                type: 'post',
                dataType: 'json',
                success:function(data){
                    if(data.error){
                       
                        Swal.fire({
                            title: "Warning",
                            text: "Email ("+email+") already exist please try another one!",
                            icon: 'warning',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            if (result.value) {
                                $("input[name='user[email]']").val('');
                            }
                        })
                    }
                }
            });
        }
    });
</script>

<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/additional-methods.min.js"></script>
<script>
// Wait for the DOM to be ready
$(function() {
  // Initialize form validation on the registration form.
  // It has the name attribute "registration"
  jQuery.validator.addMethod("passwordCheck",
    function(value, element, param) {
        if (this.optional(element)) {
            return true;
        } else if (!/[A-Z]/.test(value)) {
            return false;
        } else if (!/[a-z]/.test(value)) {
            return false;
        } else if (!/[0-9]/.test(value)) {
            return false;
        } else if (!/[!@#$%^&*()_=\[\]{};':"\\|,.<>\/?+-]/.test(value)) {
            return false;
        }

        return true;
    },
    "error msg here");
  $("form[name='password_reset']").validate({
    errorClass: 'form-text text-danger',
    errorElement: 'small',
    // Specify validation rules
    rules: {
      prev_ps: {
        required: true,
      },
     
      new_ps: {
        required: true,
        minlength: 8
      },

      con_ps: {
        required: true,
        equalTo: "[name='new_ps']",
      },
    },
    // Specify validation error messages
    messages: {
      new_ps: {
        required: "Please provide a password",
        minlength: "Your password must be at least 8 characters long",
        passwordCheck: "Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters."
      },
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
      form.submit();
    }
  });
});
</script>


</body>
</html>