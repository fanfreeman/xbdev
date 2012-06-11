<?php
/*
include("sphinxapi.php");
$s = new SphinxClient();
$s->setServer("localhost", 9312);
$s->setMatchMode(SPH_MATCH_ANY);
$s->setMaxQueryTime(3);

$result = $s->query("newsfeed");

var_dump($result);
*/
//print_r($s->getLastError());

/**
		 * Searches the users using Sphinx.
		 *
		 * @access public
		 * @param string $strSearchTerm The search term to query for
		 * @param array $arrFilters Any additional filters as well as the limits
		 * @param boolean $blnCalcFoundRows Whether to calculate the total number of matching rows
		 * @return boolean True if the search executed successfully
		 */
searchAll("tamade");
		 function searchAll($strSearchTerm, $arrFilters = array(), $blnCalcFoundRows = true) {
			
			//$arrConfig = AppConfig::load('sphinx', 'sphinx');
			//AppLoader::includeExtension('sphinx/', 'sphinxapi', true);
			include("sphinxapi.php");
			
			$objSphinx = new SphinxClient();
			//$objSphinx->SetServer($arrConfig['SphinxServer'], $arrConfig['SphinxPort']);
			$objSphinx->setServer("localhost", 9312);
			$objSphinx->SetMatchMode(SPH_MATCH_ANY);
			$objSphinx->SetIndexWeights(array(
				'params'=> 100, 
				'group_id'	=> 20
			));
			
			if (isset($arrFilters['Offset']) && isset($arrFilters['Limit'])) {
				$objSphinx->SetLimits((int) $arrFilters['Offset'], (int) $arrFilters['Limit']);
			}
			
			if (($arrResult = $objSphinx->Query($strSearchTerm)) !== false) {
				
				
				if (isset($arrResult['matches'])) {
					var_dump($arrResult['matches']);
					print_r(array_keys($arrResult['matches']));
					//echo $arrResult['total_found'];
					//$blnResult = $this->loadById(array_keys($arrResult['matches']));
					//if ($blnCalcFoundRows) {
					//	$this->intFoundRows = $arrResult['total_found'];
					//}
				} else {
					$blnResult = true;
					print("Not found");
					if ($blnCalcFoundRows) {
					//	$this->intFoundRows = 0;
					}
				}
			
			
			} else if ($strError = $objSphinx->GetLastError()) {
				trigger_error($strError);
			} else if ($strWarning = $objSphinx->GetLastWarning()) {
				trigger_error($strWarning);
			}
			
			return !empty($blnResult);
		}

?>