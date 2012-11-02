<?php require_once('./conf/config.php');
$timespan = isset($_REQUEST['ts']) ? $_REQUEST['ts'] : $config['default_timespan'];
?>
<!doctype html>
<title>status</title>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script>
$(function(){
    window.setTimeout(
        function() {
            $("img.graph").each(function(){
                this.src = this.src.replace("/\?__ts=\d*/", "") + "?__ts=" + new Date().getTime();
            });
        },
        <?php echo $config['refresh_minutes']*60000; ?>
    );
});
</script>
<style type="text/css">
ul#menu {
    list-style: none;
    margin: 0;
}

ul#menu li {
    display: inline;
    padding-left: 1em;
}
</style>
<ul id="menu">
<?php foreach($timespans as $t): ?>
    <li><a href="?ts=<?php echo $t; ?>"><?php echo $t; ?></a></li>
<?php endforeach; ?>
</ul>
<?php foreach ($config['hostnames'] as $hostname): ?>
<h1><?php echo $hostname; ?></h1>
    <?php foreach ($graphs as $graphname => $graphconfig): ?>
        <img class="graph" alt="<?php echo $graphname; ?>" src="<?php echo $config['img_dir'] . "/" . $hostname . "/" . $graphname . "_" . $timespan . ".png"; ?>" />
    <?php endforeach; ?>
<?php endforeach; ?>
