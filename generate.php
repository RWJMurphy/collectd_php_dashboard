<?php
require_once('./conf/config.php');

foreach ($config['hostnames'] as $hostname) {
    foreach ($graphs as $graph_name => $graph_config) {
        foreach ($timespans as $timespan) {
            $image_filename = $config['img_dir'] . "/" . $hostname . "/" . $graph_name . "_" . $timespan . ".png";
            $rrd_filename = $config['rrd_dir'] . "/" . $hostname . "/" . $graph_config['file'];

            $options = array_merge($graph_defaults, array(
                "--title", $graph_config['title'],
                "--start", $timespan,
            ));

            foreach ($graph_config['lines'] as $line_name => $line) {
                $line = array_merge($graph_config, $line);

                if (!array_key_exists('legend', $line)) {
                    $line['legend'] = ucwords($line_name);
                }
                if (!array_key_exists('ds', $line)) {
                    $line['ds'] = 'value';
                }
                $line_rrd_filename = $config['rrd_dir'] . "/" . $hostname . "/" . $line['file'];
                $options[] = "DEF:{$line_name}={$line_rrd_filename}:{$line['ds']}:AVERAGE";

                if (array_key_exists('area', $line) && $line['area']) {
                    $line_def = "AREA:";
                } else {
                    $line_def = "LINE{$line['width']}:";
                }
                $line_def .= "{$line_name}#{$line['color']}:{$line['legend']}";
                if (array_key_exists('stacked', $line) && $line['stacked']) {
                    $line_def .= ":STACK";
                }
                $options[] = $line_def;
            }

            $graph = rrd_graph($image_filename, $options, count($options));
            if (DEBUG) {
                var_export($options);
                echo "\n";
                var_export($graph);
                echo "\n---\n";
            }
        }
    }
}
