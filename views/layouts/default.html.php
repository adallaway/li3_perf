<?php
$scripts = array
(
  '/li3_perf/js/li3-perf.js',
  '/li3_perf/js/raphael-min.js',
  '/li3_perf/js/g.raphael-min.js',
  '/li3_perf/js/g.bar-min.js',
  '/li3_perf/js/g.pie-min.js'
);

$styles = array
(
  '/li3_perf/css/li3-perf.css',
  '/li3_perf/css/dump_r.css',
  '/li3_perf/css/ccze.css'
);

/*
 * I put this fix here because Lithium can't seem to get the webroot right for libraries.
 * TODO: We need to fix that at some point. - Alex
 */

$lib_webroot = (strpos($_SERVER['REQUEST_URI'], 'lithium-testing/') != -1) ? '/lithium-testing' : '';

foreach($scripts as &$script) $script = $lib_webroot.$script;
foreach($styles as &$style) $style = $lib_webroot.$style;

echo $this->html->script($scripts);
echo $this->html->style($styles);
echo $this->content();
?>