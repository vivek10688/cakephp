<div class="page-title"> <div class="title-env"> <h1 class="title"><?php echo __('Add SEO');?></h1></div></div>
<div class="panel">
                <div class="panel-body"><?php echo $this->Session->flash();?>
                <?php echo $this->Form->create('Seo', array('controller' => 'Seos', 'action' => 'add','name'=>'post_req','id'=>'post_req','class'=>'form-horizontal'));?>
                   <div class="form-group">
			<label for="group_name" class="col-sm-2 control-label">Name</label>
			<div class="col-sm-4">
			   <?php echo $this->Form->input('controller',array('label' => false,'class'=>'form-control validate[required]','placeholder'=>'Name','div'=>false));?>
			</div>
			<label for="group_name" class="col-sm-2 control-label">Page Name</label>
			<div class="col-sm-4">
			   <?php echo $this->Form->input('action',array('label' => false,'class'=>'form-control validate[required]','placeholder'=>'Page Name','div'=>false));?>
			</div>
		    </div>
		    <div class="form-group">
			<label for="group_name" class="col-sm-2 control-label">Meta Title</label>
			<div class="col-sm-4">
			   <?php echo $this->Form->input('meta_title',array('label' => false,'class'=>'form-control validate[required]','placeholder'=>'Meta Title','div'=>false));?>
			</div>
			<label for="group_name" class="col-sm-2 control-label">Meta Keyword</label>
			<div class="col-sm-4">
			   <?php echo $this->Form->input('meta_keyword',array('label' => false,'class'=>'form-control','placeholder'=>'Meta Keyword','div'=>false));?>
			</div>
		    </div>
		    <div class="form-group">
			<label for="group_name" class="col-sm-2 control-label">Meta Content</label>
			<div class="col-sm-4">
			   <?php echo $this->Form->input('meta_content',array('label' => false,'class'=>'form-control','placeholder'=>'Meta Content','div'=>false));?>
			</div>
		    </div>
                    <div class="form-group text-left">
                        <div class="col-sm-offset-2 col-sm-10">
                            <button type="submit" class="btn btn-success"><span class="glyphicon glyphicon-plus-sign"></span> Save</button>
                            <button type="button" class="btn btn-danger" onclick="window.location='index'"><span class="glyphicon glyphicon-remove"></span> Close</button>
                        </div>
                    </div>
                   <?php echo $this->Form->end();?>
                </div>
            </div>