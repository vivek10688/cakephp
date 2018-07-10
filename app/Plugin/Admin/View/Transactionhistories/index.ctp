<?php
 $this->Js->JqueryEngine->jQueryObject = 'jQuery';
// Paginator options
$this->Paginator->options(array(
  'update' => '#resultDiv',
  'evalScripts' => true,
));
?>
<div id="resultDiv"> 
<div class="page-title"> <div class="title-env"> <h1 class="title"><?php echo __('Transaction History');?></h1></div></div>
<div class="panel">
<?php echo $this->Session->flash();?>
    	
<?php echo $this->element('pagination');
$page_params = $this->Paginator->params();
$limit = $page_params['limit'];
$page = $page_params['page'];
$serialNo = 1*$limit*($page-1)+1;?>    
<?php echo $this->Form->create(array('name'=>'deleteallfrm','action' => 'deleteall'));?>    
    <div class="panel-body">
	<div class="table-responsive">
	    <table class="table table-striped">
			<tr>
				<th><?php echo __('#');?></th>
				<th><?php echo __('Member Name');?></th>
				<th><?php echo __('Transaction ID');?></th>
				<th><?php echo __('Plan');?></th>
				<th><?php echo __('Amount');?></th>
				<th><?php echo __('Date');?></th>
				<th><?php echo __('Type');?></th>
				<th><?php echo __('Remarks');?></th>
			</tr>
			<?php foreach($Transactionhistory as $post):?>
			<tr>
				<td><?php echo$serialNo++;?></td>
				<td><?php echo$post['Member']['name'];?></td>
				<td><?php echo$post['Transactionhistory']['transaction_id'];?></td>
				<td><?php echo$post['Plan']['name'];?></td>
				<td><?php echo$currency.$post['Transactionhistory']['amount'];?></td>
				<td><?php echo$this->Time->format($dtFormat,$post['Transactionhistory']['date']);?></td>
				<td><?php echo$post['Transactionhistory']['type'];?></td>
				<td><?php echo$post['Transactionhistory']['remarks'];?></td>
			</tr>
			<?php endforeach;unset($post);?>
			</table>
	</div>
	
	<?php echo $this->Form->end();?>	
    
    <?php echo $this->element('pagination');?>
    
</div></div>
</div>