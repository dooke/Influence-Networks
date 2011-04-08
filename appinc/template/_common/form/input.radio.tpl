{* PARAMS
	$field_name - Name of field
	$field_options - Option field
	$field_value - Posted value for this field
	$field_more - More option like title, onclick, onmouseover etc.
*}
{foreach from=$field_options key=optkey item=optvalue}
<input type="radio"  name="{$field_name}" value="{$optkey}"{if $field_value == $optkey} checked{/if} /> {$optvalue}
{/foreach}