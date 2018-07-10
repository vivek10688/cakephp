<div class="grid_3">
  <div class="container">
   <div class="breadcrumb1">
     <ul>
        <?php echo$this->Html->link('<i class="fa fa-home home_1"></i>&nbsp;',array('controller'=>'/'),array('escape'=>false));?>
        <span class="divider">&nbsp;|&nbsp;</span>
        <li class="current-page"><?php echo __('Messages');?></li>
     </ul>
   </div>
   <div class="col-sm-12">
    <?php echo $this->element('menunavigation');?>
    <div class="col-sm-9"><div class=""><h3><?php echo __('Compose Message');?></h3></div>
    <div class="services"><?php echo $this->Session->flash();?>
   <?php echo $this->Form->create('Mail', array( 'controller' => 'Mails', 'action' => 'compose','name'=>'post_req','id'=>'post_req','class'=>'form-horizontal'));?>
                    <div class="form-group">
                        <label for="group_name" class="col-sm-2 control-label mail-highlight"><strong><?php echo __('To');?></small></label>
                        <div class="col-sm-10">
                           <?php echo $this->Form->input('to_email',array('label' => false,'class'=>'form-control','placeholder'=>__('Username'),'div'=>false));?>
                        </div>
                    </div>
		    <div class="form-group">
                        <label for="group_name" class="col-sm-2 control-label mail-highlight"><small><?php echo __('Subject');?></small></label>
                        <div class="col-sm-10">
                           <?php echo $this->Form->input('subject',array('label' => false,'class'=>'form-control','placeholder'=>__('Subject'),'div'=>false));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="group_name" class="col-sm-2 control-label mail-highlight"><small><?php echo __('Message');?></small></label>
                        <div class="col-sm-10">
                           <?php echo $this->Tinymce->input('message', array('class'=>'form-control','placeholder'=>__('Message'),'label' => false),array('language'=>$configLanguage,'directionality'=>$dirType),'basic');?>
                        </div>
                    </div>
                    <div class="form-group text-left">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-success"><span class="fa fa-send"></span> <?php echo __('Send');?></button>
			    <?php echo$this->Html->link('<span class="fa fa-close"></span> '.__('Close'),array('controller'=>'Mails','action'=>'index'),array('class'=>'btn btn-danger','escape'=>false));?>
                        </div>
                    </div>
                <?php echo $this->Form->end();?>
                
   </div>
<div class="clearfix"> </div>
    </div>
</div>
  </div>
</div>