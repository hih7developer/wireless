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
                            <form action="<?php echo base_url('ApplicationController/application_confirm_action/'.$plan_id) ?>" method="post" enctype="multipart/form-data">

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

                                  // $household = json_decode($this->session->tempdata('household'));
                                  
                                  // if($household->question_one == 'yes' && $household->question_two == 'yes' && $household->question_three == 'yes'){
                                  //   $household_eligibilty = 'You do not qualify for Lifeline because someone in your household already gets the benefit. You are only allowed to get one Lifeline discount per household, not per person.';
                                  // } else if($household->question_one == 'no'){
                                  //   $household_eligibilty = 'You can apply for Lifeline. You live in a household that does not get Lifeline yet.';
                                  // } else if($household->question_one == 'yes' && $household->question_two == 'no'){
                                  //   $household_eligibilty = 'You can apply for Lifeline. You live in a household that does not get Lifeline yet.';
                                  // } else if($household->question_one == 'yes' && $household->question_two == 'yes' && $household->question_three == 'no'){
                                  //   $household_eligibilty = 'You can apply for Lifeline. You live at an address with more than one household and your household does not get Lifeline yet.';
                                  // }

                                ?>


                                <!-- <div class="form-group">
                                  <label for="">Household:</label><br>
                                  <small class="text-muted"><?php echo $household_eligibilty ?></small>
                                </div> -->



                                <div class="form-group">
                                  <label for="">Nv Status:</label>
                                  <input type="text" name="" id="" value="<?php echo ucwords(strtolower($nv_success['status'])); ?>" class="form-control" disabled>
                                </div>
                                
                                <div class="form-group">
                                  <label for="">Nv Eligibility Check Id:</label>
                                  <input type="text" name="" id="" value="<?php echo $nv_success['eligibilityCheckId']; ?>" class="form-control" disabled>
                                </div>
                                
                                <div class="form-group">
                                  <label for="">Nv Eligibility Expiration Date:</label>
                                  <input type="text" name="" id="" value="<?php echo $nv_success['eligibilityExpirationDate']; ?>" class="form-control" disabled>
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
                                

                                <input type="hidden" name="nv_response" value='<?php echo json_encode($nv_success) ?>'>

                                
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">Confirm To Aplly</button>
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



</body>

</html>