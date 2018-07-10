<div <?php if(!$isError){?>class="container"<?php }?>>
    <div class="panel panel-custom mrg"><?php echo $this->Form->create('Member', array('class'=>'form-horizontal'));?>
        <div class="panel-heading"><?php echo __('Edit Members');?><?php if(!$isError){?><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button><?php }?></div>
                <div class="panel-body"><?php echo $this->Session->flash();?>
                 <?php foreach ($Member as $k=>$post): $id=$post['Member']['id'];$form_no=$k;
		 $selstate="stateName$k";$selcity="cityName$k";$selcaste="casteName$k";?>
		 <script type="text/javascript">
	    $(document).ready(function(){
	    $('#countryId<?php echo$k;?>').change(function() {
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
						$('#stateId<?php echo$k;?>').html(response);
						$('#cityId<?php echo$k;?>').html('<select><option value=""><?php echo __('Select');?></option></select>');
					}
				},
				error: function(e) {
					
				}
			});
		});
	    $('#stateId<?php echo$k;?>').change(function() {
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
						$('#cityId<?php echo$k;?>').html(response);
					}
				},
				error: function(e) {
					
				}
			});
		});
	    $('#religionId<?php echo$k;?>').change(function() {
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
						$('#casteId<?php echo$k;?>').html(response);
					}
				},
				error: function(e) {
					
				}
			});
		});
	    });
	    </script>
		 
		 
		<script type="text/javascript">
		$(document).ready(function(){        
		$('#dob<?php echo$k;?>').datetimepicker({locale:'<?php echo$configLanguage;?>',format:'<?php echo $dpFormat;?>'});
		$('#birth_time<?php echo$k;?>').datetimepicker({locale:'<?php echo$configLanguage;?>',format:'HH:mm A'});
		});
		</script>
                    <div class="panel panel-default">
                        <div class="panel-heading"><strong class="text-danger"><small><?php echo __('Form');?> <?php echo$form_no?></small></strong></div>
			<div class="panel-heading"><strong>Personal Information</strong></div>
<div class="panel-body">
<div class="form-group">
    <label for="email" class="col-sm-2 control-label"><small><?php echo __('User Name');?><span class="text-danger"> *</span></small></label>
	    <div class="col-sm-4">
		<?php echo $this->Form->input("$k.Member.user_name",array('required'=>true,'label' => false,'class'=>'form-control','placeholder'=>__('User Name'),'div'=>false));?>
	    </div>
 </div>
</div>
			
 
<div class="panel-body">
<div class="form-group">
    <label for="email" class="col-sm-2 control-label"><small><?php echo __('Email');?></small></label>
	    <div class="col-sm-4">
		<?php echo $this->Form->input("$k.Member.email",array('label' => false,'class'=>'form-control','placeholder'=>__('Email'),'div'=>false));?>
	    </div>
     <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Name');?><span class="text-danger"> *</span></small></label>
	    <div class="col-sm-4">
		<?php echo $this->Form->input("$k.Member.name",array('label' => false,'class'=>'form-control','placeholder'=>__('Name'),'div'=>false));?>
	    </div>
 </div>
</div>
 <div class="panel-body">
	<div class="form-group">
	<label for="inputPassword3" class="col-sm-2 control-label"><small><?php echo __('Income');?></small></label>
	<div class="col-sm-4">
	<?php $income=array('0-1000'=>__('0-1000'),'1000-5000'=>__('1000-5000'),'5000-10000'=>__('5000-10000'),'10000-20000'=>__('10000-20000'),'20000-30000'=>__('20000-30000'),'30000-50000'=>__('30000-50000'),'50000-100000'=>__('50000-100000'),'100000-above'=>__('100000-above'));
	echo $this->Form->select("$k.Member.income",$income,array('class'=>'form-control','empty'=>__('Select')));   ?>
       </div>
	<label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Phone');?><span class="text-danger"> *</span></small></label>
	    <div class="col-sm-4">
		<?php echo $this->Form->input("$k.Member.phone",array('type'=>'number','label' => false,'class'=>'form-control','placeholder'=>__('Phone'),'div'=>false));?>
	    </div>
	</div>
