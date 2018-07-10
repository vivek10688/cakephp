<?php
echo $this->Html->css('/design700/css/colorbox.css');
echo $this->Html->script('/design700/js/jquery.colorbox-min.js');?>
<script type="text/javascript">
$(document).ready(function(){
	$(".photogallery").colorbox({rel:'photogallery', slideshow:true});
	});
</script>
<?php if($id ==$value['Viewprofile']['id'] ||  $viewed==1){?>
<script type="text/javascript">
$(document).ready(function(){
	$('#error').hide();
	});
</script>
<?php }?>


<?php $url=$this->Html->url(array('controller'=>'Viewprofiles','action'=>'contact',$value['Viewprofile']['id']));?>
<script type="text/javascript">
$(document).ready(function(){
	$('#error').hide();
	$('#showcontact').click(function(){
	    $.ajax({
                    type: 'get',
                    url: '<?php echo$url;?>',
					beforeSend: function(xhr) {
                            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    },
                    success: function(response) {
                            if (response==0) {
					$('#view').hide();
                                 $('#error').show();
				 $('#show').show();
                            }
			    else{
					$('#chatbtn').prop( "disabled", false );
					$('#chatbtn').removeClass('btn');
					$('#chatbtn').addClass('vertical');
					$('#messagebtn').removeClass('btn disabled');
					$('#messagebtn').addClass('vertical');
					$('#showcontact').hide();
					var obj = JSON.parse(response);
					$('#contact').html(obj['Member']['phone']);
					$('#contact1').html(obj['Member']['email']);
					$('#contact2').html(obj['Member']['address']);
			    }
                    },
                    error: function(e) {
                            
                    }
            });
	    });
	});
</script>
<div class="container" id='error'>
	<div class="panel panel-custom mrg">
        <div class="panel-heading"><?php echo __('View Profile');?><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></div>
		<div class="panel-body">
		<div class="alert alert-<?php echo (isset($alert)? $alert : 'danger' ) ?>">
			<button type="button" class="close" data-dismiss="alert">x</button>
			<center><?php echo 'Please purchase the plan.'; ?></center>
			</div>
		<div class="col-sm-offset-5">
		<ul class="nav navbar-nav nav_1"><li><?php  echo$this->Html->link('<span class="fa fa-briefcase text-danger"></span>&nbsp;'.__('<span class="text-danger"><strong>'.__('Plans').'</strong></span>'),array('controller'=>'Plans','action'=>'index'),array('escape' => false));?>
		</li></ul>
		</div>
		</div>
	</div>
</div>


