<?php
 //return all published posts with their topic
 function getPublishedPosts(){
   global $conn;
   $sql = "SELECT * FROM posts WHERE published=true";
   $result = mysqli_query($conn,$sql);
   //fetch all the posts in an associative array
   $posts = mysqli_fetch_all($result,MYSQLI_ASSOC );
   $final_posts = array();
   foreach ($posts as $post){
     $post['topic'] = getPostTopic($post['id']);
     array_push($final_posts,$post);
   }
   return $final_posts;
 }

 //get the posts topic using its id
 function getPostTopic($post_id){
   global $conn;
   $sql = "SELECT * FROM topics WHERE id=
           (SELECT topic_id FROM post_topic WHERE post_id=$post_id) LIMIT 1";
   $result = mysqli_query($conn,$sql);
   $topic = mysqli_fetch_assoc($result);
   return $topic;
 }

 //geting published posts by topic
 function getPublishedPostsByTopic($topic_id){
   global $conn;
   $sql = "SELECT * FROM posts ps WHERE ps.id IN
            (SELECT pt.post_id FROM post_topic pt
              WHERE pt.topic_id = $topic_id GROUP BY pt.post_id HAVING COUNT(1)=1)";

    $result = mysqli_query($conn,$sql);
    $posts = mysqli_fetch_all($result,MYSQLI_ASSOC);
    $final_posts = array();
    foreach($posts as $post){
      $post['topic'] = getPostTopic($post['id']);
      array_push($final_posts,$post);
    }
    return $final_posts;
 }

 //get topic name by id
 function getTopicNameById($id){
   global $conn;
   $sql = "SELECT name FROM topics WHERE id=$id";
   $result = mysqli_query($conn,$sql);
   $topic = mysqli_fetch_assoc($result);
   return $topic['name'];
 }

//Returns a single post
function getPost($slug){
	global $conn;
	// Get single post slug
	$post_slug = $_GET['post-slug'];
	$sql = "SELECT * FROM posts WHERE slug='$post_slug' AND published=true";
	$result = mysqli_query($conn, $sql);
	$post = mysqli_fetch_assoc($result);
	if ($post) {
		$post['topic'] = getPostTopic($post['id']);
	}
	return $post;
}

//Return all topics
function getAllTopics()
{
	global $conn;
	$sql = "SELECT * FROM topics";
	$result = mysqli_query($conn, $sql);
	$topics = mysqli_fetch_all($result, MYSQLI_ASSOC);
	return $topics;
}
 ?>
