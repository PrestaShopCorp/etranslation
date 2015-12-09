<?php
/**
 * etranslation traduction agence  
 * 
 * @author    contact@dream-it.ma>
 * @copyright 2015, Dream-it
 * @license   http://www.opensource.org/licenses/MIT
*/

if (!defined('_PS_VERSION_'))
exit;

require_once(dirname(__FILE__)."/classes/etbusiness.class.php");


class etranslation extends Module {

	
	public function __construct() {
		$this->name = 'etranslation';
		$this->tab = 'i18n_localization';
		$this->version = '2.0.1';
		$this->module_key = "";
		$this->author = 'Dream-IT';
		$this->ps_versions_compliancy = array('min' => '1.4', 'max' => '1.6');


		parent::__construct();

		$this->displayName = $this->l('e-translation');
		$this->description = $this->l('Vendez à l\'internationnal en traduisant votre site avec www.e-translation-agency.com,  l\'agence de traduction Nº1 dans e  e-commerce. Devis gratuit sans engagement / répétitions non facturées!.  Traducteurs natifs, diplômé en traductions et specialisés dans le secteur.  Traductions  multilingues optimisées  SEO . Traduction clé en main :   automatisation extraction des contenus (CMS, fiches produits...), intégration des traductions, identification des actualisations');
		$this->confirmUninstall = $this->l('Are you sure you want to delete this module ?');
	}



	private function _razSql() {
		return true;
	}




	





