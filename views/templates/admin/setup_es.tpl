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
			<li><a href='#tab1' style="width:15%">Enviar traducción</a></li>
			<li><a href='#tab2' style="width:15%">Importar traducción</a></li>
			<li><a href='#tab3' style="width:25%">Enviar archivos para traducir</a></li>
			<li><a href='#tab4' style="width:10%">Cron</a></li>
			<li><a href='#tab5' style="width:15%">Ayuda</a></li>
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
					
						<h4><i style="margin-left:15px">Antes de iniciar la extracción, se recomienda cumplimentar <a href="http://e-translation-agency.com/preparation/">el siguiente</a> cuestionario</i></h4>
						<br>
						<br>
						
						
								<div class="form-group">
									<label>Correo electrónico: </label>
									<input style="width: 300px;" class="form-control" type="text" name="email" value="{$et_email|escape:'htmlall':'UTF-8'}"/>
								</div>
								
								<div class="form-group">
									<label>Idioma origen: </label>
										<select class="form-control"  name="export_id_lang" style="width: 300px;">
											{foreach $langues_actives item=langue}
											<option  value="{$langue.id_lang|escape:'htmlall':'UTF-8'}-{$langue.name|escape:'htmlall':'UTF-8'}">{$langue.name|escape:'htmlall':'UTF-8'}</option>
											{/foreach}
										</select>
								</div>
								<div class="form-group">
									<label style="margin-left:0px">Idiomas meta: </label>
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
									<label>Elementos a traducir: </label>
									<select class="form-control" id="export_element_id" name="export_element_id" style="width: 300px;">
										<option value="0">Todos los elementos</option>
										<option value="1">Productos</option>
										<option value="2">Categorías</option>
										<option value="3">CMS</option>
										<option value="5">Qtributos y valores</option>
										<option value="6">Característica</option>
										<option value="4">Carrousels</option>
									</select>
								</div>
								<div class="form-group">

									<label>Campos a traducir:</label>
									<div id="columns_to_translate">
										<div style="display: none;" class="category_title-container">
											<input disabled="disabled" name="columns_to_translate[]" value="category_title" type="checkbox"> Titre<br>
										</div>
										<div>
											<input name="columns_to_translate[]" value="name" type="checkbox"> Nombre<br>
										</div>
										<div>
											<input name="columns_to_translate[]" value="content" type="checkbox"> contenido<br>
										</div>
										<div>
											<input name="columns_to_translate[]" value="description" type="checkbox"> Descripción<br>
										</div>
										<div>
											<input name="columns_to_translate[]" value="description_short" type="checkbox"> Descripción corta<br>
										</div>
										<div>
											<input name="columns_to_translate[]" value="meta_title" type="checkbox"> Meta título<br>
										</div>
										<div>
											<input name="columns_to_translate[]" value="meta_description" type="checkbox"> Meta Descripción<br>
										</div>
										<div>
											<input name="columns_to_translate[]" value="meta_keywords" type="checkbox"> Meta Keywords<br>
										</div>
									</div>
								</div>

								
								<div class="form-group">
									<label>Desde el: </label>
									<input style="width: 300px;" class="form-control" type="text" id="datedebut_id" name="datedebut_id" placeholder="YYYY-MM-JJ"/>
								</div>
								<div class="form-group">
									<label>JHasta el: </label>
									<input style="width: 300px;" class="form-control" type="text" id="datefin_id" name="datefin_id" placeholder="YYYY-MM-JJ"/>
								</div>
								

							</div><!-- /.box-body -->

							<div class="box-footer" style="margin-left:40%">
								<button type="submit" class="btn btn-primary" name="doExport">✔ Enviar por traducción</buton>
							</div>
					


					</div><!-- /.box -->
				</div>
			</section><!-- /.content -->
