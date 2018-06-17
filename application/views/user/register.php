<div class="row align-center">
    <div class="columns small-12 medium-9">
        <div class="form-box">
            <div class="row form-head align-center align-middle">
                <div class="columns small-9">
                    <h2>Register</h2>
                </div>
            </div>
            <div class="row align-center form-content align-middle">
                <div class="small-9 columns">
                    <?php if ($messages = $this->session->flashdata()): ?>
                        <?php foreach ($messages as $key => $value): ?>
                            <div data-closable class="callout <?php echo $key=='error'?'alert':'success' ?>">
                                <p data-close>
                                    <?php echo $value ?>
                                </p>
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                    <?php
                        $attributes = array('data-abide' => '', 'novalidate' => '');
                        echo form_open_multipart('user/register', $attributes);
                    ?>
                    <?php if (validation_errors()): ?>
                        <ul class="val_errors callout alert">
                            <?php echo validation_errors("<li>",'</li>'); ?>
                        </ul>
                    <?php endif; ?>
                        <label>Username
                            <input type="text" name="username" maxlength="60" value="<?php echo set_value('username'); ?>" required>
                            <span class="form-error">A valid username is required</span>
                        </label>
                        <label>E-mail
                            <input type="email" name="email" maxlength="150" value="<?php echo set_value('email'); ?>" required>
                            <span class="form-error">A valid e-mail address is required</span>
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
                            <input class="button expanded" value="Register" type="submit">
                        </label>
                    <?php echo form_close(); ?>
                </div>
            </div> 
        </div>
    </div>
</div>