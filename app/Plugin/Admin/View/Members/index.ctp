<?php
 $this->Js->JqueryEngine->jQueryObject = 'jQuery';
// Paginator options
$this->Paginator->options(array(
  'update' => '#resultDiv',
  'evalScripts' => true,
));
?>
<div id="resultDiv"> 
<div class="page-title"> <div class="title-env"> <h1 class="title"><?php echo __('Members');?></h1></div></div>
<div class="panel">
<?php echo $this->Session->flash();?>
    <div class="panel-heading">
	<div class="btn-group">
            <?php $url=$this->Html->url(array('controller'=>'Members')); echo $this->Html->link('<span class="fa fa-plus-circle"></span>&nbsp;'.__('Add New Member'),array('controller'=>'Members','action'=>'add'),array('escape'=>false,'class'=>'btn btn-success'));?>
            <?php echo $this->Html->link('<span class="fa fa-edit"></span>&nbsp;'.__('Edit'),'javascript:void(0);',array('name'=>'editallfrm','id'=>'editallfrm','onclick'=>"check_perform_edit('$url');",'escape'=>false,'class'=>'btn btn-warning'));?>
            <?php echo $this->Html->link('<span class="fa fa-trash"></span>&nbsp;'.__('Delete'),'javascript:void(0);',array('name'=>'deleteallfrm','id'=>'deleteallfrm','onclick'=>'check_perform_delete();','escape'=>false,'class'=>'btn btn-danger'));?>
	</div>
    </div>
        <?php
	$urlSearch=$this->Html->url(array('controller'=>'Members'));
	echo $this->element('pagination');
        $page_params = $this->Paginator->params();
        $limit = $page_params['limit'];
        $page = $page_params['page'];
        $serial_no = 1*$limit*($page-1)+1;?>
        <?php echo $this->Form->create(array('name'=>'deleteallfrm','action' => 'deleteall'));?>
<div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th><?php echo $this->Form->checkbox('checkbox', array('value'=>'deleteall','name'=>'selectAll','label'=>false,'id'=>'selectAll','hiddenField'=>false));?></th>
                            <th><?php echo $this->Paginator->sort('id', __('#'), array('direction' => 'desc'));?></th>
			    <th><?php echo __('Photo');?></th>
			    <th><?php echo __('Details');?></th>
			    <th><?php echo $this->Paginator->sort('name', __('Name'), array('direction' => 'asc'));?></th>
                            <?php if($luserId==1){?>
                            <th><?php echo $this->Paginator->sort('created', __('Register Date'), array('direction' => 'asc'));?></th>
                            <th><?php echo $this->Paginator->sort('status', __('Status'), array('direction' => 'asc'));?></th>
			    <?php }?>
                            <th><?php echo __('Action');?></th>                            
                        </tr>
                        <?php foreach ($Member as $post):
                        $id=$post['Member']['id'];
			if($post['Member']['photo'])
			     $memberImg='member_thumb/'.$post['Member']['photo'];
			     else
			     $memberImg='User.png';
                        ?>
                        <tr>
                            <td><?php echo $this->Form->checkbox(false,array('value' => $post['Member']['id'],'name'=>'data[Member][id][]','id'=>"DeleteCheckbox$id",'class'=>'chkselect'));?></td>
                            <td><?php echo $serial_no++; ?></td>
			    <td><?php echo$this->Html->link($this->Html->image($memberImg,array('class'=>'img-circle responsive','height'=>75,'alt' => $post['Member']['name'])),'javascript:void(0);',array('onclick'=>"show_modal('$urlSearch/View/$id');",'escape' => false));?></td>
                            <td><?php echo '<strong>'.__('Profile Id').': </strong>'.h($post['Member']['profileId']).'<br>
			    <strong>'.__('Username').': </strong>'.h($post['Member']['user_name']).'<br>
			    <strong>'.__('Email').': </strong><span ';echo($post['Member']['reg_status']=="Live") ? "style=\"background-color:#cc3f44;color:#ffffff;padding:1px;\"" : "";echo'>'.$post['Member']['email'].'</span><br>
			    <strong>'.__('Phone').': </strong>';if($post['Member']['phone']){ echo h($post['Member']['phone']);}else{ echo __('Not Specified');}?></td>
			    <td><?php if($post['Member']['name']){ echo h($post['Member']['name']);}else{ echo __('Not Specified');}?></td>
			    <?php if($luserId==1){?>
                            <td><?php echo $this->Time->format($dtFormat,h($post['Member']['created'])); ?></td>
                            <td><span class="label label-<?php if($post['Member']['status']=="Active")echo"success";elseif($post['Member']['status']=="Pending")echo"danger";else echo"default";?>"><?php echo __($post['Member']['status']); ?></span></td>
                            <?php }?>
			    <td><div class="btn-group">
			    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
			    <?php echo __('Action');?> <span class="caret"></span>
			    </button>
			    <ul class="dropdown-menu" role="menu">
			    <li><?php echo $this->Html->link('<span class="fa fa-arrows-alt"></span>&nbsp;'.__('View'),'javascript:void(0);',array('onclick'=>"show_modal('$urlSearch/View/$id');",'escape'=>false));?></li>
                            <li><?php echo $this->Html->link('<span class="fa fa-envelope fa-fw"></span>&nbsp;'.__('Send Message'),array('controller'=>'Mails','action'=>'compose','new',$id),array('escape'=>false));?></li>
                            <li><?php echo $this->Html->link('<span class="fa fa-print"></span>&nbsp;'.__('Print/Save Profile'),array('controller'=>'Searches','action'=>'viewprofile',$id),array('target'=>'_blank','escape'=>false));?></li>
                            <li><?php echo $this->Html->link('<span class="fa fa-edit"></span>&nbsp;'.__('Edit'),'javascript:void(0);',array('name'=>'editallfrm','onclick'=>"check_perform_sedit('$url','$id');",'escape'=>false));?></li>
                            <li><?php echo $this->Html->Link('<span class="fa fa-trash"></span>&nbsp;'.__('Delete'),'javascript:void(0);',array('onclick'=>"check_perform_sdelete('$id');",'escape'=>false));?></li>
			    <?php if($post['Member']['status']=="Active"){?><li><?php echo $this->Html->link('<span class="fa fa-power-off"></span>&nbsp;'.__('Deactive Profile'),array('controller'=>'Members','action'=>'deactive',$id),array('escape'=>false));?></li><?php }?>
                            </ul>
			    </div></td>
                        </tr>
                        <?php endforeach; ?>
                        <?php unset($post); ?>
                        </table>
                </div>
        <?php echo $this->Form->end();?>
	<?php echo $this->element('pagination');?>
    </div>
</div>

</div>