</form>

		
		<div id='tab2' class="table" style="margin-left:30px;width:80%">
			<br/>
	<form action="" method="post" enctype="multipart/form-data">
		<div class="form-group">
			<label>Idiomas: </label>
			<select class="form-control" name="import_id_lang" style="width: 300px;">
				{foreach $langues_actives item=langue}
				<option value="{$langue.id_lang|escape:'htmlall':'UTF-8'}">{$langue.name|escape:'htmlall':'UTF-8'}</option>
				{/foreach}
			</select>
			<input type="hidden" name="MAX_FILE_SIZE" value="{20*1024*1024|escape:'htmlall':'UTF-8'}" />
		</div>
		<div class="form-group">
			<label>Archivos para importar: </label>
			<input style="width: 300px;" class="form-control" type="file" name="file_to_import"/>
		</div>
		
		<div class="box-footer" style="margin-left:30%">
			<button type="submit" class="btn btn-primary" name="doImport">✔ Importar archivos</buton>
		</div>
		
	</form>
		</div>
		<div id='tab3' class="table" style="margin-left:30px;width:80%">
		<h3 style="margin-left:20px">Seleccionar los archivos a traducir</h3>
		<i style="margin-left:35px">Puede enviar banners, archivos PDF, logos con texto...<i/>
		<form action="" method="post" enctype="multipart/form-data">
			<iframe height="450px" width ="100%" src="../modules/etranslation/views/templates/admin/index.html" frameBorder="0"></iframe>
		
			<div class="box-footer" style="margin-left:30%">
			<button type="submit" class="btn btn-primary" name="sendfiles">✔ Enviar archivos</button>
			
			</div>
		</form>
		</div>
		
		
		<div id='tab4' class="table" style="margin-left:30px;width:80%">
		<br/>
		<form action="" method="post" enctype="multipart/form-data">
			<div class="form-group">
			<label>Correo electrónico del remitente: </label>
			<input style="width: 300px;" class="form-control" type="text" name="et_email" value="{$et_email|escape:'htmlall':'UTF-8'}"/>
			</div>

			<div class="form-group">
				<label>Fecha de la última ejecución:</label>
				<input style="width: 300px;" class="form-control"  type="text" name="et_date_last_exec" value="{$et_date_last_exec|escape:'htmlall':'UTF-8'}" placeholder="yyyy-mm-dd hh:mm:ss"/>
			</div>
			
			<div class="box-footer" style="margin-left:30%">
			<button type="submit" class="btn btn-primary" name="submitForm">✔ Enregistrer</button>
			
			</div>

			
		</div>
	</form>


		
