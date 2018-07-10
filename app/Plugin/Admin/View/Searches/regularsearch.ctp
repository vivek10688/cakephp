<?php
 $this->Js->JqueryEngine->jQueryObject = 'jQuery';
// Paginator options
$this->Paginator->options(array(
  'update' => '#resultDiv',
  'evalScripts' => true,
));
?>
<div id="resultDiv"> 

<div class="page-title"> <div class="title-env"> <h1 class="title"><?php echo __('Search Result');?></h1></div></div>
<div class="panel"><?php echo $this->Session->flash();?>
    
        <?php $url=$this->Html->url(array('controller'=>'Searches'));
	echo $this->element('pagination',array('IsSearch'=>'No'));
        $page_params = $this->Paginator->params();
        $limit = $page_params['limit'];
        $page = $page_params['page'];
        $serial_no = 1*$limit*($page-1)+1;?>
        <?php echo $this->Form->create(array('name'=>'deleteallfrm','action' => 'deleteall'));?>
<?php echo $this->Session->flash();?>
<div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th><?php echo $this->Paginator->sort('id', __('#'), array('direction' => 'desc'));?></th>
			    <th><?php echo __('Photo');?></th>
                            <th><?php echo $this->Paginator->sort('profileId', __('Profile Id'), array('direction' => 'asc'));?></th>
                            <th><?php echo $this->Paginator->sort('name', __('Name'), array('direction' => 'asc'));?></th>
			    <th><?php echo $this->Paginator->sort('religion_id', __('Religion'), array('direction' => 'asc'));?></th>
			    <th><?php echo __('Location');?></th>
                            <th><?php echo __('Action');?></th>
                        </tr>
                        <?php foreach ($post as $value):$id=$value['Search']['id'];
			if($value['Search']['photo'])
			     $memberImg='member_thumb/'.$value['Search']['photo'];
			     else
			     $memberImg='User.png';?>
                        <tr>
                            <td><?php echo $serial_no++; ?></td>
			    <td><?php echo$this->Html->link($this->Html->image($memberImg,array('class'=>'img-circle responsive','height'=>50,'alt' => $value['Search']['name'])),'javascript:void(0);',array('onclick'=>"show_modal('$url/View/$id');",'escape' => false));?></td>
                            <td><?php echo h($value['Search']['profileId']); ?></td>
                            <td><?php if($value['Search']['name']){ echo h($value['Search']['name']);}else{echo __('Not Specified');} ?></td>
			    <td>&nbsp;<?php if($value['Religion']['name']){echo$value['Religion']['name'];}else{echo __('Not Specified');}?></td>
			    <td>&nbsp;<?php if($value['Search']['city_id']){echo$value['City']['name'];}else{echo __('Not Specified');}?>,&nbsp;<?php if($value['State']['name']){echo$value['State']['name'];}else{echo __('Not Specified');}?>,&nbsp;<?php if($value['Country']['name']){echo$value['Country']['name'];}else{echo __('Not Specified');}?></td>
			    <td>
			      <?php echo $this->Html->link('<span class="fa fa-print"></span>&nbsp;'.__('Print / Save Profile'),array('controller'=>'Searches','action'=>'viewprofile',$id),array('target'=>'_blank','escape'=>false,'class'=>'btn btn-info'));?><br/><br/>
			      <?php echo $this->Html->link('<span class="fa fa-envelope fa-fw"></span>&nbsp;'.__('Send Message'),array('controller'=>'Mails','action'=>'compose','new',$id),array('escape'=>false,'class'=>'btn btn-warning'));?>
			    </td>
                        </tr>
                        <?php endforeach; ?>
                        <?php unset($value);?>	
                        </table>
                </div>
        <?php echo $this->Form->end();?>
	<?php echo $this->element('pagination',array('IsSearch'=>'No'));?>
    </div>
</div></div>