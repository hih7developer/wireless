    <!--Header Start-->
    <?php include('inc/header.php') ?>
    <!--Header End-->

    <section class="dasboard_info header-padding">
        <div class="container-fluid">
            <div class="dashboard-tab-innr">
                <?php include('inc/dashboard_tab.php') ?>

                <div class="capa-outr">
                    <div class="account_sec">
                        <div class="row">

                            <?php if (in_array($user->role_id, [1])) : ?>
                            <div class="col-md-3">
                                <div class="card dashboard-card">
                                    <div class="card-body">
                                        <h5 class="card-title">Buyers</h5>
                                        <p class="card-text"><span class="counter"><?php echo $count['buyer'] ?></span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>


                            <?php if (in_array($user->role_id, [1])) : ?>
                            <div class="col-md-3">
                                <div class="card dashboard-card">
                                    <div class="card-body">
                                        <h5 class="card-title">Carrier Admins</h5>
                                        <p class="card-text"><span
                                                class="counter"><?php echo $count['carrier_admin'] ?></span></p>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>


                            <?php if (in_array($user->role_id, [1, 2])) : ?>
                            <div class="col-md-3">
                                <div class="card dashboard-card">
                                    <div class="card-body">
                                        <h5 class="card-title">Carrier Users</h5>
                                        <p class="card-text"><span
                                                class="counter"><?php echo $count['carrier_user'] ?></span></p>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>


                            <?php if (in_array($user->role_id, [1, 2])) : ?>
                            <div class="col-md-3">
                                <div class="card dashboard-card">
                                    <div class="card-body">
                                        <h5 class="card-title">Plans</h5>
                                        <p class="card-text"><span class="counter"><?php echo $count['plan'] ?></span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>


                            <?php if (in_array($user->role_id, [2, 3])) : ?>
                            <div class="col-md-3">
                                <div class="card dashboard-card">
                                    <div class="card-body">
                                        <h5 class="card-title">Application</h5>
                                        <p class="card-text"><span
                                                class="counter"><?php echo $count['application'] ?></span></p>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="capa-outr">

                <div class="row mt-5">
                    <!-- <div class="col-md-12">
                        <form id="sort_plan_form">
                            <div class="form-row">
                                <div class="form-group col-md-3">
                                <form action="<?php echo base_url('consumer/applications') ?>" method="get">
                                    <div class="form-group">
                                        <select name="status" id="" class="form-control"  onchange="this.form.submit()">
                                            <option value="" selected disabled>Sort by status</option>
                                            <?php $sort_status = ['all', 'approved', 'pending', 'rejected', 'incomplete', 'cancelled'] ?>
                                            <?php foreach ($sort_status as $key) : ?>
                                            <option value="<?php echo $key ?>" <?php echo $key == $this->input->get('status') ? 'selected' : '' ?>><?php echo $key ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </form>
                                </div>
                            </div>

                        </form>
                    </div> -->
                    <div class="col-md-12" id="plan_table_otr">
                        <table class="table" id="plan_table">
                            <thead>
                                <th style="width: 100px;">Application Id</th>
                                <th style="width: 150px;">Consumer </th>
                                <th style="width: 150px;">Plan</th>
                                <th>Tribal</th>
                                <th>Status</th>
                                <th>Created</th>
                                <th>Updated</th>
                                <th class="text-center">Action</th>
                            </thead>
                            <tbody>
                                <?php if (!empty($applications)) : ?>
                                <?php foreach ($applications as $key) : ?>

                                <tr>
                                    <td><span class="badge badge-dark"><?php echo  $key['application_id'] ?></span>
                                    </td>
                                    <td><?php echo ucwords(strtolower($this->db->get_where('users', ['user_id' => $key['app_user_id']])->row()->name)); ?>
                                    </td>
                                    <td><a href="<?php echo base_url('plan/edit/' . $key['applier_plan_id']) ?>"
                                            class="text-primary"><?php echo  $key['plan_name'] ?> </a></td>
                                    <td><?php echo  $key['tribal_plan'] == 1 ? 'yes' : 'no' ?> </td>
                                    <?php if ($key['status'] == 'rejected') : ?>
                                    <td><span class="badge badge-warning"><?php echo  $key['status'] ?></span> </td>
                                    <?php elseif ($key['status'] == 'pending') : ?>
                                    <td><span class="badge badge-primary"><?php echo  $key['status'] ?> </span></td>
                                    <?php elseif ($key['status'] == 'incomplete') : ?>
                                    <td><span class="badge badge-warning"><?php echo  $key['status'] ?></span> </td>
                                    <?php else : ?>
                                    <td><span class="badge badge-success"><?php echo  $key['status'] ?> </span></td>
                                    <?php endif; ?>
                                    <td><?php echo  date('h:i a. d M, y', strtotime($key['created_at'])) ?> </td>
                                    <td><?php echo  time_elapsed_string($key['updated_at']) ?> </td>
                                    <td><a href="<?php echo  base_url('carrier/application/details/' . $key['application_id']) ?>"
                                            class="btn edit_sac_no"><i class="fa fa-eye" aria-hidden="true"></i> Check
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <?php include('inc/footer.php') ?>


    <?php include('inc/common_scripts.php') ?>

    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

    <script>
