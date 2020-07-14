<?php include('inc/header.php') ?>
<section class="dasboard_info">
   <div class="container-fluid">
      <div class="dashboard-tab-innr">
         <?php include('inc/dashboard_tab.php') ?>
         <div class="capa-outr">
            <div class="planinf">
               <div class="plasec_one">Create Carrier Admin</div>
            </div>
            <div class="profile_info_sec">
               <div class="personalinfo_sec">
                  <form action="<?php echo base_url('UserController/carrier_admin_update/'.$carrier_admin->user_id) ?>" method="POST"
                     autocomplete="off" enctype="multipart/form-data" class="needs-validation" novalidate>
                     <div class="personalinfo_form cmmn_title">
                        <h2>Personal Info</h2>
                        <!-- Sec 1 -->
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group user">
                                 <label for="s">Name*</label>
                                 <input type="text" name="user[name]" class="form-control"
                                    placeholder="Type name here"  value="<?php echo $carrier_admin->user_name ?>" required/>
                                    <div class="invalid-feedback">
                                       Please enter a name.
                                    </div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="s">Email*</label>
                                 <input type="email" name="user[email]" class="form-control"
                                    placeholder="info@gmail.com" autocomplete="no" value="<?php echo $carrier_admin->user_email ?>" required />
                                 <div class="invalid-feedback">
                                       Please enter an email.
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- Sec 2 -->
                        <h2>Company Info</h2>
                        <div class="row pdng35">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="s">Company Name*</label>
                                 <input type="text" class="form-control" placeholder="Company Name"
                                    name="company[name]" value="<?php echo $carrier_admin->name ?>" required />
                                 <div class="invalid-feedback">
                                       Please enter a company name.
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-12">
                              <div class="form-group">
                                 <label for="s">Street Address*</label>
                                 <input type="text" class="form-control" id="street_address" placeholder="Enter address"
                                    name="company[address]" value="<?php echo $carrier_admin->address ?>" required />
                                 <div class="invalid-feedback">
                                       Please enter a street address.
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="s">Apt/Room</label>
                                 <input type="text" class="form-control" placeholder="Enter Room"
                                    name="company[apt_room]" value="<?php echo $carrier_admin->apt_room ?>" />
                                 <div class="invalid-feedback">
                                       Please enter an apt/room.
                                 </div>
                              </div>
                           </div>
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="s">City*</label>
                                 <input type="text" class="form-control" id= "city" placeholder="Enter City"
                                    name="company[city]" value="<?php echo $carrier_admin->city ?>" required />
                                 <div class="invalid-feedback">
                                       Please enter a city.
                                 </div>
                              </div>
                           </div>
                        </div>
                        <div class="row">
                           <div class="col-md-6">
                              <div class="form-group">
                                 <label for="s">State*</label>
                                 <select name="company[state]" id ="state" required>
                                    <option>Select state</option>
                                    <?php foreach($states as $key): ?>
                                    <option value="<?php echo $key->id ?>"  <?php echo $carrier_admin->state == $key->id ? 'selected' : '' ?> data-code="<?php echo $key->code ?>"><?php echo $key->name ?></option>
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
                                 <input type="text" class="form-control" placeholder="Enter Zip Code"
                                    name="company[zip]" id="postal_code" value="<?php echo $carrier_admin->zip ?>" required />
                                 <div class="invalid-feedback">
                                       Please enter a state.
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- Sec 3 -->
                        <div class="pdng35">
                           <h2>Customer Service</h2>
                           <div class="row">
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label for="s">Contact No*</label>
                                    <input type="text" class="form-control cleave-input-phone" placeholder="Enter contact no"
                                       name="company[contact_no]" value="<?php echo $carrier_admin->contact_no ?>" required />
                                    <div class="invalid-feedback">
                                       Please enter a contact no.
                                    </div>
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label for="s">Email*</label>
                                    <input type="email" class="form-control" placeholder="Enter email"
                                       name="company[email]" value="<?php echo $carrier_admin->email ?>" required />
                                    <div class="invalid-feedback">
                                       Please enter a contact email.
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="row">
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label for="s">Website url*</label>
                                    <input type="text" class="form-control" placeholder="Enter website url"
                                       name="company[website_url]" value="<?php echo $carrier_admin->website_url ?>" />
                                 </div>
                              </div>
                              <div class="col-md-6">
                                 <div class="form-group">
                                    <label for="s">Chat url</label>
                                    <input type="text" class="form-control" placeholder="Enter chat url"
                                       name="company[chat_url]" value="<?php echo $carrier_admin->chat_url ?>" />
                                    <div class="invalid-feedback">
                                       Please enter a chat url.
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                        <!-- ---------------------------sec4----------------------------->

                        
                        <div class="pdng35" id="payment_details">
                           <h2>Payment details</h2>
                           <div class="row">
                              <div class="col-md-6">
                              <div class="form-group">
                                 <label>Name</label>
                                 <input class="form-control" placeholder="Full Name" value="<?php echo isset($payment_method->card_name) ? ucwords(strtolower($payment_method->card_name)) : NULL ?>"  type="text" disabled />
                              </div>
                              </div>
                              <div class="col-md-6">
                              <div class="form-group">
                                 <label>Card Number</label>
                                 <input class="form-control" placeholder="Card Number" type="text" value="**** **** **** <?php echo isset($payment_method->card_number) ? $payment_method->card_number : NULL ?>" disabled />
                              </div>
                              </div>
                              <div class="col-md-6">
                              <div class="form-group">
                                 <label>Expiration (mm/yy)</label>
                                 <input class="form-control" placeholder="MM/YY" value="<?php echo isset($payment_method->expiry) ?  date('m/Y', strtotime($payment_method->expiry)) : NULL ?>" type="text" disabled />
                              </div>
                              </div>
                              <div class="col-md-6">
                              <div class="form-group">
                                 <label>Security Code</label>
                                 <input class="form-control" placeholder="CVC" type="text" value="***" disabled />
                              </div>
                              </div>
                              <div class="col-md-12">
                                 <div class="form-group text-right">
                                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#update_payment_modal">Update Payment Info</button>
                                 </div>
                              </div>
                           </div>
                        </div>



                        <!-- Sec 5 -->
                        <div class="pdng35 text-left">
                           <button type="submit" class="btn btn-primary">Update Profile</button>
                           <button type="reset" class="btn btn-secondary">Reset</button>
                        </div>
                     </div>
                  </form>

                  <hr>
             
                  <!-- <div class="personalinfo_form cmmn_title">
                     <form class="payment_method_form" action="<?php echo base_url('PaymentController/update_payment_method/'.$carrier_admin->user_id) ?>" method="POST">
                        <div class="pdng35">
                           <h2>Payment details</h2>
                           <div class="card-wrapper"></div>
                           <div class="row">
                              <div class="col-md-6">
                              <div class="form-group">
                                 <label>Name</label>
                                 <input class="form-control" placeholder="Full Name" type="text" name="name" />
                              </div>
                              </div>
                              <div class="col-md-6">
                              <div class="form-group">
                                 <label>Card Number</label>
                                 <input class="form-control" placeholder="Card Number" type="text" name="number" />
                              </div>
                              </div>
                              <div class="col-md-6">
                              <div class="form-group">
                                 <label>Expiration (mm/yy)</label>
                                 <input class="form-control" placeholder="MM/YY" type="text" name="expiry" />
                              </div>
                              </div>
                              <div class="col-md-6">
                              <div class="form-group">
                                 <label>Security Code</label>
                                 <input class="form-control" placeholder="CVC" type="text" name="cvc" />
                              </div>
                              </div>
                           </div>
                        </div>

                        <div class="pdng35 text-left">
                           <button type="submit" class="btn btn-primary">Update Payment Method</button>
                        </div>
                     </form>
                  </div> -->
               </div>
               <div class="passchange_sec">
                  <div class="cmmn_title">
                     <h2>Change Password</h2>
                  </div>
                  <form action="<?php echo base_url('UserController/upload_password/'.$carrier_admin->user_id) ?>" name="password_reset" method="POST" >
                     <?php if($this->session->flashdata('ps_error')): ?>
                     <div class="alert alert-danger text-center" style="font-size: 14px;" role="alert">
                        <?php echo $this->session->flashdata('ps_error') ?>
                     </div>
                     <?php endif; ?>
                     <div class="form-group">
                        <input type="password" class="form-control" name="prev_ps" placeholder="Current Password*" required />
                     </div>
                     <div class="form-group">
                        <input type="password" class="form-control" name="new_ps" passwordCheck="passwordCheck" placeholder="New Password*" required />
                        <small id="passwordHelpBlock" class="form-text text-muted text-danger">
                           Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters.
                        </small>
                     </div>
                     <div class="form-group">
                        <input type="password" class="form-control" name="con_ps" placeholder="Confirm Password*" required />
                     </div>
                     <button type="submit" class="btn">Update</button>
                  </form>
                  <hr>
                  <div class="cmmn_title">
                     <h2>Upload Files</h2>
                     <!-- <p>Carriers need to verify identity<br> and proof of eligibility</p> -->
                  </div>
                  <form action="<?php echo base_url('UserController/upload_logo_carrier_admin/'.$carrier_admin->user_id) ?>" method="POST" enctype="multipart/form-data">
                     <div class="file-upload <?php echo $carrier_admin->logo != NULL ? 'file-uploaded' : '' ?>">
                        <h5>Logo</h5>
                        <button class="btn" type="button"
                           onclick="$('.file-upload-input1').trigger( 'click' )">Upload</button>
                        <div class="neimg_cls">No File Chosen</div>
                        <div class="image-upload-wrap">
                           <input class="file-upload-input1" type='file' name='file' onchange="readURL1(this);"
                              accept="image/*" required />
                        </div>
                        <div class="file-upload-content">
                           <img class="file-upload-image" src="<?php echo base_url('uploads/'.$carrier_admin->logo) ?>" alt="your image" />
                           <div class="image-title-wrap">
                              <button class="btn" type="submit">Update</button>
                              <button class="btn btn-secondary" type="button" onclick="removeUpload1()"
                                 class="remove-image">
                                 Remove
                                 <!-- <span class="image-title">Uploaded Image</span> -->
                              </button>
                           </div>
                        </div>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>
