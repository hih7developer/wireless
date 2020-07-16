<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.13/css/all.css"
        integrity="sha384-DNOHZ68U8hZfKXOrtjWvjxusGo9WQnrNx2sqG0tfsghAvtVlRW3tvkXWZh58N9jp" crossorigin="anonymous" />
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
        font-size: 12pt;
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
        border-bottom: 1px solid #000;
    }

	h3{
		display: inline;
	}
	ol{
		margin-bottom: 10px;
	}
	.ans{
		list-style-type: none;
		margin-top:10px;
	}
	.ques{
		margin-bottom:10px;
	}
	input{
		display: inline;
	}
	.bold{
		font-weight: bold;
	}
	P{
		margin: 20px 0;
	}
    </style>
</head>

<body>
    <div class=".page">
        <h2>Household Worksheet</h2>

		<p>Follow this decision tree to confirm if you qualify for the Lifeline Program.</p>

		<ol>
			<li class="ques"><h3>Do you live with another adult?</h3> <br>
				<ul class="ans">
					<li><input type="checkbox" name="" id="" <?php echo $household->question_one == 'yes' ? 'checked' : '' ?>> Yes</li>
					<li><input type="checkbox" name="" id="" <?php echo $household->question_one == 'no' ? 'checked' : '' ?>> No</li>
				</ul>
			</li>

			<li class="ques"><h3>Do they get Lifeline?</h3> <br>
				<ul class="ans">
					<li><input type="checkbox" name="" id="" <?php echo $household->question_two == 'yes' ? 'checked' : '' ?>> Yes</li>
					<li><input type="checkbox" name="" id="" <?php echo $household->question_two == 'no' ? 'checked' : '' ?>> No</li>
				</ul>
			</li>
		
			<li class="ques"><h3>Do you share money (income and expenses) with them?</h3> <br>
				<ul class="ans">
					<li><input type="checkbox" name="" id="" <?php echo $household->question_three == 'yes' ? 'checked' : '' ?>> Yes</li>
					<li><input type="checkbox" name="" id="" <?php echo $household->question_three == 'no' ? 'checked' : '' ?>> No</li>
				</ul>
			</li>

			<?php if($household->question_one == 'yes' && $household->question_two == 'yes' && $household->question_three == 'yes'): ?>
			<p><input type="checkbox" name="" id="" checked> <span class="bold">You do not qualify for Lifeline </span> because someone in your household already gets the benefit. You are only allowed to get one Lifeline discount per household, not per person.</p>
			<?php endif; ?>


			<?php if($household->question_one == 'no' || $household->question_two == 'no' || ($household->question_one == 'yes' && $household->question_two == 'yes' && $household->question_three == 'no')): ?>
			<p><input type="checkbox" name="" id="" checked> <span class="bold">You can apply for Lifeline.</span> You live in a household that does not get Lifeline yet.</p>
			<p>I live at an address with more than one household.</p>
			<p>
				<div style="display:inline;float:right">
					<span class='bold' style="display:block;margin-bottom: 10px">Signature</span>
					<img width="125" src="<?php echo $_SERVER['DOCUMENT_ROOT'].'/wireless/uploads/signature/'.$household->image[0]; ?>" alt="">, <?php echo $household->date[0]; ?>
				</div>
			</p>
			<?php endif; ?>
			
			<div style="clear: both"></div>

			<?php if($household->question_three == 'no'): ?>
			<p><input type="checkbox" name="" id="" checked> <span class="bold">You can apply for Lifeline.</span> You live at an address with more than one household and your household does not get Lifeline yet.</p>
			<p>I live at an address with more than one household.</p>
			<p>
				<div style="display:inline;float:right">
					<span class='bold' style="display:block;margin-bottom: 10px">Signature</span>
					<img width="125" src="<?php echo $_SERVER['DOCUMENT_ROOT'].'/wireless/uploads/signature/'.$household->image[1]; ?>" alt="">, <?php echo $household->date[1]; ?>
				</div>
			</p>
			<?php endif; ?>
		</ol>
    </div>



</body>

</html>
