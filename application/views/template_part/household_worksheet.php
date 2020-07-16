<div class="pdng35">
    <h2>Household Worksheet</h2>
    <div class="form-group">
        <label for="">1. Do you live with another adult?</label>
        <div class="adflx">
            <label class="container">Yes
                <input class="profile_field household_question_one" type="radio" name="household[question_one]"
                    value="yes" required>
                <span class="checkmark"></span>
            </label>
            <label class="container">No
                <input class="profile_field household_question_one" type="radio" name="household[question_one]"
                    value="no" required>
                <span class="checkmark"></span>
            </label>
        </div>

		<div class="invalid-feedback"> Please select an answer. </div>

        <small class="help-text text-muted">Adults are people who are 18 years old or older, or who are emancipated
            minors. This can include a spouse, domestic partner, parent, adult son or daughter, adult in your family,
            adult roommate, etc. Yes No
        </small>
    </div>


    <div class="form-group" style="display:none" id="household_question_two_div">
        <label for="">2. Do they get Lifeline?</label>
        <div class="adflx">
            <label class="container">Yes
                <input class="profile_field household_question_two" type="radio" name="household[question_two]"
                    value="yes">
                <span class="checkmark"></span>
            </label>
            <label class="container">No
                <input class="profile_field household_question_two" type="radio" name="household[question_two]"
                    value="no">
                <span class="checkmark"></span>
            </label>
		</div>
		<div class="invalid-feedback"> Please select an answer. </div>
		
    </div>


    <div class="form-group" style="display:none" id="household_question_three_div">
        <label for="">3. Do you share money (income and expenses) with them?</label>
        <div class="adflx">
            <label class="container">Yes
                <input class="profile_field household_question_three" type="radio" name="household[question_three]"
                    value="yes">
                <span class="checkmark"></span>
            </label>
            <label class="container">No
                <input class="profile_field household_question_three" type="radio" name="household[question_three]"
                    value="no">
                <span class="checkmark"></span>
            </label>
		</div>
		<div class="invalid-feedback"> Please select an answer. </div>
		
        <small class="help-text text-muted">This can be the cost of bills, food, etc., and income. If you are married,
            you should check yes for this question.</small>
    </div>

    <hr>

    <div class="row" style="display:none" id="agreement_one">
        <div class="form-group col-md-12">
            <label for="">Agreement</label><br>
            <small class="text-muted">You can apply for Lifeline. You live in a household that does not get Lifeline
                yet. Please initial and sign and date the worksheet.</small>
        </div>
        <div class="form-group col-md-6 text-center">
            <button type="button" class='btn btn-sm btn-priamry' data-toggle="modal"
                data-target="#signatureModelOne">Signature</button>
            <img class="signatureOneImg" src="" alt="">
			<div class="invalid-feedback sign-invalid-feedback"> Please sign here. </div>
        </div>
        <div class="form-group col-md-6">
            <input type="text" name="" id="" class="form-control datepicker" placeholder="Date"  value="<?php echo date('m/d/Y') ?>"
                aria-describedby="helpId">
			<div class="invalid-feedback date-invalid-feedback"> Please select an answer. </div>
        </div>
        <div class="form-group col-md-12">
            <small class="text-muted">I live at an address with more than one household.</small>
        </div>
    </div>



    <div class="row" style="display:none" id="agreement_two">

        <div class="form-group col-md-12">
            <label for="">Agreement</label><br>
            <small class="text-muted">You can apply for Lifeline. You live at an address with more than one household
                and your household does not get Lifeline yet. Please initial and sign and date the worksheet.</small>
        </div>

        <div class="form-group col-md-6 text-center">
            <button type="button" class='btn btn-sm btn-priamry' data-toggle="modal"
                data-target="#signatureModelOne">Signature</button>
            <img class="signatureOneImg" src="" alt="">
			<div class="invalid-feedback sign-invalid-feedback"> Please sign here. </div>
        </div>

        <div class="form-group col-md-6">
            <input type="text" id="" class="form-control datepicker" placeholder="Date"  value="<?php echo date('m/d/Y') ?>"
                aria-describedby="helpId">
			<div class="invalid-feedback date-invalid-feedback"> Please select an answer. </div>
        </div>
        <div class="form-group col-md-12">
            <small class="text-muted">I live at an address with more than one household.</small>
        </div>


        <div class="form-group col-md-6 text-center">
            <button type="button" class='btn btn-sm btn-priamry' data-toggle="modal"
                data-target="#signatureModelTwo">Signature</button>
            <img class="signatureTwoImg" src="" alt="">
			<div class="invalid-feedback sign-invalid-feedback"> Please sign here. </div>
        </div>

        <div class="form-group col-md-6">
            <input type="text" name="household[date][]" id="" class="form-control datepicker" placeholder="Date" value="<?php echo date('m/d/Y') ?>"
                aria-describedby="helpId">
			<div class="invalid-feedback date-invalid-feedback"> Please select an answer. </div>
        </div>
        <div class="form-group col-md-12">
            <small class="text-muted">I understand that the one-per-household limit is a Federal Communications
                Commission (FCC) rule and I will lose my Lifeline benefit if I break this rule.</small>
        </div>
    </div>

    <input type="hidden" name="signature_one_done" value="0" />
    <input type="hidden" name="signature_two_done" value="0" />
    <input type="hidden" name="signature_one" id="signatureJSONOne" />
    <input type="hidden" name="signature_two" id="signatureJSONTwo" />


    <div class="form-group" style="display:none" id="agreement_three">
        <small>You do not qualify for Lifeline because someone in your household already gets the benefit. You are only
            allowed to get one Lifeline discount per household, not per person.</small>
    </div>
</div>
