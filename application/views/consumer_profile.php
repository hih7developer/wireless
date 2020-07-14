<?php include('inc/header.php') ?>
<!-- 
<style>
.field__rules{
    display: block !important;
    column-count: 2;
    padding: 5px;
    font-size: .8em;
    list-style: none;
}
.field__rules::before{
    content: none !important;
    all: unset;
}
.field__rules li{
    display: flex;
    align-items: center;
    padding: 3px 0!important;
    color: rgba(17, 17, 17, 0.6);
    transition: .2s;
    
}
.field__rules li::before {
    content: '✔';
    display: inline-block;
    color: #DDD;
    font-size: 1em;
    line-height: 0;
    margin: 0 6px 0 0;
    transition: .2s;
}

.field__rules li.active{
    border-bottom: none !important;
    color: #00a69c !important;
}
.field__rules li.active::before{
    color: #00a69c !important;
}
</style> -->

<section class="dasboard_info">
    <div class="container-fluid">
        <div class="dashboard-tab-innr">
            <?php include('inc/dashboard_tab.php') ?>
            <div class="capa-outr">
                <!-- <div class="planinf">
                    <div class="plasec_one">Buyer Profile</div>
                </div> -->
                <div class="profile_info_sec">
                    <div class="personalinfo_sec cmmn_title">
                        <form action="<?php echo base_url('UserController/edit_consumer_profile') ?>" id="consumer_profile_form" method="post" class="needs-validation" novalidate>
                        <?php if($this->session->flashdata('error')): ?>
                        <div class="alert alert-danger nlad-error" role="alert">
                            <ol style="margin: 0;">
                                <?php foreach($this->session->flashdata('error') as $key => $value): ?>
                                <li><?php echo $value[0].': '.$value[1] ?></li>
                                <?php endforeach; ?>
                            </ol>
                        </div>
                        <?php endif; ?>
                        


                        
                        <?php if($this->session->flashdata('nv_success')): ?>
                        <?php $nv_success = $this->session->flashdata('nv_success');  ?>
                        <div class="alert alert-success nlad-error" role="alert">

                            <p class="text-center text-success"><strong><?php echo $this->session->flashdata('nv_success_status') ?></strong></p>

                            <ol style="margin: 0;">
                                <li>Eligibility check successful</li>
                                <li>Eligibility Expiration Date: <?php echo date('m/d/Y', strtotime($nv_success['eligibilityExpirationDate']))  ?></li>
                                <li>Last Manual Review Time: <?php echo date('m/d/Y H:i:s', strtotime($nv_success['lastManualReviewTime']))  ?></li>
                            </ol>
                        </div>
                        <?php endif; ?>



                        
                        <?php if($this->session->flashdata('nv_error')): ?>
                        <div class="alert alert-danger nlad-error" role="alert">
                            <p class="text-center text-danger"><strong><?php echo $this->session->flashdata('nv_error_status') ?></strong></p>


                            
                            

                            <ol style="margin: 0;">

                                <?php if(in_array($this->session->flashdata('nv_error_status'), ['BAD_REQUEST'])):  ?>
                                <?php foreach($this->session->flashdata('nv_error') as $key): ?>
                                <li><?php echo $key['field'].': '.$key['description'] ?></li>
                                <?php endforeach; ?>
                                <?php endif; ?>

                                <?php if(in_array($this->session->flashdata('nv_error_status'), ['PENDING_RESOLUTION'])):  ?>
                                <?php foreach($this->session->flashdata('nv_error') as $key): ?>
                                <li><?php echo ucwords(strtolower($key)) ?></li>
                                <?php endforeach; ?>
                                <?php endif; ?>
                                
                                <?php if(in_array($this->session->flashdata('nv_error_status'), ['PENDING_RESOLUTION'])){
                                        echo '<li>Resolution: <a class="text-danger" style="font-size:14px;" href="'.$this->session->flashdata('nv_error_links')['resolution']['href'].'" target="_blank" rel="noopener noreferrer">Click Here</a></li>';
                                    } else if(in_array($this->session->flashdata('nv_error_status'), ['PENDING_CERT'])){
                                        print_r($this->session->flashdata('nv_error_link'));
                                        echo '<li>Certification: <a href="'.$this->session->flashdata('nv_error_links')['certification']['href'].'" target="_blank" rel="noopener noreferrer">Click Here</a></li>';
                                    }
                                ?>
                                
                            </ol>

                        </div>
                        <?php endif; ?>
                        <h2>Personal Info</h2>
                        <!-- Sec 1 -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group user">
                                    <label for="s">First Name*</label>
                                    <input type="text" name="consumer[first_name]" class="form-control profile_field"
                                        placeholder="Type first name here"
                                        value="<?php echo $consumer->first_name ?>" required />
                                        <div class="invalid-feedback">
                                            Please enter a first name.
                                        </div>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="form-group user">
                                    <label for="s">Last Name*</label>
                                    <input type="text" name="consumer[last_name]" class="form-control profile_field"
                                        placeholder="Type last name here"
                                        value="<?php echo $consumer->last_name ?>" required />
                                    <div class="invalid-feedback">
                                        Please enter a last name.
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="s">Phone Number*</label>
                                    <input type="tel" name="consumer[contact_no]" class="form-control cleave-input-phone profile_field"
                                        placeholder="012-345-6789"
                                        value="<?php echo $consumer->contact_no ?>" required />
                                    <div class="invalid-feedback">
                                        Please enter a contact no.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="s">Email*</label>
                                    <input type="email" name="user[email]" class="form-control profile_field"
                                        placeholder="info@gmail.com" value="<?php echo $user->email ?>"
                                        required />
                                    <div class="invalid-feedback">
                                        Please enter an email.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="s">Date Of Birth*</label>
                                    <!-- <div class="input-group date"
                                            data-date-format="mm-dd-yyyy" value="<?php echo date('m/d/Y', strtotime($consumer->dob)) ?>"> -->
                                    <input id="datepicker2" name="consumer[dob]" class="form-control profile_field"
                                        type="text" placeholder="Select Date"
                                        value="<?php echo is_null($consumer->dob) ? null : date('m/d/Y', strtotime($consumer->dob)) ?>"
                                        required />
                                    <div class="invalid-feedback">
                                        Please enter a date of borth.
                                    </div>
                                    <span class="input-group-addon"><i
                                            class="glyphicon glyphicon-calendar"></i></span>
                                    <!-- </div> -->
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="s">Last 4 of SSN*</label>
                                    <input type="text" name="consumer[ssn]" class="form-control profile_field"
                                        placeholder="Enter 4 off SSN No"
                                        value="<?php echo $consumer->ssn ?>" maxlength="4"
                                        onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57"
                                        required />
                                    <div class="invalid-feedback">
                                        Please enter a 4 no of ssn.
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="s">Lifeline Program</label>
                                    <select name="consumer[lifeline_program]" id="lifeline_program" class="profile_field">
                                        <option value="" disabled selected>Select lifeline program</option>
                                        <option value="Food Stamps/SNAP"
                                            <?php echo $consumer->lifeline_program == 'Food Stamps/SNAP' ? 'selected' : '' ?>>
                                            Food Stamps/SNAP</option>
                                        <option value="Medicaid"
                                            <?php echo $consumer->lifeline_program == 'Medicaid' ? 'selected' : '' ?>>
                                            Medicaid</option>
                                        <option value="Supplemental Security Income (SSI)"
                                            <?php echo $consumer->lifeline_program == 'Supplemental Security Income (SSI)' ? 'selected' : '' ?>>
                                            Supplemental Security Income (SSI)</option>
                                        <option value="Section 8/Federal Public Housing Assistance"
                                            <?php echo $consumer->lifeline_program == 'Section 8/Federal Public Housing Assistance' ? 'selected' : '' ?>>
                                            Section 8/Federal Public Housing Assistance</option>
                                        <option value="Bureau of Indian Affairs General Assistance"
                                            <?php echo $consumer->lifeline_program == 'Bureau of Indian Affairs General Assistance' ? 'selected' : '' ?>>
                                            Bureau of Indian Affairs General Assistance</option>
                                        <option
                                            value="Federal Veterans Affairs (VA) Veterans Pension or Survivors Pension"
                                            <?php echo $consumer->lifeline_program == 'Federal Veterans Affairs (VA) Veterans Pension or Survivors Pension' ? 'selected' : '' ?>>
                                            Federal Veterans Affairs (VA) Veterans Pension or Survivors
                                            Pension</option>
                                        <option value="Income Based Eligibility"
                                            <?php echo $consumer->lifeline_program == 'Income Based Eligibility' ? 'selected' : '' ?>>
                                            Income Based Eligibility </option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select lifeline program.
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row income_otr" style="display:<?php echo $consumer->lifeline_program == 'Income Based Eligibility' ? '' : 'none' ?>">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="s">Income*</label>
                                    <select class="form-control" name="consumer[income]" id="income">
                                        <option value="">Select income</option>
                                    </select>
                                </div>
                            </div>
                        </div>


                        <!-- Sec 2 -->
                        <h2>Physical Address</h2>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="adflx">
                                    <label class="container">Permanent
                                        <input class="profile_field" type="radio" name="consumer[address_type]" value="permanent"
                                            <?php echo $consumer->address_type == 'permanent' ? 'checked' : '' ?>>
                                        <span class="checkmark"></span>
                                    </label>
                                    <label class="container">Temporary
                                        <input class="profile_field" type="radio" name="consumer[address_type]" value="temporary"
                                            <?php echo $consumer->address_type == 'temporary' ? 'checked' : '' ?>>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="row pdng35">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="s">Street Address*</label>
                                    <input type="text" id="street_address" name="consumer[address]"
                                        class="form-control profile_field" placeholder="Enter Address here"
                                        value="<?php echo $consumer->address ?>" required />
                                    <div class="invalid-feedback">
                                        Please enter street address.
                                    </div>
                                </div>
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="s">Apt</label>
                                    <input type="text" name="consumer[apt_room]" class="form-control profile_field"
                                        placeholder="Enter Room"
                                        value="<?php echo $consumer->apt_room ?>" />
                                    <div class="invalid-feedback">
                                        Please enter apt room.
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="s">City*</label>
                                    <input type="text" id="city" name="consumer[city]" class="form-control profile_field"
                                        placeholder="Enter City" value="<?php echo $consumer->city ?>"
                                        required />
                                    <div class="invalid-feedback">
                                        Please enter city.
                                    </div>
                                </div>
                            </div>



                        </div>

                        <div class="row">


                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="s">State*</label>
                                    <select class="form-control profile_field" name="consumer[state_id]" id="state">
                                        <option>Select state</option>
                                        <?php foreach($service_provider_state as $key): ?>
                                        <option value="<?php echo $key->id ?>"
                                            <?php echo $consumer->state_id == $key->id ? 'selected' : '' ?>
                                            data-code="<?php echo $key->code ?>"><?php echo $key->name ?>
                                        </option>
                                        <?php endforeach; ?>
                                    </select>
                                    <div class="invalid-feedback">
                                        Please select a state.
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="s">Zip Code*</label>
                                    <input type="text" id="postal_code" name="consumer[zip]"
                                        class="form-control profile_field" placeholder="Enter Zip Code"
                                        value="<?php echo $consumer->zip ?>" maxlength="6"
                                        onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57"
                                        required />
                                    <div class="invalid-feedback">
                                        Please enter zipcode.
                                    </div>
                                </div>
                            </div>


                        </div>

                        <!-- Sec 3 -->
                        <div class="pdng35">
                            <h2>What is the best way to reach you?</h2>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="adflx">
                                        <label class="container">Email
                                            <input class="profile_field" type="radio" name="consumer[how_to_reach]" value="email"
                                                <?php echo $consumer->how_to_reach == 'email' ? 'checked' : '' ?> required>
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="container">Phone
                                            <input class="profile_field" type="radio" name="consumer[how_to_reach]" value="phone"
                                                <?php echo $consumer->how_to_reach == 'phone' ? 'checked' : '' ?> required>
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="container">Message
                                            <input class="profile_field" type="radio" name="consumer[how_to_reach]"
                                                value="message"
                                                <?php echo $consumer->how_to_reach == 'message' ? 'checked' : '' ?> required>
                                            <span class="checkmark"></span>
                                        </label>
                                        <label class="container">Mail
                                            <input class="profile_field" type="radio" name="consumer[how_to_reach]" value="mail"
                                                <?php echo $consumer->how_to_reach == 'mail' ? 'checked' : '' ?> required>
                                            <span class="checkmark"></span>
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- Sec 4 -->
                        <div class="pdng35">
                            <h2>Shipping Address</h2>
                            <div class="checkbox checkbox-primary">
                                <input id="myCheck" class="profile_field" type="checkbox" onclick="myFunction()"
                                    name="consumer[shipping_address_set]" value="1"
                                    <?php echo $consumer->shipping_address_set == 1  ? 'checked' : '' ?>>
                                <label class="container" for="myCheck">Different from Physical
                                    Address.</label>
                            </div>
                            <div class="yy" id="text"
                                style="display:<?php echo $consumer->shipping_address_set == 1  ? '' : 'none' ?>;">

                                <div class="row pdng35">
                                    <div class="col-md-6">
                                        <div class="form-group">

                                            <label for="s">Shipping Address</label>
                                            <input type="text" id="shipping_address"
                                                name="consumer[shipping_address]" class="form-control profile_field"
                                                placeholder="Enter Address here"
                                                value="<?php echo $consumer->shipping_address ?>" />
                                            <div class="invalid-feedback">
                                                Please enter shipping address.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="s">Apt/Room</label>
                                            <input type="text" name="consumer[shipping_apt_room]"
                                                class="form-control profile_field" placeholder="Enter Room"
                                                value="<?php echo $consumer->shipping_apt_room ?>" />
                                            <div class="invalid-feedback">
                                                Please enter shipping apt room.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="s">Shipping City</label>
                                            <input type="text" name="consumer[shipping_city]"
                                                id="shipping_city" class="form-control profile_field"
                                                placeholder="Enter City"
                                                value="<?php echo $consumer->shipping_city ?>" />
                                            <div class="invalid-feedback">
                                                Please enter shipping city.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="s">Zip Code*</label>
                                            <input type="text" name="consumer[shipping_zip]"
                                                id="shipping_postal_code" class="form-control profile_field"
                                                placeholder="Enter Zip Code"
                                                value="<?php echo $consumer->shipping_zip ?>" maxlength="6"
                                                onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" />
                                            <div class="invalid-feedback">
                                                Please enter shipping zip.
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        </form>
                    </div>

                    <div class="passchange_sec">
                        <div class="cmmn_title">
                            <h2>Change Password</h2>
                        </div>

                        <?php if($this->session->flashdata('ps_error')): ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $this->session->flashdata('ps_error')  ?>
                        </div>
                        <?php endif; ?>

                        <form action="<?php echo base_url('UserController/update_password_consumer_profile/'.$consumerID->user_id)?>" name="password_reset" method="POST">
                            <div class="form-group">
                                <input type="password" class="form-control" name="prev_ps" placeholder="Current Password*" required="">
                                <small class="form-text text-primary">
                                    Default password is 123456
                                </small>
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="new_ps" passwordCheck="passwordCheck" placeholder="New Password*" required="">
                                <small id="passwordHelpBlock" class="form-text text-muted text-danger">
                                    Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters.
                                </small>
                            </div>
                            <!-- <ul class='field__rules'>
                                <li class="active">One lowercase character</li>
                                <li>One uppercase character</li>
                                <li>One number</li>
                                <li>One special character</li>
                                <li>8 characters minimum</li>
                            </ul> -->
                            <div class="form-group">
                                <input type="password" class="form-control" name="con_ps" placeholder="Confirm Password*" required="">
                            </div>
                            <button type="submit" class="btn">Update</button>
                        </form>
                    </div>
                </div>
                <div class="pdng35 text-center">
                    <button type="submit" class="btn btn-default formbtn" form="consumer_profile_form">Submit</button>
                    <a href="<?php echo base_url('nv/check/'.$user->user_id) ?>"
                        class="btn btn-default formbtn nv_check_btn">NV Check</a>
                    <a href="<?php echo base_url('nlad/check/'.$user->user_id) ?>"
                        class="btn btn-default formbtn nlad_check_btn">Nlad Check</a>
                    <input type="hidden" name="profile_field_touched" value="0">
                </div>
            </div>
        </div>
    </div>