</div>
<div class="panel-body">
<div class="form-group">
      <label for="inputPassword3" class="col-sm-2 control-label"><small><?php echo __('Religion');?></small></label>
    <div class="col-sm-4">
    <?php  $url = $this->Html->url(array('controller'=>'../Ajaxcontents','action' => 'caste'));
        echo $this->Form->select("$k.Member.religion_id",$religionName,array('id'=>"religionId$k",'rel'=>$url,'class'=>'form-control','empty'=>__('Select')));  ?>
   </div>
     <label for="inputPassword3" class="col-sm-2 control-label"><small><?php echo __('Caste');?></small></label>
    <div class="col-sm-4">
      <?php  echo $this->Form->select("$k.Member.caste_id",$$selcaste,array('id'=>"casteId$k",'class'=>'form-control','empty'=>__('Select')));  ?>
   </div>
   </div>
</div>
<div class="panel-body">
<div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label"><small><?php echo __('Sex');?></small></label>
    <div class="col-sm-4">
      <?php
      $option=array('Male'=>__('Male'),'Female'=>__('Female'));
      echo $this->Form->select("$k.Member.sex",$option,array('div'=>false,'label'=>false,'class'=>'form-control','empty'=>__('Select')));
    ?>
   </div>
    <label for="inputPassword3" class="col-sm-2 control-label"><small><?php echo __('Date of Birth');?></small></label>
    <div class="col-sm-4">
      <div class="input-group date" id="dob<?php echo$k;?>">
      <?php if($post['Member']['dob']!=null){$dob=$this->Time->format($dtFormat,$post['Member']['dob']);}else{$dob=null;} echo $this->Form->input("$k.Member.dob",array('type'=>'text','value'=>$dob,'label' => false,'class'=>'form-control','div'=>false));?>
      <span class="input-group-addon"><span class="fa fa-calendar"></span></span>
	</div>
   </div>
</div>
</div>
 <div class="panel-body">
<div class="form-group">
      <label for="inputPassword3" class="col-sm-2 control-label"><small><?php echo __('Country');?></small></label>
    <div class="col-sm-4">
    <?php  $url = $this->Html->url(array('controller'=>'../Ajaxcontents','action' => 'state'));
        echo $this->Form->select("$k.Member.country_id",$countryName,array('id'=>"countryId$k",'rel'=>$url,'class'=>'form-control','empty'=>__('Select')));  ?>
   </div>
     <label for="inputPassword3" class="col-sm-2 control-label"><small><?php echo __('State');?></small></label>
    <div class="col-sm-4">
    <?php  $url = $this->Html->url(array('controller'=>'../Ajaxcontents','action' => 'city'));
        echo $this->Form->select("$k.Member.state_id",$$selstate,array('id'=>"stateId$k",'rel'=>$url,'class'=>'form-control','empty'=>__('Select')));  ?>
   </div>
   </div>
</div>
<div class="panel-body">
<div class="form-group">
<label for="inputPassword3" class="col-sm-2 control-label"><small><?php echo __('City');?></small></label>
    <div class="col-sm-4">
      <?php   echo $this->Form->select("$k.Member.city_id",$$selcity,array('id'=>"cityId$k",'class'=>'form-control','empty'=>__('Select')));  ?>
    </div>
    <label for="inputPassword3" class="col-sm-2 control-label"><small><?php echo __('Address');?></small></label>
    <div class="col-sm-4">
      <?php   echo $this->Form->input("$k.Member.address",array('div'=>false,'label'=>false,'class'=>'form-control','placeholder'=>__('Address'))); ?>
   </div>
    
</div>
</div>

<div class="panel-body">
<div class="form-group">
    <?php if($custom[0]['Sitesetting']['status']=='Enabled'){?>
    <label for="email" class="col-sm-2 control-label"><small><?php echo $custom[0]['Sitesetting']['alias'];?><span class="text-danger"></span></small></label>
	    <div class="col-sm-4">
		<?php echo $this->Form->input("$k.Member.field1",array('label' => false,'class'=>'form-control','placeholder'=>$custom[0]['Sitesetting']['alias'],'div'=>false));?>
             </div>
    <?php }?>
    <?php if($custom[1]['Sitesetting']['status']=='Enabled'){?>
     <label for="group_name" class="col-sm-2 control-label"><small><?php echo $custom[1]['Sitesetting']['alias'];?><span class="text-danger"> </span></small></label>
	<div class="col-sm-4">
	    <?php echo $this->Form->input("$k.Member.field2",array('label' => false,'class'=>'form-control','placeholder'=>$custom[1]['Sitesetting']['alias'],'div'=>false));?>
        </div>
    <?php }?>	
 </div>