	// " controller " of the data backup + Module configuration form
	public function getContent() {
		// Retrocompatibility
		
		$this->initContext();

		
	
		$message="";
		$etbusiness=new ETBusiness();
		//Save operation

		if (Tools::isSubmit('submitForm')) {
			$l_filename='';
			Configuration::updateValue('ET_DATE_LAST_EXEC',Tools::getValue('et_date_last_exec'));
			$email = Tools::getValue('et_email');
			Configuration::updateValue('ET_EMAIL',Tools::getValue('et_email'));
			$etbusiness->f_log("============= CRON Processing (".date("d/m/y h:i:s").") ===============");
			// Recover updated products :
			$sql = 'SELECT id_product FROM '._DB_PREFIX_.'product WHERE date_upd>"'.pSQL(Configuration::get('ET_DATE_LAST_EXEC')).'"';
			$etbusiness->f_log( "Request running: ".$sql);
			$product_rows = Db::getInstance()->ExecuteS($sql);   

			$etbusiness->f_log( count($product_rows)." updated products..");
			$etbusiness->f_log( "products found : ".var_export($product_rows,true));
			// Recover updated CMS  :
			$sql = 'SELECT id_cms FROM '._DB_PREFIX_.'cms WHERE date_upd>"'.pSQL(Configuration::get('ET_DATE_LAST_EXEC')).'"';
			$etbusiness->f_log( "Request running : ".$sql);
			$cms_rows = Db::getInstance()->ExecuteS($sql);   

			$etbusiness->f_log( count($cms_rows)." updated cms..");
			$etbusiness->f_log( "cms found : ".var_export($cms_rows,true));

			// Recover updated  catgories :
			$sql = 'SELECT id_category FROM '._DB_PREFIX_.'category WHERE date_upd>"'.pSQL(Configuration::get('ET_DATE_LAST_EXEC')).'"';
			$etbusiness->f_log( "Request running : ".$sql);
			$categ_rows = Db::getInstance()->ExecuteS($sql);   

			$etbusiness->f_log( count($categ_rows)." updated categories..");
			$etbusiness->f_log( "categories found : ".var_export($categ_rows,true));

			// mise à jour de la date pivot de recherche
			Configuration::updateValue('ET_DATE_LAST_EXEC',date("Y-m-d H:i:s"));

			$l_filename='';
			if(!empty($product_rows) || !empty($cms_rows)) {
				
				$etbusiness->f_doExport(Configuration::get('PS_LANG_DEFAULT'), $product_rows, $cms_rows, $categ_rows, $l_filename);
			}
			$srv = $_SERVER['SERVER_NAME'];
			
			$mail_txt="<div width='100%' style='background-color:black'><img class='CToWUd' src='https://ci3.googleusercontent.com/proxy/iMH-S1NXjD2_MoltKbEHaDkJJcnhKwFa3ByJts2xWn7NOiPVwcUBEE2mosd0ojge010bXJKrJ9rqmcTggndYuIN_RnoJbubPaQrkt1iwUBFvtS0LER2e_EzdzHkNPA=s0-d-e1-ft#http://e-translation-agency.com/wp-content/uploads/2014/11/head-logo.png' alt='e-Translation Agency'></div></div><br><br><p>Hello, this email has been send by etranslation API of prestashop for asking for translation quote.<br></p>";
			$mail_txt.="<p>The module etranslation detected ".count($product_rows)." product(s) updated..<br>";
			$mail_txt.="Le module etranslation detected".count($cms_rows)."  CMS updated..</p>";
			$mail_txt.="<b><font size='4'>Client informations:</font></b><br><p><b>Email adresse :</b> " .$email."<br><b>website  :</b> ".$srv."</p>";

			$sent = $etbusiness->f_send_cron($email,$mail_txt,$l_filename);
					
				if(!$sent) {
					$message= $this->displayError($this->l('error sending the email'));
					} else {

						$message= $this->displayConfirmation($this->l('Configuration stored'));
					}


			$etbusiness->f_log( "============= End of process (".date("d/m/y h:i:s").") ===============");
			
			
		
		}
		elseif (Tools::isSubmit('sendfiles')) {
			$files = $etbusiness->f_files_list();
			$sent = $etbusiness->f_send_flsmail($files);
					
				if(!$sent) {
					$message= $this->displayError($this->l('error sending the email'));
					} else {

						$message= $this->displayConfirmation($this->l('Your request has been sent , you will receive our best quotation within 24 hour!'));
					}
		}
		elseif (Tools::isSubmit('doExport')) {
		
			$l_filename='';
            $explode =  explode('-',Tools::getValue('export_id_lang'));
            $extlgid = $explode[0];
            $extlgname = $explode[1];
			//die($extlgname);
			$extcatid =Tools::getValue('export_category_id');
			$extelemid = Tools::getValue('export_element_id');
			$datefirst = Tools::getValue('datedebut_id');
			$langdest = implode(", ",Tools::getValue('export_dest_lang_id'));
		
		
			$datesecond = Tools::getValue('datefin_id');
			$email = Tools::getValue('email');
			
			$coltotrid_str = implode(" ",Tools::getValue('columns_to_translate'));
			$coltotrid = explode(" ",$coltotrid_str);
			
			
			if ($email ==null || $email ==""){
				$message= $this->displayError($this->l('Please enter your email'));
			}else if ($langdest == null || $langdest == ""){
				$message= $this->displayError($this->l('Please check at least one language destination'));
			}else{
				if( $datefirst == null && $datesecond == null)
				{
					$etbusiness->f_doExporte($extlgid , 'all', 'all', 'all', $l_filename, $extcatid, $extelemid, $coltotrid,$datefirst, $datesecond);
				}else if ( $datefirst == null && $datesecond != null)
				{
				
					$sql = 'SELECT id_product FROM '._DB_PREFIX_.'product WHERE date_add < "'.$datesecond.'"';
					$product_rows = Db::getInstance()->ExecuteS($sql);
					

					$sql = 'SELECT id_cms FROM '._DB_PREFIX_.'cms ';
					$cms_rows = Db::getInstance()->ExecuteS($sql);  

					$sql = 'SELECT id_category FROM '._DB_PREFIX_.'category WHERE date_add < "'.$datesecond.'"';
					$categ_rows = Db::getInstance()->ExecuteS($sql); 
					
					$etbusiness->f_doExporte($extlgid, $product_rows, $cms_rows, $categ_rows, $l_filename, $extcatid, $extelemid, $coltotrid, $datefirst, $datesecond);
				}else if ( $datefirst != null && $datesecond == null)
				{
				
					$sql = 'SELECT id_product FROM '._DB_PREFIX_.'product WHERE date_add > "'.$datefirst.'"';
					$product_rows = Db::getInstance()->ExecuteS($sql);
					
					
					$sql = 'SELECT id_cms FROM '._DB_PREFIX_.'cms ';
					$cms_rows = Db::getInstance()->ExecuteS($sql);
					
					$sql = 'SELECT id_category FROM '._DB_PREFIX_.'category WHERE date_add > "'.$datefirst.'"';
					$categ_rows = Db::getInstance()->ExecuteS($sql); 
					
					
					$etbusiness->f_doExporte($extlgid, $product_rows, $cms_rows, $categ_rows, $l_filename, $extcatid, $extelemid, $coltotrid);
					
				}else if ( $datefirst != null && $datesecond != null)
				{
				
					$sql = 'SELECT id_product FROM '._DB_PREFIX_.'product WHERE date_add BETWEEN "'.$datefirst.'" AND "'.$datesecond.'"';
					$product_rows = Db::getInstance()->ExecuteS($sql);
					
					$sql = 'SELECT id_cms FROM '._DB_PREFIX_.'cms ';
					$cms_rows = Db::getInstance()->ExecuteS($sql);
					
					$sql = 'SELECT id_category FROM '._DB_PREFIX_.'category WHERE date_add BETWEEN "'.$datefirst.'" AND "'.$datesecond.'"';
					$categ_rows = Db::getInstance()->ExecuteS($sql); 
					
					$etbusiness->f_doExporte($extlgid, $product_rows, $cms_rows, $categ_rows, $l_filename, $extcatid, $extelemid, $coltotrid);
				}
				
				$sent = $etbusiness->f_send_mail($email,$extlgname,$langdest,$l_filename);
					
				if(!$sent) {
					$message= $this->displayError($this->l('error sending the email'));
					} else {

						$message= $this->displayConfirmation($this->l('Your request has been sent , you will receive our best quotation within 24 hour!!'));
					}
			}

		}
		elseif (Tools::isSubmit('doImport')) {
			$res=$etbusiness->f_doImport(Tools::getValue('import_id_lang'), $message);
			if($res==true) {
				$message= $this->displayConfirmation($this->l('Import successfully'));
			}else{
				$message=$this->displayError($message);
			}
		}

		if(!ETBusiness::f_test_directory('uploads/import')) {
			$message.=$this->displayError("The folder ".dirname(__FILE__)."/uploads/import is not writable !");
		}
		if(!ETBusiness::f_test_directory('uploads/export')) {
			$message.=$this->displayError("The folder ".dirname(__FILE__)."/uploads/export is not writable !");
		}
		if(!ETBusiness::f_test_directory('logs')) {
			$message.=$this->displayError("The folder ".dirname(__FILE__)."/logs is not writable !");
		}

		$this->context->smarty->assign ('module_displayName',$this->displayName);
		$this->context->smarty->assign ('module_name',$this->name);
		$this->context->smarty->assign ('message',$message);
		$this->context->smarty->assign ('shop_url',Tools::getHttpHost(true).__PS_BASE_URI__);

		$this->context->smarty->assign ('langues_actives',Language::getLanguages(false));
		$this->context->smarty->assign ('et_date_last_exec',Configuration::get('ET_DATE_LAST_EXEC'));
		$this->context->smarty->assign ('et_email',Configuration::get('ET_EMAIL'));
		
		$this->context->controller->addCSS($this->_path.'/views/css/help.css', 'all');
		$this->context->controller->addCSS($this->_path.'/views/css/bootstrap.min.css', 'all');
	
		
		$this->context->controller->addJS($this->_path.'/views/js/jquery-ui.js', 'all');

		
		$isoUser = Language::getIsoById(intval($this->context->employee->id_lang));
		
		if ($isoUser == "fr")
			return $this->display(__FILE__, 'views/templates/admin/setup_fr.tpl'); 
		else if ($isoUser == "es")
			return $this->display(__FILE__, 'views/templates/admin/setup_es.tpl'); 
		else
			return $this->display(__FILE__, 'views/templates/admin/setup_en.tpl'); 

	}




	private function initContext()
	{
		if (class_exists('Context'))
			$this->context = Context::getContext();
		else
		{
			global $smarty, $cookie;
			$this->context = new StdClass();
			$this->context->smarty = $smarty;
			$this->context->cookie = $cookie;
		}
	}

}
