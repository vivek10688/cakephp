<script type="text/javascript">
    $(document).ready(function(){        
        $('#start_date').datetimepicker({locale:'<?php echo$configLanguage;?>',format:'<?php echo $dpFormat;?>'});
        $('#end_date').datetimepicker({locale:'<?php echo$configLanguage;?>',format:'<?php echo $dpFormat;?>',useCurrent: false //Important! See issue #1075
        });
        $("#start_date").on("dp.change", function (e) {
            $('#end_date').data("DateTimePicker").minDate(e.date);
        });
        $("#end_date").on("dp.change", function (e) {
            $('#start_date').data("DateTimePicker").maxDate(e.date);
        });	
});
</script>
<div class="row">
    <div  class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
			<div class="widget">
				<h4 class="widget-title"> <span><?php echo __('Sales Report');?></span></h4>
			</div>
		</div>
		<div class="row mrg">
		    <?php if($dateBetween==false){?>
		    <div  class="col-sm-offset-2 col-md-3">
			<div><button class="btn btn-primary" type="button"><?php echo __('Total Sales Count this month');?> <span class="badge"><?php echo$monthSalesCount;?></span>
			<br/><br/><?php echo __('Total Earning this month');?> <span class="badge"><?php echo$currency.$this->Number->format($earningMonth,2);?></span></button></div>
		    </div>
		    <?php }?>
		   <div  class="col-sm-offset-1 col-md-3">
			<div><button class="btn btn-primary" type="button"><?php if($dateBetween==false){?><?php echo __('Total');?><?php }?> <?php echo __('Sales Count');?> <span class="badge"><?php echo$totalSalesCount;?></span>
			<br/><br/><?php if($dateBetween==false){?>Total<?php }?> <?php echo __('Earning');?> <span class="badge"><?php echo$currency.$this->Number->format($totalEearning,2);?></span></button></div>
		    </div>
		</div>
		<?php echo $this->Form->create(array('name'=>'searchfrm','action' => 'index'));?>
		<div class="row mrg">
		<div class="col-sm-2">
			<?php echo $this->Form->input('date',array('type'=>'date','dateFormat' => 'Y','minYear' => 2014,'maxYear' => date('Y') + 5 ,'empty'=>'Year','label' => false,'class'=>'form-control','div'=>false));?>
		    </div>
		     <div class="col-sm-2">
			<?php echo $this->Form->select('plan_id',$planName,array('empty'=>__('All Plan'),'label' => false,'class'=>'form-control','div'=>false));?>
		    </div>
		     <label for="group_name" class="col-sm-1 control-label"><strong><?php echo __('Date');?></strong></label>
		     <div class="col-md-2">
			<div class="input-group date" id="start_date">                        
                            <?php echo $this->Form->input('start_date',array('type'=>'text','label' => false,'class'=>'form-control','div'=>false));?>
                            <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>
		    </div>
		    <div class="col-md-2">
			<div class="input-group date" id="end_date">
                           <?php echo $this->Form->input('end_date',array('type'=>'text','id'=>'end_date','label' => false,'class'=>'form-control','div'=>false));?>
                           <span class="input-group-addon"><span class="glyphicon glyphicon-calendar"></span></span>
                        </div>
		    </div>
		    <div class="col-md-3">
			<button type="submit" class="btn btn-success btn-sm"><span class="fa fa-search"></span> <?php echo __('Search');?></button>
			<?php echo$this->Html->link('<span class="fa fa-refresh"></span>&nbsp;'.__('Reset'),array('controller'=>'Salesreports','action'=>'index'),array('class'=>'btn btn-warning btn-sm','escape'=>false));?>
		    </div>
		</div>
		<?php echo$this->Form->end();?>
		<?php if($dateBetween==false){?>
		<div class="chart">
		    <div id="mywrapperdl"></div>
			<?php echo $this->HighCharts->render("My Chartdl");?>
		</div>
             <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <tr>
                            <th><?php echo __('Month');?></th>
                            <th><?php echo __('Sales Count');?></th>
                            <th><?php echo __('Earning');?></th>			    
                        </tr>
                        <?php $totCount=0;$totEarning=0;
			foreach ($salesReport as $post):
			$totCount=$post['MonthArr']['salesCount']+$totCount;
			$totEarning=$post['MonthArr']['earning']+$totEarning;?>
                        <tr>
                            <td><?php echo$post['MonthArr']['monthName'];?></td>
                            <td><?php echo$post['MonthArr']['salesCount'];?></td>
                            <td><?php echo$currency.$this->Number->format($post['MonthArr']['earning'],2);?></td>			    
                        </tr>
                        <?php endforeach; ?>
                        <?php unset($post); ?>
			<tr class="info">
			    <td><strong><?php echo __('Total');?></strong></td>
                            <td><strong><?php echo$totCount;?></strong></td>
                            <td><strong><?php echo$currency.$this->Number->format($totEarning,2);?></strong></td>
			</tr>
                        </table>
                </div>
		<?php }?>
        </div>
    </div>
</div>