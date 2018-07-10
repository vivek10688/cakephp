<script type="text/javascript">
    $(document).ready(function(){        
        $('#birth_time').datetimepicker({locale:'<?php echo$configLanguage;?>',format:'HH:mm A'});
});
</script>
<?php if($isError){?>
<div class="grid_3">
  <div class="container">
   <div class="breadcrumb1">
     <ul>
        <?php echo$this->Html->link('<i class="fa fa-home home_1"></i>&nbsp;',array('controller'=>'/'),array('escape'=>false));?>
        <span class="divider">&nbsp;|&nbsp;</span>
        <li class="current-page"><?php echo __('My Express Interest');?></li>
     </ul>
   </div>
   <div class="col-sm-12">
    <?php echo $this->element('menunavigation');?>
    <div class="col-sm-9">

   <div class="services">
   <?php echo $this->Session->flash();?>
   <?php }else {?>
   <div class="container">
	<div class="panel panel-custom mrg">
        <div class="panel-heading"><?php echo __('My Express Interest');?><?php if(!$isError){?><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><?php }?></div>
		<div class="panel">
	         <div class="panel-body"><?php }?>
                <?php echo $this->Form->create('Expressinterest', array('name'=>'post_req','id'=>'post_req','class'=>'form-horizontal'));?>
                 <div class="form-group">
		    <label for="inputPassword3" class="col-sm-2 control-label"><small><?php echo __('Gender');?></small></label>
		    <div class="col-sm-4">
		     <div class="radio-inline">
		    <?php $sex=array('Female'=>__('Bride'),'Male'=>__('Groom'));
		    if($userValue){
		     if($userValue['Member']['sex']=="Male"){
		       $selSex="Female";
		       }
		       else{
			  $selSex="Male";
		       }
		    }
		    else{
		     $selSex="Male";
		    }
		    echo $this->Form->radio('sex',$sex,array('value'=>$selSex,'legend'=>false,'hiddenField'=>false,'separator'=> '</div><div class="radio-inline">',
									      'label'=>array('class'=>'radio-inline')));?>
	 </div>
		 </div>
		 </div>
		 <div class="form-group">
				    <label for="inputPassword3" class="col-sm-2 control-label"><small><?php echo __('Religion');?></small></label>
				    <div class="col-sm-4">
				    <?php $url = $this->Html->url(array('controller'=>'Ajaxcontents','action' => 'caste'));
                                    echo $this->Form->select('religion_id',$religionName,array('id'=>'religionId','rel'=>$url,'empty'=>__('Any'),'class'=>'form-control')); ?>
				   </div>
				    <label for="inputPassword3" class="col-sm-2 control-label"><small><?php echo __('Caste');?></small></label>
				    <div class="col-sm-4">
				    <?php   echo $this->Form->select('caste_id',$casteName,array('id'=>'casteId','empty'=>__('Any'),'class'=>'form-control')); ?>
				    </div>
		</div>
		<div class="form-group">
		<label for="inputPassword3" class="col-sm-2 control-label"><small><?php echo __('Country');?></small></label>
		    <div class="col-sm-4">
		     <?php $url = $this->Html->url(array('controller'=>'Ajaxcontents','action' => 'state'));
                             echo $this->Form->select('country_id',$countryName,array('id'=>'countryId','rel'=>$url,'empty'=>__('Any'),'class'=>'form-control')); ?>
      
		   </div>
		<label for="inputPassword3" class="col-sm-2 control-label"><small><?php echo __('State');?></small></label>
		    <div class="col-sm-4">
		      <?php $url = $this->Html->url(array('controller'=>'Ajaxcontents','action' => 'city'));
                              echo $this->Form->select('state_id',$stateName,array('id'=>'stateId','rel'=>$url,'empty'=>__('Any'),'class'=>'form-control')); ?>
	
		   </div>
		</div>
		
		<div class="form-group">
		<label for="inputPassword3" class="col-sm-2 control-label"><small><?php echo __('City');?></small></label>
		    <div class="col-sm-4">
		     <?php   echo $this->Form->select('city_id',$cityName,array('id'=>'cityId','empty'=>__('Any'),'class'=>'form-control')); ?>
		   </div>
		      
		   </div>
		
		
		   
