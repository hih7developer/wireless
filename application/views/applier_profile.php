<?php include('inc/header.php') ?>

<section class="dasboard_info">
    <div class="container-fluid">
        <div class="dashboard-tab-innr">
            <?php include('inc/dashboard_tab.php') ?>
            <div class="capa-outr">
                <div class="planinf">
                    <div class="plasec_one">Applicantion Details</div>
                </div>
                <?php
                switch ($application['status']) {
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
                        $status_class = 'primary';
                        break;

                    case 'pending':
                        $status_class = 'primary';
                        break;
                }

                ?>
                <div class="profile_info_sec">

                    <div class="personalinfo_sec">
                        <div class="cmmn_title">
                            <h2>Application Info</h2>
                        </div>

                        <?php if (in_array($application['status'], ['rejected', 'incomplete'])) : ?>
                        <div class="alert alert-warning" role="alert">

                            <?php $reasons = explode(',', $application['reason']); ?>
                            <ol style="margin: 0;">
                                <li><strong>Please review this reasons and re-submit</strong></li>
                                <?php foreach ($reasons as $reason) : ?>
                                <li><?php echo $reason ?></li>
                                <?php endforeach; ?>
                            </ol>
                        </div>
                        <?php endif; ?>
                        <div class="form-group">
                            <label for="">Appclication Id:</label>
                            <span
                                class="badge badge-secondary"><?php echo ucwords($application['application_id']) ?></span>
                        </div>
                        <div class="form-group">
                            <label for="">Order Status:</label>
                            <span
                                class="badge badge-<?php echo $status_class ?>"><?php echo ucwords($application['status']) ?></span>
                        </div>


                        <div class="cmmn_title">
                            <h2>Personal Info</h2>
                        </div>
                        <!-- Sec 1 -->

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group user">
                                    <label for="s">First Name*</label>
                                    <input type="text" name="consumer[first_name]" class="form-control profile_field"
                                        placeholder="Type first name here"
                                        value="<?php echo $application['first_name'] ?>" disabled />
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group user">
                                    <label for="s">Last Name*</label>
                                    <input type="text" name="consumer[last_name]" class="form-control profile_field"
                                        placeholder="Type last name here"
                                        value="<?php echo $application['last_name'] ?>" disabled />
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="s">Phone Number*</label>
                                    <input type="tel" name="consumer[contact_no]" class="form-control profile_field"
                                        placeholder="012-345-6789" value="<?php echo $application['contact_no'] ?>"
                                        disabled />
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="s">Email*</label>
                                    <input type="email" name="user[email]" class="form-control profile_field"
                                        placeholder="info@gmail.com" value="<?php echo $application['email'] ?>"
                                        disabled />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="s">Date Of Birth*</label>
                                    <input name="consumer[dob]" class="form-control profile_field" type="text"
                                        placeholder="Select Date"
                                        value="<?php echo date('m/d/Y', strtotime($application['dob'])) ?>" disabled />
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="s">Last 4 of SSN*</label>
                                    <input type="text" name="consumer[ssn]" class="form-control profile_field"
                                        placeholder="Enter 4 off SSN No" value="<?php echo $application['ssn'] ?>"
                                        maxlength="4"
                                        onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57"
                                        disabled />
                                </div>
                            </div>
                        </div>

						<?php if ($application['is_nv_enable'] == 1) : ?>

                        <?php

                        $nv_success = json_decode($application['nv_response']);

                        ?>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Nv Status:</label>
                                    <input type="text" name="" id=""
                                        value="<?php echo ucwords(strtolower($nv_success->status)); ?>"
                                        class="form-control" disabled>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Nv Eligibility Check Id:</label>
                                    <input type="text" name="" id=""
                                        value="<?php echo $nv_success->eligibilityCheckId; ?>" class="form-control"
                                        disabled>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Nv Eligibility Expiration Date:</label>
                                    <input type="text" name="" id=""
                                        value="<?php echo $nv_success->eligibilityExpirationDate; ?>"
                                        class="form-control" disabled>
                                </div>
                            </div>
                        </div>

						<?php endif ?>



                        <?php if ($application['is_nv_enable'] == 0) : ?>

                        <!-- <div class="cmmn_title">
                            <h2>Lifeline Certificates</h2>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Proof of Eligibility</label>
                                    <a target="_blank" href="<?php echo base_url('uploads/lifeline/' . $application['proof_of_eligibility']) ?>" class="btn btn-sm btn-primary ml-2">Download</a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Photo Id</label>
                                    <a target="_blank" href="<?php echo base_url('uploads/lifeline/' . $application['photo_id']) ?>" class="btn btn-sm btn-primary ml-2">Download</a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Lifeline Certification</label>
                                    <a target="_blank" href="<?php echo base_url('uploads/lifeline/' . $application['lifeline_certification']) ?>" class="btn btn-sm btn-primary ml-2">Download</a>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Household Worksheet</label>
                                    <a target="_blank" href="<?php echo base_url('uploads/lifeline/' . $application['household_worksheet']) ?>" class="btn btn-sm btn-primary ml-2">Download</a>
                                </div>
                            </div>
                        </div> -->

                        <?php endif; ?>


                        <?php if ($application['status'] == 'pending') : ?>
                        <div class="row">
                            <div class="col-md-12 text-center">
                                <button type="button" class="btn btn-default formbtn" form="consumer_profile_form"
                                    data-toggle="modal" data-target="#approve">Approve</button>
                                <a href="" class="btn btn-default formbtn nv_check_btn" data-toggle="modal"
                                    data-target="#reject">Reject</a>
                                <a href="" class="btn btn-default formbtn nlad_check_btn" data-toggle="modal"
                                    data-target="#hold">Incomplete</a>
                                <input type="hidden" name="profile_field_touched" value="0">
                            </div>
                        </div>
                        <?php endif; ?>


                        <div class="row income_otr"
                            style="display:<?php echo $application['lifeline_program'] == 'Income Based Eligibility' ? '' : 'none' ?>">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="s">Income*</label>
                                    <select class="form-control" name="consumer[income]" id="income">
                                        <option value="">Select income</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>

					<?php if ($application['is_nv_enable'] == 1) : ?>

                    <div class="passchange_sec">

                        <div class="cmmn_title">
                            <h2>Documents</h2>
                        </div>

                        <div class="col-md-12 text-center">
                            <div class="form-group">
                                <label for="">Lifeline Certification</label> <br>
                                <div class="btn-group">
                                    <a data-fancybox
                                        <?php if (pathinfo($application['lifeline_certification'], PATHINFO_EXTENSION) == 'pdf') : ?>
                                        data-type="iframe" <?php endif; ?>
                                        data-src="<?php echo base_url('uploads/lifeline_pdf/' . $application['lifeline_certification'] . "#toolbar=0") ?>"
                                        href="javascript:;" class="btn" disabled><i class="fa fa-eye"></i></em> View</a>
                                    <a target="_blank" download
                                        href="<?php echo base_url('uploads/lifeline_pdf/' . $application['lifeline_certification']) ?>"
                                        class="btn <?php echo $application['status'] == 'approved' ? '' : 'disabled' ?>"><i
                                            class="fa fa-download" aria-hidden="true"></i> Download</a>
                                </div>
                            </div>
                        </div>



                        <div class="col-md-12 text-center">
                            <div class="form-group">
                                <label for="">Proof of Eligibility</label> <br>
                                <div class="btn-group">
                                    <a data-fancybox
                                        <?php if (pathinfo($application['proof_of_eligibility'], PATHINFO_EXTENSION) == 'pdf') : ?>
                                        data-type="iframe" <?php endif; ?>
                                        data-src="<?php echo base_url('uploads/lifeline/' . $application['proof_of_eligibility'] . "#toolbar=0") ?>"
                                        href="javascript:;" class="btn" disabled><i class="fa fa-eye"></i></em> View</a>
                                    <a target="_blank" download
                                        href="<?php echo base_url('uploads/lifeline/' . $application['proof_of_eligibility']) ?>"
                                        class="btn  <?php echo $application['status'] == 'approved' ? '' : 'disabled' ?>"><i
                                            class="fa fa-download" aria-hidden="true"></i> Download</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 text-center">
                            <div class="form-group">
                                <label for="">Photo Id</label> <br>
                                <div class="btn-group">
                                    <a data-fancybox="images"
                                        data-src="<?php echo base_url('uploads/lifeline/' . $application['photo_id']) ?>"
                                        href="javascript:;" class="btn" disabled><i class="fa fa-eye"></i></em> View</a>
                                    <a target="_blank" download
                                        href="<?php echo base_url('uploads/lifeline/' . $application['photo_id']) ?>"
                                        class="btn <?php echo $application['status'] == 'approved' ? '' : 'disabled' ?>"><i
                                            class="fa fa-download" aria-hidden="true"></i> Download</a>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-12 text-center">
                            <div class="form-group">
                                <label for="">Household Worksheet</label> <br>
                                <div class="btn-group">
                                    <a data-fancybox
                                        <?php if (pathinfo($application['household_worksheet'], PATHINFO_EXTENSION) == 'pdf') : ?>
                                        data-type="iframe" <?php endif; ?>
                                        data-src="<?php echo base_url('uploads/household_worksheet/' . $application['household_worksheet'] . "#toolbar=0") ?>"
                                        href="javascript:;" class="btn" disabled><i class="fa fa-eye"></i></em> View</a>
                                    <a target="_blank" download
                                        href="<?php echo base_url('uploads/household_worksheet/' . $application['household_worksheet']) ?>"
                                        class="btn <?php echo $application['status'] == 'approved' ? '' : 'disabled' ?>"><i
                                            class="fa fa-download" aria-hidden="true"></i> Download</a>
                                </div>
                            </div>
                        </div>


                        <?php if ($application['status'] == 'approved') : ?>
                        <div class="cmmn_title">
                            <h2>Order Details</h2>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group ">
                                <label for="s">Track Number</label>
                                <input type="text" name="consumer[last_name]" class="form-control "
                                    value="<?php echo $application['track'] ?> " , disabled />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group ">
                                <label for="s">Contact Number</label>
                                <input type="text" name="consumer[last_name]" class="form-control "
                                    value="<?php echo $application['contact_no'] ?>" , disabled />
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group ">
                                <label for="s">Device Name</label>
                                <input type="text" name="consumer[last_name]" class="form-control "
                                    value="<?php echo $application['device'] ?> " , disabled />
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>

					<?php endif; ?>


                </div>

            </div>


        </div>

    </div>