<?php if($flag){?>
<div class="container" id='view'>
	<div class="panel panel-custom mrg">
        <div class="panel-heading"><?php echo __('View Profile');?><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></div>
		<div class="panel-body"><?php echo $this->Session->flash();?>
   	 <div class="col-md-12 profile_left">
   	 	<h2><?php echo __('Profile Id');?> : <?php if($value['Viewprofile']['profileId']){ echo$value['Viewprofile']['profileId'];}else{ echo __('Not Specified');} ?></h2>
   	 	<div class="col_3">
   	        <div class="col-sm-4 row_2">
				<div class="">
					<?php
					$targetImageUrl=str_replace("Index.php","app/webroot",$this->Html->url(array('controller'=>'img','action'=>'member',$value['Viewprofile']['photo'])));
					$photoImageUrl=str_replace("Index.php","app/webroot",$this->Html->url(array('controller'=>'img','action'=>'member_thumb',$value['Viewprofile']['photo'])));
					$memberImg=null;
					if($value['Viewprofile']['photo'] && $value['Viewprofile']['photo_status']=='Approved'){
						$memberImg='member_thumb/'.$value['Viewprofile']['photo'];
						if(strchr($url,"Index.php")){
							echo'<a href="'.$targetImageUrl.'" class="photogallery"><img src="'.$photoImageUrl.'" width="100" class="img-thumbnail"></a>';	
						}
						else{							
							echo$this->Html->link($this->Html->image($memberImg,array('width'=>100,'class'=>'img-thumbnail')),$targetImageUrl,array('class'=>'photogallery','escape'=>false));
						}					
					}
					else{
						$memberImg='User.png';
						echo$this->Html->image($memberImg,array('width'=>100,'class'=>'img-thumbnail'));
					
					}
					foreach($photoArr as $valuePhoto):
					$targetImageUrl1=str_replace("Index.php","app/webroot",$this->Html->url(array('controller'=>'img','action'=>'member',$valuePhoto['MembersPhoto']['photo'])));
					$photoImageUrl1=str_replace("Index.php","app/webroot",$this->Html->url(array('controller'=>'img','action'=>'member_thumb',$valuePhoto['MembersPhoto']['photo'])));
					$memberImgThumb1=$this->Html->url(array('controller'=>'img','action'=>'member_thumb',$valuePhoto['MembersPhoto']['photo']));
					if($valuePhoto['MembersPhoto']['photo'] && $valuePhoto['MembersPhoto']['photo_status']=='Approved'){
			                  $memberImg1='member_thumb/'.$valuePhoto['MembersPhoto']['photo'];
			                  $video='img/member/'.$valuePhoto['MembersPhoto']['photo'];
					  if(strchr($url,"Index.php")){						
						echo'<a href="'.$targetImageUrl1.'" class="photogallery"><img src="'.$photoImageUrl1.'" width="100" class="img-thumbnail"></a>';
					  }
					  else{
						echo$this->Html->link($this->Html->image($memberImg1,array('width'=>100,'class'=>'img-thumbnail')),array('controller'=>'img','action'=>'member',$valuePhoto['MembersPhoto']['photo']),array('class'=>'photogallery','escape'=>false));
					  }
					
			                 }
			                 else{
				            $memberImg1='User.png';
					    echo$this->Html->image($memberImg1,array('width'=>100,'class'=>'img-thumbnail'));
			                  }
					endforeach;unset($valuePhoto);?>
					<br/>
					<?php if($this->Session->check('Member') && $value['Viewprofile']['id']!=$memberId){?>
					<?php echo$this->Function->favouriteMember($value['Viewprofile']['id']);?><br/><br/>
					<?php echo$this->Function->shortlistMember($value['Viewprofile']['id']);?><br/><br/>
					<?php if($viewed==1){
						echo$this->Html->link('<span class="fa fa-envelope"></span>&nbsp;'.__("Send Message").'&nbsp;&nbsp;&nbsp;',array('controller'=>'Mails','action'=>'compose','new',$value['Viewprofile']['user_name']),array('id'=>'messagebtn','class'=>'vertical','escape' => false,'title'=>$value['Viewprofile']['name'],'target'=>'_blank'));?><br/><br/>
						<?php if($isChat>0){?><button type="button" id="chatbtn" class='vertical' onclick="javascript:chatWithCustom('<?php echo$value['Viewprofile']['user_name'];?>');"><span class="fa fa-weixin"></span>&nbsp;<?php echo __('Chat With %s',$value['Viewprofile']['user_name']);?></button><?php }?>
						<?php }else{echo$this->Html->link('<span class="fa fa-envelope"></span>&nbsp;'.__("Send Message").'&nbsp;&nbsp;&nbsp;',array('controller'=>'Mails','action'=>'compose','new',$value['Viewprofile']['user_name']),array('id'=>'messagebtn','class'=>'btn disabled','escape' => false,'title'=>$value['Viewprofile']['name'],'target'=>'_blank'));?><br/><br/>
						<?php if($isChat>0){?><button type="button" id="chatbtn" disabled="disabled" class='btn' onclick="javascript:chatWithCustom('<?php echo$value['Viewprofile']['user_name'];?>');"><span class="fa fa-weixin"></span>&nbsp;<?php echo __('Chat With %s',$value['Viewprofile']['user_name']);?></button><?php }}?>
						<?php  }else{?>
					<?php }?>
					</div>
			</div>
			<div class="col-sm-8 row_1">
				<table class="table_working_hours">
		        	<tbody>
				<tr class="opened_1">
							<td class="day_label"><?php echo __('Name');?></td>
							<td class="day_value"><?php if($value['Viewprofile']['name']){ echo$value['Viewprofile']['name'];}else{echo __('Not Specified');}?></td>
						</tr>
						<tr class="opened_1" >
							<td class="day_label"><?php echo __('Phone'); ?></td>
							<td class="day_value" >
							<div id="contact">
							<?php
							if($viewed==1 || $value['Viewprofile']['id']==$memberId){
									if($value['Viewprofile']['phone']){
										echo$value['Viewprofile']['phone'];
									}
									else{
										echo __('Not Specified');
									}
							}
							else{
								echo __('xxxxxxxxxx');
								echo'&nbsp;&nbsp;'.$this->Form->button(__('Show Contact'),array('type'=>'button','id'=>'showcontact','class'=>'btn btn-sm'));
							}
							?>
							</div>
							</td>
						</tr>
				<tr class="opened_1">
							<td class="day_label"><?php echo __('E-Mail');?></td>
							<td class="day_value">
							<div id="contact1">
							<?php
							if($viewed==1 || $value['Viewprofile']['id']==$memberId){
									if($value['Viewprofile']['email']){
										echo$value['Viewprofile']['email'];
									}
									else{
										echo __('Not Specified');
									}
							}
							else{
								echo __('xxxxxxxxxx');
							}
							?>
							</div>
							</td>
						</tr>
		        		<tr class="opened_1">
							<td class="day_label"><?php echo __('Age');?></td>
							<td class="day_value"><?php if($age!=0){echo$age.' '.__('Yrs');}else{echo __('Not Specified');}?></td>
						</tr>
						<tr class="opened_1">
							<td class="day_label"><?php echo __('Sex')?></td>
							<td class="day_value"><?php if($value['Viewprofile']['sex']){echo$value['Viewprofile']['sex'];}else{echo __('Not Specified');}?></td>
						</tr>
					<tr class="opened_1">
							<td class="day_label"><?php echo __('Height');?></td>
							<td class="day_value"><?php if($value['Height']['name']){echo$value['Height']['name'];}else{echo __('Not Specified');}?></td>
						</tr>
					    <tr class="opened">
						<td class="day_label1"><?php echo __('Religion');?></td>
						<td class="day_value">&nbsp;<?php if($value['Religion']['name']){echo$value['Religion']['name'];}else{echo __('Not Specified');}?></td>
					    </tr>
				            <tr class="opened">
						<td class="day_label1"><?php echo __('Caste');?></td>
						<td class="day_value">&nbsp;<?php if($value['Caste']['name']){echo$value['Caste']['name'];}else{echo __('Not Specified');}?></td>
					    </tr>
					    <tr class="opened">
							<td class="day_label"><?php echo __('Marital Status');?></td>
							<td class="day_value"><?php if($value['Maritialstatus']['name']){echo$value['Maritialstatus']['name'];}else{echo __('Not Specified');}?></td>
						</tr>
						<tr class="opened">
							<td class="day_label"><?php echo __('Address');?></td>
							<td class="day_value">
							<div id="contact2">
								<?php if($viewed==1 || $value['Viewprofile']['id']==$memberId){
									if($value['Viewprofile']['address']){
										echo$value['Viewprofile']['address'];
									}
									else{
										echo __('Not Specified');
									}
							}
							else{
								echo __('xxxxxxxxxx');
							}
							?>
							</div>
							</td>
						</tr>
					    <tr class="opened">
							<td class="day_label"><?php echo __('Location');?></td>
							<td class="day_value"><?php if($value['Viewprofile']['city_id']){echo$value['City']['name'];}else{echo __('Not Specified');}?>,&nbsp;<?php if($value['State']['name']){echo$value['State']['name'];}else{echo __('Not Specified');}?>,&nbsp;<?php if($value['Country']['name']){echo$value['Country']['name'];}else{echo __('Not Specified');}?></td>
						</tr>
					    <tr class="closed">
							<td class="day_label"><?php echo __('Education');?></td>
							<td class="day_value closed"><span><?php if($value['Education']['name']){echo$value['Education']['name'];}else{echo __('Not Specified');}?></span></td>
						</tr>
						<tr class="closed">
							<td class="day_label"><?php echo __('Occupation');?></td>
							<td class="day_value closed"><span><?php if($value['Occupation']['name']){echo$value['Occupation']['name'];}else{echo __('Not Specified');}?></span></td>
						</tr>
						<tr class="opened">
							<td class="day_label"><?php echo __('Last Login');?></td>
							<td class="day_value"><?php if($value['Viewprofile']['last_login']){ echo$this->Time->format($dtFormat,$value['Viewprofile']['last_login']);}else{echo __('Not Specified');}?></td>
						</tr>
						<tr class="opened">
							<td class="day_label"><?php echo __('Profile Created By');?></td>
							<td class="day_value"><?php if($value['Viewprofile']['profile_created']){ echo$value['Viewprofile']['profile_created'];}else{echo __('Not Specified');}?></td>
						</tr>
				    </tbody>
				</table>
			</div>
			<div class="clearfix"> </div>
		</div>
		<div class="col_4">
		    <div class="bs-example bs-example-tabs" role="tabpanel" data-example-id="togglable-tabs">
			   <ul id="myTab" class="nav nav-tabs nav-tabs1" role="tablist">
				  <li role="presentation" class="active"><a href="#home" id="home-tab" role="tab" data-toggle="tab" aria-controls="home" aria-expanded="true"><?php echo __('About Myself');?></a></li>
				  <li role="presentation"><a href="#profile" role="tab" id="profile-tab" data-toggle="tab" aria-controls="profile"><?php echo __('Family Details');?></a></li>
			   </ul>
			   <div id="myTabContent" class="tab-content">
				  <div role="tabpanel" class="tab-pane fade in active" id="home" aria-labelledby="home-tab">
				    <div class="tab_box">
				    	<h1><?php echo __('About Me');?></h1>
				    	<p><?php if($value['Viewprofile']['about_me']){echo$value['Viewprofile']['about_me'];}else{echo __('Not Specified');}?></p>
				    </div>
				    <div class="basic_1">
				    	<h3><?php echo __('Basics & Lifestyle');?></h3>
				    	<div class="col-md-6 basic_1-left">
				    	  <table class="table_working_hours">
				        	<tbody>
				        		<tr class="opened_1">
									<td class="day_label"><?php echo __('Name');?> :</td>
									<td class="day_value"><?php if($value['Viewprofile']['name']){ echo$value['Viewprofile']['name'];}else{echo __('Not Specified');}?></td>
								</tr>
							    <tr class="opened">
									<td class="day_label"><?php echo __('Marital Status');?> :</td>
									<td class="day_value"><?php if($value['Maritialstatus']['name']){echo$value['Maritialstatus']['name'];}else{echo __('Not Specified');}?></td>
								</tr>
							    <tr class="opened">
									<td class="day_label"><?php echo __('Body Type');?> :</td>
									<td class="day_value"><?php if($value['Viewprofile']['body_type']){echo$value['Viewprofile']['body_type'];}else{echo __('Not Specified');}?></td>
								</tr>
							        <tr class="opened">
									<td class="day_label"><?php echo __('Age / Sex /Height');?> :</td>
									<td class="day_value"><?php if($age!=0){ echo$age.' '.__('Yrs');}else{echo __('Not Specified');}?>, <?php if($value['Viewprofile']['sex']){echo$value['Viewprofile']['sex'];}else{echo'Not Specified';}?> , <?php if($value['Height']['name']){echo$value['Height']['name'];}else{echo'Not Specified';}?></td>
								</tr>
							    <tr class="opened">
									<td class="day_label"><?php echo __('Physical Status');?> :</td>
									<td class="day_value closed"><span><?php if($value['Viewprofile']['physical']){echo$value['Viewprofile']['physical'];}else{echo __('Not Specified');}?></span></td>
								</tr>
							    	<tr class="opened">
									<td class="day_label"><?php echo __('Hobbies');?> :</td>
									<td class="day_value closed"><span><?php if($value['Habit']['name']){echo$value['Habit']['name'];}else{echo __('Not Specified');}?></span></td>
								</tr>
								<?php if($custom[0]['Sitesetting']['status']=='Enabled'){?>
								<tr class="opened">
									<td class="day_label"><?php echo $custom[0]['Sitesetting']['alias'];?> :</td>
									<td class="day_value closed"><span><?php if($value['Viewprofile']['field1']){echo$value['Viewprofile']['field1'];}else{echo __('Not Specified');}?></span></td>
								</tr>
								<?php }?>
								<?php if($custom[1]['Sitesetting']['status']=='Enabled'){?>
								<tr class="opened">
									<td class="day_label"><?php echo $custom[1]['Sitesetting']['alias'];?> :</td>
									<td class="day_value closed"><span><?php if($value['Viewprofile']['field2']){echo$value['Viewprofile']['field2'];}else{echo __('Not Specified');}?></span></td>
								</tr>
								<?php }?>
								<?php if($custom[2]['Sitesetting']['status']=='Enabled'){?>
								<tr class="opened">
									<td class="day_label"><?php echo $custom[2]['Sitesetting']['alias'];?> :</td>
									<td class="day_value closed"><span><?php if($value['Viewprofile']['field3']){echo$value['Viewprofile']['field3'];}else{echo __('Not Specified');}?></span></td>
								</tr>
								<?php }?>
								<?php if($custom[3]['Sitesetting']['status']=='Enabled'){?>
								<tr class="opened">
									<td class="day_label"><?php echo $custom[3]['Sitesetting']['alias'];?> :</td>
									<td class="day_value closed"><span><?php if($value['Viewprofile']['field4']){echo$value['Viewprofile']['field4'];}else{echo __('Not Specified');}?></span></td>
								</tr>
								<?php }?>
								<?php if($custom[4]['Sitesetting']['status']=='Enabled'){?>
								<tr class="opened">
									<td class="day_label"><?php echo $custom[4]['Sitesetting']['alias'];?> :</td>
									<td class="day_value closed"><span><?php if($value['Viewprofile']['field5']){echo$value['Viewprofile']['field5'];}else{echo __('Not Specified');}?></span></td>
								</tr>
								<?php }?>
								<?php if($custom[5]['Sitesetting']['status']=='Enabled'){?>
								<tr class="opened">
									<td class="day_label"><?php echo $custom[5]['Sitesetting']['alias'];?> :</td>
									<td class="day_value closed"><span><?php if($value['Viewprofile']['field6']){echo$value['Viewprofile']['field6'];}else{echo __('Not Specified');}?></span></td>
								</tr>
								<?php }?>
						    </tbody>
				          </table>
				         </div>
				         <div class="col-md-6 basic_1-left">
				          <table class="table_working_hours">
				        	<tbody>
				        		    <tr class="opened">
									<td class="day_label"><?php echo __('Mother Tongue');?> :</td>
									<td class="day_value"><?php if($value['Mothertongue']['name']){echo$value['Mothertongue']['name'];}else{echo __('Not Specified');}?></td>
								</tr>
							    <tr class="opened">
									<td class="day_label"><?php echo __('Complexion');?> :</td>
									<td class="day_value"><?php if($value['Viewprofile']['complexion']){echo$value['Viewprofile']['complexion'];}else{echo __('Not Specified');}?></td>
								</tr>
							    <tr class="opened">
									<td class="day_label"><?php echo __('Children');?> :</td>
									<td class="day_value"><?php if($value['Viewprofile']['children']){echo$value['Viewprofile']['children'];}else{echo __('Not Specified');}?></td>
								</tr>
							    
				        </table>
				        </div>
				        <div class="clearfix"> </div>
				    </div>
				    <div class="basic_1">
				    	<h3><?php echo __('Religious / Social & Astro Background');?></h3>
				    	<div class="col-md-6 basic_1-left">
				    	  <table class="table_working_hours">
				        	<tbody>
				        		<tr class="opened">
									<td class="day_label"><?php echo __('Time of Birth');?> :</td>
									<td class="day_value"><?php if($value['Viewprofile']['birth_time']){echo$this->Time->format('h:i A',$value['Viewprofile']['birth_time']);}else{echo __('Not Specified');}?></td>
								</tr>
				        		    <tr class="opened">
									<td class="day_label"><?php echo __('Date of Birth');?> :</td>
									<td class="day_value closed"><span><?php if($value['Viewprofile']['dob']){ echo$this->Time->format($dtFormat,$value['Viewprofile']['dob']);}else{echo __('Not Specified');}?></span></td>
								</tr>
							    <tr class="opened">
									<td class="day_label"><?php echo __('Place of Birth');?> :</td>
									<td class="day_value closed"><span><?php if($value['Viewprofile']['birth_place']){echo$value['Viewprofile']['birth_place'];}else{echo __('Not Specified');}?></span></td>
								</tr>
							 </tbody>
				          </table>
				         </div>
				         <div class="col-md-6 basic_1-left">
				          <table class="table_working_hours">
				        	<tbody>
				        		<tr class="opened_1">
									<td class="day_label"><?php echo __('Religion');?> :</td>
									<td class="day_value"><?php if($value['Religion']['name']){echo$value['Religion']['name'];}else{echo __('Not Specified');}?></td>
								</tr>
							    <tr class="opened">
									<td class="day_label"><?php echo __('Caste');?> :</td>
									<td class="day_value"><?php if($value['Caste']['name']){echo$value['Caste']['name'];}else{echo __('Not Specified');}?></td>
								</tr>
							<tr class="opened">
									<td class="day_label"><?php echo __('Raasi');?> :</td>
									<td class="day_value"><?php if($value['Rashy']['name']){echo$value['Rashy']['name'];}else{echo __('Not Specified');}?></td>
								</tr>
								<tr class="opened">
								    <td class="day_label1"><?php echo __('Manglik');?> :</td>
								    <td class="day_value">&nbsp;<?php if($value['Viewprofile']['manglik']){echo$value['Viewprofile']['manglik'];}else{echo __('Not Specified');}?></td>
								</tr>
							</tbody>
				        </table>
				        </div>
				        <div class="clearfix"> </div>
				    </div>
				    <div class="basic_1 basic_2">
				    	<h3><?php echo __('Education & Career');?></h3>
					<div class="col-md-6 basic_1-left">
				    	  <table class="table_working_hours">
				        	<tbody>
				        		<tr class="opened">
									<td class="day_label"><?php echo __('Education');?> :</td>
									<td class="day_value"><?php if($value['Education']['name']){echo$value['Education']['name'];}else{echo __('Not Specified');}?></td>
								</tr>
				        		    <tr class="opened">
									<td class="day_label"><?php echo __('Occupation');?> :</td>
									<td class="day_value"><?php if($value['Occupation']['name']){echo$value['Occupation']['name'];}else{echo __('Not Specified');}?></td>
								</tr>
							    <tr class="opened">
									<td class="day_label"><?php echo __('Annual Income');?> :</td>
									<td class="day_value"><?php if($value['Viewprofile']['income']){echo$currency.' '.$value['Viewprofile']['income'];}else{echo __('Not Specified');}?></td>
								</tr>
							 </tbody>
				          </table>
				         </div>
				         <div class="clearfix"> </div>
				    </div>
				  </div>
				  <div role="tabpanel" class="tab-pane fade" id="profile" aria-labelledby="profile-tab">
				    <div class="basic_3">
				    	<h4><?php echo __('Family Details');?></h4>
				    	<div class="basic_1 basic_2">
				    	<h3><?php echo __('Basics');?></h3>
				    	<div class="col-md-6 basic_1-left">
				    	  <table class="table_working_hours">
				        	<tbody>
				        		<tr class="opened">
									<td class="day_label"><?php echo ('Father Occupation');?> :</td>
									<td class="day_value"><?php if($value['Viewprofile']['father_occupation']){echo$value['Viewprofile']['father_occupation'];}else{echo __('Not Specified');}?></td>
								</tr>
				        		<tr class="opened">
									<td class="day_label"><?php echo __('Mother Occupation');?> :</td>
									<td class="day_value"><?php if($value['Viewprofile']['mother_occupation']){echo$value['Viewprofile']['mother_occupation'];}else{echo __('Not Specified');}?></td>
								</tr>
							    <tr class="opened">
									<td class="day_label"><?php echo __('No. of Brothers');?> :</td>
									<td class="day_value closed"><span><?php if($value['Viewprofile']['no_of_brother']){echo$value['Viewprofile']['no_of_brother'];}else{echo __('Not Specified');}?></span></td>
								</tr>
							    <tr class="opened">
									<td class="day_label"><?php echo __('No. of Sisters');?> :</td>
									<td class="day_value closed"><span><?php if($value['Viewprofile']['no_of_sister']){echo$value['Viewprofile']['no_of_sister'];}else{echo __('Not Specified');}?></span></td>
								</tr>
								<tr class="opened">
									<td class="day_label"><?php echo __('Family Value');?> :</td>
									<td class="day_value closed"><span><?php if($value['Viewprofile']['family_value']){echo$value['Viewprofile']['family_value'];}else{echo __('Not Specified');}?></span></td>
								</tr>
								<tr class="opened">
									<td class="day_label"><?php echo __('Family Type');?> :</td>
									<td class="day_value closed"><span><?php if($value['Viewprofile']['family_type']){echo$value['Viewprofile']['family_type'];}else{echo __('Not Specified');}?></span></td>
								</tr>
								<tr class="opened">
									<td class="day_label"><?php echo __('Family Status');?> :</td>
									<td class="day_value closed"><span><?php if($value['Viewprofile']['family_status']){echo$value['Viewprofile']['family_status'];}else{echo __('Not Specified');}?></span></td>
								</tr>
								<tr class="opened">
									<td class="day_label"><?php echo __('Family Origion');?> :</td>
									<td class="day_value closed"><span><?php if($value['Viewprofile']['family_origion']){echo$value['Viewprofile']['family_origion'];}else{echo __('Not Specified');}?></span></td>
								</tr>
							 </tbody>
				          </table>
				         </div>
				       </div>
				    </div>
				 </div>
		     </div>
		  </div>
	   </div>
   	 </div>
</div>
	</div>
</div>
<script>
// Can also be used with $(document).ready()
  setTimeout(function(){
  $('.flexslider').flexslider({
    animation: "slide",
    controlNav: "thumbnails"
  });
  }, 300);
</script>   
<?php }else{?>
<div class="container">
	<div class="panel panel-custom mrg">
        <div class="panel-heading"><?php echo __('View Profile');?><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></div>
		<div class="panel-body"><?php echo $this->Session->flash();?>
		<div class="col-sm-offset-5">
		<ul class="nav navbar-nav nav_1"><li><?php  echo$this->Html->link('<span class="fa fa-briefcase text-danger"></span>&nbsp;'.__('<span class="text-danger"><strong>'.__('Plans').'</strong></span>'),array('controller'=>'Plans','action'=>'index'),array('escape' => false));?>
		</li></ul>
		</div>
		</div>
	</div>
</div>
<?php }?>
<script type="text/javascript">
	function chatWithCustom(id)
	{
		$('#targetModal').modal('hide');
		chatWith(id);
	}
</script>