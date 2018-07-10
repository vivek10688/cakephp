<?php
if($value['Search']['photo'])
$memberImg='member_thumb/'.$value['Search']['photo'];
else
$memberImg='User.png';?>
<table width="960" border="0" cellpadding="4" cellspacing="4">
<tr>
<td width="20%"><?php echo$this->Html->image($frontLogo,array('alt'=>$siteName,'class'=>'img-responsive'));?></td>
<td align="center"><h2><?php echo$siteName;?></h2></td>
</tr>
</table>
<table width="960" border="0" cellpadding="4" cellspacing="4">
<tr>
<td colspan="2"><h2><?php echo __('Profile Id');?> : <?php echo$value['Search']['profileId'];?></h2></td>
</tr>
<tr>
<td colspan="2">
<?php echo$this->Html->image($memberImg,array('class'=>'img-responsive','alt' => $value['Search']['name']));?>
</td>
</tr>
<tr >
<td ><strong><?php echo __('Name');?> :</strong>&nbsp;<?php if($value['Search']['name']){ echo$value['Search']['name'];}else{echo __('Not Specified');}?></td>
<td ><strong><?php echo __('Phone');?> :</strong>&nbsp;<?php if($value['Search']['phone']){echo$value['Search']['phone'];}else{echo __('Not Specified');}?></td>
</tr>
<tr >
<td ><strong><?php echo __('E-Mail');?> :</strong>&nbsp;<?php if($value['Search']['email']){echo$value['Search']['email'];}else{echo __('Not Specified');}?></td>
<td ><strong><?php echo __('Age');?> :</strong> &nbsp;<?php if($value['Search']['age']!=0){ echo$value['Search']['age'].' '.__('Yrs');}else{echo __('Not Specified');}?></td>
</tr>
<tr >
<td ><strong><?php echo __('Sex')?> :</strong>&nbsp;<?php if($value['Search']['sex']){echo$value['Search']['sex'];}else{echo __('Not Specified');}?></td>
<td ><strong><?php echo __('Height');?> :</strong>&nbsp;<?php if($value['Height']['name']){echo$value['Height']['name'];}else{echo __('Not Specified');}?></td>
</tr>
<tr >
<td ><strong><?php echo __('Religion');?> :</strong>&nbsp;<?php if($value['Religion']['name']){echo$value['Religion']['name'];}else{echo __('Not Specified');}?></td>
<td ><strong><?php echo __('Caste');?> :</strong>&nbsp;<?php if($value['Caste']['name']){echo$value['Caste']['name'];}else{echo __('Not Specified');}?></td>
</tr>
<tr >
<td colspan="2"><strong><?php echo __('Address ');?> :</strong>&nbsp;<?php if($value['Search']['address']){ echo$value['Search']['address'];}else{echo __('Not Specified');}?></td>

</tr>
<tr >
<td ><strong><?php echo __('Marital Status');?> :</strong>&nbsp;<?php if($value['Maritialstatus']['name']){echo$value['Maritialstatus']['name'];}else{echo __('Not Specified');}?></td>
<td ><strong><?php echo __('Location');?> :</strong>&nbsp;<?php if($value['Search']['city_id']){echo$value['City']['name'];}else{echo __('Not Specified');}?>,&nbsp;<?php if($value['State']['name']){echo$value['State']['name'];}else{echo __('Not Specified');}?>,&nbsp;<?php if($value['Country']['name']){echo$value['Country']['name'];}else{echo __('Not Specified');}?></td>
</tr>
<tr >
<td ><strong><?php echo __('Education');?> :</strong>&nbsp;<?php if($value['Education']['name']){echo$value['Education']['name'];}else{echo __('Not Specified');}?></span></td>
<td ><strong><?php echo __('Occupation');?> :</strong>&nbsp;<?php if($value['Occupation']['name']){echo$value['Occupation']['name'];}else{echo __('Not Specified');}?></span></td>
</tr>
<tr >
<td ><strong><?php echo __('Last Login');?> :</strong>&nbsp;<?php if($value['Search']['last_login']){ echo$this->Time->format($dtFormat,$value['Search']['last_login']);}else{echo __('Not Specified');}?></td>
<td ><strong><?php echo __('Profile Created By');?> :</strong>&nbsp;<?php if($value['Search']['profile_created']){ echo$value['Search']['profile_created'];}else{echo __('Not Specified');}?></td>
</tr>
<tr>
<td colspan="2">
				    
			   	    	<h3><?php echo __('About Me');?></h3>
				    	<p><?php if($value['Search']['about_me']){echo$value['Search']['about_me'];}else{echo __('Not Specified');}?></p>
