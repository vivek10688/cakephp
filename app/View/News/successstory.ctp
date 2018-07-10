<div class="grid_3">
  <div class="container">
   <div class="breadcrumb1">
     <ul>
     <?php echo$this->Html->link('<i class="fa fa-home home_1"></i>&nbsp;',array('controller'=>'Testimonials'),array('escape'=>false));?>
        <span class="divider">&nbsp;|&nbsp;</span>
        <li class="current-page"><?php echo __('Success story');?></li>
     </ul>
   </div>
   <div class="services">

<div class="col-md-9">
    <div class="page-heading">
        <div class="widget">
	 <?php if($postTestimonial['Testimonial']['photo'])
		  $photoImg='testimonial_thumb/'.$postTestimonial['Testimonial']['photo'];
		  else
		  $photoImg='User.png';?>
            <figure class="suceess_story-content-featured-image">
		  <?php echo $this->Html->image($photoImg,array('class'=>'img-responsive','width'=>'100','height'=>'100','alt' => $postTestimonial['Testimonial']['name']));?>
						   				            
	   </figure>
        </div>
    </div>
        <?php echo $this->Session->flash();?>
            <div><strong><?php echo h($postTestimonial['Testimonial']['name']);?></strong></div><br/>
			<div><?php echo str_replace("<script","",($postTestimonial['Testimonial']['description']));?></div>        
    </div>
   </div></div></div>