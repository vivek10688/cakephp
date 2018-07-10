<div class="grid_3">
  <div class="container">
   <div class="breadcrumb1">
     <ul>
        <?php echo$this->Html->link('<i class="fa fa-home home_1"></i>&nbsp;',array('controller'=>''),array('escape'=>false));?>
        <span class="divider">&nbsp;|&nbsp;</span>
        <li class="current-page"><?php echo __('Register');?></li>
     </ul>
   </div>
   <div class="services"><?php echo $this->Session->flash();?>
   	    <div class="col-sm-6 login_left">
            <?php echo $this->Form->create('Register', array( 'controller' => 'Register', 'action' => 'index','name'=>'post_req','id'=>'post_req','class'=>'form-horizontal','role'=>'form','type' => 'file'));?>
            <div class="form-group">
                <label for="group_name" class="col-sm-3 control-label"><small><?php echo __('User Name');?><span class="text-danger"> *</span></small></label>
                <div class="col-sm-9">
                <?php echo $this->Form->input('user_name',array('required'=>true,'label' => false,'class'=>'form-control','placeholder'=>__('User Name'),'div'=>false));?>
                </div>
            </div>
            
	    <div class="form-group">
                <label for="group_name" class="col-sm-3 control-label"><small><?php echo __('Name');?><span class="text-danger"> *</span></small></label>
                <div class="col-sm-9">
                <?php echo $this->Form->input('name',array('label' => false,'class'=>'form-control','placeholder'=>__('Name'),'div'=>false));?>
                </div>
            </div>
            
	    <div class="form-group">
                <label for="inputEmail3" class="col-sm-3 control-label"><small><?php echo __('Email');?> <span class="text-danger"> *</span></small></label>
                <div class="col-sm-9">
                <?php echo $this->Form->input('email',array('label' => false,'class'=>'form-control','placeholder'=>__('Email'),'div'=>false));?>
                </div>
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-3 control-label"><small><?php echo __('Password');?><span class="text-danger"> *</span></small></label>
                <div class="col-sm-9">
                <?php echo $this->Form->input('password',array('label' => false,'class'=>'form-control','placeholder'=>__('Password'),'minlength'=>'4','maxlength'=>'15','div'=>false));?>
                </div>
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-3 control-label"><small><?php echo __('Phone');?><span class="text-danger"> *</span></small></label>
                <div class="col-sm-9">
                <?php echo $this->Form->input('phone',array('label' => false,'class'=>'form-control','placeholder'=>__('Phone'),'div'=>false));?>
                </div>
            </div>
	    <?php if($custom[0]['Sitesetting']['status']=='Enabled'){?>
	    <div class="form-group">
                <label for="group_name" class="col-sm-3 control-label"><small><?php echo $custom[0]['Sitesetting']['alias'];?><span class="text-danger"> </span></small></label>
                <div class="col-sm-9">
                <?php echo $this->Form->input('field1',array('label' => false,'class'=>'form-control','placeholder'=>$custom[0]['Sitesetting']['alias'],'div'=>false));?>
                </div>
            </div>
	    <?php }?>
	    <?php if($custom[1]['Sitesetting']['status']=='Enabled'){?>
	    <div class="form-group">
                <label for="group_name" class="col-sm-3 control-label"><small><?php echo $custom[1]['Sitesetting']['alias'];?><span class="text-danger"> </span></small></label>
                <div class="col-sm-9">
                <?php echo $this->Form->input('field2',array('label' => false,'class'=>'form-control','placeholder'=>$custom[1]['Sitesetting']['alias'],'div'=>false));?>
                </div>
            </div>
	    <?php }?>
	    <?php if($custom[2]['Sitesetting']['status']=='Enabled'){?>
	    <div class="form-group">
                <label for="group_name" class="col-sm-3 control-label"><small><?php echo $custom[2]['Sitesetting']['alias'];?><span class="text-danger"> </span></small></label>
                <div class="col-sm-9">
                <?php echo $this->Form->input('field3',array('label' => false,'class'=>'form-control','placeholder'=>$custom[2]['Sitesetting']['alias'],'div'=>false));?>
                </div>
            </div>
	    <?php }?>
	    <?php if($custom[3]['Sitesetting']['status']=='Enabled'){?>
	    <div class="form-group">
                <label for="group_name" class="col-sm-3 control-label"><small><?php echo $custom[3]['Sitesetting']['alias'];?><span class="text-danger"> </span></small></label>
                <div class="col-sm-9">
                <?php echo $this->Form->input('field4',array('label' => false,'class'=>'form-control','placeholder'=>$custom[3]['Sitesetting']['alias'],'div'=>false));?>
                </div>
            </div>
	    <?php }?>
	    <?php if($custom[4]['Sitesetting']['status']=='Enabled'){?>
	    <div class="form-group">
                <label for="group_name" class="col-sm-3 control-label"><small><?php echo $custom[4]['Sitesetting']['alias'];?><span class="text-danger"> </span></small></label>
                <div class="col-sm-9">
                <?php echo $this->Form->input('field5',array('label' => false,'class'=>'form-control','placeholder'=>$custom[4]['Sitesetting']['alias'],'div'=>false));?>
                </div>
            </div>
	    <?php }?>
	    <?php if($custom[5]['Sitesetting']['status']=='Enabled'){?>
	    <div class="form-group">
                <label for="group_name" class="col-sm-3 control-label"><small><?php echo $custom[5]['Sitesetting']['alias'];?><span class="text-danger"> </span></small></label>
                <div class="col-sm-9">
                <?php echo $this->Form->input('field6',array('label' => false,'class'=>'form-control','placeholder'=>$custom[5]['Sitesetting']['alias'],'div'=>false));?>
                </div>
            </div>
	    <?php }?>
	    <div class="form-group">
                <label for="group_name" class="col-sm-3 control-label"><small><?php echo __('Upload Photo');?></small></label>
                <div class="col-sm-9">
                <?php echo $this->Form->input('photoimg',array('type' => 'file','label' => false,'class'=>'','div'=>false));?>
                </div>
            </div>
            <div class="form-group">
                <label for="group_name" class="col-sm-3 control-label"><small><?php echo __('Security Code');?><span class="text-danger"> *</span></small></label>
                <div class="col-sm-9">
                <?php echo$this->Captcha->render($captchaSettings);?>
                </div>
            </div>
            <div class="form-group">
			  <div class="col-sm-offset-4 form-actions">
			    <input type="submit" id="edit-submit" name="op" value="Register Now" class="btn_1 submit">
			  </div>
		<?php echo$this->Form->end();?>
	  </div>
          </div>
          <div class="col-sm-6">
            <div class="col-sm-12 ">
            <?php echo $this->Html->image('register_image.gif',array('class'=>'img-thumbnail'));?>
            </div>
            <div class="col-sm-12 mrg">
            
            </div>
        </div>
          
          
          
          
          
          
          
          
	  <div class="clearfix"> </div>
   </div>
  </div>
</div>