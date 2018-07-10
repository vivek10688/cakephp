  <div class="">
    <div class="banner_info">
	
			    <div class="carousel slide" data-ride="carousel">
			    <!--  <ol class="carousel-indicators">
				<?php foreach($slides as $k=>$value):?>
				<li data-target=".carousel" data-slide-to="<?php echo$k;?>" <?php echo ($k==0?"class=\"active\"":"");?>></li>
				<?php endforeach;unset($k);unset($value);?>
			      </ol>-->
			      <!-- Wrapper for slides -->
				  <div class="carousel-inner dis">
					<?php foreach($slides as $k=>$value):$photoImg='slides_thumb/'.$value['Slide']['photo'];?>
					<div class="<?php echo ($k==0?"item active":"item");?>"><?php echo $this->Html->image($photoImg,array('alt'=>$value['Slide']['slide_name'],'class'=>''));?></div>
				  <?php endforeach;unset($k);unset($value);?>
				</div>
				  <!-- Controls -->
				  <a class="left carousel-control" href=".carousel" data-slide="prev">
					<span class="glyphicon glyphicon-chevron-left"></span>
				  </a>
				  <a class="right carousel-control" href=".carousel" data-slide="next">
					<span class="glyphicon glyphicon-chevron-right"></span>
				  </a>
			 
	
    </div>

  <div class="profile_search">
  	<div class="container wrap_1">
	<?php echo $this->Form->create('Viewprofile', array( 'controller' => 'Viewprofiles', 'action' => 'index'));?>
	  	<div class="search_top">
		 <div class="inline-block">
		  <label class="gender_1"><?php echo __('I am looking for');?> :</label>
			<div class="age_box1" style="max-width: 100%; display: inline-block;">
			<?php   echo $this->Form->select('sex',array('Female'=>__('Bride'),'Male'=>__('Groom')),array('class'=>'slider-selectbox','empty'=>__('All Gender'))); ?>
		   </div>
	    </div>
        <div class="inline-block">
		  <label class="gender_1"><?php echo __('Located In');?> :</label>
			<div class="age_box1" style="max-width: 100%; display: inline-block;">
			<?php   echo $this->Form->select('state_id',$stateName,array('class'=>'slider-selectbox','empty'=>__('All State'))); ?>
          </div>
        </div>
        <div class="inline-block">
		  <label class="gender_1"><?php echo __('Interested In');?> :</label>
			<div class="age_box1" style="max-width: 100%; display: inline-block;">
			<?php   echo $this->Form->select('habit_id',$habitName,array('class'=>'slider-selectbox','empty'=>__('All Interest'))); ?>
        </div>
       </div>
     </div>
	 <div class="inline-block">
	   <div class="age_box2" style="max-width: 220px;">
	   	<label class="gender_1"><?php echo __('Age');?> :</label>
		<?php for($i=18;$i<=100;$i++){
		   $ageFrom[$i]=$i;
		 } ?>
		<?php   echo $this->Form->select('age_from',$ageFrom,array('class'=>'slider-selectbox','style'=>'width: 38%','empty'=>__('From'))); ?>
		<?php for($i=18;$i<=100;$i++){
		   $ageTo[$i]=$i;
		 } ?>
		<?php   echo $this->Form->select('age_to',$ageTo,array('class'=>'slider-selectbox','style'=>'width: 32%','empty'=>__('To'))); ?>
	   </div>
	 </div>
       <div class="inline-block">
		  <label class="gender_1"><?php echo __('Status');?> :</label>
			<div class="age_box1" style="max-width: 100%; display: inline-block;">
			<?php   echo $this->Form->select('maritialstatus_id',$maritialstatus,array('class'=>'slider-selectbox','empty'=>__('All Status'))); ?>
		  </div>
	    </div>
		<div class="submit inline-block">
		   <input id="submit-btn" class="hvr-wobble-vertical" type="submit" value="<?php echo __('Find Matches');?>">
		</div>
     <?php echo$this->Form->end();?>
    </div>
  </div> 
