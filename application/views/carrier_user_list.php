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
                            <a class="btn" href="<?php echo base_url('carrier_user/create') ?>">Add Carrier User</a>
                        </div>
                    </div>
                    <div class="row mt-5">
                        <div class="col-md-12">
                            <table class="table" id="carrier_user_table">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Created At</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($carrier_users as $key) : ?>
                                    <tr>
                                        <td scope="row"><?php echo $key->name ?></td>
                                        <td><?php echo $key->email ?></td>
                                        <td><?php echo $key->created_at ?></td>
                                        <!-- <td><input type="checkbox" checked data-toggle="toggle" data-size="mini"></td> 
                                        -->
                                        <td><input type="checkbox" class="status_toggle" data-onstyle="default"
                                                data-id="<?php echo $key->user_id ?>"
                                                <?php echo $key->status == 1 ? "checked" : "" ?> data-toggle="toggle"
                                                data-size="mini"></td>

                                        <td>
                                            <button value="<?php echo $key->user_id ?>"
                                                class="btn btn-info edit_carrier_user" data-toggle="modal"
                                                data-target="#edit_carrier_user_modal"><em><i
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
    <div class="modal fade" id="edit_carrier_user_modal" tabindex="-1" role="dialog"
        aria-labelledby="edit_carrier_user_modal_label" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="carrier_user_edit_form">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="edit_carrier_user_modal_label">Edit Carrier User</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="">Name</label>
                            <input type="text" name="carrier_user[name]" id="" class="form-control"
                                placeholder="Enter name">
                        </div>
                        <div class="form-group">
                            <label for="">Email</label>
                            <input type="email" name="carrier_user[email]" id="" class="form-control"
                                placeholder="Enter email">
                        </div>
                        <input type="hidden" id="hidden_id">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="carrier_user_edit_form">Save</button>
                    </div>
                </div>
        </div>
    </div>
    </form>


    <?php include('inc/common_scripts.php') ?>

    <script>
$(document).ready(function() {
    $('#carrier_user_table').DataTable({
        "scrollX": true
    });
});
    </script>

    <script>
$(".status_toggle").change(function() {
    var id = $(this).data('id');
    var status = $(this).prop('checked') ? 1 : 0;
    $.ajax({
        url: "<?php echo base_url('UserController/update_status/') ?>" + id,
        type: 'post',
        data: {
            'status': status
        },
        success: function(data) {
            console.log('success');
        }
    })
})
    </script>

    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

    <script>
$(function() {
    $('#toggle-one').bootstrapToggle();
});
    </script>


    <script>
$(document).on('click', '.edit_carrier_user', function() {
    var user_id = $(this).val();
    $('#hidden_id').val(user_id);
    // alert(user_id);
    $.ajax({
        url: "<?php echo base_url('Carrier_user_controller/edit/') ?>",
        type: 'POST',
        data: {
            'user_id': user_id
        },
        dataType: 'json',
        success: function(response) {
            console.log(response);
            $('input[name="carrier_user[name]"]').val(response.name);
            $('input[name="carrier_user[email]"]').val(response.email);
        }
    });

})
    </script>


    <script>
$(document).on('submit', '#carrier_user_edit_form', function(e) {
    e.preventDefault();
    // var user_id = $(this).val();
    var form = $('#carrier_user_edit_form').serialize();
    var user_id = $('#hidden_id').val();

    // alert(user_id);

    $.ajax({
        url: "<?php echo base_url('Carrier_user_controller/edit_carrier_user_action/') ?>" + user_id,
        type: 'POST',
        data: form,
        success: function(data) {
            $('#carrier_user_edit_form').trigger("");
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


    </body>

    </html>