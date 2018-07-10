<div class="grid_3">
  <div class="container">
   <div class="breadcrumb1">
   <ul>
        <?php echo$this->Html->link('<i class="fa fa-home home_1"></i>&nbsp;',array('controller'=>'/'),array('escape'=>false));?>
        <span class="divider">&nbsp;|&nbsp;</span>
        <li class="current-page"><?php echo$name;?> <?php echo __('Search');?></li>
     </ul>
   </div>
   <div class="col-sm-12">
   <?php   if($this->Session->check('Member')){?>
    <?php echo $this->element('menunavigation');?>
   <?php }?>
   <div class="col-md-6 search_left">
  <?php  echo $this->Form->create('Viewprofile', array( 'controller' => 'Viewprofiles', 'action' => 'index'));?>
  <?php if($name=='Profile'){?>
  <div class="form_but1">
		<label class="col-sm-3 control-lable1" for="sex"><?php echo __('Profile ID');?> : </label>
		<div class="col-sm-9">
		  <div class="input-group1">
		  <?php  echo $this->Form->input('profileId',array('required'=>true,'type'=>'text','div'=>false,'label'=>false,'class'=>'form-control','placeholder'=>__('Profile ID')));   ?>
	       
	      </div>
	    </div>
		<div class="clearfix"> </div>
	 </div>
  <?php }?>
   <?php if($name=='Quick' || $name=='Regular' || $name=='Advanced'){?>
   <div class="form_but1">
	<label class="col-sm-3 control-lable1" for="sex"><?php echo __('Gender');?> : </label>
	<div class="col-sm-9 form_radios">
	<div class="select-block1">
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
	<div class="clearfix"> </div>
  </div>
  <?php }?>
  <?php if($name=='Regular' || $name=='Advanced'){?>
  <div class="form_but1">
    <label class="col-sm-3 control-lable1" for="sex"><?php echo __('Marital Status');?> : </label>
    <div class="col-sm-9 form_radios">
      <div class="select-block1">
        <?php   echo $this->Form->select('maritialstatus_id',$maritialstatus,array('empty'=>__('Any'))); ?>
      </div>
    </div>
    <div class="clearfix"> </div>
  </div>
  <?php }?>
  <?php if($name=='Advanced'){?>
  <div class="form_but1">
    <label class="col-sm-3 control-lable1" for="sex"><?php echo __('Have Children');?> : </label>
    <div class="col-sm-9 form_radios">
      <div class="select-block1">
      <div class="radio-inline">
      <?php $haveChildren=array('Yes'=>__('Yes'),'No'=>__('No'),'Does not matter'=>__('Does not matter'));?>
	 <?php echo $this->Form->radio('have_children',$haveChildren,array('checked'=>true,'legend'=>false,'hiddenField'=>false,'separator'=> '</div><div class="radio-inline">',
									      'label'=>array('class'=>'radio-inline')));?>
      </div> 
      </div>
      </div>
    <div class="clearfix"> </div>
  </div>  
  <?php }?>
  <?php if($name=='Advanced'){?>
  <div class="form_but1">
    <label class="col-sm-3 control-lable1" for="sex"><?php echo __('Habbits');?> : </label>
    <div class="col-sm-9 form_radios">
      <div class="select-block1">
        <?php   echo $this->Form->select('habit_id',$habitName,array('empty'=>__('Any'))); ?>
      </div>
    </div>
    <div class="clearfix"> </div>
  </div>
  <?php }?>
  <?php if($name=='Advanced'){?>
  <div class="form_but1">
    <label class="col-sm-3 control-lable1" for="sex"><?php echo __('Physical Status');?> : </label>
    <div class="col-sm-9 form_radios">
      <div class="select-block1">
      <div class="radio-inline">
      <?php $physicalStatus=array('Normal'=>__('Normal'),'Disable'=>__('Disable'),'Does not matter'=>__('Does not matter'));?>
	 <?php echo $this->Form->radio('physical_status',$physicalStatus,array('checked'=>true,'legend'=>false,'hiddenField'=>false,'separator'=> '</div><div class="radio-inline">',
									      'label'=>array('class'=>'radio-inline')));?>
      </div>
      </div>
    </div>
    <div class="clearfix"> </div>
  </div>
  <?php }?>
  <?php if($name=='Advanced'){?>
  <div class="form_but1">
    <label class="col-sm-3 control-lable1" for="sex"><?php echo __('Country');?> : </label>
    <div class="col-sm-9 form_radios">
      <div class="select-block1">
      <?php $url = $this->Html->url(array('controller'=>'Ajaxcontents','action' => 'state'));
                             echo $this->Form->select('country_id',$country,array('id'=>'countryId','rel'=>$url,'empty'=>__('Any'),'class'=>'form-control')); ?>
      </div>
    </div>
    <div class="clearfix"> </div>
  </div>
  <?php }?>
  <?php if($name=='Advanced'){?>
  <div class="form_but1">
    <label class="col-sm-3 control-lable1" for="sex"><?php echo __('State');?> : </label>
    <div class="col-sm-9 form_radios">
      <div class="select-block1">
      <?php $url = $this->Html->url(array('controller'=>'Ajaxcontents','action' => 'city'));
                              echo $this->Form->select('state_id',$stateName,array('id'=>'stateId','rel'=>$url,'empty'=>__('Any'),'class'=>'form-control')); ?>
	                
    </div>
    </div>
    <div class="clearfix"> </div>
  </div>
  <?php }?>
  <?php if($name=='Advanced'){?>
  <div class="form_but1">
    <label class="col-sm-3 control-lable1" for="sex"><?php echo __('City');?> : </label>
    <div class="col-sm-9 form_radios">
      <div class="select-block1">
      <?php   echo $this->Form->select('city_id',$cityName,array('id'=>'cityId','empty'=>__('Any'),'class'=>'form-control')); ?>                
    </div>
    </div>
    <div class="clearfix"> </div>
  </div>
  <?php }?>
  
  <?php if($name=='Quick' || $name=='Regular' || $name=='Advanced'){?>
  <div class="form_but1">
    <label class="col-sm-3 control-lable1" for="sex"><?php echo __('Religion');?> : </label>
    <div class="col-sm-9 form_radios">
      <div class="select-block1">
      <?php $url = $this->Html->url(array('controller'=>'Ajaxcontents','action' => 'caste'));
                              echo $this->Form->select('religion_id',$religionName,array('id'=>'religionId','rel'=>$url,'empty'=>__('Any'),'class'=>'form-control')); ?>
	                
        
      </div>
    </div>
    <div class="clearfix"> </div>
  </div>
  <?php }?>
  <?php if($name=='Regular' || $name=='Advanced'){?>
  <div class="form_but1">
    <label class="col-sm-3 control-lable1" for="sex"><?php echo __('Caste / Division');?> : </label>
    <div class="col-sm-9 form_radios">
      <div class="select-block1">
        <?php   echo $this->Form->select('caste_id',$casteName,array('id'=>'casteId','empty'=>__('Any'),'class'=>'form-control')); ?>
      </div>
    </div>
    <div class="clearfix"> </div>
  </div>
  <?php }?>
  <?php if($name=='Quick' || $name=='Regular' || $name=='Advanced'){?>
  <div class="form_but1">
    <label class="col-sm-3 control-lable1" for="sex"><?php echo __('Mother Tongue');?> : </label>
    <div class="col-sm-9 form_radios">
      <div class="select-block1">
        <?php   echo $this->Form->select('mothertongue_id',$mothertongueName,array('empty'=>__('Any'))); ?>
      </div>
    </div>
    <div class="clearfix"> </div>
  </div>
  <?php }?>
  <?php if($name=='Regular' || $name=='Advanced'){?>
  <div class="form_but1">
    <label class="col-sm-3 control-lable1" for="sex"><?php echo __('Manglik');?> : </label>
    <div class="col-sm-9 form_radios">
      <div class="select-block1">
      <div class="radio-inline">
      <?php $manglik=array('Yes'=>__('Yes'),'No'=>__('No'),'Does not matter'=>__('Does not matter'));?>
	 <?php echo $this->Form->radio('manglik',$manglik,array('checked'=>true,'legend'=>false,'hiddenField'=>false,'separator'=> '</div><div class="radio-inline">',
									      'label'=>array('class'=>'radio-inline')));?>
      </div>
      </div>
    </div>
    <div class="clearfix"> </div>
  </div>
  <?php }?>
  <?php if($name=='Regular' || $name=='Advanced'){?>
  <div class="form_but1">
    <label class="col-sm-3 control-lable1" for="sex"><?php echo __('Education');?> : </label>
    <div class="col-sm-9 form_radios">
      <div class="select-block1">
        <?php   echo $this->Form->select('education_id',$educationName,array('empty'=>__('Any'))); ?>
      </div>
    </div>
    <div class="clearfix"> </div>
  </div>
  <?php }?>
  <?php if($name=='Advanced'){?>
  <div class="form_but1">
    <label class="col-sm-3 control-lable1" for="sex"><?php echo __('Occupation');?> : </label>
    <div class="col-sm-9 form_radios">
      <div class="select-block1">
        <?php   echo $this->Form->select('occupation_id',$occupationName,array('empty'=>__('Any'))); ?>
      </div>
    </div>
    <div class="clearfix"> </div>
  </div>
  <?php }?>
  <?php if($name=='Advanced'){?>
  <div class="form_but1">
    <label class="col-sm-3 control-lable1" for="sex"><?php echo __('Employed');?> : </label>
    <div class="col-sm-9 form_radios">
      <div class="select-block1">
        <?php   echo $this->Form->select('employed_id',$employedName,array('empty'=>__('Any'))); ?>
      </div>
    </div>
    <div class="clearfix"> </div>
  </div>
  <?php }?>
  <?php if($name!='Profile'){?>
  <div class="form_but1">
	<label class="col-sm-3 control-lable1" for="sex"><?php echo __('Show Profile');?> : </label>
	<div class="col-sm-9 form_radios">
	<label>
 <?php echo $this->Form->checkbox('photo',array('checked'=>'checked','value'=>'1','label' => false,'class'=>'radio_1','div'=>false));?>
 <?php echo ('with Photo');?> &nbsp;&nbsp;</label>
	<label><?php echo $this->Form->checkbox('rashi',array('value'=>'1','label' => false,'class'=>'radio_1','div'=>false));?>
 <?php echo __('with Horoscope');?></label>
	</div>
	<div class="clearfix"> </div>
  </div>
 <?php }?>
