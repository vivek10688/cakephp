<?php
echo $this->Html->css('select2/select2');
echo $this->Html->css('select2/select2-bootstrap');
echo $this->fetch('css');
echo $this->Html->script('select2.min');
echo $this->fetch('script');
$memberUrl=$this->Html->url(array('controller'=>'Sendsms','action'=>'membersearch'));

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
       	
	$('#members').hide();;
	$('#any').hide();
    $('#SendsmsType').change(function(){
    if($('#SendsmsType').val()=="Member")
    {
	$('#members').show();;
	$('#any').hide();
    }
    
    else if($('#SendsmsType').val()=="Any")
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
    $('#SendsmsSmsTemplate').change(function() {
    $('#SendsmsMessage').val($('#SendsmsSmsTemplate').val());
    sms_character_count();
    });
    $('#SendsmsMessage').keyup(function () {
	sms_character_count();
    });
    $('#SendsmsMessage').focus(function () {
	sms_character_count();
    });    
    });
</script>
<div class="panel panel-custom">
    <div class="panel-heading"><?php echo __('Send Sms');?></div>
    <div class="panel-body">
    <?php echo $this->Session->flash();?>
		    <?php echo $this->Form->create('Sendsms', array('class'=>'form-horizontal'));?>                    
		    <div class="form-group">
			<label for="site_name" class="col-sm-2 control-label"><?php echo __('Type');?></label>
			<div class="col-sm-10">
			   <?php echo $this->Form->select('type',array('Member'=>__('Members'),'Any'=>__('Any Sms')),array('required'=>'required','empty'=>__('Please Select'),'label' => false,'class'=>'form-control','div'=>false));?>
			</div>			
		    </div>
		    <div class="form-group" id="members">
			<label for="site_name" class="col-sm-2 control-label"><?php echo __('Members');?></label>
			<div class="col-sm-10">
			   <?php echo $this->Form->input('member_id',array('type'=>'text','id'=>'memberId','label' => false,'class'=>'form-control','placeholder'=>__('Default all member if you add manually then search member name'),'div'=>false));?>
			</div>			
		    </div>
		    <div class="form-group" id="any">
			<label for="site_name" class="col-sm-2 control-label"><?php echo __('Any Number');?></label>
			<div class="col-sm-10">
			   <?php echo $this->Form->input('any_sms',array('type'=>'text','placeholder'=>__('Type any number comma seprated'),'label' => false,'class'=>'form-control','div'=>false));?>
			</div>			
		    </div>
		    <div class="form-group">
			<label for="site_name" class="col-sm-2 control-label"><?php echo __('Select Sms Template');?></label>
			<div class="col-sm-10">
			   <?php echo $this->Form->select('sms_template',$smsTemplate,array('empty'=>__('Please Select'),'label' => false,'class'=>'form-control','div'=>false));?>
			</div>			
		    </div>
		    <div class="form-group">
			<label for="group_name" class="col-sm-2 control-label"><?php echo __('Sms Template');?>:</label>
			<div class="col-sm-8">
			    <?php echo $this->Form->textarea('message',array('label' => false,'class'=>'form-control','placeholder'=>__('If you do not want to select sms template then simply type sms message'),'div'=>false,'rows'=>5));?>
			</div>
			<div class="span2"><div id="characterLeft"></div></div>
		    </div>
		    <div class="form-group text-left">
			<div class="col-sm-offset-2 col-sm-10">
			    <button type="submit" class="btn btn-success"><span class="fa fa-mobile"></span>&nbsp;<?php echo __('Send');?></button>
			    <?php echo$this->Html->link('<span class="fa fa-refresh"></span>&nbsp;'.__('Reset'),array('action'=>'index'),array('class'=>'btn btn-danger','escape'=>false));?>
			</div>
		    </div>
		    <?php echo$this->Form->end(null);?>
                </div>
            </div>
        