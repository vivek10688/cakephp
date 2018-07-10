<div <?php if(!$isError){?>class="container"<?php }?>>    
    <div class="panel panel-custom mrg">
        <div class="panel-heading"><?php echo __('View Bank Deposit');?><?php if(!$isError){?><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><?php }?></div>
        <div class="panel-body"><?php echo $this->Session->flash();?>
	    <?php echo $this->Form->create('Bankdeposit',array('class'=>'form-horizontal'));?>
	    <div class="panel panel-default">
		<div class="panel-body">
		    <div class="form-group">
			<div class="col-sm-3 col-sm-offset-3"><?php echo __('Name');?>: <?php echo $this->request->data['Member']['name'];?></div>
			<div class="col-sm-2"><?php echo __('Username');?>: <?php echo $this->request->data['Member']['user_name'];?></div>
			<div class="col-sm-4"><?php echo __('Email');?>: <?php echo $this->request->data['Member']['email'];?></div>
		    </div>
		    <div class="form-group">
			<div class="col-sm-3 col-sm-offset-3"><?php echo __('Plan');?>: <?php echo $this->request->data['Plan']['name'];?></div>
			<div class="col-sm-2"><?php echo __('Amount');?>: <?php echo $currency.$this->request->data['Plan']['amount'];?></div>
			<div class="col-sm-4"><?php echo __('Request Date');?>: <?php echo $this->Time->format($dtFormat,$this->request->data['Bankdeposit']['created']);?></div>
		    </div>
		    <div class="form-group">
			<div class="col-sm-9 col-sm-offset-3"><?php echo __('User Remarks');?>: <?php echo $this->request->data['Bankdeposit']['user_remarks'];?></div>
		    </div>
		    <div class="form-group">
			<label for="group_name" class="col-sm-3 control-label"><?php echo __('Status');?></label>
			<div class="col-sm-9">
			   <?php echo $this->Form->select('status',array('Approved'=>'Approved','Rejected'=>'Rejected'),array('empty'=>__('Please Select'),'label' => false,'class'=>'form-control','div'=>false));?>
			</div>
		    </div>
		    <div class="form-group">
			<label for="group_name" class="col-sm-3 control-label"><?php echo __('Remarks');?></label>
			<div class="col-sm-9">
			   <?php echo $this->Form->input('remarks',array('label' => false,'class'=>'form-control','placeholder'=> __('Remarks'),'div'=>false));?>
			</div>
		    </div>
		    <div class="form-group text-left">
			<div class="col-sm-offset-3 col-sm-6">
			    <?php echo $this->Form->input('id', array('type' => 'hidden'));?>
			</div>
		    </div>
		</div>
	    </div>
	    <?php if($this->request->data['Bankdeposit']['status']=="Pending"){?>
	    <div class="form-group text-left">
		<div class="col-sm-offset-3 col-sm-6">
		    <?php echo$this->Form->button('<span class="fa fa-refresh"></span>&nbsp;'.__('Submit'),array('class'=>'btn btn-success','escpae'=>false));?>
		    <?php if(!$isError){?><button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-remove"></span>&nbsp;<?php echo __('Cancel');?></button><?php }else{
			echo$this->Html->link('<span class="fa fa-close"></span>&nbsp;'.__('Close'),array('action'=>'index'),array('class'=>'btn btn-danger','escape'=>false));}?>
		</div>
	    </div>
	    <?php }?>
	    <?php echo $this->Form->end();?>
	</div>
    </div>
</div>