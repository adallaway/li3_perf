$(document).ready(function()
{ 	
	// Show queries
	$('.li3-perf-link').click(function()
	{
	  var link_id = $(this).attr('id');
	  var area = '#li3-perf-' + link_id.replace('lp-', '');
	  if($(area).css('display') != 'none')
	  {
	    $('#li3-perf-content > div').slideUp();
	    $('#li3-perf-content').slideUp();
	    $(this).removeClass('active');
	    return;
	  }
	  
	  $('.li3-perf-link').removeClass('active');
	  $(this).addClass('active');
	  $('#li3-perf-content > div:not(' + area + ')').slideUp(function()
	  {
	    $(area).slideDown();
      $('#li3-perf-content').slideDown();
	  });
		
		if(area == 'li3-perf-log')
		{
		  li3_perf_getErrorLog();
		}
	});
});

function li3_perf_getErrorLog()
{
  $.get('/li3_perf/tail', function(data)
  {
    $('#li3-perf-log-output').html(data);
  });
}
