<?php include('inc/header.php') ?>

<section class="dasboard_info">
    <div class="container-fluid">
        <div class="dashboard-tab-innr">
            <?php include('inc/dashboard_tab.php') ?>
            <div class="capa-outr">
                <div class="planinf">
                    <div class="plasec_one">Application Summery</div>
                </div>
                <div class="profile_info_sec">
                    <div class="personalinfo_sec">
                        <div class="col-md-12">
                            <form action="<?php echo base_url('ApplicationController/application_confirm_action/'.$plan_id) ?>" method="post" enctype="multipart/form-data" class="needs-validation" novalidate>


                                <div class="form-group">
                                  <label for="">Plan Selected:</label>
                                  <input type="text" name="plan_id" id="" value="<?php echo $plan->name ?>" class="form-control" disabled>
                                </div>

                                <div class="form-group">
                                  <label for="">Provider:</label>
                                  <input type="text" name="" id="" value="<?php echo $this->db->get_where('service_providers', ['user_id' => $plan->user_id])->row()->name ?>" class="form-control" disabled>
                                </div>

                                <div class="form-group">
                                  <label for="">State:</label>
                                  <input type="text" name="" id="" value="<?php echo $this->db->get_where('states', ['id' => $plan->state_id])->row()->name ?>" class="form-control" disabled>
                                </div>

                                <div class="form-group">
                                  <label for="">Tribal Plan:</label>
                                  <input type="text" name="" id="" value="<?php echo $plan->tribal_plan == 1 ? 'Yes' : 'No' ?>" class="form-control" disabled>
                                </div>



                                <?php
                                
                                  $household = json_decode($this->session->tempdata('household'));

                                  if($household->question_one == 'yes' && $household->question_two == 'yes' && $household->question_three == 'yes'){
                                    $household_eligibilty = 'You do not qualify for Lifeline because someone in your household already gets the benefit. You are only allowed to get one Lifeline discount per household, not per person.';
                                  } else if($household->question_one == 'no'){
                                    $household_eligibilty = 'You can apply for Lifeline. You live in a household that does not get Lifeline yet.';
                                  } else if($household->question_one == 'yes' && $household->question_two == 'no'){
                                    $household_eligibilty = 'You can apply for Lifeline. You live in a household that does not get Lifeline yet.';
                                  } else if($household->question_one == 'yes' && $household->question_two == 'yes' && $household->question_three == 'no'){
                                    $household_eligibilty = 'You can apply for Lifeline. You live at an address with more than one household and your household does not get Lifeline yet.';
                                  }

                                ?>


                                <div class="form-group">
                                  <label for="">Household:</label><br>
                                  <small class="text-muted"><?php echo $household_eligibilty ?></small>
                                </div>




                                <div class="form-group">
                                  <label for="">Proof Of Eligibility:</label>
                                  <input type="file" name="proof_of_eligibility" id="" class="form-control" accept="image/png, image/jpg, image/jpeg" required />
                                    <div class="invalid-feedback">
                                      Please select a file.
                                    </div>
                                    <small class="form-text text-muted">
                                        Only pdf or image file format can be accepted
                                    </small>
                                </div>
                                
                                <div class="form-group">
                                  <label for="">Photo Id:</label>
                                  <input type="file" name="photo_id" id="" class="form-control" accept="application/pdf" required />
                                    <div class="invalid-feedback">
                                        Please select a file.
                                    </div>
                                    <small class="form-text text-muted">
                                        Only pdf or image file format can be accepted
                                    </small>
                                </div>
                                
                                <div class="form-group">
                                  <label for="">Lifeline Certification:</label>
                                  <input type="file" name="lifeline_certification" id="" class="form-control" accept="application/pdf" required />
                                    <div class="invalid-feedback">
                                        Please select a file.
                                    </div>
                                    <small class="form-text text-muted">
                                        Only pdf or image file format can be accepted
                                    </small>
                                </div>
                                
                                <div class="form-group">
                                  <label for="">Household Worksheet:</label>
                                  <input type="file" name="household_worksheet" id="" class="form-control" accept="application/pdf" required />
                                    <div class="invalid-feedback">
                                        Please select a file.
                                    </div>
                                    <small class="form-text text-muted">
                                        Only pdf or image file format can be accepted
                                    </small>
                                </div>
                                
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Upload</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?php include('inc/footer.php') ?>


<?php include('inc/common_scripts.php') ?>



<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
            
        }
        form.classList.add('was-validated');
        if($(".invalid-feedback:visible").length > 0){
            $([document.documentElement, document.body]).animate({
                scrollTop: $(".invalid-feedback:visible").offset().top - 75
            }, 750);
        }
      }, false);
    });
  }, false);
})();
</script>


</body>

</html>