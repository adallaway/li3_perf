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
foreach($queries as $query)
{
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
  </tr>
  <tr>
    <td colspan="3">
      <?php echo $sql; ?>
    </td>
  </tr>
<?php
}
?>
</table>
