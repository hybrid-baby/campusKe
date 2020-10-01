<?php //include(BASE_URL . '/includes/newsletter.php'); ?>


<footer>

  <div class="search-text">
     <div class="container">
       <div class="row text-center">

         <div class="form">
             <h4>SIGN UP TO OUR NEWSLETTER</h4>
              <form id="search-form" class="form-search form-horizontal" method="post" action="<?php include(BASE_URL. '/includes/footer.php') ?>">
                  <input type="text" name="news-letter" class="input-search" placeholder="Email Address">
                  <button type="submit" class="btn-search" value= "Send">SUBMIT</button>
              </form>
          </div>

        </div>
     </div>
  </div>

 <div class="container">
   <div class="row">

            <div class="col-md-4 col-sm-6 col-xs-12">
              <span class="logo">LOGO</span>
            </div>

            <div class="col-md-4 col-sm-6 col-xs-12">
                <ul class="menu">
                     <span>Menu</span>
                     <li>
                        <a href="<?php echo BASE_URL . 'index.php' ?>">Home</a>
                      </li>

                      <li>
                         <a href="<?php echo BASE_URL . 'about.php' ?>">About</a>
                      </li>

                      <li>
                        <a href="<?php echo BASE_URL . 'contact.php' ?>">Contact</a>
                      </li>

                      <li>
                         <a href="<?php echo BASE_URL . 'news.php' ?>">News</a>
                      </li>
                 </ul>
            </div>

            <div class="col-md-4 col-sm-6 col-xs-12">
              <ul class="address">
                    <span>Contact</span>
                    <li>
                       <i class="fa fa-phone" aria-hidden="true"></i> <a href="<?php echo BASE_URL . 'contact.php' ?>">Phone</a>
                    </li>
                    <li>
                       <i class="fa fa-map-marker" aria-hidden="true"></i> <a href="<?php echo BASE_URL . 'contact.php' ?>">Adress</a>
                    </li>
                    <li>
                       <i class="fa fa-envelope" aria-hidden="true"></i> <a href="<?php echo BASE_URL . 'contact.php' ?>">Email</a>
                    </li>
               </ul>
           </div>


       </div>
       <p style="color:white">Powered by <a href="https://binarylabske.co.ke" target="_blank">binarylabske</a></p>
       <p style="color:white">CampusKe--- All time Campus blog&copy; <?php echo date('Y'); ?></p>
    </div>
</footer>

</div>
<!-- // container -->
</body>
</html>
