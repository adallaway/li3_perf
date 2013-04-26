<div id="li3-perf-toolbar">
	<div id="li3-perf-toolbar-content-wrapper">
	
		Execution Time: <?= number_format($timers['complete_load'], 2) . 's'; ?>

		Mem. Usage: <?= $this->li3perf->byteSize(memory_get_usage(true)) . ' / ' . ini_get('memory_limit'); ?>

		<div id="li3-perf-toolbar-links">
		  <a href="#" id="lp-queries" class="li3-perf-link">Queries</a>
		  <a href="#" id="lp-perf-graph" class="li3-perf-link">Graph</a>
		  <a href="#" id="lp-timing" class="li3-perf-link">Time</a>
		  <a href="#" id="lp-variables" class="li3-perf-link">Vars</a>
		  <a href="#" id="lp-log" class="li3-perf-link">Log</a>
		  <a href="#" id="lp-minimize" class="li3-perf-link">[ X ]</a>
		</div>
		
		<div id="li3-perf-content">
			<div id="li3-perf-queries">
				<?php
				echo $this->view()->render('all', 
					array(
						'queries' => $queries
					), 
					array(
						'library' => 'li3_perf',
						'template' => 'queries',
						'layout' => 'empty'
				));
				?>
			</div>
			
			<div id="li3-perf-graph">
				<?php
				echo $this->view()->render('all', 
					array(
						'timers' => $timers
					), 
					array(
						'library' => 'li3_perf',
						'template' => 'perf_graph',
						'layout' => 'empty'
				));
				?>
			</div>
			
			<div id="li3-perf-timing">
				<?php
				echo $this->view()->render('all', 
					array(
						'timers' => $timers
					), 
					array(
						'library' => 'li3_perf',
						'template' => 'timers',
						'layout' => 'empty'
				));
				?>
			</div>
			
			<div id="li3-perf-vars">
				<?php
				echo $this->view()->render('all', 
					array(
						'vars' => $vars
					), 
					array(
						'library' => 'li3_perf',
						'template' => 'variables',
						'layout' => 'empty'
				));
				?>
			</div>
			
			<div id="li3-perf-log">
				<h2>Application Log</h2>
				<div id="error-log"></div>
			</div>
		</div>
	</div>
</div>
<?php
	//var_dump($timers);
?>