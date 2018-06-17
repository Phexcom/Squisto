<div class="detail">
<?php if ($recent): ?>
    <h2 class="text-center subheader" style="font-weight: bolder">Recent Orders</h2>
    <div class="row align-center align-middle">
        <div class="column small-12">
            <table>
                <thead>
                    <tr>
                        <th class="text-center">No.</th>
                        <th class="text-center">Meal</th>
                        <th class="text-center">Restaurant</th>
                        <th class="text-center" width="180">Card</th>
                        <th class="text-center" width="100">Price</th>
                        <th class="text-center" width="150">Date</th>
                        <th class="text-center">Time</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($recent as $row): ?>
                <?php $period = new DateTime($row->datetime); ?>
                <tr>
                    <td><?php echo $row->id; ?></td>
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
        </div>
    </div>
<?php else: ?>
    <div class="row">
        <div class="callout large warning">
            <div>
                <p class="subheader">You have not placed any orders recently.</p>
                <p class="subheader">Click 'Menu' on the navigation bar to browse the available meals.</p>
            </div>
        </div>
    </div>
<?php endif; ?>
</div>