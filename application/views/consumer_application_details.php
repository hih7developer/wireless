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
                            <form id="app_form" action="<?php echo base_url('ApplicationController/application_status_change/'.$application->application_id) ?>" method="post">

                                <input type="hidden" name="application_id" value="<?php echo $application->application_id ?>">

                                <?php 
                                    switch ($application->status) {
                                        case 'incomplete':
                                            $status_class = 'warning';
                                        break;
                                        
                                        case 'rejected':
                                            $status_class = 'warning';
                                        break;
                                        
                                        case 'approved':
                                            $status_class = 'success';
                                            break;
                                            
                                        case 'cancelled':
                                            $status_class = 'danger';
                                            break;
                                            
                                        case 'pending':
                                            $status_class = 'primary';
                                            break;
                                    }
                                
                                ?>

                                
                                <div class="cmmn_title">
                                    <h2>Aplication Info</h2>
                                </div>

                                <div class="form-group">
                                    <label for="">Order Status:</label>
                                    <span class="badge badge-<?php echo $status_class ?>"><?php echo ucwords($application->status) ?></span>
                                </div>

                                <?php if(in_array($application->status, ['rejected', 'incomplete'])): ?>
                                <div class="alert alert-warning" role="alert">
                                    
                                    <?php $reasons = explode(',', $application->reason); ?>
                                    <ol style="margin: 0;">
                                        <li><strong>Please review this reasons and re-submit</strong></li>
                                        <?php foreach($reasons as $reason): ?>
                                            <li><?php echo $reason ?></li>
                                        <?php endforeach; ?>
                                    </ol>
                                </div>
                                <?php endif; ?>

                                <div class="form-group">
                                  <label for="">Plan Selected:</label>
                                  <input type="text" name="" id="" value="<?php echo $application->plan_name ?>" class="form-control" disabled>
                                </div>

                                <div class="form-group">
                                  <label for="">Provider:</label>
                                  <input type="text" name="" id="" value="<?php echo $application->service_provider_name ?>" class="form-control" disabled>
                                </div>

                                <div class="form-group">
                                  <label for="">State:</label>
                                  <input type="text" name="" id="" value="<?php echo $this->db->get_where('states', ['id' => $application->state_id])->row()->name ?>" class="form-control" disabled>
                                </div>

                                <div class="form-group">
                                  <label for="">Tribal Plan:</label>
                                  <input type="text" name="" id="" value="<?php echo $application->tribal_plan == 1 ? 'Yes' : 'No' ?>" class="form-control" disabled>
                                </div>
                                
                                

                                <?php if(in_array($application->status, ['approved'])): ?>

                                <div class="cmmn_title">
                                    <h2>Order Info</h2>
                                </div>

                                <div class="form-group">
                                  <label for="">Tracking Id:</label>
                                  <input type="text" name="" id="" value="<?php echo $application->track ?>" class="form-control" disabled>
                                </div>

                                <div class="form-group">
                                  <label for="">Contact No:</label>
                                  <input type="text" name="" id="" value="<?php echo $application->application_contact_no ?>" class="form-control" disabled>
                                </div>

                                <div class="form-group">
                                  <label for="">Device:</label>
                                  <input type="text" name="" id="" value="<?php echo $application->device ?>" class="form-control" disabled>
                                </div>
                                <?php endif; ?>

                                <div class="form-group">
                                    <?php if(!in_array($application->status, ['cancelled', 'approved'])): ?>
                                        <a class="btn btn-primary cancel_order_btn" href="<?php echo base_url('ApplicationController/cancel_order/'.$application->application_id) ?>" class="btn btn-primary">Cancel Order</a>
                                    <?php endif; ?>
                                    <a class="btn btn-primary" href="<?php echo base_url('consumer/applications') ?>" class="btn btn-primary">Back</a>
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

<?php if($this->session->flashdata('success')): ?>
<script>
Swal.fire(
    'Good job!',
    '<?php echo $this->session->flashdata('success') ?>',
    'success'
)
</script>
<?php endif; ?>


<script>
    $(document).on('click', '.cancel_order_btn', function(e){
        e.preventDefault();
        Swal.fire({
            title: 'Are you sure wnat to cancel?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            cancelButtonText: 'No',
            confirmButtonText: 'Yes, Cancel it!'
        }).then((result) => {
            if (result.value) {
                window.location.href = $('.cancel_order_btn').attr('href');
            }
        })
    })
</script>



</body>

</html>