<div class="form-group">
     <label for="inputPassword3" class="col-sm-2 control-label"><small><?php echo __('Employed');?></small></label>
    <div class="col-sm-4">
       <?php
      echo $this->Form->select('employed_id',$employedName,array('class'=>'form-control','empty'=>__('Any')));
      ?>
   </div>
    <label for="inputPassword3" class="col-sm-2 control-label"><small><?php echo __('Maritial Status');?></small></label>
    <div class="col-sm-4">
      <?php
      echo $this->Form->select('maritialstatus_id',$maritialstatusName,array('class'=>'form-control','empty'=>__('Any')));
     ?>
   </div>
</div>

<div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label"><small><?php echo __('Height');?></small></label>
    <div class="col-sm-4">
       <?php  echo $this->Form->select('height_id',$heightName,array('class'=>'form-control','empty'=>__('Any'))); ?>
   </div>
    <label for="inputPassword3" class="col-sm-2 control-label"><small><?php echo __('Habits');?></small></label>
    <div class="col-sm-4">
      <?php echo $this->Form->select('habit_id',$habitName,array('class'=>'form-control','empty'=>__('Any'))); ?>
   </div>
</div>

<div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label"><small><?php echo __('Education');?></small></label>
    <div class="col-sm-4">
       <?php echo $this->Form->select('education_id',$educationName,array('class'=>'form-control','empty'=>__('Any')));   ?>
   </div>
    <label for="inputPassword3" class="col-sm-2 control-label"><small>Occupation</small></label>
    <div class="col-sm-4">
      <?php echo $this->Form->select('occupation_id',$occupationName,array('class'=>'form-control','empty'=>__('Any')));   ?>
   </div>
   </div>


<div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label"><small><?php echo __('Manglik');?></small></label>
    <div class="col-sm-4">
       <?php $manglik=array('Yes'=>__('Yes'),'No'=>__('No'),'Does not matter'=>__('Does not matter')); echo $this->Form->select('manglik',$manglik,array('class'=>'form-control','empty'=>__('Any')));   ?>
   </div>
    <label for="inputPassword3" class="col-sm-2 control-label"><small><?php echo __('Physical Status');?></small></label>
    <div class="col-sm-4">
      <?php $physical=array('Normal'=>__('Normal'),'Disable'=>__('Disable'),'Does not matter'=>__('Does not matter')); echo $this->Form->select('physical',$physical,array('class'=>'form-control','empty'=>__('Any')));   ?>
    
   </div>
   
</div>

<div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label"><small><?php echo __('Have Children');?></small></label>
    <div class="col-sm-4">
       <?php $children=array('Yes'=>__('Yes'),'No'=>__('No'),'Does not matter'=>__('Does not matter')); echo $this->Form->select('children',$children,array('class'=>'form-control','empty'=>__('Any')));   ?>
   </div>
    <label for="inputPassword3" class="col-sm-2 control-label"><small><?php echo __('Complexion');?></small></label>
    <div class="col-sm-4">
      <?php $complexion=array('Normal'=>__('Normal'),'Fair'=>__('Fair'),'Very Fair'=>__('Very Fair'),'Wheatish'=>__('Wheatish'),'Dark'=>__('Dark')); echo $this->Form->select('complexion',$complexion,array('class'=>'form-control','empty'=>__('Any')));   ?>
    
   </div>
   </div>


<div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label"><small><?php echo __('Body Type');?></small></label>
    <div class="col-sm-4">
       <?php $bodyType=array('Slim'=>__('Slim'),'Average'=>__('Average'),'Athletic'=>__('Athletic'),'Heavy'=>__('Heavy')); echo $this->Form->select('body_type',$bodyType,array('class'=>'form-control','empty'=>__('Any')));   ?>
   </div>
    <label for="inputPassword3" class="col-sm-2 control-label"><small><?php echo __('Rashi');?></small></label>
    <div class="col-sm-4">
      <?php  echo $this->Form->select('rashy_id',$rashiName,array('class'=>'form-control','empty'=>__('Any')));   ?>
    
   </div>
   </div>

