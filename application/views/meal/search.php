<div class="row align-center" id="search-container">
    <h4>Search meals based on any of the optional criteria below...</h4>
</div>
<div class="row align-center" id="search-form">
    <div class="column small-12">
        <?php echo form_open(); ?>
            <div class="row">
                <div class="column small-12">
                    <label>Name
                        <input name="name" type="text" placeholder="falafel, sushi..." />
                    </label>
                    <span class="help-text">*optional</span>
                </div>
            </div>
            <div class="row">
                <div class="column small-12">
                    <label>Main Ingredient
                        <input name="ingredient" type="text" placeholder="rice, potato, egg, beef..." />
                    </label>
                    <span class="help-text">*optional</span>
                </div>
            </div>
            <div class="row">
                <div class="column small-6">
                    <label>Cuisine
                        <input name="cuisine" type="text" placeholder="arabian, japanese, chinese, indian, french..." />
                    </label>
                    <span class="help-text">*optional</span>
                </div>
                <div class="column small-6">
                    <label>Maximum price
                        <div class="input-group">
                            <span class="input-group-label">AED</span>
                            <input name="price" type="number" />
                        </div>
                    </label>
                    <span class="help-text">*optional</span>
                </div>
            </div>
            <div class="row">
                <div class="column small-12">
                    <label>
                        <input class="button expanded" type="submit" value="Search" />
                    </label>
                </div>
            </div>
        <?php echo form_close(); ?>
    </div>
</div>