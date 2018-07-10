<div <?php if(!$isError){?>class="container"<?php }?>>
    <?php echo $this->Session->flash();?>
    <div class="panel panel-custom mrg">
        <div class="panel-heading">Edit Plan<?php if(!$isError){?><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><?php }?></div>
        <div class="panel-body">
	    <?php echo $this->Form->create('Plan', array('class'=>'form-horizontal'));?>
	    <?php foreach ($Plan as $k=>$post): $id=$post['Plan']['id'];$form_no=$k+1;?>
	    <div class="panel panel-default">
		<div class="panel-heading"><strong><small class="text-danger">Form <?php echo$form_no?></small></strong></div>
		<div class="panel-body">
<div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Name *</label>
    <div class="col-sm-3">
       
       <?php echo $this->Form->input("$k.Plan.name",array('label' => false,'class'=>'form-control','placeholder'=>'Plan Name','div'=>false));?>
            
     
   </div>
    <label for="inputPassword3" class="col-sm-2 control-label"><?php echo __('No of Contacts');?> *</label>
    <div class="col-sm-3">
      <?php echo $this->Form->input("$k.Plan.expiry",array('label' => false,'class'=>'form-control','placeholder'=>'No of Contacts','div'=>false));?>
         
   </div>
</div>
</div>
<div class="panel-body">
<div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label">Amount *</label>
    <div class="col-sm-3">
       <?php echo $this->Form->input("$k.Plan.amount",array('label' => false,'class'=>'form-control','placeholder'=>'Amount','div'=>false));?>
    </div>
    <label for="inputPassword3" class="col-sm-2 control-label">Duration (Months) *</label>
    <div class="col-sm-3">
       <?php echo $this->Form->input("$k.Plan.duration",array('label' => false,'class'=>'form-control','placeholder'=>'Duration (0 for Unlimited)','div'=>false));?>
    </div>
    <div class="col-sm-3">
      <?php echo $this->Form->input("$k.Plan.id", array('type' => 'hidden'));?>
         
   </div>
</div>
</div>
	    </div>
	    <?php endforeach;?>
	    <?php unset($post); ?>
	    <div class="form-group text-left">
		<div class="col-sm-offset-3 col-sm-6">
		    <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span> Update</button>
		    <?php if(!$isError){?><button type="button" class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancel</button><?php }?>
		</div>
	    </div>
	    <?php echo $this->Form->end();?>
	</div>
    </div>
</div>