<?php
 $this->Js->JqueryEngine->jQueryObject = 'jQuery';
// Paginator options
$this->Paginator->options(array(
  'update' => '#resultDiv',
  'evalScripts' => true,
));
?>
<div id="resultDiv"> 

<div id="resultDiv">
<div class="grid_3">
  <div class="container"><?php echo $this->Session->flash();?>
   <div class="breadcrumb1">
     <ul>
     <?php echo$this->Html->link('<i class="fa fa-home home_1"></i>&nbsp;',array('controller'=>'pages'),array('escape'=>false));?>
        <span class="divider">&nbsp;|&nbsp;</span>
        <li class="current-page"><?php echo __('Who Viewed My Profile');?></li>
     </ul>
   </div>
   <div class="services">
	     <?php echo $this->Session->flash();?>
   	    <div class="col-sm-12 login_left">
	    
	    <?php echo $this->Session->flash();?>
   
   <div class="services">
   <div class="col-sm-12">
   
	    <?php echo$this->element('menunavigation');?>
	   
   
   <div class="col-sm-9">
   <?php if(!$post){?><h3><span class="text-danger"><strong><?php echo __('No Profile Found');?> !</strong></span><?php }?>
<?php //echo $this->element('pagination',array('IsSearch'=>'No','IsDropdown'=>'No'));
$page_params = $this->Paginator->params();
$limit = $page_params['limit'];
$page = $page_params['page'];
$serialNo = 1*$limit*($page-1)+1;?>
   
   <?php  foreach ($post as $value):$id=$value['Member']['id'];
   $age=$value[0]['age'];
   if($age==NULL){
    $age=0;
   }
   if($value['Member']['photo'] && $value['Member']['photo_status']=='Approved')
	$memberImg='member_thumb/'.$value['Member']['photo'];
	else
	$memberImg='User.png';
	
   ?>

	    <div class="profile_top">
	    <div class="col-sm-12">
	    
	    <div class="col-sm-3 profile_left-top">
	    <?php $url=$this->Html->url(array('controller'=>'Viewprofiles'));
	    if($this->Session->check('Member')){
	     echo$this->Html->link($this->Html->image($memberImg,array('class'=>'img-responsive img-thumbnail','alt' => $value['Member']['name'])),'javascript:void(0);',array('onclick'=>"show_modal('$url/view/$id/$age');",'escape' => false));
	     }else{
	     echo$this->Html->link($this->Html->image($memberImg,array('class'=>'img-responsive img-thumbnail','alt' => $value['Member']['name'])),array('controller'=>'Users','action'=>'index'),array('escape' => false,'title'=>$value['Member']['name'],'class'=>'religion_1'));
	     }?>
	     <?php if($this->Session->check('Member')){?>
	     <?php echo$this->Function->favouriteMember($value['Member']['id']);?><br/>
	     <?php echo$this->Function->shortlistMember($value['Member']['id']);?><br/>
	     <?php }?></div>
	    <div class="col-sm-9">
	    	<table class="table_working_hours table table-bordered">
	        	<tbody>
	        		<tr class="opened_1">
				<tr class="opened">
						<td class="day_label1"><?php echo __('Profile ID');?> :</td>
						<td class="day_value">&nbsp;<?php if($value['Member']['profileId']){ echo$value['Member']['profileId'];}else{echo __('Not Specified');}?></td>
					</tr>
				<tr class="opened">
						<td class="day_label1"><?php echo __('Name');?> :</td>
						<td class="day_value">&nbsp;<?php if($value['Member']['name']){ echo$value['Member']['name'];}else{echo __('Not Specified');}?></td>
					</tr>
				
						<td class="day_label1"><?php echo __('Age / Sex / Height');?> :</td>
						<td class="day_value"><?php if($age!=0){echo$age.' '.__('Yrs');}else{echo __('Not Specified');}?> , <?php if($value['Member']['sex']){echo$value['Member']['sex'];}else{echo __('Not Specified');}?> , <?php if($value['Height']['name']){echo$value['Height']['name'];}else{echo __('Not Specified');}?></td>
					</tr>
				    <tr class="opened">
						<td class="day_label1"><?php echo __('Religion');?> :</td>
						<td class="day_value">&nbsp;<?php if($value['Religion']['name']){echo$value['Religion']['name'];}else{echo __('Not Specified');}?></td>
					</tr>
					<tr class="opened">
						<td class="day_label1"><?php echo __('Location');?> :</td>
						<td class="day_value">&nbsp;<?php if($value['City']['name']){echo$value['City']['name'];}else{echo __('Not Specified');}?>,&nbsp;<?php if($value['State']['name']){echo$value['State']['name'];}else{echo __('Not Specified');}?>,&nbsp;<?php if($value['Country']['name']){echo$value['Country']['name'];}else{echo __('Not Specified');}?></td>
					</tr>
					<tr class="opened">
						<td class="day_label1"><?php echo __('Last Login');?> :</td>
						<td class="day_value">&nbsp;<?php if($value['Member']['last_login']){echo$this->Time->format($dtFormat,$value['Member']['last_login']);}else{echo __('Not specified');}?></td>
					</tr>
					
					<tr class="opened">
						<td class="day_label1" colspan="2">
						 <?php if($this->Session->check('Member'))
			    echo$this->Html->link('View Profile','javascript:void(0);',array('onclick'=>"show_modal('$url/view/$id/$age');",'class'=>'vertical','escape' => false));
			    else
			    echo$this->Html->link('View Profile',array('controller'=>'Users','action'=>'index'),array('class'=>'vertical','escape' => false,'title'=>$value['Member']['name']));?>
						</td>
						
					</tr>
			    </tbody>
		   </table>
			   
		</div>
	    </div>
	    </div>
		<?php endforeach; ?>
		<?php unset($value); ?>	   
	    </div>
	    
	    
    </div>
   
<?php echo $this->element('pagination',array('IsSearch'=>'No','IsDropdown'=>'No'));?>
</div>
</div></div></div>
	    
				</div>
				<div class="clear"> </div>
			</div>		  
	  </div>
  </div>
</div>

