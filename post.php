<?php include "includes/db.php"; ?>
<?php include "includes/header.php"; ?>

    
    <!-- Navigation -->
   
    <?php include "includes/navigation.php"; ?> 
    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            
            <div class="col-md-8">

            <?php

                if(isset($_GET['p_id'])){
                   
                   $post_id = $_GET['p_id']; 
                
                $view_query ="UPDATE posts SET post_views_count = post_views_count +1 WHERE post_id = $post_id ";
                $send_query = mysqli_query($connection,$view_query);
                
                if(!$send_query){
                    die('QUERY FAILED'. mysqli_error($connection));
                }

                if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin'){
                    $query = "SELECT * FROM posts WHERE post_id ='$post_id'";
                }else{
                    $query = "SELECT * FROM posts WHERE post_id ='$post_id' AND post_status ='published'";
                }

                //$query = "SELECT * FROM posts WHERE post_id ='$post_id'";
                $select_all_posts_query = mysqli_query($connection,$query);
                  if(mysqli_num_rows($select_all_posts_query)<1){
                   echo "<h1 class= 'text-center'>No posts Available</h1>";
                } else{ 
                    while($row = mysqli_fetch_assoc($select_all_posts_query)){
                        $post_title = $row['post_title'];
                        $post_author = $row['post_author'];
                        $post_date = $row['post_date'];
                        $post_image = $row['post_image'];
                        $post_content= $row['post_content'];


                        ?>
                
                <!-- <h1 class="page-header">
                          Page Heading
                          <small>Secondary Text</small>
                </h1> -->
                <h1 class="page-header">
                          Posts
                          
                </h1>

                <!-- First Blog Post -->
                <h2>
                    <a href="#"><?php echo $post_title; ?></a>
                </h2>
                <p class="lead">
                    by <a href="index.php"><?php echo $post_author; ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span> <?php echo $post_date; ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image;  ?>" alt="">
                <hr>
                <p><?php echo $post_content; ?></p>
                
                <hr>

                

                    
                <?php } }}else{
                    header("Location: index.php");
                    }
                    ?>

            
                <!-- Blog Comments -->
                
                <?php
                   
                   if(isset($_POST['create_comment'])){

                   $the_post_id = $_GET['p_id']; 

                   $comment_author = $_POST['comment_author'];
                   $comment_email = $_POST['comment_email'];
                   $comment_content =$_POST['comment_content'];

                   $query ="INSERT INTO comments (comment_post_id,comment_author,comment_email,comment_content, comment_status,comment_date) ";
                   $query .=" VALUES ($the_post_id,'{$comment_author}','{$comment_email}','{$comment_content}', 'unapproved',now())";
                   
                   
                // $query=" INSERT INTO `comments`(`comment_post_id`, `comment_author`, `comment_email`, `comment_content`, `comment_status`, `comment_date`) VALUES ('$the_post_id','[$comment_author]','[$comment_email]',
                // '[$comment_content]','unapproved','now()')";
                $create_comment_query =mysqli_query($connection,$query);

                   if(!$create_comment_query){
                       die('QUERY FAILED'. mysqli_error($connection));
                   }

                   
                }
                ?>
                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <form action= "" method="post" role="form">
                        
                        <div class="form-group">
                            <label for="Author">Author</label>
                            <input type="text" name="comment_author" 
                            class="form-control" >    
                        </div>

                        <div class="form-group">
                            <label for="Author">Email</label>
                            <input type="email" name="comment_email" class="form-control">    
                        </div>

                        <div class="form-group">
                            <label for="comment">Your Comment</label>
                            <textarea name= "comment_content" class="form-control" ></textarea>   
                        </div>
                     
                       <button type="submit" name="create_comment" class="btn btn-primary">Submit</button>
                   
                    </form>
                </div>

                <hr>
                <!-- Posted Comments -->
                </div>
        <!-- /.row -->

       

            <!-- Blog Sidebar Widgets Column -->

            <?php //include "includes/sidebar.php"; ?>    

        
<?php include "includes/footer.php"; ?>