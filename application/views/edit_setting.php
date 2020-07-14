<?php include('inc/header.php') ?>

<section class="dasboard_info">
    <div class="container-fluid">
        <div class="dashboard-tab-innr">

            <?php include('inc/dashboard_tab.php') ?>
            <div class="capa-outr">
                <div class="planinf">
                    <div class="plasec_one">View Settings Details</div>

                </div>
                
                        <!-- <div class="row"> -->
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
            <div class="passchange_sec">
                      <div class="cmmn_title">
                        <h2>Upload Files</h2>
                        <!-- <div class="row"> -->
                        <form action="defaultController/setting_page_insert" method="POST">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="name">Name</label>
                                                <input type="text" class="form-control" placeholder="Enter Name"
                                                    name="setting[name]"/>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="name">Value</label>
                                                <input type="text" class="form-control" placeholder="Enter Value"
                                                    name="setting[value]"/>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="name">Label</label>
                                                <input type="text" class="form-control" placeholder="Enter Label"
                                                    name="setting[label]"/>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn">Update</button>
                                        <!-- <button type="submit" class="btn">Update</button> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
        </div>
    </div>
</div>


<?php include('inc/common_scripts.php') ?>




</body>

</html>