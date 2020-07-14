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
                            <a class="btn" href="<?php echo base_url('plan/create') ?>">Add Plan</a>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12">
                            <form id="sort_plan_form">
                                <div class="form-row">
                                    <div class="form-group col-md-3">
                                        <select name="state_id" id="state_select" class="form-control"
                                            placeholder="Select a state">
                                            <option selected disabled>Select a state</option>
                                            <?php foreach ($states as $key) : ?>
                                            <option value="<?php echo $key->id ?>"><?php echo $key->name ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-md-12" id="plan_table_otr">
                            <table class="table" id="plan_table">
                                <thead>
                                    <th style="width: 300px;">Name</th>
                                    <th style="width: 150px;">Details</th>
                                    <th>Price</th>
                                    <th>Service</th>
                                    <th>State</th>
                                    <th>Lifeline</th>
                                    <th>Tribal</th>
                                    <th>Active</th>
                                    <th class="text-center">Action</th>
                                </thead>
                                <tbody>
                                    <?php foreach ($plans as $key) : ?>
                                    <tr>
                                        <td>
                                            <b><?php echo $key->plan_name ?></b><br>
                                            <span><?php echo $key->description ?></span>
                                        </td>
                                        <td>
                                            <b>Voice:</b> <?php echo json_decode($key->voice)->value ?><br>
                                            <b>Sms:</b> <?php echo json_decode($key->sms)->value ?><br>
                                            <b>Data:</b>
                                            <?php echo json_decode($key->data)->value . ' ' . (strtolower(json_decode($key->data)->value) == 'unlimited' ? '' : json_decode($key->data)->type) ?>
                                        </td>
                                        <!-- <td><?php //echo $key->initial_price 
                                                        ?></td> -->
                                        <td><?php echo $key->monthly_price ?></td>
                                        <td><?php echo $key->service_type_name ?></td>
                                        <td>
                                            <?php  ?>
                                            <?php
                                                if ($key->state_id != '') {
                                                    $plan_states = explode(',', $key->state_id);
                                                    foreach ($plan_states as $plan_state) {
                                                        echo $this->db->get_where('states', ['id' => $plan_state])->row()->name . '<br>';
                                                    }
                                                }
                                                ?>
                                        </td>
                                        <td><?php echo ($key->lifeline_service == 1) ? "yes" : "no"  ?></td>
                                        <td><?php echo ($key->tribal_plan == 1) ? "yes" : "no" ?></td>
                                        <td><input type="checkbox" class="active_toggle" data-onstyle="default"
                                                data-id="<?php echo $key->plan_id ?>"
                                                <?php echo $key->is_active == 1 ? "checked" : "" ?> data-toggle="toggle"
                                                data-size="mini"></td>
                                        <td>
                                            <div class="btn-group">
                                                <a class="btn btn-info"
                                                    href="<?php echo base_url('plan/edit/' . $key->plan_id) ?>"><i
                                                        class="fa fa-pencil-square-o"></i> Edit</a>
                                                <button class="btn btn-info delete_plan_btn"
                                                    data-href="<?php echo base_url('plan/delete/' . $key->plan_id) ?>"><i
                                                        class="fa fa-trash-o"></i>
                                                    Delete</button>
                                            </div>
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


    <?php include('inc/common_scripts.php') ?>

    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>

    <script>
$(document).ready(function() {
    $('#plan_table').DataTable({
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


    </body>

    </html>