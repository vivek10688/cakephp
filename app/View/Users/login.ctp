<div class="grid_3">
  <div class="container">
   <div class="breadcrumb1">
     <ul>
     <?php echo$this->Html->link('<i class="fa fa-home home_1"></i>&nbsp;',array('controller'=>'pages'),array('escape'=>false));?>
        <span class="divider">&nbsp;|&nbsp;</span>
        <li class="current-page"><?php echo __('Member Login');?></li>
     </ul>
   </div>
   <div class="services">
   	  <div class="col-sm-7 login_left"><?php echo $this->Session->flash();?>
	   <?php echo $this->Form->create('User', array('role'=>'form'));?>
  	    <div class="form-item form-type-textfield form-item-name">
	      <label for="edit-name">Username / E-Mail <span class="form-required" title="This field is required.">*</span></label>
	      <?php echo $this->Form->input('email',array('id'=>'edit-name','required'=>true,'type'=>'text','label' => false,'class'=>'form-text required','placeholder'=>__('Username / Email'),'div'=>false));?>
	     </div>
	    <div class="form-item form-type-password form-item-pass">
	      <label for="edit-pass">Password <span class="form-required" title="This field is required.">*</span></label>
              <?php echo $this->Form->input('password',array('size'=>'60','maxlength'=>'128','required'=>true,'id'=>'edit-pass','label' => false,'class'=>'form-text required','placeholder'=>__('Password'),'value'=>'','type'=>'password','div'=>false));?>
	      </div>
	    <div class="form-actions">
	    	<input type="submit" id="edit-submit" name="op" value="Log in" class="btn_1 submit">
	    </div>
	    <div class="mrg">
				<?php echo$this->Html->link('<span class="glyphicon glyphicon-cog"></span>&nbsp; '.__('Forgot Password'),array('controller'=>'forgots','action'=>'password'),array('escape'=>false));?>
				
				<?php if($frontRegistration==1){?>
				
				<?php echo$this->Html->link('<span class="glyphicon glyphicon-user"></span>&nbsp; '.__('New Member? Create Account'),array('controller'=>'Registers','action'=>'index'),array('escape'=>false));?>
				
				<?php echo$this->Html->link('<span class="glyphicon glyphicon-share-alt"></span>&nbsp; '.__('Re-Send Email Verification'),array('controller'=>'Emailverifications','action'=>'resend'),array('escape'=>false));?>
				
				<?php }?>
	    </div>			
				<?php echo$this->Form->end();?>
	  </div>
	  <div class="col-md-5">
	  <?php echo $this->Html->image('login.jpg',array('class'=>'img-thumbnail'));?>
	  </div>
	  
	  
	  
	  
	  
         <div class="clearfix"> </div>
   </div>
  </div>
</div>