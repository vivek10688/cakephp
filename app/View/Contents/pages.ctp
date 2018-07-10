<div class="grid_3">
  <div class="container"><?php echo $this->Session->flash();?>
   <div class="breadcrumb1">
     <ul>
        <?php echo$this->Html->link('<i class="fa fa-home home_1"></i>&nbsp;',array('controller'=>'/'),array('escape'=>false));?>
        <span class="divider">&nbsp;|&nbsp;</span>
        <li class="current-page"><?php echo h($linkName1);?> <span><?php echo h($linkName2);?></span></li>
     </ul>
   </div>
   <div><?php echo str_replace("<script","",$contentPost['Content']['main_content']);?></div>
	  <div class="clearfix"> </div>
    </div>
</div>
</div>


