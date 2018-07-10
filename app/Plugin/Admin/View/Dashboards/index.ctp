<?php echo $this->Session->flash();?>
<div class="row">	
			<div class="col-md-3">
				<div class="panel panel-custom">
					<div class="panel-heading"><?php echo __('Member Statistics');?></div>
					<table class="table">
						<tr>
							<td><?php echo __('Total Members');?></td>
							<td><strong><?php echo$count;?></strong></td>
						</tr>
						<tr>
							<td><?php echo __('Total Groom');?></td>
							<td><strong><?php echo$countMale;?></strong></td>
						</tr>
						<tr>
							<td><?php echo __('Total Bride');?></td>
							<td><strong><?php echo$countFemale;?></strong></td>
						</tr>
						<tr>
							<td><?php echo __('Pending Photos');?></td>
							<td><?php echo$this->Html->link('<span class="badge">'.$pendingPhotos.'</span>',array('controller'=>'Photos'),array('escape'=>false));?></td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
					</table>
				</div>
			</div>
			<div class="col-md-9">
				<div class="panel panel-custom">
					<div class="panel-heading"><?php echo __('Recently 5 Days  Report');?></div>
					<div class="table-responsive">
					<table class="table table-striped table-bordered">
						<tr>
							<th><?php echo __('Date');?></th>
							<th><?php echo __('Amount');?></th>
						</tr>
						
						<?php  foreach($payment as $post):?>
						<tr>
							<td><?php  echo$post[0];?></td>
							<td><?php echo $currency.h($post[1]['Payment']['total']);?></td>
							
						</tr>
						<?php endforeach;?>
						<?php unset($post);?>
					</table>
					</div>					
				</div> 
			</div>
			
			
</div>

<div class="row">
			<div class="col-sm-12">
				<div class="panel panel-custom">
					<div class="panel-heading"><?php echo __('Bank Deposit (Latest 5)');?></div>
					<div class="table-responsive">
					<table class="table table-striped table-bordered">
						<tr>
							<th><?php echo __('Name');?></th>
							<th><?php echo __('Plan');?></th>
							<th><?php echo __('Date');?></th>
							<th><?php echo __('Status');?></th>
						</tr>
						
						<?php  foreach($bankDeposit as $post):?>
						<tr>
							<td><?php echo$post['Member']['name'];?></td>
							<td><?php echo$post['Plan']['name'];?></td>
							<td><?php echo $this->Time->format($dtFormat,$post['Bankdeposit']['created']);?></td>
							<td><span class="label label-<?php if($post['Bankdeposit']['status']=="Approved")echo"success";elseif($post['Bankdeposit']['status']=="Pending")echo"warning";else echo"danger";?>"><?php echo __($post['Bankdeposit']['status']); ?></span></td>
						</tr>
						<?php endforeach;?>
						<?php unset($post);?>
					</table>
					<div><?php echo$this->Html->link(__('View All'),array('controller'=>'Bankdeposits','action'=>'index'));?></div>
					</div>					
				</div> 
			</div>
			
			
			
</div>


<div class="row">
	<div class="col-md-12">
		<div class="panel panel-custom">
		<div class="panel-heading"><?php echo __('Featured Members');?></div>
			<div class="table-responsive">
			<table class="table table-striped table-bordered">
				<tr>
					<th><?php echo __('Photo');?></th>
					<th><?php echo __('Name');?></th>
					<th><?php echo __('Sex');?></th>
					<th><?php echo __('Education');?></th>
					<th><?php echo __('Occupation');?></th>
				</tr>
				<?php $url=$this->Html->url(array('controller'=>'Members'));
				foreach($members as $post):$id=$post['Dashboard']['id'];
				if($post['Dashboard']['photo'])
				$image='member_thumb/'.$post['Dashboard']['photo'];
				else
				$image='user.png';
				
				?>
				<tr>
				<td><?php echo$this->Html->link($this->Html->image($image,array('class'=>'img-circle responsive','height'=>50,'alt' => $post['Dashboard']['name'])),'javascript:void(0);',array('onclick'=>"show_modal('$url/View/$id');",'escape' => false));?></td>
				<td><?php if($post['Dashboard']['name']){ echo h($post['Dashboard']['name']);}else{echo __('Not Specified');}?></td>
				<td><?php if($post['Dashboard']['sex']){ echo h($post['Dashboard']['sex']);}else{echo __('Not Specified');}?></td>
				<td><?php if($post['Education']['name']){echo h($post['Education']['name']);}else{echo __('Not Specified');}?></td>
				<td><?php if($post['Occupation']['name']){ echo h($post['Occupation']['name']);}else{echo __('Not Specified');}?></td>
				</tr>
				<?php endforeach;?>
				<?php unset($post);?>	
					
			</table>
			</div>
		</div> 
	</div>
</div>


<div class="row">
	<div class="col-md-12">
		<div class="panel panel-custom">
		<div class="panel-heading"><?php echo __('Subsciption Plans');?></div>
			<div class="table-responsive">
			<table class="table table-striped table-bordered">
				<tr>
					<th><?php echo __('Name');?></th>
					<th><?php echo __('No of Contacts');?></th>
					<th><?php echo __('Amount');?></th>
					<th><?php echo __('Duration');?></th>
					<th><?php echo __('Description');?></th>
				</tr>
				<?php foreach($plans as $post):?>
				<tr>
				<td><?php if($post['Plan']['name']){ echo h($post['Plan']['name']);}else{echo __('Not Specified');}?></td>
				<td><?php if($post['Plan']['expiry']){echo h($post['Plan']['expiry']).' '.__('Contacts');}else{echo __('Unlimited');} ?></td>
				<td><?php if($post['Plan']['amount']){ echo $currency.h($post['Plan']['amount']);}else{echo __('Not Specified');}?></td>
				<td><?php if($post['Plan']['duration']){echo h($post['Plan']['duration']).' '.__('Months');}else{echo __('Unlimited');} ?></td>
				<td><?php if($post['Plan']['description']){ echo h($post['Plan']['description']);}else{echo __(__('Not Specified'));}?></td>
				</tr>
				<?php endforeach;?>
				<?php unset($post);?>	
					
			</table>
			</div>
		</div> 
	</div>
</div>
