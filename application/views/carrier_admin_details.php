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
                        <form class="needs-validation" action="<?php echo base_url('UserController/carrier_admin_update/'.$carrier_admin->user_id) ?>" method="POST"
                            autocomplete="off" enctype="multipart/form-data" novalidate>
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
                                                Please enter a email.
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
                                                Please enter a Company Name.
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
                                                Please enter a address.
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
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="s">City*</label>
                                            <input type="text" class="form-control" id="city" placeholder="Enter City"
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
                                            <select name="company[state]" id="state" required>
                                                <option>Select state</option>
                                                <?php foreach($states as $key): ?>
                                                <option value="<?php echo $key->id ?>"  <?php echo $carrier_admin->state == $key->id ? 'selected' : '' ?>><?php echo $key->name ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                            <div class="invalid-feedback">
                                            Please enter a state.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="s">Zip Code*</label>
                                            <input type="text" class="form-control" id="postal_code" placeholder="Enter Zip Code"
                                                name="company[zip]"  value="<?php echo $carrier_admin->zip ?>" required />
                                                <div class="invalid-feedback">
                                                Please enter a zip.
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
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="s">Email*</label>
                                                <input type="email" class="form-control" placeholder="Enter email"
                                                    name="company[email]" value="<?php echo $carrier_admin->email ?>" required />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="s">Website url</label>
                                                <input type="text" class="form-control" placeholder="Enter website url"
                                                    name="company[website_url]" value="<?php echo $carrier_admin->website_url ?>" />
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="s">Chat url</label>
                                                <input type="text" class="form-control" placeholder="Enter chat url"
                                                    name="company[chat_url]" value="<?php echo $carrier_admin->chat_url ?>" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Sec 5 -->
                                <div class="pdng35">
                                    <button type="submit" class="btn btn-lg">Update</button>
                                    <button type="reset" class="btn btn-secondary btn-lg">Reset</button>
                                </div>
                            </div>
                        </form>

                    </div>
                    <div class="passchange_sec">
                        <!-- <div class="cmmn_title">
                            <h2>Change Password</h2>
                        </div>
                        <form action="<?php echo base_url('UserController/upload_password/'.$carrier_admin->user_id) ?>" method="POST" >
                            <?php if($this->session->flashdata('ps_error')): ?>
                            <div class="alert alert-danger text-center" style="font-size: 14px;" role="alert">
                                <?php echo $this->session->flashdata('ps_error') ?>
                            </div>
                            <?php endif; ?>
                            <div class="form-group">
                                <input type="password" class="form-control" name="prev_ps" placeholder="Current Password*" required />
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="new_ps" placeholder="New Password*" required />
                            </div>
                            <div class="form-group">
                                <input type="password" class="form-control" name="con_ps" placeholder="Confirm Password*" required />
                            </div>
                            <button type="submit" class="btn">Update</button>
                        </form>
                        <hr> -->
                        <div class="cmmn_title">
                            <h2>Upload Files</h2>
                            <p>Company Logo</p>
                        </div>
                        <form action="<?php echo base_url('UserController/upload_logo_carrier_admin/'.$carrier_admin->user_id) ?>" method="POST" enctype="multipart/form-data">
                            <div class="file-upload <?php echo $carrier_admin->logo != NULL ? 'file-uploaded' : '' ?>">
                                <h5>Photo ID</h5>
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
                                            class="remove-image">Remove
                                            <!-- <span class="image-title">Uploaded Image</span> --></button>
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


<?php include('inc/common_scripts.php') ?>

<script>
    $("input[name='user[email]']").focusout(function(){
        var email = $(this).val();
        if(email != ''){
            $.ajax({
                url: '<?php echo base_url('UserController/email_check/'.$carrier_admin->user_id) ?>',
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

</body>

</html>