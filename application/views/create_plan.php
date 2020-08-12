<?php include('inc/header.php') ?>

<section class="dasboard_info">
    <div class="container-fluid">
        <div class="dashboard-tab-innr">

            <?php include('inc/dashboard_tab.php') ?>

            <div class="capa-outr">
                <div class="planinf">
                    <div class="plasec_one">Create Plan</div>

                </div>
                <form class="needs-validation" action="<?php echo base_url('PlanController/create_plan_action/') ?>" method="POST"
                    autocomplete="off" enctype="multipart/form-data" novalidate>
                    <div class="profile_info_sec">
                        <div class="personalinfo_sec">
                            <div class="personalinfo_form cmmn_title">
                                <h2>Plan Info</h2>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="s">Name*</label>
                                            <input type="text" name="plan[name]" class="form-control"
                                                placeholder="Type name here" required/>
                                                <div class="invalid-feedback">
                                                Please enter a plan name.
                                                </div>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="s">Voice*</label>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <select class="form-control cstm_select2" name="plan[voice][value]"
                                                        id="" required>
                                                        <option selected disabled>Type voice here</option>
                                                        <?php foreach ($plan_voices as $key): ?>
                                                        <option value="<?php echo $key ?>">
                                                            <?php echo ucwords(strtolower($key)) ?></option>
                                                        <?php endforeach ?>
                                                    </select>

                                                    <div class="invalid-feedback">
                                                        Please enter a voice value.
                                                    </div>
                                                    <!-- <input type="text" name="plan[voice][]" class="form-control"
                                                placeholder="Type voice here" autocomplete="no" /> -->
                                                </div>
                                                <div class="col-md-2">
                                                    <select class="form-control" name="plan[voice][type]">
                                                        <option value="minutes" selected>Minutes</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" name="plan[voice][extra]"
                                                        placeholder="Extra info">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="s">Sms*</label>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <select class="form-control cstm_select2" name="plan[sms][value]"
                                                        id="" required>
                                                        <option selected disabled>Type sms here</option>
                                                        <?php foreach ($plan_sms as $key): ?>
                                                        <option value="<?php echo $key ?>">
                                                            <?php echo ucwords(strtolower($key)) ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        Please enter a sms value.
                                                    </div>
                                                    <!-- <input type="text" name="plan[sms][]" class="form-control"
                                                    placeholder="Type sms here" /> -->
                                                </div>

                                                <div class="col-md-2">
                                                    <select class="form-control" name="plan[sms][type]">
                                                        <option value="month" selected>Month</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" name="plan[sms][extra]"
                                                        placeholder="Extra info">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="s">Data*</label>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <select class="form-control cstm_select2" name="plan[data][value]"
                                                        id="">
                                                        <option selected disabled>Type data here</option>
                                                        <?php foreach ($plan_data as $key): ?>
                                                        <option value="<?php echo $key ?>">
                                                            <?php echo ucwords(strtolower($key)) ?></option>
                                                        <?php endforeach ?>
                                                    </select>
                                                    <div class="invalid-feedback">
                                                        Please enter a data value.
                                                    </div>
                                                    <!-- <input type="text" name="plan[data][]" class="form-control"
                                                    placeholder="Type data here" /> -->
                                                </div>
                                                <div class="col-md-2">
                                                    <select class="form-control" name="plan[data][type]">
                                                        <option value="mb" selected>MB</option>
                                                        <option value="gb">GB</option>
                                                    </select>
                                                </div>

                                                <div class="col-md-6">
                                                    <input type="text" class="form-control" name="plan[data][extra]"
                                                        placeholder="Extra info">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="s">Description*</label>
                                            <textarea name="plan[description]" class="form-control" id="" cols="30"
                                                rows="4" placeholder="Type description here" required></textarea>
                                            <!-- <input type="text" name="plan[sms]" class="form-control"
                                            placeholder="Type sms here"/> -->
                                            <div class="invalid-feedback">
                                                Please enter a plan description.
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="s">Initial Price*</label>
                                            <input type="number" name="plan[initial_price]" class="form-control"
                                                placeholder="Type initial price here" required />
                                                <div class="invalid-feedback">
                                                    Please enter a initial price.
                                                </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="s">Monthly Price*</label>
                                            <input type="number" name="plan[monthly_price]" class="form-control"
                                                placeholder="Type monthly price here" required/>
                                                <div class="invalid-feedback">
                                                    Please enter a monthly price.
                                                </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="s">Service Type*</label>
                                            <select name="plan[service_type_id]" id="" required>
                                                <option value="" selected disabled>Select service type</option>
                                                <?php foreach($service_types as $key): ?>
                                                <option value="<?php echo $key->service_type_id ?>">
                                                    <?php echo $key->name ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <div class="invalid-feedback">
                                                Please enter a service type.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="s">Region/State*</label>
                                            <select name="plan[state_id][]" id="select_state" autocomplete="none"
                                                multiple required>
                                                <option></option>
                                                <?php foreach($states as $key): ?>
                                                <option value="<?php echo $key->id ?>"><?php echo $key->name ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <div class="invalid-feedback">
                                                Please enter a region.
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="s">Lifeline Service*</label>
                                            <div class="adflx">
                                                <label class="container">Yes
                                                    <input type="radio" checked="checked" name="plan[lifeline_service]"
                                                        value="1" required>
                                                    <span class="checkmark"></span>
                                                </label>
                                                <label class="container">No
                                                    <input type="radio" name="plan[lifeline_service]" value="0">
                                                    <span class="checkmark" required></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="s">Tribal Plan*</label>
                                            <div class="adflx">
                                                <label class="container">Yes
                                                    <input type="radio" checked="checked" name="plan[tribal_plan]"
                                                        value="1" required>
                                                    <span class="checkmark"></span>
                                                </label>
                                                <label class="container">No
                                                    <input type="radio" name="plan[tribal_plan]" value="0" required>
                                                    <span class="checkmark"></span>
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    
                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="s">Plan Price</label>
                                            <div class="adflx">
                                                <p>
                                                    <sup><i class="fas fa-dollar-sign"></i></sup> <span class="monthly_price">0</span> Plus Taxes and Fees <br>
                                                    <sup><i class="fas fa-dollar-sign"></i></sup> <span class="lifeline_discount">34.25</span> Lifeline Discount Applied
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Sec 5 -->
                                <div class="pdng35">
                                    <button type="submit" class="btn btn-lg">Create</button>
                                    <button type="reset" class="btn btn-secondary btn-lg">Reset</button>
                                </div>
                            </div>
                        </div>

                        <div class="passchange_sec">
                            <div class="cmmn_title">
                                <h2>Handsets</h2>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Handset Name</label>
                                        <input type="text" name="plan[handset_name]" id="" class="form-control"
                                            placeholder="Enter handset name">
                                    </div>
                                </div>
                            </div>
                            <div class="file-upload">
                                <h5>Photo ID</h5>
                                <button class="btn" type="button"
                                    onclick="$('.file-upload-input1').trigger( 'click' )">Upload</button>
                                <div class="neimg_cls">No File Chosen</div>
                                <div class="image-upload-wrap">
                                    <input class="file-upload-input1" type='file' name='file' onchange="readURL1(this);"
                                        accept="image/*" />
                                </div>
                                <div class="file-upload-content">
                                    <img class="file-upload-image" src="" alt="your image" />
                                    <div class="image-title-wrap">
                                        <!-- <button class="btn" type="submit">Update</button> -->

                                        <button class="btn btn-secondary" type="button" onclick="removeUpload1()"
                                            class="remove-image">Remove</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<?php include('inc/footer.php') ?>

<?php include('inc/common_scripts.php') ?>
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<link rel="stylesheet"
    href="https://raw.githack.com/ttskch/select2-bootstrap4-theme/master/dist/select2-bootstrap4.css">
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script>
// $.fn.select2.defaults.set("theme", "bootstrap");
$('#select_state').select2({
    placeholder: "Select a state",
    theme: 'bootstrap4'
});


$('.cstm_select2').select2({
    theme: 'bootstrap4',
    tags: true

});
</script>

<script>
    $(document).on('keyup', 'input[name="plan[monthly_price]"]', function(){
        $('.monthly_price').html($(this).val());
    });
    
    
    $(document).on('change', 'input[name="plan[tribal_plan]"]', function(){
        if($(this).val() == 1){
            $('.lifeline_discount').html('34.25');
        } else{
            $('.lifeline_discount').html('9.25');
        }
    });
</script>


</body>

</html>