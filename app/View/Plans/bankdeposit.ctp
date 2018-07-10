<div <?php if(!$isError){?>class="container"<?php }?>>
    <div class="panel panel-custom mrg">
        <div class="panel-heading"><?php echo __('Bank Deposit Details');?><?php if(!$isError){?><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><?php }?></div>            
                <div class="panel-body">  <?php echo $this->Session->flash();?>
                <?php echo $this->Form->create('Plan',array('class'=>'form-horizontal'));?>
                    <div class="form-group">
                        <label for="group_name" class="col-sm-3 control-label"><?php echo __('Plan');?></label>
                        <div class="col-sm-9">
                           <?php echo$this->Form->select('plan',$plan,array('value'=>$id,'empty'=>__('Please Select'),'class'=>'form-control'));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="group_name" class="col-sm-3 control-label"><?php echo __('Transaction Id');?></label>
                        <div class="col-sm-9">
                           <?php echo $this->Form->input('transaction_no',array('label' => false,'class'=>'form-control','placeholder'=>__('Transaction Id'),'div'=>false));?>
                        </div>
                    </div>
                     <div class="form-group">
                        <label for="group_name" class="col-sm-3 control-label"><?php echo __('Remarks');?></label>
                        <div class="col-sm-9">
                           <?php echo $this->Form->input('remarks',array('type'=>'textarea','label' => false,'class'=>'form-control','placeholder'=>__('Remarks'),'div'=>false));?>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-9">
                            <?php echo $this->Form->input('id', array('type' => 'hidden'));?>                            
                        </div>
                    </div>
                    <div class="form-group text-left">
                        <div class="col-sm-offset-3 col-sm-7">
                            <?php echo$this->Form->button('<span class="fa fa-plus-circle"></span>&nbsp;'.__('Submit'),array('class'=>'btn btn-success','escpae'=>false));?>
		    <?php if(!$isError){?><button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-times"></span>&nbsp;<?php echo __('Cancel');?></button><?php }else{
			echo$this->Html->link('<span class="fa fa-times"></span>&nbsp;'.__('Close'),array('action'=>'index'),array('class'=>'btn btn-danger','escape'=>false));}?>
                        </div>
                    </div>
                <?php echo $this->Form->end();?>
        </div>
    </div>
</div>