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
<img src="../modules/etranslation/views/img/biglogo.png" />
<br/>



		<ul class='tabs'>
			<li><a href='#tab1' style="width:15%">Send translation</a></li>
			<li><a href='#tab2' style="width:15%">Import translation</a></li>
			<li><a href='#tab3' style="width:25%">Send files for translation</a></li>
			<li><a href='#tab4' style="width:10%">Cron</a></li>
			<li><a href='#tab5' style="width:15%">Help</a></li>
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
					
						<h4><i style="margin-left:15px">Before starting the extraction we recommend filling out the questionnaire on the following <a href="http://e-translation-agency.com/preparation/">page</a></i></h4>
						<br>
						<br>
						
						
								<div class="form-group">
									<label>Email Adress: </label>
									<input style="width: 300px;" class="form-control" type="text" name="email" value="{$et_email|escape:'htmlall':'UTF-8'}"/>
								</div>
								
								<div class="form-group">
									<label>Source Language: </label>
										<select class="form-control"  name="export_id_lang" style="width: 300px;">
											{foreach $langues_actives item=langue}
											<option  value="{$langue.id_lang|escape:'htmlall':'UTF-8'}-{$langue.name|escape:'htmlall':'UTF-8'}">{$langue.name|escape:'htmlall':'UTF-8'}</option>
											{/foreach}
										</select>
								</div>
								<div class="form-group">
									<label style="margin-left:0px">Target Languages: </label>
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
									<label>Elements to Translate : </label>
									<select class="form-control" id="export_element_id" name="export_element_id" style="width: 300px;">
										<option value="0">All Elements</option>
										<option value="1">Produts</option>
										<option value="2">Categories</option>
										<option value="3">CMS</option>
										<option value="5">Attributs and values</option>
										<option value="6">Features</option>
										<option value="4">Carrousels</option>
									</select>
								</div>
								<div class="form-group">

									<label>Fields to Translate:</label>
									<div id="columns_to_translate">
										<div style="display: none;" class="category_title-container">
											<input disabled="disabled" name="columns_to_translate[]" value="category_title" type="checkbox"> Title<br>
										</div>
										<div>
											<input name="columns_to_translate[]" value="name" type="checkbox"> Name<br>
										</div>
										<div>
											<input name="columns_to_translate[]" value="content" type="checkbox"> Content<br>
										</div>
										<div>
											<input name="columns_to_translate[]" value="description" type="checkbox"> Description<br>
										</div>
										<div>
											<input name="columns_to_translate[]" value="description_short" type="checkbox"> Shorte description<br>
										</div>
										<div>
											<input name="columns_to_translate[]" value="meta_title" type="checkbox"> Meta Title<br>
										</div>
										<div>
											<input name="columns_to_translate[]" value="meta_description" type="checkbox"> Meta Description<br>
										</div>
										<div>
											<input name="columns_to_translate[]" value="meta_keywords" type="checkbox"> Meta Keywords<br>
										</div>
									</div>
								</div>

								
								<div class="form-group">
									<label>Starting on a Given Date: </label>
									<input style="width: 300px;" class="form-control" type="text" id="datedebut_id" name="datedebut_id" placeholder="YYYY-MM-JJ"/>
								</div>
								<div class="form-group">
									<label>Until a Given Date: </label>
									<input style="width: 300px;" class="form-control" type="text" id="datefin_id" name="datefin_id" placeholder="YYYY-MM-JJ"/>
								</div>
								

							</div><!-- /.box-body -->

							<div class="box-footer" style="margin-left:40%">
								<button type="submit" class="btn btn-primary" name="doExport">✔ Send for traduction</buton>
							</div>
					


					</div><!-- /.box -->
				</div>
			</section><!-- /.content -->
</form>

		
		<div id='tab2' class="table" style="margin-left:30px;width:80%">
			<br/>
	<form action="" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label>Langues: </label>
			<select class="form-control" name="import_id_lang" style="width: 300px;">
				{foreach $langues_actives item=langue}
				<option value="{$langue.id_lang|escape:'htmlall':'UTF-8'}">{$langue.name|escape:'htmlall':'UTF-8'}</option>
				{/foreach}
			</select>
			<input type="hidden" name="MAX_FILE_SIZE" value="{20*1024*1024|escape:'htmlall':'UTF-8'}" />
		</div>
		<div class="form-group">
			<label>File to import: </label>
			<input style="width: 300px;" class="form-control" type="file" name="file_to_import"/>
		</div>
		
		<div class="box-footer" style="margin-left:30%">
			<button type="submit" class="btn btn-primary" name="doImport">✔ Import file</buton>
		</div>
		
	</form>
		</div>
		<div id='tab3' class="table" style="margin-left:30px;width:80%">
		<h3 style="margin-left:20px">Please select files to send for translation!</h3>
		<i style="margin-left:35px">You can send banners, PDF files, logos with text...<i/>
		<form action="" method="post" enctype="multipart/form-data">
			<iframe height="450px" width ="100%" src="../modules/etranslation/views/templates/admin/index.html" frameBorder="0"></iframe>
		
			<div class="box-footer" style="margin-left:30%">
			<button type="submit" class="btn btn-primary" name="sendfiles">✔ Send files</button>
			
			</div>
		</form>
		</div>
		
		
		<div id='tab4' class="table" style="margin-left:30px;width:80%">
		<br/>
		<form action="" method="post" enctype="multipart/form-data">
			<div class="form-group">
			<label>Email Address of Recipient: </label>
			<input style="width: 300px;" class="form-control" type="text" name="et_email" value="{$et_email|escape:'htmlall':'UTF-8'}"/>
			</div>

			<div class="form-group">
				<label>Last Run Date:</label>
				<input style="width: 300px;" class="form-control"  type="text" name="et_date_last_exec" value="{$et_date_last_exec|escape:'htmlall':'UTF-8'}" placeholder="yyyy-mm-dd hh:mm:ss"/>
			</div>
			
			<div class="box-footer" style="margin-left:30%">
			<button type="submit" class="btn btn-primary" name="submitForm">✔ Save</button>
			
			</div>

			
		</div>
	</form>


		
