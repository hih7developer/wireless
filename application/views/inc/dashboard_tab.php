<ul>
    <?php if(!in_array($user->role_id, [4])): ?>
    <li class="<?php echo in_array($this->uri->segment(1), ['dashboard']) ? 'active' : '' ?>"><a href="<?php echo base_url('dashboard') ?>"><span>Dashboard</span></a></li>
    <?php endif; ?>
    

    <?php if(in_array($user->role_id, [1])): ?>
        <li class="<?php echo in_array($this->uri->segment(2), ['profile']) ? 'active' : '' ?>"><a href="<?php echo base_url('admin/profile') ?>"><span>Profile</span></a></li>

        <li class="<?php echo in_array($this->uri->segment(1), ['carrier_admins', 'carrier_admin']) ? 'active' : '' ?>"><a href="<?php echo base_url('carrier_admins') ?>"><span>Carrier Admin</span></a></li>

        
        <?php //if($this->uri->segment(1) == 'plans'): ?>
     
        <?php //endif; ?>

        <li class="<?php echo in_array($this->uri->segment(1), ['carrier_users', 'carrier_user']) ? 'active' : '' ?>"><a href="<?php echo base_url('carrier_users') ?>"><span>Carrier User</span></a></li>

        <!-- <li class="<?php echo in_array($this->uri->segment(1), ['plans']) ? 'active' : '' ?>">
            <a href="<?php echo base_url('plans/lists') ?>"><span>Plans</span></a>
        </li> -->

        <li class="<?php echo in_array($this->uri->segment(1), ['settings', 'settings']) ? 'active' : '' ?>">
            <a href="<?php echo base_url('settings') ?>"><span>Settings</span></a>
        </li>

    <?php elseif(in_array($user->role_id, [2])): ?>
    
        <li class="<?php echo in_array($this->uri->segment(2), ['profile']) ? 'active' : '' ?>">
            <a href="<?php echo base_url('carrier_admin/profile') ?>"><span>Profile</span></a>
        </li>

        <li class="<?php echo in_array($this->uri->segment(1), ['plans', 'plan']) ? 'active' : '' ?>">
            <a href="<?php echo base_url('plans') ?>"><span>Plans</span></a>
        </li>
        
        <li class="<?php echo in_array($this->uri->segment(1), ['lifeline']) ? 'active' : '' ?>">
            <a href="<?php echo base_url('lifeline') ?>"><span>Lifeline</span></a>
        </li>

        <li class="<?php echo in_array($this->uri->segment(1), ['carrier_users', 'carrier_user']) ? 'active' : '' ?>">
            <a href="<?php echo base_url('carrier_users') ?>"><span>Carrier User</span></a>
        </li>

        
    <?php elseif(in_array($user->role_id, [4])): ?>
        <li class="<?php echo in_array($this->uri->segment(1), ['plans']) ? 'active' : '' ?>">
            <a href="<?php echo base_url('plans/search/'.$this->session->userdata('state_id')) ?>"><span>Plans</span></a>
        </li>
        
        
        <li class="<?php echo in_array($this->uri->segment(2), ['profile']) ? 'active' : '' ?>">
            <a href="<?php echo base_url('consumer/profile/') ?>"><span>Profile</span></a>
        </li>

        <li class="<?php echo in_array($this->uri->segment(2), ['applications']) ? 'active' : '' ?>">
            <a href="<?php echo base_url('consumer/applications') ?>"><span>Applications</span></a>
        </li>

        <?php if(in_array($this->uri->segment(1), ['application']) || in_array($this->uri->segment(2), ['application'])): ?>
        <li class="<?php echo in_array($this->uri->segment(1), ['application']) || in_array($this->uri->segment(2), ['application']) ? 'active' : '' ?>">
            <a href="javascript:void(0)"><span>Application</span></a>
        </li>
        <?php endif; ?>

    <?php endif; ?>
</ul>