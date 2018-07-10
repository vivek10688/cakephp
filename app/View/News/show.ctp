<div class="grid_3">
  <div class="container">
   <div class="breadcrumb1">
     <ul>
     <?php echo$this->Html->link('<i class="fa fa-home home_1"></i>&nbsp;',array('controller'=>'pages'),array('escape'=>false));?>
        <span class="divider">&nbsp;|&nbsp;</span>
        <li class="current-page"><?php echo __('News & Events');?></li>
     </ul>
   </div>
   <div class="services">

<div class="col-sm-8">
        <?php echo $this->Session->flash();?>
            <div><strong><?php echo h($newsPost['News']['news_title']);?></strong></div><br/>
			<div><?php echo str_replace("<script","",($newsPost['News']['news_desc']));?></div>        
    </div>
    <div class="col-sm-4">
      <h4><?php echo __('News & Events');?></h4><i class="fa fa-style1 fa fa-bullhorn"></i>
	        
		<marquee align="top" direction="up" onmouseover="this.stop();" onmouseout="this.start();" scrollamount="2" height="218">
				    <ul>				
					<?php foreach($news as $value):$id=$value['News']['page_url'];?>
					<li><?php echo$this->Html->link($value['News']['news_title'],array('controller'=>'News','action'=>'show',$id));?></li>
					<?php endforeach;unset($value);?>				  
				  </ul>
		</marquee>
    </div>
   </div></div></div>