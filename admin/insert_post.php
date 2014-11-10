<DOCTYPE HTML>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title></title>
<script src="//tinymce.cachefly.net/4.0/tinymce.min.js"></script>
<script>
	tinymce.init({selector:'textarea'});
</script>

<style type="text/css">
td, tr {padding:0px; margin:0px;}

</style>
</head>

<body bgcolor="#AD6519">
	<form action="insert_post.php" method="post" enctype="multipart/form-data">
		
		<table width="800" align="center" border="2">
			
			<tr bgcolor="#FF6600">
				<td colspan="6" align="center"><h1>Insert New Post:</h1></td>
			</tr>
			
			<tr>
				<td align="center" bgcolor="#E9B15C"><strong>Post Title:</strong></td>
				<td bgcolor="#E9B15C"><input type="text" name="post_title" size="60"/></td>
			</tr>
			
			<tr>
				<td align="center" bgcolor="#E9B15C"><strong>Post Category:</strong></td>
				<td bgcolor="#E9B15C">
				<select name="cat">
					<option value="null">Select a Category</option>
					<?php
			include("includes/database.php");
			
			$getCats = "select * from categories";
			
			$runCats = mysql_query($getCats);
			
			while ($catsRow=mysql_fetch_array($runCats)) {
				$cat_id=$catsRow['cat_id'];
				$cat_title=$catsRow['cat_title'];
				
				echo "<option value='$cat_id'>$cat_title</option>";
			}
		?>
				</select>
				
				</td>
			</tr>
			
			<tr>
				<td align="center" bgcolor="#E9B15C"><strong>Post Author:</strong></td>
				<td bgcolor="#E9B15C"><input type="text" name="post_author" size="60"/></td>
			</tr>
			
			<tr>
				<td align="center" bgcolor="#E9B15C"><strong>Post Keywords:</strong></td>
				<td bgcolor="#E9B15C"><input type="text" name="post_keyword" size="60"/></td>
			</tr>
			
			<tr>
				<td align="center" bgcolor="#E9B15C"><strong>Post Image:</strong></td>
				<td bgcolor="#E9B15C"><input type="file" name="post_image" size="50" /></td>
			</tr>
			
			<tr>
				<td align="center" bgcolor="#E9B15C"><strong>Post Content:</strong></td>
				<td bgcolor="#E9B15C"><textarea name="post_content" rows="15" cols="40"></textarea></td>
			</tr>
			
			<tr>
				<td align="center" bgcolor="#E9B15C"><strong>Post Summary:</strong></td>
				<td bgcolor="#E9B15C"><textarea name="post_summary" rows="15" cols="40"></textarea></td>
			</tr>
			
			<tr bgcolor="#E9B15C">
				<td colspan="6" align="center"><input type="submit" name="submit" value="Publish Now"/></td>
			</tr>
		</table>
		
	</form>
	
</body>
</html>

<?php
if(isset($_POST['submit'])) {

	$post_title = $_POST['post_title'];
	$post_date = date('d-m-y');
	$post_cat = $_POST['cat'];
	$post_author = $_POST['post_author'];
	$post_keyword = $_POST['post_keyword'];
	$post_image = $_FILES['post_image']['name'];
	$post_image_tmp = $_FILES['post_image']['tmp_name'];
	$post_content = addslashes($_POST['post_content']);
	$post_summary = addslashes($_POST['post_summary']);

	if($post_title=='' OR $post_cat=='null' OR $post_author=='' OR $post_keyword=='' OR $post_image=='' OR $post_content=='' OR $post_summary==''){
	
		echo "<script>alert('tidak ada yang boleh kosong')</script>";
		exit();
	} else {
	
		move_uploaded_file($post_image_tmp, "news_images/$post_image");
		
		$insert_post = "insert into post (category_id,post_title,post_date,post_author,post_keyword,post_image,post_content,post_summary) values 
						('$post_cat','$post_title','$post_date','$post_author','$post_keyword','$post_image','$post_content','$post_summary')";
	
	$run_posts = mysql_query($insert_post);
	//var_dump($run_post);
	if($run_posts){
	
		echo "<script>alert('Post berhasil di Publish!')</script>";
		
		echo "<script>window.open('insert_post.php', '_self')</script>";
	
		}
	
	}
		

}

?>