</div>
<div class="panel-body">
<div class="form-group">
    <?php if($custom[2]['Sitesetting']['status']=='Enabled'){?>
    <label for="email" class="col-sm-2 control-label"><small><?php echo $custom[2]['Sitesetting']['alias'];?><span class="text-danger"></span></small></label>
	    <div class="col-sm-4">
		<?php echo $this->Form->input("$k.Member.field3",array('label' => false,'class'=>'form-control','placeholder'=>$custom[2]['Sitesetting']['alias'],'div'=>false));?>
             </div>
    <?php }?>
    <?php if($custom[3]['Sitesetting']['status']=='Enabled'){?>
     <label for="group_name" class="col-sm-2 control-label"><small><?php echo $custom[3]['Sitesetting']['alias'];?><span class="text-danger"> </span></small></label>
	<div class="col-sm-4">
	    <?php echo $this->Form->input("$k.Member.field4",array('label' => false,'class'=>'form-control','placeholder'=>$custom[3]['Sitesetting']['alias'],'div'=>false));?>
        </div>
    <?php }?>	
 </div>
</div>
<div class="panel-body">
<div class="form-group">
    <?php if($custom[4]['Sitesetting']['status']=='Enabled'){?>
    <label for="email" class="col-sm-2 control-label"><small><?php echo $custom[4]['Sitesetting']['alias'];?><span class="text-danger"></span></small></label>
	    <div class="col-sm-4">
		<?php echo $this->Form->input("$k.Member.field5",array('label' => false,'class'=>'form-control','placeholder'=>$custom[4]['Sitesetting']['alias'],'div'=>false));?>
             </div>
    <?php }?>
    <?php if($custom[5]['Sitesetting']['status']=='Enabled'){?>
     <label for="group_name" class="col-sm-2 control-label"><small><?php echo $custom[5]['Sitesetting']['alias'];?><span class="text-danger"> </span></small></label>
	<div class="col-sm-4">
	    <?php echo $this->Form->input("$k.Member.field6",array('label' => false,'class'=>'form-control','placeholder'=>$custom[5]['Sitesetting']['alias'],'div'=>false));?>
        </div>
    <?php }?>	
 </div>
</div>





 </div>
 </div>
 
<div class="panel-body">
<div class="panel panel-default">
<div class="panel-heading"><strong><?php echo __('Details');?></strong></div>
 <div class="panel-body">
<div class="form-group">
     <label for="inputPassword3" class="col-sm-2 control-label"><small><?php echo __('Employed');?></small></label>
    <div class="col-sm-4">
       <?php
      echo $this->Form->select("$k.Member.employed_id",$employedName,array('class'=>'form-control','empty'=>__('Select')));
      ?>
   </div>
    <label for="inputPassword3" class="col-sm-2 control-label"><small><?php echo __('Marital Status');?></small></label>
    <div class="col-sm-4">
      <?php
      echo $this->Form->select("$k.Member.maritialstatus_id",$maritialstatusName,array('class'=>'form-control','empty'=>__('Select')));
     ?>
   </div>
</div>
</div>
<div class="panel-body">
<div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label"><small><?php echo __('Height');?></small></label>
    <div class="col-sm-4">
       <?php  echo $this->Form->select("$k.Member.height_id",$heightName,array('class'=>'form-control','empty'=>__('Select'))); ?>
   </div>
    <label for="inputPassword3" class="col-sm-2 control-label"><small><?php echo __('Habits');?></small></label>
    <div class="col-sm-4">
      <?php echo $this->Form->select("$k.Member.habit_id",$habitName,array('class'=>'form-control','empty'=>__('Select'))); ?>
   </div>
</div>
</div>
<div class="panel-body">
<div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label"><small><?php echo __('Education');?></small></label>
    <div class="col-sm-4">
       <?php echo $this->Form->select("$k.Member.education_id",$educationName,array('class'=>'form-control','empty'=>__('Select')));   ?>
   </div>
    <label for="inputPassword3" class="col-sm-2 control-label"><small><?php echo __('Occupation');?></small></label>
    <div class="col-sm-4">
      <?php echo $this->Form->select("$k.Member.occupation_id",$occupationName,array('class'=>'form-control','empty'=>__('Select')));   ?>
   </div>
   </div>
</div>
<div class="panel-body">
<div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label"><small><?php echo __('Manglik');?></small></label>
    <div class="col-sm-4">
       <?php $manglik=array('Yes'=>__('Yes'),'No'=>__('No'),'Does not matter'=>__('Does not matter')); echo $this->Form->select("$k.Member.manglik",$manglik,array('class'=>'form-control','empty'=>__('Select')));   ?>
   </div>
    <label for="inputPassword3" class="col-sm-2 control-label"><small><?php echo __('Physical Status');?></small></label>
    <div class="col-sm-4">
      <?php $physical=array('Normal'=>__('Normal'),'Disable'=>__('Disable'),'Does not matter'=>__('Does not matter')); echo $this->Form->select("$k.Member.physical",$physical,array('class'=>'form-control','empty'=>__('Select')));   ?>
    
   </div>
   </div>
