{* PARAMS
	$field_name - Name of field
	$field_value - Posted value for this field
	$field_more - More option like title, onclick, onmouseover etc.
	$field_cols - Cols
	$field_rows - Rows
*}
<textarea id="id_{$field_name}" name="{$field_name}" cols="{if $field_cols}{$field_cols}{else}20{/if}" rows="{if $field_rows}{$field_rows}{else}4{/if}" {$field_more}>{$field_value}</textarea>