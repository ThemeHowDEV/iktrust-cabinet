		
		<div class="maincontent"><!--maincontent open--> 
			<div class="contentinner"><!--contentinner open-->	
			<?php echo $this->element('newsticker'); ?>
				<!--FIRST TTLE/HEADER-->
				<br>
				<div class="row-fluid">
					<div class="span12">
						<h3 class="widgettitle nomargin">Bank Details</h3>
						<p>
						<div class="row-fluid">
							<div class="span12 well">
								<?php echo $this->Form->create('Deposit', array('type' => '', 'id'=>'' , 'class' => 'stdform')); ?>
									<p>
										<label>IK Trust Bank : </label>
										<?php echo $this->Form->input('ikbank_id' ,array('label' => false, 'div' => false, 'empty'=>'select' )); ?>
									</p>
									<p>
										<label>Currency : </label>
										<?php echo $this->Form->input('ecurr_id' ,array('label' => false, 'div' => false, 'empty'=>'select' )); ?>
									</p>
									<p>
										<label>Deposit Amount : </label>
										<?php echo $this->Form->input('amount' ,array('label' => false, 'div' => false, 'class'=>'input-xlarge' )); ?>
									</p>
									<p>
										<label>Bank Name  : </label>
										<?php echo $this->Form->input('userbank' ,array('label' => false, 'div' => false, 'class'=>'input-xlarge' )); ?>
									</p>
									<p>
										<label>Name : </label>
										<?php echo $this->Form->input('name' ,array( 'disable' => 'disable' ,'label' => false, 'div' => false, 'class'=>'input-xlarge' , 'value' => $mt4user['Mt4User']['NAME'])); ?>
									</p>
									<p>
										<label>email  : </label>
										<?php echo $this->Form->input('email' ,array( 'disable' => 'disable' ,'label' => false, 'div' => false, 'class'=>'input-xlarge' , 'value' => $mt4user['Mt4User']['EMAIL'])); ?>
									</p>
										<?php echo $this->Form->input('user_id' ,array( 'type' => 'hidden' ,'label' => false, 'div' => false, 'class'=>'input-xlarge' , 'value' => $user_id)); ?>
										<?php echo $this->Form->input('mt4_user_LOGIN' ,array( 'type' => 'hidden' ,'label' => false, 'div' => false, 'class'=>'input-xlarge' , 'value' => $mt4user['Mt4User']['LOGIN'])); ?>
									<?php echo $this->Form->Submit(__('Submit'), array('class'=>'btn btn-danger span2'));?>
							</div>
						</div>
						</p>
					</div>
				</div>
					<?php echo $this->Form->end(); ?>
			</div><!--contentinner close-->
		</div><!--mainconten closet-->