</section>


<?php include('inc/footer.php') ?>


<?php include('inc/common_scripts.php') ?>

<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
            
        }
        form.classList.add('was-validated');
        if($(".invalid-feedback:visible").length > 0){
            $([document.documentElement, document.body]).animate({
                scrollTop: $(".invalid-feedback:visible").offset().top - 75
            }, 750);
        }
      }, false);
    });
  }, false);
})();
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

<script>
    $(document).on('change', '.profile_field', function(){
        var val = $('input[name="profile_field_touched"]').val();
        // alert(val);
        $('input[name="profile_field_touched"]').val(val++);
    });
    
    $(document).on('click', '.nv_check_btn', function(e){
        e.preventDefault();

        var profile_field_touched = $('input[name="profile_field_touched"]').val();

        if(profile_field_touched > 2){
            Swal.fire('Please update first. fields has been changed');
        } else {
            window.location.href = $(this).attr('href');
        }
    });
    
    $(document).on('click', '.nlad_check_btn', function(e){
        e.preventDefault();

        var profile_field_touched = $('input[name="profile_field_touched"]').val();

        if(profile_field_touched > 2){
            Swal.fire('Please update first. fields has been changed');
        } else {
            window.location.href = $(this).attr('href');
        }
    });
</script>

<script type="text/javascript">
// $(function() {
//     // $("#datepicker").datepicker({
//     //     format: "dd-mm-yyyy",
//     //     autoclose: true,
//     //     todayHighlight: true,
//     //     endDate: '+0d',
//     //     startDate: new Date('1-1-1990')
//     // }).datepicker('update', new Date());
//     // $("#datepicker2").datepicker();
// });
</script>

