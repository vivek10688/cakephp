<?php
 $this->Js->JqueryEngine->jQueryObject = 'jQuery';
// Paginator options
$this->Paginator->options(array(
  'update' => '#resultDiv',
  'evalScripts' => true,
));
?>
<div id="resultDiv"> 
<div class="page-title"> <div class="title-env"> <h1 class="title"><?php echo __('Testimonials');?></h1></div></div>
<div class="panel">
<?php echo $this->Session->flash();?>
    <div class="panel-heading">
	<div class="btn-group">
            <?php $url=$this->Html->url(array('controller'=>'Testimonials')); echo $this->Html->link('<span class="fa fa-plus-circle"></span>&nbsp;'.__('Add New Testimonial'),array('controller'=>'Testimonials','action'=>'add'),array('escape'=>false,'class'=>'btn btn-success'));?>
            <?php echo $this->Html->link('<span class="fa fa-edit"></span>&nbsp;'.__('Edit'),'javascript:void(0);',array('name'=>'editallfrm','id'=>'editallfrm','onclick'=>"check_perform_edit('$url','testimonials');",'escape'=>false,'class'=>'btn btn-warning'));?>
            <?php echo $this->Html->link('<span class="fa fa-trash"></span>&nbsp;'.__('Delete'),'javascript:void(0);',array('name'=>'deleteallfrm','id'=>'deleteallfrm','onclick'=>"check_perform_delete('testimonials');",'escape'=>false,'class'=>'btn btn-danger'));?>
            </div>
    </div>
        <?php echo $this->element('pagination');
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
                            <th><?php echo $this->Paginator->sort('name', __('Name'), array('direction' => 'asc'));?></th>
                            <th><?php echo $this->Paginator->sort('description', __('Description'), array('direction' => 'asc'));?></th>
                            <th><?php echo $this->Paginator->sort('status', __('Status'), array('direction' => 'asc'));?></th>
                            <th><?php echo __('Photo');?></th>
                            <th><?php echo __('Action');?></th>
                        </tr>
                        <?php foreach ($Testimonial as $post):
                        $id=$post['Testimonial']['id'];
			if(strlen($post['Testimonial']['photo'])>0)
			$photoImg='testimonial_thumb/'.$post['Testimonial']['photo'];
			else
			$photoImg='User.png';
			if($post['Testimonial']['member_id']){
			 $photoImg='member_thumb/'.$post['Member']['photo'];
			}
			?>
                        <tr>
                            <td><?php echo $this->Form->checkbox(false,array('value' => $post['Testimonial']['id'],'name'=>'data[Testimonial][id][]','id'=>"DeleteCheckbox$id",'class'=>'chkselect'));?></td>
                            <td><?php echo $serial_no++; ?></td>
                            <td><?php echo h($post['Testimonial']['name']); ?></td>
                            <td><?php echo h($post['Testimonial']['description']); ?></td>
			    <td><span class="label label-<?php if($post['Testimonial']['status']=="Active")echo"success";else echo"danger";?>"><?php echo __($post['Testimonial']['status']); ?></span></td>
                            <td><?php echo $this->Html->image($photoImg,array('class'=>'img-circle','width'=>150));?>
                            <td><div class="btn-group">
		    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
		    <?php echo __('Action');?> <span class="caret"></span>
		    </button>
		    <ul class="dropdown-menu" role="menu">
		    <?php if($post['Testimonial']['member_id']==NULL){?><li><?php echo $this->Html->link('<i class="fa fa-photo"></i>&nbsp;'.__('Change Photo'),'javascript:void(0);',array('onclick'=>"show_modal('$url/changephoto/$id');",'escape'=>false));?></li><?php }?>
		    <li><?php echo $this->Html->link('<span class="fa fa-edit"></span>&nbsp;'.__('Edit'),'javascript:void(0);',array('name'=>'editallfrm','onclick'=>"check_perform_sedit('$url','$id');",'escape'=>false));?></li>
		    <li><?php echo $this->Html->Link('<span class="fa fa-trash"></span>&nbsp;'.__('Delete'),'javascript:void(0);',array('onclick'=>"check_perform_sdelete('$id');",'escape'=>false));?></li>
		    </ul>
		    </div></td></tr>
                        <?php endforeach; ?>
                        <?php unset($post); ?>
                        </table>
                </div>
<?php echo $this->Form->end();?>
<?php echo $this->element('pagination');?>

        </div>
    </div>

</div>