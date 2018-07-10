<?php
$age=$ageValue[0]['age'];
if($value['Dashboard']['photo'] && $value['Dashboard']['photo_status']=='Approved')
$memberImg='member_thumb/'.$value['Dashboard']['photo'];
else
$memberImg='User.png';
$urlView=$this->Html->url(array('controller'=>'Viewprofiles'));
$urlProfile=$this->Html->url(array('controller'=>'Profiles'));
$urlTestimonial=$this->Html->url(array('controller'=>'Testimonials'));
$expressInterest=$this->Html->url(array('controller'=>'Expressinterests'));
?>
<div class="col-sm-3 about_left">
	  <div class='mrg'><a href="javascript:void(0);" onclick='show_modal("<?php echo$urlView;?>/view/<?php echo$id;?>/<?php echo$age;?>");'> <?php echo$this->Html->image($memberImg,array('class'=>'img-responsive img-thumbnail','alt' => $value['Dashboard']['name']));?></a></div>
	   <ul class="menu">
	   <div class="panel">
		<li class="item1"><h3 class="m_2"><?php echo$value['Dashboard']['name'];?></h3>
		  <ul class="cute">
		      <li class="subitem2"><?php  echo$this->Html->link('<span class="fa fa-history"></span>&nbsp;'.__('Transaction History'),array('controller'=>'Transactionhistorys','action'=>'index'),array('escape' => false));?></li>
		      <li class="subitem2"><?php echo$this->Html->link('<span class="fa fa-envelope"></span>&nbsp;'.__("Personalised Message"),array('controller'=>'Mails','action'=>'index'),array('escape' => false));?></li>
		      <li class="subitem2"><?php echo$this->Html->link('<span class="fa fa-star"></span>&nbsp;'.__("My Favourites"),array('controller'=>'Memberfavourites','action'=>'index'),array('escape' => false));?></li>
		      <li class="subitem2"><?php echo$this->Html->link('<span class="fa fa-check-square"></span>&nbsp;'.__("My Shortlist"),array('controller'=>'Membershortlists','action'=>'index'),array('escape' => false));?></li>
		      <li class="subitem1"><?php echo $this->Html->link('<span class="fa fa-edit"></span>&nbsp;'.__('My Express Interest'),'javascript:void(0);',array('onclick'=>"show_modal('$expressInterest/index');",'escape' => false));?></li>
                      <li class="subitem2"><?php  echo$this->Html->link('<span class="fa fa-user"></span>&nbsp;'.__('My Matches'),array('controller'=>'Mymatches','action'=>'index'),array('escape' => false));?></li>
                      <li class="subitem2"><?php  echo$this->Html->link('<span class="fa fa-user"></span>&nbsp;'.__('Who Viewed My Profile'),array('controller'=>'Vmyprofiles','action'=>'index'),array('escape' => false));?></li>
		      <li class="subitem1"><?php echo $this->Html->link('<span class="fa fa-edit"></span>&nbsp;'.__('Post Success Story'),'javascript:void(0);',array('onclick'=>"show_modal('$urlTestimonial/add');",'escape' => false));?></li>
		      <li class="subitem2"><?php echo $this->Html->link('<span class="fa fa-heart"></span>&nbsp;'.__('Success Stories'),array('controller' => 'Testimonials', 'action' => 'index'),array('escape' => false));?></li>
		      <li class="subitem1"><?php echo $this->Html->link('<span class="fa fa-cog"></span>&nbsp;'.__('Change Password'),'javascript:void(0);',array('onclick'=>"show_modal('$urlProfile/changePass');",'escape' => false));?></li>
                      <li class="subitem2"><?php echo $this->Html->link('<span class="fa fa-power-off"></span>&nbsp;'.__('Sign out'),array('controller' => 'Users', 'action' => 'logout'),array('escape' => false));?></li>
		  </ul>
		</li>
	  </div>
	  <div class="panel">
	  	<li class="item1"><h3 class="m_2"><?php echo __('Profile');?></h3>
		  <ul class="cute">
			<li class="subitem1"><?php  echo$this->Html->link('<span class="fa fa-arrows-alt"></span>&nbsp;'.__("View Profile"),'javascript:void(0);',array('onclick'=>"show_modal('$urlView/view/$id/$age');",'escape' => false));?></li>
			<li class="subitem1"><?php echo$this->Html->link('<span class="fa fa-edit"></span>&nbsp;'.__("Basic Profile"),'javascript:void(0);',array('onclick'=>"show_modal('$urlProfile/editProfile');",'escape' => false));?></li>
			<li class="subitem1"><?php echo$this->Html->link('<span class="fa fa-edit"></span>&nbsp;'.__("Detail Profile"),'javascript:void(0);',array('onclick'=>"show_modal('$urlProfile/editdetailprofile');",'escape' => false));?></li>
			<li class="subitem1"><?php echo$this->Html->link('<span class="fa fa-edit"></span>&nbsp;'.__("Family Profile"),'javascript:void(0);',array('onclick'=>"show_modal('$urlProfile/editmyfamilyprofile');",'escape' => false));?></li>
                       <?php if($value['Dashboard']['status']=="Active"){?><li class="subitem1"><?php echo $this->Form->postlink('<span class="fa fa-power-off"></span>&nbsp;'.__('Deactive Profile'),array('controller'=>'Dashboards','action'=>'deactive',$id),array('confirm' =>__('Do You Want to Deactive Profile ?'),'escape'=>false));?></li><?php }?>


		  </ul>
		</li>
	  </div>
	  <div class="panel">
		<li class="item1"><h3 class="m_2"><?php echo __('Photo');?></h3>
		  <ul class="cute">
			<li class="subitem2"><?php echo$this->Html->link('<span class="fa fa-picture-o"></span>&nbsp;'.__("Change Profile Photo"),'javascript:void(0);',array('onclick'=>"show_modal('$urlProfile/cprofilePhoto');",'escape' => false));?></li>
		        <li class="subitem2"><?php echo$this->Html->link('<span class="fa fa-times"></span>&nbsp;'.__("Remove Profile Photo"),'javascript:void(0);',array('onclick'=>"show_modal('$urlProfile/rprofilePhoto');",'escape' => false));?></li>
		        <li class="subitem2"><?php echo$this->Html->link('<span class="fa fa-picture-o"></span>&nbsp;'.__("Add More Photos"),'javascript:void(0);',array('onclick'=>"show_modal('$urlProfile/changePhoto');",'escape' => false));?></li>
		        <li class="subitem2"><?php echo$this->Html->link('<span class="fa fa-times"></span>&nbsp;'.__("View/Remove Photos"),'javascript:void(0);',array('onclick'=>"show_modal('$urlProfile/removePhoto');",'escape' => false));?></li>
		  </ul>
		</li>
	  </div>
	  <div class="panel">
		<li class="item1"><h3 class="m_2"><?php echo __('Search');?></h3>
		  <ul class="cute">
			<li class="subitem1"><?php  echo$this->Html->link('<span class="fa fa-search"></span>&nbsp;'.__('Quick Search'),array('controller'=>'Searches','action'=>'Quick'),array('escape' => false));?></li>
			<li class="subitem1"><?php  echo$this->Html->link('<span class="fa fa-search"></span>&nbsp;'.__('Regular Search'),array('controller'=>'Searches','action'=>'Regular'),array('escape' => false));?></li>
			<li class="subitem1"><?php  echo$this->Html->link('<span class="fa fa-search"></span>&nbsp;'.__('Advanced Search'),array('controller'=>'Searches','action'=>'Advanced'),array('escape' => false));?></li>
			<li class="subitem1"><?php  echo$this->Html->link('<span class="fa fa-search"></span>&nbsp;'.__('Profile By Id'),array('controller'=>'Searches','action'=>'Profile'),array('escape' => false));?></li>
		  </ul>
		</li>
	  </div>
	  <?php if($isChat>0){?>
	  <div class="panel">
		<li class="item1"><h3 class="m_2"><?php echo __('Chat');?></h3>
		<div class="allchat">
		    <?php $allChatUserName=null; foreach($chatMemberArr as $value):
		    if($value['Chat']['from_name']!=$userValue['Member']['user_name']){
			      $chatUserName=$value['Chat']['from_name'];			      
		    }
		    else{
			      $chatUserName=$value['Chat']['to_name'];
		    }
		    if($allChatUserName!=$chatUserName){
		    $memberArr=$this->Function->getMemberDetails($chatUserName);
		    if($memberArr['Member']['photo'] && $memberArr['Member']['photo_status']=='Approved')
		    $memberImg='member_thumb/'.$memberArr['Member']['photo'];
		    else
		    $memberImg='User.png';
		    ?>
			      <a href="javascript:void(0);" onclick="javascript:chatWith('<?php echo$chatUserName;?>');">
			      <div class="chatarea">
			      <span class="chatphoto"><?php echo$this->Html->image($memberImg,array('class'=>'img-circle responsive','height'=>35,'alt' => $chatUserName));?>
			      <span class="chatname"><?php echo$memberArr['Member']['name'];?></span>
			      </div>
			      </a>
			<?php } $allChatUserName=$chatUserName; endforeach;unset($value);unset($memberArr);?>
		</div>	
		</li>
	  </div>
	  <?php }?>
           </ul>
	  </div>