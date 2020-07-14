<?php include('inc/header.php') ?>

<section class="dasboard_info">
    <div class="container-fluid">
        <div class="dashboard-tab-innr">

            <?php include('inc/dashboard_tab.php') ?>
            <form class="needs-validation" action="<?php echo base_url('UserController/carrier_admin_insert') ?>" method="POST" autocomplete="off" enctype="multipart/form-data" novalidate>
            <div class="capa-outr">
                <div class="planinf">
                    <div class="plasec_one">Create Carrier Admin</div>

                </div>
                <div class="profile_info_sec">
                    <div class="personalinfo_sec">
                        <div class="personalinfo_form cmmn_title">

                                <?php if($this->session->flashdata('error')): ?>
                                <div class="alert alert-danger text-center" role="alert">
                                    <strong><?php echo $this->session->flashdata('error') ?></strong>
                                </div>
                                <?php endif; ?>

                                <h2>Personal Info</h2>
                                <!-- Sec 1 -->
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group user">
                                            <label for="s">Name*</label>
                                            <input type="text" name="user[name]" class="form-control"
                                                placeholder="Type name here" required />
                                                <div class="invalid-feedback">
                                                    Please enter a name.
                                                </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="s">Email*</label>
                                            <input type="email" name="user[email]" class="form-control"
                                                placeholder="info@gmail.com" autocomplete="no" required />
                                                <div class="invalid-feedback">
                                                    Please enter a email.
                                                </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="s">Password*</label>
                                            <input type="password" name="user[password]" class="form-control"
                                                placeholder="*******" autocomplete="new-password" required />
                                                <div class="invalid-feedback">
                                                    Please enter a password.
                                                </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-right">
                                        <button type="button" class="btn btn-secondary btn-sm" id="gn_ps_btn"
                                            data-toggle="modal" data-target="#generate_ps_modal">Generate
                                            Password</button>
                                    </div>
                                </div>
                                <!-- Sec 2 -->
                                <h2>Company Info</h2>
                                <div class="row pdng35">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="s">Company Name*</label>
                                            <input type="text" class="form-control" placeholder="Company Name"
                                                name="company[name]" required/>
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
                                                name="company[address]" required/>
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
                                                name="company[apt_room]"/>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="s">City*</label>
                                            <input type="text" class="form-control" id="city" placeholder="Enter City"
                                                name="company[city]" required />
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
                                            <select class="form-control" name="company[state]" id="state" required>
                                                <option value="" selected disabled>Select state</option>
                                                <?php foreach($states as $key): ?>
                                                <option data-code="<?php echo $key->code ?>" value="<?php echo $key->id ?>"><?php echo $key->name ?></option>
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
                                                name="company[zip]" required/>
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
                                                    name="company[contact_no]" required/>
                                                    <div class="invalid-feedback">
                                                        Please enter a contact no.
                                                    </div>

                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="s">Email*</label>
                                                <input type="email" class="form-control" placeholder="Enter email"
                                                    name="company[email]" required/>
                                                    <div class="invalid-feedback">
                                                        Please enter a email.
                                                    </div>

                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="s">Website url</label>
                                                <input type="text" class="form-control" placeholder="Enter website url"
                                                    name="company[website_url]"/>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="s">Chat url</label>
                                                <input type="text" class="form-control" placeholder="Enter chat url"
                                                    name="company[chat_url]"/>
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
                    <div class="passchange_sec cmmn_title">
                        <h2>Upload Files</h2>
                        <p>Carriers need to verify identity<br> and proof of eligibility</p>
                        <hr>
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
                                <img class="file-upload-image" src="#" alt="your image" />
                                <div class="image-title-wrap">
                                    <button class="btn btn-secondary" type="button" onclick="removeUpload1()" class="remove-image">Remove
                                        <!-- <span class="image-title">Uploaded Image</span> --></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </form>
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




<script>
    $("input[name='user[email]']").focusout(function(){
        var email = $(this).val();
        if(email != ''){
            $.ajax({
                url: '<?php echo base_url('UserController/email_check/') ?>',
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