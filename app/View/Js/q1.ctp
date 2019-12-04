<div class="alert  ">
<button class="close" data-dismiss="alert"></button>
Question: Advanced Input Field</div>

<p>
1. Make the Description, Quantity, Unit price field as text at first. When user clicks the text, it changes to input field for use to edit. Refer to the following video.

</p>


<p>
2. When user clicks the add button at left top of table, it wil auto insert a new row into the table with empty value. Pay attention to the input field name. For example the quantity field

<?php echo htmlentities(
  '<input name="data[1][quantity]" class="">'
); ?> ,  you have to change the data[1][quantity] to other name such as data[2][quantity] or data["any other not used number"][quantity]

</p>



<div class="alert alert-success">
<button class="close" data-dismiss="alert"></button>
The table you start with</div>

<table class="table table-striped table-bordered table-hover">
<thead>
<th><span id="add_item_button" class="btn mini green addbutton" onclick="addToObj=false">
											<i class="icon-plus"></i></span></th>
<th>Description</th>
<th>Quantity</th>
<th>Unit Price</th>
</thead>

<tbody>
<tr id="tr_1">
	<td class="line"><i class="icon-remove" id="remove_1"></i></td>
	<td id="td_1_1" class="td description">
		<div id="text_1_1"></div>
		<textarea name="data[1][description]" id="input_1_1" class="input m-wrap  description required" rows="2" style="display:none;"></textarea>
	</td>
	<td id="td_1_2" class="td quantity"><div id="text_1_2"></div><input name="data[1][quantity]" id="input_1_2" class="input" style="display:none;"></td>
	<td id="td_1_3" class="td unit"><div id="text_1_3"></div><input name="data[1][unit_price]" id="input_1_3" class="input" style="display:none;"></td>
</tr>

</tbody>

</table>


<p></p>

<style>
textarea,input {
	width: 98%;
    height: 100%;
}
.description{
	width: 500px;
}
.line {
	width: 5%;
}
.quantity{
	width: 20%;
}
.unit{
	width: 20%;
}
</style>

<?php $this->start('script_own'); ?>
<script>
$(document).ready(function(){
	let index = 1;
	$('#add_item_button').click(function(){
		index++;
		const new_line = '<tr id="tr_'+index+'"><td class="line"><i class="icon-remove" id="remove_'+index+'"></i></td><td id="td_'+index+'_1" class="td description"><div id="text_'+index+'_1"></div>' +
						'<textarea name="data['+index+'][description]" id="input_'+index+'_1" class="input m-wrap  description required" rows="2" style="display:none;"></textarea></td>' +
						'<td id="td_'+index+'_2" class="td quantity"><div id="text_'+index+'_2"></div><input name="data['+index+'][quantity]" id="input_'+index+'_2" class="input" style="display:none;"></td>' +
						'<td id="td_'+index+'_3" class="td unit"><div id="text_'+index+'_3"></div><input name="data['+index+'][unit_price]" id="input_'+index+'_3" class="input" style="display:none;"></td>';
		$('.table').append(new_line);
		});
	$('.table').on('click', '.icon-remove', function(){
		const id =  $(this).attr('id').replace('remove','');
		$('#tr'+id).remove();
	});
	$('.table').on('click','.td',function() {
		const id =  $(this).attr('id').replace('td','');
		$('#text'+id).css( 'display', 'none');
		$('#input'+id).val( $('#text'+id).text()).css( 'display', '').focus();
	});
	$('.table').on('blur','.input',function() {
		const id =  $(this).attr('id').replace('input','');
		$('#input'+id).css( 'display', 'none');
		$('#text'+id).text($('#input'+id).val()).css( 'display', '');
	});
});
</script>
<?php $this->end(); ?>