</div>
<div class="">
<div class="grid_1">
      <div class="container">
      	<h1><?php echo __('Featured Profiles');?></h1>
       	<div class="heart-divider">
			<span class="grey-line"></span>
			<i class="fa fa-heart pink-heart"></i>
			<i class="fa fa-heart grey-heart"></i>
			<span class="grey-line"></span>
        </div>
	
	<div class="container">
        <div class="panel panel-default">
    
       <div class="panel-body" style="background-color: rgb(245, 238, 238);">
       <ul id="flexiselDemo3">
	<?php $loginUrl=$this->Html->url(array('controller'=>'Users','action'=>'login','Pages'));
	foreach($post as $value):$id=$value['Member']['id'];
	if($value['Member']['photo'] && $value['Member']['photo_status']=='Approved')
	$memberImg='member_thumb/'.$value['Member']['photo'];
	else
	$memberImg='User.png';
	if($value['Member']['sex']=='Male')
	$sex=__('About Him');
	else
	$sex=__('About Her');
	$url=$this->Html->url(array('controller'=>'Viewprofiles'));
	$age=$value[0]['age'];
	?>
	   <?php  if($this->Session->check('Member')){?>
	     <li><div class="col_1"><a href="javascript:void(0);" onclick="show_modal('<?php echo$url;?>/view/<?php echo$id;?>/<?php echo$age;?>');"><?php echo$this->Html->image($memberImg,array('class'=>'hover-animation image-zoom-in img-responsive','alt' =>$value['Member']['name']),array('escape' => false));?>
             <div class="layer m_1 hidden-link hover-animation delay1 fade-in">
                <div class="center-middle"><?php echo$sex?></div>
             </div>
             <h3><span class="m_3"><?php echo __('Profile ID');?> : <?php echo $value['Member']['profileId'];?></span><br><?php if($value[0]['age']){ echo $value[0]['age'];}else{echo 'N/A';}?>, <?php echo $value['Member']['name'];?>, <?php echo $value['Country']['name'];?><br><?php echo $value['Employed']['name'];?></h3></a></div>
          </li>
	  <?php }else {?>
	  <li><div class="col_1"><a href="<?php echo $loginUrl;?>" ><?php echo$this->Html->image($memberImg,array('class'=>'hover-animation image-zoom-in img-responsive','alt' =>$value['Member']['name']),array('escape' => false));?>
             <div class="layer m_1 hidden-link hover-animation delay1 fade-in">
                <div class="center-middle"><?php echo$sex?></div>
             </div>
             <h3><span class="m_3"><?php echo __('Profile ID');?> : <?php echo $value['Member']['profileId'];?></span><br><?php if($value[0]['age']){ echo $value[0]['age'];}else{echo 'N/A';}?>, <?php echo $value['Member']['name'];?>, <?php echo $value['Country']['name'];?><br><?php echo $value['Employed']['name'];?></h3></a></div>
          </li>
	  <?php }?>  
	  
		<?php endforeach;unset($value);?> 
	    </ul>
	</div>
       </div>
       </div>

	
            <script type="text/javascript">
		 $(window).load(function() {
			$("#flexiselDemo3").flexisel({
				visibleItems: 5,
				animationSpeed: 1000,
				autoPlay:false,
				autoPlaySpeed: 3000,    		
				pauseOnHover: true,
				enableResponsiveBreakpoints: true,
		    	responsiveBreakpoints: { 
		    		portrait: { 
		    			changePoint:480,
		    			visibleItems: 1
		    		}, 
		    		landscape: { 
		    			changePoint:640,
		    			visibleItems: 2
		    		},
		    		tablet: { 
		    			changePoint:768,
		    			visibleItems: 3
		    		}
		    	}
		    });
		    
		});
	   </script>
	   <?php echo $this->Html->script('/design700/js/jquery.flexisel.js');?>
	   
    </div>
