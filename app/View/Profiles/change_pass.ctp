<script type="text/javascript">
$(document).ready(function(){
  $('#password').change(function(){validatePassword();});
  $('#con_password').keyup(function(){validatePassword();})
function validatePassword(){
  if($('#password').val() != $('#con_password').val()) {
    document.getElementById('con_password').setCustomValidity("Passwords Don't Match");
  } else {
   document.getElementById('con_password').setCustomValidity('');
  }
}
});
</script>
<?php echo $this->Session->flash();?>
<div class="container">
	<div class="panel panel-custom mrg">
        <div class="panel-heading"><?php echo __('Change Password');?><button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button></div>
                <div class="panel-body">
                <?php echo $this->Form->create('Profile', array('name'=>'post_req','id'=>'post_req','class'=>'form-horizontal'));?>
                     <div class="form-group">
                        <label for="group_name" class="col-sm-3 control-label"><?php echo __('Old Password');?></label>
                        <div class="col-sm-9">
			<?php echo $this->Form->input('oldPassword',array('required'=>true,'type'=>'password','value'=>'','label' => false,'class'=>'form-control','placeholder'=>__('Old Password'),'div'=>false,'maxlength'=>15,'minlength'=>4));?>
		  </div>
                    </div>
                    <div class="form-group">
                        <label for="group_name" class="col-sm-3 control-label"><?php echo __('Password');?></label>
                        <div class="col-sm-9">
			<?php echo $this->Form->input('password',array('required'=>true,'id'=>'password','value'=>'','label' => false,'class'=>'form-control','placeholder'=>__('Password'),'div'=>false,'maxlength'=>15,'minlength'=>4));?>
		  </div>
                    </div>
                    <div class="form-group">
                        <label for="group_name" class="col-sm-3 control-label"><?php echo __('Confirm Password');?></label>
                        <div class="col-sm-9">
			<?php echo $this->Form->input('con_password',array('required'=>true,'type'=>'password','value'=>'','id'=>'con_password','label' => false,'class'=>'form-control','placeholder'=>__('Confirm Password'),'div'=>false));?>
		 </div>
                    </div>
                    <div class="form-group text-left">
                        <div class="col-sm-offset-3 col-sm-7">
                            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-refresh"></span> <?php echo __('Update');?></button>                            
                        </div>
                    </div>
                <?php echo $this->Form->end(null);?>
                </div>
            </div>
        </div>