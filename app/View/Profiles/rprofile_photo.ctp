<?php echo $this->Session->flash();?>

<div class="container">
	<div class="panel panel-custom mrg">
        <div class="panel-heading"><?php echo __('Remove Profile Photo');?><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></div>
                <div class="panel-body">
                <?php echo $this->Form->create('Profile', array( 'controller' => 'Profiles', 'action' => 'rprofilePhoto','name'=>'deleteall'));?>
                     <div class="table-responsive">
			<table class="table table-striped table-bordered">
			    <tr>
				<td><?php if($photo){echo$this->Html->image($photo,array('class'=>'img-responsive'));}else{echo __('No profile photo avalilable');}?>
				</td>
			    </tr>
			</table>
		    </div>
		     <?php if($photo){?>
                    <div class="form-group text-left">
                        <div class="col-sm-7">
                            <button type="submit" class="btn btn-danger"><span class="fa fa-trash"></span>&nbsp;<?php echo __('Delete');?></button>                            
                        </div>
                    </div>
		    <?php }?>
                <?php echo $this->Form->end();?>
                </div>
            </div>
        </div>
