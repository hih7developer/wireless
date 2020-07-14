<table class="table" id="plan_table">
    <thead>
        <th style="width: 300px;">Name</th>
        <th style="width: 150px;">Details</th>
        <th>Price</th>
        <th>Service</th>
        <th>State</th>
        <th>Lifeline</th>
        <th>Tribal</th>
        <th class="text-center">Action</th>
    </thead>
    <tbody>
        <?php foreach($plans as $key): ?>
        <tr>
            <td>
                <b><?php echo $key->plan_name ?></b><br>
                <span><?php echo $key->description ?></span>
            </td>
            <td>
                <b>Voice:</b> <?php echo json_decode($key->voice)->value ?><br>
                <b>Sms:</b> <?php echo json_decode($key->sms)->value ?><br>
                <b>Data:</b>
                <?php echo json_decode($key->data)->value.' '.(strtolower(json_decode($key->data)->value) == 'unlimited' ? '' : json_decode($key->data)->type ) ?>
            </td>
            <!-- <td><?php //echo $key->initial_price ?></td> -->
            <td><?php echo $key->monthly_price ?></td>
            <td><?php echo $key->service ?></td>
            <td>
                <?php $plan_states = explode(',', $key->state_id) ?>
                <?php 
                foreach ($plan_states as $plan_state) {
                    echo $this->db->get_where('states', ['id' => $plan_state])->row()->name.'<br>';
                }
                ?>
            </td>
            <td><?php echo ($key->lifeline_service==1) ? "yes" : "no"  ?></td>
            <td><?php echo ($key->tribal_plan == 1) ? "yes" : "no" ?></td>
            <td>
                <div class="btn-group">
                    <a class="btn btn-info" href="<?php echo base_url('plan/edit/'.$key->plan_id)?>"><i
                            class="fa fa-pencil-square-o"></i> Edit</a>
                    <button class="btn btn-info delete_plan_btn"
                        data-href="<?php echo base_url('plan/delete/'.$key->plan_id)?>"><i class="fa fa-trash-o"></i>
                        Delete</button>
                </div>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<script>
$(document).ready(function() {
    $('#plan_table').DataTable();
});
</script>