
	<div class="maincontent">
		<div class="contentinner">
			<h3 class="widgettitle">Summary Deposit Transaction</h3>
            	<table class="table table-bordered table-hover" id="dyntable">
					<thead>
                        <tr>
                            <th class="center">Deposit Id</th>
                            <th class="center">Login Id</th>
							<th class="center">Transaction Type</th>
							<th class="center">Amount</th>
							<th class="center">Balance</th>
							<th class="center">Free Margin</th>
                            <th class="center">PrevMonthBalance</th>
                            <th class="center">More Action</th>
                        </tr>
                    </thead>
					<?php	foreach ($deposit as $deposit): ?>
                    <tbody>
                        <tr class="gradeX">
                            <td class="center">
								<? echo $deposit['Deposit']['id']; ?>
							</td>
							<td class="center">
								<? echo $deposit['Mt4User']['LOGIN']; ?>
							</td>
							<td class="center">
								 Bank Transfer
							</td>
							 <td class="center">
								<? echo $deposit['Deposit']['amount']; ?>
							</td>
                            <td class="center">
								<? echo $deposit['Mt4User']['BALANCE']; ?>
							</td>
                            
							<td class="center">
								<? echo $deposit['Mt4User']['MARGIN_FREE']; ?>
							</td>
							<td class="center">
								<? echo $deposit['Mt4User']['PREVMONTHBALANCE']; ?>
							</td>
							<td class="center"><span class="icon-edit"></span>
								<?php echo $this->Html->link(__('view'), array('action' => 'view_deposit', $deposit['Deposit']['id'] )); ?>
							</td>
                        </tr>
                    </tbody>
					<?php endforeach; ?>
                </table>
				<p>
					<?php
						echo $this->Paginator->counter(array(
						'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
						));
					?>
				</p>
				<div class="pagination">
				<p>
					<ul>
						<li ><?php  echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));?> </li>
						<li ><?php  echo $this->Paginator->numbers(array('separator' => ''));?></li>
						<li ><?php  echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));?></li>
					</ul>
				</p>
				<br><br>
				</div>
		</div><!--contentinner-->
	</div><!--maincontent-->