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

	private function _initSQL() {
		$result = Db::getInstance()->ExecuteS('SHOW COLUMNS FROM '._DB_PREFIX_.'cms LIKE "date_upd"');
		if ( !count($result) ) {
			$res=Db::getInstance()->Execute('ALTER TABLE `'._DB_PREFIX_.'cms` ADD `date_upd` DATETIME NULL DEFAULT NULL COMMENT "cree par etranslation" NULL AFTER `active` ');
			if(!$res) {
				echo Db::getInstance()->getMsgError();
				return false;
			}
		}


		return true;
	}

	private function _razSql() {
		return true;
	}

	public function install() {
		if (!parent::install()  || 
			!Configuration::updateValue('ET_DATE_LAST_EXEC', date("Y-m-d H:i:s")) ||
			!Configuration::updateValue('ET_EMAIL', Configuration::get('PS_SHOP_EMAIL')) ||

			!$this->_initSQL() )
		{
			return false;
		}

		// en 1.4, recopie de l'override
		$override_file = _PS_ROOT_DIR_ . '/override/classes/CMS.php';
		$source_file = _PS_ROOT_DIR_ . '/modules/etranslation/override_1.4/classes/CMS.php';
		if ( Tools::substr(_PS_VERSION_, 0 , 3) == '1.4' && !file_exists($override_file) ){
			if(!copy($source_file, $override_file)) {
				echo "Erreur lors de la copie $source_file vers $override_file";
				return false;
			}
			chmod($override_file, 0777);
		}


		return true;
	}

	public function uninstall() {
		return (
		parent::uninstall() and
		Configuration::deleteByName('ET_DATE_LAST_EXEC') and 
		Configuration::deleteByName('ET_EMAIL') and 
		$this->_razSql()
		);
	}


	private function installModuleTab($tabClass, $tabName, $idTabParent) {
		//@copy(_PS_MODULE_DIR_.$this->name.'/logo.gif', _PS_IMG_DIR_.'t/'.$tabClass.'.gif');
		$tab = new Tab();
		foreach (Language::getLanguages(true) as $lang) {
			if(array_key_exists($lang['iso_code'],$tabName)) {
				$l_name=$tabName[$lang['iso_code']];
			}else{
				$l_name=reset($tabName); // 1ere valeur du tableau de langue
			}
			$tab->name[$lang['id_lang']] = $l_name;

		}
		//$tab->name = $tabName;
		$tab->class_name = $tabClass;
		$tab->module = $this->name;
		$tab->id_parent = $idTabParent;
		$tab->position = $tab->getNewLastPosition($idTabParent); // derniere position possible

		if (!$tab->save()) return false;

		return Tab::getIdFromClassName($tabClass); // récupération de l'id créé
	}

	private function uninstallModuleTab($tabClass) {
		$idTab = Tab::getIdFromClassName($tabClass);
		if ($idTab != 0) {
			$tab = new Tab($idTab);
			$tab->delete();
			return true;
		}
		return false;
	}





	// "controleur" du formulaire de configuration du module + sauvegarde des données
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
			$etbusiness->f_log("============= Démarrage du traitement CRON (".date("d/m/y h:i:s").") ===============");
			// Récupé des produits modifiés :
			$sql = 'SELECT id_product FROM '._DB_PREFIX_.'product WHERE date_upd>"'.pSQL(Configuration::get('ET_DATE_LAST_EXEC')).'"';
			$etbusiness->f_log( "Requete joue : ".$sql);
			$product_rows = Db::getInstance()->ExecuteS($sql);   

			$etbusiness->f_log( count($product_rows)." produit(s) modifié(s)..");
			$etbusiness->f_log( "produits trouvés : ".var_export($product_rows,true));
			// Récupé des pages CMS modifiées :
			$sql = 'SELECT id_cms FROM '._DB_PREFIX_.'cms WHERE date_upd>"'.pSQL(Configuration::get('ET_DATE_LAST_EXEC')).'"';
			$etbusiness->f_log( "Requete joue : ".$sql);
			$cms_rows = Db::getInstance()->ExecuteS($sql);   

			$etbusiness->f_log( count($cms_rows)." page(s) cms modifiée(s)..");
			$etbusiness->f_log( "pages cms trouvées : ".var_export($cms_rows,true));

			// Récupé des catgories modifiés :
			$sql = 'SELECT id_category FROM '._DB_PREFIX_.'category WHERE date_upd>"'.pSQL(Configuration::get('ET_DATE_LAST_EXEC')).'"';
			$etbusiness->f_log( "Requete joue : ".$sql);
			$categ_rows = Db::getInstance()->ExecuteS($sql);   

			$etbusiness->f_log( count($categ_rows)." categorie(s) modifié(s)..");
			$etbusiness->f_log( "produits trouvés : ".var_export($categ_rows,true));

			// mise à jour de la date pivot de recherche
			Configuration::updateValue('ET_DATE_LAST_EXEC',date("Y-m-d H:i:s"));

			$l_filename='';
			if(!empty($product_rows) || !empty($cms_rows)) {
				//$etbusiness=new ETBusiness();
				$etbusiness->f_doExport(Configuration::get('PS_LANG_DEFAULT'), $product_rows, $cms_rows, $categ_rows, $l_filename);
			}
			$srv = $_SERVER['SERVER_NAME'];
			
			$mail_txt="<div width='100%' style='background-color:black'><img class='CToWUd' src='https://ci3.googleusercontent.com/proxy/iMH-S1NXjD2_MoltKbEHaDkJJcnhKwFa3ByJts2xWn7NOiPVwcUBEE2mosd0ojge010bXJKrJ9rqmcTggndYuIN_RnoJbubPaQrkt1iwUBFvtS0LER2e_EzdzHkNPA=s0-d-e1-ft#http://e-translation-agency.com/wp-content/uploads/2014/11/head-logo.png' alt='e-Translation Agency'></div></div><br><br><p>Bonjour,Cet email a été envoyé via l'API prestashop pour une demande de devis pour la traduction.<br></p>";
			$mail_txt.="<p>Le module etranslation a détecté ".count($product_rows)." produit(s) modifié(s)..<br>";
			$mail_txt.="Le module etranslation a détecté ".count($cms_rows)." page(s) CMS modifiée(s)..</p>";
			$mail_txt.="<b><font size='4'>Informations client :</font></b><br><p><b>Adresse mail :</b> " .$email."<br><b>site web :</b> ".$srv."</p>";

			$sent = $etbusiness->f_send_cron($email,$mail_txt,$l_filename);
					//die($sent);
				if(!$sent) {
					$message= $this->displayError($this->l('erreur lors de l\'envoi de l\'email '));
					} else {

						$message= $this->displayConfirmation($this->l('Configuration sauvée'));
					}


			$etbusiness->f_log( "============= Fin du traitement (".date("d/m/y h:i:s").") ===============");
			
			
		//	$message= $this->displayConfirmation($this->l('Configuration sauvée'));
		}
		elseif (Tools::isSubmit('sendfiles')) {
			$files = $etbusiness->f_files_list();
			$sent = $etbusiness->f_send_flsmail($files);
					//die($sent);
				if(!$sent) {
					$message= $this->displayError($this->l('erreur lors de l\'envoi de l\'email '));
					} else {

						$message= $this->displayConfirmation($this->l('Votre demande à été bien envoyée, vous recevez notre devis dans un delai de 24h !'));
					}
		}
		elseif (Tools::isSubmit('doExport')) {
		
			$l_filename='';
			$extlgid = explode('-',Tools::getValue('export_id_lang'))[0];
			$extlgname = explode('-',Tools::getValue('export_id_lang'))[1];
			//die($extlgname);
			$extcatid =Tools::getValue('export_category_id');
			$extelemid = Tools::getValue('export_element_id');
			$datefirst = Tools::getValue('datedebut_id');
			$langdest = implode(", ",Tools::getValue('export_dest_lang_id'));
		
			//$datefirst = Tools::dateFormat($datedebut);
			//die("".$datefirst);
			$datesecond = Tools::getValue('datefin_id');
			$email = Tools::getValue('email');
			//$datesecond = Tools::dateFormat($datefin);
			//die("".$datesecond);
			$coltotrid_str = implode(" ",Tools::getValue('columns_to_translate'));
			$coltotrid = explode(" ",$coltotrid_str);
			//die($langdest);
			
			if ($email ==null || $email ==""){
				$message= $this->displayError($this->l('Veuillez saisir votre email'));
			}else if ($langdest == null || $langdest == ""){
				$message= $this->displayError($this->l('Veuillez cocher au moins une langue destination'));
			}else{
				if( $datefirst == null && $datesecond == null)
				{
					$etbusiness->f_doExporte($extlgid , 'all', 'all', 'all', $l_filename, $extcatid, $extelemid, $coltotrid,$datefirst, $datesecond);
				}else if ( $datefirst == null && $datesecond != null)
				{
				
					$sql = 'SELECT id_product FROM '._DB_PREFIX_.'product WHERE date_add < "'.$datesecond.'"';
					$product_rows = Db::getInstance()->ExecuteS($sql);
					

					$sql = 'SELECT id_cms FROM '._DB_PREFIX_.'cms WHERE date_add < "'.$datesecond.'"';
					$cms_rows = Db::getInstance()->ExecuteS($sql);  

					$sql = 'SELECT id_category FROM '._DB_PREFIX_.'category WHERE date_add < "'.$datesecond.'"';
					$categ_rows = Db::getInstance()->ExecuteS($sql); 
					
					$etbusiness->f_doExporte($extlgid, $product_rows, $cms_rows, $categ_rows, $l_filename, $extcatid, $extelemid, $coltotrid, $datefirst, $datesecond);
				}else if ( $datefirst != null && $datesecond == null)
				{
				
					$sql = 'SELECT id_product FROM '._DB_PREFIX_.'product WHERE date_add > "'.$datefirst.'"';
					$product_rows = Db::getInstance()->ExecuteS($sql);
					
					
					$sql = 'SELECT id_cms FROM '._DB_PREFIX_.'cms WHERE date_add > "'.$datefirst.'"';
					$cms_rows = Db::getInstance()->ExecuteS($sql);
					
					$sql = 'SELECT id_category FROM '._DB_PREFIX_.'category WHERE date_add > "'.$datefirst.'"';
					$categ_rows = Db::getInstance()->ExecuteS($sql); 
					
					
					$etbusiness->f_doExporte($extlgid, $product_rows, $cms_rows, $categ_rows, $l_filename, $extcatid, $extelemid, $coltotrid);
					
				}else if ( $datefirst != null && $datesecond != null)
				{
				
					$sql = 'SELECT id_product FROM '._DB_PREFIX_.'product WHERE date_add BETWEEN "'.$datefirst.'" AND "'.$datesecond.'"';
					$product_rows = Db::getInstance()->ExecuteS($sql);
					
					$sql = 'SELECT id_cms FROM '._DB_PREFIX_.'cms WHERE date_add BETWEEN "'.$datefirst.'" AND "'.$datesecond.'"';
					$cms_rows = Db::getInstance()->ExecuteS($sql);
					
					$sql = 'SELECT id_category FROM '._DB_PREFIX_.'category WHERE date_add BETWEEN "'.$datefirst.'" AND "'.$datesecond.'"';
					$categ_rows = Db::getInstance()->ExecuteS($sql); 
					
					$etbusiness->f_doExporte($extlgid, $product_rows, $cms_rows, $categ_rows, $l_filename, $extcatid, $extelemid, $coltotrid);
				}
				//$etbusiness->f_send_file($l_filename);
				//die($l_filename);
				$sent = $etbusiness->f_send_mail($email,$extlgname,$langdest,$l_filename);
					//die($sent);
				if(!$sent) {
					$message= $this->displayError($this->l('erreur lors de l\'envoi de l\'email '));
					} else {

						$message= $this->displayConfirmation($this->l('Votre demande à été bien envoyée, vous recevez notre devis dans un delai de 24h !'));
					}
			}

		}
		elseif (Tools::isSubmit('doImport')) {
			$res=$etbusiness->f_doImport(Tools::getValue('import_id_lang'), $message);
			if($res==true) {
				$message= $this->displayConfirmation($this->l('Import réalisé avec succès'));
			}else{
				$message=$this->displayError($message);
			}
		}

		if(!ETBusiness::f_test_directory('uploads/import')) {
			$message.=$this->displayError("Le dossier ".dirname(__FILE__)."/uploads/import n'est pas accessible en écriture ! Merci de faire le nécessaire.");
		}
		if(!ETBusiness::f_test_directory('uploads/export')) {
			$message.=$this->displayError("Le dossier ".dirname(__FILE__)."/uploads/export n'est pas accessible en écriture ! Merci de faire le nécessaire.");
		}
		if(!ETBusiness::f_test_directory('logs')) {
			$message.=$this->displayError("Le dossier ".dirname(__FILE__)."/logs n'est pas accessible en écriture ! Merci de faire le nécessaire.");
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



	// Retrocompatibility 1.4/1.5
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