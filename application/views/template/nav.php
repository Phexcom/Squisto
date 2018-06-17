<div id="container">
    <div data-sticky-container>
        <div id="nav" style="color:#FFFFFF !important;" data-anchor="container" data-sticky data-margin-top="0" class="row show-for-large expanded align-center align-middle sticky">
            <div class="columns large-3">
                <ul class="menu">
                    <li><a href="<?php echo base_url('/') ?>">Home</a></li>
                    <li><a href="<?php echo base_url('meal/search') ?>">Search</a></li>
                    <li><a href="<?php echo base_url('meal') ?>">Menu</a></li>
                    
                </ul>
            </div>
            <div class="columns large-3">
                <span id="logo">Squisto Restaurant</span>
            </div>
            <div class="columns large-4">
                <ul class="menu">
                    <?php
                        $text = 'Log in';
                        $url  = 'user/login';
                        if ($this->session->has_userdata('user_id')) {
                            $text = 'Log out';
                            $url = 'user/logout';
                        } elseif ($this->session->has_userdata('admin_id')) {
                            $text = 'Log out';
                            $url = 'admin/logout';
                        }
                    ?>
                    <li><a href="<?php echo base_url($url) ?>"><?php echo $text ?></a></li>
                    <?php if(!$this->session->has_userdata('user_id')): ?>
                        <li><a href="<?php echo base_url('user/register') ?>">Sign Up</a></li>
                    <?php else: ?>

                        <li>
                            <a id="cart" href="<?php echo base_url('meal/cart') ?>">
                            Cart[<?php echo count($this->session->cart); ?>]
                            </a>
                        </li>
                        <li><a href="<?php echo base_url('user'); ?>">Account</a></li>
                        

                    <?php endif; ?>

                </ul>
            </div>
        </div>

        <div class="hide-for-large sticky" data-sticky data-anchor="container" data-margin-top="0" style="width:100%">
            <div class="title-bar" data-hide-for="large" data-responsive-toggle="mobile-menu">
                <button class="menu-icon" type="button" data-toggle></button>
                <div class="title-bar-title">Squisto</div>
            </div>
            <div class="top-bar" id="mobile-menu">
                <ul class="menu text-center expanded vertical">
                    <li><a href="<?php echo base_url('/') ?>">Home</a></li>
                    <li><a href="<?php echo base_url('meal/search') ?>">Search</a></li>
                    <li><a href="<?php echo base_url('meal') ?>">Menu</a></li>
                    <li><a href="<?php echo base_url($url);?>"><?php echo $text;?></a></li>
                    <?php if(!$this->session->has_userdata('user_id')): ?>
                        <li><a href="<?php echo base_url('user/register') ?>">Sign Up</a></li>
                    <?php else: ?>
                        <li>
                            <a id="cart" href="<?php echo base_url('meal/cart') ?>">
                            Cart[<?php echo count($this->session->cart); ?>]
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>  
    </div>