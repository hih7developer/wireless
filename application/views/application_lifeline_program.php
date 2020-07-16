<?php include('inc/header.php') ?>

<style>
.profile_field {
    display: none;
}
</style>

<section class="dasboard_info">
    <div class="container-fluid">
        <div class="dashboard-tab-innr">
			<?php include('inc/dashboard_tab.php') ?>
			<nav aria-label="breadcrumb">
				<ol class="breadcrumb application-breadcrumb">
					<li class="breadcrumb-item"><a href="<?php echo base_url('/') ?>">Plans</a></li>
					<li class="breadcrumb-item"><a href="<?php echo base_url('application/lifeline_program/'.$plan_id) ?>">Profile Details</a></li>
					<li class="breadcrumb-item active" aria-current="page"><a href="#">Lifelife Eligibity</a></li>
				</ol>
			</nav>
            <div class="capa-outr">
                <div class="planinf">
                    <div class="plasec_one">Lifeline Program Eligibility</div>
                </div>
                <div class="profile_info_sec">
                    <div class="personalinfo_sec w-100 cmmn_title">
                        <div class="col-md-12">
                            <form class="needs-validation" id="lifeline_eligibilty_form"
                                action="<?php echo base_url('ApplicationController/application_lifeline_action/'.$plan_id) ?>"
                                method="post" enctype="multipart/form-data" novalidate>
                                <div class="pdng35 checkbox-group">
                                    <h2>Qualify for Lifeline</h2>
                                    <small class="d-block mb-2">Check all programs that you or someone in your household
                                        have:</small>

                                    <div class="lifeline_program_invalid invalid-feedback"> Please check one program.
                                    </div>
                                    <?php foreach($lifeline_programs as $key): ?>
                                    <div class="checkbox checkbox-primary">
                                        <input
                                            class="profile_field <?php echo $key->lifeline_program_id == 6 ? 'income_program' : 'gov_program' ?>"
                                            name="lifeline[program][]" type="checkbox"
                                            value="<?php echo $key->lifeline_program_id ?>">
                                        <label class="container checklabel"><?php echo $key->program ?></label>
                                    </div>
                                    <?php endforeach; ?>
                                    <!-- <div class="checkbox checkbox-primary">
																		<input class="profile_field income_program" name="lifeline[qualify]" required type="checkbox" value="Income Based Eligibility">
																		<label class="container checklabel">Income Based Eligibility</label>
																</div> -->
                                </div>
                                <div class="row income_otr" style="display: none">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="s">Income*</label>
                                            <select class="form-control" name="lifeline[income]" id="income">
                                                <option value="">Select income</option>
                                            </select>
                                            <div class="invalid-feedback"> Please enter a income. </div>
                                        </div>
                                    </div>
                                </div>

                                <h2>Agreement</h2>

                                <div class="lifeline_agreement_invalid invalid-feedback">Please check agreements. </div>

                                <div class="pdng35">
                                    <?php foreach($lifeline_agreements as $key): ?>
                                    <div class="checkbox checkbox-primary">
                                        <input class="profile_field" type="checkbox" name="lifeline[agreement][]"
                                            value="<?php echo $key->lifeline_agreement_id ?>">
                                        <label class="container agreement"><?php echo $key->agreement ?></label>
                                    </div>
                                    <?php endforeach; ?>

                                </div>

                                <div class="row mt-2">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Signature</label>
                                            <input type="text" name="lifeline[signature][name]" id=""
                                                class="form-control" placeholder="" required>
                                            <div class="invalid-feedback">
                                                Please enter a today's date.
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="s">Today's Date*</label>
                                            <input id="datepicker2" name="lifeline[signature][date]"
                                                class="form-control" type="text" placeholder="Select Date"
                                                value="<?php echo date('m/d/Y') ?>" required />
                                            <div class="invalid-feedback">
                                                Please enter a today's date.
                                            </div>
                                            <span class="input-group-addon"><i
                                                    class="glyphicon glyphicon-calendar"></i></span>
                                        </div>
                                    </div>

                                </div>

                            </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mt-4 d-flex justify-content-between">
					<button  onclick="history.back();" class="btn btn-default formbtn">Back</button>
                    <button type="submit" class="btn btn-default formbtn ml-auto"
                        form="lifeline_eligibilty_form">Next</button>
                </div>
            </div>
        </div>
    </div>
</section>


<?php include('inc/footer.php') ?>


<?php include('inc/common_scripts.php') ?>


<script>
function programValidity() {
    var fields = $("input[name='lifeline[program][]']").serializeArray();
	alert(fields.length);
    if (fields.length === 0) {
        $('.lifeline_program_invalid').show();
        return false;
    } else {
        $('.lifeline_program_invalid').hide();
        return true;
    }
}

function agreementValidity() {
    var fields = $("input[name='lifeline[agreement][]']").serializeArray();
    if (fields.length === 0) {
        $('.lifeline_agreement_invalid').show();
        return false;
    } else {
        $('.lifeline_agreement_invalid').hide();
        return true;
    }
}

// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
    'use strict';
    window.addEventListener('load', function() {
        // Fetch all the forms we want to apply custom Bootstrap validation styles to
        var forms = document.getElementsByClassName('needs-validation');
        // Loop over them and prevent submission
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                if (form.checkValidity() === false && programValidity() &&
                    agreementValidity()) {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
                if ($(".invalid-feedback:visible").length > 0) {
                    $([document.documentElement, document.body]).animate({
                        scrollTop: $(".invalid-feedback:visible").eq(0).offset()
                            .top - 75
                    }, 750);
                }
            }, false);
        });
    }, false);
})();
</script>

<script>
$(document).on('click', '.checklabel', function() {
    var checkbox = $(this).prev();
    checkbox.prop('checked', !checkbox.prop('checked'));

    if (checkbox.hasClass('income_program')) {
        var val = checkbox.prop('checked');
        var state = "<?php echo $consumer->state_id ?>";
        if (val) {
            $('.gov_program').prop('checked', false);
            $('.income_otr #income').attr('required', 'required');
            $.ajax({
                url: '<?php echo base_url('UserController/get_income_options') ?>',
                data: {
                    'state': state
                },
                type: 'post',
                success: function(data) {
                    $('#income').html(data);
                    $('.income_otr').show();
                }
            })
        } else {
            $('.income_otr').hide();
            $('.income_otr #income').removeAttr('required');
        }
    } else {
        $('.income_program').prop('checked', false);
        $('.income_otr').hide();
        $('.income_otr #income').removeAttr('required');
    }
});

$(document).on('click', '.agreement', function() {
    var checkbox = $(this).prev();
    checkbox.prop('checked', !checkbox.prop('checked'));
});
</script>



</body>

</html>
