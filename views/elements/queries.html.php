<?php
$total_queries = count($queries);
$total_query_time = 0;
foreach($queries as $query)
{
  $total_query_time += !empty($query['explain']['millis']) ? $query['explain']['millis'] : 0;
}
?>
<h2>Queries</h2>
<p>There <?php echo ($total_queries == 1) ? 'is':'are'; ?> <span class="li3-perf-stat-value"><?=$total_queries; ?></span> quer<?php echo ($total_queries == 1) ? 'y':'ies'; ?> which took <span class="li3-perf-stat-value"><?= round($total_query_time, 2); ?>ms</span> to execute.</p>

<table>
<?php
$longest_queries = $queries;
uasort($longest_queries, function($ao, $bo)
{
  $a = floatval($ao['explain']['millis']);
  $b = floatval($bo['explain']['millis']);
  if ($a == $b) return 0;
  return ($a < $b) ? -1 : 1;
});
$longest_query_keys = array_keys(array_reverse($longest_queries, true));
$queries_count = count($queries);

$total_ms = 0;
foreach($queries as $key => $query)
{
  $total_ms += floatval($query['explain']['millis']);
}

foreach($queries as $key => $query)
{
  
  $longest_query_index = (array_search($key, $longest_query_keys) + 1);
  $longest_query_percentage = round(($query['explain']['millis'] / $total_ms) * 100, 2);
  if(isset($_GET['full']))
  {
    $sql = li3_perf\extensions\util\SqlFormatter::format($query['sql']);
  }
  else
  {
    $sql = li3_perf\extensions\util\SqlFormatter::highlight($query['sql']);
  }
?>
  <tr>
    <td>Ms: <?= round($query['explain']['millis'], 2); ?>ms</td>
    <td>Params: <?= print_r($query['params'], true); ?></td>
    <td>Types: <?= implode(', ', $query['types']); ?></td>
    <td>Time Index: <?= $longest_query_index; ?></td>
    <td>% Time: <?= $longest_query_percentage; ?>%</td>
    <td>Source: <?= $query['source']; ?></td>
  </tr>
  <tr>
    <td colspan="6">
      <?php
      if(isset($_GET['btrace']))
      {
        echo '<pre>';
        $limit = is_numeric($_GET['btrace']) ? $_GET['btrace'] : 10;
        $trace = '';
        $found_first = true;
        $skipped = 0;
        foreach($query['btrace'] as $k => $v)
        {
          if(!$found_first)
          {
            if(isset($v['file']) && stripos($v['file'], 'resources') !== false)
            {
              $found_first = true;
              $skipped = ($k - 1);
            }
            else continue;
          }
          if($k > $limit) break;
          $v['args'] = array();
          //array_walk($v['args'], function (&$item, $key) { $item = var_export($item, true);});
          $trace .= '#' . ($k - $skipped) . ' ' . @$v['file'] . '(' . @$v['line'] . '): ' . (isset($v['class']) ? $v['class'] . '->' : '') . $v['function'] . '(' . implode(', ', $v['args']) . ')' . "\n";
        }
        echo $trace;
        echo '</pre>';
      }
      ?>
      <?php echo $sql; ?>
    </td>
  </tr>
<?php
}
?>
</table>
