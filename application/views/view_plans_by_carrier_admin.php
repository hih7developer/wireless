
                          
 <!--Header Start-->
    <?php include('inc/header.php') ?>
    <!--Header End-->


    <section class="dasboard_info">
        <div class="container-fluid">
            <div class="dashboard-tab-innr">
                <?php include('inc/dashboard_tab.php') ?>

                <div class="capa-outr">
                    <div class="row mt-5">
                        <div class="col-md-12">
                            <!-- <a class="btn" href="<?php echo base_url('carrier_admin/create') ?>">Add Carrier Admin</a> -->
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-12" id="plan_table_otr">
                            <table class="table">
                          
                                <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>voice</th>
                                    <th>Sms</th>
                                    <th>Data</th>
                                    <th>Initial Price</th>
                                    <th>Monthly Price</th>
                                    <th>Service Type</th>
                                    <th>State</th>
                                    <th>Lifeline Service</th>
                                    <th>Tribal Plan</th>
                                    <th>Handset Name</th>
                                    <th>Description</th>
                                </tr>
                                </thead>
                                <tbody>
                                  <?php foreach($fetch_plan as $key):?>
                                  <tr>
                                  <td><?php echo $key->name ?></td>
                                  <td><?php echo $key->voice ?></td>
                                  <td><?php echo $key->sms ?></td>
                                  <td><?php echo $key->data ?></td>
                                  <td><?php echo $key->initial_price ?></td>
                                  <td><?php echo $key->monthly_price ?></td>
                                  <td><?php echo $key->service ?></td>
                                  <td><?php echo $key->state ?></td>
                                  <td><?php echo $key->lifeline_service ?></td>
                                  <td><?php echo $key->tribal_plan ?></td>
                                  <td><?php echo $key->handset_name ?></td>
                                  <td><?php echo $key->description ?></td>
                                  </tr>
                                  <?php endforeach;?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include('inc/footer.php') ?>