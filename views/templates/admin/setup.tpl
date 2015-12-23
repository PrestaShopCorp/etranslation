{*
/*********************************************************************************
 * e-translation is a customer relationship management program developed by
 * DREAM_IT, (C) 2014-2015 .
 * 
 * This program is free software; you can redistribute it and/or modify it under
 * the terms of the GNU General Public License version 3 as published by the
 * Free Software Foundation 
 * The interactive user interfaces in modified source and object code versions
 * of this program must display Appropriate Legal Notices, as required under
 * Section 5 of the GNU General Public License version 3.
 * 
 * In accordance with Section 7(b) of the GNU General Public License version 3,
 * these Appropriate Legal Notices must retain the display of the "Powered by
 * e-translation" logo. If the display of the logo is not reasonably feasible for
 * technical reasons, the Appropriate Legal Notices must display the words
 * "Powered by e-translation".
 ********************************************************************************/
*}
<style>
			

			.tabs li {
				list-style:none;
				display:inline;
			}

			.tabs a {
				padding:5px 10px;
				display:inline-block;
				background:#666;
				color:#fff;
				text-decoration:none;
			}

			.tabs a.active {
				background:#fff;
				border-bottom: 1px solid #000;
				color:#666;
			}

		</style>

<!-- header logo: style can be found in header.less -->
<header class="header">
    <script>
  $(function() {
    $( "#datedebut_id" ).datepicker({ dateFormat: 'yy-mm-dd' });
	$( "#datefin_id" ).datepicker({ dateFormat: 'yy-mm-dd' });
  });

  </script>


	
</header>
<div >
		<!-- Left side column. contains the logo and sidebar -->
