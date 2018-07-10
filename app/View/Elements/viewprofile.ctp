<div class="col-md-10"> 
							<div>

								<!-- Nav tabs -->
								<ul class="nav nav-tabs" role="tablist">
								  <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab"><?php echo __('Personal');?></a></li>
								  <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab"><?php echo __('Details');?></a></li>
								  <li role="presentation"><a href="#familyprofile" aria-controls="familyprofile" role="tab" data-toggle="tab"><?php echo __('Family Details');?></a></li>
								  <li role="presentation"><a href="#photo" aria-controls="photo" role="tab" data-toggle="tab"><?php echo __('Photos');?></a></li>
								</ul>
							      
								<!-- Tab panes -->
								<div class="tab-content">
								<div role="tabpanel" class="tab-pane active" id="home">
								<div class="table-responsive"> 
								<table class="table table-bordered">
								<tr>
								<td><strong><small class="text-primary"><?php echo __('Profile ID');?></small></strong></td>
								<td><strong><small class="text-danger"><?php echo h($post['Member']['profileId']);?></small></strong></td>								
								<td><strong><small class="text-primary"><?php echo __('User Name');?></small></strong></td>
								<td><strong><small class="text-danger"><?php echo h($post['Member']['user_name']);?></small></strong></td>								
								
								</tr>
								<tr>
								<td><strong><small class="text-primary"><?php echo __('Name');?></small></strong></td>
								<td><strong><small class="text-danger"><?php if($post['Member']['name']){ echo h($post['Member']['name']);}else{echo __('Not Specified');}?></small></strong></td>								
								<td><strong><small class="text-primary"><?php echo __('Date of Birth');?></small></strong></td>
								<td><strong><small class="text-danger"><?php  if($post['Member']['dob']==null){echo __('not specified');}else{ echo$this->Time->format($sysDay.$dateSep.$sysMonth.$dateSep.$sysYear,$post['Member']['dob']);}?></small></stromg></td>
							        </tr>
								<tr>
								<td><strong><small class="text-primary"><?php echo __('Sex');?></small></strong></td>
								<td><strong><small class="text-danger"><?php if($post['Member']['sex']){ echo h($post['Member']['sex']);}else{echo __('Not Specified');}?></small></strong></td>								
								<td><strong><small class="text-primary"><?php echo __('Phone / Mobile');?></small></strong></td>
								<td><strong><small class="text-danger"><?php if($post['Member']['phone']){ echo h($post['Member']['phone']);}else{echo __('Not Specified');}?></small></strong></td>								
								</tr>
								<tr>
								<td><strong><small class="text-primary"><?php echo __('E-Mail');?></small></strong></td>
								<td><strong><small class="text-danger"><?php if($post['Member']['email']){ echo h($post['Member']['email']);}else{echo __('Not Specified');}?></small></strong></td>								
								<td><strong><small class="text-primary"><?php echo __('Income');?></small></strong></td>
								<td><strong><small class="text-danger"><?php if($post['Member']['income']){ echo $currency.' '.h($post['Member']['income']);}else{echo __('not specified');}?></small></strong></td>								
								</tr>
								<tr>
								<td><strong><small class="text-primary"><?php echo __('Address');?></small></strong></td>
								<td><strong><small class="text-danger"><?php if($post['Member']['address']){ echo h($post['Member']['address']);}else{echo __('Not Specified');}?></small></strong></td>								
								<td><strong><small class="text-primary"><?php echo __('City');?></small></strong></td>
								<td><strong><small class="text-danger"><?php if($post['Member']['city_id']){ echo h($post['City']['name']);}else{echo __('Not Specified');}?></small></strong></td>								
								</tr>
								<tr>
								<td><strong><small class="text-primary"><?php echo __('State');?></small></strong></td>
								<td><strong><small class="text-danger"><?php if($post['State']['name']){ echo h($post['State']['name']);}else{echo __('Not Specified');}?></small></strong></td>								
								<td><strong><small class="text-primary"><?php echo __('Country');?></small></strong></td>
								<td><strong><small class="text-danger"><?php if($post['Country']['name']){ echo h($post['Country']['name']);}else{echo __('Not Specified');}?></small></strong></td>								
								</tr>
								<tr>
								<td><strong><small class="text-primary"><?php echo __('Caste');?></small></strong></td>
								<td><strong><small class="text-danger"><?php if($post['Caste']['name']){ echo h($post['Caste']['name']);}else{echo __('Not Specified');}?></small></strong></td>								
								<td><strong><small class="text-primary"><?php echo __('Religion');?></small></strong></td>
								<td><strong><small class="text-danger"><?php if($post['Religion']['name']){ echo h($post['Religion']['name']);}else{echo __('Not Specified');}?></small></strong></td>								
								</tr>
								<tr>
								<td><strong><small class="text-primary">
								<?php if($custom[0]['Sitesetting']['status']=='Enabled'){?>
								<?php echo $custom[0]['Sitesetting']['alias'];?></small></strong>
								<?php }?>
								</td>
								<td><strong><small class="text-danger">
								<?php if($custom[0]['Sitesetting']['status']=='Enabled'){?>
								<?php if($post['Member']['field1']){ echo h($post['Member']['field1']);}else{echo __('Not Specified');}?></small></strong>
								<?php }?>
								</td>								
								<td><strong><small class="text-primary">
								<?php if($custom[1]['Sitesetting']['status']=='Enabled'){?>
								<?php echo $custom[1]['Sitesetting']['alias'];?></small></strong>
								<?php }?>
								</td>
								<td><strong><small class="text-danger">
								<?php if($custom[1]['Sitesetting']['status']=='Enabled'){?>
								<?php if($post['Member']['field2']){ echo h($post['Member']['field2']);}else{echo __('Not Specified');}?></small></strong>
								<?php }?>
								</td>								
								</tr>
								<tr>
								<td><strong><small class="text-primary">
								<?php if($custom[2]['Sitesetting']['status']=='Enabled'){?>
								<?php echo $custom[2]['Sitesetting']['alias'];?></small></strong>
								<?php }?>
								</td>
								<td><strong><small class="text-danger">
								<?php if($custom[2]['Sitesetting']['status']=='Enabled'){?>
								<?php if($post['Member']['field3']){ echo h($post['Member']['field3']);}else{echo __('Not Specified');}?></small></strong>
								<?php }?>
								</td>								
								<td><strong><small class="text-primary">
								<?php if($custom[3]['Sitesetting']['status']=='Enabled'){?>
								<?php echo $custom[3]['Sitesetting']['alias'];?></small></strong>
								<?php }?>
								</td>
								<td><strong><small class="text-danger">
								<?php if($custom[3]['Sitesetting']['status']=='Enabled'){?>
								<?php if($post['Member']['field4']){ echo h($post['Member']['field4']);}else{echo __('Not Specified');}?></small></strong>
								<?php }?>
								</td>								
								</tr>
								<tr>
								<td><strong><small class="text-primary">
								<?php if($custom[4]['Sitesetting']['status']=='Enabled'){?>
								<?php echo $custom[4]['Sitesetting']['alias'];?></small></strong>
								<?php }?>
								</td>
								<td><strong><small class="text-danger">
								<?php if($custom[4]['Sitesetting']['status']=='Enabled'){?>
								<?php if($post['Member']['field5']){ echo h($post['Member']['field5']);}else{echo __('Not Specified');}?></small></strong>
								<?php }?>
								</td>								
								<td><strong><small class="text-primary">
								<?php if($custom[5]['Sitesetting']['status']=='Enabled'){?>
								<?php echo $custom[5]['Sitesetting']['alias'];?></small></strong>
								<?php }?>
								</td>
								<td><strong><small class="text-danger">
								<?php if($custom[5]['Sitesetting']['status']=='Enabled'){?>
								<?php if($post['Member']['field6']){ echo h($post['Member']['field6']);}else{echo __('Not Specified');}?></small></strong>
								<?php }?>
								</td>								
								</tr>
								<?php if($luserId==1){?>
								<tr>
								<td><strong><small class="text-primary"><?php echo __('Featured Profile');?></small></strong></td>
								<td><strong><small class="text-danger"><?php echo h($post['Member']['feature']);?></small></strong></td>								
								<td><strong><small class="text-primary"><?php echo __('Register Date');?></small></strong></td>
								<td><strong><small class="text-danger"><?php echo $this->Time->format($sysDay.$dateSep.$sysMonth.$dateSep.$sysYear.$dateGap.$sysHour.$timeSep.$sysMin.$dateGap.$sysMer,$post['Member']['created']);?></small></strong></td>								
								</tr>					
								<?php }?>
								
								<tr>
								
								<td><strong><small class="text-primary"><?php echo __('Last Login');?></small></strong></td>
								<td colspan="3"><strong><small class="text-danger"><?php if($post['Member']['last_login']==null){echo __('not specified');}else{ echo $this->Time->format($sysDay.$dateSep.$sysMonth.$dateSep.$sysYear.$dateGap.$sysHour.$timeSep.$sysMin.$dateGap.$sysMer,$post['Member']['last_login']);}?></small></strong></td>								
								</tr>
								
								</table>
					                       </div>
								  </div>
								  <div role="tabpanel" class="tab-pane" id="profile">
								  <div class="table-responsive"> 
								<table class="table table-bordered">
								<tr>
								<td><strong><small class="text-primary"><?php echo __('Education');?></small></strong></td>
								<td><strong><small class="text-danger"><?php if($post['Education']['name']){ echo h($post['Education']['name']);}else{echo __('Not Specified');}?></small></strong></td>								
								<td><strong><small class="text-primary"><?php echo __('Occupation');?></small></strong></td>
								<td><strong><small class="text-danger"><?php if($post['Occupation']['name']){ echo h($post['Occupation']['name']);}else{echo __('Not Specified');}?></small></strong></td>								
								</tr>
								<tr>
								<td><strong><small class="text-primary"><?php echo __('Height');?></small></strong></td>
								<td><strong><small class="text-danger"><?php if($post['Height']['name']){ echo h($post['Height']['name']);}else{echo __('Not Specified');}?></small></strong></td>								
								<td><strong><small class="text-primary"><?php echo __('Habbits');?></small></strong></td>
								<td><strong><small class="text-danger"><?php if($post['Habit']['name']){ echo h($post['Habit']['name']);}else{echo __('Not Specified');}?></small></strong></td>								
								</tr>
								<tr>
								<td><strong><small class="text-primary"><?php echo __('Marital Status');?></small></strong></td>
								<td><strong><small class="text-danger"><?php if($post['Maritialstatus']['name']){ echo h($post['Maritialstatus']['name']);}else{echo __('Not Specified');}?></small></strong></td>								
								<td><strong><small class="text-primary"><?php echo __('Employed');?></small></strong></td>
								<td><strong><small class="text-danger"><?php if($post['Employed']['name']){ echo h($post['Employed']['name']);}else{echo __('Not Specified');}?></small></strong></td>								
								</tr>
								<tr>
								<td><strong><small class="text-primary"><?php echo __('Maglik');?></small></strong></td>
								<td><strong><small class="text-danger"><?php if($post['Member']['manglik']){ echo h($post['Member']['manglik']);}else{echo __('Not Specified');}?></small></strong></td>								
								<td><strong><small class="text-primary"><?php echo __('Rashi');?></small></strong></td>
								<td><strong><small class="text-danger"><?php if($post['Rashy']['name']){ echo h($post['Rashy']['name']);}else{echo __('Not Specified');}?></small></strong></td>								
								</tr>
								<tr>
								<td><strong><small class="text-primary"><?php echo __('Physical Status');?></small></strong></td>
								<td><strong><small class="text-danger"><?php if($post['Member']['physical']){ echo h($post['Member']['physical']);}else{echo __('Not Specified');}?></small></strong></td>								
								<td><strong><small class="text-primary"><?php echo __('Have Children');?></small></strong></td>
								<td><strong><small class="text-danger"><?php if($post['Member']['children']){ echo h($post['Member']['children']);}else{echo __('Not Specified');}?></small></strong></td>								
								</tr>
								<tr>
								<td><strong><small class="text-primary"><?php echo __('Body Type');?></small></strong></td>
								<td><strong><small class="text-danger"><?php if($post['Member']['body_type']){ echo h($post['Member']['body_type']);}else{echo __('Not Specified');}?></small></strong></td>								
								<td><strong><small class="text-primary"><?php echo __('Birth Time');?></small></strong></td>
								<td><strong><small class="text-danger"><?php if($post['Member']['birth_time']){ echo $this->Time->format('h:i A',$post['Member']['birth_time']);}else{echo __('Not Specified');}?></small></strong></td>								
								</tr>
								<tr>
								<td><strong><small class="text-primary"><?php echo __('Mother Tongue');?></small></strong></td>
								<td><strong><small class="text-danger"><?php if($post['Mothertongue']['name']){ echo h($post['Mothertongue']['name']);}else{echo __('Not Specified');}?></small></strong></td>								
								<td><strong><small class="text-primary"><?php echo __('Birth Place');?></small></strong></td>
								<td><strong><small class="text-danger"><?php if($post['Member']['birth_place']){ echo h($post['Member']['birth_place']);}else{echo __('Not Specified');}?></small></strong></td>								
								</tr>
								</table>
					                        </div>	
								</div>
								<div role="tabpanel" class="tab-pane" id="familyprofile">
								  <div class="table-responsive"> 
								<table class="table table-bordered">
								<tr>
								<td><strong><small class="text-primary"><?php echo __('Father Occupation');?></small></strong></td>
								<td><strong><small class="text-danger"><?php if($post['Member']['father_occupation']){ echo h($post['Member']['father_occupation']);}else{echo __('Not Specified');}?></small></strong></td>								
								<td><strong><small class="text-primary"><?php echo __('Mother Occupation');?></small></strong></td>
								<td><strong><small class="text-danger"><?php if($post['Member']['mother_occupation']){ echo h($post['Member']['mother_occupation']);}else{echo __('Not Specified');}?></small></strong></td>								
								</tr>
								<tr>
								<td><strong><small class="text-primary"><?php echo __('No. of Brothers');?></small></strong></td>
								<td><strong><small class="text-danger"><?php if($post['Member']['no_of_brother']){ echo h($post['Member']['no_of_brother']);}else{echo __('Not Specified');}?></small></strong></td>								
								<td><strong><small class="text-primary"><?php echo __('No. of Sisters');?></small></strong></td>
								<td><strong><small class="text-danger"><?php if($post['Member']['no_of_sister']){ echo h($post['Member']['no_of_sister']);}else{echo __('Not Specified');}?></small></strong></td>								
								</tr>
								<tr>
								<td><strong><small class="text-primary"><?php echo __('Family Value');?></small></strong></td>
								<td><strong><small class="text-danger"><?php if($post['Member']['family_value']){ echo h($post['Member']['family_value']);}else{echo __('Not Specified');}?></small></strong></td>								
								<td><strong><small class="text-primary"><?php echo __('Family Type');?></small></strong></td>
								<td><strong><small class="text-danger"><?php if($post['Member']['family_type']){ echo h($post['Member']['family_type']);}else{echo __('Not Specified');}?></small></strong></td>								
								</tr>
								<tr>
								<td><strong><small class="text-primary"><?php echo __('Family Status');?></small></strong></td>
								<td><strong><small class="text-danger"><?php if($post['Member']['family_status']){ echo h($post['Member']['family_status']);}else{echo __('Not Specified');}?></small></strong></td>								
								<td><strong><small class="text-primary"><?php echo __('Family Origion');?></small></strong></td>
								<td><strong><small class="text-danger"><?php if($post['Member']['family_origion']){ echo h($post['Member']['family_origion']);}else{echo __('Not Specified');}?></small></strong></td>								
								</tr>
								
								</table>
					                        </div>	
								</div>
								
								<div role="tabpanel" class="tab-pane" id="photo">
								  
								<div class="col-sm-12">
								<?php if(!$postPhoto)
								       echo '<span class=text-danger>'.__('No Photo Available').'</span>';
								 foreach ($postPhoto as $value):
			                                              $memberphotoId=$value['MembersPhoto']['id'];
			                                             $memberImg='member_thumb/'.$value['MembersPhoto']['photo'];
			                                         
			                                       ?>
								<div class="col-sm-4 mrg">
								<?php echo$this->Html->image($memberImg,array('class'=>'img-responsive','width'=>'80%','height'=>'30%'));?>
								<?php echo $this->Html->Link('<span class="fa fa-trash"></span>&nbsp;'.__('Remove'),array('controller'=>'Members','action'=>'del',$memberphotoId),array('escape'=>false));?>
								<?php if($value['MembersPhoto']['photo_status']=='Pending'){ echo $this->Html->Link('<span class="fa fa-edit"></span>&nbsp;'.__('Approved'),array('controller'=>'Members','action'=>'approvedphoto',$memberphotoId),array('escape'=>false));}?>
								<?php if($value['MembersPhoto']['photo_status']=='Approved'){ echo $this->Html->Link('<span class="fa fa-remove"></span>&nbsp;'.__('Pending'),array('controller'=>'Members','action'=>'pendingphoto',$memberphotoId),array('escape'=>false));}?>
								
								</div>
								<?php endforeach; ?>
			                                        <?php unset($value); ?>
								</div>	
								</div>
								
								</div>
						       </div>
						</div>