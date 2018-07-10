
<div class="grid_3">
  <div class="container">
   <div class="breadcrumb1">
     <ul>
        <?php echo$this->Html->link('<i class="fa fa-home home_1"></i>&nbsp;',array('controller'=>'pages'),array('escape'=>false));?>
        <span class="divider">&nbsp;|&nbsp;</span>
        <li class="current-page"><?php echo __('Dashboard');?></li>
     </ul>
   </div><?php echo $this->Session->flash();?>
   <div class="about">
   	  <?php echo$this->element('menunavigation');?>
   	  <div class="col-md-9 about_right">
   	  	<div class="panel">
		   <div class="panel-heading">
				<span class="text-danger"><strong><?php echo __('Basic').' '.__('Details');?></strong></span></div>
				<ul class="menu">
				<li class="item1"><h3 class="m_2"><?php echo __('Profile ID');?> / <?php echo __('Name');?> / <?php echo __('Username');?> / <?php echo __('Last Login');?></h3>
				<ul class="cute">
				      <li class="subitem1"><a href="#"><?php if($value['Dashboard']['profileId']){ echo$value['Dashboard']['profileId'];}else{ echo __('Not specified');}?> , <?php if($value['Dashboard']['name']){ echo$value['Dashboard']['name'];}else{ echo __('Not specified');}?> , <?php if($value['Dashboard']['user_name']){echo$value['Dashboard']['user_name'];}else{echo __('Not specified');}?> , <?php if($value['Dashboard']['last_login']){echo$this->Time->format($dtFormat,$value['Dashboard']['last_login']);}else{echo __('Not specified');}?></a></li>
				</ul>
			      </li>
		      
				<li class="item1"><h3 class="m_2"><?php echo __('E-Mail');?> / <?php echo __('Phone');?></h3>
				<ul class="cute">
				      <li class="subitem1"><a href="#"><?php if($value['Dashboard']['email']){echo$value['Dashboard']['email'];}else{echo __('Not specified');}?> , <?php if($value['Dashboard']['phone']){ echo$value['Dashboard']['phone'];}else{echo __('Not specified');}?></a></li>
				</ul>
			      </li>
			      <li class="item1"><h3 class="m_2"><?php echo __('Date of Birth');?> / <?php echo __('Sex');?> / <?php echo __('Height');?></h3>
				<ul class="cute">
				      <li class="subitem1"><a href="#"><?php if($value['Dashboard']['dob']){echo$this->Time->format($dtFormat,$value['Dashboard']['dob']);}else{echo __('Not Specified');}?>, <?php if($value['Dashboard']['sex']){echo$value['Dashboard']['sex'];}else{echo __('Not Specified');}?> , <?php if($value['Height']['name']){echo$value['Height']['name'];}else{echo __('Not Specified');}?> </a></li>
				</ul>
			      </li>
				<li class="item1"><h3 class="m_2"><?php echo __('Address');?></h3>
				<ul class="cute">
				      <li class="subitem1"><a href="#"><?php if($value['Dashboard']['address']){ echo$value['Dashboard']['address'];}else{echo __('Not specified');}?></a></li>
				</ul>
			      </li>
			      <li class="item1"><h3 class="m_2"><?php echo __('Annual Income');?></h3>
				<ul class="cute">
				      <li class="subitem1"><a href="#"><?php if($value['Dashboard']['income']){echo$currency.' '.$value['Dashboard']['income'];}else{echo __('Not specified');}?></a></li>
				</ul>
			      </li>
			      <li class="item1"><h3 class="m_2"><?php echo __('Mother Tongue');?></h3>
		  <ul class="cute">
			<li class="subitem1"><a href="#"><?php if($value['Mothertongue']['name']){echo$value['Mothertongue']['name'];}else{echo __('Not specified');}?></a></li>
		  </ul>
		</li>
		<li class="item1"><h3 class="m_2"><?php echo __('Education');?></h3>
		  <ul class="cute">
			<li class="subitem1"><a href="#"><?php if($value['Education']['name']){echo$value['Education']['name'];}else{echo __('Not specified');}?></a></li>
		  </ul>
		</li>
		<li class="item1"><h3 class="m_2"><?php echo __('Occupation');?></h3>
		  <ul class="cute">
			<li class="subitem1"><a href="#"><?php if($value['Occupation']['name']){echo$value['Occupation']['name'];}else{echo __('Not specified');}?></a></li>
		  </ul>
		</li>
		<li class="item1"><h3 class="m_2"><?php echo __('Physical Status');?></h3>
		  <ul class="cute">
			<li class="subitem1"><a href="#"><?php if($value['Dashboard']['physical']){echo$value['Dashboard']['physical'];}else{echo __('Not specified');}?></a></li>
		  </ul>
		</li>
		<li class="item1"><h3 class="m_2"><?php echo __('Eating Habits');?></h3>
		  <ul class="cute">
			<li class="subitem1"><a href="#"><?php if($value['Habit']['name']){echo$value['Habit']['name'];}else{echo __('Not specified');}?></a></li>
		  </ul>
		</li>
		<li class="item1"><h3 class="m_2"><?php echo __('Location (City / State / Coumtry)');?></h3>
		  <ul class="cute">
			<li class="subitem1"><a href="#"><?php if($value['Dashboard']['city_id']){echo$value['City']['name'];}else{echo __('Not Specified');}?>,&nbsp;<?php if($value['State']['name']){echo$value['State']['name'];}else{echo __('Not Specified');}?>,&nbsp;<?php if($value['Country']['name']){echo$value['Country']['name'];}else{echo __('Not Specified');}?></a></li>
		  </ul>
		</li>
		<li class="item1"><h3 class="m_2"><?php echo __('Religion / Caste / Rashi / Manglik');?></h3>
		  <ul class="cute">
			<li class="subitem1"><a href="#"><?php if($value['Religion']['name']){echo$value['Religion']['name'];}else{echo __('Not Specified');}?>,&nbsp;<?php if($value['Caste']['name']){echo$value['Caste']['name'];}else{echo __('Not Specified');}?>,&nbsp;<?php if($value['Rashy']['name']){echo$value['Rashy']['name'];}else{echo __('Not Specified');}?>,<?php if($value['Dashboard']['manglik']){echo$value['Dashboard']['manglik'];}else{echo __('Not specified');}?></a></li>
		  </ul>
		</li>
		<?php if($custom[0]['Sitesetting']['status']=='Enabled'){?>
		<li class="item1"><h3 class="m_2"><?php  echo $custom[0]['Sitesetting']['alias'];?></h3>
		  <ul class="cute">
			<li class="subitem1"><a href="#"><?php if($value['Dashboard']['field1']){ echo$value['Dashboard']['field1'];}else{echo __('Not Specified');}?> </a></li>
		  </ul>
		</li>
		<?php }?>
		<?php if($custom[1]['Sitesetting']['status']=='Enabled'){?>
		<li class="item1"><h3 class="m_2"><?php echo $custom[1]['Sitesetting']['alias'];?></h3>
		  <ul class="cute">
			<li class="subitem1"><a href="#"><?php if($value['Dashboard']['field2']){ echo$value['Dashboard']['field2'];}else{echo __('Not Specified');}?> </a></li>
		  </ul>
		</li>
		<?php }?>
		<?php if($custom[2]['Sitesetting']['status']=='Enabled'){?>
		<li class="item1"><h3 class="m_2"><?php echo $custom[2]['Sitesetting']['alias'];?></h3>
		  <ul class="cute">
			<li class="subitem1"><a href="#"><?php if($value['Dashboard']['field3']){ echo$value['Dashboard']['field3'];}else{echo __('Not Specified');}?> </a></li>
		  </ul>
		</li>
		<?php }?>
		<?php if($custom[3]['Sitesetting']['status']=='Enabled'){?>
		<li class="item1"><h3 class="m_2"><?php echo $custom[3]['Sitesetting']['alias'];?></h3>
		  <ul class="cute">
			<li class="subitem1"><a href="#"><?php if($value['Dashboard']['field4']){ echo$value['Dashboard']['field4'];}else{echo __('Not Specified');}?> </a></li>
		  </ul>
		</li>
		<?php }?>
		<?php if($custom[4]['Sitesetting']['status']=='Enabled'){?>
		<li class="item1"><h3 class="m_2"><?php echo $custom[4]['Sitesetting']['alias'];?></h3>
		  <ul class="cute">
			<li class="subitem1"><a href="#"><?php if($value['Dashboard']['field5']){ echo$value['Dashboard']['field5'];}else{echo __('Not Specified');}?> </a></li>
		  </ul>
		</li>
		<?php }?><?php if($custom[5]['Sitesetting']['status']=='Enabled'){?>
		<li class="item1"><h3 class="m_2"><?php echo $custom[5]['Sitesetting']['alias'];?></h3>
		  <ul class="cute">
			<li class="subitem1"><a href="#"><?php if($value['Dashboard']['field6']){ echo$value['Dashboard']['field6'];}else{echo __('Not Specified');}?> </a></li>
		  </ul>
		</li>
		<?php }?>
		<li class="item1"><h3 class="m_2"><?php echo __('Profile Created by');?></h3>
		  <ul class="cute">
			<li class="subitem1"><a href="#"><?php echo$value['Dashboard']['profile_created'];?> </a></li>
		  </ul>
		</li>
		</ul>
		<h1>About us</h1>
   	  	<p><?php if($value['Dashboard']['about_me']){echo$value['Dashboard']['about_me'];}else{echo'Not Specified';}?></p>
   	  		
				
				
				
				
				</div>
				<p><!-- /.collapse --></p>
			</div>
			
		</div>
   	  </div>
   	  <div class="clearfix"> </div>
   </div>
  </div>
</div>