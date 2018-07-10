<?php
 $this->Js->JqueryEngine->jQueryObject = 'jQuery';
// Paginator options
$this->Paginator->options(array(
  'update' => '#resultDiv',
  'evalScripts' => true,
));
?>
<div id="resultDiv">
<div class="grid_3">
  <div class="container">
   <div class="breadcrumb1">
     <ul>
     <?php echo$this->Html->link('<i class="fa fa-home home_1"></i>&nbsp;',array('controller'=>'pages'),array('escape'=>false));?>
        <span class="divider">&nbsp;|&nbsp;</span>
        <li class="current-page"><?php echo __('Success stories');?></li>
     </ul>
   </div>
	<div class="site-page-content">
		<div class="wrap">
			<div class="blog-grids-box">
			<?php echo $this->Session->flash();?>
   	    <div class="col-sm-12">
	    <?php   if($this->Session->check('Member')){?>
               <?php echo $this->element('menunavigation');?>
              <?php }?>
	    <div class="col-sm-9">
	    <?php echo $this->element('pagination',array('IsSearch'=>'No','IsDropdown'=>'No'));
		$page_params = $this->Paginator->params();
		$limit = $page_params['limit'];
		$page = $page_params['page'];
		$serial_no = 1*$limit*($page-1)+1;?>
    <div class="mrg"><br></div>
    <ul>
		 <?php foreach($Testimonials as $postTestimonial):
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
						<?php echo $this->Html->image($photoImg,array('class'=>'img-circle','width'=>'150','alt' => $postTestimonial['Testimonial']['name']));?>
						   				            
					        </figure>
						<div class="suceess_story-content-info">
				        	<h4><?php echo$postTestimonial['Testimonial']['name'];?></h4>
				        	<p><?php echo $postTestimonial['Testimonial']['description'];?>
						</p>
						</div>
				    </div>
				</li>
	            <?php endforeach;unset($postTestimonial);?>
		</ul>
	    </div>
    </div>
	    </div>
	    
				</div>
				<div class="clear"> </div>
			</div>		  
	  </div>
  </div>
</div>
</div>