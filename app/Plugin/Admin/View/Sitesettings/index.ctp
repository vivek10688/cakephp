<div class="page-title"><div class="title-env"> <h1 class="title"><?php echo __('Custom Fields');?></h1></div></div>
<div class="panel">    
    <div class="panel-body"><?php echo $this->Session->flash();?>
	<?php echo $this->Form->create(array('method'=>'post','name'=>'ss','class'=>'form-horizontal'));?>
        <?php foreach($post as $k=> $value): ?>
     <div class="form-group">
    <label for="inputEmail3" class="col-sm-2 control-label"> <?php echo $value['Sitesetting']['name'];?></label>
    <div class="col-sm-4">
    <?php
      echo $this->Form->input("$k.Sitesetting.alias",array('div'=>false,'label'=>false,'class'=>'form-control'));
      echo $this->Form->input("$k.Sitesetting.id",array('type'=>'hidden'));?>
      </div>
      <div class="col-sm-4">
        <?php
      $option=array('Enabled'=>__('Enabled'),'Disabled'=>__('Disabled'));
      echo $this->Form->select("$k.Sitesetting.status",$option,array('div'=>false,'label'=>false,'class'=>'form-control','empty'=>__('Select Status')));
    ?>

      </div>
      </div>
     <?php endforeach;
    unset($value);?>

      <div class="col-sm-offset-2 col-sm-3">
                    <button type="submit" class="btn btn-success"><span class="fa fa-plus-circle"></span> <?php echo __('Save');?></button>
              </div>
	<?php echo $this->Form->end();?>
    </div>
</div>