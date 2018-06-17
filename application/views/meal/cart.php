<?php
function get_meal_data($rest_id, $meal_id, $meals_array) {
    foreach ($meals_array as $meal) {
        if ($meal->id == $meal_id && $meal->restaurant->id == $rest_id) return $meal;
    }
    return false;
}
?>
<div class="detail">
<?php if (!empty($cart = $this->session->cart)): ?>
    <h1 class="text-center" style="font-weight: bolder">Cart</h1>
    <div class="row align-center align-middle">
    <div class="columns small-12">
    <?php foreach($cart as $key => $item): ?>
        <?php if($item = get_meal_data($item['restaurant'], $item['meal'], $meals)): ?>
            <div class="row box">
                <div class="image column small-12 medium-4" style="background-image: url(<?php echo "'".$item->restaurant->images_path.$item->id."'"; ?>);">
                </div>
                <div class="content column small-12 medium-8">
                    <h4 ><?php echo $item->name; ?><a data-disable-hover="false" tabindex="1" data-tooltip aria-haspopup="true" title="view meal" class="has-tip right button small primary" href="<?php echo base_url("meal/view/".$item->restaurant->id."/".$item->id); ?>"><i class="fi-arrows-out"></i></a></h4>
                    
                    <hr/>
                    <span>Cuisine: <?php echo $item->cuisine; ?></span>
                    <hr/>
                    <span class="price">Price: AED <?php echo $item->price; ?></span>
                    <a id="remove-cart-button" class="button alert small" href="<?php echo base_url("cart/".$key); ?>"><i class="fi-shopping-cart"></i>Remove</a>
                    <hr/>
                    <span class="rest">Offered by: <?php echo $item->restaurant->name; ?></span>
                    <a class="button primary small" href="<?php echo base_url("restaurant/view/".$item->restaurant->id); ?>"><i class="fi-info"></i>info</a>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; ?>
    </div>
    </div>
    <div class="row align-middle align-center">
        <div class="column small-12">
            <div class="callout success">
                <div class="row align-spaced">
                    <p id="price-text" class="subheader text-center">Total : AED <span id="price-number"></span></p>
                    <a class="button primary large" href="<?php echo base_url('meal/checkout'); ?>">Checkout</a>
                </div>
            </div>
        </div>
    </div>
<?php else: ?>
    <div class="row">
        <div class="column small-12">
            <div class="callout large info">
                <p class="subheader">Your cart is currently empty. Please click on the button below to browse and add meals to the cart.</p>
            </div>
        </div>
    </div>  
<?php endif; ?>
    <div class="row align-center">
        <div class="column small-10">
            <a href="<?php echo base_url("meal") ?>" class="button hollow success expanded large"><i>continue shopping?</i></a> 
        </div>
    </div>
</div>