</td>
</tr>
<tr>
<td valign="top">
				    
				    	<h3><?php echo __('Basics & Lifestyle');?></h3>
				    	<table class="table_working_hours" cellpadding="2" cellspacing="2">
				        	<tbody>
				        		<tr class="opened_1">
									<td class="day_label"><strong><?php echo __('Name');?> :</strong></td>
									<td class="day_value"><?php if($value['Search']['name']){ echo$value['Search']['name'];}else{echo __('Not Specified');}?></td>
								</tr>
							    <tr class="opened">
									<td class="day_label"><strong><?php echo __('Marital Status');?> :</strong></td>
									<td class="day_value"><?php if($value['Maritialstatus']['name']){echo$value['Maritialstatus']['name'];}else{echo __('Not Specified');}?></td>
								</tr>
							    <tr class="opened">
									<td class="day_label"><strong><?php echo __('Body Type');?> :</strong></td>
									<td class="day_value"><?php if($value['Search']['body_type']){echo$value['Search']['body_type'];}else{echo __('Not Specified');}?></td>
								</tr>
							        <tr class="opened">
									<td class="day_label"><strong><?php echo __('Age / Sex /Height');?> :</strong></td>
									<td class="day_value"><?php if($value['Search']['age']!=0){ echo$value['Search']['age'].' '.__('Yrs');}else{echo __('Not Specified');}?>, <?php if($value['Search']['sex']){echo$value['Search']['sex'];}else{echo __('Not Specified');}?> , <?php if($value['Height']['name']){echo$value['Height']['name'];}else{echo __('Not Specified');}?></td>
								</tr>
							    <tr class="opened">
									<td class="day_label"><strong><?php echo __('Physical Status');?> :</strong></td>
									<td class="day_value closed"><span><?php if($value['Search']['physical']){echo$value['Search']['physical'];}else{echo __('Not Specified');}?></span></td>
								</tr>
							    	<tr class="opened">
									<td class="day_label"><strong><?php echo __('Hobbies');?> :</strong></td>
									<td class="day_value closed"><span><?php if($value['Habit']['name']){echo$value['Habit']['name'];}else{echo __('Not Specified');}?></span></td>
								</tr>
								<?php if($custom[0]['Sitesetting']['status']=='Enabled'){?>
								<tr class="opened">
									<td class="day_label"><strong><?php echo $custom[0]['Sitesetting']['alias'];?> :</strong></td>
									<td class="day_value closed"><span><?php if($value['Search']['field1']){echo$value['Search']['field1'];}else{echo __('Not Specified');}?></span></td>
								</tr>
								<?php }?>
								<?php if($custom[1]['Sitesetting']['status']=='Enabled'){?>
								<tr class="opened">
									<td class="day_label"><strong><?php echo $custom[1]['Sitesetting']['alias'];?> :</strong></td>
									<td class="day_value closed"><span><?php if($value['Search']['field2']){echo$value['Search']['field2'];}else{echo __('Not Specified');}?></span></td>
								</tr>
								<?php }?>
								<?php if($custom[2]['Sitesetting']['status']=='Enabled'){?>
								<tr class="opened">
									<td class="day_label"><strong><?php echo $custom[2]['Sitesetting']['alias'];?> :</strong></td>
									<td class="day_value closed"><span><?php if($value['Search']['field3']){echo$value['Search']['field3'];}else{echo __('Not Specified');}?></span></td>
								</tr>
								<?php }?>
								<?php if($custom[3]['Sitesetting']['status']=='Enabled'){?>
								<tr class="opened">
									<td class="day_label"><strong><?php echo $custom[3]['Sitesetting']['alias'];?> :</strong></td>
									<td class="day_value closed"><span><?php if($value['Search']['field4']){echo$value['Search']['field4'];}else{echo __('Not Specified');}?></span></td>
								</tr>
								<?php }?>
								<?php if($custom[4]['Sitesetting']['status']=='Enabled'){?>
								<tr class="opened">
									<td class="day_label"><strong><?php echo $custom[4]['Sitesetting']['alias'];?> :</strong></td>
									<td class="day_value closed"><span><?php if($value['Search']['field5']){echo$value['Search']['field5'];}else{echo __('Not Specified');}?></span></td>
								</tr>
								<?php }?>
								<?php if($custom[5]['Sitesetting']['status']=='Enabled'){?>
								<tr class="opened">
									<td class="day_label"><strong><?php echo $custom[5]['Sitesetting']['alias'];?> :</strong></td>
									<td class="day_value closed"><span><?php if($value['Search']['field6']){echo$value['Search']['field6'];}else{echo __('Not Specified');}?></span></td>
								</tr>
								<?php }?>
						    </tbody>
				          </table>
					  
