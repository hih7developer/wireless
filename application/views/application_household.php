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
					<li class="breadcrumb-item"><a href="<?php echo base_url('application/eligibility_check/'.$plan_id) ?>">Profile Details</a></li>
					<li class="breadcrumb-item"><a href="<?php echo base_url('application/lifeline_program/'.$plan_id) ?>">Lifelife Eligibity</a></li>
					<li class="breadcrumb-item active" aria-current="page"><a href="#">Household Worksheet</a></li>
				</ol>
			</nav>
            <div class="capa-outr">
                <div class="planinf">
                    <div class="plasec_one">Household Worksheet</div>
                </div>
                <div class="profile_info_sec">
                    <div class="personalinfo_sec w-100 cmmn_title">
                        <div class="col-md-12">
                           <form method="post" id="household_form" action="<?php echo base_url('ApplicationController/application_household_action/' . $plan_id) ?>" novalidate>
								<div id="household_worksheet_div">
									<?php include('template_part/household_worksheet.php') ?>
								</div>
						   </form>
                        </div>
                    </div>
                </div>

                <div class="col-md-12 mt-4 d-flex justify-content-between">
                    <button  onclick="history.back();" class="btn btn-default formbtn">Back</button>
                    <button type="submit" class="btn btn-default formbtn ml-auto"
                        form="household_form">Next</button>
                </div>
            </div>
        </div>
    </div>
</section>


<?php include('inc/footer.php') ?>


<!-- Modal -->
<div class="modal fade" id="signatureModelOne" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Sign Here</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <div id="signatureOne"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-secondary" id="clearSignatureOne">Clear</button>
                <button type="button" class="btn btn-primary" id="saveSignatureOne">Save changes</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="signatureModelTwo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Sign Here</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body text-center">
                <div id="signatureTwo"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-secondary" id="clearSignatureTwo">Clear</button>
                <button type="button" class="btn btn-primary" id="saveSignatureTwo">Save changes</button>
            </div>
        </div>
    </div>
</div>

<?php include('inc/common_scripts.php') ?>


<script>
$(document).on('submit', '#household_form', function(){
	var qone = $("input:checked[name='household[question_one]']");
	var qtwo = $("input:checked[name='household[question_two]']");
	var qthree = $("input:checked[name='household[question_three]']");

	var count = 0;

	if(qone.length == 0){
		$(".invalid-feedback").eq(0).show();
		count++;
	}
	if(qone.val() == 'yes' && qtwo.length == 0){
		$(".invalid-feedback").eq(1).show();
		count++;
	}

	if(qtwo.val() == 'yes' && qthree.length == 0){
		$(".invalid-feedback").eq(2).show();
		count++;
	}

	if(qone.val() == 'no'){
		$('input[name="signature_one_done"]').val();

		if($('input[name="signature_one_done"]').val() == 0){
			$(".sign-invalid-feedback").eq(0).show();
			count++;
		}
	}

	if(qtwo.val() == 'no'){
		$('input[name="signature_one_done"]').val();

		if($('input[name="signature_one_done"]').val() == 0){
			$(".sign-invalid-feedback").eq(0).show();
			count++;
		}
	}

	if(qthree.val() == 'no'){
		$('input[name="signature_one_done"]').val();

		if($('input[name="signature_one_done"]').val() == 0){
			$(".sign-invalid-feedback").eq(1).show();
			count++;
		}

		if($('input[name="signature_two_done"]').val() == 0){
			$(".sign-invalid-feedback").eq(2).show();
			count++;
		}
	}

	if(count > 0){
		if ($(".invalid-feedback:visible").length > 0) {
			$([document.documentElement, document.body]).animate({
				scrollTop: $(".invalid-feedback:visible").offset().top - 75
			}, 750);
		}
		return false;
	} else if(count == 0){
		return true;
	}

});

$(document).on('change', '.profile_field', function(){
	$(".invalid-feedback").hide();
})
</script>



