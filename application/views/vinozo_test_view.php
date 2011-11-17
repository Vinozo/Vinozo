<?php var_dump($_SESSION); ?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Vinozo Test</title>

	
</head>
<body>

<div id="container">
	<h1>Vinozo Test</h1>

	<div id="body">
		
		<h2>Test User Interfaces</h2>
		<ul>
			<li><a href="/user/login/">Login - /user/login</a></li>
			<li><a href="/search/">Search - /search/ - TODO: Doesn't handle NULL results well</a></li>
			<li><a href="/wine/checkin/">Checkin - /wine/checkin</a></li>
		</ul>
		
		<h2></h2>Raw calls to the Vinozo API:</h2>
		<ul>
			<li><a href="/vinozo_test/userFB/5521459">/user/userFB/5521459</a></li>
			<li><a href="/vinozo_test/createCheckin/wine">/checkin/createcheckin/wine</a></li>
		</ul>
		
		
		
		<?php 
		// Show results data if exists
		
		if($data == NULL){
			$data = '';
		} else {
			echo $data; 
		}
		?>
	</div>
	<?php 
  if ($data['user']): ?>
      <a href="<?php echo $data['logoutUrl']; ?>">Logout</a>
    <?php else: ?>
      <div>
        Login using OAuth 2.0 handled by the PHP SDK:
        <a href="<?php echo $data['loginUrl']; ?>">Login with Facebook</a>
      </div>
    <?php endif ?>
	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>

</body>
</html>