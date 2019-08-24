
    <section id="contact">
        <div class="overlay">
            <div class="container">
                <div class="row text-center" data-scroll-reveal="enter from the bottom after 0.2s">
                    <div class="col-md-6 col-md-offset-3 pad-bottom">
                        <h2><strong>Contact Us </strong></h2>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <form role="form" id="contact-form" class="contact-form">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="text" class="form-control" name="Name" autocomplete="off" id="Name" placeholder="Name">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <input type="email" class="form-control" name="email" autocomplete="off" id="email" placeholder="E-mail">
                                        </div>
                                </div>
                                </div>
                                <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="subject" class="form-control" name="subject" autocomplete="off" id="subject" placeholder="Subject">
                                            </div>
                                        </div>
                                    </div>
                                <div class="row">
                                    <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea class="form-control textarea" rows="3" name="Message" id="Message" placeholder="Message"></textarea>
                                    </div>
                                    </div>
                                </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <button type="submit" class="btn btn-success pull-right">Send a message</button>
                                        </div>
                                    </div>
                            </form>
                        </div>
                        <div class="col-md-6">
                            <div class="row text-center" data-scroll-reveal="enter from the bottom after 0.4s">

                                    <h3><strong>Address : </strong></h3>
                                    <h4><?php echo nl2br(COMPANY_ADDRESS);?></h4>
                                    <h4><strong>Email : </strong><?php echo CONTACT_US_EMAIL_ADDRESS;?></h4>

                                    <div class="row">
                                    <div class="col-12">

                                    <br />
                                        <div class="social-media-container">
                                        <?php
                                         if(FACEBOOK_URL != "")
                                         {
                                         ?>
                                           <a href="<?php echo FACEBOOK_URL;?>">
                                                <img src="http://unioil.com/assets_site/images/unioil-thumbnail-facebook.png" class="social-media-link" alt=""></a>
                                          <?php
                                         }
                                         ?>
                                        <?php
                                         if(TWITTER_URL != "")
                                         {
                                         ?>
                                            <a href="<?php echo TWITTER_URL;?>">
                                                <img src="http://unioil.com/assets_site/images/unioil-thumbnail-twitter.png" class="social-media-link" alt=""></a>
                                        <?php
                                         }
                                         ?>   
                                         <?php
                                         if(INSTAGRAM_URL != "")
                                         {
                                         ?>
                                            <a href="<?php echo INSTAGRAM_URL;?>">
                                                <img src="http://unioil.com/assets_site/images/unioil-thumbnail-instagram.png" class="social-media-link" alt=""></a>
                                        <?php
                                         }
                                         ?>  
                                        </div>
                                    </div>
                                
                                </div>

                            </div>
                        </dv>
                        
                    </div>
                </div>

                



            </div>
        </div>
    </section>
    <!-- CONTACT SECTION END -->
    <footer>
        &copy 2018 <?php echo SITE_NAME;?>   <a href="<?php echo base_url();?>" target="_blank"><!--by <?php echo SITE_NAME;?>--></a>
    </footer>
    <!--FOOTER SECTION END  -->
    <!-- JAVASCRIPT FILES PLACED AT THE BOTTOM TO REDUCE THE LOADING TIME  -->
    <!-- CORE JQUERY  SCRIPTS -->
    <script src="<?php echo base_url()."pink/assets/";?>js/jquery-1.11.1.js"></script>
    <!-- BOOTSTRAP SCRIPTS  -->
    <script src="<?php echo base_url()."pink/assets/";?>js/bootstrap.js"></script>
    <!-- SCROLLING SCRIPTS PLUGIN  -->
    <script src="<?php echo base_url()."pink/assets/";?>js/jquery.easing.min.js"></script>
    <!--  FANCYBOX PLUGIN -->
    <script src="<?php echo base_url()."pink/assets/";?>js/source/jquery.fancybox.js"></script>
    <!-- ISOTOPE SCRIPTS -->
    <script src="<?php echo base_url()."pink/assets/";?>js/jquery.isotope.js"></script>
     <!-- SCROLL ANIMATIONS  -->
    <script src="<?php echo base_url()."pink/assets/";?>js/scrollReveal.js"></script>
    <!-- CUSTOM SCRIPTS   -->
    <script src="<?php echo base_url()."pink/assets/";?>js/custom.js"></script>

</body>
</html>