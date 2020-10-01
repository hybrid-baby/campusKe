<?php include('config.php'); ?>
<?php include('includes/public_functions.php'); ?>
<?php include('includes/header.php'); ?>
<?php
  //get posts under a topic
  if(isset($_GET['topic'])){
    $topic_id=$_GET['topic'];
    $posts=getPublishedPostsByTopic($topic_id);
  }
 ?>
 <title>CampusKe | Home</title>
</head>
<body>
  <div class="container">
    <!-- navbar-->
    <?php include(ROOT_PATH . '/includes/navbar.php'); ?>
    <!-- navbar-->
    <!-- content -->
    <div class="content">
      <h2 class="content-title">
        <p>Your Opinion matters</p>
  Articles on <u><?php echo getTopicNameById($topic_id); ?></u>
</h2>
<hr>
<?php foreach ($posts as $post): ?>
  <div class="post" style="margin-left: 0px;">
    <img src="<?php echo BASE_URL . '/static/img/' . $post['image']; ?>" class="post_image" alt="">
    <a href="single_post.php?post-slug=<?php echo $post['slug']; ?>">
      <div class="post_info">
        <h3><?php echo $post['title'] ?></h3>
        <div class="info">
          <span><?php echo date("F j, Y ", strtotime($post["created_at"])); ?></span>
          <span class="read_more">Read more...</span>
        </div>
      </div>
    </a>
  </div>
<?php endforeach ?>
    </div>
<!-- </div> -->
  <!-- // content -->

<!-- // container -->

<!-- Footer -->
	<?php include( ROOT_PATH . '/includes/footer.php'); ?>
<!-- // Footer -->