<script type="text/javascript">
function readURL1(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('.neimg_cls').hide();
            $('.image-upload-wrap').hide();
            $('.file-upload-image').attr('src', e.target.result);
            $('.file-upload-content').show();
            $('.image-title').html(input.files[0].name);
        };
        reader.readAsDataURL(input.files[0]);
    } else {
        removeUpload1();
    }
}

function removeUpload1() {
    $('.file-upload-input1').replaceWith($('.file-upload-input1').clone());
    $('.file-upload-content').hide();
    $('.image-upload-wrap').show();
}
$('.image-upload-wrap').bind('dragover', function() {
    $('.image-upload-wrap').addClass('image-dropping');
});
$('.image-upload-wrap').bind('dragleave', function() {
    $('.image-upload-wrap').removeClass('image-dropping');
});

/* Upload sec 2 */
function readURL2(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('.neimg_cls2').hide();
            $('.image-upload-wrap').hide();
            $('.file-upload-image2').attr('src', e.target.result);
            $('.file-upload-content2').show();
            $('.image-title2').html(input.files[0].name);
        };
        reader.readAsDataURL(input.files[0]);
    } else {
        removeUpload2();
    }
}

function removeUpload2() {
    $('.file-upload-input2').replaceWith($('.file-upload-input2').clone());
    $('.file-upload-content2').hide();
    $('.image-upload-wrap').show();
}

