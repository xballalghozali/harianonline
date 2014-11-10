<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title>Harian Online</title>
<link rel="stylesheet" href="styles/style.css" media="all" />
</head>

<body>
<div class="container">

  <div class="head">
		<img src='images/logoheader.jpg' />	
     </div>
	<div class="navbar">
			<ul id="menu">
		<?php
			include("includes/database.php");
			
			$getCats = "select * from categories";
			
			$runCats = mysql_query($getCats);
			
			while ($catsRow=mysql_fetch_array($runCats)) {
				$cat_id=$catsRow['cat_id'];
				$cat_title=$catsRow['cat_title'];
				
				echo "<li><a href='index.php?cat=$cat_id'>$cat_title</a></li>";
			}
		?>
			</ul>
			
			<div id="form">
				<form method="get" action="result.php" enctype="multipart/form-data">
					<input type="text" name="search_query"/>
					<input type="submit" name="search" value="Search"/>
				</form>
			</div>
     </div>
	
     
		<div class="post_area">
        	<?php
			
				$get_posts = "select * from post order by rand() LIMIT 0,5";
				
				$run_posts = mysql_query($get_posts);
				
				while ($row_posts = mysql_fetch_array($run_posts)) {
				
					$post_id = $row_posts['post_id'];
					$post_title = $row_posts['post_title'];
					$post_date = $row_posts['post_date'];
					$post_author = $row_posts['post_author'];
					$post_image = $row_posts['post_image'];
					$post_content = $row_posts['post_content'];
					$post_summary = $row_posts['post_summary'];
				
					echo "
					
						<h2 class=\"post-title\">$post_title</h2>
						
						<span>$post_author</span> <span>$post_date</span>
						
						<img class=\"post-image\" src='admin/news_images/$post_image' width='100' height='100' />
						
						<div>$post_summary</div>
						
					";
				}
			?>
        </div>
        
		<div class="sidebar"> 
        	<?php
			
				$get_posts = "select * from post order by 1 DESC LIMIT 0,5";
				
				$run_posts = mysql_query($get_posts);
				
				while ($row_posts = mysql_fetch_array($run_posts)) {
				
					$post_id = $row_posts['post_id'];
					$post_title = $row_posts['post_title'];
				
					$post_image = $row_posts['post_image'];
					$post_content = $row_posts['post_content'];
					$post_summary = $row_posts['post_summary'];
				
					echo "
					
						<h2 class=\"post-title\">$post_title</h2>
						
						<span>$post_author</span> <span>$post_date</span>
						<img class=\"post-image\" src='admin/news_images/$post_image' width='100' height='100'/>
						
						<div>$post_summary</div>
						
					";
				}
			?>
        </div>
        
		<div id="footer" class="center">
			<ul>
				<li><a href="#">Home</a></li>
				<li><a href="#">Products</a></li>
				<li><a href="#">About</a></li>
				<li><a href="#">Contact Us</a></li>
				<li><a href="#">FAQ</a></li>
			</ul>
					<p class="copyright">Copyright &copy; 2014. Company Name. All Rights Reserved</p>
		</div>
	</div>
</body>


</html>