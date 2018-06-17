<div class="detail">
    <?php if(isset($failed)): ?>
    <div class="row">
        <div class="column small-12">
            <div class="callout alert">
                <p class="subheader text-justify">One or more of your ordered items have not been successfully placed. This may be due to a downtime in the meal's restaurant server, in which case you'll need to try again later. Also, cross check your payment details and try again. Below are the items which have failed.</p>
            </div>
        </div>
    </div>
    <div class="row align-center align-middle">
        <div class="column small-12">
        <?php foreach ($failed as $item): ?>
            <div class="row box">
                <div class="image column small-12 medium-4" style="background-image: url(<?php echo "'".$item->restaurant->images_path.$item->id."'"; ?>);">
                </div>
                <div class="content column small-12 medium-8">
                    <h4 ><?php echo $item->name; ?><a data-disable-hover="false" tabindex="1" data-tooltip aria-haspopup="true" title="view meal" class="has-tip right button small primary" href="<?php echo base_url("meal/view/".$item->restaurant->id."/".$item->id); ?>"><i class="fi-arrows-out"></i></a></h4>
                    
                    <hr/>
                    <span>Cuisine: <?php echo $item->cuisine; ?></span>
                    <hr/>
                    <span>Price: AED <?php echo $item->price; ?></span>
                    <a id="cart-button" class="button success small" href="<?php echo base_url("cart/".$item->restaurant->id."-".$item->id); ?>"><i class="fi-shopping-cart"></i>Add back to Cart</a>
                    <hr/>
                    <span class="rest">Offered by: <?php echo $item->restaurant->name; ?></span>
                    <a class="button primary small" href="<?php echo base_url("restaurant/view/".$item->restaurant->id); ?>"><i class="fi-info"></i>info</a>
                </div>
            </div>
        <?php endforeach ?>
        </div>
    </div>
    <?php else: ?>
        <div class="row">
            <div class="column small-12">
                <div class="callout large success">
                    <div class="row align-spaced align-middle">
                        <div class="column small-12 medium-8">
                            <p class="subheader">Your order has been successfully placed and is undergoing processing. Thanks for using our service.</p>
                            <p class="subheader">Click on the adjacent button to continue browsing the menu.</p>
                        </div>
                        <div class="column small-12 shrink">
                            <a class="button primary large" href="<?php echo base_url('meal'); ?>">View Menu</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>