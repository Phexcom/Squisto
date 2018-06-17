<div class="detail">
    <h3 class="text-center subheader">Today's Orders</h3>
    <div class="row align-top">
        <div class="column small-12 medium-expand">
        <?php if ($orders): ?>
            <table>
                <thead>
                    <tr>
                        <th class="text-center" width="10">No.</th>
                        <th class="text-center" width="50">Username</th>
                        <th class="text-center" width="110">Meal</th>
                        <th class="text-center" width="120">Restaurant</th>
                        <th class="text-center">Card</th>
                        <th class="text-center">Price</th>
                        <th class="text-center">Date</th>
                        <th class="text-center">Time</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($orders as $row): ?>
                <?php $period = new DateTime($row->datetime); ?>
                <tr>
                    <td><?php echo $row->id; ?></td>
                    <td><?php echo $row->username; ?></td>
                    <td><?php echo $row->meal; ?></td>
                    <td><?php echo $row->name; ?></td>
                    <td><?php echo $row->card; ?></td>
                    <td><?php echo 'AED '.$row->price; ?></td>
                    <td><?php echo $period->format('M jS, Y'); ?></td>
                    <td><?php echo $period->format('H:i'); ?></td>
                </tr>
                <?php endforeach ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="callout large warning">
                <div>
                    <p class="subheader">There have been no recent orders within the last 24 hours.</p>
                </div>
            </div>
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