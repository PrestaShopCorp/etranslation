<?php
/**
 * etranslation traduction agence  
 * 
 * @author    contact@dream-it.ma>
 * @copyright 2015, Dream-it
 * @license   http://www.opensource.org/licenses/MIT
*/

class ETBusiness
{

    public function f_doExport($export_id_lang, $product_rows, $cms_rows, $categ_rows, &$p_filename)
    {
        $UPLOAD_DIR=dirname(__FILE__)."/../uploads/export";
  // products:
  
  // si vide on prend tous les produits
        if(empty($product_rows)) {
            $all_products=Product::getProducts($export_id_lang, 1, 10000, 'id_product', 'ASC');
        } else {
            // on ne prend que le sproduits demandés
            $all_products=array();
            foreach ($product_rows as $product_row) {
                $l_productObj=new Product($product_row['id_product'], false, $export_id_lang);
                if($l_productObj==false) {
                    $p_message.='impossible de charger le produit n°'.$product_row['id_product'];
                    $this->f_log($p_message);
                    continue;
                }// on transforme l'objet en tableau, et on le merge avec l'id_product
                $all_products[]=array_merge((array)$l_productObj, array('id_product'=>$product_row['id_product']));
            }
        }
  //var_export($all_products);

        $etranslation = new SimpleXMLExtended("<?xml version=\"1.0\" encoding=\"utf-8\" ?><etranslation></etranslation>");//
        $etranslation->addChild('products');
        foreach ($all_products as $product) {
            $product_xml=$etranslation->products->addChild('product');
            $product_xml->addAttribute('id_product', $product['id_product']);
            $product_xml->addChildCData('description', $product['description']);
            $product_xml->addChildCData('description_short', $product['description_short']);
            $product_xml->addChild('name', $product['name']);
            $product_xml->addChild('meta_description', $product['meta_description']);
            $product_xml->addChild('meta_keywords', $product['meta_keywords']);
            $product_xml->addChild('meta_title', $product['meta_title']);
        }

  // CMS
        if(empty($cms_rows)) { // on prend tous les CMS
            $all_cmspages=CMS::getCMSPages($export_id_lang);
        } else { // on ne prend que les pages CMS demandées
            $all_cmspages=array();
            foreach ($cms_rows as $cms_row) {
                $l_cmsObj=new CMS($cms_row['id_cms']);
                $all_cmspages[]=array(
                'id_cms'=>$cms_row['id_cms'],
                'content'=>$l_cmsObj->content[$export_id_lang],
                'meta_description'=>$l_cmsObj->meta_description[$export_id_lang],
                'meta_keywords'=>$l_cmsObj->meta_keywords[$export_id_lang],
                'meta_title'=>$l_cmsObj->meta_title[$export_id_lang]
                );
            }
        }

  //var_export($all_cmspages);

        $etranslation->addChild('cms_pages');
        foreach ($all_cmspages as $cmspage) {
            $cms_xml=$etranslation->cms_pages->addChild('cms_page');
            $cms_xml->addAttribute('id_cms', $cmspage['id_cms']);
            $cms_xml->addChildCData('content', $cmspage['content']);
            $cms_xml->addChild('meta_description', $cmspage['meta_description']);
            $cms_xml->addChild('meta_keywords', $cmspage['meta_keywords']);
            $cms_xml->addChild('meta_title', $cmspage['meta_title']);
        }


  // categories
        $sqlWhere='';
        if(!empty($categ_rows)) { // on prend tous les categ demandée
            $sqlWhere='AND c.id_category IN ('.implode(',', $categ_rows).') ';
        }
        $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
   SELECT c.id_category, cl.name, cl.description, cl.link_rewrite, cl.meta_title, cl.meta_keywords, cl.meta_description
   FROM `'._DB_PREFIX_.'category` c
   LEFT JOIN `'._DB_PREFIX_.'category_lang` cl ON (c.`id_category` = cl.`id_category` AND cl.id_lang = '.$export_id_lang.')
   WHERE 1 '.$sqlWhere.'
   GROUP BY c.`id_category`
   ORDER BY `level_depth` ASC
  ');
        $etranslation->addChild('categories');
        foreach ($result as $categ_row) {
            $categ_xml=$etranslation->categories->addChild('category');
            $categ_xml->addAttribute('id_category', $categ_row['id_category']);
            $categ_xml->addChildCData('description', $categ_row['description']);
            $categ_xml->addChild('name', $categ_row['name']);
            $categ_xml->addChild('meta_description', $categ_row['meta_description']);
            $categ_xml->addChild('meta_keywords', $categ_row['meta_keywords']);
            $categ_xml->addChild('meta_title', $categ_row['meta_title']);
        }

  //$etranslation->asXML($UPLOAD_DIR.'/'.$p_filename);
        $dom = dom_import_simplexml($etranslation)->ownerDocument;
        $dom->formatOutput = true;
        $p_filename="etranslation_".Language::getIsoById($export_id_lang).'_'.date("Ymd_His").'.xml';
        $dom->save($UPLOAD_DIR.'/'.$p_filename);
        return true;
    }
 
 

