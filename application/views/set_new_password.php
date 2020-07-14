      <!--Header Start-->
      <?php include('inc/header.php') ?>
      <!--Header End-->
      
      <section class="login_body_sec">
         <div class="container-fluid">
            <div class="loginbdy_cls">
               <div class="log_logosec cmmn_title text-center">
                  <img src="<?php echo base_url('assets/images/logo.png') ?>" alt="" />
                  <h2 >Set New Password</h2>
               </div>
               <div class="log_formsec">
                  <form action="<?php echo base_url('ForgetPasswordController/insert_new_password_action/'.$user_id) ?>" name="password_reset" method="post">
                     <div class="row">
                        <div class="col-md-12">
                           <!-- <div class="form-group">
                              <label for="s">Enter Your Email*</label>
                              <input type="email" class="form-control" placeholder="info@gmail.com" name="email" autocomplete="off" required>
                           </div> -->
                           <div class="form-group amprel">
                              <label for="s">Enter Password*</label>
                              <input type="password" id="myInput" class="form-control"
                                 placeholder="**************" name="password"  passwordCheck="passwordCheck" autocomplete="off" required>
                              <img src="<?php echo base_url('assets/images/pass_icon.png') ?>" class="passtab" onclick="mypasstab()" alt="p" />
                              <small id="passwordHelpBlock" class="form-text text-muted text-danger">
                                    Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters.
                                </small>
                           </div>
                           <div class="form-group amprel">
                              <label for="s">Confirm Password*</label>
                              <input type="password" id="myInput" class="form-control"
                                 placeholder="**************" name="confirmPassword" autocomplete="off" required>
                              <img src="<?php echo base_url('assets/images/pass_icon.png') ?>" class="passtab" onclick="mypasstab()" alt="p" />
                           </div>
                           <!-- <div class="forgot_pass text-right">
                              <a href="javascript:void(0);">Forgot Password?</a>
                           </div> -->
                           <?php if($this->session->flashdata('error')): ?>
                           <div class="alert alert-danger text-center" role="alert">
                              <?php echo $this->session->flashdata('error'); ?>
                           </div>
                           <?php endif; ?>

                           <?php if($this->session->flashdata('success')): ?>
                           <div class="alert alert-success text-center" role="alert">
                              <?php echo $this->session->flashdata('success'); ?>
                           </div>
                           <?php endif; ?>
                           
                           <div class="pdng35 text-center logbtn936">
                              <button type="submit" class="btn btn-lg">Change Password</button>
                              <!-- <p>Don’t have an account? <a href="<?php echo base_url('signup') ?>">Sign Up</a></p> -->
                           </div>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </section>

      <?php include('inc/footer.php') ?>
      
      <?php include('inc/common_scripts.php') ?>


  
      <script type="text/javascript">
         function mypasstab() {
         
             var x = document.getElementById("myInput");
         
             if (x.type === "password") {
         
                 x.type = "text";
         
             } else {
         
                 x.type = "password";
         
             }
         
         }
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
         password: {
         required: true,
         minlength: 8
         },

         confirmPassword: {
         required: true,
         equalTo: "[name='password']",
         },
      },
      // Specify validation error messages
      messages: {
         password: {
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