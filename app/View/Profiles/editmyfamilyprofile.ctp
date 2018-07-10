<div class="container">
	<div class="panel panel-custom mrg">
        <div class="panel-heading"><?php echo __('Edit My Family Profile');?><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></div>

		<div class="panel">
                <div class="panel-body">
                <?php echo $this->Form->create('Profile', array( 'controller' => 'Profiles', 'action' => 'editProfile','name'=>'post_req','id'=>'post_req','class'=>'form-horizontal'));?>
                     <div class="panel-body">
					<div class="form-group">
					<label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Father Occupation');?></small></label>
					    <div class="col-sm-4">
						<?php echo $this->Form->input('father_occupation',array('type'=>'text','label' => false,'class'=>'form-control','placeholder'=>__('Father Occupation'),'div'=>false));?>
					    </div>
					<label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Mother Occupation');?></small></label>
					    <div class="col-sm-4">
						<?php echo $this->Form->input('mother_occupation',array('type'=>'text','label' => false,'class'=>'form-control','placeholder'=>__('Mother Occupation'),'div'=>false));?>
					    </div>
					</div>
		     </div>
		     <div class="panel-body">
					<div class="form-group">
					<label for="group_name" class="col-sm-2 control-label"><small><?php echo __('No Of Brother');?></small></label>
					    <div class="col-sm-4">
						<?php echo $this->Form->input('no_of_brother',array('label' => false,'class'=>'form-control','placeholder'=>__('No Of Brother'),'div'=>false));?>
					    </div>
					<label for="group_name" class="col-sm-2 control-label"><small><?php echo __('No Of Sister');?></small></label>
					    <div class="col-sm-4">
						<?php echo $this->Form->input('no_of_sister',array('label' => false,'class'=>'form-control','placeholder'=>__('No Of Sister'),'div'=>false));?>
					    </div>
					</div>
		     </div>
		     <div class="panel-body">
					<div class="form-group">
					<label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Family Value');?></small></label>
					    <div class="col-sm-4">
						<?php
						$familyValue=array('Orthodox'=>__('Orthodox'),'Traditional'=>__('Traditional'),'Moderate'=>__('Moderate'),'Liberal'=>__('Liberal'));
						echo $this->Form->select('family_value',$familyValue,array('div'=>false,'label'=>false,'class'=>'form-control','empty'=>__('Select')));
					      ?>
					    </div>
					<label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Family Type');?></small></label>
					    <div class="col-sm-4">
						<?php
						$familyType=array('Joint'=>__('Joint'),'Nuclear'=>__('Nuclear'),'Other'=>__('Other'));
						echo $this->Form->select('family_type',$familyType,array('div'=>false,'label'=>false,'class'=>'form-control','empty'=>__('Select')));
					      ?>
					    </div>
					</div>
		     </div>
		     <div class="panel-body">
					<div class="form-group">
					<label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Family Status');?></small></label>
					    <div class="col-sm-4">
						<?php
						$familyStatus=array('Lower Class'=>__('Lower Class'),'Middle Class'=>__('Middle Class'),'Upper Middle Class'=>__('Upper Middle Class'),'Rich / Affluent'=>__('Rich / Affluent'));
						echo $this->Form->select('family_status',$familyStatus,array('div'=>false,'label'=>false,'class'=>'form-control','empty'=>__('Select')));
					      ?>
					    </div>
					<label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Family Origion');?></small></label>
					    <div class="col-sm-4">
						<?php echo $this->Form->input('family_origion',array('type'=>'text','label' => false,'class'=>'form-control','placeholder'=>__('Father Origion'),'div'=>false));?>
					    </div>
					</div>
		     </div>
		    <div class="panel-body">
                    <div class="form-group text-left">
                        <div class="col-sm-offset-2 col-sm-7">
                            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span>&nbsp;<?php echo __('Update');?></button>                            
                        </div>
                    </div>
		     </div>
                <?php echo $this->Form->end();?>
                </div>
            </div>
        </div>
    </div>