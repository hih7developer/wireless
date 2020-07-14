<?php include('inc/header.php') ?>


<section class="dasboard_info">
    <div class="container-fluid">
        <div class="dashboard-tab-innr">

            <?php include('inc/dashboard_tab.php') ?>

            <div class="capa-outr">
                <div class="planinf">
                    <!-- <div class="plasec_one">Edit Plan</div> -->
                </div>
                    <link rel="stylesheet" href="assests/css/custom.css">
                <div class="profile_info_sec">
                    <div class="personalinfo_sec">
                        <div class="personalinfo_form cmmn_title">
                            <h2>Add state</h2>
                            <form action="<?php echo base_url('PlanController/add_service_provider_state/') ?>" method="POST" autocomplete="off">
                            <div class="row">

                                <?php if($this->session->flashdata('error')):  ?>
                                <div class="col-md-12">
                                    <div class="alert alert-danger" role="alert">
                                        <?php echo $this->session->flashdata('error'); ?>
                                    </div>    
                                </div>
                                <?php endif;  ?>
                                
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for="s">State*</label>
                                        <select name="service_provider_state[state_id]" required>
                                            <option>Select a state</option>
                                            <?php foreach($service_provider_filtered_states as $key): ?>
                                            <option value="<?php echo $key->id ?>"><?php echo $key->name ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="s">Sac*</label>
                                        <input type="number" name="service_provider_state[sac]" class="form-control" placeholder="Enter sac here" required />
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <button class="btn">Add</button>
                                    </div>
                                </div>

                            </div>
                            </form>

                            <hr>

                            <h2>States List</h2>

                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table">
                                        <thead>
                                            <th>#</th>
                                            <th>State</th>
                                            <th>Sac</th>
                                            <th class="text-center">Action</th>
                                        </thead>
                                        <tbody class="tbody tr td:last-child">
                                            <?php $i = 1; foreach($service_provider_states as $key): ?>
                                            <tr>
                                                <td><?php echo $i ?></td>
                                                <td><?php echo $key->name ?></td>
                                                <td><?php echo $key->sac ?></td>
                                                <td style="text-align: center">
                                                <div class="btn-group" >
                                                   <button value="<?php echo $key->service_provider_state_id ?>" class="btn edit_sac_no" data-toggle="modal" data-target="#edit_sac_no_modal"><em><i class="fa fa-pencil-square-o"></i></em> Edit</button> 
                                                   <button class="btn btn-info delete_plan_btn" data-state="<?php echo $key->state_id ?>" data-href= "<?php echo base_url('LifelineController/delete/'.$key->service_provider_state_id)?>"><i class="fa fa-trash-o"></i>Delete</button>
                                                </div>
                                                </td>
                                                
                                            </tr>
                                            <?php $i++; endforeach; ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="passchange_sec" id="nlad_verification_div">
                        <div class="cmmn_title">
                            <h2>Nlad Verification</h2>
                        </div>
                        <form id="nlad_form" action="<?php echo base_url('NladController/update_nlad_cred') ?>" method="POST">
                            <div class="form-group">
                              <input type="text" name="nlad_username" value="<?php echo $service_provider->nlad_username ?>" id="" class="form-control" placeholder="Nlad Usename" aria-describedby="helpId">
                            </div>
                            <div class="form-group">
                              <input type="password" name="nlad_password" value="<?php echo $service_provider->nlad_password ?>" id="" class="form-control" placeholder="Nlad Password" aria-describedby="helpId">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary btn-sm">Update</button>
                                <a href="<?php echo base_url('NladController/verify_check') ?>" class="btn btn-primary btn-sm">Verify</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<!-- -------------------------------------------------MOdal-------------------------------------- -->

    <!-- Modal -->
    <div class="modal fade" id="edit_sac_no_modal" tabindex="-1" role="dialog" aria-labelledby="edit_sac_no_modal_label"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
        <form  id="edit_sac_no_form">
        <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="edit_carrier_user_modal_label">Edit Sac Number</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                      <label for="">Sac No</label>
                      <input type="text" name="service_provider_state[sac]" id="" class="form-control" placeholder="Enter Sac No">
                    </div>
                    
                    <input type="hidden" id="hidden_id">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary"  id="carrier_user_edit_form">Save</button>
                </div>
            </div>
        </div>
    </div>
    </form>






<?php include('inc/footer.php') ?>

<?php include('inc/common_scripts.php') ?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet" href="https://raw.githack.com/ttskch/select2-bootstrap4-theme/master/dist/select2-bootstrap4.css">
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script>
    // $.fn.select2.defaults.set("theme", "bootstrap");
    $('#select_state').select2({
        placeholder: "Select a state",
        theme: 'bootstrap4'
    });
</script>


<?php if($this->session->flashdata('success')): ?>
<script>
Swal.fire(
    'Good job!',
    '<?php echo $this->session->flashdata('success') ?>',
    'success'
)
</script>
<?php endif; ?>

<?php if($this->session->flashdata('nlad_error')): ?>
<script>
Swal.fire(
    'Good job!',
    '<?php echo $this->session->flashdata('nlad_error') ?>',
    'error'
)
</script>
<?php endif; ?>

<script>
      
      $(document).on('click', '.edit_sac_no', function(){
            var user_id = $(this).val();
            $('#hidden_id').val(user_id);
            $.ajax({
               url: "<?php echo base_url('LifelineController/edit_sac_number/') ?>",
               type: 'POST',
               data: {'service_provider_state_id': user_id},
               dataType: 'json',
               success:function(response){
                  console.log(response);
                  $('input[name="service_provider_state[sac]"]').val(response.sac);
                }
            });
               
        })

    </script>

<script>
        $(document).on('submit', '#edit_sac_no_form', function(e){
            e.preventDefault();
            // var user_id = $(this).val();
            var form = $('#edit_sac_no_form').serialize();
            var user_id = $('#hidden_id').val();

            // alert(user_id);
         
            $.ajax({
                url: "<?php echo base_url('LifelineController/edit_sac_number_action/') ?>"+user_id,
                type: 'POST',
                data: form,
                success:function(data){
                $('#edit_sac_no_form').trigger("");
                Swal.fire({
                    icon: 'success',
                    title: 'Update Successful',
                    showConfirmButton: false,
                    timer: 1500
                });
                setTimeout(function() {
                    location.reload();
                }, 1000);
               
               }
            });
               
        })
    </script>


<script>
        $(document).on('click', '.delete_plan_btn', function() {
            var state = $(this).data('state');
            var href = $(this).data('href');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    // window.location.href = $(this).data('href');
                    $.ajax({
                        url: '<?php echo base_url('LifelineController/plan_check_by_state') ?>',
                        data: {'state' : state},
                        type: 'post',
                        dataType: 'json',
                        success:function(data){
                            if(data.exist){
                                Swal.fire({
                                    title: 'Are you sure?',
                                    text: "There are plans in this state, if you delete it will effect those plans",
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#3085d6',
                                    cancelButtonColor: '#d33',
                                    confirmButtonText: 'Yes, delete it!'
                                }).then((result) => {
                                    if (result.value) {
                                        window.location.href = href;
                                        // alert('check_good');
                                    }
                                })
                            } else{
                                // alert('check');
                                window.location.href = href;
                            }
                        }
                    });
                }
            })
        });
            </script>

</body>

</html>