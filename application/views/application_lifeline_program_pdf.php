<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.css') ?>" /> -->

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

</html>
