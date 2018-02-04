<!doctype html>
<html>
<head>

<meta charset="utf-8">
<meta name="viewport" content="width=960, initial-scale=1">
<meta name="robots" content="index, follow, noarchive">
<meta name="keywords" content="game, shark, reviews, gsr, games, review">

<title>Game Shark Reviews | GSR | Thankyou</title>

<meta name="description" content="Welcome to GSR - Game Shark Reviews - one of the world's best online gaming hubs!">

<?php 
	
	$user = $_SESSION['username'];
	include "links.php"; 
?>

<link rel="alternate" media="only screen and (max-width: 640px)" href="http://m.gamesharkreviews.com/">
<script type="text/javascript">
  <!--
  if (screen.width <= 800) {
    window.location = "http://m.gamesharkreviews.com/";
  }
  //-->
</script>
<script type="application/ld+json">
{
  "@context": "http://schema.org",
  "@type": "WebSite",
  "url": "http://gamesharkreviews.com/",
  "potentialAction": {
    "@type": "SearchAction",
    "target": "http://gamesharkreviews.com/search.php?q={search_term_string}",
    "query-input": "required name=search_term_string"
  }
}
</script>
</head>

<body>

	<?php 
		include "header.php"; 
		echo "<div id='page' class='container_24'><br/></br/><br/>";
		echo "<h1>Thankyou!".$user."</h1>";
	?>


	<p>
		Thankyou for your contribution, 
	</p>
	</div>
	
</body>
</html>