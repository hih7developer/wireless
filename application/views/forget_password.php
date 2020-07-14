      <!--Header Start-->
      <?php include('inc/header.php') ?>
      <!--Header End-->
      

      <section class="login_body_sec">
         <div class="container-fluid">
            <div class="loginbdy_cls">
               <div class="log_logosec cmmn_title text-center">
                  <img src="<?php echo base_url('assets/images/logo.png') ?>" alt="" />
                  <h2>Forget Password</h2>
               </div>
               <div class="log_formsec">
                  <form action="<?php echo base_url('ForgetPasswordController/email_check/') ?>" method="post">
                     <div class="row">
                        <div class="col-md-12">
                           <div class="form-group">
                              <label for="s">Enter Your Email*</label>
                              <input type="email" class="form-control" placeholder="info@gmail.com" name="email" autocomplete="off" required>
                           </div>
                           <!-- <div class="form-group amprel">
                              <label for="s">Password*</label>
                              <input type="password" id="myInput" class="form-control"
                                 placeholder="**************" name="user[password]" autocomplete="off" required>
                              <img src="<?php echo base_url('assets/images/pass_icon.png') ?>" class="passtab" onclick="mypasstab()" alt="p" />
                           </div> -->
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
                              <button type="submit" class="btn btn-lg">Send OTP</button>
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


   </body>
</html>