<?php if($name=='Quick' || $name=='Regular' || $name=='Advanced'){?>  
  <div class="form_but1">
	<label class="col-sm-3 control-lable1" for="sex"><?php echo __('Age');?> : </label>
	<div class="col-sm-9 form_radios">
	  <div class="col-sm-5 input-group1">
        <?php for($i=18;$i<=100;$i++){
		   $ageFrom[$i]=$i;
		 } ?>
		<?php   echo $this->Form->select('age_from',$ageFrom,array('class'=>'form-control has-dark-background','empty'=>__('From'))); ?>
		
      </div>
      <div class="col-sm-5 input-group1">
       <?php for($i=18;$i<=100;$i++){
		   $ageTo[$i]=$i;
		 } ?>
		<?php   echo $this->Form->select('age_to',$ageTo,array('class'=>'form-control has-dark-background','empty'=>__('To'))); ?>
      </div>
	</div>
  </div>
<?php }?>      
      <div class="col-sm-offset-3 col-sm-5 input-group1">
       <input   type="submit" value="<?php echo __('Find Matches');?>">
      </div>
      <div class="clearfix"> </div>
	<div class="clearfix"> </div>
 <?php echo$this->Form->end();?>
    <div class="clearfix"> </div>
  </div>
<div class="col-md-3">
<?php echo$this->Html->image('search.png',array('class'=>'img-responsive'));?>
</div>
</div>
</div></div>
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