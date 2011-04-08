{* PARAMS
	$field_name - Name of field
	$field_options - Option field
	$field_value - Posted value for this field
	$field_more - More option like title, onclick, onmouseover etc.
*}
<select id="id_{$field_name}" name="{$field_name}" size="1" {$field_more}>
{foreach from=$field_options key=optkey item=optvalue}
<optgroup label="{$optkey}">
{foreach from=$optvalue key=groupkey item=groupvalue}
<option label="{$groupvalue}" value="{$groupkey}"{if $field_value == $groupkey} selected="selected"{/if}>{$groupvalue}</option>
{/foreach}
</optgroup>
{/foreach}
</select>