      <!--Header Start-->
      <?php include('inc/header.php') ?>
      <!--Header End-->

      <section class="login_body_sec">
          <div class="container-fluid">
              <div class="loginbdy_cls">
                  <div class="log_logosec cmmn_title text-center">
                      <img src="<?php echo base_url('assets/images/logo.png') ?>" alt="" />
                      <h2>Sign Up</h2>
                  </div>
                  <div class="log_formsec">
                      <form action="<?php echo base_url('UserController/add_consumer_action') ?>" method="post">
                          <div class="row">
                              <div class="col-md-12">

                                <?php if($this->session->flashdata('error')): ?>
                                <div class="alert alert-danger text-center" role="alert">
                                    <strong><?php echo $this->session->flashdata('error') ?></strong>
                                </div>
                                <?php endif ?>

                                  <div class="form-group">
                                      <label for="s">Email*</label>
                                      <input type="email" class="form-control" placeholder="info@gmail.com"
                                          name="user[email]" autocomplete="off" required>
                                  </div>

                                  <div class="form-group">
                                      <label for="s">State*</label>
                                      <select name="state_id" required>
                                          <option>Select a state</option>
                                          <?php foreach($service_provider_states as $key): ?>
                                          <option value="<?php echo $key->id ?>"><?php echo $key->name ?></option>
                                          <?php endforeach; ?>
                                      </select>
                                  </div>

                                  <div class="form-group">
                                      <label for="s">Zip Code*</label>
                                      <input type="text" class="form-control" placeholder="Zip Code"
                                          name="zip" autocomplete="off" maxlength="6" onkeypress='validate(event)' required>
                                  </div>

                                  <div class="pdng35 text-center logbtn936">
                                      <button type="submit" class="btn btn-lg">Search</button>
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