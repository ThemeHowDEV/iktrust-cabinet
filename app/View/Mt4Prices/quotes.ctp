<?php #echo debug($quotes);die(); 

	#echo debug($check['Mt4Price']);
	#echo h($quotes['Mt4Price']['SYMBOL']);

?>

<div class="maincontent">
	<div class="contentinner">
	
		<h3 class="widgettitle nomargin shadowed">Live Quotes</h3>
			<table class="table table-striped">
			<tr>
				<th>SYMBOL</th>
				<th>BID</th>
				<th>ASK</th>
				<th>SPREAD</th>
				<th>TICK TIME (GMT+0)</th>

			</tr>
		
			
			<?php foreach ($quotes as $quote): 
			
				$cal =  $quote['Mt4Price']['ASK'] - $quote['Mt4Price']['BID']; 
				$cal_spread = number_format($cal, 5 , '.' , '');
				if($quote['Mt4Price']['DIRECTION'] == 0){ ?>
				
				<tr class="success">
					<td><?php echo str_replace(" ","%#%", $quote['Mt4Price']['SYMBOL']); ?>&nbsp;</td>
					<td><?php echo number_format($quote['Mt4Price']['BID'], 5, '.', ''); ?>&nbsp;</td>
					<td><?php echo number_format($quote['Mt4Price']['ASK'], 5, '.', ''); ?>&nbsp;</td>
					<td><?php echo h($cal_spread); ?>&nbsp;</td>
					<td><?php echo h($quote['Mt4Price']['TIME']); ?>&nbsp;</td>

				</tr>
					
			<?php }  else { ?>
			
				<tr class="error">
						<td><?php echo h($quote['Mt4Price']['SYMBOL']); ?>&nbsp;</td>
						<td><?php echo number_format($quote['Mt4Price']['BID'], 5, '.', ''); ?>&nbsp;</td>
					<td><?php echo number_format($quote['Mt4Price']['ASK'], 5, '.', ''); ?>&nbsp;</td>
						<td><?php echo h($cal_spread); ?>&nbsp;</td>
						<td><?php echo h($quote['Mt4Price']['TIME']); ?>&nbsp;</td>

					</tr>
			<?php } ?>
	
			<?php endforeach; ?>
		</table>
		
	</div>
</div>