<?php
/**
 *
 * @author sahil <sahil.ismail@provabmail.com>
 *
 */
class Meta {
	
	function initialize_meta_info()
	{
		 $domain_details = $GLOBALS ['CI']->custom_db->single_table_records ( 'domain_address', '*');
		 //debug($domain_details);die;
		if ($domain_details == true and count ( $domain_details ) >= 1) {
			$domain_details = $domain_details ['data'] [0];
			$this->CI->entity_domain_name = $domain_details ['domain_name'];
			//debug($this->CI->entity_domain_name);die;
			//$this->CI->application_domain_logo = $domain_details['domain_logo'];
			$this->CI->entity_domain_website = $domain_details ['domain_webiste'];
		}

		 if(empty($module) == false){
			if($module == 'contact'){
				$module = 'contact';
			}
			else if($module == 'about'){
				$module = 'about';
			}
			else{
				$module ='general';
			}
		}
		else{
			$module ='general';
		}
		$seo_details = $GLOBALS ['CI']->custom_db->single_table_records ( 'seo', '*',array('module' => $module) );
		define('HEADER_DOMAIN_WEBSITE', $this->CI->entity_domain_website);
		define('HEADER_DOMAIN_NAME', $this->CI->entity_domain_name);
		if($seo_details['status'] == SUCCESS_STATUS){
            define('HEADER_TITLE_SUFFIX', $seo_details['data'][0]['title']); // Common Suffix For All Pages
			define('META_KEYWORDS', $seo_details['data'][0]['keyword']); // Common Suffix For All Pages
			define('META_DESCRIPTION', $seo_details['data'][0]['description']); // Common Suffix For All Pages
		}else{
			if (empty($this->CI->entity_domain_name) == false) {
				define('HEADER_TITLE_SUFFIX', ' - Welcome'.$this->CI->entity_domain_name); // Common Suffix For All Pages
			} else {
				define('HEADER_TITLE_SUFFIX', ' - Welcome Travels'); // Common Suffix For All Pages
			}
			define('META_KEYWORDS', HEADER_TITLE_SUFFIX. "About Us,Contact Us,Join us,Screening Questions");
			define('META_DESCRIPTION', 'Screening Questions for patients, About Us,Contact Us,Join us');
		}
	}
}?>