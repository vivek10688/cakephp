<?php echo $this->Session->flash();?>
<script>
$(document).ready(function(){
$('#selectAll').click(function() {
$('.chkselect').prop('checked', this.checked);});
});
</script>
<div class="container">
	<div class="panel panel-custom mrg">
        <div class="panel-heading"><?php echo __('Remove Photos');?><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></div>
                <div class="panel-body">
                <?php echo $this->Form->create('Profile', array( 'controller' => 'Profiles', 'action' => 'removePhoto','name'=>'deleteall'));?>
                     <div class="table-responsive">
			<table class="table table-striped table-bordered">
			<?php if($post){?>
			    <tr>
				<th><?php echo $this->Form->checkbox('checkbox', array('value'=>'deleteall','name'=>'selectAll','label'=>false,'id'=>'selectAll','hiddenField'=>false));?></th>
				<th><?php echo __('Photos');?></th>
			    </tr>
			    <?php  foreach ($post as $value):
			    $id=$value['MembersPhoto']['id'];
			    if($value['MembersPhoto']['photo'] && $value['MembersPhoto']['photo_status']=='Approved'){
			    $memberImg='member_thumb/'.$value['MembersPhoto']['photo'];
			    $video='img/member/'.$value['MembersPhoto']['photo'];
			    }
			    else{
				$memberImg='User.png';
			    }
			    ?>
			    <tr>
				<td class="col-sm-1"><?php echo $this->Form->checkbox(false,array('value' => $value['MembersPhoto']['id'],'name'=>'data[MembersPhoto][id][]','id'=>"DeleteCheckbox$id",'class'=>'chkselect'));?></td>
				<td class="col-sm-3">
				<?php echo$this->Html->image($memberImg,array('class'=>'img-thumbnail'));?>
				
				</td>
			    </tr>
			    <?php endforeach; ?>
			    <?php unset($value); ?>
			</table>
		    </div>                  
                    <div class="form-group text-left">
                        <div class="col-sm-7">
                            <button type="submit" class="btn btn-danger"><span class="fa fa-trash"></span>&nbsp;<?php echo __('Delete');?></button>                            
                        </div>
                    </div>
		    <?php }else{?>
		    <div class="form-group text-left">
                        <div class="col-sm-7">
                            <?php echo __('No Photo');?>                            
                        </div>
                    </div>
		    
		    <?php }?>
                <?php echo $this->Form->end();?>
                </div>
            </div>
        </div>
