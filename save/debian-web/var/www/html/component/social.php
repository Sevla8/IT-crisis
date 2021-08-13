<div class="px-5">
	<form action="control.php" method="post">
		<textarea class="form-control" style="min-width: 100%" placeholder="Post something..." name="text-post"></textarea>
		<input class="form-control" type="submit" value="Post" name="post">
	</form>
	<?php
		require_once 'model.php';
		$posts = getPost();

		foreach ($posts as &$post) {
			include 'post.php';
			$comments = getComment($post['id']);
			foreach ($comments as &$comment) {
				include 'comment.php';
			}
		}
	?>
</div>