<script>
$(document).on('change', '.household_question_one', function() {
    var ans = $(this).val();
    if (ans == 'no') {
        $('#agreement_one').show();
        $('#agreement_two').hide();
        $('#agreement_three').hide();
        $('.household_question_two').closest('#household_question_two_div').hide();
        $('.household_question_three').closest('#household_question_three_div').hide();
        $('.household_question_two').removeAttr('required');
		$('.datepicker').eq(1).attr('name', '');
		$('.datepicker').eq(0).attr('name', 'household[date][]');
    } else {
        $('#agreement_one').hide();
        $('.household_question_two').closest('#household_question_two_div').show();
        $('.household_question_two').attr('required', 'required');
		$('.datepicker').eq(0).attr('name', '');
		$('.datepicker').eq(1).attr('name', 'household[date][]');
    }
    $('.household_question_two').prop('checked', false);
    $('.household_question_three').prop('checked', false);
});

$(document).on('change', '.household_question_two', function() {
    var ans = $(this).val();
    if (ans == 'no') {
        $('#agreement_one').show();
        $('#agreement_two').hide();
        $('#agreement_three').hide();
        $('.household_question_three').closest('#household_question_three_div').hide();
        $('.household_question_three').removeAttr('required');
		$('.datepicker').eq(1).attr('name', '');
		$('.datepicker').eq(0).attr('name', 'household[date][]');
    } else {
        $('#agreement_one').hide();
        $('.household_question_three').closest('#household_question_three_div').show();
        $('.household_question_three').attr('required', 'required');
		$('.datepicker').eq(0).attr('name', '');
		$('.datepicker').eq(1).attr('name', 'household[date][]');
    }
    $('.household_question_three').prop('checked', false);
});


$(document).on('change', '.household_question_three', function() {
    var ans = $(this).val();
    if (ans == 'no') {
        $('#agreement_two').show();
        $('#agreement_three').hide();
    } else {
        $('#agreement_two').hide();
        $('#agreement_three').show();
    }
});
</script>

<script type="text/javascript">
$(function() {
    $(".datepicker").datepicker({
        format: "dd-mm-yyyy",
        autoclose: true,
        todayHighlight: true,
        endDate: '+0d',
        startDate: '+0d'
    });
});
</script>

<!-- 
<link type="text/css" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/south-street/jquery-ui.css" rel="stylesheet">  -->
<link rel="stylesheet" href="<?php echo base_url('assets/css/jquery.signature.css') ?>">

<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
<script src="<?php echo base_url('assets/js/jquery.signature.min.js') ?>"></script>
<script>
jQuery.noConflict();

(function($) {

    $('#signatureOne').signature();

    $('#signatureOne').signature({
        syncField: '#signatureJSONOne'
    });
    $('#signatureOne').signature('option', 'syncFormat', 'PNG');

    $(document).on('click', '#clearSignatureOne', function() {
        $('#signatureOne').signature('clear');
    });

    $(document).on('click', '#saveSignatureOne', function() {
        $('.signatureOneImg').attr('src', $('#signatureJSONOne').val());
        $('input[name="signature_one_done"]').val('1');
        $('#signatureModelOne').modal('hide');
		$('.modal-backdrop').remove();
		$(".sign-invalid-feedback").eq(0).hide();
		$(".sign-invalid-feedback").eq(1).hide();

    });


    $('#signatureTwo').signature();
    $('#signatureTwo').signature('option', 'syncFormat', 'PNG');


    $('#signatureTwo').signature({
        syncField: '#signatureJSONTwo'
    });

    $(document).on('click', '#clearSignatureTwo', function() {
        $('#signatureTwo').signature('clear');
    });

    $(document).on('click', '#saveSignatureTwo', function() {
        $('input[name="signature_two_done"]').val('1');
        $('.signatureTwoImg').attr('src', $('#signatureJSONTwo').val());
        $('#signatureModelTwo').modal('hide');
		$('.modal-backdrop').remove();
		$(".sign-invalid-feedback").eq(2).hide();
    });
})(jQuery);
</script>



</body>

</html>
