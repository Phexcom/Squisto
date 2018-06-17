<div class="detail">
    <h3 class="text-center">Restaurants</h3>
    <div class="row align-top">
        <div class="column small-12 medium-expand">
        <?php if ($restaurants): ?>
            <table>
                <thead>
                    <tr>
                        <th class="text-center">id</th>
                        <th class="text-center">Name</th>
                        <th class="text-center">WSDL URL</th>
                        <th class="text-center">Images Path</th>
                        <th class="text-center"></th>
                        <th class="text-center"></th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($restaurants as $row): ?>
                <tr>
                    <td><?php echo $row->id; ?></td>
                    <td><?php echo $row->name; ?></td>
                    <td><?php echo $row->wsdl_url; ?></td>
                    <td><?php echo $row->images_path; ?></td>
                    <td><a class="button success" href="<?php echo base_url('restaurant/edit/'.$row->id); ?>">Edit</a></td>
                    <td><a class="button alert" href="<?php echo base_url('restaurant/delete/'.$row->id); ?>">Delete</a></td>
                </tr>
                <?php endforeach ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="callout large warning">
                <div>
                    <p class="subheader">There are no registered restaurants in the database. Add some restaurants and try again.</p>
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