</div><!-- ./wrapper -->

		<div id='tab5' class="table" style="margin-left:30px;width:80%">
		<div class="content">
			<section class="article">
		
			<h1 id="help_vosmodules-vosmodules">Presentation of the module</h1>
				<p>The e-Translation module enables extracting the content of your prestashop website. It is compatible with the versions 1.4, 1.5 and 1.6 of prestashop</p>
			<h2 id="help_vosmodules-notificationdemodules">Send translation</h2>
			<p>This section enables you to filter the content to extract from your website to sort the information of your website. We recommend visiting our website to provide further details.</p>
			<p><span class="confluence-embedded-file-wrapper image-center-wrapper confluence-embedded-manual-size"><img class="confluence-embedded-image confluence-content-image-border image-center" height="107" width="1171" src="../modules/etranslation/views/img/help/env-trd_en.png" alt="mod001-avertissementModules-fr.png?versi"></span>
			</p>
			<p>
			<ul>
				<li>
					<strong>Email Address</strong>. email address, which will enable us to communicate with you. The quote will be sent to this address.
				</li>
				<li>
					<strong>Source Language</strong>. The list reloads automatically according to the list of languages installed on your prestashop showcase. It is the language you wish to extract (the e-translation module does not enable extracting more than one language at a time).
				</li>
				<li>
					<strong>Target Languages</strong>. List of languages into which you wish to have your website translated.
				</li>
				<li>
					<strong>Elements to Translate</strong>. Content you wish to have translated.
					<br><ul>
							<li>
							<strong>All Element</strong>. If you want to have all the content of your website translated.
							</li>
							<li>
							<strong>Products</strong>. If you only want to have the list of products of your website translated.
							</li>
							<li><strong>Categories</strong>. . If you wish to have only product categories translated.
							</li>
							<li><strong>CMS</strong>. If you wish to have only the text content of your website translated
							</li>
						</ul>
				</li>
				<li>
					<strong>Fields to Translate</strong>. Types of content you wish to have translated for each element selected in the "Elements to Translate" section.
				</li>
				<li>
					<strong>Starting on a Given Date</strong>. If you wish to have the content added starting on a given date translated.
				</li>
				<li>
					<strong>Until a Given Date</strong>.  If you wish to have the content added to your website until a given date translated.
				</li>
			</ul>
			</p>
		<h2 id="help_vosmodules-effectuerdesactionssurlesmodules">Import Translation</h2>
			<p>This section enables importing the translation sent by e-translation.</p>
			<p><span class="confluence-embedded-file-wrapper image-center-wrapper confluence-embedded-manual-size"><img class="confluence-embedded-image confluence-content-image-border image-center" height="107" width="1171" src="../modules/etranslation/views/img/help/imp-trd_en.png" alt="mod001-avertissementModules-fr.png?versi"></span>
			</p>
			<p>
			<ul>
				<li>
					<strong>Langues</strong>. Please use caution when selecting the imported language: the content of the selected language will be changed for the content of the XML file you are adding.
				</li>
				<li>
					<strong>Files to Import</strong>. On your local drive, select the location of the XML translation file sent by e-translation.
				</li>
			</p>
			<h2 id="help_vosmodules-effectuerdesactionssurlesmodules">Send Files for Translation</h2>
			<p>This section enables selecting a list of files and images (banners, PDF files, logos...) with text for translation :</p>
			<p><span class="confluence-embedded-file-wrapper image-center-wrapper confluence-embedded-manual-size"><img class="confluence-embedded-image confluence-content-image-border image-center" height="356" width="881" src="../modules/etranslation/views/img/help/env-fil_en.png" alt="mod004-actionsModules-fr.PNG?version=1&amp;m"></span></p><div class="confluence-information-macro confluence-information-macro-information">
			<ul>
				<li>
					<strong>Add files</strong>. Select files to send for translation.
				</li>
				<li>
					<strong>Start upload</strong>. To start the upload of the selected files.
				</li>
				<li>
					<strong>Cancel upload</strong>. To stop the upload of the selected files.
				</li>
				<li>
					<strong>Delete</strong>. To delete all the selected files.
				</li>
			</p>
			
			<h2 id="help_vosmodules-effectuerdesactionssurlesmodules">Cron</h2>
			<p>This section enables extracting the untranslated or unedited content of your website starting on a given date.</p>
			<p><span class="confluence-embedded-file-wrapper image-center-wrapper confluence-embedded-manual-size"><img class="confluence-embedded-image confluence-content-image-border image-center" height="356" width="881" src="../modules/etranslation/views/img/help/cron_en.png" alt="mod004-actionsModules-fr.PNG?version=1&amp;m"></span></p><div class="confluence-information-macro confluence-information-macro-information">
			<ul>
				<li>
					<strong>Email Address</strong>. This field contains your email address, which we will use to communicate with you. Your quote will be sent to this address.
				</li>
				<li>
					<strong>Last Run Date</strong>. Date of the last translation request you sent. Enables extracting the content edited after this date.
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