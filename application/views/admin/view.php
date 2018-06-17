<div class="detail">
    <div class="row">
    <?php if ($messages = $this->session->flashdata()): ?>
        <?php foreach ($messages as $key => $value): ?>
            <div class="callout data-closable <?php echo $key=='error'?'alert':'success' ?>">
                <p data-close>
                    <?php echo $value ?>
                </p>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
    </div>
    <h3 class="text-center">Registered Admins</h3>
    <div class="row align-top">
        <div class="column small-12 medium-expand">
        <?php if ($admins): ?>
            <table class="scroll">
                <thead>
                    <tr>
                        <th class="text-center">Username</th>
                        <th class="text-center"></th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($admins as $row): ?>
                <tr>
                    <td><?php echo $row->username; ?></td>
                    <td><a class="button alert" href="<?php echo base_url('admin/delete/'.$row->id); ?>">Delete</a></td>
                </tr>
                <?php endforeach ?>
                </tbody>
            </table>
        <?php endif; ?>
        </div>
        <div class="column small-12 shrink">
            <div class="callout admin">
                <h3 class="text-center">Admin Actions</h3>
                <ul class="no-bullet text-center">
                    <li><a class="button primary" href="<?php echo base_url('admin/view'); ?>">Manage Admins</a></li>
                    <li><a class="button primary" href="<?php echo base_url('admin'); ?>">View order report</a></li>
                    <li><a class="button primary" href="<?php echo base_url('admin/add'); ?>">Add Admin</a></li>
                    <li><a class="button primary" href="<?php echo base_url('restaurant/index'); ?>">Manage Restaurants</a></li>
                    <li><a class="button primary" href="<?php echo base_url('restaurant/add'); ?>">Add Restaurants</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>