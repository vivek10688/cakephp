<div class="container">
	<div class="panel panel-custom mrg">
        <div class="panel-heading"><?php echo __('Payment');?><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></div>
                <div class="panel-body">
                <?php echo $this->Form->create('Payment',array('name'=>'post_req','id'=>'post_req','class'=>'form-horizontal'));?>
                     <div class="form-group">
                        <label for="group_name" class="col-sm-3 control-label"><?php echo __('Plan');?></label>
                        <div class="col-sm-4">
			<?php  echo $this->Form->select('plan_id',$planName,array('class'=>'form-control','empty'=>'Select'));   ?>
		  </div>
                    </div>
                    <div class="form-group">
                        <label for="group_name" class="col-sm-3 control-label"><?php echo __('Remarks');?></label>
                        <div class="col-sm-4">
			<?php echo $this->Form->input('remarks',array('label' => false,'class'=>'form-control','placeholder'=>__('Remarks'),'div'=>false));?>
		 </div>
                    </div>
                    <div class="form-group text-left">
                        <div class="col-sm-offset-3 col-sm-7">
                            <button type="submit" class="btn btn-success"><span class="fa fa-money"></span> <?php echo __('Pay Now');?></button>                            
                        </div>
                    </div>
                <?php echo $this->Form->end(null);?>
                </div>
            </div>
        </div>