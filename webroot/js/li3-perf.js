$(document).ready(function()
{ 	
	// Show queries
	$('.li3-perf-link').click(function()
	{
	  var link_id = $(this).attr('id');
	  var area = '#li3-perf-' + link_id.replace('lp-', '');
	  if($(area).css('display') != 'none')
	  {
	    $('#li3-perf-content div').slideUp();
	    $('#li3-perf-content').slideUp();
	    $(this).removeClass('active');
	    return;
	  }
	  
	  $(this).addClass('active');
	  $('#li3-perf-content div:not(' + area + ')').slideUp();
		$(area).show();
		$('#li3-perf-content').slideDown();
		
		if(area == 'li3-perf-log')
		{
		  $.get('/li3_perf/tail', function(data)
		  {
        $('#error-log').html(data);
      });
		}
	});
});