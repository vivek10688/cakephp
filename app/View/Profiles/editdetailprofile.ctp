<script type="text/javascript">
    $(document).ready(function(){        
        $('#birth_time').datetimepicker({locale:'<?php echo$configLanguage;?>',format:'HH:mm A'});
});
</script>

<div class="container">
	<div class="panel panel-custom mrg">
        <div class="panel-heading"><?php echo __('Edit Detail Profile');?><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></div>

		<div class="panel">
                <div class="panel-body">
                <?php echo $this->Form->create('Profile', array( 'controller' => 'Profiles', 'action' => 'editProfile','name'=>'post_req','id'=>'post_req','class'=>'form-horizontal'));?>
                     <div class="panel-body">
<div class="form-group">
     <label for="inputPassword3" class="col-sm-2 control-label"><small><?php echo __('Employed');?></small></label>
    <div class="col-sm-4">
       <?php
      echo $this->Form->select('employed_id',$employedName,array('class'=>'form-control','empty'=>__('Select')));
      ?>
   </div>
    <label for="inputPassword3" class="col-sm-2 control-label"><small><?php echo __('Marital Status');?></small></label>
    <div class="col-sm-4">
      <?php
      echo $this->Form->select('maritialstatus_id',$maritialstatusName,array('class'=>'form-control','empty'=>__('Select')));
     ?>
   </div>
</div>
</div>
<div class="panel-body">
<div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label"><small><?php echo __('Height');?></small></label>
    <div class="col-sm-4">
       <?php  echo $this->Form->select('height_id',$heightName,array('class'=>'form-control','empty'=>__('Select'))); ?>
   </div>
    <label for="inputPassword3" class="col-sm-2 control-label"><small><?php echo __('Habits');?></small></label>
    <div class="col-sm-4">
      <?php echo $this->Form->select('habit_id',$habitName,array('class'=>'form-control','empty'=>__('Select'))); ?>
   </div>
</div>
</div>
<div class="panel-body">
<div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label"><small><?php echo __('Education');?></small></label>
    <div class="col-sm-4">
       <?php echo $this->Form->select('education_id',$educationName,array('class'=>'form-control','empty'=>__('Select')));   ?>
   </div>
    <label for="inputPassword3" class="col-sm-2 control-label"><small>Occupation</small></label>
    <div class="col-sm-4">
      <?php echo $this->Form->select('occupation_id',$occupationName,array('class'=>'form-control','empty'=>__('Select')));   ?>
   </div>
   </div>
</div>
<div class="panel-body">
<div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label"><small><?php echo __('Manglik');?></small></label>
    <div class="col-sm-4">
       <?php $manglik=array('Yes'=>__('Yes'),'No'=>__('No'),'Does not matter'=>__('Does not matter')); echo $this->Form->select('manglik',$manglik,array('class'=>'form-control','empty'=>__('Select')));   ?>
   </div>
    <label for="inputPassword3" class="col-sm-2 control-label"><small><?php echo __('Physical Status');?></small></label>
    <div class="col-sm-4">
      <?php $physical=array('Normal'=>__('Normal'),'Disable'=>__('Disable'),'Does not matter'=>__('Does not matter')); echo $this->Form->select('physical',$physical,array('class'=>'form-control','empty'=>__('Select')));   ?>
    
   </div>
   </div>
</div>
<div class="panel-body">
<div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label"><small><?php echo __('Have Children');?></small></label>
    <div class="col-sm-4">
       <?php $children=array('Yes'=>__('Yes'),'No'=>__('No'),'Does not matter'=>__('Does not matter')); echo $this->Form->select('children',$children,array('class'=>'form-control','empty'=>__('Select')));   ?>
   </div>
    <label for="inputPassword3" class="col-sm-2 control-label"><small><?php echo __('Complexion');?></small></label>
    <div class="col-sm-4">
      <?php $complexion=array('Normal'=>__('Normal'),'Fair'=>__('Fair'),'Very Fair'=>__('Very Fair'),'Wheatish'=>__('Wheatish'),'Dark'=>__('Dark')); echo $this->Form->select('complexion',$complexion,array('class'=>'form-control','empty'=>__('Select')));   ?>
    
   </div>
   </div>
</div>
<div class="panel-body">
<div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label"><small><?php echo __('Body Type');?></small></label>
    <div class="col-sm-4">
       <?php $bodyType=array('Slim'=>__('Slim'),'Average'=>__('Average'),'Athletic'=>__('Athletic'),'Heavy'=>__('Heavy')); echo $this->Form->select('body_type',$bodyType,array('class'=>'form-control','empty'=>__('Select')));   ?>
   </div>
    <label for="inputPassword3" class="col-sm-2 control-label"><small><?php echo __('Rashi');?></small></label>
    <div class="col-sm-4">
      <?php  echo $this->Form->select('rashy_id',$rashiName,array('class'=>'form-control','empty'=>__('Select')));   ?>
    
   </div>
   </div>
</div>
<div class="panel-body">
<div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label"><small><?php echo __('Birth Time');?></small></label>
    <div class="col-sm-4">
    <div class="input-group date" id="birth_time">
	<?php echo $this->Form->input('birth_time',array('type'=>'text','label' => false,'class'=>'form-control','div'=>false));?>
	<span class="input-group-addon"><span class="fa fa-calendar"></span></span>
	</div>
    </div>
    <label for="inputPassword3" class="col-sm-2 control-label"><small><?php echo __('Birth Place');?></small></label>
    <div class="col-sm-4">
      <?php  echo $this->Form->input('birth_place',array('div'=>false,'label'=>false,'class'=>'form-control','placeholder'=>__('Birth Place')));   ?>
   </div>
   </div>
</div>
<div class="panel-body">
<div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label"><small><?php echo __('Mother Tongue');?></small></label>
    <div class="col-sm-4">
      <?php  echo $this->Form->select('mothertongue_id',$mothertongueName,array('class'=>'form-control','empty'=>__('Select')));   ?>
    
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