$('.image-upload-wrap').bind('dragover', function() {
    $('.image-upload-wrap').addClass('image-dropping');
});

$('.image-upload-wrap').bind('dragleave', function() {
    $('.image-upload-wrap').removeClass('image-dropping');
});

$(document).ready(function() {
    $("select option:first-child").attr("disabled", "true");
});
</script>


<script>
function myFunction() {
    // Get the checkbox
    var checkBox = document.getElementById("myCheck");
    // Get the output text
    var text = document.getElementById("text");
    // If the checkbox is checked, display the output text
    if (checkBox.checked == true) {
        $('#myCheck').val(1);
        text.style.display = "block";
    } else {
        $('#myCheck').val(0);
        text.style.display = "none";
    }
}
</script>


<script
    src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyA3-pecaK5H2_enOKnleuDJchGBWykDvw4">
</script>
<!-- <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA3-pecaK5H2_enOKnleuDJchGBWykDvw4&amp;libraries=places&amp;callback=initAutocomplete" async="" defer=""></script> -->
<script>
var componentForm = {
    street_number: 'short_name',
    route: 'long_name',
    locality: 'long_name',
    administrative_area_level_1: 'short_name',
    country: 'long_name',
    postal_code: 'short_name'
};

$(document).ready(function() {
    var autocomplete;
    autocomplete = new google.maps.places.Autocomplete((document.getElementById('street_address')), {
        types: ['geocode'],
        componentRestrictions: {
            country: "USA"
        }
    });

    autocomplete.setFields(['address_component']);

    google.maps.event.addListener(autocomplete, 'place_changed', function() {
        var place = autocomplete.getPlace();

        $('#street_address').val(place.address_components[0].short_name+' '+place.address_components[1].short_name);
        
        for (var i = 0; i < place.address_components.length; i++) {
            var addressType = place.address_components[i].types[0];


            if (addressType == 'locality') {
                $('#city').val(place.address_components[i].long_name);
            }


            if (addressType == 'administrative_area_level_1') {
                $("#state option").each(function() {
                    if ($(this).data('code') == place.address_components[i].short_name) {
                        $(this).attr("selected", "selected");
                    }
                });
            }

            if (addressType == 'postal_code') {
                $('#postal_code').val(place.address_components[i].long_name)
            }

        }
    });


    var autocomplete_shipping;
    autocomplete_shipping = new google.maps.places.Autocomplete((document.getElementById('shipping_address')), {
        types: ['geocode'],
        componentRestrictions: {
            country: "USA"
        }
    });

    google.maps.event.addListener(autocomplete_shipping, 'place_changed', function() {
        var place = autocomplete_shipping.getPlace();
        $('#shipping_address').val(place.address_components[0].short_name+' '+place.address_components[1].short_name);
        for (var i = 0; i < place.address_components.length; i++) {
            var addressType = place.address_components[i].types[0];

            if (addressType == 'locality') {
                $('#shipping_city').val(place.address_components[i].long_name)
            }

            if (addressType == 'postal_code') {
                $('#shipping_postal_code').val(place.address_components[i].long_name)
            }

        }
    });
});
</script>


