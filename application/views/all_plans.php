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
                     <div class="col-md-12">
                         <table class="table" id="plan_table">
                             <thead>
                                 <tr>
                                     <th>Service Provider</th>
                                     <th>Plan Name</th>
                                     <th>Details</th>
                                     <th>Initial Price</th>
                                     <th>Monthly Price</th>
                                     <th>Service Type</th>
                                     <th>State</th>
                                     <!-- <th>Lifeline Service</th>
                                    <th>Tribal Plan</th> -->
                                     <th>Handset Name</th>
                                     <th>Description</th>
                                 </tr>
                             </thead>
                             <tbody>

                                 <?php foreach($plans as $key):?>
                                 <tr>
                                     <td><?php echo $key->service_provider?></td>
                                     <td><?php echo $key->name ?></td>
                                     <td>
                                         <b>Voice:</b> <?php echo $key->voice ?><br>
                                         <b>Sms:</b> <?php echo $key->sms ?><br>
                                         <b>Data:</b> <?php echo $key->data ?>
                                     </td>
                                     <td><?php echo $key->initial_price?></td>
                                     <td><?php echo $key->monthly_price?></td>
                                     <td><?php echo $key->service_type?></td>
                                     <td><?php echo $key->states_name?></td>
                                     <td><?php echo $key->handset_name?></td>
                                     <td><?php echo $key->description?></td>

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


 <?php include('inc/common_scripts.php') ?>

 <script>
$(document).ready(function() {
    $('#plan_table').DataTable();
});
 </script>

 </body>

 </html>