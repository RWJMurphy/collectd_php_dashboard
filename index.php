<?php require_once('./conf/config.php'); ?>
<!doctype html>
<title>status</title>
<script> window.setTimeout(function() { window.location.reload(); },<?php echo $config['refresh_minutes']*60000; ?>); </script>
<?php foreach ($config['hostnames'] as $hostname): ?>
<h1><?php echo $hostname; ?></h1>
    <?php foreach ($graphs as $graphname => $graphconfig): ?>
        <img src="<?php echo $config['img_dir'] . "/" . $hostname . "/" . $graphname . ".png"; ?>" />
    <?php endforeach; ?>
<?php endforeach; ?>
