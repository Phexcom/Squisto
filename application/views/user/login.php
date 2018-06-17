<div class="row align-center">
    <div class="columns small-12 medium-9">
        <div class="form-box">
            <div class="row form-head align-center align-middle">
                <div class="columns small-9">
                    <h2>User Login</h2>
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
                        echo form_open('user/login', $attributes);
                    ?>
                        <?php if (validation_errors()): ?>
                            <ul class="val_errors callout alert">
                                <?php echo validation_errors("<li>",'</li>'); ?>
                            </ul>
                        <?php endif; ?>
                        <label>Username
                            <input type="text" name="username" value="<?php echo set_value('username'); ?>" required>
                            <span class="form-error">Input a valid username</span>
                        </label>
                        <label>Password
                            <input type="password" name="password" placeholder="Enter password" required>
                            <span class="form-error">Insert a password</span>
                        </label>
                        <label>
                            <input class="button expanded" value="Log in" type="submit">
                        </label>
                    <?php echo form_close(); ?>
                </div>
            </div> 
        </div>
    </div>
</div>