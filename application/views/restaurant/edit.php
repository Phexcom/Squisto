<div class="row align-center">
    <div class="columns small-12 medium-9">
        <div class="form-box">
            <div class="row form-head align-center align-middle">
                <div class="columns small-9">
                    <h2>Edit Restaurant</h2>
                </div>
            </div>
            <div class="row align-center form-content align-middle">
                <div class="small-9 columns">
                    <?php
                        if ($this->input->method() == "post") {
                            $restaurant = new stdClass();
                            $restaurant->id = html_escape($this->input->post('id'));
                        }
                        // $hidden = array('id' => $restaurant->id);
                        
                        // $attributes = array('data-abide' => '', 'novalidate' => '');

                        echo form_open('restaurant/edit/'.$restaurant->id);
                    ?>
                    <?php if (validation_errors()): ?>
                        <ul class="val_errors callout alert">
                            <?php echo validation_errors("<li>",'</li>'); ?>
                        </ul>
                    <?php endif; ?>
                        <label>Name
                            <input type="text" maxlength="200" name="name"
                            value="<?php 
                                if ($this->input->method()!="post") {
                                    echo set_value('name',$restaurant->name);
                                } else {
                                    echo set_value('name');
                                } 
                            ?>" required>
                            <span class="form-error">A valid restaurant name is required</span>
                        </label>
                        <label>WSDL URI
                            <input type="url" name="wsdl" value="<?php
                                if ($this->input->method()!="post") {
                                    echo set_value('wsdl',$restaurant->wsdl_url);
                                }
                                else {
                                    echo set_value('wsdl');
                                } 
                            ?>" required>
                            <span class="form-error">A URL link to WSDL file is required</span>
                        </label>
                        <label>Images folder URI
                            <input type="url" name="images" value="<?php
                                if ($this->input->method()!="post") {
                                    echo set_value('images',$restaurant->images_path);
                                }
                                else {
                                    echo set_value('images');
                                }?>" required>
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