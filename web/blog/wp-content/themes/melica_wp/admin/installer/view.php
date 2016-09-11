<div class="wrap">

	<h2><?php echo esc_html($title); ?></h2>

	<!-- Description text -->
	<div class="main-grid">
		<div class="text-col">
			<h3>Step 1. Include demo data</h3>

			<p><i>This step is optional.</i> Here you can include demo data to your site. This procedure will make your site look as our demo. Learning demo data helps you to understand overall architecture and internal institution of the theme.</p>

			<p>To start import just click the button below. Importing process may take up to <b>3-5 minutes</b>. Do not close window until import process is done. Note that we did not include images to release files. They used only for demonstration purposes.</p>

			<!-- Buttons -->
			<div class="buttons-line">
				<button class="button button-primary button-large wphunters-import">
					Import demo data
				</button>

				<span class="spinner"></span>
			</div>

			<!-- Result field -->
			<div class="import-message">
				<h3>Import results</h3>
				<p></p>
			</div>

			<hr class="mega-hr"/>

			<!-- Second section -->
			<h3>Step 2. Tune your WordPress installation</h3>

			<p>In this step you can automatically tune settings of your site to get much better experience using our theme.  Of course, you can skip this step or make changes by yourself. <b>What we'll do with your site:</b></p>

			<ul class="ul-square">
				<li>Set home page to <i>Index page</i>(if that page exists).</li>
				<li>Set permalinks settings to <i>Post name</i> option.</li>
			</ul>

			<!-- Buttons -->
			<div class="buttons-line">
				<button class="button button-primary button-large wphunters-tune">
					Tune WordPress for using with this theme
				</button>

				<span class="spinner"></span>
			</div>

			<!-- Result field -->
			<div class="tune-message">
				<h3>Setup results</h3>
				<p></p>
			</div>
		</div>

		<!-- Image logo -->
		<div class="logo-col"><img src="<?php echo $this_dir ?>/style/logo_black.png" alt=""/></div>

	</div>

</div>

<!-- JavaScript & styles -->
<link rel="stylesheet" href="<?php echo $this_dir ?>/style/style.css"/>
<script type="text/javascript" src="<?php echo $this_dir ?>/style/importer.js"></script>