<img src="../modules/etranslation/views/img/biglogo.png" style="margin-left:5%"/>
<img src="../modules/etranslation/views/img/Official_prestashop_partner.jpg" style="margin-left:43%"/>
<br/>



		<ul class='tabs'>
			<li><a href='#tab1' style="width:15%">{l s='Send translation' mod='etranslation'}</a></li>
			<li><a href='#tab2' style="width:15%">{l s='Import translation' mod='etranslation'}</a></li>
			<li><a href='#tab3' style="width:25%">{l s='Send files for translation' mod='etranslation'}</a></li>
			<li><a href='#tab4' style="width:10%">{l s='Cron' mod='etranslation'}</a></li>
			<li><a href='#tab5' style="width:15%">{l s='Help' mod='etranslation'}</a></li>
		</ul>
		<div id='tab1' class="table" style="margin-left:30px;width:80%">
			<br/>
{$message|escape:'mail':'UTF-8'}
<form action="" method="post" enctype="multipart/form-data">



		<!-- Right side column. Contains the navbar and content of the page -->
		
			<!-- Content Header (Page header) -->
		   

			<!-- Main content -->
			<section class="content">
				<!-- left column -->
				
				<div  >
					<!-- general form elements -->
					<div class="box box-primary">
					
						<h4><i style="margin-left:15px">{l s='Before starting the extraction we recommend filling out the questionnaire on the following' mod='etranslation'} <a href="http://e-translation-agency.com/preparation/">{l s='page' mod='etranslation'}</a></i></h4>
						<br>
						<br>
						
						
								<div class="form-group">
									<label>{l s='Email Adress:' mod='etranslation'}</label>
									<input style="width: 300px;" class="form-control" type="text" name="email" value="{$et_email|escape:'htmlall':'UTF-8'}"/>
								</div>
								
								<div class="form-group">
									<label>{l s='Source Language:' mod='etranslation'}</label>
										<select class="form-control"  name="export_id_lang" style="width: 300px;">
											{foreach $langues_actives item=langue}
											<option  value="{$langue.id_lang|escape:'htmlall':'UTF-8'}-{$langue.name|escape:'htmlall':'UTF-8'}">{$langue.name|escape:'htmlall':'UTF-8'}</option>
											{/foreach}
										</select>
								</div>
								<div class="form-group">
									<label style="margin-left:0px">{l s='Target Languages:' mod='etranslation'} </label>
										<div id="export_dest_lang_id" style="float:left;width:500px;">
											<div style="float: left; width: 33%">
												<div >
													<input name="export_dest_lang_id[]" value="Allemand" type="checkbox"> Allemand (DE)<br>
												</div>
												<div >
													<input name="export_dest_lang_id[]" value="Anglais" type="checkbox"> Anglais (EN)<br>
												</div>
												<div >
													<input name="export_dest_lang_id[]" value="Arabe" type="checkbox"> Arabe (AR)<br>
												</div>
												<div >
													<input name="export_dest_lang_id[]" value="Bulgare" type="checkbox"> Bulgare (BG)<br>
												</div>
												<div >
													<input name="export_dest_lang_id[]" value="Cantonais" type="checkbox"> Cantonais (ZT)<br>
												</div>
												<div>
													<input name="export_dest_lang_id[]" value="Coréen" type="checkbox"> Coréen (KO)<br>
												</div>
												<div>
													<input name="export_dest_lang_id[]" value="Croate" type="checkbox"> Croate (HR)<br>
												</div>
												<div >
													<input name="export_dest_lang_id[]" value="Danois" type="checkbox"> Danois (DA)<br>
												</div>
												<div >
													<input name="export_dest_lang_id[]" value="Espagnol" type="checkbox"> Espagnol (ES)<br>
												</div>
												<div >
													<input name="export_dest_lang_id[]" value="Espagnol-LS" type="checkbox"> Espagnol (Amérique Latine) (LS)<br>
												</div>
												<div >
													<input name="export_dest_lang_id[]" value="Estonien" type="checkbox"> Estonien (ET)<br>
												</div>
												<div >
													<input name="export_dest_lang_id[]" value="Finnois" type="checkbox"> Finnois (FI)<br>
												</div>
												<div>
													<input name="export_dest_lang_id[]" value="Français" type="checkbox"> Français (FR)<br>
												</div>
											</div>
											<div style="float: left; width: 33%">
												<div >
													<input name="export_dest_lang_id[]" value="Grec" type="checkbox"> Grec (EL)<br>
												</div>
												<div >
													<input name="export_dest_lang_id[]" value="Hindi" type="checkbox"> Hindi (HI)<br>
												</div>
												<div >
													<input name="export_dest_lang_id[]" value="Hongrois" type="checkbox"> Hongrois (HU)<br>
												</div>
												<div >
													<input name="export_dest_lang_id[]" value="Hébreu" type="checkbox"> Hébreu (HE)<br>
												</div>
												<div >
													<input name="export_dest_lang_id[]" value="Italien" type="checkbox"> Italien (IT)<br>
												</div>
												<div>
													<input name="export_dest_lang_id[]" value="Japonais" type="checkbox"> Japonais (JA)<br>
												</div>
												<div >
													<input name="export_dest_lang_id[]" value="Letton" type="checkbox"> Letton (LV)<br>
												</div>
												<div >
													<input name="export_dest_lang_id[]" value="Lituanien" type="checkbox"> Lituanien (LT)<br>
												</div>
												<div >
													<input name="export_dest_lang_id[]" value="Mandarin" type="checkbox"> Mandarin (ZH)<br>
												</div>
												<div>
													<input name="export_dest_lang_id[]" value="Norvégien" type="checkbox"> Norvégien (NO)<br>
												</div>
												<div >
													<input name="export_dest_lang_id[]" value="Néerlandais" type="checkbox"> Néerlandais (NL)<br>
												</div>
												<div>
													<input name="export_dest_lang_id[]" value="Polonais" type="checkbox"> Polonais (PL)<br>
												</div>
												<div>
													<input name="export_dest_lang_id[]" value="Polonais" type="checkbox"> Portugais (PT)<br>
												</div>
											</div>
											<div style="float: left; width: 33%">
												<div >
													<input name="export_dest_lang_id[]" value="189" type="checkbox"> Portugais (Brésilien) (PB)<br>
												</div>
												<div >
													<input name="export_dest_lang_id[]" value="Roumain" type="checkbox"> Roumain (RO)<br>
												</div>
												<div >
													<input name="export_dest_lang_id[]" value="Russe" type="checkbox"> Russe (RU)<br>
												</div>
												<div >
													<input name="export_dest_lang_id[]" value="Serbe" type="checkbox"> Serbe (SR)<br>
												</div>
												<div>
													<input name="export_dest_lang_id[]" value="Slovaque" type="checkbox"> Slovaque (SK)<br>
												</div>
												<div>
													<input name="export_dest_lang_id[]" value="Slovène" type="checkbox"> Slovène (SL)<br>
												</div>
												<div>
													<input name="export_dest_lang_id[]" value="Suédois" type="checkbox"> Suédois (SV)<br>
												</div>
												<div >
													<input name="export_dest_lang_id[]" value="Tchèque" type="checkbox"> Tchèque (CS)<br>
												</div>
												<div >
													<input name="export_dest_lang_id[]" value="Thaï" type="checkbox"> Thaï (TH)<br>
												</div>
												<div >
													<input name="export_dest_lang_id[]" value="Turc" type="checkbox"> Turc (TR)<br>
												</div>
												<div>
													<input name="export_dest_lang_id[]" value="Ukrainien" type="checkbox"> Ukrainien (UK)<br>
												</div>
												<div>
													<input name="export_dest_lang_id[]" value="Vietnamien" type="checkbox"> Vietnamien (VI)<br>
												</div>
											</div>
								</div>
							</div>
								<div class="form-group">
									<label>{l s='Elements to Translate :' mod='etranslation'} </label>
									<select class="form-control" id="export_element_id" name="export_element_id" style="width: 300px;">
										<option value="0">{l s='All Elements' mod='etranslation'}</option>
										<option value="1">{l s='Produts' mod='etranslation'}</option>
										<option value="2">{l s='Categories' mod='etranslation'}</option>
										<option value="3">{l s='CMS' mod='etranslation'}</option>
										<option value="5">{l s='Attributs and values' mod='etranslation'}</option>
										<option value="6">{l s='Features' mod='etranslation'}</option>
									</select>
								</div>
								<div class="form-group">

									<label>{l s='Fields to Translate:' mod='etranslation'}</label>
									<div id="columns_to_translate">
										<div style="display: none;" class="category_title-container">
											<input disabled="disabled" name="columns_to_translate[]" value="category_title" type="checkbox"> {l s='Title' mod='etranslation'}<br>
										</div>
										<div>
											<input name="columns_to_translate[]" value="name" type="checkbox"> {l s='Name' mod='etranslation'}<br>
										</div>
										<div>
											<input name="columns_to_translate[]" value="content" type="checkbox"> {l s='Content' mod='etranslation'}<br>
										</div>
										<div>
											<input name="columns_to_translate[]" value="description" type="checkbox"> {l s='Description' mod='etranslation'}<br>
										</div>
										<div>
											<input name="columns_to_translate[]" value="description_short" type="checkbox"> {l s='Shorte description' mod='etranslation'}<br>
										</div>
										<div>
											<input name="columns_to_translate[]" value="meta_title" type="checkbox"> {l s='Meta Title' mod='etranslation'}<br>
										</div>
										<div>
											<input name="columns_to_translate[]" value="meta_description" type="checkbox"> {l s='Meta Description' mod='etranslation'}<br>
										</div>
										<div>
											<input name="columns_to_translate[]" value="meta_keywords" type="checkbox"> {l s='Meta Keywords' mod='etranslation'}<br>
										</div>
									</div>
									<div style="margin-left:23%;">
										<iframe align="right" src="//www.youtube.com/embed/SI5getoiuVA?wmode=opaque" allowfullscreen="allowfullscreen" frameborder="0" id="fitvid81558"></iframe>
									</div>
								</div>

								
								<div class="form-group">
									<label>{l s='Starting on a Given Date:' mod='etranslation'} </label>
									<input style="width: 300px;" class="form-control" type="text" id="datedebut_id" name="datedebut_id" placeholder="YYYY-MM-JJ"/>
								</div>
								<div class="form-group">
									<label>{l s='Until a Given Date:' mod='etranslation'} </label>
									<input style="width: 300px;" class="form-control" type="text" id="datefin_id" name="datefin_id" placeholder="YYYY-MM-JJ"/>
								</div>
								

							</div><!-- /.box-body -->

							<div class="box-footer" style="margin-left:40%">
								<button type="submit" class="btn btn-primary" name="doExport">✔ {l s='Send for traduction' mod='etranslation'}</buton>
							</div>
					


					</div><!-- /.box -->
				</div>
			</section><!-- /.content -->
