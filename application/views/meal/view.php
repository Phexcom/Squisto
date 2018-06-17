<div class="detail">
    <div class="row align-middle align-center">
        <div class="column small-12">
            <div class="form-box">
                <div class="row image-head" style="background-image: url(<?php echo "'".$meal->restaurant->images_path.$meal->id.".jpg'"; ?>);">
                </div>
                <div class="row form-content align-center align-middle">
                    <div class="column small-11">
                        <div class="row align-middle">
                            <div class="column small-12">
                                <h1 id="meal-name"><?php echo $meal->name; ?></h1>
                            </div>
                        </div>
                        <div class="row medium-unstack align-justify align-middle">
                            <div class="column">
                                <p class="descr"><i>Cuisine</i></p>
                            </div>
                            <div class="column">
                                <p class="descr"><?php echo $meal->cuisine; ?></p>
                            </div>
                        </div>
                        <div class="row medium-unstack align-justify align-middle">
                            <div class="column">
                                <p class="descr"><i>Price</i></p>
                            </div>
                            <div class="column">
                                AED <?php echo $meal->price; ?><a id="cart-button" class="button success basic" href="<?php echo base_url("cart/".$meal->restaurant->id."-".$meal->id); ?>"><i class="fi-shopping-cart"></i>Add to Cart</a>
                            </div>
                        </div>
                        <div class="row medium-unstack align-justify align-middle">
                            <div class="column">
                                <p class="descr"><i>Main Ingredient</i></p>
                            </div>
                            <div class="column">
                                <p class="descr"><?php echo $meal->ingredient; ?></p>
                            </div>
                        </div>
                        <div class="row medium-unstack align-justify align-middle">
                            <div class="column">
                                <p class="descr"><i>Type</i></p>
                            </div>
                            <div class="column">
                                <p class="descr"><?php echo ucfirst($meal->period); ?></p>
                            </div>
                        </div>
                        <div class="row medium-unstack align-justify align-middle">
                            <div class="column">
                                <p class="descr"><i>Offered by</i></p>
                            </div>
                            <div class="column">
                                <p class="descr"><?php echo $meal->restaurant->name; ?></p>
                            </div>
                        </div>
                        <div class="row medium-unstack align-justify align-top">
                            <div class="column">
                                <p class="descr"><i>Description</i></p>
                            </div>
                            <div class="column">
                                <p class="descr text-justify"><?php echo $meal->description; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>                          