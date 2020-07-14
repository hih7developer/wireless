<?php include('inc/header.php') ?>

<section class="dasboard_info">
    <div class="container-fluid">
        <div class="dashboard-tab-innr">
            <?php include('inc/dashboard_tab.php') ?>
            <div class="capa-outr">
                <form action="<?php echo base_url('UserController/edit_consumer_profile') ?>" method="post">
                    <div class="account_sec">
                        <div class="profile_info_sec">
                            <div class="account_tabsec1">
                                <div class="personalinfo_form cmmn_title">
                                    <?php if($this->session->flashdata('error')): ?>
                                    <div class="alert alert-danger nlad-error" role="alert">
                                        <ol style="margin: 0;">
                                            <?php foreach($this->session->flashdata('error') as $key => $value): ?>
                                            <li><?php echo $value[0].': '.$value[1] ?></li>
                                            <?php endforeach; ?>
                                        </ol>
                                    </div>
                                    <?php endif; ?>
                                    <h2>Personal Info</h2>
                                    <!-- Sec 1 -->
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group user">
                                                <label for="s">First Name*</label>
                                                <input type="text" name="consumer[first_name]" class="form-control"
                                                    placeholder="Type first name here" value="<?php echo $consumer->first_name ?>" required/>
                                            </div>
                                        </div>
                                        
                                        
                                        <div class="col-md-6">
                                            <div class="form-group user">
                                                <label for="s">Last Name*</label>
                                                <input type="text" name="consumer[last_name]" class="form-control"
                                                    placeholder="Type last name here" value="<?php echo $consumer->last_name ?>" required/>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="s">Phone Number*</label>
                                                <input type="tel" name="consumer[contact_no]" class="form-control"
                                                    placeholder="012-345-6789"
                                                    value="<?php echo $consumer->contact_no ?>" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="s">Email*</label>
                                                <input type="email" name="user[email]" class="form-control"
                                                    placeholder="info@gmail.com" value="<?php echo $user->email ?>" required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="s">Date Of Birth*</label>
                                                <!-- <div class="input-group date"
                                                        data-date-format="mm-dd-yyyy" value="<?php echo date('m-d-Y', strtotime($consumer->dob)) ?>"> -->
                                                <input id="datepicker2" name="consumer[dob]" class="form-control"
                                                    type="text" placeholder="Select Date"
                                                    value="<?php echo date('m-d-Y', strtotime($consumer->dob)) ?>" required />
                                                <span class="input-group-addon"><i
                                                        class="glyphicon glyphicon-calendar"></i></span>
                                                <!-- </div> -->
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="s">Last 4 of SSN*</label>
                                                <input type="text" name="consumer[ssn]" class="form-control"
                                                    placeholder="Enter 4 off SSN No" value="<?php echo $consumer->ssn ?>" maxlength="4" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" required />
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="s">Food Stamps/SNAP</label>
                                                <select name="consumer[food_stamp_snap]">
                                                    <option value="Food Stamps/SNAP" <?php echo $consumer->food_stamp_snap == 'Food Stamps/SNAP' ? 'selected' : '' ?>>Food Stamps/SNAP</option>
                                                    <option value="Medicaid" <?php echo $consumer->food_stamp_snap == 'Medicaid' ? 'selected' : '' ?>>Medicaid</option>
                                                    <option value="Supplemental Security Income (SSI)" <?php echo $consumer->food_stamp_snap == 'Supplemental Security Income (SSI)' ? 'selected' : '' ?>>Supplemental Security Income (SSI)</option>
                                                    <option value="Section 8/Federal Public Housing Assistance" <?php echo $consumer->food_stamp_snap == 'Section 8/Federal Public Housing Assistance' ? 'selected' : '' ?>>Section 8/Federal Public Housing Assistance</option>
                                                    <option value="Bureau of Indian Affairs General Assistance" <?php echo $consumer->food_stamp_snap == 'Bureau of Indian Affairs General Assistance' ? 'selected' : '' ?>>Bureau of Indian Affairs General Assistance</option>
                                                    <option value="Federal Veterans Affairs (VA) Veterans Pension or Survivors Pension" <?php echo $consumer->food_stamp_snap == 'Federal Veterans Affairs (VA) Veterans Pension or Survivors Pension' ? 'selected' : '' ?>>Federal Veterans Affairs (VA) Veterans Pension or Survivors Pension</option>
                                                    <option value="Income Based Eligibility" <?php echo $consumer->food_stamp_snap == 'Income Based Eligibility' ? 'selected' : '' ?>>Income Based Eligibility </option>
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
                                                    <input type="radio" name="consumer[address_type]" value="permanent"
                                                        <?php echo $consumer->address_type == 'permanent' ? 'checked' : '' ?>>
                                                    <span class="checkmark"></span>
                                                </label>
                                                <label class="container">Temporary
                                                    <input type="radio" name="consumer[address_type]" value="temporary"
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
                                                <input type="text" id="street_address" name="consumer[address]" class="form-control"
                                                    placeholder="Enter Address here"
                                                    value="<?php echo $consumer->address ?>" required />
                                            </div>
                                        </div>
                                      
                                    </div>

                                    <div class="row">

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="s">City*</label>
                                                <input type="text" id="city" name="consumer[city]" class="form-control"
                                                    placeholder="Enter City" value="<?php echo $consumer->city ?>" required />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="s">State*</label>
                                                <select class="form-control" name="consumer[state_id]" id="state">
                                                    <option>Select state</option>
                                                    <?php foreach($service_provider_state as $key): ?>
                                                    <option value="<?php echo $key->id ?>" <?php echo $consumer->state_id == $key->id ? 'selected' : '' ?> data-code="<?php echo $key->code ?>"><?php echo $key->name ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                        </div>


                                    </div>

                                    <div class="row">
                            
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="s">Zip Code*</label>
                                                <input type="text" id="postal_code" name="consumer[zip]" class="form-control"
                                                    placeholder="Enter Zip Code" value="<?php echo $consumer->zip ?>" maxlength="6" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" required />
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="s">Apt/Room</label>
                                                <input type="text" name="consumer[apt_room]" class="form-control"
                                                    placeholder="Enter Room" value="<?php echo $consumer->apt_room ?>" />
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
                                                        <input type="radio" name="consumer[how_to_reach]" value="email"
                                                            <?php echo $consumer->how_to_reach == 'email' ? 'checked' : '' ?>>
                                                        <span class="checkmark"></span>
                                                    </label>
                                                    <label class="container">Phone
                                                        <input type="radio" name="consumer[how_to_reach]" value="phone"
                                                            <?php echo $consumer->how_to_reach == 'phone' ? 'checked' : '' ?>>
                                                        <span class="checkmark"></span>
                                                    </label>
                                                    <label class="container">Message
                                                        <input type="radio" name="consumer[how_to_reach]" value="message"
                                                            <?php echo $consumer->how_to_reach == 'message' ? 'checked' : '' ?>>
                                                        <span class="checkmark"></span>
                                                    </label>
                                                    <label class="container">Mail
                                                        <input type="radio" name="consumer[how_to_reach]" value="mail"
                                                            <?php echo $consumer->how_to_reach == 'mail' ? 'checked' : '' ?>>
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
                                            <input id="myCheck" type="checkbox" onclick="myFunction()"  name="consumer[shipping_address_set]" value="1" <?php echo $consumer->shipping_address_set == 1  ? 'checked' : '' ?> >
                                            <label class="container" for="myCheck">Different from Physical Address.</label>
                                        </div>
                                        <div class="yy" id="text" style="display:<?php echo $consumer->shipping_address_set == 1  ? '' : 'none' ?>;">
                                        
                                    <div class="row pdng35">
                                        <div class="col-md-6">
                                            <div class="form-group">                                     
                                                                                                                                              
                                                <label for="s">Shipping Address</label>
                                                <input type="text" id="shipping_address" name="consumer[shipping_address]" class="form-control"
                                                    placeholder="Enter Address here"
                                                    value="<?php echo $consumer->shipping_address ?>" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="s">Apt/Room</label>
                                                <input type="text" name="consumer[shipping_apt_room]" class="form-control"
                                                    placeholder="Enter Room" value="<?php echo $consumer->shipping_apt_room ?>" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="s">Shipping City</label>
                                                <input type="text" name="consumer[shipping_city]" id="shipping_city" class="form-control"
                                                    placeholder="Enter City" value="<?php echo $consumer->shipping_city ?>" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="s">Zip Code*</label>
                                                <input type="text" name="consumer[shipping_zip]" id="shipping_postal_code" class="form-control"
                                                    placeholder="Enter Zip Code" value="<?php echo $consumer->shipping_zip ?>" maxlength="6" onkeypress="return (event.charCode == 8 || event.charCode == 0 || event.charCode == 13) ? null : event.charCode >= 48 && event.charCode <= 57" />
                                            </div>
                                        </div>
                                    </div>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="account_tabsec2">
                                <div class="cmmn_title account_subtabsec">
                                    <h2>Upload Files</h2>
                                    <p>Carriers need to verify identity<br> and proof of eligibility</p>
                                    <hr>
                                    <span><a href="#">Click here</a> for help on proof<br> of program eligibility</span>
                                    <div class="file-upload">
                                        <h5>Photo ID</h5>
                                        <button class="btn btn-primary common-btn" type="button"
                                            onclick="$('.file-upload-input1').trigger( 'click' )">Upload</button>
                                        <div class="neimg_cls">No File Chosen</div>
                                        <div class="image-upload-wrap">
                                            <input class="file-upload-input1" type='file' onchange="readURL1(this);"
                                                accept="image/*" />
                                        </div>
                                        <div class="file-upload-content">
                                            <img class="file-upload-image" src="#" alt="your image" />
                                            <div class="image-title-wrap">
                                                <button type="button" onclick="removeUpload1()" class="remove-image">Remove
                                                    <!-- <span class="image-title">Uploaded Image</span> --></button>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="file-upload">
                                        <h5>Proof of Program Eligibility</h5>
                                        <button class="btn btn-primary common-btn" type="button"
                                            onclick="$('.file-upload-input2').trigger( 'click' )">Upload</button>
                                        <div class="neimg_cls2">No File Chosen</div>
                                        <div class="image-upload-wrap">
                                            <input class="file-upload-input2" type='file' onchange="readURL2(this);"
                                                accept="image/*" />
                                        </div>
                                        <div class="file-upload-content2">
                                            <img class="file-upload-image2" src="#" alt="your image" />
                                            <div class="image-title-wrap2">
                                                <button type="button" onclick="removeUpload2()" class="remove-image">Remove
                                                    <!-- <span class="image-title2">Uploaded Image</span> --></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="pdng35 text-center">
                            <button type="submit" class="btn btn-default formbtn">Submit</button>
                            <a href="<?php echo base_url('nlad/check/'.$user->user_id) ?>" class="btn btn-default formbtn">Nlad Check</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>


