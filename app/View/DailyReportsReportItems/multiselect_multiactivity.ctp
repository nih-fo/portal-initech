<?php 

$this->Local->setSortableActivities($activities);

// content
$th = array(
	'ReportItem.item' => array('content' => __('Item'), 'options' => array('sort' => 'ReportItem.item')),
	'ReportItem.activity_id' => array('content' => __('Current %s', __('Activity')), 'options' => array('sort' => 'ReportItem.activity_id')),
	'activity_id' => array('content' => __('Select %s', __('Activity')), 'options' => array('class' => 'actions')),
);

$td = array();
foreach ($dailyreports_reportitems as $i => $dailyreports_reportitem)
{
	$actions = $this->Form->input('ReportItem.'.$i.'.id', array('type' => 'hidden', 'value' => $dailyreports_reportitem['ReportItem']['id']));
	$actions .= $this->Form->input('ReportItem.'.$i.'.activity_id', array(
	        					'div' => false,
	        					'label' => false,
								'empty' => __('[ None ]'),
	        					'options' => $activities,
	        					'selected' => $dailyreports_reportitem['ReportItem']['activity_id'],
	        				));
	
	$td[$i] = array(
		$dailyreports_reportitem['ReportItem']['item'],
		$this->Local->getSortableActivities($dailyreports_reportitem['ReportItem']['activity_id']),
		array(
			$actions,
			array('class' => 'actions'),
		),
	);
}

$before_table = false;
$after_table = false;

if($td)
{
	$before_table = $this->Form->create('DailyReportsReportItem', array('url' => array('action' => 'multiselect_multiactivity')));
	$after_table = $this->Form->end(__('Save'));
}

echo $this->element('Utilities.page_index', array(
	'page_title' => __('Select an %s for each %s', __('Activity'), __('Report Item')),
	'use_search' => false,
	'th' => $th,
	'td' => $td,
	'before_table' => $before_table,
	'after_table' => $after_table,
));