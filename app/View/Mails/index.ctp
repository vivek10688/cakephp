<?php
 $this->Js->JqueryEngine->jQueryObject = 'jQuery';
// Paginator options
$this->Paginator->options(array(
  'update' => '#resultDiv',
  'evalScripts' => true,
));
?>
<div id="resultDiv"> 
<?php
$url=$this->Html->url(array('controller'=>'Mails','action'=>'View'));
$urlAction=$this->params['action'];
if($urlAction=="trash")
$deleteAction="deleteall";
else
$deleteAction="trashall";
?>
<div class="grid_3">
  <div class="container">
   <div class="breadcrumb1">
     <ul>
        <?php echo$this->Html->link('<i class="fa fa-home home_1"></i>&nbsp;',array('controller'=>'/'),array('escape'=>false));?>
        <span class="divider">&nbsp;|&nbsp;</span>
        <li class="current-page"><?php echo __('Messages');?></li>
     </ul>
   </div>
   <div class="col-sm-12"><?php echo $this->Session->flash();?>
    <?php echo $this->element('menunavigation');?>
    <div class="col-sm-9"><div class="blog-info"><h3><?php echo $mailPageName;?></h3></div>
   <?php echo $this->element('pagination',array('IsSearch'=>'No','IsDropdown'=>'No'));
		$page_params = $this->Paginator->params();
		$limit = $page_params['limit'];
		$page = $page_params['page'];
		$serial_no = 1*$limit*($page-1)+1;?>
	
   <div class="services">
   <div class="page-mail">
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="sidebar sidebar-left nav nav-pills">
                                        <div class="sidebar-row">
                                           
					    <ul class="list-group">
					    <li class="list-group-item"><?php echo$this->Html->link(__('Compose'),array('controller'=>'Mails','action'=>'compose'),array('class'=>'btn btn-danger pll prl'));?></li>
						<li <?php if($urlAction=="index"){echo "class=\"list-group-item active\"";}else{echo "class=\"list-group-item\"";}?>><?php echo$this->Html->link(__('Inbox')." <span class='badge'>$totalInbox</span>",array('controller'=>'Mails','action'=>'index'),array('class'=>'','escape'=>false));?></li>
						<li <?php if($urlAction=="sent"){echo "class=\"list-group-item active\"";}else{echo "class=\"list-group-item\"";}?>><?php echo$this->Html->link(__('Sent Message'),array('controller'=>'Mails','action'=>'sent'),array('class'=>'btn-group dropup btn-block'));?></li>
						<li <?php if($urlAction=="trash"){echo "class=\"list-group-item active\"";}else{echo "class=\"list-group-item\"";}?>><?php echo$this->Html->link(__('Trash'),array('controller'=>'Mails','action'=>'trash'),array('class'=>'btn-group dropup btn-block'));?></li>
                                            </ul> 
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div>
                                       <div>
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <ul class="list-group mail-action list-unstyled list-inline">
                                                        <li><a class="btn btn-default"><?php echo $this->Form->checkbox('checkbox', array('value'=>'deleteall','name'=>'selectAll','label'=>false,'id'=>'selectAll','hiddenField'=>false));?></a></li>
                                                        <?php if($urlAction=="trash"){?>
							<li><?php echo $this->Html->link('<i class="fa fa-trash"></i>','javascript:void(0);',array('name'=>'deleteallfrm','id'=>'deleteallfrmi','onclick'=>'check_perform_delete();','escape'=>false,'class'=>'btn btn-default','data-hover'=>'tooltip','data-original-title'=>__('Delete Forever')));?></li>
							<?php }else{?>
							<li><?php echo $this->Html->link('<i class="fa fa-trash"></i>','javascript:void(0);',array('name'=>'deleteallfrm','id'=>'deleteallfrm','onclick'=>'check_perform_trash();','escape'=>false,'class'=>'btn btn-default','data-hover'=>'tooltip','data-original-title'=>__('Move to Trash')));?></li>
							<?php }?>
							<?php if($urlAction!="sent"){?>
							<li class="dropdown"><a href="javascript:void(0);" data-toggle="dropdown"
                                                                                class="btn btn-default dropdown-toggle"><i
                                                                class="fa fa-folder"></i>&nbsp;<?php echo __('More');?> &nbsp;<span
                                                                class="caret"></span></a>
                                                            <ul role="menu" class="dropdown-menu">
								<?php if($urlAction=="index"){?>
                                                                <li><?php echo $this->Html->link(__('Mark as Read'),'javascript:void(0);',array('onclick'=>'check_perform_more("read");'));?></li>
                                                                <li><?php echo $this->Html->link(__('Mark as Unread'),'javascript:void(0);',array('onclick'=>'check_perform_more("unread");'));?></li><?php }?>
                                                                <?php if($urlAction=="trash"){?><li><?php echo $this->Html->link(__('Move to Inbox'),'javascript:void(0);',array('onclick'=>'check_perform_more("inbox");'));?></li><?php }?>
                                                            </ul>
                                                        </li><?php }?>                                                      
                                                    </ul>
						    <?php echo $this->Form->create(array('name'=>'deleteallfrm','action' => $deleteAction));?> 
                                                    <div class="list-group mail-box">
						    <?php foreach ($Mail as $post):
						    $id=$post['Mail']['id'];?>
						    <a href="javascript:void(0);" class="list-group-item">
                                                        <div class="row">
                                                            <div class="col-md-5 col-lg-4"><?php echo $this->Form->checkbox(false,array('value' => $post['Mail']['id'],'name'=>'data[Mail][id][]','id'=>"DeleteCheckbox$id",'class'=>'chkselect'));?>
							    <?php echo($post['Mail']['type']=="Unread") ? "<strong onclick=show_modal('$url/$id'); class=\"mail-from mail-highlight\">" : "<span onclick=show_modal('$url/$id'); class=\"mail-from\">";?><?php if($post['Mail']['to_email']==$mailType){echo h($post['Mail']['from_email']);}else{echo h($post['Mail']['to_email']);}?><?php echo ($post['Mail']['type']=="Unread") ? "</strong>" : "</span>"?></div>
                                                            <div class="col-md-7 col-lg-8" onclick=show_modal('<?php echo$url;?>/<?php echo$id;?>');><?php echo($post['Mail']['type']=="Unread") ? "<strong class=\"mail-title mail-highlight\">" : "<span class=\"mail-title\">";?><i><?php echo h($post['Mail']['subject']);?></i><?php echo ($post['Mail']['type']=="Unread") ? "</strong>" : "</span>"?>
							    <span class="pull-right"><?php echo $this->Time->Format($sysDay.$dateSep.$sysMonth.$dateSep.$sysYear.$dateGap.$sysHour.$timeSep.$sysMin.$timeSep.$sysSec.$dateGap.$sysMer,$post['Mail']['date']);?></span>
                                                            </div>
                                                        </div>
                                                    </a>
						    <?php endforeach;?>
						    <?php unset($post);?>
						   </div>
						   <?php echo$this->Form->input('type',array('type'=>'hidden','name'=>'type'));?>
						   <?php echo $this->Form->end();?>
                                                </div>
                                            </div>
                                       </div>
				</div>
			    </div>
			</div>
   		
   </div></div></div>
<div class="clearfix"> </div>
    </div>
</div>
  </div>
</div>

<script type="text/javascript">
function check_perform_trash()
{
    document.deleteallfrm.submit();
}
function check_perform_more(type)
{
    document.deleteallfrm.type.value=type;
    document.deleteallfrm.submit();
}
</script>