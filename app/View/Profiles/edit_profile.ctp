<script type="text/javascript">
    $(document).ready(function(){        
        $('#dob').datetimepicker({locale:'<?php echo$configLanguage;?>',format:'<?php echo $dpFormat;?>'});
});
</script>

<div class="container">
	<div class="panel panel-custom mrg">
        <div class="panel-heading"><?php echo __('Edit Basic Profile');?><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></div>

		<div class="panel">
                <div class="panel-body">
                <?php echo $this->Form->create('Profile', array( 'controller' => 'Profiles', 'action' => 'editProfile','name'=>'post_req','id'=>'post_req','class'=>'form-horizontal'));?>
                     <div class="panel-body">
					<div class="form-group">
					<label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Name');?><span class="text-danger"> *</span></small></label>
					    <div class="col-sm-4">
						<?php echo $this->Form->input('name',array('type'=>'text','label' => false,'class'=>'form-control','placeholder'=>__('Phone'),'div'=>false));?>
					    </div>
					<label for="inputPassword3" class="col-sm-2 control-label"><small><?php echo __('Sex');?><span class="text-danger"> *</span></small></label>
						<div class="col-sm-4">
						<?php
						$option=array('Male'=>__('Male'),'Female'=>__('Female'));
						echo $this->Form->select('sex',$option,array('div'=>false,'label'=>false,'class'=>'form-control','empty'=>__('Select')));
					      ?>
						</div>
					</div>
		     </div>
		     <div class="panel-body">
				<div class="form-group">
				    <label for="inputPassword3" class="col-sm-2 control-label"><small><?php echo __('Address');?><span class="text-danger"> *</span></small></label>
				    <div class="col-sm-4">
				      <?php   echo $this->Form->input('address',array('div'=>false,'label'=>false,'class'=>'form-control','placeholder'=>__('Address'))); ?>
				   </div>
				    <label for="inputPassword3" class="col-sm-2 control-label"><small><?php echo __('Date of Birth');?><span class="text-danger"> *</span></small></label>
				    <div class="col-sm-4">
				      <div class="input-group date" id="dob">
				       <?php if($post['Profile']['dob']==NULL)$dob=NULL;else$dob=$this->Time->format($dtFormat,$post['Profile']['dob']);echo$this->Form->input('dob',array('type'=>'text','value'=>$dob,'label' => false,'class'=>'form-control','div'=>false));?>
			        	<span class="input-group-addon"><span class="fa fa-calendar"></span></span>
					</div>
				   </div>
				</div>
		    </div>
		    <div class="panel-body">
				<div class="form-group">
				      <label for="inputPassword3" class="col-sm-2 control-label"><small><?php echo __('Religion');?></small></label>
				    <div class="col-sm-4">
				    <?php $url = $this->Html->url(array('controller'=>'Ajaxcontents','action' => 'caste'));
                              echo $this->Form->select('religion_id',$religionName,array('id'=>'religionId','rel'=>$url,'empty'=>__('Select'),'class'=>'form-control')); ?>
				   </div>
				     <label for="inputPassword3" class="col-sm-2 control-label"><small><?php echo __('Caste');?></small></label>
				    <div class="col-sm-4">
				      <?php   echo $this->Form->select('caste_id',$casteName,array('id'=>'casteId','empty'=>__('Select'),'class'=>'form-control')); ?>
				   </div>
				   </div>
		</div>
		<div class="panel-body">
		<div class="form-group">
		      <label for="inputPassword3" class="col-sm-2 control-label"><small><?php echo __('Country');?><span class="text-danger"> *</span></small></label>
		    <div class="col-sm-4">
		<?php $url1 = $this->Html->url(array('controller'=>'Ajaxcontents','action' => 'state'));
                             echo $this->Form->select('country_id',$countryName,array('required'=>true,'id'=>'countryId','rel'=>$url1,'empty'=>__('Select'),'class'=>'form-control')); ?>
                   </div>
		   <label for="inputPassword3" class="col-sm-2 control-label"><small><?php echo __('State');?><span class="text-danger"> *</span></small></label>
		    <div class="col-sm-4">
		     <?php $url2 = $this->Html->url(array('controller'=>'Ajaxcontents','action' => 'city'));
                              echo $this->Form->select('state_id',$stateName,array('required'=>true,'id'=>'stateId','rel'=>$url2,'empty'=>__('Select'),'class'=>'form-control')); ?>
	                

		   </div>
		
		   </div>
		</div>
		<div class="panel-body">
		<div class="form-group">
		<label for="inputPassword3" class="col-sm-2 control-label"><small><?php echo __('City');?><span class="text-danger"> *</span></small></label>
		    <div class="col-sm-4">
		      <?php   echo $this->Form->select('city_id',$cityName,array('required'=>true,'id'=>'cityId','empty'=>__('Select'),'class'=>'form-control')); ?>
		   </div>
		    <label for="group_name" class="col-sm-2 control-label"><small><?php echo __('Phone');?><span class="text-danger"> *</span></small></label>
		<div class="col-sm-4">
		    <?php echo $this->Form->input('phone',array('type'=>'number','label' => false,'class'=>'form-control','placeholder'=>__('Phone'),'div'=>false));?>
		</div>
	       </div>
		</div>
		     <div class="panel-body">
					<div class="form-group">
					<label for="inputPassword3" class="col-sm-2 control-label"><small><?php echo __('About Us');?><span class="text-danger"> *</span></small></label>
				      <div class="col-sm-4">
				      <?php   echo $this->Form->input('about_me',array('div'=>false,'label'=>false,'class'=>'form-control','placeholder'=>__('About Us'))); ?>
				   </div>
					<label for="inputPassword3" class="col-sm-2 control-label"><?php echo __('Income');?></label>
					<div class="col-sm-4">
					<?php $income=array('0-1000'=>__('0-1000'),'1000-5000'=>__('1000-5000'),'5000-10000'=>__('5000-10000'),'10000-20000'=>__('10000-20000'),'20000-30000'=>__('20000-30000'),'30000-50000'=>__('30000-50000'),'50000-100000'=>__('50000-100000'),'100000-above'=>__('100000-above'));
					echo $this->Form->select('income',$income,array('class'=>'form-control','empty'=>__('Select')));   ?>
				       </div>
					
				</div></div>
				<div class="panel-body">
					<div class="form-group">
					<label for="inputPassword3" class="col-sm-2 control-label"><?php echo __('Profile Created By');?></label>
					<div class="col-sm-4">
					<?php $profileCreated=array('Self'=>__('Self'),'Parent / Guardians'=>__('Parent / Guardians'),'Sibling'=>__('Sibling'),'Friend'=>__('Friend'),'Other'=>__('Other'));
					echo $this->Form->select('profile_created',$profileCreated,array('class'=>'form-control','empty'=>__('Select')));   ?>
				       </div>
				       <?php if($custom[0]['Sitesetting']['status']=='Enabled'){?>
					<label for="inputPassword3" class="col-sm-2 control-label"><?php echo $custom[0]['Sitesetting']['alias'];?></label>
					<div class="col-sm-4">
					<?php echo $this->Form->input('field1',array('label' => false,'class'=>'form-control','placeholder'=>$custom[0]['Sitesetting']['alias'],'div'=>false));?>
                                        </div>
				       <?php }?>
				</div></div>
				<div class="panel-body">
					<div class="form-group">
					<?php if($custom[1]['Sitesetting']['status']=='Enabled'){?>
					<label for="inputPassword3" class="col-sm-2 control-label"><?php echo $custom[1]['Sitesetting']['alias'];?></label>
					<div class="col-sm-4">
					<?php echo $this->Form->input('field2',array('label' => false,'class'=>'form-control','placeholder'=>$custom[1]['Sitesetting']['alias'],'div'=>false));?>
                                        </div>
				       <?php }?>
				       <?php if($custom[2]['Sitesetting']['status']=='Enabled'){?>
					<label for="inputPassword3" class="col-sm-2 control-label"><?php echo $custom[2]['Sitesetting']['alias'];?></label>
					<div class="col-sm-4">
					<?php echo $this->Form->input('field3',array('label' => false,'class'=>'form-control','placeholder'=>$custom[2]['Sitesetting']['alias'],'div'=>false));?>
                                        </div>
				       <?php }?>
				</div></div>
				<div class="panel-body">
					<div class="form-group">
					<?php if($custom[3]['Sitesetting']['status']=='Enabled'){?>
					<label for="inputPassword3" class="col-sm-2 control-label"><?php echo $custom[3]['Sitesetting']['alias'];?></label>
					<div class="col-sm-4">
					<?php echo $this->Form->input('field4',array('label' => false,'class'=>'form-control','placeholder'=>$custom[3]['Sitesetting']['alias'],'div'=>false));?>
                                        </div>
				       <?php }?>
				       <?php if($custom[4]['Sitesetting']['status']=='Enabled'){?>
					<label for="inputPassword3" class="col-sm-2 control-label"><?php echo $custom[4]['Sitesetting']['alias'];?></label>
					<div class="col-sm-4">
					<?php echo $this->Form->input('field5',array('label' => false,'class'=>'form-control','placeholder'=>$custom[4]['Sitesetting']['alias'],'div'=>false));?>
                                        </div>
				       <?php }?>
				</div></div>
				<div class="panel-body">
					<div class="form-group">
					<?php if($custom[5]['Sitesetting']['status']=='Enabled'){?>
					<label for="inputPassword3" class="col-sm-2 control-label"><?php echo $custom[5]['Sitesetting']['alias'];?></label>
					<div class="col-sm-4">
					<?php echo $this->Form->input('field6',array('label' => false,'class'=>'form-control','placeholder'=>$custom[5]['Sitesetting']['alias'],'div'=>false));?>
                                        </div>
				       <?php }?>
				</div></div>
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