    public function f_doExporte($export_id_lang, $product_rows, $cms_rows, $categ_rows, &$p_filename, $extcatid, $extelemid, $coltotrid, $date_first, $date_second)
    {
        $UPLOAD_DIR=dirname(__FILE__)."/../uploads/export";
  //$export_id_lang=Tools::getValue('export_id_lang');
        $etranslation = new SimpleXMLExtended("<?xml version=\"1.0\" encoding=\"utf-8\" ?><etranslation></etranslation>");//
  // products:
        if ($extelemid == 0 || $extelemid == 1) {
            if($product_rows=='all')
    { // on prend tous les produits
                $all_products=Product::getProducts($export_id_lang, 0, 1000000, 'id_product', 'ASC');
            } elseif (empty($product_rows))
    {
                $p_message.='Aucun produit trouver !';
                $this->f_log($p_message);
            } else { // on ne prend que le sproduits demandés
                $all_products=array();
                foreach ($product_rows as $product_row) {
                    $l_productObj=new Product($product_row['id_product'], false, $export_id_lang);
                    if($l_productObj==false)
                    {
                        $p_message.='impossible de charger le produit n°'.$product_row['id_product'];
                        $this->f_log($p_message);
                        continue;
                    }
     // on transforme l'objet en tableau, et on le merge avec l'id_product
                    $all_products[]=array_merge((array)$l_productObj, array('id_product'=>$product_row['id_product']));
                }
            }
        }
  
   //var_export($all_products);

   

        $etranslation->addChild('products');
        foreach ($all_products as $product) {
            $product_xml=$etranslation->products->addChild('product');
            $product_xml->addAttribute('id_product', $product['id_product']);
    //$product_xml->addChild('description', $product['description']);
            foreach ($coltotrid as $column)
            {
                if($column == "description")
                {
                     $product_xml->addChildCData($column, $product[$column]);
                } else {
                    $product_xml->addChild($column, $product[$column]);
                }
            }
        }
  

  // CMS
  //$all_cmspages=CMS::listCms($export_id_lang);
        if ($extelemid == 0 || $extelemid == 3) {
            if($cms_rows == 'all') { // on prend tous les CMS
                $all_cmspages=CMS::getCMSPages($export_id_lang);
            } elseif (empty($cms_rows)) {
                $p_message.='Aucun CMS trouver !';
                $this->f_log($p_message);
            } else { // on ne prend que les pages CMS demandées
                $all_cmspages=array();
                foreach ($cms_rows as $cms_row) {
                    $l_cmsObj=new CMS($cms_row['id_cms']);

                    $all_cmspages[]=array(
                    'id_cms'=>$cms_row['id_cms'],
                    'content'=>$l_cmsObj->content[$export_id_lang],
                    'meta_description'=>$l_cmsObj->meta_description[$export_id_lang],
                    'meta_keywords'=>$l_cmsObj->meta_keywords[$export_id_lang],
                    'meta_title'=>$l_cmsObj->meta_title[$export_id_lang]
                    );
                }
            }

   //var_export($all_cmspages);

            $etranslation->addChild('cms_pages');
            foreach ($all_cmspages as $cmspage) {
                $cms_xml=$etranslation->cms_pages->addChild('cms_page');
                $cms_xml->addAttribute('id_cms', $cmspage['id_cms']);
                foreach ($coltotrid as $column)
    {
                    if($column == "description")
     {
                        $cms_xml->addChildCData('content', $cmspage['content']);
                    } elseif ($column == "name")
                    {
                    } else {
                        $cms_xml->addChild($column, $cmspage[$column]);
                    }
                }
            }
        }

  // categories
        if ($extelemid == 0 || $extelemid == 2) {
            $sqlWhere='';
            if($categ_rows == 'all') {// on prend tous les categ
                $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
    SELECT c.id_category, cl.name, cl.description, cl.link_rewrite, cl.meta_title, cl.meta_keywords, cl.meta_description
    FROM `'._DB_PREFIX_.'category` c
    LEFT JOIN `'._DB_PREFIX_.'category_lang` cl ON (c.`id_category` = cl.`id_category` AND cl.id_lang = '.$export_id_lang.')
    WHERE 1 '.$sqlWhere.'
    GROUP BY c.`id_category`
    ORDER BY `level_depth` ASC
   ');
    
            } elseif (empty($categ_rows)) {
                $p_message.='Aucune categorie trouver !';
                $this->f_log($p_message);
            } else { // on prend tous les categ demandée
                $sqlWhere='AND c.id_category IN ('.implode(',', $categ_rows).') ';
                $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
    SELECT c.id_category, cl.name, cl.description, cl.link_rewrite, cl.meta_title, cl.meta_keywords, cl.meta_description
    FROM `'._DB_PREFIX_.'category` c
    LEFT JOIN `'._DB_PREFIX_.'category_lang` cl ON (c.`id_category` = cl.`id_category` AND cl.id_lang = '.$export_id_lang.')
    WHERE 1 '.$sqlWhere.'
    GROUP BY c.`id_category`
    ORDER BY `level_depth` ASC
   ');
    
            }
            $etranslation->addChild('categories');
            foreach ($result as $categ_row) {
                $categ_xml=$etranslation->categories->addChild('category');
                $categ_xml->addAttribute('id_category', $categ_row['id_category']);
                foreach ($coltotrid as $column)
                {
                    if($column == "description")
                    {
                        $categ_xml->addChildCData($column, $categ_row[$column]);
                    } else {
                        $categ_xml->addChild($column, $categ_row[$column]);
                    }
                }
            }
        }

// Groupe d'attribue
        if ($extelemid == 0 || $extelemid == 5) {
  // on prend tous les groupes d'attribut
   
            $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
    SELECT c.id_attribute_group , c.name, c.public_name
    FROM `'._DB_PREFIX_.'attribute_group_lang` c
    WHERE c.id_lang = '.$export_id_lang.'
   ');
    
     
   
   
            $etranslation->addChild('Attribute_Groups');
            foreach ($result as $G_attribute_row) {
                $G_attribute_xml=$etranslation->Attribute_Groups->addChild('Attribute_Group');
                $G_attribute_xml->addAttribute('id_attribute_group', $G_attribute_row['id_attribute_group']);
                $G_attribute_xml->addChild('name', $G_attribute_row['name']);
                $G_attribute_xml->addChild('public_name', $G_attribute_row['public_name']);
    
            }
        
// Attribues
        
  // on prend tous les groupes d'attribut
   
            $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
    SELECT c.id_attribute , c.name
    FROM `'._DB_PREFIX_.'attribute_lang` c
    WHERE c.id_lang = '.$export_id_lang.'
   ');
    
     
   
   
            $etranslation->addChild('Attributes');
            foreach ($result as $attribute_row) {
                $attribute_xml=$etranslation->Attributes->addChild('Attribute');
                $attribute_xml->addAttribute('id_attribute', $attribute_row['id_attribute']);
                $attribute_xml->addChild('name', $attribute_row['name']);
    
            }
        }

// Caractéristiques
        if ($extelemid == 0 || $extelemid == 6) {
  // on prend tous les groupes d'attribut
   
            $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
    SELECT c.id_feature  , c.name
    FROM `'._DB_PREFIX_.'feature_lang` c
    WHERE c.id_lang = '.$export_id_lang.'
   ');
    
     
   
   
            $etranslation->addChild('Features');
            foreach ($result as $feature_row) {
                $feature_xml=$etranslation->Features->addChild('Feature');
                $feature_xml->addAttribute('id_feature', $feature_row['id_feature']);
                $feature_xml->addChild('name', $feature_row['name']);
    
            }
         
// Features Value

  // on prend tous les valeurs de caractéristiques
   
            $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
    SELECT c.id_feature_value , c.value
    FROM `'._DB_PREFIX_.'feature_value_lang` c
    WHERE c.id_lang = '.$export_id_lang.'
   ');
    
     
   
   
            $etranslation->addChild('Features_Value');
            foreach ($result as $featureV_row) {
                $featureV_xml=$etranslation->Features_Value->addChild('Feature_Value');
                $featureV_xml->addAttribute('id_feature_value', $featureV_row['id_feature_value']);
                $featureV_xml->addChild('value', $featureV_row['value']); 
            }
        }

 // carousel
        if ($extelemid == 0 || $extelemid == 4) {
  // on prend tous les carousel
   
            $result = Db::getInstance(_PS_USE_SQL_SLAVE_)->executeS('
    SELECT c.id_st_owl_carousel, c.description, c.title
    FROM `'._DB_PREFIX_.'st_owl_carousel_lang` c
    WHERE c.id_lang = '.$export_id_lang.'
   ');
    
     
   
   
            $etranslation->addChild('carousels');
            foreach ($result as $carou_row) {
                $carou_xml=$etranslation->carousels->addChild('carousel');
                $carou_xml->addAttribute('id_st_owl_carousel', $carou_row['id_st_owl_carousel']);
                $carou_xml->addChild('description', $carou_row['description']);
                $carou_xml->addChild('title', $carou_row['title']);
    
            }
        }
  




  //$etranslation->asXML($UPLOAD_DIR.'/'.$p_filename);
        $dom = dom_import_simplexml($etranslation)->ownerDocument;
        $dom->formatOutput = true;

        $p_filename="etranslation_".Language::getIsoById($export_id_lang).'_'.date("Ymd_His").'.xml';
  
        $dom->save($UPLOAD_DIR.'/'.$p_filename);


        return true;
    }





###############################################
    public function f_doImport($import_id_lang, &$p_message)
{
  //$import_id_lang=Tools::getValue('import_id_lang');

        $UPLOAD_DIR=dirname(__FILE__)."/../uploads/import";

        $this->f_log("*******************************");
        $this->f_log("DO_IMPORT, démarrage du process");
        $this->f_log("export_id_lang=".$import_id_lang);

  // Undefined | Multiple Files | $_FILES Corruption Attack
  // If this request falls under any of them, treat it invalid.
        if (!isset($_FILES['file_to_import']['error']) || is_array($_FILES['file_to_import']['error']) ) {
            $p_message='Parametres invalies.';
            $this->f_log($p_message);
            return false;
        }
  // Check $_FILES['upfile']['error'] value.
        switch ($_FILES['file_to_import']['error']) {
            case UPLOAD_ERR_OK:
                break;
            case UPLOAD_ERR_NO_FILE:
                $p_message='Aucun fichier envoyé.';
                $this->f_log($p_message);
                return false;
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                $p_message='Vous avez dépassé la taille maximum autorisée par le serveur.';
                $this->f_log($p_message);
                return false;
            default:
                $p_message='erreur inconnue.';
                $this->f_log($p_message);
                return false;
        }
  // You should also check filesize here.
        if ($_FILES['file_to_import']['size'] > 20*1024*1024) {
            $p_message='Vous avez dépassé la taille maximum autorisée (20Mo).';
            $this->f_log($p_message);
            return false;
        }
 
        if(!preg_match("/\.xml$/", $_FILES['file_to_import']['name']))
  {
            $p_message='Votre fichier doit avoir comme extension xml ('.$_FILES['file_to_import']['name'].')';
            $this->f_log($p_message);
            return false;
        }
        $filename="etranslation_".Language::getIsoById($import_id_lang).'_'.date("Ymd_His").'.xml';

        $this->f_log("Déplacement de ".$_FILES['file_to_import']['tmp_name'].' vers '.$filename);

        if (move_uploaded_file($_FILES['file_to_import']['tmp_name'], $UPLOAD_DIR.'/'.$filename)) {
            $this->f_log("Déplacement OK");
        } else {
            $p_message='Erreur lors du déplacement du fichier sur le serveur';
            $this->f_log($p_message);
            return false;
        }

        libxml_use_internal_errors(true);
        $etranslation = simplexml_load_file($UPLOAD_DIR.'/'.$filename);
        if ($etranslation === false) {
            $p_message="Erreur lors du chargement du XML\n";
            foreach (libxml_get_errors() as $error) {
                $p_message.="\t".$error->message;
            }$this->f_log($p_message);
            return false;
        }

        $this->f_log('Traitement des produits ');
        foreach ($etranslation->products->product as $product_xml) {
            $id_product=(int)$product_xml['id_product'];
            if(empty($id_product))
   {
                $p_message.='impossible de trouver id_product.';
                $this->f_log($p_message);
                continue;
            }$this->f_log('Traitement de '.$id_product);

            $l_productObj=new Product($id_product, false);
            if($l_productObj==false)
   {
                $p_message.='impossible de charger le produit n°'.$id_product;
                $this->f_log($p_message);
                continue;
            }
   //var_export($l_productObj);&& ($l_productObj->description[$import_id_lang]!=$product_xml->description)
            $previous_date_upd=$l_productObj->date_upd;
            if(!empty($product_xml->description) && ($l_productObj->description[$import_id_lang]!=$product_xml->description)){
                $l_productObj->description[$import_id_lang]=$product_xml->description;
    //ECHO ($product_xml->description);
            }
            if(!empty($product_xml->description_short) && ($l_productObj->description_short[$import_id_lang]!=$product_xml->description_short)){
                $l_productObj->description_short[$import_id_lang]=$product_xml->description_short;
            }
            if(!empty($product_xml->name) && ($l_productObj->name[$import_id_lang]!=$product_xml->name)){
                $l_productObj->name[$import_id_lang]=$product_xml->name;
            }
            if(!empty($product_xml->meta_description) && ($l_productObj->meta_description[$import_id_lang]!=$product_xml->meta_description)){
                $l_productObj->meta_description[$import_id_lang]=$product_xml->meta_description;
            }
            if(!empty($product_xml->meta_keywords) && ($l_productObj->meta_keywords[$import_id_lang]!=$product_xml->meta_keywords)){
                $l_productObj->meta_keywords[$import_id_lang]=$product_xml->meta_keywords;
            }
            if(!empty($product_xml->meta_title) && ($l_productObj->meta_title[$import_id_lang]!=$product_xml->meta_title)){
                $l_productObj->meta_title[$import_id_lang]=$product_xml->meta_title;
            }
   //$l_productObj->link_rewrite[$import_id_lang]=Tools::link_rewrite($product_xml->name);// en plus... sinon Presta plante
   

                        $l_productObj->update();

   // réécrasement manuel de la date de mise à jour produit
            if (Tools::substr(_PS_VERSION_, 0, 3) == '1.4' ){
                Db::getInstance()->Execute('UPDATE '._DB_PREFIX_.'product SET date_upd="'.$previous_date_upd.'" WHERE id_product='.$id_product);
            } else {
                Db::getInstance()->update('product', array('date_upd'=>$previous_date_upd), 'id_product='.$id_product, 1);
            }
  



        }

        $this->f_log('Traitement des pages cms ');
        foreach ($etranslation->cms_pages->cms_page as $cms_xml) {
            $id_cms=(int)$cms_xml['id_cms'];
            if(empty($id_cms))
   {
                $p_message.='impossible de trouver id_cms.';
                $this->f_log($p_message);
                continue;
            }$this->f_log('Traitement de '.$id_cms);

            $l_cmsObj=new CMS($id_cms);
            if($l_cmsObj==false) {
                $p_message.='impossible de charger le cms n°'.$id_cms;
                $this->f_log($p_message);
                continue;
            }
   //var_export($l_cmsObj);
            if(!empty($cms_xml->content) && ($l_cmsObj->content[$import_id_lang]!=$cms_xml->content)){
                $l_cmsObj->content[$import_id_lang]=$cms_xml->content;
            }
            if(!empty($cms_xml->meta_keywords) && ($l_cmsObj->meta_keywords[$import_id_lang]!=$cms_xml->meta_keywords)){
                $l_cmsObj->meta_keywords[$import_id_lang]=$cms_xml->meta_keywords;
            }
            if(!empty($cms_xml->meta_title) && ($l_cmsObj->meta_title[$import_id_lang]!=$cms_xml->meta_title)){
                $l_cmsObj->meta_title[$import_id_lang]=$cms_xml->meta_title;
            }
            if(!empty($cms_xml->meta_description) && ($l_cmsObj->meta_description[$import_id_lang]!=$cms_xml->meta_description)){
                $l_cmsObj->meta_description[$import_id_lang]=$cms_xml->meta_description;
            }

                $l_cmsObj->update();

        }


        $this->f_log('Traitement des categories');
        foreach ($etranslation->categories->category as $categ_xml) {
            $id_category=(int)$categ_xml['id_category'];
            if(empty($id_category)) {
                $p_message.='impossible de trouver id_category.';
                $this->f_log($p_message);
                continue;
            }$this->f_log('Traitement de '.$id_category);

            $l_categObj=new Category($id_category);
            if($l_categObj==false) {
                $p_message.='impossible de charger la catégorie n°'.$id_category;
                $this->f_log($p_message);
                continue;
            }
   //var_export($l_categObj);
            $previous_date_upd=$l_categObj->date_upd;
   
   
   
   
            if(!empty($categ_xml->description) && ($l_categObj->description[$import_id_lang]!=$categ_xml->description)){
                $l_categObj->description[$import_id_lang]=$categ_xml->description;
            }
     
            if(!empty($categ_xml->name) && ($l_categObj->name[$import_id_lang]!=$categ_xml->name)){
                $l_categObj->name[$import_id_lang]=$categ_xml->name;
            }
            if(!empty($categ_xml->meta_description) && ($l_categObj->meta_description[$import_id_lang]!=$categ_xml->meta_description)){
                $l_categObj->meta_description[$import_id_lang]=$categ_xml->meta_description;
            }
            if(!empty($categ_xml->meta_keywords) && ($l_categObj->meta_keywords[$import_id_lang]!=$categ_xml->meta_keywords)){
                $l_categObj->meta_keywords[$import_id_lang]=$categ_xml->meta_keywords;
            }
            if(!empty($categ_xml->meta_title) && ($l_categObj->meta_title[$import_id_lang]!=$categ_xml->meta_title)){
                $l_categObj->meta_title[$import_id_lang]=$categ_xml->meta_title;
            }
            if(!empty($categ_xml->content) && ($l_categObj->content[$import_id_lang]!=$categ_xml->content)){
                $l_categObj->content[$import_id_lang]=$categ_xml->content;
            }
            $l_categObj->update();

   // réécrasement manuel de la date de mise à jour catégorie
            if (Tools::substr(_PS_VERSION_, 0, 3) == '1.4' ) {
                Db::getInstance()->Execute('UPDATE '._DB_PREFIX_.'category SET date_upd="'.$previous_date_upd.'" WHERE id_category='.$id_category);
            } else {
                Db::getInstance()->update('category', array('date_upd'=>$previous_date_upd), 'id_category='.$id_category, 1);
            }
        }
      
// import Groupe d'attribue
        $this->f_log('Traitement des Groupes d\'attribue');
        foreach ($etranslation->Attribute_Groups->Attribute_Group as $G_attribute_xml) {
            $id_attribute_group=(int)$G_attribute_xml['id_attribute_group'];
            if(empty($id_attribute_group)) {
                $p_message.='impossible de trouver id_attribute_group.';
                $this->f_log($p_message);
                continue;
            }$this->f_log('Traitement de '.$id_attribute_group);
   
            $G_Att_name = $G_attribute_xml->name;
            $G_Att_Pname = $G_attribute_xml->public_name;
   
   
            Db::getInstance()->Execute('UPDATE '._DB_PREFIX_.'attribute_group_lang SET name="'.$G_Att_name.'", public_name="'.$G_Att_Pname.'" WHERE id_attribute_group='.$id_attribute_group.' AND id_lang='.$import_id_lang);
        }
   
   
   // import Attribues
        $this->f_log('Traitement des attribues');
        foreach ($etranslation->Attributes->Attribute as $attribute_xml) {
            $id_attribute=(int)$attribute_xml['id_attribute'];
            if(empty($id_attribute)) {
                $p_message.='impossible de trouver id_attribute.';
                $this->f_log($p_message);
                continue;
            }$this->f_log('Traitement de '.$id_attribute);
   
            $Att_name = $attribute_xml->name;
   
   
            Db::getInstance()->Execute('UPDATE '._DB_PREFIX_.'attribute_lang SET name="'.$Att_name.'" WHERE id_attribute='.$id_attribute.' AND id_lang='.$import_id_lang);
        }
         
         
         
         
         
   // import Caractéristiques
        $this->f_log('Traitement des Caractéristiques');
        foreach ($etranslation->Features->Feature as $feature_xml) {
            $id_feature=(int)$feature_xml['id_feature'];
            if(empty($id_feature)) {
                $p_message.='impossible de trouver id_feature.';
                $this->f_log($p_message);
                continue;
            }$this->f_log('Traitement de '.$id_feature);
   
            $Feat_name = $feature_xml->name;
   
   
            Db::getInstance()->Execute('UPDATE '._DB_PREFIX_.'feature_lang SET name="'.$Feat_name.'" WHERE id_feature='.$id_feature.' AND id_lang='.$import_id_lang);
        }
         
// import Features Value
        $this->f_log('Traitement des Features Value');
        foreach ($etranslation->Features_Value->Feature_Value as $featureV_xml) {
            $id_feature_value=(int)$featureV_xml['id_feature_value'];
            if(empty($id_feature_value)) {
                $p_message.='impossible de trouver id_feature_value.';
                $this->f_log($p_message);
                continue;
            }$this->f_log('Traitement de '.$id_feature_value);
   
            $Feat_value = $featureV_xml->value;
   
   
            Db::getInstance()->Execute('UPDATE '._DB_PREFIX_.'feature_value_lang SET value="'.$Feat_value.'" WHERE id_feature_value='.$id_feature_value.' AND id_lang='.$import_id_lang);
        }
   
  // import des carousels
        $this->f_log('Traitement des carousels');
        foreach ($etranslation->carousels->carousel as $carou_xml) {
            $id_st_owl_carousel=(int)$carou_xml['id_st_owl_carousel'];
            if(empty($id_st_owl_carousel)) {
                $p_message.='impossible de trouver id_st_owl_carousel.';
                $this->f_log($p_message);
                continue;
            }$this->f_log('Traitement de '.$id_st_owl_carousel);
   
            $carou_desc = $carou_xml->description;
            $carou_title = $carou_xml->title;
   
   
            Db::getInstance()->Execute('UPDATE '._DB_PREFIX_.'st_owl_carousel_lang SET description="'.$carou_desc.'", title="'.$carou_title.'" WHERE id_st_owl_carousel='.$id_st_owl_carousel.' AND id_lang='.$import_id_lang);

  
    

   
        }
        return true;


    }



    public function f_log($p_msg)
    {
        $l_log_desc=dirname(__FILE__)."/../logs/".date("Y-m-d").".log";
        $p_msg=preg_replace("/[\t\r\n]/", " ", $p_msg);
        $p_msg=date("Y-m-d H:i:s").' : '.$p_msg."\n";
        error_log($p_msg, 3, $l_log_desc);
    }


    public function f_send_file($p_filename)
    {
        $UPLOAD_DIR=dirname(__FILE__)."/../uploads/export";
        $file = $UPLOAD_DIR.'/'.$p_filename;
        ob_clean();
        $ze_string = implode('', file($UPLOAD_DIR.'/'.$p_filename));
  
        header("Content-Type: application/force-download;name=\"" .$p_filename . "\"");
        header("Content-Transfer-Encoding: binary");
        header("Content-Length: ".Tools::strlen($ze_string));
        header("Content-Disposition: attachment;filename=\"" . $p_filename . "\"");
        header("Expires: 0");
        header("Cache-Control: no-cache, must-revalidate");
        header("Pragma: no-cache");
        readfile ($file);
        exit;
    }

 
    public function f_send_mail($email, $extlgid, $langdest, $p_filename)
    {
        try {
            $file_name = $p_filename;
            $path = dirname(__FILE__)."/../uploads/export/";
            $file = $path.$file_name;
            $file_size = filesize($file);
            $handle = fopen($file, "r");
            $content = fread($handle, $file_size);
            fclose($handle);
   
            $client = new SoapClient(null, array(
            'location' => "http://e-translation-agency.com/wp-content/prestashopApi/Server.php",
            'uri' => "http://e-translation-agency.com/wp-content/prestashopApi/Server"));
     
            $domaine = $_SERVER['SERVER_NAME'];

            $result = $client->send_mail($email, $domaine, $extlgid, $langdest, $content, $file_name);
            return $result;
        }catch(SoapFault $ex) {
            $ex->getMessage();
        }
    }





    public function f_send_cron($email, $msg, $p_filename)
    {
        try {
            $file_name = $p_filename;
            $path = dirname(__FILE__)."/../uploads/export/";
            $file = $path.$file_name;
            $file_size = filesize($file);
            $handle = fopen($file, "r");
            $content = fread($handle, $file_size);
            fclose($handle);
   
            $client = new SoapClient(null, array(
            'location' => "http://e-translation-agency.com/wp-content/prestashopApi/Server.php",
            'uri' => "http://e-translation-agency.com/wp-content/prestashopApi/Server"));
          
            $result = $client->send_cron($email, $msg, $p_filename, $content);
            return $result;
        }catch(SoapFault $ex) {
            $ex->getMessage();
        }
    }
 
    public function f_files_list()
    {
        $dir = dirname(__FILE__)."/../views/templates/admin/server/php/files/";
        $files = [];
        $i = 0;
  //die($dir);
  //  si le dossier pointe existe
        if (is_dir($dir)) {

     // si il contient quelque chose
            if ($dh = opendir($dir)) {

      // boucler tant que quelque chose est trouve
                while (($file = readdir($dh)) !== false) {
       // affiche le nom et le type si ce n'est pas un element du systeme
                    if($file != '.' && $file != '..' && $file != 'index.php') {
                        if (filetype($dir . $file) != "dir"){
                            $files[$i] = $file;
                            $i++;
                        }
                    }
                }
      // on ferme la connection
                closedir($dh);
               
            }
        }return $files;

    }
   
    public function f_send_flsmail($liste_fichier)
    {
        try {
     //permet de définir les différentes parties du mail
  
           
            $dir = dirname(__FILE__)."/../views/templates/admin/server/php/files/";
            //indice de boucle permettant d'ajouter tous les fichiers joints
            $i=0;
            //les fichiers joints a attacher
            $attachement = '';
            if (sizeof($liste_fichier)>1){
               while($i<sizeof($liste_fichier)) { // iterate files
                    $liste_fichier[$i] = $dir . $liste_fichier[$i];
                    $i++;
               }
            
                $destination = $dir . "eTranslation.zip";
               if ($this->create_zip($liste_fichier, $destination, true) == false){
                    return 0;
               }
            
            } else {
                $destination = $dir . $liste_fichier[0];
            }   

            //on vérifie l'extension
            /*
            Pour les besoins de mon formulaire je devait savoir si le fichier était un .doc ou un .pdf
            il suffit uniquement de modifier cette partie pour ajout n'importe quel type de fichier
                                                                                                                  
            */
            $info = new SplFileInfo($destination);
            $extention = $info->getExtension();
            $fileName =$info->getFilename () ;
            $type ="";
            if($extention == "doc" || $extention == "docx") {
                $type = "application/msword";
            } elseif ($extention == "xls" || $extention == "xlsx") {
                $type = "application/vnd.ms-excel";
            } elseif ($extention == "pdf") {
                $type = "application/octet-stream";
            } elseif ($extention == "xml") {
                $type = "application/xml";
            } elseif ($extention == "csv") {
                $type = "application/csv";
            } elseif ($extention == "zip") {
                $type = "application/zip";
            } elseif ($extention == "jpeg" || $extention == "png" || $extention == "gif" || $extention == "jpg") {
                $type = "image/".$extention;
            } else {
                $type = "application/{$extention}";
            }
            //On lit le fichier présent sur le serveur
            //"rb" permet de lire des fichiers en mode binaire (utile sous windows)
            $fd = fopen($destination, "rb" );
            $contenu = fread($fd, filesize($destination));

            //encodage en base64 pour que le fichier soit lisible
            $attachement .= chunk_split(base64_encode($contenu));
            //$attachement .= "\n\n";
            //$attachement .= "--".$limite."--\n";

            fclose($fd);
            //on ferme ensuite toutes les parties du mail
            $domaine = $_SERVER['SERVER_NAME'];

            foreach ($liste_fichier as $file){ // iterate files
                if(is_file($dir.$file))
                  chmod($dir,0777);
                    unlink($dir.$file);// delete file
            }
            //SOAP Call
            $client = new SoapClient(null, array(
            'location' => "http://e-translation-agency.com/wp-content/prestashopApi/Server.php",
            'uri' => "http://e-translation-agency.com/wp-content/prestashopApi/Server"));
            $result = $client->send_files($domaine, $attachement, $type, $fileName);
            //die ($result);
            return $result;
        }
        catch(SoapFault $ex) {
            $ex->getMessage();
        }

    }
 /* creates a compressed zip file */
function create_zip($files = array(),$destination = '',$overwrite = false) {
   //if the zip file already exists and overwrite is false, return false
   
        if(file_exists($destination) && !$overwrite) { 
      return false;
       }
   //vars
        $valid_files = array();
   //if files were passed in...
        if(is_array($files)) {
      //cycle through each file
            foreach ($files as $file) {
            //make sure the file exists
                if(file_exists($file)) {
               $valid_files[] = $file;
               }
           }
       }
   
   //if we have good files...
        if(count($valid_files)) {
      //create the archive
        $zip = new ZipArchive();
        if($zip->open($destination,$overwrite ? ZIPARCHIVE::OVERWRITE : ZIPARCHIVE::CREATE) !== true) {
            return false;
       }
      //add the files
        foreach ($valid_files as $file) {
            $zip->addFile($file,basename($file));
       }
      //debug
      //echo 'The zip archive contains ',$zip->numFiles,' files with a status of ',$zip->status;
      
      //close the zip -- done!
        $zip->close();
      
      //check to make sure the file exists
        return file_exists($destination);
       }
        else
        {
            return false;
       }
}
 
   static function f_test_directory($p_directory_name)
    {
        if(is_writeable(dirname(__FILE__)."/../".$p_directory_name)) {
            return true;
        } else {
            return false;
        }
 }

}

 



class SimpleXMLExtended extends SimpleXMLElement
{
 /**
 * Add CDATA text in a node
 * @param string $cdata_text The CDATA value  to add
 */
 private function addCData($cdata_text)
 {
        $node= dom_import_simplexml($this);
        $no = $node->ownerDocument;
        $node->appendChild($no->createCDATASection($cdata_text));
 }

 /**
 * Create a child with CDATA value
 * @param string $name The name of the child element to add.
 * @param string $cdata_text The CDATA value of the child element.
 */
    public function addChildCData($name,$cdata_text)
 {
        $child = $this->addChild($name);
        $child->addCData($cdata_text);
    }

}