</section>




<!------------------------------- Approve Modal ------------------------------------------>


<div class="modal fade" id="approve" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form action="<?php echo base_url('AdminViewListController/add_approve/' . $application['application_id']) ?>"
            method="post">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Order Details – Emailed to Customer:</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                    <div class="form-group">
                        <label for="">Tracking:</label>
                        <input type="text" name="track" id="" class="form-control" placeholder="Enter Tracking No"
                            required>
                    </div>
                    <div class="form-group">
                        <label for="">Phone number:</label>
                        <input type="text" name="contact_no" id="" class="form-control cleave-input-phone"
                            placeholder="Enter Phone number" required>
                    </div>
                    <div class="form-group">
                        <label for="">Provided Device:</label>
                        <input type="text" name="device" id="" class="form-control" placeholder="Enter Provided Device">
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Approve</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!------------------------------- Reject Modal ------------------------------------------>


<div class="modal fade" id="reject" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form
            action="<?php echo base_url('AdminViewListController/add_reject_reasons/' . $application['application_id']) ?>"
            method="post" id="incomplete_reason">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Order Details – Emailed to Customer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">


                    <div class="checkbox checkbox-primary">
                        <input id="myCheck_1" class="reject_field" type="checkbox" name="reason[]"
                            value="Ineligible for Lifeline Service">
                        <label class="container" for="myCheck_1">Ineligible for Lifeline Service</label>
                        <input id="myCheck_2" class="reject_field" type="checkbox" name="reason[]"
                            value="Service Area Not Supported">
                        <label class="container" for="myCheck_2">Service Area Not Supported</label>
                        <input id="myCheck_3" class="reject_field" type="checkbox" name="reason[]"
                            value="Current Customer">
                        <label class="container" for="myCheck_3">Current Customer</label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Reject</button>
                </div>
            </div>
        </form>
    </div>