<?php include('inc/footer.php') ?>
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


<div class="modal fade" id="update_payment_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
   aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Payment Method</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form class="payment_method_form needs-validation" id="payment_method_form" action="<?php echo base_url('PaymentController/update_payment_method/'.$carrier_admin->user_id) ?>" method="POST"  novalidate>
               <div class="pdng35">
                  <div class="card-wrapper"></div>
                  <div class="row">
                     <div class="col-md-6">
                     <div class="form-group">
                        <label>Name</label>
                        <input class="form-control" placeholder="Full Name" type="text" name="name" required />
                        <div class="invalid-feedback">
                           Please enter a card name.
                        </div>
                     </div>
                     </div>
                     <div class="col-md-6">
                     <div class="form-group">
                        <label>Card Number</label>
                        <input class="form-control" placeholder="Card Number" type="text" name="number" required />
                        <div class="invalid-feedback">
                           Please enter a valid card number.
                        </div>
                     </div>
                     </div>
                     <div class="col-md-6">
                     <div class="form-group">
                        <label>Expiration (mm/yy)</label>
                        <input class="form-control" placeholder="MM/YY" type="text" name="expiry" required />
                        <div class="invalid-feedback">
                           Please enter a valid expiry.
                        </div>
                     </div>
                     </div>
                     <div class="col-md-6">
                     <div class="form-group">
                        <label>Security Code</label>
                        <input class="form-control" placeholder="CVC" type="text" name="cvc" required />
                        <div class="invalid-feedback">
                           Please enter a valid cvc.
                        </div>
                     </div>
                     </div>
                  </div>
               </div>

               <!-- <div class="pdng35 text-left">
                  <button type="submit" class="btn btn-primary">Update Payment Method</button>
               </div> -->
            </form>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="submit" form="payment_method_form" class="btn btn-primary" id="gn_ps_sv_btn">Update Payment Method</button>
         </div>
      </div>
   </div>
</div>


<?php include('inc/common_scripts.php') ?>
<script src="<?php echo base_url('assets/js/card.js') ?>"></script>

<?php if($this->session->flashdata('success')): ?>
<script>
   Swal.fire(
       'Good job!',
       '<?php echo $this->session->flashdata('success') ?>',
       'success'
   )
</script>
<?php endif; ?>

<?php if($this->session->flashdata('error')): ?>
<script>
   Swal.fire(
       "Error",
       "<?php echo $this->session->flashdata("error") ?>",
       "error"
   )
</script>
<?php endif; ?>




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
                console.log("locality");
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
                console.log("postal_code");
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