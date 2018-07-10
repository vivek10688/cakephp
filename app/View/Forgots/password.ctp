<div class="grid_3">
  <div class="container">
   <div class="breadcrumb1">
     <ul>
     <?php echo$this->Html->link('<i class="fa fa-home home_1"></i>&nbsp;',array('controller'=>'pages'),array('escape'=>false));?>
        <span class="divider">&nbsp;|&nbsp;</span>
        <li class="current-page"><?php echo __('Password');?></li>
     </ul>
   </div>
   <div class="services">

<div class="col-md-7">
    <div class="page-heading">
        <div class="widget">
            <h2 class="widget-title"><?php echo __('Forgot Password');?></span></h2>
        </div>
    </div>
    <?php echo $this->Session->flash();?>
        <?php echo $this->Form->create('Forgot', array('name'=>'post_req','id'=>'post_req','class'=>'form-horizontal','role'=>'form'));?>
        <div class="form-group">
            <label for="inputEmail3" class="col-sm-3 control-label"><?php echo __('Email');?> :</label>
            <div class="col-sm-9">
            <?php echo $this->Form->input('email',array('type'=>'email','required'=>true,'label' => false,'class'=>'form-control','placeholder'=>__('Email'),'div'=>false));?>
            </div>
        </div>
        <div class="form-group text-center">
            <div class="col-sm-offset-3 col-sm-2">
            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-log-in"></span> <?php echo __('Submit');?></button>
            </div>
        </div>
    <?php echo$this->Form->end();?>
</div>
<div class="col-md-5">
<?php echo $this->Html->image('forgot_password.jpg',array('class'=>'img-thumbnail'));?>
</div>

  </div></div></div>
  