<div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label"><small><?php echo __('Mother Tongue');?></small></label>
    <div class="col-sm-4">
      <?php  echo $this->Form->select('mothertongue_id',$mothertongueName,array('class'=>'form-control','empty'=>__('Any')));   ?>
    
   </div>
   <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Family Status');?></small></label>
					    <div class="col-sm-4">
						<?php
						$familyStatus=array('Lower Class'=>__('Lower Class'),'Middle Class'=>__('Middle Class'),'Upper Middle Class'=>__('Upper Middle Class'),'Rich / Affluent'=>__('Rich / Affluent'));
						echo $this->Form->select('family_status',$familyStatus,array('div'=>false,'label'=>false,'class'=>'form-control','empty'=>__('Any')));
					      ?>
					    </div>
   </div>

		    
					<div class="form-group">
					<label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Family Value');?></small></label>
					    <div class="col-sm-4">
						<?php
						$familyValue=array('Orthodox'=>__('Orthodox'),'Traditional'=>__('Traditional'),'Moderate'=>__('Moderate'),'Liberal'=>__('Liberal'));
						echo $this->Form->select('family_value',$familyValue,array('div'=>false,'label'=>false,'class'=>'form-control','empty'=>__('Any')));
					      ?>
					    </div>
					<label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Family Type');?></small></label>
					    <div class="col-sm-4">
						<?php
						$familyType=array('Joint'=>__('Joint'),'Nuclear'=>__('Nuclear'),'Other'=>__('Other'));
						echo $this->Form->select('family_type',$familyType,array('div'=>false,'label'=>false,'class'=>'form-control','empty'=>__('Any')));
					      ?>
					    </div>
					</div>
		    
                    <div class="form-group text-left">
                        <div class="col-sm-offset-2 col-sm-7">
                            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span>&nbsp;<?php echo __('Save My Express Interest');?></button>
			    <?php if(!$isError){?><button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-remove"></span>&nbsp;<?php echo __('Cancel');?></button><?php }else{
			echo$this->Html->link('<span class="fa fa-close"></span>&nbsp;'.__('Close'),array('controller'=>'Dashboards','action'=>'index'),array('class'=>'btn btn-danger','escape'=>false));}?>
                        </div>
                    </div>
                <?php echo $this->Form->end();?>
		 <?php if($isError){?>
			</div>
<div class="clearfix"> </div>
    </div>
</div>
  </div>
</div>
<?php }else {?>
	</div>
		 </div>
		</div>
<?php }?>

<script type="text/javascript">
$(document).ready(function(){
$('#countryId').change(function() {
            var selectedValue = $(this).val();
            var targeturl = $(this).attr('rel') + '?id=' + selectedValue;
            $.ajax({
                    type: 'get',
                    url: targeturl,
                    beforeSend: function(xhr) {
                            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    },
                    success: function(response) {
                            if (response) {
                                    $('#stateId').html(response);
				    $('#cityId').html('<select><option>Select</option></select>');
                            }
                    },
                    error: function(e) {
                            
                    }
            });
    });
$('#stateId').change(function() {
            var selectedValue = $(this).val();
            var targeturl = $(this).attr('rel') + '?id=' + selectedValue;
            $.ajax({
                    type: 'get',
                    url: targeturl,
                    beforeSend: function(xhr) {
                            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    },
                    success: function(response) {
                            if (response) {
                                    $('#cityId').html(response);
                            }
                    },
                    error: function(e) {
                            
                    }
            });
    });
$('#religionId').change(function() {
            var selectedValue = $(this).val();
            var targeturl = $(this).attr('rel') + '?id=' + selectedValue;
            $.ajax({
                    type: 'get',
                    url: targeturl,
                    beforeSend: function(xhr) {
                            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    },
                    success: function(response) {
                            if (response) {
                                    $('#casteId').html(response);
                            }
                    },
                    error: function(e) {
                            
                    }
            });
    });
});
</script>    