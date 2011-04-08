<?
	/** Function replaceSpecialChars
	 * @author: KHALDI Christophe aka duke <christophe@khaldi.fr>
	 *
	 * @param char $dest_fichier
	 * @return char
	 */
	function replaceSpecialChars ($dest_fichier) {
		$dest_fichier = strtr($dest_fichier,
		'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ',
		'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
		// remplacer les caracteres autres que lettres, chiffres et point par _
		$dest_fichier = preg_replace('/([^.a-z0-9]+)/i', '-', $dest_fichier);
		return $dest_fichier;
	}
	
	
	/** Function replaceSpecialChars
	 * @author: KHALDI Christophe aka duke <christophe@khaldi.fr>
	 *
	 * @param char $dest_fichier
	 * @return char
	 */
	function replaceSpecialCharsUnderscore ($dest_fichier) {
		$dest_fichier = strtr($dest_fichier,
		'ÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ',
		'AAAAAACEEEEIIIIOOOOOUUUUYaaaaaaceeeeiiiioooooouuuuyy');
		// remplacer les caracteres autres que lettres, chiffres et point par _
		$dest_fichier = preg_replace('/([^.a-z0-9]+)/i', '_', $dest_fichier);
		return $dest_fichier;
	}
	
	
	
	/** Function fieldText
	* @author: KHALDI Christophe aka duke <christophe@khaldi.fr>
	* 
	* @param: TO DO !!!!!!!!!!!!!!
	* @return HTML Table code
	*/
	function fieldText( $id, $name, $value, $size = 10, $maxlength = 255, $sOptions = null ) {
		$options = empty($sOptions['class']) == false ? ' class="'.$sOptions['class'].'"' : '';
		$options .= empty($sOptions['style']) == false ? ' style="'.$sOptions['style'].'"' : '';
		$options .= empty($sOptions['onchange']) == false ? ' onchange="'.$sOptions['onchange'].'"' : '';
		$options .= empty($sOptions['onmouseover']) == false ? ' onmouseover="'.$sOptions['onmouseover'].'"' : '';
		$options .= empty($sOptions['onmouseout']) == false ? ' onmouseout="'.$sOptions['onmouseout'].'"' : '';
		$options .= empty($sOptions['readonly']) == false ? ' readonly' : '';
		
		$return = '<input id="'.$id.'" type="text" name="'.$name.'" value="'.$value.'" size="'.$size.'" maxlength="'.$maxlength.'" '.$options.' />';
		return $return;
	}
	
	
	/** Function fieldPassword
	* @author: KHALDI Christophe aka duke <christophe@khaldi.fr>
	* 
	* @param: TO DO !!!!!!!!!!!!!!
	* @return HTML Table code
	*/
	function fieldPassword( $id, $name, $value, $size = 10, $maxlength = 255, $sOptions = null ) {
		$options = empty($sOptions['style']) == false ? ' style="'.$sOptions['style'].'"' : '';
		$options .= empty($sOptions['onchange']) == false ? ' onchange="'.$sOptions['onchange'].'"' : '';
		$options .= empty($sOptions['onmouseover']) == false ? ' onmouseover="'.$sOptions['onmouseover'].'"' : '';
		$options .= empty($sOptions['onmouseout']) == false ? ' onmouseout="'.$sOptions['onmouseout'].'"' : '';
		$options .= empty($sOptions['readonly']) == false ? ' readonly' : '';
		
		$return = '<input id="'.$id.'" type="password" name="'.$name.'" value="'.$value.'" size="'.$size.'" maxlength="'.$maxlength.'" '.$options.' />';
		return $return;
	}
	
	
	/** Function fieldFile
	* @author: KHALDI Christophe aka duke <christophe@khaldi.fr>
	* 
	* @param: TO DO !!!!!!!!!!!!!!
	* @return HTML Table code
	*/
	function fieldFile( $id, $name, $value, $size = 10, $maxlength = 255,  $sOptions = null ) {
		$options = empty($sOptions['style']) == false ? ' style="'.$sOptions['style'].'"' : '';
		$options .= empty($sOptions['class']) == false ? ' class="'.$sOptions['class'].'"' : '';
		$options .= empty($sOptions['onchange']) == false ? ' onchange="'.$sOptions['onchange'].'"' : '';
		$options .= empty($sOptions['onmouseover']) == false ? ' onmouseover="'.$sOptions['onmouseover'].'"' : '';
		$options .= empty($sOptions['onmouseout']) == false ? ' onmouseout="'.$sOptions['onmouseout'].'"' : '';
		
		$return = '<input id="'.$id.'" type="file" name="'.$name.'" value="'.$value.'" size="'.$size.'" maxlength="'.$maxlength.'" '.$options.' />';
		return $return;
	}
	
	
	/** Function fieldHidden
	* @author: KHALDI Christophe aka duke <christophe@khaldi.fr>
	* 
	* @param: TO DO !!!!!!!!!!!!!!
	* @return HTML Table code
	*/
	function fieldHidden( $id, $name, $value, $sOptions = null ) {
		$options = empty($sOptions['style']) == false ? ' style="'.$sOptions['style'].'"' : '';
		$options .= empty($sOptions['onchange']) == false ? ' onchange="'.$sOptions['onchange'].'"' : '';
		$options .= empty($sOptions['onmouseover']) == false ? ' onmouseover="'.$sOptions['onmouseover'].'"' : '';
		$options .= empty($sOptions['onmouseout']) == false ? ' onmouseout="'.$sOptions['onmouseout'].'"' : '';
		
		$return = '<input id="'.$id.'" type="hidden" name="'.$name.'" value="'.$value.'" '.$options.' />';
		return $return;
	}
	
	
	/** Function fieldRadio
	* @author: KHALDI Christophe aka duke <christophe@khaldi.fr>
	* 
	* @param: TO DO !!!!!!!!!!!!!!
	* @return HTML Table code
	*/
	function fieldRadio( $id, $name, $value,  $sOptions = null ) {
		$options = empty($sOptions['style']) == false ? ' style="'.$sOptions['style'].'"' : '';
		$options .= empty($sOptions['onmouseover']) == false ? ' onmouseover="'.$sOptions['onmouseover'].'"' : '';
		$options .= empty($sOptions['onmouseout']) == false ? ' onmouseout="'.$sOptions['onmouseout'].'"' : '';
		$options .= empty($sOptions['readonly']) == false ? ' readonly' : '';
		$options .= empty($sOptions['checked']) == false ? ' checked="'.$sOptions['checked'].'"' : '';
		
		$return = '<input id="'.$id.'" type="radio" name="'.$name.'" value="'.$value.'" '.$options.' />';
		return $return;
	}
	
	
	/** Function fieldCheckbox
	* @author: KHALDI Christophe aka duke <christophe@khaldi.fr>
	* 
	* @param: TO DO !!!!!!!!!!!!!!
	* @return HTML Table code
	*/
	function fieldCheckbox( $id, $name, $value,  $sOptions = null ) {
		$options = empty($sOptions['style']) == false ? ' style="'.$sOptions['style'].'"' : '';
		$options .= empty($sOptions['onmouseover']) == false ? ' onmouseover="'.$sOptions['onmouseover'].'"' : '';
		$options .= empty($sOptions['onmouseout']) == false ? ' onmouseout="'.$sOptions['onmouseout'].'"' : '';
		$options .= empty($sOptions['readonly']) == false ? ' readonly' : '';
		$options .= empty($sOptions['checked']) == false ? ' checked' : '';
		
		$return = '<input id="'.$id.'" type="checkbox" name="'.$name.'" value="'.$value.'" '.$options.' />';
		return $return;
	}
	
	
	/** Function fieldSelect
	* @author: KHALDI Christophe aka duke <christophe@khaldi.fr>
	* 
	* @param: TO DO !!!!!!!!!!!!!!
	* @return HTML Table code
	*/
	function fieldSelect ( $id, $name, $arrValues, $selected, $sOptions = null ) {
		if ( sizeof($arrValues) > 0 ) {
			$return = '<select id="'.$id.'" name="'.$name.'"';
			$return .= empty($sOptions['class']) == false ? ' class="'.$sOptions['class'].'"' : '';
			$return .= empty($sOptions['size']) == false ? ' size="'.$sOptions['size'].'"' : '';
			$return .= empty($sOptions['style']) == false ? ' style="'.$sOptions['style'].'"' : '';
			$return .= empty($sOptions['onchange']) == false ? ' onchange="'.$sOptions['onchange'].'"' : '';
			$return .= empty($sOptions['onmouseover']) == false ? ' onmouseover="'.$sOptions['onmouseover'].'"' : '';
			$return .= empty($sOptions['onmouseout']) == false ? ' onmouseout="'.$sOptions['onmouseout'].'"' : '';
			$return .= empty($sOptions['readonly']) == false ? ' readonly="readonly"' : '';
			$return .= empty($sOptions['disabled']) == false ? ' disabled' : '';
			$return .= '>';
			foreach ( $arrValues as $k=>$v ) {
				$return .= '<option value="'.$k.'"'.($selected == $k ? ' selected' : '').'>'.$v.'</option>';
			}
			$return .= '</select>';
			
			return $return;
		}
	}
	
	
?>