</div>
<div class="grid_2">
	<div class="container">
		<h2><?php echo __('Success Stories');?></h2>
       	<div class="heart-divider">
			<span class="grey-line"></span>
			<i class="fa fa-heart pink-heart"></i>
			<i class="fa fa-heart grey-heart"></i>
			<span class="grey-line"></span>
        </div>
        <div class="row_1">
	     <div class="col-md-8 suceess_story">
	         <ul>
		 <?php foreach($testimonials as $postTestimonial):
		 $id=$postTestimonial['Testimonial']['id'];
		  if($postTestimonial['Testimonial']['photo'])
		  $photoImg='testimonial_thumb/'.$postTestimonial['Testimonial']['photo'];
		  else
		  $photoImg='User.png';
		  if($postTestimonial['Testimonial']['member_id']){
		    $photoImg='member_thumb/'.$postTestimonial['Member']['photo'];
		   }
		   ?>
				       <li>
				  	<div class="suceess_story-date">
						<span class="entry-1"><?php echo $this->Time->format('M d, Y',h($postTestimonial['Testimonial']['created'])); ?></span>
					</div>
					<div class="suceess_story-content-container">
						<figure class="suceess_story-content-featured-image">
						<?php echo $this->Html->image($photoImg,array('class'=>'img-circle','width'=>'75','height'=>'75','alt' => $postTestimonial['Testimonial']['name']));?>
						   				            
					    </figure>
						<div class="suceess_story-content-info">
				        	<h4><a href="javascript:void(0);"><?php echo$postTestimonial['Testimonial']['name'];?></a></h4>				        	
				        	<p><?php echo substr($postTestimonial['Testimonial']['description'],0,90);?></p>
				        </div>
				    </div>
				</li>
	            <?php endforeach;unset($postTestimonial);?>
	        
		<li>
		<div class="suceess_story-content-container"><div class="suceess_story-content-info"><p>
		<?php echo $this->Html->link('<span class="fa fa-heart"></span>&nbsp;'.__('View All'),array('controller' => 'Testimonials','action'=>'index'),array('escape' => false));?>
		</p></div></div></li></ul>				
	    </div>
	    <div class="col-md-4 row_1-right">
	      <h3><?php echo __('News & Events');?></h3><i class="fa fa-style1 fa fa-bullhorn"></i>
	        
		<marquee align="top" direction="up" onmouseover="this.stop();" onmouseout="this.start();" scrollamount="2" height="218">
				    <ul>				
					<?php foreach($news as $value):$id=$value['News']['page_url'];?>
					<li><?php echo$this->Html->link($value['News']['news_title'],array('controller'=>'News','action'=>'show',$id));?></li>
					<?php endforeach;unset($value);?>				  
				  </ul>
		</marquee>
		
	        <div class="religion">
               <div class="religion_1-title"><?php echo __('Religion');?> :</div>
	       <?php foreach($religion as $value):$id=$value['Religion']['id'];$name="religion";
	             echo$this->Html->link($value['Religion']['name'],array('controller'=>'Viewprofiles',$id,$name),array('escape' => false,'title'=>$value['Religion']['name'],'class'=>'religion_1'));?>
		    <span>|</span>
		    <?php endforeach;unset($value);?>
	        </div>
	        <div class="religion">
               <div class="religion_1-title"><?php echo __('Community');?> :</div>
		     <?php foreach($mothertongue as $value):$id=$value['Mothertongue']['id'];$name="mothertongue";
	             echo$this->Html->link($value['Mothertongue']['name'],array('controller'=>'Viewprofiles',$id,$name),array('escape' => false,'title'=>$value['Mothertongue']['name'],'class'=>'religion_1'));?>
		    <span>|</span>
		    <?php endforeach;unset($value);?>
	        </div>
	        
	        <div class="religion" style="padding: 5px;">
               <div class="religion_1-title" ><?php echo __('Location');?> :</div>
	       <?php foreach($state as $value):$id=$value['State']['id'];$name="state";
	       echo$this->Html->link($value['State']['name'],array('controller'=>'Viewprofiles',$id,$name),array('escape' => false,'title'=>$value['State']['name'],'class'=>'religion_1'));?>
	       <span>|</span>
	       <?php endforeach;unset($value);?>
	      </div>
	     </div>
	     <div class="clearfix"> </div>
	   </div> 
	  </div>
    </div></div></div>