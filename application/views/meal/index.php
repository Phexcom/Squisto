<div class="detail">
<!-- <php //if ($meals): > // there will always be meals -->
    <div class="row align-center align-middle">
    <div class="columns small-12">
    <?php if ($messages = $this->session->flashdata()): ?>
        <?php foreach ($messages as $key => $value): ?>
            <div class="callout data-closable <?php echo $key=='error'?'alert':'success' ?>">
                <p data-close>
                    <?php echo $value ?>
                </p>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
    <?php foreach($meals as $meal): ?>
        <div class="row box">
            <div class="image column small-12 medium-4" style="background-image: url(<?php echo "'".$meal->restaurant->images_path.$meal->id."'"; ?>);">
            </div>
            <div class="content column small-12 medium-8">
                <h4 ><?php echo $meal->name; ?><a data-disable-hover="false" tabindex="1" data-tooltip aria-haspopup="true" title="view meal" class="has-tip right button small primary" href="<?php echo base_url("meal/view/".$meal->restaurant->id."/".$meal->id); ?>"><i class="fi-arrows-out"></i></a></h4>
                
                <hr/>
                <span>Cuisine: <?php echo $meal->cuisine; ?></span>
                <hr/>
                <span>Price: AED <?php echo $meal->price; ?></span>
                <a id="cart-button" class="button success small" href="<?php echo base_url("cart/".$meal->restaurant->id."-".$meal->id); ?>"><i class="fi-shopping-cart"></i>Add to Cart</a>
                <hr/>
                <span class="rest">Offered by: <?php echo $meal->restaurant->name; ?></span>
                <a class="button primary small" href="<?php echo base_url("restaurant/view/".$meal->restaurant->id); ?>"><i class="fi-info"></i>info</a>
            </div>
        </div>
    <?php endforeach; ?>
    </div>
    <div class="columns small-10">
        <a href="<?php echo base_url("meal/search") ?>" class="button hollow success expanded large"><i>looking for a meal?</i></a> 
    </div>
    </div>
</div>