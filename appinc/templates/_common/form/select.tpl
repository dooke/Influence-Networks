{* PARAMS
	$field_name - Name of field
	$field_options - Option field
	$field_value - Posted value for this field
	$field_more - More option like title, onclick, onmouseover etc.
*}
<select id="id_{$field_name}" name="{$field_name}" size="1" {$field_more}>
{foreach from=$field_options key=optkey item=optvalue}
<option value="{$optkey}"{if $field_value == $optkey} selected="selected"{/if}>{$optvalue}</option>
{/foreach}
</select>