<div class="panel panel-custom">
    <div class="panel-heading"><?php echo __('Add Plan');?></div>
    <div class="panel-body"><?php echo $this->Session->flash();?>
        <?php echo $this->Form->create('Plan',array('class'=>'form-horizontal'));?>
        <div class="form-group">
            <label for="group_name" class="col-sm-3 control-label"><small><?php echo __('Name');?></small></label>
            <div class="col-sm-9">
               <?php echo $this->Form->input('name',array('label' => false,'class'=>'form-control','placeholder'=> __('Plan Name'),'div'=>false));?>
            </div>
        </div>
        <div class="form-group">
            <label for="group_name" class="col-sm-3 control-label"><small><?php echo __('No of Contacts');?></small></label>
            <div class="col-sm-9">
               <?php echo $this->Form->input('expiry',array('label' => false,'class'=>'form-control','placeholder'=> __('No of Contacts'),'div'=>false));?>
            </div>
        </div>
        <div class="form-group">
            <label for="group_name" class="col-sm-3 control-label"><small><?php echo __('Amount');?></small></label>
            <div class="col-sm-9">
               <?php echo $this->Form->input('amount',array('label' => false,'class'=>'form-control','placeholder'=> __('Amount'),'div'=>false));?>
            </div>
        </div>
        <div class="form-group">
            <label for="group_name" class="col-sm-3 control-label"><small><?php echo __('Duration (Months)');?></small></label>
            <div class="col-sm-9">
               <?php echo $this->Form->input('duration',array('required'=>true,'label' => false,'class'=>'form-control','placeholder'=> __('Duration (0 for Unlimited)'),'div'=>false));?>
            </div>
        </div>
        <div class="form-group text-left">
            <div class="col-sm-offset-3 col-sm-6">
                <?php echo$this->Form->button('<span class="fa fa-plus-circle"></span>&nbsp;'.__('Save'),array('class'=>'btn btn-success','escpae'=>false));?>
                <?php echo$this->Html->link('<span class="fa fa-close"></span>&nbsp;'.__('Close'),array('action'=>'index'),array('class'=>'btn btn-danger','escape'=>false));?>
            </div>
        </div>
        <?php echo $this->Form->end();?>
    </div>
</div>