</form>

		
		<div id='tab2' class="table" style="margin-left:30px;width:80%">
			<br/>
	<form action="" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label>{l s='Langues:' mod='etranslation'} </label>
			<select class="form-control" name="import_id_lang" style="width: 300px;">
				{foreach $langues_actives item=langue}
				<option value="{$langue.id_lang|escape:'htmlall':'UTF-8'}">{$langue.name|escape:'htmlall':'UTF-8'}</option>
				{/foreach}
			</select>
			<input type="hidden" name="MAX_FILE_SIZE" value="{20*1024*1024|escape:'htmlall':'UTF-8'}" />
		</div>
		<div class="form-group">
			<label>{l s='File to import:' mod='etranslation'} </label>
			<input style="width: 300px;" class="form-control" type="file" name="file_to_import"/>
		</div>
		
		<div class="box-footer" style="margin-left:30%">
			<button type="submit" class="btn btn-primary" name="doImport">✔ {l s='Import file' mod='etranslation'}</buton>
		</div>
		
	</form>
		</div>
		<div id='tab3' class="table" style="margin-left:30px;width:80%">
		<h3 style="margin-left:20px">{l s='Please select files to send for translation!' mod='etranslation'}</h3>
		<i style="margin-left:35px">{l s='You can send banners, PDF files, logos with text...' mod='etranslation'}<i/>
		<form action="" method="post" enctype="multipart/form-data">
			<iframe height="450px" width ="100%" src="../modules/etranslation/views/templates/admin/index.html" frameBorder="0"></iframe>
		
			<div class="box-footer" style="margin-left:30%">
			<button type="submit" class="btn btn-primary" name="sendfiles">✔ {l s='Send files' mod='etranslation'}</button>
			
			</div>
		</form>
		</div>
		
		
		<div id='tab4' class="table" style="margin-left:30px;width:80%">
		<br/>
		<form action="" method="post" enctype="multipart/form-data">
			<div class="form-group">
			<label>{l s='Email Address of Recipient:' mod='etranslation'} </label>
			<input style="width: 300px;" class="form-control" type="text" name="et_email" value="{$et_email|escape:'htmlall':'UTF-8'}"/>
			</div>

			<div class="form-group">
				<label>{l s='Last Run Date:' mod='etranslation'}</label>
				<input style="width: 300px;" class="form-control"  type="text" name="et_date_last_exec" value="{$et_date_last_exec|escape:'htmlall':'UTF-8'}" placeholder="yyyy-mm-dd hh:mm:ss"/>
			</div>
			
			<div class="box-footer" style="margin-left:30%">
			<button type="submit" class="btn btn-primary" name="submitForm">✔ {l s='Save' mod='etranslation'}</button>
			
			</div>

			
		</div>
	</form>


		
