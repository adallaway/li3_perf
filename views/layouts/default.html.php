<?php
echo $this->html->script(array('/li3_perf/js/jquery.1.7.1.min.js', '/li3_perf/js/li3-perf.js', '/li3_perf/js/raphael-min.js', '/li3_perf/js/g.raphael-min.js', '/li3_perf/js/g.bar-min.js', '/li3_perf/js/g.pie-min.js'));
echo $this->html->style(array('/li3_perf/css/li3-perf.css', '/li3_perf/css/dump_r.css', '/li3_perf/css/ccze.css'));
echo $this->content();
?>