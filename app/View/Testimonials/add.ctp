<div class="container">
	<div class="panel panel-custom mrg">
        <div class="panel-heading"><?php echo __('Post Success  Story');?><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></div>
              <div class="panel-body">
                <?php echo $this->Form->create('Testimonial', array('controller' => 'Testimonials','action'=>'add','class'=>'form-horizontal','type'=>'file'));?>
                    <div class="form-group">
                        <label for="group_name" class="col-sm-3 control-label"><small><?php echo __('Name');?></small></label>
                        <div class="col-sm-9">
                           <?php echo $this->Form->input('name',array('value'=>$userValue['Member']['name'],'label' => false,'class'=>'form-control','placeholder'=> __('Name'),'div'=>false,'readonly'=>true));?>
                        </div>
                    </div>
                   <div class="form-group">
                        <label for="group_name" class="col-sm-3 control-label"><small><?php echo __('Description');?></small></label>
                        <div class="col-sm-9">
                           <?php echo $this->Form->input('description',array('type'=>'textarea','label' => false,'class'=>'form-control','placeholder'=>__('Description'),'div'=>false,'maxlength'=>255));?>
                        </div>
                    </div>
                    <div class="form-group text-left">
                        <div class="col-sm-offset-3 col-sm-7">
                            <?php echo$this->Form->button('<span class="fa fa-plus-circle"></span>&nbsp;'.__('Save'),array('class'=>'btn btn-success','escpae'=>false));?>
                            <button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-remove"></span>&nbsp;<?php echo __('Cancel');?></button>
                     </div>
                    </div>
                <?php echo $this->Form->end();?>
                </div>
            </div>
        </div>