</td>

<td>
					  
				    	<h3><?php echo __('Religious / Social & Astro Background');?></h3>
				    	
				    	  <table class="table_working_hours" cellpadding="2" cellspacing="2">
				        	<tbody>
				        		<tr class="opened">
									<td class="day_label"><strong><?php echo __('Time of Birth');?> :</strong></td>
									<td class="day_value"><?php if($value['Search']['birth_time']){echo$this->Time->format('h:i A',$value['Search']['birth_time']);}else{echo __('Not Specified');}?></td>
								</tr>
				        		    <tr class="opened">
									<td class="day_label"><strong><?php echo __('Date of Birth');?> :</strong></td>
									<td class="day_value closed"><span><?php if($value['Search']['dob']){ echo$this->Time->format($dtFormat,$value['Search']['dob']);}else{echo __('Not Specified');}?></span></td>
								</tr>
							    <tr class="opened">
									<td class="day_label"><strong><?php echo __('Place of Birth');?> :</strong></td>
									<td class="day_value closed"><span><?php if($value['Search']['birth_place']){echo$value['Search']['birth_place'];}else{echo __('Not Specified');}?></span></td>
								</tr>
							
				        		<tr class="opened_1">
									<td class="day_label"><strong><?php echo __('Religion');?> :</strong></td>
									<td class="day_value"><?php if($value['Religion']['name']){echo$value['Religion']['name'];}else{echo __('Not Specified');}?></td>
								</tr>
							    <tr class="opened">
									<td class="day_label"><strong><?php echo __('Caste');?> :</strong></td>
									<td class="day_value"><?php if($value['Caste']['name']){echo$value['Caste']['name'];}else{echo __( __('Not Specified'));}?></td>
								</tr>
							<tr class="opened">
									<td class="day_label"><strong><?php echo __('Raasi');?> :</strong></td>
									<td class="day_value"><?php if($value['Rashy']['name']){echo$value['Rashy']['name'];}else{echo __( __('Not Specified'));}?></td>
								</tr>
								<tr class="opened">
								    <td class="day_label1"><strong><?php echo __('Manglik');?> :</strong></td>
								    <td class="day_value">&nbsp;<?php if($value['Search']['manglik']){echo$value['Search']['manglik'];}else{echo __( __('Not Specified'));}?></td>
								</tr>
							
				        		    <tr class="opened">
									<td class="day_label"><strong><?php echo __('Mother Tongue');?> :</strong></td>
									<td class="day_value"><?php if($value['Mothertongue']['name']){echo$value['Mothertongue']['name'];}else{echo __( __('Not Specified'));}?></td>
								</tr>
							    <tr class="opened">
									<td class="day_label"><strong><?php echo __('Complexion');?> :</strong></td>
									<td class="day_value"><?php if($value['Search']['complexion']){echo$value['Search']['complexion'];}else{echo __( __('Not Specified'));}?></td>
								</tr>
							    <tr class="opened">
									<td class="day_label"><strong><?php echo __('Children');?> :</strong></td>
									<td class="day_value"><?php if($value['Search']['children']){echo$value['Search']['children'];}else{echo __( __('Not Specified'));}?></td>
								</tr>
							    
				        </table>