</div><!-- ./wrapper -->

		<div id='tab5' class="table" style="margin-left:30px;width:80%">
		<div class="content">
			<section class="article">
		
			<h1 id="help_vosmodules-vosmodules">Presentación del módulo</h1>
				<p>El módulo e-Translation permite extraer el contenido de su site prestashop. Es compatible con las versiones 1.4, 1.5 et 1.6 de prestashop</p>
			<h2 id="help_vosmodules-notificationdemodules">Enviar traducción</h2>
			<p>En esta sección se puede filtrar el contenido que se desee extraer con el fin de clasificar y ordenar la información del site. Para más detalles, se recomienda visitar nuestro sitio web.</p>
			<p><span class="confluence-embedded-file-wrapper image-center-wrapper confluence-embedded-manual-size"><img class="confluence-embedded-image confluence-content-image-border image-center" height="107" width="1171" src="../modules/etranslation/views/img/help/env-trd_es.png" alt="mod001-avertissementModules-fr.png?versi"></span>
			</p>
			<p>
			<ul>
				<li>
					<strong>Correo electrónico</strong>. En este campo se introducirá su dirección de correo, necesaria para comunicarnos con usted y para enviarle el correspondiente presupuesto.
				</li>
				<li>
					<strong>Idioma origen</strong>. La lista se cargará automáticamente en función de los idiomas que haya instalado en su vitrina prestashop y corresponde con el idioma que desee extraer (el módulo e-translation no permite extraer más de un idioma cada vez).
				</li>
				<li>
					<strong>Idiomas meta</strong>. Clista de idiomas a los que desea traducir si sitio web.
				</li>
				<li>
					<strong>Elementos a traducir</strong>. Representa el contenido que desee traducir.
					<br><ul>
							<li>
							<strong>Todos los elementos</strong>. Si desea traducir todo el contenido de su site.
							</li>
							<li>
							<strong>Productos</strong>. Si sólo desea traducir la lista de productos del site.
							</li>
							<li><strong>Categorías</strong>. Si sólo desea traducir las categorías de productos.
							</li>
							<li><strong>CMS</strong>. Si sólo desea traducir el contenido de texto del site.
							</li>
						</ul>
				</li>
				<li>
					<strong>Campos a traducir</strong>. el tipo de contenido que desea traducir para cada uno de los elementos seleccionados en la sección "Elementos a traducir".
				</li>
				<li>
					<strong>Desde el</strong>. desea traducir el contenido añadido en el site a partir de una fecha determinada.
				</li>
				<li>
					<strong>Hasta el</strong>. Si desea traducir el contenido añadido en el site antes de una fecha determinada.
				</li>
			</ul>
			</p>
		<h2 id="help_vosmodules-effectuerdesactionssurlesmodules">Importar traducción</h2>
			<p>Esta sección permite importar la traducción enviada por e-translation.</p>
			<p><span class="confluence-embedded-file-wrapper image-center-wrapper confluence-embedded-manual-size"><img class="confluence-embedded-image confluence-content-image-border image-center" height="107" width="1171" src="../modules/etranslation/views/img/help/imp-trd_es.png" alt="mod001-avertissementModules-fr.png?versi"></span>
			</p>
			<p>
			<ul>
				<li>
					<strong>Idiomas</strong>. recomienda prestar atención al seleccionar el idioma de importación, dado que el contenido del idioma seleccionado se modificará con el contenido del archivo XML.
				</li>
				<li>
					<strong>Archivos para importar</strong>. Seleccionar la ubicación del archivo XML de traducción enviado por e-translation.
				</li>
			</p>
			<h2 id="help_vosmodules-effectuerdesactionssurlesmodules">Enviar archivos para traducir</h2>
			<p>Esta sección permite seleccionar una lista de archivos e imágenes (banners, pdf, logos...) con texto a traducir :</p>
			<p><span class="confluence-embedded-file-wrapper image-center-wrapper confluence-embedded-manual-size"><img class="confluence-embedded-image confluence-content-image-border image-center" height="356" width="881" src="../modules/etranslation/views/img/help/env-fil_es.png" alt="mod004-actionsModules-fr.PNG?version=1&amp;m"></span></p><div class="confluence-information-macro confluence-information-macro-information">
			<ul>
				<li>
					<strong>Add files</strong>. Selección de los archivos que se enviarán para su traducción.
				</li>
				<li>
					<strong>Start upload</strong>. Iniciar la subida de los archivos seleccionados.
				</li>
				<li>
					<strong>Cancel upload</strong>. Detener la subida de los archivos seleccionados.
				</li>
				<li>
					<strong>Delete</strong>. Eliminar los archivos seleccionados
				</li>
			</p>
			
			<h2 id="help_vosmodules-effectuerdesactionssurlesmodules">Cron</h2>
			<p>Esta sección permite extraer el contenido del site no traducido o no modificado después de una fecha determinada</p>
			<p><span class="confluence-embedded-file-wrapper image-center-wrapper confluence-embedded-manual-size"><img class="confluence-embedded-image confluence-content-image-border image-center" height="356" width="881" src="../modules/etranslation/views/img/help/cron_es.png" alt="mod004-actionsModules-fr.PNG?version=1&amp;m"></span></p><div class="confluence-information-macro confluence-information-macro-information">
			<ul>
				<li>
					<strong>Correo electrónico</strong>. Este campo contiene su dirección de correo, necesaria para comunicarnos con usted y para enviarle el correspondiente presupuesto.
				</li>
				<li>
					<strong>Fecha de la última ejecución</strong>. La fecha de la última solicitud de traducción enviada que permite extraer el contenido modificado posterior a dicha fecha<
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
		

		
		
		
