<!doctype html>
<html>
<head>

<meta charset="utf-8">
<meta name="viewport" content="width=960, initial-scale=1">
<meta name="robots" content="index, follow, noarchive">
<meta name="keywords" content="game, shark, reviews, gsr, games, review">

<title>Game Shark Reviews | GSR | Homepage</title>

<meta name="description" content="Welcome to GSR - Game Shark Reviews - one of the world's best online gaming hubs!">

<?php include "links.php"; ?>
</head>

<body>

    <?php include "header.php"; ?>

	<div id="featured_articles_container">
		<ul id="featured_articles"></ul>
	</div>

	<div id="page" class="container_24">

		<article class="blog">
			<section class="grid_18">
				<h1>EXCLUSIVE</h1>
				<div id="exclusive" class="owl-carousel owl-theme">

					<?php
						$exclusives = mysqli_query($con, "SELECT * FROM tbl_exclusives ORDER BY id");

						while ($exc_row = mysqli_fetch_assoc($exclusives)) {
							$exc_class	= $exc_row['class'];
							$exc_img	= $exc_row['file'];
							$exc_prim	= $exc_row['primary_desc'];
							$exc_sec	= $exc_row['secondary_desc'];
							$exc_url	= $exc_row['url'];
						?>

						<div class="item"><a href="<?php echo $exc_url; ?>" class="exclusive_item <?php echo $exc_class; ?>">
							<img src="<?php echo $exc_img; ?>">
							<span class="primary"><?php echo $exc_prim; ?></span><br>
							<span class="secondary"><?php echo $exc_sec; ?></span>
						</a></div>

					<?php } ?>
				</div>

				<h2>Latest Articles</h2>

				<ul class="article_list">
					<?php
						$art_row = array();
						
						$review_link_list = mysqli_query($con, "SELECT * FROM tbl_review WHERE alpha_approved = 'true' ORDER BY id DESC LIMIT 4");
						while ($rvw_row = mysqli_fetch_assoc($review_link_list)) {
							array_push($art_row, $rvw_row);
						}
						$opinion_link_list = mysqli_query($con, "SELECT * FROM tbl_opinion WHERE alpha_approved = 'true' ORDER BY id DESC LIMIT 4");
						while ($op_row = mysqli_fetch_assoc($opinion_link_list)) {
							array_push($art_row, $op_row);
						}
						$news_link_list = mysqli_query($con, "SELECT * FROM tbl_news WHERE alpha_approved = 'true' ORDER BY id DESC LIMIT 4");
						while ($op_row = mysqli_fetch_assoc($news_link_list)) {
							array_push($art_row, $op_row);
						}
						$guide_link_list = mysqli_query($con, "SELECT * FROM tbl_guide WHERE alpha_approved = 'true' ORDER BY id DESC LIMIT 4");
						while ($gd_row = mysqli_fetch_assoc($guide_link_list)) {
							array_push($art_row, $gd_row);
						}
					  
						usort($art_row, 'date_compare');
						$art_row = array_slice($art_row, 0, 4);
						
						foreach ($art_row as $article_row) {
							$art_name	= $article_row['title'];
							$art_game	= $article_row['gamename'];
							$art_desc	= $article_row['summary'];
							$art_rate	= $article_row['main_rating'];
							$art_file	= urlencode($article_row['a_image']);
							$art_auth	= $article_row['author'];
							$art_plat	= $article_row['platform'];
							$art_type	= $article_row['article_type'];
							if($art_type=="Guide"){
								$art_file = urlencode(unserialize($article_row['images'])[0]);
							}
							$art_date	= strtotime($article_row['createdate']);
							$art_rdat	= strtotime($article_row['release_date']);
							if($art_type=="Review"){
							$art_url	= "review.php?t=" . urlencode(str_replace(" ", "_", $art_name)) . "&g=" . urlencode(str_replace(" ", "_", $art_game));
							}
							if($art_type=="Opinion"){
							$art_url	= "opinion.php?t=" . urlencode(str_replace(" ", "_", $art_name));
							}
							if($art_type=="News"){
							$art_url	= "news.php?t=" . urlencode(str_replace(" ", "_", $art_name));
							}
							if($art_type=="Guide"){
							$art_url	= "guide.php?t=" . urlencode(str_replace(" ", "_", $art_name));
							}
						?>

							<li><a href="<?php echo $art_url; ?>" class="article_item" data-article-image="<?php echo $art_file; ?>" data-article-type="<?php echo strtolower($art_type); ?>">
								<h5><?php echo $art_name; ?></h5>
								<p><?php echo $art_desc; ?></p>
								<p class="game_details"><?php echo $art_auth; ?><span> - <?php echo date("j F Y", $art_date); ?></span></p>
								<div id="game_display">
									<div id="game_info">
										<span id="game_rating"><?php echo $art_rate; ?></span>
									</div>
								</div>
								<div id="game_type">
									<span class="game_type"><?php echo $art_type; ?></span>
								</div>
							</a></li>

						<?php } ?>

	  				<li class="review_link"><a href="articles.php" class="full grid_4">SEE MORE</a></li>
				</ul>

                <h2>Latest Videos</h2>
                <ul id="video-list">
                    <li class="video_link"><a href="videos.php" class="full grid_4">SEE MORE</a></li>
                </ul>
				
			</section>

			<aside class="articles grid_6 tall_9">
				<?php include "aside.php"; ?>
			</aside>
			
			

			<section class="grid_24">
				<h2>Highest Rated of <?php echo date("Y"); ?></h2>
				<div id="owl-demo" class="owl-carousel owl-theme">

					<?php
						$review_block_list = mysqli_query($con, "SELECT * FROM tbl_review WHERE main_rating >= '8' AND year = '" . date("Y") . "' AND alpha_approved = 'true' ORDER BY main_rating DESC LIMIT 8");
						if(mysqli_num_rows($review_block_list)<1){
						$review_block_list = mysqli_query($con, "SELECT * FROM tbl_review WHERE main_rating >= '8' AND year = '" . (date("Y")-1) . "' AND alpha_approved = 'true' ORDER BY main_rating DESC LIMIT 8");
						}
						while ($block = mysqli_fetch_assoc($review_block_list)) {
							$blk_name	= $block['title'];
							$blk_game	= $block['gamename'];
							$blk_file	= urlencode($block['a_image']);
							$blk_auth	= $block['author'];
							$blk_rate	= $block['main_rating'];
							$blk_type	= $block['article_type'];
							$blk_url	= "review.php?t=" . urlencode(str_replace(" ", "_", $blk_name)) . "&g=" . urlencode(str_replace(" ", "_", $blk_game));

						?>

						<div class="item" data-block-image="<?php echo $blk_file; ?>" data-block-type="<?php echo strtolower($blk_type); ?>"><a href="<?php echo $blk_url; ?>" class="game_block">
							<span id="block_type"><?php echo $blk_type; ?></span><br>
							<span id="block_name"><?php echo $blk_name; ?></span><br>
							<span id="block_auth"><?php echo $blk_auth; ?></span><br>
							<span id="block_rate"><?php echo $blk_rate; ?></span>
	    				</a></div>

	  				<?php } ?>
				</div>
			</section>
		</article>

	</div>

	<?php include "footer.html"; ?>

	<script type="text/javascript">
		$(function() {

			$.ajax({
				url: "zulu-run.php",
				success:function(zulu_run) {
			        $("#featured_articles").html(zulu_run);
			        alert("all good?");
			    },
			    error:function(x,y,z) {
			    	alert(z + "! " + y + "! " + z + "!");
			    }
			});



			$(".article_item").each(function() {
				$(this).children("#game_display").css("background", "url(imgs/"+$(this).attr("data-article-type")+"/" + $(this).attr("data-article-image") + ") no-repeat top right");
				$(this).children("#game_type").css("background", "url(imgs/"+$(this).attr("data-article-type")+"/" + $(this).attr("data-article-image") + ") no-repeat top left");
				$(this).children(".game_block").css("background", "url(imgs/"+$(this).attr("data-article-type")+"/" + $(this).attr("data-article-image") + ") no-repeat center center");
			});

			$(".item").each(function() {
				$(this).children(".game_block").css("background", "url(imgs/"+$(this).attr("data-block-type")+"/" + $(this).attr("data-block-image") + ") no-repeat center center");
			});
		});
	</script>

</body>
</html>