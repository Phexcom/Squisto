    </div>
    <footer>

        <div class="row align-justify text-center medium-text-left">
            <div class="columns small-12 medium-4">
                <span href="<?php echo(base_url());?>" class="small"  font-family:ubuntu;">&copy; 2018 Squisto Restaurant by Ralph Otutu</span>
                <!-- <span class="small">&copy; 2018 Squisto Restaurant</span> -->

            </div>

                <span><a href="mailto:?from=admin@Squisto.com&subject=Squisto Newsletter&body= We at Squisto Curate the best Meal with great pricing an deliver to you email">Subscribe to our newsletter</a></span>
            <div class="columns small-12 medium-4">

                <ul>
                
              <li><a href="http://facebook.com/"><i class="fa fa-facebook"></i></a></li>
              <li><a href="http://linkedin.com/"><i class="fa fa-linkedin"></i></a></li>
              <li><a href="http://twitter.com/"><i class="fa fa-twitter"></i></a></li>
              <li><a href="http://plus.google.com/"><i class="fa fa-google-plus"></i> </a></li>

              <li><a href="<?php echo base_url('contactus') ?>">Contact us</a></li>
            </ul>
            
            </div>
        </div>
    </footer>
        
    <script src="<?php echo(asset_url());?>js/vendor/jquery.min.js"></script>
    <script src="<?php echo(asset_url());?>js/vendor/jquery-ui.min.js"></script>
    <script src="<?php echo(asset_url());?>js/vendor/what-input.min.js"></script>
    <script src="<?php echo(asset_url());?>js/foundation.min.js"></script>
    <script src="<?php echo(asset_url());?>js/app.js"></script>

    <script>
      // execute/clear BS loaders for docs
      $(function(){
        if (window.BS&&window.BS.loader&&window.BS.loader.length) {
          while(BS.loader.length){(BS.loader.pop())()}
        }
      })

    document.getElementById("files").onchange = function () {
      var reader = new FileReader();

      reader.onload = function (e) {
          // get loaded data and render thumbnail.
          document.getElementById("image").src = e.target.result;
      };

      // read the image file as a data URL.
      reader.readAsDataURL(this.files[0]);
    };
</body>
</html>