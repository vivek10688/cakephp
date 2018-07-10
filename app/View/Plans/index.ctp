<div class="grid_3">
  <div class="container"><?php echo $this->Session->flash();?>
   <div class="breadcrumb1">
     <ul>
        <?php echo$this->Html->link('<i class="fa fa-home home_1"></i>&nbsp;',array('controller'=>'/'),array('escape'=>false));?>
        <span class="divider">&nbsp;|&nbsp;</span>
        <li class="current-page"><?php echo __('Membership').' '.__('Plans');?></li>
     </ul>
   </div>
   <?php foreach($plan as $post):?>
   <div class="col-md-3 pricing-table">
	  <div class="pricing-table-grid">
		<h3><span class="dollar"><?php echo$currency;?></span><?php echo$post['Plan']['amount'];?><br><span class="month1"><?php if($post['Plan']['expiry']){echo$post['Plan']['expiry'].' '.__('Contacts');}else{echo __('Unlimited').' '.__('(Contacts)');}?></span><br>
		<span class="month1"><?php if($post['Plan']['duration']){echo$post['Plan']['duration'].' '.__('Month');}else{echo'Unlimited'.' '.__('Months');}?></span></h3>
		<ul>
			<li><span><?php echo$post['Plan']['name'];?></span></li>
			<li><a href="javascript:void(0);"><i class="fa fa-envelope-o icon_3"></i><?php echo __('E-Mails');?></a></li>
			<li><a href="javascript:void(0);"><i class="fa fa-phone icon_3"></i><?php echo __('Phone Number');?> </a></li>
			<li><a href="javascript:void(0);"><i class="fa fa-user icon_3"></i><?php echo __('Profile Highlight');?></a></li>
			<li><a href="javascript:void(0);"><i class="fa fa-smile-o icon_3"></i><?php echo __('View Profile');?></a></li>
		</ul>
		<a class="popup-with-zoom-anim order-btn" data-toggle="modal" data-target=".payment-option-<?php echo$post['Plan']['id'];?>" href="javascript:void(0);"><?php echo __('Pay Now');?></a>
	  </div>
	  </div>
	  <?php endforeach;?>
	  <div class="clearfix"> </div>
	  
<?php foreach($plan as $post):$id=$post['Plan']['id'];$url=$this->Html->url(array('controller'=>'Plans','action'=>'bankdeposit',$id));?>
<div class="modal fade payment-option-<?php echo$id;?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel-<?php echo$id;?>">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Payment Options</h4>
      </div>
      <div class="modal-body">
        <p>1. <?php echo __('Online');?>
	<?php if($post['Plan']['amount']>0){?>
	<?php if($PPL){?><div><?php echo$this->Html->link($this->Html->image('paypal.png'),array('controller'=>'Payments','action'=>'paymentgateway',$id,'PAYPAL'),array('class'=>'img-thumbnail','escape' => false));?>&nbsp;</div><?php }?>
	<?php if($CAE){?><div><?php echo$this->Html->link($this->Html->image('ccavenue.png'),array('controller'=>'Payments','action'=>'paymentgateway',$id,'CCAVENUE'),array('class'=>'img-thumbnail','escape' => false));?>&nbsp;</div><?php }?>
	<?php if($PME){?><div><?php echo$this->Html->link($this->Html->image('payumoney.png'),array('controller'=>'Payments','action'=>'paymentgateway',$id,'PAYUMONEY'),array('class'=>'img-thumbnail','escape' => false));?>&nbsp;</div><?php }}
	else{echo$this->Html->link('<span class="fa fa-shopping-cart"></span>&nbsp;'.__('Free Checkout'),array('controller'=>'Payments','action'=>'paymentgateway',$id,'F'),array('class'=>'btn btn-success','escape'=>false));}?>
	<p>2. <?php if($userValue){echo $this->Html->link(__('Bank Deposit'),'javascript:void(0)',array('onclick'=>"show_modal('$url');"));}
	else {echo $this->Html->link(__('Bank Deposit'),array('controller'=>'Registers','action'=>'index'));}?><br/><br/></p>
	<?php echo$bankDetail;?>
      </div>
  </div>
</div>
</div>
<?php endforeach;unset($post);?>
    </div>
</div>
</div>