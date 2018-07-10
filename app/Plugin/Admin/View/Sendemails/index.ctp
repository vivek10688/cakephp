<?php
echo $this->Html->css('select2/select2');
echo $this->Html->css('select2/select2-bootstrap');
echo $this->fetch('css');
echo $this->Html->script('select2.min');
echo $this->fetch('script');
$memberUrl=$this->Html->url(array('controller'=>'Sendemails','action'=>'memberssearch'));
echo $this->Session->flash();?>
<script type="text/javascript">
    $(document).ready(function(){
        $('#memberId').select2({
        minimumInputLength: 1,
	tags: true,
        ajax: {
          url: '<?php echo$memberUrl;?>',
          dataType: 'json',
          data: function (term, page) {
            return {
              q: term
            };
          },          
          results: function (data, page) {
            return { results: data };
          }
        }
      });
		
	$('#members').hide();
	$('#any').hide();
    $('#SendemailType').change(function(){
    if($('#SendemailType').val()=="Member")
    {
	$('#members').show();
	$('#any').hide();
    }
     else if($('#SendemailType').val()=="Any")
    {
	$('#any').show();
	$('#members').hide();
    }
    else
    {
	$('#any').hide();
	$('#members').hide();
    }
    });
    $('#SendemailEmailTemplate').change(function() {
    $('#SendemailMessage').val($('#SendemailEmailTemplate').val());
    });
    });
</script>
<?php echo $this->Session->flash();?>
<div class="panel panel-custom">
    <div class="panel-heading"><?php echo __('Send Emails');?></div>
               <div class="panel-body">
		    <?php echo $this->Form->create('Sendemail', array('class'=>'form-horizontal'));?>                    
		    <div class="form-group">
			<label for="site_name" class="col-sm-2 control-label"><?php echo __('Type');?></label>
			<div class="col-sm-10">
			   <?php echo $this->Form->select('type',array('Member'=>__('Members'),'Any'=>__('Any Email')),array('required'=>'required','empty'=>__('Please Select'),'label' => false,'class'=>'form-control','div'=>false));?>
			</div>			
		    </div>
		    <div class="form-group" id="members">
			<label for="site_name" class="col-sm-2 control-label"><?php echo __('Members');?></label>
			<div class="col-sm-10">
			   <?php echo $this->Form->input('member_id',array('type'=>'text','id'=>'memberId','label' => false,'class'=>'form-control','div'=>false,'placeholder'=>__('Default all members if you add manually then search member email')));?>
			</div>			
		    </div>
		     <div class="form-group" id="any">
			<label for="site_name" class="col-sm-2 control-label"><?php echo __('Any Email');?></label>
			<div class="col-sm-10">
			   <?php echo $this->Form->input('any_email',array('type'=>'text','placeholder'=>__('Type any email comma seprated'),'label' => false,'class'=>'form-control','div'=>false));?>
			</div>			
		    </div>
		    <div class="form-group">
			<label for="site_name" class="col-sm-2 control-label"><?php echo __('Subject');?></label>
			<div class="col-sm-10">
			   <?php echo $this->Form->input('subject',array('type'=>'text','placeholder'=>__('Type subject'),'required'=>'required','label' => false,'class'=>'form-control','div'=>false));?>
			</div>
		    </div>
		    <div class="form-group">
			<label for="site_name" class="col-sm-2 control-label"><?php echo __('Select Email Template');?></label>
			<div class="col-sm-10">
			   <?php echo $this->Form->select('email_template',$emailTemplate,array('empty'=>__('Please Select'),'label' => false,'class'=>'form-control','div'=>false));?>
			</div>			
		    </div>
		    <div class="form-group">
			<label for="group_name" class="col-sm-2 control-label"><?php echo __('Email Template');?>:</label>
			<div class="col-sm-10">
			    <?php echo $this->Tinymce->input('message',array('label' => false,'class'=>'form-control','placeholder'=>__('If you do not want to select email template then simply type email message. Once you load editor then you can not select template go to reset button'),'div'=>false),array('language'=>$configLanguage,'directionality'=>$dirType),'absolute');?>
			</div>
		    </div>
		    <div class="form-group text-left">
			<div class="col-sm-offset-2 col-sm-10">
			    <button type="submit" class="btn btn-success"><span class="fa fa-send"></span>&nbsp;<?php echo __('Send');?></button>
			    <?php echo$this->Html->link('<span class="fa fa-refresh"></span>&nbsp;'.__('Reset'),array('action'=>'index'),array('class'=>'btn btn-danger','escape'=>false));?>
			</div>
		    </div>
		    <?php echo$this->Form->end(null);?>
                </div>
            </div>
        