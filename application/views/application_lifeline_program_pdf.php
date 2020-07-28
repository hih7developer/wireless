<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.css') ?>" />

    <style>
    @media print {
        .page-break {
            height: 0;
            page-break-before: always;
            margin: 0;
            border-top: none;
        }
    }

    body,
    p,
    a,
    span,
    td {
        font-size: 11pt;
        font-family: Arial, Helvetica, sans-serif;
    }

    body {
        /* margin-left: 2em;
        margin-right: 2em; */
    }

    .page {
        height: 947px;
        /* padding-top: 5px; */
        page-break-after: always;
        font-family: Arial, Helvetica, sans-serif;
        position: relative;
        /* border-bottom: 1px solid #000; */
    }

    h3 {
        display: inline;
    }
    input {
        display: inline;
    }

    .bold {
        font-weight: bold;
    }

    P {
        margin: 5px 0;
    }
    </style>
</head>

<body>
    <div class="">

        <h2>Qualify for Lifeline</h2>

        <?php foreach($lifeline_programs as $key): ?>
        <div>
            <input name="lifeline[program][]" type="checkbox" value="<?php echo $key->lifeline_program_id ?>"
                <?php echo in_array($key->lifeline_program_id, $lifeline['program']) ? 'checked' : '' ?>>
            <label><?php echo $key->program ?></label>
        </div>
        <?php endforeach; ?>

        <?php if(in_array(6, $lifeline['program'])): ?>
        <h3 style="margin-top:5px">Income based eligibilty with</h3>
        <p><?php echo $lifeline['income'] ?></p>
        <?php endif; ?>


        <h2>Agreement</h2>

        <?php foreach($lifeline_agreements as $key): ?>
        <div>
            <input type="checkbox" name="lifeline[agreement][]" value="<?php echo $key->lifeline_agreement_id ?>"
                <?php echo in_array($key->lifeline_agreement_id, $lifeline['agreement']) ? 'checked' : '' ?>>
            <label class="agreement"><?php echo $key->agreement ?></label>
        </div>
        <?php endforeach; ?>

        <div>
            <div style="float: right">
                <div>
                    <h4 for="">Signature</h4>
                    <h5><?php echo $lifeline['signature']['name'] ?>, <?php echo date('m/d/Y') ?></h5>
                </div>
            </div>
        </div>
    </div>

</body>

</html> -->



<!DOCTYPE HTML>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <!-- Always force latest IE rendering engine (even in intranet) & Chrome Frame
         Remove this if you use the .htaccess -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title></title>
    <meta name="description" content="" />
    <meta name="author" content="admin" />
    <meta name="viewport" content="width=device-width; initial-scale=1.0" />
    <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.css') ?>" />
    <link rel="stylesheet" href="<?php echo base_url('assets/css/pdf.css') ?>" />
    <style type="text/css">
    /*
         @page sheetPage {
         size: A4 portrait;
         }
         */
    .sheet {
        /*			page: sheetPage;*/
        page-break-after: always;
    }

    .sheet:last-child {
        page-break-after: avoid !important;
    }

    .last-sheet {
        page-break-after: avoid !important;
    }

    input[type="text"] {
        letter-spacing: 3px;
    }
	input[type="checkbox"] {
        display: inline !important;
    }
	.page5 .chk_bx label{
		font-size: 12px;
		font-weight: normal;
	}
	.page6 .chk_bx label{
		font-size: 12px;
		font-weight: normal;
	}
	.page6 ol {
		margin-left: 50px;
		list-style-type: decimal;
	}
	.page6 ol li:first-child{
		margin-top: 5px;
		margin-bottom: 5px;
	}
    </style>
    <?php 
		function split_name($name) {
			$parts = array();
		
			while ( strlen( trim($name)) > 0 ) {
				$name = trim($name);
				$string = preg_replace('#.*\s([\w-]*)$#', '$1', $name);
				$parts[] = $string;
				$name = trim( preg_replace('#'.$string.'#', '', $name ) );
			}
		
			if (empty($parts)) {
				return false;
			}
		
			$parts = array_reverse($parts);
			$name = array();
			$name['first_name'] = $parts[0];
			$name['middle_name'] = (isset($parts[2])) ? $parts[1] : '';
			$name['last_name'] = (isset($parts[2])) ? $parts[2] : ( isset($parts[1]) ? $parts[1] : '');
		
			return $name;
		} 
	 
		?>
</head>

