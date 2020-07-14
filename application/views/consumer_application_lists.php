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
                            <div class="row">
                                <div class="col-md-3">
                                    <form action="<?php echo base_url('consumer/applications') ?>" method="get">
                                        <div class="form-group">
                                            <select name="status" id="" class="form-control"
                                                onchange="this.form.submit()">
                                                <option value="" selected disabled>Sort by status</option>
                                                <?php $sort_status = ['all', 'approved', 'pending', 'rejected', 'incomplete', 'cancelled'] ?>
                                                <?php foreach ($sort_status as $key) : ?>
                                                <option value="<?php echo $key ?>"
                                                    <?php echo $key == $this->input->get('status') ? 'selected' : '' ?>>
                                                    <?php echo $key ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <table class="table" id="carrier_application_table">
                                <thead>
                                    <tr>
                                        <th class="text-center">Application Id</th>
                                        <th>Plan</th>
                                        <th>Service Provider</th>
                                        <th class="text-center">Status</th>
                                        <th>Created</th>
                                        <th>Updated</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php foreach ($applications as $key) : ?>
                                    <tr>
                                        <td class="text-center"> <span
                                                class="badge badge-secondary"><?php echo $key->application_id ?></span>
                                        </td>
                                        <td><?php echo $key->plan_name ?></td>
                                        <td><?php echo $key->service_provider_name ?></td>
                                        <td class="text-center">
                                            <?php
                                                switch ($key->status) {
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
                                            <span
                                                class="badge badge-<?php echo $status_class ?>"><?php echo $key->status ?></span>
                                        </td>
                                        <td><?php echo date('h:i a. d M, y', strtotime($key->application_created_at)) ?>
                                        </td>
                                        <td><?php echo time_elapsed_string($key->application_updated_at) ?></td>
                                        <td>
                                            <a href="<?php echo base_url('consumer/application/details/' . $key->application_id) ?>"
                                                class="btn edit_sac_no">
                                                <i class="fa fa-eye" aria-hidden="true"></i> Check
                                            </a>
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
    $('#carrier_application_table').DataTable({
        "order": [],
        "scrollX": true
    });
});
    </script>


    </body>




    </html>