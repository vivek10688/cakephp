	<div class="container">		
			<?php echo $this->Session->flash();?>
				<div class="panel panel-custom mrg">
					<div class="panel-heading"><?php echo __('View Member Information');?><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></div>
					<div class="panel-body">
					<div class="col-md-2 text-center">
							<p><div class="img-thumbnail"><?php echo $this->Html->image($std_img, array('alt' => $post['Member']['name'],'width'=>'132','height'=>'132'));?></div></p>
					</div>	
						<?php echo$this->element('viewprofile');?>
					</div>	
				</div>
        </div>