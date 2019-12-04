
<div id="message1">


<?php echo $this->Form->create('Type', array(
  'id' => 'form_type',
  'type' => 'file',
  'method' => 'POST',
  'autocomplete' => 'off',
  'url' => '/Format/radioSelect',
  'inputDefaults' => array(
    'label' => false,
    'div' => false,
    'type' => 'text',
    'required' => false
  )
)); ?>
	
<?php echo __("Hi, please choose a type below:"); ?>
<br><br>

<?php $options_new = array(
  'Type1' => __(
    '<span class="hover" data-radio="#TypeTypeType1" style="color:blue">Type 1
	 			<span class="tooltiptext">Lorem Ip Sum</span>
			</span>'
  ),
  'Type2' => __(
    '<span class="hover" data-radio="#TypeTypeType2" style="color:blue">Type 2
	 			<span class="tooltiptext">Lorem Ip Sum 2</span>
			</span>'
  )
); ?>

<?php echo $this->Form->input('type', array(
  'legend' => false,
  'type' => 'radio',
  'options' => $options_new,
  'before' => '<label class="radio line notcheck">',
  'after' => '</label>',
  'separator' => '</label><label class="radio line notcheck">'
)); ?>


<?php echo $this->Form->end('Save'); ?>

</div>

<style>
.showDialog:hover{
	text-decoration: underline;
}

#message1 .radio{
	vertical-align: top;
	font-size: 13px;
}

.control-label{
	font-weight: bold;
}

.wrap {
	white-space: pre-wrap;
}

.hover {
  position: relative;
  display: inline-block;
}

.hover .tooltiptext {
  visibility: hidden;
  width: 120px;
  background-color: black;
  color: #fff;
  text-align: center;
  padding: auto;
 
  position: absolute;
  right: -130px;
  top: 0;
  z-index: 1;
}

.hover:hover .tooltiptext {
  visibility: visible;
}

</style>

<?php $this->start('script_own'); ?>
<script>

$(document).ready(function(){
	$(".dialog").dialog({
		autoOpen: false,
		width: '500px',
		modal: true,
		dialogClass: 'ui-dialog-blue'
	});

});


</script>
<?php $this->end(); ?>
