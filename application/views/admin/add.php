<div class="row align-center">
    <div class="columns small-12 medium-9">
        <div class="form-box">
            <div class="row form-head align-center align-middle">
                <div class="columns small-9">
                    <h2>Create Admin</h2>
                </div>
            </div>
            <div class="row align-center form-content align-middle">
                <div class="small-9 columns">
                    <?php
                        $attributes = array('data-abide' => '', 'novalidate' => '');
                        echo form_open('admin/add', $attributes);
                    ?>
                        <ul>
                    <?php if (validation_errors()): ?>
                        <ul class="val_errors callout alert">
                            <?php echo validation_errors("<li>",'</li>'); ?>
                        </ul>
                    <?php endif; ?>
                        </ul>
                        <label>Username
                            <input type="text" pattern="alpha_numeric" maxlength="30" name="username" value="<?php echo set_value('username'); ?>" required>
                            <span class="form-error">Enter Username. Only alphanumeric characters allowed</span>
                        </label>
                        <label>Password
                            <input type="password" name="password" id="password" required>
                            <span class="form-error">Password is required</span>
                        </label>
                        <label>Confirm Password
                            <input type="password" name="password_conf" data-equalto="password" required>
                            <span class="form-error">Passwords must match</span>
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