</div>
<div class="panel-body">
<div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label"><small><?php echo __('Have Children');?></small></label>
    <div class="col-sm-4">
       <?php $children=array('Yes'=>__('Yes'),'No'=>__('No'),'Does not matter'=>__('Does not matter')); echo $this->Form->select("$k.Member.children",$children,array('class'=>'form-control','empty'=>__('Select')));   ?>
   </div>
    <label for="inputPassword3" class="col-sm-2 control-label"><small><?php echo __('Complexion');?></small></label>
    <div class="col-sm-4">
      <?php $complexion=array('Normal'=>__('Normal'),'Fair'=>__('Fair'),'Very Fair'=>__('Very Fair'),'Wheatish'=>__('Wheatish'),'Dark'=>__('Dark')); echo $this->Form->select("$k.Member.complexion",$complexion,array('class'=>'form-control','empty'=>__('Select')));   ?>
    
   </div>
   </div>
</div>
<div class="panel-body">
<div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label"><small><?php echo __('Body Type');?></small></label>
    <div class="col-sm-4">
       <?php $bodyType=array('Slim'=>__('Slim'),'Average'=>__('Average'),'Athletic'=>__('Athletic'),'Heavy'=>__('Heavy')); echo $this->Form->select("$k.Member.body_type",$bodyType,array('class'=>'form-control','empty'=>__('Select')));   ?>
   </div>
    <label for="inputPassword3" class="col-sm-2 control-label"><small><?php echo __('Rashi');?></small></label>
    <div class="col-sm-4">
      <?php  echo $this->Form->select("$k.Member.rashy_id",$rashiName,array('class'=>'form-control','empty'=>__('Select')));   ?>
    
   </div>
   </div>
</div>
<div class="panel-body">
<div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label"><small><?php echo __('Birth Time');?></small></label>
    <div class="col-sm-4">
    <div class="input-group date" id="birth_time<?php echo$k;?>">
	<?php echo $this->Form->input("$k.Member.birth_time",array('type'=>'text','label' => false,'class'=>'form-control','div'=>false));?>
	<span class="input-group-addon"><span class="fa fa-calendar"></span></span>
	</div>
    </div>
    <label for="inputPassword3" class="col-sm-2 control-label"><small><?php echo __('Birth Place');?></small></label>
    <div class="col-sm-4">
      <?php  echo $this->Form->input("$k.Member.birth_place",array('div'=>false,'label'=>false,'class'=>'form-control','placeholder'=>__('Birth Place')));   ?>
   </div>
   </div>
</div>
<?php if($luserId==1){?>
<div class="panel-body">
<div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label"><small><?php echo __('Featured');?></small></label>
    <div class="col-sm-4">
      <?php echo $this->Form->select("$k.Member.feature",array("Yes"=>__('Yes'),"No"=>__('No')),array('empty'=>null,'label' => false,'class'=>'form-control','placeholder'=>'Status','div'=>false));?>
   </div>
   <label for="inputPassword3" class="col-sm-2 control-label"><small>Status</small></label>
    <div class="col-sm-4">
      <?php echo $this->Form->select("$k.Member.status",array("Active"=>__('Active'),"Pending"=>__('Pending'),"Suspend"=>__('Suspend')),array('empty'=>null,'label' => false,'class'=>'form-control','placeholder'=>'Status','div'=>false));?>
   </div>
   </div>
</div>
<?php }?>
<div class="panel-body">
<div class="form-group">

<label for="inputPassword3" class="col-sm-2 control-label"><small><?php echo __('Profile Photo Status');?></small></label>
    <div class="col-sm-4">
      <?php echo $this->Form->select("$k.Member.photo_status",array("Pending"=>__('Pending'),"Approved"=>__('Approved')),array('empty'=>null,'label' => false,'class'=>'form-control','placeholder'=>'Status','div'=>false));?>
   </div>

    <label for="inputPassword3" class="col-sm-2 control-label"><small><?php echo __('Mother Tongue');?></small></label>
    <div class="col-sm-4">
      <?php  echo $this->Form->select("$k.Member.mothertongue_id",$mothertongueName,array('class'=>'form-control','empty'=>__('Select')));   ?>
    <?php echo $this->Form->input("$k.Member.id", array('type' => 'hidden'));?>
   </div>
   </div>
