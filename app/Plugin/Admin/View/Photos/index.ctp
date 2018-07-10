<?php
$url=$this->Html->url(array('controller'=>'Photos')); 
?>
<div id="resultDiv"> 
<div class="page-title"> <div class="title-env"> <h1 class="title"><?php echo __('Pending Photos');?></h1></div></div>
<div class="panel">
<?php echo $this->Session->flash();?>
    <div class="panel-body">
	<div class="table-responsive">
	    <table class="table table-striped">
			<tr>
				<th><?php echo __('#');?></th>
				<th><?php echo __('Photo');?></th>
				<th><?php echo __('Profile Id');?></th>
				<th><?php echo __('Name');?></th>
				<th><?php echo __('User Details');?></th>
				<th><?php echo __('Remove');?></th>
				<th><?php echo __('Approve');?></th> 
			</tr>
			<?php $serialNo=1;foreach($memberPhoto as $post):$id=$post['Member']['id'];
			$id=$post['Member']['id'];
			if($post['Member']['photo'])
			     $memberImg='member_thumb/'.$post['Member']['photo'];
			     else
			     $memberImg='User.png';?>
			<tr>
				<td><?php echo$serialNo++;?></td>
				<td><?php echo$this->Html->image($memberImg,array('class'=>'img-circle responsive'));?></td>
				<td><?php echo h($post['Member']['profileId']);?></td>
				<td><?php echo h($post['Member']['name']);?></td>
				<td>Username: <?php echo h($post['Member']['user_name']);?><br/>
				Email: <?php echo h($post['Member']['email']);?><br/>
				Phone: <?php echo h($post['Member']['phone']);?></td>
				<td><?php echo $this->Form->postlink('<span class="fa fa-trash"></span>&nbsp;'.__('Remove'),array('controller'=>'Photos','action'=>'pdel',$id),array('confirm'=>__('Are you sure you want to delete?'),'class'=>'btn btn-danger','escape'=>false));?></td>
				<td><?php echo $this->Html->link('<span class="fa fa-edit"></span>&nbsp;'.__('Approve'),array('controller'=>'Photos','action'=>'papprovedphoto',$id),array('class'=>'btn btn-success','escape'=>false));?></td>
			</tr>
			<?php endforeach;unset($post);
			foreach($membersPhotos as $post):$id=$post['MembersPhoto']['id'];
			$id=$post['MembersPhoto']['id'];
			if($post['MembersPhoto']['photo'])
			     $memberImg='member_thumb/'.$post['MembersPhoto']['photo'];
			     else
			     $memberImg='User.png';?>
			<tr>
				<td><?php echo$serialNo++;?></td>
				<td><?php echo$this->Html->image($memberImg,array('class'=>'img-circle responsive'));?></td>
				<td><?php echo h($post['Member']['profileId']);?></td>
				<td><?php echo h($post['Member']['name']);?></td>
				<td>Username: <?php echo h($post['Member']['user_name']);?><br/>
				Email: <?php echo h($post['Member']['email']);?><br/>
				Phone: <?php echo h($post['Member']['phone']);?></td>
				<td><?php echo $this->Form->postlink('<span class="fa fa-trash"></span>&nbsp;'.__('Remove'),array('controller'=>'Photos','action'=>'del',$id),array('confirm'=>__('Are you sure you want to delete?'),'class'=>'btn btn-danger','escape'=>false));?></td>
				<td><?php echo $this->Html->link('<span class="fa fa-edit"></span>&nbsp;'.__('Approve'),array('controller'=>'Photos','action'=>'approvedphoto',$id),array('class'=>'btn btn-success','escape'=>false));?></td>
			</tr>
			<?php endforeach;unset($post);?>
			</table>
	</div>
    
</div></div>
</div>