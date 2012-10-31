<?php
define('DEBUG', False);

$config = array( 
    "img_dir" => "images",
    "rrd_dir" => "/var/lib/collectd",
    "hostnames" => array("server.example.com"),
    # web interface
    "refresh_minutes" => 1,
);

$graph_defaults = array(
    "--start", "-1hour",
    "--end", "now",
    "--width", "600",
    "--height", "400",
    "--full-size-mode",
    "--slope-mode",
);

$graphs = array(
    "load" => array(
        "title" => "System Load",
        "file" => "load/load.rrd",
        "width" => 1,
        "lines" => array(
            "shortterm" => array(
                "legend" => "Shortterm Load",
                "ds" => "shortterm",
                "color" => "FFFF00",
            ),
            "midterm" => array(
                "legend" => "Midterm Load",
                "ds" => "midterm",
                "color" => "FF8800",
            ),
            "longterm" => array(
                "legend" => "Longterm Load",
                "ds" => "longterm",
                "color" => "FF0000",
            ),
        )
    ),
    "interface" => array(
        "title" => "Network Traffic",
        "file" => "interface/if_octets-eth0.rrd",
        "width" => 1,
        "lines" => array(
            "tx" => array(
                "ds" => "tx",
                "legend" => "Transmitted",
                "color" => "00FF00",
            ),
            "rx" => array(
                "ds" => "rx",
                "legend" => "Received",
                "color" => "0000FF",
            ),
        ),
    ),
    "memory" => array(
        "title" => "Memory Usage",
        "stacked" => True,
        "area" => True,
        "file" => "",
        "lines" => array(
            "used" => array(
                "file" => "memory/memory-used.rrd",
                "color" => "FF0000",
            ),
            "cached" => array(
                "file" => "memory/memory-cached.rrd",
                "color" => "0000FF",
            ),
            "buffered" => array(
                "file" => "memory/memory-buffered.rrd",
                "color" => "880088",
            ),
            "free" => array(
                "file" => "memory/memory-free.rrd",
                "color" => "00FF00",
            ),
        ),
    ),
    "swap" => array(
        "title" => "Swap Usage",
        "stacked" => True,
        "area" => True,
        "file" => "",
        "lines" => array(
            "used" => array(
                "file" => "swap/swap-used.rrd",
                "color" => "FF0000",
            ),
            "cached" => array(
                "file" => "swap/swap-cached.rrd",
                "color" => "0000FF",
            ),
            "free" => array(
                "file" => "swap/swap-free.rrd",
                "color" => "00FF00",
            ),
        ),
    ),
    "df" => array(
        "title" => "Disk Usage",
        "stacked" => "True",
        "area" => True,
        "file" => "df/df-root.rrd",
        "lines" => array(
            "used" => array(
                "ds" => "used",
                "color" => "FF0000",
            ),
            "free" => array(
                "ds" => "free",
                "color" => "00FF00",
            ),
        ),
    ),
);