</td>
<tr>
<td>
				    	<h3><?php echo __('Education & Career');?></h3>
				    	 <table class="table_working_hours" cellpadding="2" cellspacing="2">
				        	<tbody>
				        		<tr class="opened">
									<td class="day_label"><strong><?php echo __('Education');?> :</strong></td>
									<td class="day_value"><?php if($value['Education']['name']){echo$value['Education']['name'];}else{echo __( __('Not Specified'));}?></td>
								</tr>
				        		    <tr class="opened">
									<td class="day_label"><strong><?php echo __('Occupation');?> :</strong></td>
									<td class="day_value"><?php if($value['Occupation']['name']){echo$value['Occupation']['name'];}else{echo __( __('Not Specified'));}?></td>
								</tr>
							    <tr class="opened">
									<td class="day_label"><strong><?php echo __('Annual Income');?> :</strong></td>
									<td class="day_value"><?php if($value['Search']['income']){echo$currency.' '.$value['Search']['income'];}else{echo __( __('Not Specified'));}?></td>
								</tr>
							 </tbody>
				          </table>
</td>				         
<tr><td>					 
					 
					<h3><?php echo __('Family Details');?></h3>
				    	 <table class="table_working_hours" cellpadding="2" cellspacing="2">
				        	<tbody>
				        		<tr class="opened">
									<td class="day_label"><strong><?php echo __('Father Occupation');?> :</strong></td>
									<td class="day_value"><?php if($value['Search']['father_occupation']){echo$value['Search']['father_occupation'];}else{echo __( __('Not Specified'));}?></td>
								</tr>
				        		<tr class="opened">
									<td class="day_label"><strong><?php echo __('Mother Occupation');?> :</strong></td>
									<td class="day_value"><?php if($value['Search']['mother_occupation']){echo$value['Search']['mother_occupation'];}else{echo __( __('Not Specified'));}?></td>
								</tr>
							    <tr class="opened">
									<td class="day_label"><strong><?php echo __('No. of Brothers');?> :</strong></td>
									<td class="day_value closed"><span><?php if($value['Search']['no_of_brother']){echo$value['Search']['no_of_brother'];}else{echo __( __('Not Specified'));}?></span></td>
								</tr>
							    <tr class="opened">
									<td class="day_label"><strong><?php echo __('No. of Sisters');?> :</strong></td>
									<td class="day_value closed"><span><?php if($value['Search']['no_of_sister']){echo$value['Search']['no_of_sister'];}else{echo __( __('Not Specified'));}?></span></td>
								</tr>
								<tr class="opened">
									<td class="day_label"><strong><?php echo __('Family Value');?> :</strong></td>
									<td class="day_value closed"><span><?php if($value['Search']['family_value']){echo$value['Search']['family_value'];}else{echo __( __('Not Specified'));}?></span></td>
								</tr>
								<tr class="opened">
									<td class="day_label"><strong><?php echo __('Family Type');?> :</strong></td>
									<td class="day_value closed"><span><?php if($value['Search']['family_type']){echo$value['Search']['family_type'];}else{echo __( __('Not Specified'));}?></span></td>
								</tr>
								<tr class="opened">
									<td class="day_label"><strong><?php echo __('Family Status');?> :</strong></td>
									<td class="day_value closed"><span><?php if($value['Search']['family_status']){echo$value['Search']['family_status'];}else{echo __( __('Not Specified'));}?></span></td>
								</tr>
								<tr class="opened">
									<td class="day_label"><strong><?php echo __('Family Origion');?> :</strong></td>
									<td class="day_value closed"><span><?php if($value['Search']['family_origion']){echo$value['Search']['family_origion'];}else{echo __( __('Not Specified'));}?></span></td>
								</tr>
							 </tbody>
				          </table>
</td></tr>
</table>
<?php if($postPhoto){?>
<br><br><br><br>
<h3><?php echo __('More Photos');?></h3>
					  
								      <?php foreach ($postPhoto as $value):
			                                              $memberphotoId=$value['MembersPhoto']['id'];
			                                             $memberImg='member/'.$value['MembersPhoto']['photo'];
			                                         
			                                       ?>
								<div class="">
								<?php echo$this->Html->image($memberImg);?>								
								<br><br></div>
								<?php endforeach; ?>
			                                        <?php unset($value); }?>					 
<script type="text/javascript">
  setTimeout(function(){if (typeof(window.print) != 'undefined') {
    window.print();
    window.close();
}}, 1500);
</script>