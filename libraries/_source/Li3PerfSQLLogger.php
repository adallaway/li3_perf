<?php
namespace li3_perf\libraries\_source;

use Doctrine\DBAL\Logging\SQLLogger;
use li3_perf\extensions\util\Data;

class Li3PerfSQLLogger implements SQLLogger
{
	protected $query;
	protected $start;

	public function startQuery($sql, array $params = null, array $types = null)
	{
	  $btrace = debug_backtrace();
		$this->start = microtime(true);
		$this->query = compact('sql', 'params', 'types', 'btrace');
	}

	public function stopQuery()
	{
		$ellapsed = (microtime(true) - $this->start) * 1000;
    $query = array
    (
      'time' => $this->start,
      'explain' => array('millis' => $ellapsed),
      'source' => 'foobar'
    );
    $query = array_merge($query, $this->query);
		Data::append('queries', array($query));
	}
}
?>