<?php if(count($plans) > 0): ?>

<?php foreach($plans as $key): ?>
<div class="plan-innr-table">
    <div class="pln-prc-outr">
        <div class="tag-innr">
            <img src="<?php echo base_url('uploads/'.$key->logo) ?>" alt="" />
        </div>
        <div class="pln-img">
            <img class="img-thumbnail" src="<?php echo base_url('uploads/'.$key->file) ?>" alt="" />
        </div>
        <div class="value-pln-txt">
            <a href="javascript:void(0);">
                <h3><?php echo $key->plan_name ?></h3>
            </a>

            <a href="javascript:void(0);" class="btn btn-info service-type"><em><i class="fa fa-info-circle" aria-hidden="true"></i></em><strong> <?php echo $key->service ?></strong></a>
            
            <div class="value-list">
                <ul>
                    <li><em><i class="fa fa-signal"></i></em><strong>Network: <?php echo $key->service_provider_name ?> </strong>
                    </li>
                    <li>
                        <?php echo $key->description ?>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="pln-prc-innr">
        <div class="pln-prc-pic">
            <div class="box">
                <div class="chart" data-percent="<?php echo $this->plan->voice_percentage(json_decode($key->voice)->value); ?>">Calls</div>
            </div>
        </div>
        <div class="pln-prc-txt">
            <h4><?php echo json_decode($key->voice)->value ?></h4>
            <p><?php echo json_decode($key->voice)->extra ?></p>
        </div>
    </div>
    
    <div class="pln-prc-innr">
        <div class="pln-prc-pic">
            <div class="box">
                <div class="chart" data-percent="<?php echo $this->plan->sms_percentage(json_decode($key->sms)->value); ?>">Sms</div>
            </div>
        </div>
        <div class="pln-prc-txt">
            <h4></b> <?php echo json_decode($key->sms)->value ?></h4>
            <p></b> <?php echo json_decode($key->sms)->extra ?></p>
        </div>
    </div>

    <div class="pln-prc-innr">
        <div class="pln-prc-pic">
            <div class="box">
                <div class="chart" data-percent="<?php echo $this->plan->data_percentage(json_decode($key->data)->value, json_decode($key->data)->type); ?>">Data</div>
            </div>
        </div>
        <div class="pln-prc-txt">
            <h4><?php echo json_decode($key->data)->value.' '.(strtolower(json_decode($key->data)->value) == 'unlimited' ? '' : json_decode($key->data)->type ) ?></h4>
            <p><?php echo json_decode($key->data)->extra ?></p>
        </div>
    </div>

    <div class="pln-prc-innr pln-price">
        <div class="pln-prc-txt">
            <h2><sup><i class="fa fa-usd" aria-hidden="true"></i></sup><?php echo $key->monthly_price ?><sup>/mo</sup></h2>
            <span class="init-price"> <small><b>Initial price</b></small> <span><sup><i class="fa fa-usd" aria-hidden="true"></i></sup><?php echo $key->initial_price ?></span></span>
            <!-- <strong><strong>Excludes Phone Costs</strong></p> -->
        </div>
    </div>
    <div class="pln-prc-innr pln-price">
        <a href="<?php echo base_url('application/eligibility_check/'.$key->plan_id) ?>" class="btn btn-primary site-btn">Apply</a>
    </div>
</div>
<?php endforeach; ?>


<script src='https://cdnjs.cloudflare.com/ajax/libs/easy-pie-chart/2.1.6/jquery.easypiechart.min.js'></script>

<script>
    $('.chart').easyPieChart({
        size: 60,
        barColor: "#00a69c",
        scaleLength: 0,
        lineWidth: 13,
        trackColor: "#c5daeb",
        lineCap: "circle",
        animate: 1000,
    });
</script>
<?php elseif(count($plans) == 0): ?>

<div class="plan-innr-table justify-content-center p-4">
    <p class="text-center text-muted">
        No result found
    </p>
</div>

<?php endif; ?>