<?php include('inc/footer.php') ?>


<?php include('inc/common_scripts.php') ?>


<?php if($this->session->flashdata('success')): ?>
<script>
    Swal.fire(
        'Good job!',
        '<?php echo $this->session->flashdata('success') ?>',
        'success'
    )
</script>
<?php endif; ?>

<script type="text/javascript">
$(function() {
    $("#datepicker").datepicker({
        format: "dd-mm-yyyy",
        autoclose: true,
        todayHighlight: true,
        endDate: '+0d',
        startDate: new Date('1-1-1990')
    }).datepicker('update', new Date());
    $("#datepicker2").datepicker({
        autoclose: true,
        todayHighlight: true,
        endDate: '+0d',
        startDate: new Date('1-1-1990')
    }).datepicker('update', new Date());
});
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
  if (checkBox.checked == true){
    $('#myCheck').val(1);
    text.style.display = "block";
  } else {
    $('#myCheck').val(0);
    text.style.display = "none";
  }
}
</script>


<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyA3-pecaK5H2_enOKnleuDJchGBWykDvw4"></script>
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

$(document).ready(function () {
    var autocomplete;
    autocomplete = new google.maps.places.Autocomplete((document.getElementById('street_address')), {
        types: ['geocode'],
        componentRestrictions: {
            country: "USA"
        }
    });
	
    autocomplete.setFields(['address_component']);

    google.maps.event.addListener(autocomplete, 'place_changed', function () {
        var place = autocomplete.getPlace();
        for (var i = 0; i < place.address_components.length; i++) {
            var addressType = place.address_components[i].types[0];


            if(addressType == 'locality'){
                $('#city').val(place.address_components[i].long_name);
            }       

            
            if(addressType == 'administrative_area_level_1'){
                $("#state option").each(function(){     
                    if($(this).data('code')==place.address_components[i].short_name){
                        $(this).attr("selected","selected");
                    }
                });
            }    
            
            if(addressType == 'postal_code'){
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

    google.maps.event.addListener(autocomplete_shipping, 'place_changed', function () {
        var place = autocomplete_shipping.getPlace();
        for (var i = 0; i < place.address_components.length; i++) {
            var addressType = place.address_components[i].types[0];

            if(addressType == 'locality'){
                $('#shipping_city').val(place.address_components[i].long_name)
            }           
            
            if(addressType == 'postal_code'){
                $('#shipping_postal_code').val(place.address_components[i].long_name)
            }

        }
    });
});
</script>


</body>

</html>