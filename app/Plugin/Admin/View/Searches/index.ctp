<div class="page-title"> <div class="title-env"> <h1 class="title"><?php echo __('Search');?></h1></div></div>
<div class="panel">
<div class="panel-body">
  <?php  echo $this->Form->create('Search', array( 'controller' => 'Searches', 'action' => 'regularsearch','class'=>'form-horizontal'));?>
		  <div class="form-group">
                        <label for="group_name" class="col-sm-3 control-label"><span class="text-danger"><strong><?php echo __('Profile ID');?></strong></span></label>
                        <div class="col-sm-5">
                           <?php  echo $this->Form->input('profileId',array('type'=>'text','div'=>false,'label'=>false,'class'=>'form-control','placeholder'=>__('Profile ID')));?>
	                </div>
                   </div>
		   <div class="form-group">
                        <label for="group_name" class="col-sm-3 control-label"><span class="text-danger"><strong><?php echo __('Gender');?></strong></span></label>
                        <div class="col-sm-5">
                           <div class="radio-inline">
			   <?php $sex=array('Male'=>__('Male'),'Female'=>__('Female'));?>
			   <?php echo $this->Form->radio('sex',$sex,array('checked'=>true,'legend'=>false,'hiddenField'=>false,'separator'=> '</div><div class="radio-inline">',
												'label'=>array('class'=>'radio-inline')));?>
			   </div>
	                </div>
                   </div>
		   <div class="form-group">
                        <label for="group_name" class="col-sm-3 control-label"><span class="text-danger"><strong><?php echo __('Marital Status');?></strong></span></label>
                        <div class="col-sm-5">
                           <?php   echo $this->Form->select('maritialstatus_id',$maritialstatus,array('empty'=>__('Any'),'class'=>'form-control')); ?>
	                </div>
                   </div>
                  <div class="form-group">
                        <label for="group_name" class="col-sm-3 control-label"><span class="text-danger"><strong><?php echo __('Have Children');?></strong></span></label>
                        <div class="col-sm-5">
                           <div class="radio-inline">
			   <?php $haveChildren=array('Yes'=>__('Yes'),'No'=>__('No'),'Does not matter'=>__('Does not matter'));?>
			      <?php echo $this->Form->radio('have_children',$haveChildren,array('checked'=>true,'legend'=>false,'hiddenField'=>false,'separator'=> '</div><div class="radio-inline">',
												   'label'=>array('class'=>'radio-inline')));?>
			   </div>
	             </div>
                   </div>
		   <div class="form-group">
                        <label for="group_name" class="col-sm-3 control-label"><span class="text-danger"><strong><?php echo __('Habbits');?></strong></span></label>
                        <div class="col-sm-5">
                           <?php   echo $this->Form->select('habit_id',$habitName,array('empty'=>__('Any'),'class'=>'form-control')); ?>
	                </div>
                   </div>
		   <div class="form-group">
                        <label for="group_name" class="col-sm-3 control-label"><span class="text-danger"><strong><?php echo __('Physical Status');?></strong></span></label>
                        <div class="col-sm-5">
                           <div class="radio-inline">
			   <?php $physicalStatus=array('Normal'=>__('Normal'),'Disable'=>__('Disable'),'Does not matter'=>__('Does not matter'));?>
			      <?php echo $this->Form->radio('physical_status',$physicalStatus,array('checked'=>true,'legend'=>false,'hiddenField'=>false,'separator'=> '</div><div class="radio-inline">',
												   'label'=>array('class'=>'radio-inline')));?>
			   </div>
	             </div>
                   </div>
		   <div class="form-group">
                        <label for="group_name" class="col-sm-3 control-label"><span class="text-danger"><strong><?php echo __('Country');?></strong></span></label>
                        <div class="col-sm-5">
			<?php $url = $this->Html->url(array('controller'=>'../Ajaxcontents','action' => 'state'));
                             echo $this->Form->select('country_id',$country,array('id'=>'countryId','rel'=>$url,'empty'=>__('Any'),'class'=>'form-control')); ?>
	                </div>
                   </div>
		   <div class="form-group">
                        <label for="group_name" class="col-sm-3 control-label"><span class="text-danger"><strong><?php echo __('State');?></strong></span></label>
                        <div class="col-sm-5">
			<?php $url = $this->Html->url(array('controller'=>'../Ajaxcontents','action' => 'city'));
                              echo $this->Form->select('state_id',$stateName,array('id'=>'stateId','rel'=>$url,'empty'=>__('Any'),'class'=>'form-control')); ?>
	                </div>
                   </div>
		   <div class="form-group">
                        <label for="group_name" class="col-sm-3 control-label"><span class="text-danger"><strong><?php echo __('City');?></strong></span></label>
                        <div class="col-sm-5">
			<?php   echo $this->Form->select('city_id',$cityName,array('id'=>'cityId','empty'=>__('Any'),'class'=>'form-control')); ?>
	                </div>
                   </div>
		   
		   <div class="form-group">
                        <label for="group_name" class="col-sm-3 control-label"><span class="text-danger"><strong><?php echo __('Religion');?></strong></span></label>
                        <div class="col-sm-5">
			<?php $url = $this->Html->url(array('controller'=>'../Ajaxcontents','action' => 'caste'));
                              echo $this->Form->select('religion_id',$religionName,array('id'=>'religionId','rel'=>$url,'empty'=>__('Any'),'class'=>'form-control')); ?>
	                </div>
                   </div>
		   <div class="form-group">
                        <label for="group_name" class="col-sm-3 control-label"><span class="text-danger"><strong><?php echo __('Caste / Division');?></strong></span></label>
                        <div class="col-sm-5">
                           <?php   echo $this->Form->select('caste_id',$casteName,array('id'=>'casteId','empty'=>__('Any'),'class'=>'form-control')); ?>
	                </div>
                   </div>
		   <div class="form-group">
                        <label for="group_name" class="col-sm-3 control-label"><span class="text-danger"><strong><?php echo __('Mother Tongue');?></strong></span></label>
                        <div class="col-sm-5">
                           <?php   echo $this->Form->select('mothertongue_id',$mothertongueName,array('empty'=>__('Any'),'class'=>'form-control')); ?>
	                </div>
                   </div>
		   <div class="form-group">
                        <label for="group_name" class="col-sm-3 control-label"><span class="text-danger"><strong><?php echo __('Manglik');?></strong></span></label>
                        <div class="col-sm-5">
                           <div class="radio-inline">
			   <?php $manglik=array('Yes'=>__('Yes'),'No'=>__('No'),'Does not matter'=>__('Does not matter'));?>
			      <?php echo $this->Form->radio('manglik',$manglik,array('checked'=>true,'legend'=>false,'hiddenField'=>false,'separator'=> '</div><div class="radio-inline">',
												   'label'=>array('class'=>'radio-inline')));?>
			   </div>
			   
	                </div>
                   </div>
		   <div class="form-group">
                        <label for="group_name" class="col-sm-3 control-label"><span class="text-danger"><strong><?php echo __('Education');?></strong></span></label>
                        <div class="col-sm-5">
                           <?php   echo $this->Form->select('education_id',$educationName,array('empty'=>__('Any'),'class'=>'form-control')); ?>
	                </div>
                   </div>
		   <div class="form-group">
                        <label for="group_name" class="col-sm-3 control-label"><span class="text-danger"><strong><?php echo __('Occupation');?></strong></span></label>
                        <div class="col-sm-5">
                           <?php   echo $this->Form->select('occupation_id',$occupationName,array('empty'=>__('Any'),'class'=>'form-control')); ?>
	                </div>
                   </div>
		   <div class="form-group">
                        <label for="group_name" class="col-sm-3 control-label"><span class="text-danger"><strong><?php echo __('Employed');?></strong></span></label>
                        <div class="col-sm-5">
                           <?php   echo $this->Form->select('employed_id',$employedName,array('empty'=>__('Any'),'class'=>'form-control')); ?>
	                </div>
                   </div>
		   <div class="form-group">
                        <label for="group_name" class="col-sm-3 control-label"><span class="text-danger"><strong><?php echo __('Show Profile');?></strong></span></label>
                        <div class="col-sm-5">
			<label>
			     <?php echo $this->Form->checkbox('photo',array('checked'=>'checked','value'=>'1','label' => false,'class'=>'radio_1','div'=>false));?>
				 <?php echo __('with Photo');?> &nbsp;&nbsp;</label>
			      <label><?php echo $this->Form->checkbox('rashi',array('value'=>'1','label' => false,'class'=>'radio_1','div'=>false));?>
				<?php echo __('with Horoscope');?></label>
                          
	                </div>
                   </div>
		   <div class="form-group">
                        <label for="group_name" class="col-sm-3 control-label"><span class="text-danger"><strong><?php echo __('Age');?></strong></span></label>
                        <div class="col-sm-2">
                           <?php for($i=18;$i<=100;$i++){
			      $ageFrom[$i]=$i;
			    } ?>
			   <?php   echo $this->Form->select('age_from',$ageFrom,array('class'=>'form-control has-dark-background','empty'=>__('From'),'class'=>'form-control')); ?>
			</div>
			<div class="col-sm-2">
			   <?php for($i=18;$i<=100;$i++){
			   $ageTo[$i]=$i;
			 } ?>
			<?php   echo $this->Form->select('age_to',$ageTo,array('class'=>'form-control has-dark-background','empty'=>__('To'),'class'=>'form-control')); ?>
			</div>
                   </div>
		   <div class="form-group text-left">
                        <div class="col-sm-offset-3 col-sm-7">
                            <?php echo$this->Form->button('<span class="fa fa-search"></span>&nbsp;'.__('Search'),array('class'=>'btn btn-success','escpae'=>false));?>
			 </div>
                    </div>
                <?php echo $this->Form->end();?>
                </div>
            </div>
		   
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