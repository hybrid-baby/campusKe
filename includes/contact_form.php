<div class="content">
  <div="post-wrapper">
  <!-- form for simple samlpe cotent -->
   <div class="full-post-div">
     <h2><b><i>FILL THE FORM WITH WITH YOUR SAMPLE WRITEUP OR SEND ONE TO THE ADMIN VIA EMAILS</i></b></h2></br>
   </br>
   <div class="contact-form" >
     <form action="<?php  include(BASE_URL . 'includes/contact_form.php') ?>" method="POST">
       <!-- include error file to push errors -->
       <?php include(ROOT_PATH . '/includes/errors.php'); ?>
       <p>Name</p> <input type="text" name="name">
       <p>Email</p> <input type="text" name="email">
       <p>Phone</p> <input type="text" name="phone">
       <p>Sample work</p><textarea name="sample-work" rows="20" cols="50"></textarea><br />
       <input type="submit" value="Send"><input type="reset" value="Clear">
     </form>
   </div>
   </div>
  </div>
