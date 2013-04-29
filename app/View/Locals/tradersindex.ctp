	
	
	<div class="maincontent">
		<div class="contentinner">
		
			<h3 class="widgettitle">IKTRUST Trader Details</h3>
            	<table class="table table-bordered table-hover" id="dyntable">
					<thead>
                        <tr>
                            <th class="center">User ID</th>
                            <th class="center">Name</th>
							<th class="center">Email</th>
                            <th class="center">Status</th>
							  <th class="center">Signup Date</th>
                            <th class="center">More Action</th>
                        </tr>
                    </thead>
					<?php	foreach ($locals as $locals): ?>
                    <tbody>
                        <tr class="gradeX">
                            <td class="center">
								IK<? echo str_pad($locals['User']['id'], 8, '0', STR_PAD_LEFT); ?>
							</td>
                            <td class="center">
								<? echo $locals['User']['first_name'].' '.$locals['User']['first_name']; ?>
							</td>
                            <td class="center">
								<? echo $locals['User']['email']; ?>
							</td>
							<td class="center">
								<? echo $locals['LocalStatus']['name']; ?>
							</td>
                            <td class="center">
								<? echo $locals['Local']['created']; ?>
							</td>
							<td class="center">
								<span class="icon-edit"></span>
								<?php echo $this->Html->link(__('View'), array('action' => 'adminview', $locals['Local']['id'])); ?>
								<span class="icon-edit"></span>
								<?php echo $this->Html->link(__('Edit'), array('action' => 'adminedit', $locals['Local']['id'])); ?>
								<span class="icon-edit"></span>
								<?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $locals['Local']['id']), null, __('Are you sure you want to delete # %s?', $locals['Local']['id'])); ?>
							</td>
								
                        </tr>
                    </tbody>
					<?php endforeach; ?>
                </table>	
				
				<div class="pagination pagination-small" align="right">
					<ul>
						<li class="disabled"><a href="#">&laquo;</a></li>
						<li class="active"><a href="#">1</a></li>
						<li class="active"><a href="#">2</a></li>
						<li class="active"><a href="#">3</a></li>
					</ul>
				</div>
	
		</div><!--contentinner-->
	</div><!--maincontent-->