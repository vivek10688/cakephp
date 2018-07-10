<?php
 $this->Js->JqueryEngine->jQueryObject = 'jQuery';
// Paginator options
$this->Paginator->options(array(
  'update' => '#resultDiv',
  'evalScripts' => true,
));
$url=$this->Html->url(array('controller'=>'Bankdeposits')); 
?>
<div id="resultDiv"> 
<div class="page-title"> <div class="title-env"> <h1 class="title"><?php echo __('Bank Deposit');?></h1></div></div>
<div class="panel">
<?php echo $this->Session->flash();?>
    	
<?php echo $this->element('pagination');
$page_params = $this->Paginator->params();
$limit = $page_params['limit'];
$page = $page_params['page'];
$serialNo = 1*$limit*($page-1)+1;?>    
    <div class="panel-body">
	<div class="table-responsive">
	    <table class="table table-striped">
			<tr>
				<th><?php echo __('#');?></th>
				<th><?php echo __('Name');?></th>
				<th><?php echo __('User Name');?></th>
				<th><?php echo __('Email');?></th>
				<th><?php echo __('Plan');?></th>				
				<th><?php echo __('Amount');?></th>
				<th><?php echo __('Transaction ID');?></th>
				<th><?php echo __('Date');?></th>
				<th><?php echo __('Status');?></th>
				 <th><?php echo __('Action');?></th> 
			</tr>
			<?php foreach($Bankdeposit as $post):$id=$post['Bankdeposit']['id'];?>
			<tr>
				<td><?php echo$serialNo++;?></td>
				<td><?php echo$post['Member']['name'];?></td>
				<td><?php echo$post['Member']['user_name'];?></td>
				<td><?php echo$post['Member']['email'];?></td>
				<td><?php echo$post['Plan']['name'];?></td>								
				<td><?php echo$currency.$post['Plan']['amount'];?></td>
				<td><?php echo$post['Bankdeposit']['transaction_id'];?></td>
				<td><?php echo$this->Time->format($dtFormat,$post['Bankdeposit']['created']);?></td>
				<td><span class="label label-<?php if($post['Bankdeposit']['status']=="Approved")echo"success";elseif($post['Bankdeposit']['status']=="Pending")echo"warning";else echo"danger";?>"><?php echo __($post['Bankdeposit']['status']); ?></span></td>
				<td><div class="btn-group">
				<button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
				<?php echo __('Action');?> <span class="caret"></span>
				</button>
				<ul class="dropdown-menu" role="menu">
				<li><?php echo $this->Html->link('<span class="fa fa-arrows-alt"></span>&nbsp;'.__('View'),'javascript:void(0);',array('onclick'=>"show_modal('$url/edit/$id');",'escape'=>false));?></li>
				<li><?php echo $this->Form->postLink('<span class="fa fa-trash"></span>&nbsp;'.__('Delete'),array('action' => 'delete', $id),array('confirm' => __('Do you want to delete selected record'),'escape'=>false));?></li>
				</ul>
				</div></td>
			</tr>
			<?php endforeach;unset($post);?>
			</table>
	</div>
    <?php echo $this->element('pagination');?>
    
</div></div>
</div>