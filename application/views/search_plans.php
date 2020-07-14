    <!--Header Start-->
    <?php include('inc/header.php') ?>
    <!--Header End-->

    <section class="dasboard_info">
        <div class="container-fluid">
            <div class="dashboard-tab-innr">
                <?php include('inc/dashboard_tab.php') ?>

                <div class="row mt-5">
                    <div class="col-md-12 cmmn_title">
                        <h2>
                            Plans in <?php echo $state->name ?>
                            <!-- / <small><b>Tribal: <?php echo $this->db->get_where('zipcodes', ['zipcode' => $this->db->get_where('consumers', ['user_id' => $user->user_id])->row()->zip])->row()->tribal == 1 ? 'Yes' : 'No'; ?></b></small> -->
                        </h2>
                    </div>
                </div>

                <div class="range-outr">
                    <div class="row">
                        <div class="col-md-6"></div>
                        <div class="col-md-2">
                            <label class="d-block text-center" for=""><small>Data: </small> <b class="data_label">Unlimited</b></label>
                            <div class="range-innr">
                                <input id="range1" type="text" name="data_range" value="" />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label class="d-block text-center" for=""><small>Sms: </small> <b class="sms_label">Unlimited</b></label>
                            <div class="range-innr">
                                <input id="range2" type="text" name="" value="" />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label class="d-block text-center" for=""><small>Voice: </small> <b class="voice_label">Unlimited</b></label>
                            <div class="range-innr">
                                <input id="range3" type="text" name="" value="" />
                            </div>
                        </div>
                    </div>
                </div>

                <div class="dshh-outr">
                    
                    <div class="plan-outr mt-2" id="plans-otr" style="position: relative">

                        <input type="hidden" value="0" name="offset">
                        <input type="hidden" value="<?php echo $total_plans ?>" name="total_plans">
                        <input type="hidden" name="sort_data" value="Unlimited">
                        <input type="hidden" name="sort_sms" value="Unlimited">
                        <input type="hidden" name="sort_voice" value="Unlimited">

                        <div id="plan-list-otr">
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

                                            <!-- <a href="javascript:void(0);" class="btn btn-info service-type"><em><i class="fa fa-info-circle" aria-hidden="true"></i></em><strong> <?php echo $key->service ?></strong></a> -->
                                            
                                            <div class="value-list">
                                                <ul>
                                                    <li><em><i class="fa fa-signal"></i></em><strong>Carrier: <?php echo $key->service_provider_name ?> </strong>
                                                    </li>
                                                    <li>
                                                        <?php echo $key->description ?>
                                                    </li> 
                                                    <li>
                                                        Handset: <?php echo $key->handset_name ?>
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
                                        <div class="pln-prc-txt text-center">
                                            <h2><sup><i class="fa fa-usd" aria-hidden="true"></i></sup><?php echo $key->monthly_price ?><sup>/mo</sup></h2>
                                            <span class="init-price"> <small><b>Initial price</b></small> <span><sup><i class="fa fa-usd" aria-hidden="true"></i></sup><?php echo $key->initial_price ?></span></span>
                                            <!-- <h2></h2> -->
                                            <!--  <min>Excludes Phone Costs</min></p> --> 
                                        </div>
                                    </div>
                                    <div class="pln-prc-innr pln-price">
                                        <a href="<?php echo base_url('application/eligibility_check/'.$key->plan_id) ?>" class="btn btn-primary site-btn">Apply</a>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            <?php elseif(count($plans) == 0): ?>

                            <div class="plan-innr-table justify-content-center p-4">
                                <p class="text-center text-muted">
                                    No result found
                                </p>
                            </div>

                            <?php endif; ?>
                        </div>

                   
                      

                    </div>
                </div>
                
                <?php if($total_plans > 1): ?>
                <div class="row mt-2">
                    <div class="col-md-12 text-center">
                        <button class="btn" id="load_more">Load More Results</button>
                    </div>
                </div>
                <?php endif; ?>

            </div>
        </div>
    </section>

    <?php include('inc/footer.php') ?>


    <?php include('inc/common_scripts.php') ?>

    <script>
        $(document).ready(function() {
            $('#plan_table').DataTable();
        });
    </script>



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
            'Process failed',
            '<?php echo $this->session->flashdata('error') ?>',
            'error'
        )
    </script>
    <?php endif; ?>

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

    <script>
       
    </script>


    <script src="<?php echo base_url('assets/js/ion.rangeSlider.js') ?>"></script>
    <script>

        var data_values = ['0', '50 MB', '100 MB', '500 MB', '750 MB', '1 GB', '5 GB', '10 GB', '25 GB', '75 GB', '100 GB', 'Unlimited'];
        
        // be careful! FROM and TO should be index of values array
        var data_from = data_values.indexOf('Unlimited');
        var data_to = data_values.indexOf('Unlimited');
        
        $("#range1").ionRangeSlider({
            skin: "big",
            hide_min_max: true,
            hide_from_to: true,
            from: data_from,
            to: data_to,
            values: data_values,
            onChange: function(data) {
                $('input[name="sort_data"]').val(data.from_value);
                $('.data_label').html(data.from_value);
                plan_sort();
            }
        });


        var sms_values = ['0', '50', '100', '250', '500', '750', '1000', '1500', '2000', '3000', 'Unlimited'];
        
        // be careful! FROM and TO should be index of values array
        var sms_from = sms_values.indexOf('Unlimited');
        var sms_to = sms_values.indexOf('Unlimited');


        $("#range2").ionRangeSlider({
            skin: "big",
            hide_min_max: true,
            hide_from_to: true,
            from: sms_from,
            to: sms_to,
            values: sms_values,
            onChange: function(data) {
                $('input[name="sort_sms"]').val(data.from_value);
                $('.sms_label').html(data.from_value);
                plan_sort();
            }
        });


        var voice_values = ['0', '50', '100', '250', '500', '750', '1000', '1500', '2000', '3000', 'Unlimited'];
        
        // be careful! FROM and TO should be index of values array
        var voice_from = voice_values.indexOf('Unlimited');
        var voice_to = voice_values.indexOf('Unlimited');

        $("#range3").ionRangeSlider({
            skin: "big",
            hide_min_max: true,
            hide_from_to: true,
            from: voice_from,
            to: voice_to,
            values: voice_values,
            onChange: function(data) {
                $('input[name="sort_voice"]').val(data.from_value);
                $('.voice_label').html(data.from_value);
                plan_sort();
            }
        });

        function plan_sort(){
            var sort_data = $('input[name="sort_data"]').val();
            var sort_sms = $('input[name="sort_sms"]').val();
            var sort_voice = $('input[name="sort_voice"]').val();

            $.ajax({
                url: "<?php echo base_url('PlanController/sort_plan_consumer') ?>",
                data: {'sort_data': sort_data, 'sort_sms' : sort_sms, 'sort_voice' : sort_voice},
                type: 'post',
                dataType: 'json',
                beforeSend:function(){
                    $('#plans-otr').append('<div class="loader_container"><div class="loader"></div></div>');
                },
                success:function(data){
                    // console.log(data);
                    $('#plan-list-otr').html(data.plan_view);
                    $('input[name="offset"]').val(0);
                    $('input[name="total_plans"]').val(data.total_plan);
                    $('#plans-otr .loader_container').remove();

                    if(data.total_plan > 1){
                        $('#load_more').show();
                    } else if(data.total_plan <= 1){
                        $('#load_more').hide();
                    }
                }
            });
        }

        $(document).on('click', '#load_more', function(){
            var offset = parseInt($('input[name="offset"]').val()) + 1;
            var total_plans = $('input[name="total_plans"]').val();
            var sort_data = $('input[name="sort_data"]').val();
            var sort_sms = $('input[name="sort_sms"]').val();
            var sort_voice = $('input[name="sort_voice"]').val();

           
            if(offset < total_plans){
                $('input[name="offset"]').val(offset);
                $.ajax({
                    url: '<?php echo base_url('PlanController/load_more_plan') ?>',
                    data: {'offset': offset, 'sort_data': sort_data, 'sort_sms': sort_sms, 'sort_voice' : sort_voice},
                    type: 'post',
                    dataType: 'json',
                    beforeSend:function(){
                        $('#plans-otr').append('<div class="loader_container"><div class="loader"></div></div>');
                    },
                    success:function(data){
                        // console.log(data);
                        $('#plans-otr #plan-list-otr').append(data.plan_view);
                        $('#plans-otr .loader_container').remove();

                        if(total_plans == offset + 1){
                            $('#load_more').hide();
                        }
                    }
                });
            }
        });
    </script>
    


    </body>

    </html>