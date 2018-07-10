<?php echo $this->Session->flash();?>
<div class="container">
	<div class="panel panel-custom mrg">
        <div class="panel-heading"><?php echo __('Change profile Photo');?><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></div>
                <div class="panel-body">
                <?php echo $this->Form->create('Profile', array( 'controller' => 'Profiles', 'action' => 'cprofilePhoto','name'=>'post_req','id'=>'post_req','class'=>'form-horizontal','type' => 'file'));?>
                     <div class="form-group">
                        <label for="group_name" class="col-sm-3 control-label"><?php echo __('Upload Photo');?></label>
                        <div class="col-sm-9">
			<?php echo $this->Form->input('photo',array('required'=>true,'type' => 'file','label' => false,'div'=>false));?>
                        </div>
                    </div>                   
                    <div class="form-group text-left">
                        <div class="col-sm-offset-3 col-sm-7">
                            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span>&nbsp;<?php echo __('Submit');?></button>                            
                        </div>
                    </div>
                <?php echo $this->Form->end();?>
                </div>
            </div>
        </div>