</div>
<!------------------------------- Incomplete Modal ------------------------------------------>


<div class="modal fade" id="hold" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">

        <form
            action="<?php echo base_url('AdminViewListController/add_incomplete_reasons/' . $application['application_id']) ?>"
            method="post" id="incomplete_reason">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Order Details – Emailed to Customer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="checkbox checkbox-primary">
                        <input id="myCheck_4" class="profile_field" type="checkbox" name="reason[]"
                            value="Revise Application Information">
                        <label class="container" for="myCheck_4">Revise Application Information</label>
                        <input id="myCheck_5" class="profile_field" type="checkbox" name="reason[]"
                            value="Provide Photo ID">
                        <label class="container" for="myCheck_5">Provide Photo ID </label>
                        <input id="myCheck_6" class="profile_field" type="checkbox" name="reason[]"
                            value="Provide Proof of Eligibility">
                        <label class="container" for="myCheck_6">Provide Proof of Eligibility</label>

                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="incomplete_reason">Incomplete</button>
                </div>
            </div>
        </form>
    </div>
</div>



<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>

<script>
$(document).ready(function() {
    $('.reject_field').click(function() {
        $('.reject_field').not(this).prop('checked', false);
    });
});
</script>


<?php include('inc/footer.php') ?>


<?php include('inc/common_scripts.php') ?>


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


<?php if ($this->session->flashdata('error')) : ?>
<script>
Swal.fire(
    'Error',
    '<?php echo $this->session->flashdata('
    error ') ?>',
    'error'
)
</script>
<?php endif; ?>

<?php if ($this->session->flashdata('status')) : ?>
<script>
Swal.fire(
    'Application Status is now Incomplete!',
    '<?php echo $this->session->flashdata('
    success ') ?>',
    'success'
)
</script>
<?php endif; ?>

<?php if ($this->session->flashdata('reject')) : ?>
<script>
Swal.fire(
    'Application Status is now Rejected!',
    '<?php echo $this->session->flashdata('
    success ') ?>',
    'success'
)
</script>
<?php endif; ?>

<?php if ($this->session->flashdata('approve')) : ?>
<script>
Swal.fire(
    'Success',
    '<?php echo $this->session->flashdata('
    approve ') ?>',
    'success'
)
</script>
<?php endif; ?>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.css" />
<script src="https://cdn.jsdelivr.net/gh/fancyapps/fancybox@3.5.7/dist/jquery.fancybox.min.js"></script>
<script>
$('[data-fancybox]').fancybox({
    toolbar: false,
    smallBtn: true,
    iframe: {
        preload: false
    }
})
</script>

</body>

</html>
