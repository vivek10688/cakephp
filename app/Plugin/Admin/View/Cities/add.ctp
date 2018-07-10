<div class="panel panel-custom">
    <div class="panel-heading"><?php echo __('Add City');?></div>
    <div class="panel-body"><?php echo $this->Session->flash();?>
        <?php echo $this->Form->create('City', array('class'=>'form-horizontal'));?>
        <div class="form-group">
            <label for="group_name" class="col-sm-3 control-label"><small><?php echo __('Country');?></small></label>
            <div class="col-sm-9">
                <?php $url = $this->Html->url(array('controller'=>'../Ajaxcontents','action' => 'state'));
                echo $this->Form->select('country_id',$country,array('required'=>true,'id'=>'countryId','rel'=>$url,'class'=>'form-control','empty'=>__('Select')));  ?>
            </div>
        </div>
        <div class="form-group">
            <label for="group_name" class="col-sm-3 control-label"><small><?php echo __('State');?></small></label>
            <div class="col-sm-9">
               <?php  echo $this->Form->select('state_id',$state,array('id'=>'stateId','required'=>true,'class'=>'form-control','empty'=>'Select'));?>
            </div>
        </div>
        <div class="form-group">
            <label for="group_name" class="col-sm-3 control-label"><small><?php echo __('City Name');?></small></label>
            <div class="col-sm-9">
               <?php echo $this->Form->input('name',array('label' => false,'class'=>'form-control','placeholder'=> __('City Name'),'div'=>false));?>
            </div>
        </div>
        <div class="form-group text-left">
            <div class="col-sm-offset-3 col-sm-6">
                <?php echo$this->Form->button('<span class="fa fa-plus-circle"></span>&nbsp;'.__('Save'),array('class'=>'btn btn-success','escpae'=>false));?>
                <?php echo$this->Html->link('<span class="fa fa-close"></span>&nbsp;'.__('Close'),array('action'=>'index'),array('class'=>'btn btn-danger','escape'=>false));?>
            </div>
        </div>
        <?php echo $this->Form->end();?>
    </div>
</div>
<script type="text/javascript">
$(document).ready(function(){
$('#countryId').change(function() {
            var selectedValue = $(this).val();
            var targeturl = $(this).attr('rel') + '?id=' + selectedValue;
            $.ajax({
                    type: 'get',
                    url: targeturl,
                    beforeSend: function(xhr) {
                            xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                    },
                    success: function(response) {
                            if (response) {
                                    $('#stateId').html(response);
                            }
                    },
                    error: function(e) {
                            
                    }
            });
    });
});
</script>    