<body>
    <section class="sheet">
        <table style="border-collapse:collapse;border:1px solid #eee;margin:auto;font-family: Arial,serif;" width="100%"
            cellspacing="0" cellpadding="0" border="0" align="center">
            <tr>
                <td valign="top" style="padding: 15px 25px;">
                    <table width="100%" cellpadding="0" cellspacing="0" align="center;">
                        <tr>
                            <td valign="top" style="padding:0;">
                                <table width="100%" cellpadding="0" cellspacing="0" align="" style="">
                                    <tr>
                                        <td
                                            style="margin: 0;padding:0;border-bottom: 1px solid #979090;padding-bottom:10px;">
                                            <div class="hdr">
                                                <h6 class="mar_btn_13">FCC FORM 5629</h6>
                                                <h2 class="mar_btn_10">Lifeline Program</h2>
                                                <h2><b>Application Form</b></h2>
                                            </div>
                                        </td>
                                        <td
                                            style="margin: 0;padding:0;text-align: right;border-bottom: 1px solid #979090;padding-bottom:10px;">
                                            <div class="hdr">
                                                <h6 class="mar_btn_10">OMB APPROVAL EDITION 3060-0819</h6>
                                                <div class="img_hdr">
                                                    <div class="img_hdr_innr">
                                                        <img style="max-width: auto;"
                                                            src="<?php echo $_SERVER['DOCUMENT_ROOT'] . '/wireless/assets/images/img1.jpg'; ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                                <table width="100%" cellpadding="0" cellspacing="0" align="" style="">
                                    <tr>
                                        <td
                                            style="margin: 0;padding:0;padding-top:20px;width: 25%;vertical-align: top;">
                                            <div class="mid">
                                                <div class="mid_innr heading">
                                                    <h1 class="mar_btn_10">1.<br />About<br />Lifeline</h1>
                                                    <h3>Lifeline is a federal<br />benefit that lowers the<br />monthly
                                                        cost of phone<br />or internet service.</h3>
                                                </div>
                                            </div>
                                        </td>
                                        <td
                                            style="margin: 0;padding:0;padding-top:20px;width: 75%;vertical-align: top;">
                                            <div class="mid">
                                                <div class="mid_innr">
                                                    <div class="side">
                                                        <div class="each mar_btn_13">
                                                            <h4 class="mar_btn_7">Rules</h4>
                                                            <div class="small_para">
                                                                <p>If you qualify, your household can get Lifeline for
                                                                    phone or internet service, but not both. </p>
                                                            </div>
                                                            <div class="list bull">
                                                                <ul>
                                                                    <li><b>If you get Lifeline for phone service</b>,
                                                                        you can get the benefit for one mobile phone or
                                                                        one home phone, but not both. </li>
                                                                    <li><b>If you get Lifeline for phone service</b>,
                                                                        you can get the benefit for one mobile phone or
                                                                        one home phone, but not both. </li>
                                                                    <li><b>If you get Lifeline for phone service</b>,
                                                                        you can get the benefit for one mobile phone or
                                                                        one home phone, but not both. </li>
                                                                </ul>
                                                            </div>
                                                            <div class="small_para">
                                                                <p>Your household cannot get Lifeline from more than one
                                                                    phone or internet company.</p>
                                                                <p>You are only allowed to get one Lifeline benefit per
                                                                    household, <b>not per person</b>. If more than one
                                                                    person in your household gets Lifeline, you are
                                                                    breaking the FCC’s rules and will lose your benefit.
                                                                </p>
                                                            </div>
                                                        </div>
                                                        <div class="each mar_btn_13">
                                                            <h4 class="mar_btn_7">What is a household?</h4>
                                                            <div class="small_para">
                                                                <p>A household is a group of people who live together
                                                                    and share income and expenses (even if they are not
                                                                    related to each other).</p>
                                                            </div>
                                                        </div>
                                                        <div class="each mar_btn_13">
                                                            <h4 class="mar_btn_7">Do not give your benefit to another
                                                                person</h4>
                                                            <div class="small_para">
                                                                <p>Lifeline is non-transferable. You cannot give your
                                                                    Lifeline benefit to another person, even if they
                                                                    qualify.</p>
                                                            </div>
                                                        </div>
                                                        <div class="each mar_btn_13">
                                                            <h4 class="mar_btn_7">Be honest on this form</h4>
                                                            <div class="small_para">
                                                                <p>You must give accurate and true information on this
                                                                    form and on all Lifeline-related forms or
                                                                    questionnaires. If you give false or fraudulent
                                                                    information, you will lose your Lifeline benefit
                                                                    (i.e., de-enrollment or being barred from the
                                                                    program) and the United States government can take
                                                                    legal actions against you. This may include (but is
                                                                    not limited to) fines or imprisonment. </p>
                                                            </div>
                                                        </div>
                                                        <div class="each mar_btn_13">
                                                            <h4 class="mar_btn_7">You may need to show other documents
                                                            </h4>
                                                            <div class="small_para">
                                                                <p>You will need to show your phone or internet company
                                                                    an official document from one of the government
                                                                    qualifying programs or prove your annual income.
                                                                    Please provide copies of your official documents
                                                                    with this application. Include the documents in
                                                                    option 1 or option 2 below: </p>
                                                            </div>
                                                            <div class="list number">
                                                                <ol style="list-style: decimal;">
                                                                    <li>If you qualify through a government program:
                                                                        copies of your state ID card and an official
                                                                        document from the program you are qualifying
                                                                        through (your SNAP card, Medicaid card,
                                                                        Supplemental Security Income (SSI) benefit
                                                                        letter, Federal Public Housing Assistance (FPHA)
                                                                        award letter, or other accepted documents).</li>
                                                                    <li>If you qualify through your income: copies of
                                                                        your state ID card and your last state, federal,
                                                                        or Tribal tax return, pay stubs for 3
                                                                        consecutive months, or other accepted documents.
                                                                        Visit lifelinesupport.org to see the full list
                                                                        of accepted documents. </li>
                                                                </ol>
                                                            </div>
                                                            <div class="small_para mar_btn_7">
                                                                <p>Visit lifelinesupport.org to see the full list of
                                                                    accepted documents.</p>
                                                            </div>
                                                            <table width="100%" cellpadding="0" cellspacing="0" align=""
                                                                style="">
                                                                <tr>
                                                                    <td
                                                                        style="margin: 0;padding:0;border: 2px solid #ffdc94;border-right:0;padding:5px;vertical-align: top;">
                                                                        <div class="apply_lft">
                                                                            <h4 class="mar_btn_7">Apply</h4>
                                                                            <div class="small_para">
                                                                                <p>To apply for a Lifeline benefit, fill
                                                                                    out the required sections of this
                                                                                    form, initial every agreement
                                                                                    statement, and sign on page 6.</p>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td
                                                                        style="margin: 0;padding:0;border: 2px solid #ffdc94;border-left:0;padding:5px;vertical-align: top;">
                                                                        <div class="apply_rht">
                                                                            <div class="small_para">
                                                                                <p>To apply, bring or mail this form to
                                                                                    your phone or internet company. </p>
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                                <br />
                                <table width="100%" cellpadding="0" cellspacing="0" align="" style="">
                                    <tr>
                                        <td
                                            style="margin: 0;padding:0;border-top: 1px solid #979090;padding-top:10px;vertical-align: top;">
                                            <div class="ftr">
                                                <p>Page 1 of 8</p>
                                            </div>
                                        </td>
                                        <td
                                            style="margin: 0;padding:0;text-align: right;border-top: 1px solid #979090;padding-top:10px;">
                                            <div class="ftr">
                                                <div class="rgtt_ftrr">
                                                    <h6 class="mar_btn_10"><a href="">Universal Service Administrative
                                                            Company | www.lifelinesupport.org</a></h6>
                                                    <h6><a href="">Need help? Call the Lifeline Support Center at
                                                            1-800-234-9473</a></h6>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </section>
    <section class="sheet page2">
        <table style="border-collapse:collapse;border:1px solid #eee;margin:auto;font-family: Arial,serif;" width="100%"
            cellspacing="0" cellpadding="0" border="0" align="center">
            <tr>
                <td valign="top" style="padding: 15px 25px;">
                    <table width="100%" cellpadding="0" cellspacing="0" align="center;">
                        <tr>
                            <td valign="top" style="padding:0;">
                                <table width="100%" cellpadding="0" cellspacing="0" align="" style="">
                                    <tr>
                                        <td
                                            style="margin: 0;padding:0;border-bottom: 1px solid #979090;padding-bottom:10px;">
                                            <div class="hdr">
                                                <h6 class="mar_btn_13">FCC FORM 5629</h6>
                                                <h2 class="mar_btn_10">Lifeline Program</h2>
                                                <h2><b>Application Form</b></h2>
                                            </div>
                                        </td>
                                        <td
                                            style="margin: 0;padding:0;text-align: right;border-bottom: 1px solid #979090;padding-bottom:10px;">
                                            <div class="hdr">
                                                <h6 class="mar_btn_10">OMB APPROVAL EDITION 3060-0819</h6>
                                                <div class="img_hdr">
                                                    <div class="img_hdr_innr">
                                                        <img style="max-width: auto;"
                                                            src="<?php echo $_SERVER['DOCUMENT_ROOT'] . '/wireless/assets/images/img1.jpg'; ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                                <table width="100%" cellpadding="0" cellspacing="0" align="" style="">
                                    <tr>
                                        <td
                                            style="margin: 0;padding:0;padding-top:20px;width: 25%;vertical-align: top;">
                                            <div class="mid">
                                                <div class="mid_innr heading">
                                                    <h1 class="mar_btn_10">2.<br />Your<br />Information</h1>
                                                    <h3>All fields are required<br />unless indicated. Use
                                                        only<br />CAPITALIZED LETTERS<br />and black ink to fill
                                                        out<br />this form.</h3>
                                                </div>
                                            </div>
                                        </td>
                                        <td
                                            style="margin: 0;padding:0;padding-top:20px;width: 75%;vertical-align: top;">
                                            <div class="mid">
                                                <div class="mid_innr frm">
                                                    <div class="small_para too_small">
                                                        <p><b>What is your full legal name?</b></p>
                                                        <h6>The name you use on official documents, like your Social
                                                            Security Card or State ID. Not a nickname.</h6>
                                                    </div>
                                                    <div class="inputt mar_top_5 mar_btn_5">
                                                        <input type="text"
                                                            value="<?php echo split_name($user->name)['first_name'] ?>" />
                                                        <span>First</span>
                                                    </div>
                                                    <table width="100%" cellpadding="0" cellspacing="0" align=""
                                                        style="">
                                                        <tr>
                                                            <td
                                                                style="margin: 0;padding: 0;vertical-align: top;padding-right: 10px;">
                                                                <div class="inputt mar_btn_5">
                                                                    <input type="text"
                                                                        value="<?php echo split_name($user->name)['middle_name'] ?>" />
                                                                    <span>Middle (optional)</span>
                                                                </div>
                                                            </td>
                                                            <td
                                                                style="margin: 0;padding: 0;vertical-align: top;padding-right: 10px;">
                                                                <div class="inputt mar_btn_5">
                                                                    <input type="text" />
                                                                    <span>Suffix (optional)</span>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <div class="inputt mar_btn_15">
                                                        <input type="text"
                                                            value="<?php echo split_name($user->name)['last_name'] ?>" />
                                                        <span>Last</span>
                                                    </div>
                                                    <table width="100%" cellpadding="0" cellspacing="0" align=""
                                                        style="">
                                                        <tr>
                                                            <td
                                                                style="margin: 0;padding: 0;vertical-align: top;padding-right: 10px;">
                                                                <div class="small_para too_small">
                                                                    <p><b>What is your phone number</b>(if you have
                                                                        one)?</p>
                                                                </div>
                                                                <div class="inputt mar_top_5 mar_btn_15">
                                                                    <input type="text"
                                                                        value="<?php echo $consumer->contact_no ?>" />
                                                                </div>
                                                            </td>
                                                            <td
                                                                style="margin: 0;padding: 0;vertical-align: top;padding-left: 10px;">
                                                                <div class="small_para too_small">
                                                                    <p><b>What is your date of birth?</b></p>
                                                                </div>
                                                                <div class="inputt mar_top_5 mar_btn_15">
                                                                    <input type="text"
                                                                        value="<?php echo date('m/d/Y', strtotime($consumer->dob)) ?>" />
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <div class="small_para too_small">
                                                        <p><b>What is your email address</b>(if you have one)? </p>
                                                        <h6>The name you use on official documents, like your Social
                                                            Security Card or State ID. Not a nickname.</h6>
                                                    </div>
                                                    <div class="inputt mar_top_5 mar_btn_5">
                                                        <input type="text" value="<?php echo $user->email ?>" />
                                                    </div>
                                                    <div class="inputt mar_btn_15">
                                                        <input type="text" />
                                                    </div>
                                                    <table width="100%" cellpadding="0" cellspacing="0" align=""
                                                        style="">
                                                        <tr>
                                                            <td
                                                                style="margin: 0;padding: 0;vertical-align: middle;padding-right: 10px;margin-bottom:15px;">
                                                                <div class="small_para too_small">
                                                                    <p><b>What are the last 4 numbers of your Social
                                                                            Security Number (SSN)?</b></p>
                                                                </div>
                                                            </td>
                                                            <td
                                                                style="margin: 0;padding: 0;vertical-align: middle;padding-left: 10px;margin-bottom:15px;width:20%;">
                                                                <div class="inputt">
                                                                    <input type="text"
                                                                        value="<?php echo $consumer->ssn ?>" />
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <div class="small_para too_small">
                                                        <p>If you do not have a SSN, what is your Tribal Identification
                                                            Number? </p>
                                                    </div>
                                                    <div class="inputt mar_top_5 mar_btn_5">
                                                        <input type="text" />
                                                    </div>
                                                    <div class="small_para too_small mar_top_15">
                                                        <p><b>What is the best way to reach you? </b></p>
                                                    </div>
                                                    <div class="inputt mar_top_5 mar_btn_5">
                                                        <div class="chk_bx">
                                                            <input type="checkbox" id="email" name="email"
                                                                value="email" <?php echo $consumer->how_to_reach == 'email' ? 'checked' : '' ?>><span class="Hide_small">H1</span><label
                                                                for="email">Email</label><span
                                                                class="Hide_big">Hide_big</span><input type="checkbox"
                                                                id="phone" name="phone" value="phone" <?php echo $consumer->how_to_reach == 'phone' ? 'checked' : '' ?>><span
                                                                class="Hide_small">H1</span><label
                                                                for="phone">Phone</label><span
                                                                class="Hide_big">Hide_big</span><input type="checkbox"
                                                                id="text message" name="text message" value="Msg"  <?php echo $consumer->how_to_reach == 'message' ? 'checked' : '' ?>><span
                                                                class="Hide_small">H1</span><label
                                                                for="text message">Text Message</label><span
                                                                class="Hide_big">Hide_big</span><input type="checkbox"
                                                                id="mail " name="mail " value="mail" <?php echo $consumer->how_to_reach == 'mail' ? 'checked' : '' ?>><span
                                                                class="Hide_small">H1</span><label
                                                                for="mail ">Mail</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br />
                                            <br />
                                            <br />
                                            <br />
                                            <br />
                                            <br />
                                            <br />
                                            <br />
                                            <br />
                                            <br />
                                        </td>
                                    </tr>
                                </table>
                                <table width="100%" cellpadding="0" cellspacing="0" align="" style="">
                                    <tr>
                                        <td
                                            style="margin: 0;padding:0;border-top: 1px solid #979090;padding-top:10px;vertical-align: top;">
                                            <div class="ftr">
                                                <p>Page 2 of 8</p>
                                            </div>
                                        </td>
                                        <td
                                            style="margin: 0;padding:0;text-align: right;border-top: 1px solid #979090;padding-top:10px;">
                                            <div class="ftr">
                                                <div class="rgtt_ftrr">
                                                    <h6 class="mar_btn_10"><a href="">Universal Service Administrative
                                                            Company | www.lifelinesupport.org</a></h6>
                                                    <h6><a href="">Need help? Call the Lifeline Support Center at
                                                            1-800-234-9473</a></h6>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </section>
    <section class="sheet page3">
        <table style="border-collapse:collapse;border:1px solid #eee;margin:auto;font-family: Arial,serif;" width="100%"
            cellspacing="0" cellpadding="0" border="0" align="center">
            <tr>
                <td valign="top" style="padding: 15px 25px;">
                    <table width="100%" cellpadding="0" cellspacing="0" align="center;">
                        <tr>
                            <td valign="top" style="padding:0;">
                                <table width="100%" cellpadding="0" cellspacing="0" align="" style="">
                                    <tr>
                                        <td
                                            style="margin: 0;padding:0;border-bottom: 1px solid #979090;padding-bottom:10px;">
                                            <div class="hdr">
                                                <h6 class="mar_btn_13">FCC FORM 5629</h6>
                                                <h2 class="mar_btn_10">Lifeline Program</h2>
                                                <h2><b>Application Form</b></h2>
                                            </div>
                                        </td>
                                        <td
                                            style="margin: 0;padding:0;text-align: right;border-bottom: 1px solid #979090;padding-bottom:10px;">
                                            <div class="hdr">
                                                <h6 class="mar_btn_10">OMB APPROVAL EDITION 3060-0819</h6>
                                                <div class="img_hdr">
                                                    <div class="img_hdr_innr">
                                                        <img style="max-width: auto;"
                                                            src="<?php echo $_SERVER['DOCUMENT_ROOT'] . '/wireless/assets/images/img1.jpg'; ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                                <table width="100%" cellpadding="0" cellspacing="0" align="" style="">
                                    <tr>
                                        <td
                                            style="margin: 0;padding:0;padding-top:20px;width: 25%;vertical-align: top;">
                                            <div class="mid">
                                                <div class="mid_innr heading">
                                                    <h1 class="mar_btn_10">
                                                        2.<br />Your<br />Informationr<br />(continued)</h1>
                                                    <h3 class="mar_top_15">* Tribal lands include any federally
                                                        recognized Indian tribe’s reservation, pueblo, or colony,
                                                        including former reservations in Oklahoma; Alaska Native regions
                                                        established pursuant to the Alaska Native Claims Settlement Act
                                                        (85 Stat. 688); Indian allotments; Hawaiian Home Lands—areas
                                                        held in trust for Native Hawaiians by the state of Hawaii,
                                                        pursuant to the Hawaiian Homes Commission Act, 1920 July 9,
                                                        1921, 42 Stat. 108, et. seq., as amended; and any land
                                                        designated as such by the Commission for purposes of this
                                                        subpart pursuant to the designation process in the FCC’s
                                                        Lifeline rules.</h3>
                                                </div>
                                            </div>
										</td>
										<?php 
										if ($consumer->shipping_address_set == 1) {
											$shipping_address = $consumer->shipping_address;
											$shipping_apt_room = $consumer->shipping_apt_room;
											$shipping_city = $consumer->shipping_city;
											$shipping_state_id = $consumer->shipping_state_id;
											$shipping_zip = $consumer->shipping_zip;
										}
										
										?>
                                        <td
                                            style="margin: 0;padding:0;padding-top:20px;width: 75%;vertical-align: top;">
                                            <div class="mid">
                                                <div class="mid_innr frm">
                                                    <div class="small_para too_small">
                                                        <p><b>What is your home address?</b> (The address where you will
                                                            get service. Do not use a P.O. Box</p>
                                                    </div>
                                                    <div class="inputt mar_top_5 mar_btn_5">
                                                        <input type="text"  value="<?php echo $consumer->address ?>" />
                                                        <span>Street Number and Nam</span>
                                                    </div>
                                                    <table width="100%" cellpadding="0" cellspacing="0" align=""
                                                        style="">
                                                        <tr>
                                                            <td
                                                                style="margin: 0;padding: 0;vertical-align: top;padding-right: 10px;">
                                                                <div class="inputt mar_btn_5">
                                                                    <input type="text" value="<?php echo $consumer->apt_room ?>"/>
                                                                    <SPAN>Apt,Unit Etc.</SPAN>
                                                                </div>
                                                            </td>
                                                            <td
                                                                style="margin: 0;padding: 0;vertical-align: top;padding-left: 10px;">
                                                                <div class="inputt mar_btn_5">
																	<input type="text" value="<?php echo $consumer->city ?>"/>
                                                                    <SPAN>City</SPAN>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td
                                                                style="margin: 0;padding: 0;vertical-align: top;padding-right: 10px;">
                                                                <div class="inputt mar_btn_15">
																	<?php 
																	$state = $this->db->get_where('states', ['id' => $consumer->state_id])->row()->name;
																	?>
																	<input type="text" value="<?php echo $state ?>"/>
                                                                    <SPAN>State</SPAN>
                                                                </div>
                                                            </td>
                                                            <td
                                                                style="margin: 0;padding: 0;vertical-align: top;padding-left: 10px;">
                                                                <div class="inputt mar_btn_15">
                                                                    <input type="text" value="<?php echo $consumer->zip ?>"/>
                                                                    <SPAN>Zip Code</SPAN>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td
                                                                style="margin: 0;padding: 0;padding-right: 10px;vertical-align:middle;">
                                                                <table width="100%" cellpadding="0" cellspacing="0"
                                                                    align="" style="">
                                                                    <tr>
                                                                        <td
                                                                            style="margin: 0;padding: 0;padding-right: 5px;">
                                                                            <div class="small_para too_small">
                                                                                <p><b>Is this a temporary address?</b>
                                                                                </p>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <div class="chk_bx mar_btn_15">
                                                                            <input type="checkbox" id="yes"
                                                                                name="yes" value="yes" <?php echo $consumer->address_type != 'permanent' ? 'checked' : 'no' ?>> <label
                                                                                for="yes">Yes</label><span
                                                                                class="Hide_big">Hide_big</span><input
                                                                                type="checkbox" id="no" name="no"
                                                                                value="no" <?php echo $consumer->address_type == 'permanent' ? 'checked' : 'no' ?>> <label
                                                                                for="no">No</label>
                                                                        </div>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                            <td
                                                                style="margin: 0;padding: 0;padding-left: 10px;vertical-align:middle;">
                                                                <table width="100%" cellpadding="0" cellspacing="0"
                                                                    align="" style="">
                                                                    <tr>
                                                                        <td
                                                                            style="margin: 0;padding: 0;vertical-align:middle;">
                                                                            <div class="small_para too_small">
                                                                                <p><b>Check if you live on Tribal
                                                                                        Lands*</b></p>
                                                                            </div>
                                                                        </td>
                                                                        <td
                                                                            style="margin: 0;padding: 0;width:10%;vertical-align:middle;">
                                                                            <div class="chk_bx mar_btn_15">
																				<?php 
																				$tribal = $this->db->get_where('zipcodes', ['zipcode' => $consumer->zip])->row()->tribal == 1 ? true : false;
																				?>
                                                                                <input type="checkbox" id="tribal"
                                                                                    name="tribal" value="tribal" <?php echo $tribal ? 'checked' : '' ?>>
                                                                            </div>
                                                                        </td>
                                                                    </tr>
                                                                </table>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <div class="small_para too_small">
                                                        <p><b>What is your mailing address?</b>(Only fill this out if it
                                                            is not the same as your home address.)</p>
                                                    </div>
                                                    <div class="inputt mar_top_5 mar_btn_5">
                                                        <input type="text" value="<?php echo $shipping_address ?? null ?>"/>
                                                        <span>Street Number and Name</span>
                                                    </div>
                                                    <table width="100%" cellpadding="0" cellspacing="0" align=""
                                                        style="">
                                                        <tr>
                                                            <td
                                                                style="margin: 0;padding: 0;vertical-align: top;padding-right: 10px;">
                                                                <div class="inputt mar_btn_5">
                                                                    <input type="text" value="<?php echo $shipping_apt_room ?? null ?>"/>
                                                                    <SPAN>Apt,Unit Etc.</SPAN>
                                                                </div>
                                                            </td>
                                                            <td
                                                                style="margin: 0;padding: 0;vertical-align: top;padding-left: 10px;">
                                                                <div class="inputt mar_btn_5">
                                                                    <input type="text" value="<?php echo $shipping_city ?? null ?>"/>
                                                                    <SPAN>City</SPAN>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td
                                                                style="margin: 0;padding: 0;vertical-align: top;padding-right: 10px;">
                                                                <div class="inputt mar_btn_15">
																	<?php 
																	$state = isset($shipping_state_id) ? $this->db->get_where('states', ['id' => $shipping_state_id])->row()->name : null;
																	?>
                                                                    <input type="text" value="<?php echo $state ?>"/>
                                                                    <SPAN>State</SPAN>
                                                                </div>
                                                            </td>
                                                            <td
                                                                style="margin: 0;padding: 0;vertical-align: top;padding-left: 10px;">
                                                                <div class="inputt mar_btn_15">
                                                                    <input type="text" value="<?php echo $shipping_zip ?? null ?>"/>
                                                                    <SPAN>Zip Code</SPAN>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                            <br />
                                            <br />
                                            <br />
                                            <br />
                                            <br />
                                            <br />
                                            <br />
                                            <br />
                                            <br />
                                            <br />
                                            <br />
                                            <br />
                                            <br />
                                        </td>
                                    </tr>
                                </table>
                                <table width="100%" cellpadding="0" cellspacing="0" align="" style="">
                                    <tr>
                                        <td
                                            style="margin: 0;padding:0;border-top: 1px solid #979090;padding-top:10px;vertical-align: top;">
                                            <div class="ftr">
                                                <p>Page 3 of 8</p>
                                            </div>
                                        </td>
                                        <td
                                            style="margin: 0;padding:0;text-align: right;border-top: 1px solid #979090;padding-top:10px;">
                                            <div class="ftr">
                                                <div class="rgtt_ftrr">
                                                    <h6 class="mar_btn_10"><a href="">Universal Service Administrative
                                                            Company | www.lifelinesupport.org</a></h6>
                                                    <h6><a href="">Need help? Call the Lifeline Support Center at
                                                            1-800-234-9473</a></h6>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </section>
    <section class="sheet page4">
        <table style="border-collapse:collapse;border:1px solid #eee;margin:auto;font-family: Arial,serif;" width="100%"
            cellspacing="0" cellpadding="0" border="0" align="center">
            <tr>
                <td valign="top" style="padding: 15px 25px;">
                    <table width="100%" cellpadding="0" cellspacing="0" align="center;">
                        <tr>
                            <td valign="top" style="padding:0;">
                                <table width="100%" cellpadding="0" cellspacing="0" align="" style="">
                                    <tr>
                                        <td
                                            style="margin: 0;padding:0;border-bottom: 1px solid #979090;padding-bottom:10px;">
                                            <div class="hdr">
                                                <h6 class="mar_btn_13">FCC FORM 5629</h6>
                                                <h2 class="mar_btn_10">Lifeline Program</h2>
                                                <h2><b>Application Form</b></h2>
                                            </div>
                                        </td>
                                        <td
                                            style="margin: 0;padding:0;text-align: right;border-bottom: 1px solid #979090;padding-bottom:10px;">
                                            <div class="hdr">
                                                <h6 class="mar_btn_10">OMB APPROVAL EDITION 3060-0819</h6>
                                                <div class="img_hdr">
                                                    <div class="img_hdr_innr">
                                                        <img style="max-width: auto;"
                                                            src="<?php echo $_SERVER['DOCUMENT_ROOT'] . '/wireless/assets/images/img1.jpg'; ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                                <table width="100%" cellpadding="0" cellspacing="0" align="" style="">
                                    <tr>
                                        <td
                                            style="margin: 0;padding:0;padding-top:20px;padding-right:10px;width: 25%;vertical-align: top;">
                                            <div class="mid">
                                                <div class="mid_innr heading">
                                                    <h1 class="mar_btn_10">
                                                        2.<br />Your<br />Informationr<br />(continued)</h1>
                                                    <h3 class="mar_top_15 orng">Only fill this section out if you are
                                                        applying through a child or dependent.</h3>
                                                </div>
                                            </div>
                                        </td>
                                        <td
                                            style="margin: 0;padding:0;padding-top:20px;width: 75%;vertical-align: top;">
                                            <div class="mid">
                                                <div class="mid_innr frm">
                                                    <div class="chk_bx mar_btn_15">
                                                        <input type="checkbox" id="chk" name="chk" value="chk">
                                                        <span class="Hide_big">h1</span>
                                                        <label for="chk">Check if you are qualifying through a child or
                                                            dependent in your household. If so, answer the following
                                                            questions:</label>
                                                    </div>
                                                    <div class="small_para too_small">
                                                        <p><b>What is your full legal name?</b></p>
                                                    </div>
                                                    <div class="inputt mar_top_5 mar_btn_5">
                                                        <input type="text" />
                                                        <span>First</span>
                                                    </div>
                                                    <table width="100%" cellpadding="0" cellspacing="0" align=""
                                                        style="">
                                                        <tr>
                                                            <td
                                                                style="margin: 0;padding: 0;vertical-align: top;padding-right: 10px;">
                                                                <div class="inputt mar_btn_5">
                                                                    <input type="text" />
                                                                    <span>Middle</span>
                                                                </div>
                                                            </td>
                                                            <td
                                                                style="margin: 0;padding: 0;vertical-align: top;padding-right: 10px;">
                                                                <div class="inputt mar_btn_5">
                                                                    <input type="text" />
                                                                    <span>Suffix</span>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <div class="inputt mar_btn_15">
                                                        <input type="text" />
                                                        <span>Last</span>
                                                    </div>
                                                    <table width="100%" cellpadding="0" cellspacing="0" align=""
                                                        style="">
                                                        <tr>
                                                            <td style="margin: 0;padding: 0;vertical-align: top;">
                                                                <div class="small_para too_small">
                                                                    <p><b>What is their date of birth?</b></p>
                                                                </div>
                                                                <div class="inputt mar_top_5 mar_btn_15">
                                                                    <input type="text" />
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <table width="100%" cellpadding="0" cellspacing="0" align=""
                                                        style="">
                                                        <tr>
                                                            <td
                                                                style="margin: 0;padding: 0;vertical-align: middle;padding-right: 10px;margin-bottom:15px;">
                                                                <div class="small_para too_small">
                                                                    <p><b>What are the last 4 numbers of your Social
                                                                            Security Number (SSN)?</b></p>
                                                                </div>
                                                            </td>
                                                            <td
                                                                style="margin: 0;padding: 0;vertical-align: middle;padding-left: 10px;margin-bottom:15px;width:20%;">
                                                                <div class="inputt">
                                                                    <input type="text" />
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <div class="small_para too_small">
                                                        <p>If you do not have a SSN, what is your Tribal Identification
                                                            Number? </p>
                                                    </div>
                                                    <div class="inputt mar_top_5 mar_btn_5">
                                                        <input type="text" />
                                                    </div>
                                                </div>
                                            </div>
                                            <br />
                                            <br />
                                            <br />
                                            <br />
                                            <br />
                                            <br />
                                            <br />
                                            <br />
                                            <br />
                                            <br />
                                            <br />
                                            <br />
                                            <br />
                                            <br />
                                            <br />
                                            <br />
                                        </td>
                                    </tr>
                                </table>
                                <br />
                                <table width="100%" cellpadding="0" cellspacing="0" align="" style="">
                                    <tr>
                                        <td
                                            style="margin: 0;padding:0;border-top: 1px solid #979090;padding-top:10px;vertical-align: top;">
                                            <div class="ftr">
                                                <p>Page 4 of 8</p>
                                            </div>
                                        </td>
                                        <td
                                            style="margin: 0;padding:0;text-align: right;border-top: 1px solid #979090;padding-top:10px;">
                                            <div class="ftr">
                                                <div class="rgtt_ftrr">
                                                    <h6 class="mar_btn_10"><a href="">Universal Service Administrative
                                                            Company | www.lifelinesupport.org</a></h6>
                                                    <h6><a href="">Need help? Call the Lifeline Support Center at
                                                            1-800-234-9473</a></h6>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </section>
    <section class="sheet page5">
        <table style="border-collapse:collapse;border:1px solid #eee;margin:auto;font-family: Arial,serif;" width="100%"
            cellspacing="0" cellpadding="0" border="0" align="center">
            <tr>
                <td valign="top" style="padding: 15px 25px;">
                    <table width="100%" cellpadding="0" cellspacing="0" align="center;">
                        <tr>
                            <td valign="top" style="padding:0;">
                                <table width="100%" cellpadding="0" cellspacing="0" align="" style="">
                                    <tr>
                                        <td
                                            style="margin: 0;padding:0;border-bottom: 1px solid #979090;padding-bottom:10px;">
                                            <div class="hdr">
                                                <h6 class="mar_btn_13">FCC FORM 5629</h6>
                                                <h2 class="mar_btn_10">Lifeline Program</h2>
                                                <h2><b>Application Form</b></h2>
                                            </div>
                                        </td>
                                        <td
                                            style="margin: 0;padding:0;text-align: right;border-bottom: 1px solid #979090;padding-bottom:10px;">
                                            <div class="hdr">
                                                <h6 class="mar_btn_10">OMB APPROVAL EDITION 3060-0819</h6>
                                                <div class="img_hdr">
                                                    <div class="img_hdr_innr">
                                                        <img style="max-width: auto;"
                                                            src="<?php echo $_SERVER['DOCUMENT_ROOT'] . '/wireless/assets/images/img1.jpg'; ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                                <table width="100%" cellpadding="0" cellspacing="0" align="" style="">
                                    <tr>
                                        <td
                                            style="margin: 0;padding:0;padding-top:20px;padding-right:10px;width: 25%;vertical-align: top;">
                                            <div class="mid">
                                                <div class="mid_innr heading">
                                                    <h1 class="mar_btn_10">3.<br />Qualify for<br />Lifeline </h1>
                                                    <h3 class="mar_top_15">I agree, under penalty of perjury, to the
                                                        following statements:</h3>
                                                    <h3 class="mar_top_15 orng">Fill out this section to show that you,
                                                        your dependent, or someone in your household qualifies for
                                                        Lifeline.</h3>
                                                    <h3 class="mar_top_10 orng">You can qualify through some government
                                                        assistance programs or through your income (you do not need to
                                                        qualify through both).</h3>
                                                </div>
                                            </div>
                                        </td>
                                        <td
                                            style="margin: 0;padding:0;padding-top:20px;width: 75%;vertical-align: top;">
                                            <div class="mid">
                                                <h4 class="mar_btn_7 page_5hd">Qualify through a government program</h4>
                                                <div class="mid_innr frm mar_btn_15">
													<?php foreach($lifeline_programs as $key): ?>
                                                    <div class="chk_bx mar_btn_3">
														<?php if($key->lifeline_program_id != 6): ?>
                                                        <input type="checkbox" id="chk" name="chk" value="chk" <?php echo in_array($key->lifeline_program_id, $lifeline['program']) ? 'checked' : '' ?>><span
															class="Hide_big">h</span><label for="chk"><?php echo $key->program ?></label>
														<?php endif; ?>
													</div>
													<?php endforeach; ?>
                                                
                                                    <div class="chk_bx mar_btn_3">
                                                        <label for="chk">Tribal Specific Programs</label>
                                                    </div>
                                                    <div class="mar_left_20">
                                                        <div class="chk_bx mar_btn_3">
                                                            <input type="checkbox" id="chk" name="chk" value="chk"><span
                                                                class="Hide_big">h</span><label for="chk">Bureau of
                                                                Indian Affairs (BIA) General Assistance</label>
                                                        </div>
                                                        <div class="chk_bx mar_btn_3">
                                                            <input type="checkbox" id="chk" name="chk" value="chk"><span
                                                                class="Hide_big">h</span><label for="chk">Tribal
                                                                Temporary Assistance for Needy Families (Tribal
                                                                TANF)</label>
                                                        </div>
                                                        <div class="chk_bx mar_btn_3">
                                                            <input type="checkbox" id="chk" name="chk" value="chk"><span
                                                                class="Hide_big">h</span><label for="chk">Food
                                                                Distribution Program on Indian Reservations (FDPIR)
                                                            </label>
                                                        </div>
                                                        <div class="chk_bx mar_btn_3">
                                                            <input type="checkbox" id="chk" name="chk" value="chk"><span
                                                                class="Hide_big">h</span><label for="chk">Tribal Head
                                                                Start (only households that meet the income qualifying
                                                                standard)</label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--Pending-->

                                                <!--Pending-->
                                                <br />
                                                <br />
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                                <br />
                                <table width="100%; margin-top:auto" cellpadding="0" cellspacing="0" align="" style="">
                                    <tr>
                                        <td
                                            style="margin: 0;padding:0;border-top: 1px solid #979090;padding-top:10px;vertical-align: top;">
                                            <div class="ftr">
                                                <p>Page 5 of 8</p>
                                            </div>
                                        </td>
                                        <td
                                            style="margin: 0;padding:0;text-align: right;border-top: 1px solid #979090;padding-top:10px;">
                                            <div class="ftr">
                                                <div class="rgtt_ftrr">
                                                    <h6 class="mar_btn_10"><a href="">Universal Service Administrative
                                                            Company | www.lifelinesupport.org</a></h6>
                                                    <h6><a href="">Need help? Call the Lifeline Support Center at
                                                            1-800-234-9473</a></h6>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </section>
    <section class="sheet page6">
        <table style="border-collapse:collapse;border:1px solid #eee;margin:auto;font-family: Arial,serif;" width="100%"
            cellspacing="0" cellpadding="0" border="0" align="center">
            <tr>
                <td valign="top" style="padding: 15px 25px;">
                    <table width="100%" cellpadding="0" cellspacing="0" align="center;">
                        <tr>
                            <td valign="top" style="padding:0;">
                                <table width="100%" cellpadding="0" cellspacing="0" align="" style="">
                                    <tr>
                                        <td style="margin: 0;padding:0;border-bottom: 1px solid #979090;padding-bottom:10px;">
                                            <div class="hdr">
                                                <h6 class="mar_btn_13">FCC FORM 5629</h6>
                                                <h2 class="mar_btn_10">Lifeline Program</h2>
                                                <h2><b>Application Form</b></h2>
                                            </div>
                                        </td>
                                        <td style="margin: 0;padding:0;text-align: right;border-bottom: 1px solid #979090;padding-bottom:10px;">
                                            <div class="hdr">
                                                <h6 class="mar_btn_10">OMB APPROVAL EDITION 3060-0819</h6>
                                                <div class="img_hdr">
                                                    <div class="img_hdr_innr">
                                                        <img style="max-width: auto;" src="<?php echo $_SERVER['DOCUMENT_ROOT'].'/wireless/assets/images/img1.jpg'; ?>"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                                <table width="100%" cellpadding="0" cellspacing="0" align="" style="">
                                    <tr>
                                        <td
                                            style="margin: 0;padding:0;padding-top:20px;padding-right:10px;width: 25%;vertical-align: top;">
                                            <div class="mid">
                                                <div class="mid_innr heading">
                                                    <h1 class="mar_btn_10">4.<br />Agreement</h1>
                                                    <h3 class="mar_top_15">I agree, under penalty of perjury, to the
                                                        following statements:</h3>
                                                    <h3 class="mar_top_15 orng">You must initial next to each statement
                                                    </h3>
                                                    <div class="left_btm_small">
                                                        <p>I consent to let USAC contact me at my Lifeline phone number
                                                            for important reminders and updates to my Lifeline service.
                                                            Message and data rates may apply. Text STOP to end messages.
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td
                                            style="margin: 0;padding:0;padding-top:20px;width: 75%;vertical-align: top;">
                                            <div class="mid">
                                                <div class="mid_innr frm mar_btn_15">

													<?php foreach($lifeline_agreements as $key): ?>

                                                    <div class="chk_bx mar_btn_7">
                                                        <input type="checkbox" id="chk" name="chk" value="chk" <?php echo in_array($key->lifeline_agreement_id, $lifeline['agreement']) ? 'checked' : '' ?>><span
                                                            class="Hide_big">h</span><label for="chk"><?php echo $key->agreement ?></label>
													</div>
													
													<?php endforeach ?>
                                               
                                                </div>
                                                <div class="mid_innr frm bx2">
                                                    <table width="100%" cellpadding="0" cellspacing="0" align=""
                                                        style="">
                                                        <tr>
                                                            <td
                                                                style="margin: 0;padding: 0;vertical-align: top;padding-right: 10px;">
                                                                <div class="small_para">
                                                                    <p>Signature</p>
                                                                </div>
                                                                <div class="inputt mar_top_5">
                                                                    <input type="text" value="<?php echo $lifeline['signature']['name'] ?>"/>
                                                                </div>
                                                            </td>
                                                            <td
                                                                style="margin: 0;padding: 0;vertical-align: top;padding-right: 10px;">
                                                                <div class="small_para">
                                                                    <p>Today’s Date</p>
                                                                </div>
                                                                <div class="inputt mar_top_5">
                                                                    <input type="text" value="<?php echo date('m/d/Y') ?>"/>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <br />
                                                <br />
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                                <!-- <br /> -->
                                <table width="100%" cellpadding="0" cellspacing="0" align="" style="">
                                    <tr>
                                        <td
                                            style="margin: 0;padding:0;border-top: 1px solid #979090;padding-top:10px;vertical-align: top;">
                                            <div class="ftr">
                                                <p>Page 6 of 8</p>
                                            </div>
                                        </td>
                                        <td
                                            style="margin: 0;padding:0;text-align: right;border-top: 1px solid #979090;padding-top:10px;">
                                            <div class="ftr">
                                                <div class="rgtt_ftrr">
                                                    <h6 class="mar_btn_10"><a href="">Universal Service Administrative
                                                            Company | www.lifelinesupport.org</a></h6>
                                                    <h6><a href="">Need help? Call the Lifeline Support Center at
                                                            1-800-234-9473</a></h6>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </section>
    <section class="sheet page7">
        <table style="border-collapse:collapse;border:1px solid #eee;margin:auto;font-family: Arial,serif;" width="100%"
            cellspacing="0" cellpadding="0" border="0" align="center">
            <tr>
                <td valign="top" style="padding: 15px 25px;">
                    <table width="100%" cellpadding="0" cellspacing="0" align="center;">
                        <tr>
                            <td valign="top" style="padding:0;">
                                <table width="100%" cellpadding="0" cellspacing="0" align="" style="">
                                    <tr>
                                        <td
                                            style="margin: 0;padding:0;border-bottom: 1px solid #979090;padding-bottom:10px;">
                                            <div class="hdr">
                                                <h6 class="mar_btn_13">FCC FORM 5629</h6>
                                                <h2 class="mar_btn_10">Lifeline Program</h2>
                                                <h2><b>Application Form</b></h2>
                                            </div>
                                        </td>
                                        <td
                                            style="margin: 0;padding:0;text-align: right;border-bottom: 1px solid #979090;padding-bottom:10px;">
                                            <div class="hdr">
                                                <h6 class="mar_btn_10">OMB APPROVAL EDITION 3060-0819</h6>
                                                <div class="img_hdr">
                                                    <div class="img_hdr_innr">
                                                        <img style="max-width: auto;"
                                                            src="<?php echo $_SERVER['DOCUMENT_ROOT'] . '/wireless/assets/images/img1.jpg'; ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                                <table width="100%" cellpadding="0" cellspacing="0" align="" style="">
                                    <tr>
                                        <td
                                            style="margin: 0;padding:0;padding-top:20px;padding-right:10px;width: 25%;vertical-align: top;">
                                            <div class="mid">
                                                <div class="mid_innr heading">
                                                    <h1 class="mar_btn_10">5.<br />Agent<br />Informationr<br /></h1>
                                                    <h3 class="mar_top_15 orng">Answer only if a sales person submits
                                                        this form.</h3>
                                                </div>
                                            </div>
                                        </td>
                                        <td
                                            style="margin: 0;padding:0;padding-top:20px;width: 75%;vertical-align: top;">
                                            <div class="mid">
                                                <div class="mid_innr frm">
                                                    <div class="small_para too_small">
                                                        <p><b>What is the agent’s full legal name?</b></p>
                                                        <h6>The name you use on official documents, like your Social
                                                            Security Card or State ID. Not a nickname.</h6>
                                                    </div>
                                                    <div class="inputt mar_top_5 mar_btn_5">
                                                        <input type="text" />
                                                        <span>First</span>
                                                    </div>
                                                    <table width="100%" cellpadding="0" cellspacing="0" align=""
                                                        style="">
                                                        <tr>
                                                            <td
                                                                style="margin: 0;padding: 0;vertical-align: top;padding-right: 10px;">
                                                                <div class="inputt mar_btn_5">
                                                                    <input type="text" />
                                                                    <span>Middle</span>
                                                                </div>
                                                            </td>
                                                            <td
                                                                style="margin: 0;padding: 0;vertical-align: top;padding-right: 10px;">
                                                                <div class="inputt mar_btn_5">
                                                                    <input type="text" />
                                                                    <span>Suffix</span>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                    <div class="inputt mar_btn_15">
                                                        <input type="text" />
                                                        <span>Last</span>
                                                    </div>
                                                    <table width="100%" cellpadding="0" cellspacing="0" align=""
                                                        style="">
                                                        <tr>
                                                            <td
                                                                style="margin: 0;padding: 0;vertical-align: top;padding-right:5px;">
                                                                <div class="small_para too_small">
                                                                    <p><b>What is the agent’s ID number?</b></p>
                                                                </div>
                                                                <div class="inputt mar_top_5 mar_btn_15">
                                                                    <input type="text" />
                                                                </div>
                                                            </td>
                                                            <td
                                                                style="margin: 0;padding: 0;vertical-align: top;padding-left:5px;">
                                                                <div class="small_para too_small">
                                                                    <p><b>What is the agent’s date of birth?</b></p>
                                                                </div>
                                                                <div class="inputt mar_top_5 mar_btn_15">
                                                                    <input type="text" />
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                            <br />
                                            <br />
                                            <br />
                                            <br />
                                            <br />
                                            <br />
                                            <br />
                                            <br />
                                            <br />
                                            <br />
                                            <br />
                                            <br />
                                            <br />
                                            <br />
                                            <br />
                                            <br />
                                            <br />
                                        </td>
                                    </tr>
                                </table>
                                <br />
                                <table width="100%" cellpadding="0" cellspacing="0" align="" style="">
                                    <tr>
                                        <td
                                            style="margin: 0;padding:0;border-top: 1px solid #979090;padding-top:10px;vertical-align: top;">
                                            <div class="ftr">
                                                <p>Page 7 of 8</p>
                                            </div>
                                        </td>
                                        <td
                                            style="margin: 0;padding:0;text-align: right;border-top: 1px solid #979090;padding-top:10px;">
                                            <div class="ftr">
                                                <div class="rgtt_ftrr">
                                                    <h6 class="mar_btn_10"><a href="">Universal Service Administrative
                                                            Company | www.lifelinesupport.org</a></h6>
                                                    <h6><a href="">Need help? Call the Lifeline Support Center at
                                                            1-800-234-9473</a></h6>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </section>
    <section class="sheet page8 last-sheet">
        <table style="border-collapse:collapse;border:1px solid #eee;margin:auto;font-family: Arial,serif;" width="100%"
            cellspacing="0" cellpadding="0" border="0" align="center">
            <tr>
                <td valign="top" style="padding: 15px 25px;">
                    <table width="100%" cellpadding="0" cellspacing="0" align="center;">
                        <tr>
                            <td valign="top" style="padding:0;">
                                <table width="100%" cellpadding="0" cellspacing="0" align="" style="">
                                    <tr>
                                        <td
                                            style="margin: 0;padding:0;border-bottom: 1px solid #979090;padding-bottom:10px;">
                                            <div class="hdr">
                                                <h6 class="mar_btn_13">FCC FORM 5629</h6>
                                                <h2 class="mar_btn_10">Lifeline Program</h2>
                                                <h2><b>Application Form</b></h2>
                                            </div>
                                        </td>
                                        <td
                                            style="margin: 0;padding:0;text-align: right;border-bottom: 1px solid #979090;padding-bottom:10px;">
                                            <div class="hdr">
                                                <h6 class="mar_btn_10">OMB APPROVAL EDITION 3060-0819</h6>
                                                <div class="img_hdr">
                                                    <div class="img_hdr_innr">
                                                        <img style="max-width: auto;"
                                                            src="<?php echo $_SERVER['DOCUMENT_ROOT'] . '/wireless/assets/images/img1.jpg'; ?>" />
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                                <table width="100%" cellpadding="0" cellspacing="0" align="" style="">
                                    <tr>
                                        <td
                                            style="margin: 0;padding:0;padding-top:15px;width: 25%;vertical-align: top;">
                                        </td>
                                        <td
                                            style="margin: 0;padding:0;padding-top:15px;width: 75%;vertical-align: top;">
                                            <div class="mid">
                                                <div class="mid_innr">
                                                    <div class="side">
                                                        <div class="each">
                                                            <h4 class="mar_btn_13">Rules</h4>
                                                            <div class="small_para">
                                                                <p><b>PAPERWORK REDUCTION ACT NOTICE:</b> Section 54.410
                                                                    of the Federal Communications Commission’s rules
                                                                    requires all Lifeline subscribers to demonstrate
                                                                    their eligibility to receive Lifeline services. This
                                                                    collection of information stems from the
                                                                    Commission’s authority under Section 254 of the
                                                                    Communications Act of 1934, as amended, 47 U.S.C.
                                                                    §254. Using this authority, the FCC has designated
                                                                    USAC as the permanent Lifeline Administrator. The
                                                                    FCC has published rules detailing how consumers can
                                                                    qualify for Lifeline services and what Lifeline
                                                                    services they may receive (47 CFR §54.400 et seq.).
                                                                    The data provided in response to this information
                                                                    collection will be used by USAC to verify the
                                                                    applicant’s eligibility for Lifeline services. </p>
                                                                <p>We have estimated that each response to this
                                                                    collection of information will take, on average,
                                                                    between 0.25 and 0.75 hours. Our estimate includes
                                                                    the time to read the questions, look through
                                                                    existing records, gather the required data, and
                                                                    actually complete and review the form or response.
                                                                    If you have any comments on this estimate, or how we
                                                                    can improve the collection and reduce the burden it
                                                                    causes you, please write to the Federal
                                                                    Communications Commission, OMD-PERM, Paperwork
                                                                    Reduction Project (3060-0819), Washington, D.C.
                                                                    20554. We also will accept your comments via the
                                                                    Internet if you send them to PRA@fcc.gov. Please DO
                                                                    NOT SEND COMPLETED DATA COLLECTION FORMS TO THIS
                                                                    ADDRESS. </p>
                                                                <p>Remember – You are not required to respond to a
                                                                    collection of information sponsored by the Federal
                                                                    government, and the government may not conduct or
                                                                    sponsor this collection, unless it displays a
                                                                    currently valid Office of Management and Budget
                                                                    (OMB) control number. This collection has been
                                                                    assigned an OMB control number of 3060-0819. </p>
                                                                <p>The Commission is authorized under the Communications
                                                                    Act of 1934, as amended, to collect the information
                                                                    we request on this form. If we believe there may be
                                                                    a violation or potential violation of a statute or a
                                                                    Commission regulation, rule, or order, your response
                                                                    may be referred to the Federal, state, or local
                                                                    agency responsible for investigating, prosecuting,
                                                                    enforcing, or implementing the statute, rule,
                                                                    regulation, or order.</p>
                                                                <p>If you do not provide the information we request on
                                                                    this form, you will not be eligible to receive
                                                                    Lifeline services under the Lifeline Program rules,
                                                                    47 C.F.R. §§ 54.400-54.423.</p>
                                                                <p>The foregoing Notice is required by the Paperwork
                                                                    Reduction Act of 1995, P.L. No. 104-13, 44 U.S.C. §
                                                                    3501, et seq.</p>
                                                                <p><b>PRIVACY ACT STATEMENT:</b> The Privacy Act is a
                                                                    law that requires the Federal Communications
                                                                    Commission (FCC) and the Universal Service
                                                                    Administrative Company (USAC) to explain why we are
                                                                    asking individuals for personal information and what
                                                                    we are going to do with this information after we
                                                                    collect it. </p>
                                                                <p><b>Authority:</b> Section 254 of the Communications
                                                                    Act (47 U.S.C. § 254), as amended, 47 U.S.C. §254,
                                                                    authorizes the FCC to operate the Lifeline program.
                                                                    Using this authority, the FCC has designated USAC as
                                                                    the permanent Lifeline Administrator. The FCC has
                                                                    published rules detailing how consumers can qualify
                                                                    for Lifeline services and what Lifeline services
                                                                    they may receive (47 CFR §54.400 et seq.). </p>
                                                                <p><b>Purpose:</b> We are collecting this personal
                                                                    information so we can verify that you qualify for
                                                                    the Lifeline program and so we can efficiently
                                                                    provide Lifeline services to you. We access,
                                                                    maintain and use your personal information in the
                                                                    manner described in the Lifeline System of Records
                                                                    Notice (SORN), FCC/WCB-1, which we have published in
                                                                    82 Fed. Reg. 38686 (Aug. 15, 2017). </p>
                                                                <p><b>Routine Uses:</b> We may share the personal
                                                                    information you enter into this form with other
                                                                    parties for specific purposes, such as: with
                                                                    contractors that help us operate the Lifeline
                                                                    program; with other federal and state government
                                                                    agencies that help us determine your Lifeline
                                                                    eligibility; with the telecommunications companies
                                                                    that provide you Lifeline service; and with law
                                                                    enforcement and other officials investigating
                                                                    potential violations of Lifeline rules. </p>
                                                                <p>A complete listing of the ways we may use your
                                                                    information is published in the Lifeline SORN
                                                                    described in the “Purpose” paragraph of this
                                                                    statement. </p>
                                                                <p><b>Disclosure:</b> You are not required to provide
                                                                    the information we are requesting, but if you do
                                                                    not, you will not be eligible to receive Lifeline
                                                                    services under the Lifeline Program rules, 47 C.F.R.
                                                                    §§ 54.400-54.423.</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                                <br />
                                <table width="100%" cellpadding="0" cellspacing="0" align="" style="">
                                    <tr>
                                        <td
                                            style="margin: 0;padding:0;border-top: 1px solid #979090;padding-top:10px;vertical-align: top;">
                                            <div class="ftr">
                                                <p>Page 8 of 8</p>
                                            </div>
                                        </td>
                                        <td
                                            style="margin: 0;padding:0;text-align: right;border-top: 1px solid #979090;padding-top:10px;">
                                            <div class="ftr">
                                                <div class="rgtt_ftrr">
                                                    <h6 class="mar_btn_10"><a href="">Universal Service Administrative
                                                            Company | www.lifelinesupport.org</a></h6>
                                                    <h6><a href="">Need help? Call the Lifeline Support Center at
                                                            1-800-234-9473</a></h6>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </section>
</body>

</html>