</div>


<div class="panel-body">
<div class="panel panel-default">
<div class="panel-heading"><strong><?php echo __('Family Details');?></strong></div>
<div class="panel-body">
<div class="form-group">
     <label for="inputPassword3" class="col-sm-2 control-label"><small><?php echo __('Father Occupation');?></small></label>
    <div class="col-sm-4"><?php echo $this->Form->input("$k.Member.father_occupation",array('type'=>'text','label' => false,'class'=>'form-control','placeholder'=>__('Father Occupation'),'div'=>false));?>
   </div>
    <label for="inputPassword3" class="col-sm-2 control-label"><small><?php echo __('Mother Occupation');?></small></label>
    <div class="col-sm-4">
      <?php echo $this->Form->input("$k.Member.mother_occupation",array('type'=>'text','label' => false,'class'=>'form-control','placeholder'=>__('Mother Occupation'),'div'=>false));?>
   </div>
</div>
</div>
<div class="panel-body">
<div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label"><small><?php echo __('No Of Brother');?></small></label>
    <div class="col-sm-4">
       <?php echo $this->Form->input("$k.Member.no_of_brother",array('label' => false,'class'=>'form-control','placeholder'=>__('No Of Brother'),'div'=>false));?>
   </div>
    <label for="inputPassword3" class="col-sm-2 control-label"><small><?php echo __('No Of Sister');?></small></label>
    <div class="col-sm-4">
      <?php echo $this->Form->input("$k.Member.no_of_sister",array('label' => false,'class'=>'form-control','placeholder'=>__('No Of Sister'),'div'=>false));?>
   </div>
</div>
</div>
<div class="panel-body">
<div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label"><small><?php echo __('Family Value');?></small></label>
    <div class="col-sm-4">
    <?php
	     $familyValue=array('Orthodox'=>__('Orthodox'),'Traditional'=>__('Traditional'),'Moderate'=>__('Moderate'),'Liberal'=>__('Liberal'));
	    echo $this->Form->select("$k.Member.family_value",$familyValue,array('div'=>false,'label'=>false,'class'=>'form-control','empty'=>__('Select')));
    ?>
 </div>
    <label for="inputPassword3" class="col-sm-2 control-label"><small><?php echo __('Family Type');?></small></label>
    <div class="col-sm-4">
     <?php
	$familyType=array('Joint'=>__('Joint'),'Nuclear'=>__('Nuclear'),'Other'=>__('Other'));
	echo $this->Form->select("$k.Member.family_type",$familyType,array('div'=>false,'label'=>false,'class'=>'form-control','empty'=>__('Select')));
      ?>
   </div>
   </div>
</div>
<div class="panel-body">
<div class="form-group">
    <label for="inputPassword3" class="col-sm-2 control-label"><small><?php echo __('Family Status');?></small></label>
    <div class="col-sm-4">
       <?php
	$familyStatus=array('Lower Class'=>__('Lower Class'),'Middle Class'=>__('Middle Class'),'Upper Middle Class'=>__('Upper Middle Class'),'Rich / Affluent'=>__('Rich / Affluent'));
	echo $this->Form->select("$k.Member.family_status",$familyStatus,array('div'=>false,'label'=>false,'class'=>'form-control','empty'=>__('Select')));
      ?>
   </div>
    <label for="inputPassword3" class="col-sm-2 control-label"><small><?php echo __('Family Origion');?></small></label>
    <div class="col-sm-4">
      <?php echo $this->Form->input("$k.Member.family_origion",array('type'=>'text','label' => false,'class'=>'form-control','placeholder'=>__('Father Origion'),'div'=>false));?>
   </div>
   </div>
</div>
</div></div>

    <?php endforeach; ?>
    <?php unset($post); ?>
                        <div class="panel-body">
                        <div class="form-group text-left">
                        <div class="col-sm-offset-2 col-sm-7">                            
                            <?php echo$this->Form->button('<span class="fa fa-refresh"></span>&nbsp;'.__('Update'),array('class'=>'btn btn-success','escpae'=>false));?>
			    <?php if(!$isError){?><button type="button" class="btn btn-danger" data-dismiss="modal"><span class="fa fa-remove"></span>&nbsp;<?php echo __('Cancel');?></button><?php }else{
			    echo$this->Html->link('<span class="fa fa-close"></span>&nbsp;'.__('Close'),array('action'=>'index'),array('class'=>'btn btn-danger','escape'=>false));}?>
                        </div>
                    </div>
		    </div>
                <?php echo $this->Form->end();?>
        </div>
    </div>
</div>
   