<script>
    $("input[name='user[email]']").focusout(function(){
        var email = $(this).val();
        if(email != ''){
            $.ajax({
                url: '<?php echo base_url('UserController/email_check/'.$user->user_id) ?>',
                data: {'email' : email},
                type: 'post',
                dataType: 'json',
                success:function(data){
                    if(data.error){
                       
                        Swal.fire({
                            title: "Warning",
                            text: "Email ("+email+") already exist please try another one!",
                            icon: 'warning',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: 'Ok'
                        }).then((result) => {
                            if (result.value) {
                                $("input[name='user[email]']").val('');
                            }
                        })
                    }
                }
            });
        }
    });
</script>


<script>
    $(document).on('change', '#lifeline_program', function(){
        var val = $(this).val();
        var state = $('#state').val();
        if(val == 'Income Based Eligibility'){
            $('.income_otr').show();
            $('.income_otr #income').attr('required', 'required');
            $.ajax({
                url: '<?php echo base_url('UserController/get_income_options') ?>',
                data: {'state': state},
                type: 'post',
                success:function(data){
                    $('#income').html(data);
                    // console.log(data);
                    setTimeout(() => {
                        $('#income').val('<?php echo $consumer->income ?>').change();
                    }, 1000);
                }
            })
        } else {
            $('.income_otr').hide();
            $('.income_otr #income').removeAttr('required');
        }
    });

    $(document).on('change', '#state', function(){
        $('#lifeline_program').change();
    });
