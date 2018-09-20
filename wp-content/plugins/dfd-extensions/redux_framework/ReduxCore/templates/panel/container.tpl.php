<?php
/**
 * The template for the main panel container.
 *
 * Override this template by specifying the path where it is stored (templates_path) in your Redux config.
 *
 * @author 		Redux Framework
 * @package 	ReduxFramework/Templates
 * @version     3.4.3
 */
$expanded = ( $this->parent->args['open_expanded'] ) ? ' fully-expanded' : '' . (!empty($this->parent->args['class']) ? ' ' . $this->parent->args['class'] : '' );
$nonce = wp_create_nonce("redux_ajax_nonce" . $this->parent->args['opt_name']);
?>
<a style="display: none;" href="#TB_inline?width=400&height=500&inlineId=hiddenModalContent&modal=true" id="CompilelessCliker" class="thickbox" >Show hidden modal content.</a>
<div id="hiddenModalContent" style="display:none">
	<div class="BlockCompile" style="text-align:center">
		<p class="heading"> Please wait while theme ReCompile styles. <br> Don't close this window</p>
		<p class="compilestatuslessTotal" > </p>
		<p class="compilestatuslessBar" ><span class="stat">&nbsp;</span> </p>
		<table class="compilestatusless" style="text-align:center" >

		</table>
		<p style="text-align:center; display: none" class="closeCompile">
			<input type="submit" id="Login" value="&nbsp;&nbsp;Compile Error&nbsp;&nbsp;" onclick="tb_remove()">
			<br><span class="compile_err_mess">Please increase <code>max_input_vars</code> setting in server configuration if it's lower then 3000 and contact our team if it is but the issue still shows up.</span>
		</p>
	</div>
</div>
<?php
/*
<style>
	.compilestatuslessBar{
		height: 20px;
		background: rgba(167, 167, 167, 0.15);
	}
	.BlockCompile .hasError{
		color: red;
	}
	.closeCompile .compile_err_mess{
		color: red;
	}
	.BlockCompile .c_row{
		border-top: 1px solid #999;
	}
	.compilestatusless{
		width: 100%;
	}
	.compilestatusless thead{
		font-weight: bold;
	}
	.compilestatuslessBar .stat{
		background: green;
		height: 100%;
		width: 0%;
		display: block;
		-webkit-transition: all 0.5s ease-out 0.5s;
		-moz-transition: all 0.5s ease-out 0.5s;
		-o-transition: all 0.5s ease-out 0.5s;
		transition: all 0.5s ease-out 0.5s;
	}
</style>
*/
?>
<script type="text/template" id="templateCompileLessModalStatsTotal">
	Progress <b><%= start %></b> of <b><%= end %></b><br>
</script>
<script type="text/template" id="templateСompilestatuslessHead">
	<thead>
	<tr>
	<td>file name</td>
	<td> size</td>
	<td> total size</td>
	</tr>
	</thead>
</script>
<script type="text/template" id="templateCompileLessModalStats">
	<tbody>
	<tr>
	<% if(error_message) { %>
	<td colspan="3" class="hasError"><%=error_message%></span>
	<% } else { %>
	<td><%= name %></td>
	<td><%= scrip_m %></td>
	<td><%= total_m %>M</td>
	<%}%>
	</tr>
	</tbody>
</script>
<div class="redux-container<?php echo $expanded; ?>">
	<?php $action = ( $this->parent->args['database'] == "network" && $this->parent->args['network_admin'] && is_network_admin() ? './edit.php?action=redux_' . $this->parent->args['opt_name'] : './options.php' ) ?>
	<form method="post" action="<?php echo $action; ?>" data-nonce="<?php echo $nonce; ?>" enctype="multipart/form-data" id="redux-form-wrapper">
		<input type="hidden" id="redux-compiler-hook" name="<?php echo $this->parent->args['opt_name']; ?>[compiler]" value=""/>
		<input type="hidden" id="currentSection" name="<?php echo $this->parent->args['opt_name']; ?>[redux-section]" value=""/>
		<?php if (!empty($this->parent->no_panel)) : ?>
			<input type="hidden" name="<?php echo $this->parent->args['opt_name']; ?>[redux-no_panel]" value="<?php echo implode('|', $this->parent->no_panel); ?>"/>
		<?php endif; ?>
			   <?php
			   // Must run or the page won't redirect properly
			   $this->init_settings_fields();

			   // Last tab?
			   $this->parent->options['last_tab'] = ( isset($_GET['tab']) && !isset($this->parent->transients['last_save_mode']) ) ? $_GET['tab'] : '';
			   ?>
		<input type="hidden" id="last_tab" name="<?php echo $this->parent->args['opt_name']; ?>[last_tab]" value="<?php echo $this->parent->options['last_tab']; ?>"/>

		<?php $this->get_template('content.tpl.php'); ?>

	</form>
</div>

<?php if (isset($this->parent->args['footer_text'])) : ?>
	<div id="redux-sub-footer"><?php echo $this->parent->args['footer_text']; ?></div>
<?php endif; ?>
