<div class="row align-center">
    <div class="columns small-12 medium-9">
        <div class="form-box">
            <div class="row form-head align-center align-middle">
                <div class="columns small-9">
                    <h2>Add Restaurant</h2>
                </div>
            </div>
            <div class="row align-center form-content align-middle">
                <div class="small-9 columns">
                    <?php if ($messages = $this->session->flashdata()): ?>
                        <?php foreach ($messages as $key => $value): ?>
                            <div data-closable class="callout <?php echo $key=='error'?'alert':'success' ?>">
                                <p data-close><?php echo $value ?></p>
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
                        <label>Name
                            <input type="text" maxlength="200" name="name" value="<?php echo set_value('name'); ?>" required>
                            <span class="form-error">A valid restaurant name is required</span>
                        </label>
                        <label>WSDL URI
                            <input placeholder="http://eatwithus.com/web/services.wsdl" type="url" name="wsdl" value="<?php echo set_value('wsdl'); ?>" required>
                            <span class="form-error">A URL link to WSDL file is required</span>
                        </label>
                        <label>Images folder URI
                            <input placeholder="http://eatwithus.com/web/images/" type="url" name="images" value="<?php echo set_value('url'); ?>" required>
                            <span class="form-error">A URL link to images path is required</span>
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