</div><!-- ./wrapper -->

		<div id='tab5' class="table" style="margin-left:30px;width:80%">
		<div class="content">
			<section class="article">
		
			<h1 id="help_vosmodules-vosmodules">{l s='Presentation of the module' mod='etranslation'}</h1>
				<p>{l s='The e-Translation module enables extracting the content of your prestashop website. It is compatible with the versions 1.4, 1.5 and 1.6 of prestashop' mod='etranslation'}</p>
			<h2 id="help_vosmodules-notificationdemodules">{l s='Send translation' mod='etranslation'}</h2>
			<p>{l s='This section enables you to filter the content to extract from your website to sort the information of your website. We recommend visiting our website to provide further details.' mod='etranslation'}</p>
			<p><span class="confluence-embedded-file-wrapper image-center-wrapper confluence-embedded-manual-size"><img class="confluence-embedded-image confluence-content-image-border image-center" height="107" width="1171" src="../modules/etranslation/views/img/help/env-trd_en.png" alt="mod001-avertissementModules-fr.png?versi"></span>
			</p>
			<p>
			<ul>
				<li>
					<strong>{l s='Email Address' mod='etranslation'}</strong>. {l s='email address, which will enable us to communicate with you. The quote will be sent to this address.' mod='etranslation'}
				</li>
				<li>
					<strong>{l s='Source Language' mod='etranslation'}</strong>. {l s='The list reloads automatically according to the list of languages installed on your prestashop showcase. It is the language you wish to extract (the e-translation module does not enable extracting more than one language at a time).' mod='etranslation'}
				</li>
				<li>
					<strong>{l s='Target Languages' mod='etranslation'}</strong>. {l s='List of languages into which you wish to have your website translated.' mod='etranslation'}
				</li>
				<li>
					<strong>{l s='Elements to Translate' mod='etranslation'}</strong>. {l s='Content you wish to have translated.' mod='etranslation'}
					<br><ul>
							<li>
							<strong>{l s='All Element' mod='etranslation'}</strong>. {l s='If you want to have all the content of your website translated.' mod='etranslation'}
							</li>
							<li>
							<strong>{l s='Products' mod='etranslation'}</strong>. {l s='If you only want to have the list of products of your website translated.' mod='etranslation'}
							</li>
							<li><strong>{l s='Categories' mod='etranslation'}</strong>. {l s='If you wish to have only product  categories translated.' mod='etranslation'}
							</li>
							<li><strong>{l s='CMS' mod='etranslation'}</strong>. {l s='If you wish to have only the text content of your website translated' mod='etranslation'}
							</li>
						</ul>
				</li>
				<li>
					<strong>{l s='Fields to Translate' mod='etranslation'}</strong>.{l s=' Types of content you wish to have translated for each element selected in the "Elements to Translate" section.' mod='etranslation'}
				</li>
				<li>
					<strong>{l s='Starting on a Given Date' mod='etranslation'}</strong>. {l s='If you wish to have the content added starting on a given date translated.' mod='etranslation'}
				</li>
				<li>
					<strong>{l s='Until a Given Date' mod='etranslation'}</strong>.  {l s='If you wish to have the content added to your website until a given date translated.' mod='etranslation'}
				</li>
			</ul>
			</p>
		<h2 id="help_vosmodules-effectuerdesactionssurlesmodules">{l s='Import Translation' mod='etranslation'}</h2>
			<p>{l s='This section enables importing the translation sent by e-translation.' mod='etranslation'}</p>
			<p><span class="confluence-embedded-file-wrapper image-center-wrapper confluence-embedded-manual-size"><img class="confluence-embedded-image confluence-content-image-border image-center" height="107" width="1171" src="../modules/etranslation/views/img/help/imp-trd_en.png" alt="mod001-avertissementModules-fr.png?versi"></span>
			</p>
			<p>
			<ul>
				<li>
					<strong>{l s='Langues' mod='etranslation'}</strong>. {l s='Please use caution when selecting the imported language: the content of the selected language will be changed for the content of the XML file you are adding.' mod='etranslation'}
				</li>
				<li>
					<strong>{l s='Files to Import' mod='etranslation'}</strong>. {l s='On your local drive, select the location of the XML translation file sent by e-translation.' mod='etranslation'}
				</li>
			</p>
			<h2 id="help_vosmodules-effectuerdesactionssurlesmodules">{l s='Send Files for Translation' mod='etranslation'}</h2>
			<p>{l s='This section enables selecting a list of files and images (banners, PDF files, logos...) with text for translation :' mod='etranslation'}</p>
			<p><span class="confluence-embedded-file-wrapper image-center-wrapper confluence-embedded-manual-size"><img class="confluence-embedded-image confluence-content-image-border image-center" height="356" width="881" src="../modules/etranslation/views/img/help/env-fil_en.png" alt="mod004-actionsModules-fr.PNG?version=1&amp;m"></span></p><div class="confluence-information-macro confluence-information-macro-information">
			<ul>
				<li>
					<strong>{l s='Add files' mod='etranslation'}</strong>. {l s='Select files to send for translation.' mod='etranslation'}
				</li>
				<li>
					<strong>{l s='Start upload' mod='etranslation'}</strong>. {l s='To start the upload of the selected files.' mod='etranslation'}
				</li>
				<li>
					<strong>{l s='Cancel upload' mod='etranslation'}</strong>.{l s=' To stop the upload of the selected files.' mod='etranslation'}
				</li>
				<li>
					<strong>{l s='Delete' mod='etranslation'}</strong>. {l s='To delete all the selected files.' mod='etranslation'}
				</li>
			</p>
			
			<h2 id="help_vosmodules-effectuerdesactionssurlesmodules">{l s='Cron' mod='etranslation'}</h2>
			<p>{l s='This section enables extracting the untranslated or unedited content of your website starting on a given date.' mod='etranslation'}</p>
			<p><span class="confluence-embedded-file-wrapper image-center-wrapper confluence-embedded-manual-size"><img class="confluence-embedded-image confluence-content-image-border image-center" height="356" width="881" src="../modules/etranslation/views/img/help/cron_en.png" alt="mod004-actionsModules-fr.PNG?version=1&amp;m"></span></p><div class="confluence-information-macro confluence-information-macro-information">
			<ul>
				<li>
					<strong>{l s='Email Address' mod='etranslation'}</strong>. {l s='This field contains your email address, which we will use to communicate with you. Your quote will be sent to this address.' mod='etranslation'}
				</li>
				<li>
					<strong>{l s='Last Run Date' mod='etranslation'}</strong>. {l s='Date of the last translation request you sent. Enables extracting the content edited after this date.' mod='etranslation'}
				</li>
			</p>
		</section>
		</div>
		
		</div>

<!-- page script -->
<script type="text/javascript">

      


			// Wait until the DOM has loaded before querying the document
			$(document).ready(function(){
							
				$('ul.tabs').each(function(){
					// For each set of tabs, we want to keep track of
					// which tab is active and it's associated content
					var $active, $content, $links = $(this).find('a');

					// If the location.hash matches one of the links, use that as the active tab.
					// If no match is found, use the first link as the initial active tab.
					$active = $($links.filter('[href="'+location.hash+'"]')[0] || $links[0]);
					$active.addClass('active');

					$content = $($active[0].hash);

					// Hide the remaining content
					$links.not($active).each(function () {
						$(this.hash).hide();
					});

					// Bind the click event handler
					$(this).on('click', 'a', function(e){
						// Make the old tab inactive.
						$active.removeClass('active');
						$content.hide();

						// Update the variables with the new link and content
						$active = $(this);
						$content = $(this.hash);

						// Make the tab active.
						$active.addClass('active');
						$content.show();

						// Prevent the anchor's default click action
						e.preventDefault();
					});
				});
			});
		</script>