$(document).ready(function() {
    $('#plan_table').DataTable({
        "order": [],
        "scrollX": true
    });
});
    </script>

    <script>
$(".active_toggle").change(function() {
    var id = $(this).data('id');
    var active = $(this).prop('checked') ? 1 : 0;

    $.ajax({
        url: "<?php echo base_url('PlanController/update_active_plan/') ?>" + id,
        type: 'post',
        data: {
            'active': active
        },
        success: function(data) {
            console.log('success');
        }
    })
})
    </script>

    <script>
$(document).on('click', '.delete_plan_btn', function() {
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
            window.location.href = $(this).data('href');
        }
    })
});
    </script>

    <script>
$(document).on('change', '#state_select', function() {
    $('#sort_plan_form').submit();
});

$(document).on('submit', '#sort_plan_form', function(e) {
    e.preventDefault();

    var form = $(this).serialize();

    $.ajax({
        url: '<?php echo base_url('
        PlanController / sort_plan_carrier_admin ') ?>',
        data: form,
        type: 'post',
        beforeSend: function() {
            $('#plan_table_otr').append(
                '<div class="loader_container"><div class="loader"></div></div>');
        },
        success: function(data) {
            $('#plan_table_otr').html(data);
            $('#plan_table_otr .loader_container').remove();
        }
    });

});
    </script>


    <?php if ($this->session->flashdata('success')) : ?>
    <script>
Swal.fire(
    'Good job!',
    '<?php echo $this->session->flashdata('
    success ') ?>',
    'success'
)
    </script>
    <?php endif; ?>



    <?php if ($this->session->flashdata('payment_method')) : ?>
    <script>
Swal.fire({
    title: 'Payment Method',
    text: "<?php echo $this->session->flashdata('payment_method') ?>",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Go to profile'
}).then((result) => {
    if (result.value) {
        window.location.href = "<?php echo base_url('carrier_admin/profile#payment_details') ?>";
    }
})
    </script>
    <?php endif; ?>


    <?php if ($this->session->flashdata('nlad_verified')) : ?>
    <script>
Swal.fire({
    title: 'Nlad Verification',
    text: "<?php echo $this->session->flashdata('nlad_verified') ?>",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Go to lifeline'
}).then((result) => {
    if (result.value) {
        window.location.href = "<?php echo base_url('lifeline#nlad_verification_div') ?>";
    }
})
    </script>
    <?php endif; ?>


    </body>

    </html>






    <!-- Modal -->
    <div class="modal fade" id="generate_ps_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Generate Password</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="gn_ps_inp">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="gn_ps_sv_btn">Save & Copy</button>
                </div>
            </div>
        </div>
    </div>

    <?php include('inc/common_scripts.php') ?>

    <script>
$(document).on('click', '#gn_ps_btn', function() {
    $('#gn_ps_inp').val(password_generator(8));
});

$(document).on('click', '#gn_ps_sv_btn', function() {
    $('#generate_ps_modal').modal('hide');
    var copyText = $('#gn_ps_inp');
    copyText.select();
    document.execCommand("copy");
    $('input[name="user[password]"]').val(copyText.val());
});

function password_generator(len) {
    var length = (len) ? (len) : (10);
    var string = "abcdefghijklmnopqrstuvwxyz"; //to upper 
    var numeric = '0123456789';
    var punctuation = '!@#$%^&*()_+~`|}{[]\:;?><,./-=';
    var password = "";
    var character = "";
    var crunch = true;
    while (password.length < length) {
        entity1 = Math.ceil(string.length * Math.random() * Math.random());
        entity2 = Math.ceil(numeric.length * Math.random() * Math.random());
        entity3 = Math.ceil(punctuation.length * Math.random() * Math.random());
        hold = string.charAt(entity1);
        hold = (password.length % 2 == 0) ? (hold.toUpperCase()) : (hold);
        character += hold;
        character += numeric.charAt(entity2);
        character += punctuation.charAt(entity3);
        password = character;
    }
    password = password.split('').sort(function() {
        return 0.5 - Math.random()
    }).join('');
    return password.substr(0, len);
}
    </script>


    <?php if ($this->session->flashdata('success')) : ?>
    <script>
Swal.fire(
    'Good job!',
    '<?php echo $this->session->flashdata('
    success ') ?>',
    'success'
)
    </script>
    <?php endif; ?>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/2.0.3/waypoints.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Counter-Up/1.0.0/jquery.counterup.min.js"></script>
    <script>
jQuery.noConflict();

(function($) {
    jQuery(document).ready(function($) {
        $('.counter').counterUp();
    });
})(jQuery);
    </script>

    </body>

    </html>