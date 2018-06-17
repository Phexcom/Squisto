<div class="checkout">
    <div class="row align-center align-middle">
        <div class="column small-12 medium-9">
            <div class="callout success">
                <div class="row align-spaced align-middle">
                    <div class="column small-12 medium-7">
                        <p class="subheader text-justify">Your cart contains <?php echo $count; ?> item(s) costing a total of AED <?php echo $price; ?>. Click on the adjacent button if you would like to review the items in your cart. Otherwise, fill in your payment details below to place your order.</p>
                    </div>
                    <div class="column small-12 shrink">
                        <a class="button primary large" href="<?php echo base_url('meal/cart'); ?>">View cart</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row align-center align-middle">
        <div class="column small-12 medium-9">
            <div class="form-box">
                <div class="row form-head align-center align-middle">
                    <div class="columns small-12 medium-9">
                        <h2>Payment Details</h2>
                    </div>
                </div>
                <div class="row align-center form-content align-middle">
                    <div class="small-12 medium-9 column">
                        <?php if ($messages = $this->session->flashdata()): ?>
                            <?php foreach ($messages as $key => $value): ?>
                                <div class="callout data-closable <?php echo $key=='error'?'alert':'success' ?>">
                                    <p data-close>
                                        <?php echo $value ?>
                                    </p>
                                </div>
                            <?php endforeach; ?>
                        <?php endif; ?>
                        <?php 
                            $attributes = array('data-abide' => '', 'novalidate' => '');
                            echo form_open('', $attributes);
                        ?>
                        <?php if (validation_errors()): ?>
                            <ul class="val_errors callout alert">
                                <?php echo validation_errors("<li>",'</li>'); ?>
                            </ul>
                        <?php endif; ?>
                            <label>Card Number
                                <input type="number" pattern="card" name="card_no" value="<?php echo set_value('card_no'); ?>" required>
                                <span class="form-error">Insert a valid credit card number</span>
                            </label>
                            <label>Expiry Date
                                <input type="text" pattern="^(0[1-9]|1[0-2])\/?([0-9]{4}|[0-9]{2})$" name="exp" value="<?php echo set_value('exp'); ?>" required>
                                <span class="form-error">Insert a valid card expiry date (e.g. 02/20)</span>
                            </label>
                            <label>Name on Card
                                <input type="text" name="c_name" value="<?php echo set_value('exp'); ?>" required>
                                <span class="form-error">Insert a valid card name</span>
                            </label>
                            <label>CVV
                                <input type="number" pattern="cvv" name="cvv" value="<?php echo set_value('cvv'); ?>" required>
                                <span class="form-error">Insert a valid card verification value</span>
                            </label>
                            
                            <label>
                                <input class="button expanded" value="Submit" type="submit">
                            </label>
                        <?php echo form_close(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>