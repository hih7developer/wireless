<?php include('inc/header.php') ?>

<section class="dasboard_info">
    <div class="container-fluid">
        <div class="dashboard-tab-innr">

            <?php include('inc/dashboard_tab.php') ?>
            <div class="capa-outr">
                <div class="planinf">
                    <div class="plasec_one">View Settings Details</div>

                </div>
                <div class="profile_info_sec">
                    <div class="personalinfo_sec">
                        <div class="personalinfo_form cmmn_title">
                            <h2>Settings</h2>
                            <!-- Sec 1 -->
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Value</th>
                                                <th>Label</th>
                                                <th style="text-align: center">Acton</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php foreach($settings as $key) : ?>
                                            <tr>
                                                <td><?php echo $key->label ?></td>
                                                <td><?php echo $key->name ?></td>
                                                <td><?php echo $key->value ?></td>
                                                <td style="text-align: center">
                                                    <div class="btn-group">
                                                        <button class="btn btn-info edit_carrier_admin" value="<?php echo $key->setting_id ?>"  data-toggle="modal" data-target="#edit_carrier_user_modal"><em><i class="fa fa-pencil-square-o"></i></em>Edit</button>
                                                        <!-- <button class="btn btn-info delete_plan_btn" data-href="<?php echo base_url("DefaultController/delete/".$key->setting_id)?>" ><i class="fa fa-trash-o"></i> Delete</button> -->
                                                    </div>                                                
                                                </td>                                         
                                            </tr>
                                          <?php endforeach ;?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="passchange_sec">
                      <div class="cmmn_title">
                        <h2>Upload Files</h2>
                        <!-- <div class="row"> -->
                        <form action="defaultController/setting_page_insert" method="POST">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="name">Label</label>
                                                <input type="text" class="form-control" placeholder="Enter Label"
                                                    name="setting[label]"/>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" class="form-control" placeholder="Enter Name"
                                                    name="setting[name]"/>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="name">Value</label>
                                                <input type="text" class="form-control" placeholder="Enter Value"
                                                    name="setting[value]"/>
                                            </div>
                                        </div>
                                        
                                        <button type="submit" class="btn">Update</button>
                                        <!-- <button type="submit" class="btn">Update</button> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </section>

<?php include('inc/footer.php') ?>

<!-- Modal -->
<div class="modal fade" id="edit_carrier_user_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="edit_setting_form" method='post'>
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Settings</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
    
                    <div class="form-group">
                        <label for="name">Label</label>
                        <input type="text" class="form-control" placeholder="Enter Label" name="setting[label]"
                            id="label" />
                    </div>
                    
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control" placeholder="Enter Name" name="setting[name]"
                            id="name" />
                    </div>
                    
                    <div class="form-group">
                        <label for="name">Value</label>
                        <input type="text" class="form-control" placeholder="Enter Value" name="setting[value]"
                            id="value" />
                    </div>
                </div>

                <input type="hidden" name="setting_id" id="hidden_id">
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="edit_setting_form">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>

<?php include('inc/common_scripts.php') ?>

<script>
$(document).on('click','.edit_carrier_admin',function(){
    var setting_id = $(this).val();
    // $('#hidden_id').val(setting_id);
    // alert(setting_id);
    $.ajax({
        url:"<?php echo base_url('DefaultController/update_view_setting_page/')?>",
        type:"post",
        data : {'setting_id' : setting_id},
        dataType : 'json',
        success: function(response){
            console.log(response);
            $('#name').val(response.name);
            $('#value').val(response.value);
            $('#label').val(response.label);
            $('#hidden_id').val(response.setting_id);
            $('#edit_setting_form').attr('action', '<?php echo base_url("DefaultController/update_view_setting_page_action/") ?>'+response.setting_id);
        }
    });

})
</script>

<script>
$(document).on('click','.delete_plan_btn',function(){
    swal.fire({
        title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
              }).then((result)=>{
                  if(result.value){
                      window.location.href = $(this).data('href');
                  }
              })
          });

</script>
</body>

</html>