</script>

<?php if($consumer->lifeline_program == 'Income Based Eligibility'): ?>
<script>
    $('#lifeline_program').change();
    setTimeout(() => {
        $('#income').val('<?php echo $consumer->income ?>').change();
    }, 1000);
</script>
<?php endif; ?>

<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/jquery.validate.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.2/dist/additional-methods.min.js"></script>
<script>
// Wait for the DOM to be ready
$(function() {
  // Initialize form validation on the registration form.
  // It has the name attribute "registration"
  jQuery.validator.addMethod("passwordCheck",
    function(value, element, param) {
        if (this.optional(element)) {
            return true;
        } else if (!/[A-Z]/.test(value)) {
            return false;
        } else if (!/[a-z]/.test(value)) {
            return false;
        } else if (!/[0-9]/.test(value)) {
            return false;
        } else if (!/[!@#$%^&*()_=\[\]{};':"\\|,.<>\/?+-]/.test(value)) {
            return false;
        }

        return true;
    },
    "error msg here");
  $("form[name='password_reset']").validate({
    errorClass: 'form-text text-danger',
    errorElement: 'small',
    // Specify validation rules
    rules: {
      prev_ps: {
        required: true,
      },
     
      new_ps: {
        required: true,
        minlength: 8
      },

      con_ps: {
        required: true,
        equalTo: "[name='new_ps']",
      },
    },
    // Specify validation error messages
    messages: {
      new_ps: {
        required: "Please provide a password",
        minlength: "Your password must be at least 8 characters long",
        passwordCheck: "Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters."
      },
    },
    // Make sure the form is submitted to the destination defined
    // in the "action" attribute of the form when valid
    submitHandler: function(form) {
      form.submit();
    }
  });
});
</script>

</body>

</html>