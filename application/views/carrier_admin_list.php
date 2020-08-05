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
                            <a class="btn" href="<?php echo base_url('carrier_admin/create') ?>">Add Carrier Admin</a>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-12">
                            <table class="table" id="carrier_admin_table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Service Provider</th>
                                        <th>Total Plan</th>
                                        <th>Created At</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($carrier_admins as $key) : ?>
                                    <tr>
                                        <td scope="row"><a class="cstm_link"
                                                href="<?php echo base_url('carrier_admin/details/' . $key->user_id) ?>"><?php echo $key->user_name ?></a>
                                        </td>
                                        <td><?php echo $key->user_email ?></td>
                                        <td><?php echo $key->name ?></td>
                                        <td class="text-center"><a class="cstm_link"
                                                href="<?php echo base_url('plans/' . $key->user_id) ?>"><?php echo $this->plan->get_plan_count($key->user_id); ?></a>
                                        </td>
                                        <td><?php echo $key->created_at ?></td>
                                        <td>
                                            <input type="checkbox" class="status_toggle" data-onstyle="default"
                                                data-id="<?php echo $key->user_id ?>"
                                                <?php echo $key->status == 1 ? "checked" : "" ?> data-toggle="toggle"
                                                data-size="mini">
                                        </td>
                                        <td>
                                            <button value="<?php echo $key->user_id ?>"
                                                class="btn btn-info edit_carrier_admin" data-toggle="modal"
                                                data-target="#edit_carrier_admin_modal"><em><i
                                                        class="fa fa-pencil-square-o"></i></em> Edit</button>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include('inc/footer.php') ?>


    <!-- Modal -->
    <div class="modal fade" id="edit_carrier_admin_modal" tabindex="-1" role="dialog"
        aria-labelledby="edit_carrier_admin_modal_label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="carrier_admin_edit_form">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="edit_carrier_admin_modal_label">Edit Carrier Admin</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" name="carrier_admin[name]" id="" class="form-control"
                                placeholder="Enter name">
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" name="carrier_admin[email]" id="" class="form-control"
                                placeholder="Enter email">
                        </div>

                        <div class="form-group">
                            <label for="">Lifeline Yes Tribal Yes</label>
                            <input type="text" name="charge_amount[lifeline_yes_tribal_yes]" id="" class="form-control"
                                placeholder="Tribal Yes Price">
                        </div>

                        <div class="form-group">
                            <label for="">Lifeline Yes Tribal No</label>
                            <input type="text" name="charge_amount[lifeline_yes_tribal_no]" id="" class="form-control"
                                placeholder="Tribal No Price">
						</div>
						
                        <div class="form-group">
                            <label for="">Lifeline No</label>
                            <input type="text" name="charge_amount[lifeline_no]" id="" class="form-control"
                                placeholder="Tribal No Price">
                        </div>


                        <input type="hidden" id="hidden_id" value="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="carrier_admin_edit_form">Save</button>
                    </div>
                </div>
        </div>
    </div>
    </form>


    <?php include('inc/common_scripts.php') ?>
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

    <script>
$(document).ready(function() {
    $('#carrier_admin_table').DataTable({
        "scrollX": true
    });
});
    </script>

    <script>
$('.status_toggle').change(function() {
    var id = $(this).data('id');
    var status = $(this).prop('checked') ? 1 : 0;
    $.ajax({
        url: "<?php echo base_url('UserController/update_status/') ?>" + id,
        data: {
            'status': status
        },
        type: 'post',
        success: function(data) {
            console.log('status changed');
        }
    })

})
    </script>


    <script>
$(document).on('click', '.edit_carrier_admin', function() {
    var user_id = $(this).val();
    $('#hidden_id').val(user_id);
    $.ajax({
        url: "<?php echo base_url('UserController/edit_carrier_admin/') ?>",
        type: 'POST',
        data: {
            'user_id': user_id
        },
        dataType: 'json',
        success: function(data) {
			$('input[name="carrier_admin[name]"]').val(data.user_name);
			$('input[name="carrier_admin[email]"]').val(data.user_email);
			var charge_amount = JSON.parse(data.charge_amount);
            if(charge_amount !== null){
				$('input[name="charge_amount[lifeline_yes_tribal_yes]"]').val(charge_amount.lifeline_yes_tribal_yes);
				$('input[name="charge_amount[lifeline_yes_tribal_no]"]').val(charge_amount.lifeline_yes_tribal_no);
				$('input[name="charge_amount[lifeline_no]"]').val(charge_amount.lifeline_no);
			} else {
				$('input[name="charge_amount[lifeline_yes_tribal_yes]"]').val(null);
				$('input[name="charge_amount[lifeline_yes_tribal_no]"]').val(null);
				$('input[name="charge_amount[lifeline_no]"]').val(null);
			}
        }
    });

})
    </script>

    <script>
$(document).on('submit', '#carrier_admin_edit_form', function(e) {
    e.preventDefault();
    // var user_id = $(this).val();
    var form = $('#carrier_admin_edit_form').serialize();
    var user_id = $('#hidden_id').val();

    // alert(user_id);

    $.ajax({
        url: "<?php echo base_url('UserController/edit_carrier_admin_action_ajax/') ?>" + user_id,
        type: 'POST',
        data: form,
        success: function(data) {
            Swal.fire({
                icon: 'success',
                title: 'Update Successful',
                showConfirmButton: false,
                timer: 1500
            })

            setTimeout(() => {
                location.reload();
            }, 2000);
        }
    });

})
    </script>

    <script>
$("input[name='carrier_admin[email]']").focusout(function() {
    var email = $(this).val();
    var id = $('#hidden_id').val();
    if (email != '') {
        $.ajax({
            url: '<?php echo base_url('UserController/email_check/') ?>' + id,
            data: {
                'email': email
            },
            type: 'post',
            dataType: 'json',
            success: function(data) {
                if (data.error) {

                    Swal.fire({
                        title: "Warning",
                        text: "Email (" + email + ") already exist please try another one!",
                        icon: 'warning',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ok'
                    }).then((result) => {
                        if (result.value) {
                            $("input[name='carrier_admin[email]']").val('');
                        }
                    })
                }
            }
        });
    }
});
    </script>


    </body>




    </html>
