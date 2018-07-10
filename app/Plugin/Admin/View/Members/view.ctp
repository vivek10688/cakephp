	<div class="container">		
			<?php $passUrl=$this->Html->url(array('controller'=>'Members','action'=>'changepass',$id));
                        $photoUrl=$this->Html->url(array('controller'=>'Members','action'=>'changephoto',$id));
                        echo $this->Session->flash();?>
				<div class="panel panel-custom mrg">
					<div class="panel-heading"><?php echo __('View Member Information');?><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></div>
					<div class="panel-body">
						<div class="col-md-2 text-center">
							<p><div class="img-thumbnail"><?php echo $this->Html->image($std_img, array('alt' => $post['Member']['name'],'width'=>'132','height'=>'132'));?></div></p>
							<?php echo $this->Html->link(__('Update Photo'),'javascript:void(0);',array('onclick'=>"show_modal('$photoUrl');",'class'=>'btn btn-success btn-sm btn-block','escape'=>false)); ?>
                                                        <?php echo $this->Html->link(__('Change Password'),'javascript:void(0);',array('onclick'=>"show_modal('$passUrl');",'class'=>'btn btn-danger btn-sm btn-block','escape'=>false)); ?>
						</div>
						<?php echo$this->element('viewprofile');?>
					</div>	
				</div>
        </div>