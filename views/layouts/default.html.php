<?php
$scripts = array
(
  '/li3_perf/js/li3-perf.js?li3_perf',
  '/li3_perf/js/raphael-min.js?li3_perf',
  '/li3_perf/js/g.raphael-min.js?li3_perf',
  '/li3_perf/js/g.bar-min.js?li3_perf',
  '/li3_perf/js/g.pie-min.js?li3_perf'
);

$styles = array
(
  '/li3_perf/css/li3-perf.css?li3_perf',
  '/li3_perf/css/dump_r.css?li3_perf',
  '/li3_perf/css/ccze.css?li3_perf'
);

echo $this->html->script($scripts);
echo $this->html->style($styles);
echo $this->content();
?>