<div class="container<?php echo (!SGRB_PRO_VERSION) ? '-fluid' : '';?>">
	<div class="sgrb-preview-container">
		<div class="row sgrb-skin-style-preview-wrapper">
			<div class="col-md-12">
				<div class="row">
					<div class="col-md-5 col-md-offset-3">
						<div class="row">
							<div class="col-md-1 col-md-offset-2"<?php echo (!SGRB_PRO_VERSION) ? ' style="z-index:99999999"' : '';?>>
								<div class="sgrb-radio-wrapper">
									<input type="checkbox" value="<?php echo SGRB_RATE_TYPE_STAR;?>" id="<?php echo (SGRB_PRO_VERSION) ? 'sgrb-star-skin' : '';?>" name="rate-type" class="sgrb-rate-type sgrb-default-rating-type"/<?php echo ((@$sgrbDataArray['rate-type'] == SGRB_RATE_TYPE_STAR) || (@$sgrbRevId == 0) || !SGRB_PRO_VERSION ) ? ' checked' : '' ;?> autocomplete="off">
									<label for="<?php echo (SGRB_PRO_VERSION) ? 'sgrb-star-skin' : '';?>"></label>
								</div>
							</div>
							<div class="col-md-2"<?php echo (!SGRB_PRO_VERSION) ? ' style="z-index:99999999"' : '';?>>
								<label for="<?php echo (SGRB_PRO_VERSION) ? 'sgrb-star-skin' : '';?>">Star</label>
							</div>
							<?php if (!SGRB_PRO_VERSION) :?>
							<div class="col-md-2 sgrb-pro-skins-wrapper">
								<div class="sgrb-coming-soon">
									<a target="_blank" href="<?php echo SGRB_PRO_URL ;?>"><img src="<?php echo $sgrb->app_url.'assets/page/img/dist.png';?>" width="80px"></a>
								</div>
							<?php endif;?>
								<div class="col-md-1<?php echo (!SGRB_PRO_VERSION) ? ' col-md-offset-1' : '';?>">
									<div class="sgrb-radio-wrapper">
										<input type="checkbox" value="<?php echo SGRB_RATE_TYPE_PERCENT;?>"<?php echo (SGRB_PRO_VERSION) ? ' id="sgrb-percent-skin"' : '';?> name="rate-type" class="sgrb-rate-type"/<?php echo (@$sgrbDataArray['rate-type'] == SGRB_RATE_TYPE_PERCENT) ? ' checked' : '' ;?> autocomplete="off">
										<label for="sgrb-percent-skin"></label>
									</div>
								</div>
								<div class="col-md-2">
									<label for="sgrb-percent-skin">Percent</label>
								</div>
							<?php echo (!SGRB_PRO_VERSION) ? '</div>' : '';?>
							<?php if (!SGRB_PRO_VERSION) :?>
							<div class="col-md-2 col-md-offset-1 sgrb-pro-skins-wrapper" style="margin-left:8%;">
								<div class="sgrb-coming-soon">
									<a target="_blank" href="<?php echo SGRB_PRO_URL ;?>"><img src="<?php echo $sgrb->app_url.'assets/page/img/dist.png';?>" width="80px"></a>
								</div>
							<?php endif;?>
								<div class="col-md-1 col-md-offset-1">
									<div class="sgrb-radio-wrapper">
										<input type="checkbox" value="<?php echo SGRB_RATE_TYPE_POINT;?>"<?php echo (SGRB_PRO_VERSION) ? ' id="sgrb-point-skin"' : '';?> name="rate-type" class="sgrb-rate-type"/<?php echo (@$sgrbDataArray['rate-type'] == SGRB_RATE_TYPE_POINT) ? ' checked' : '' ;?> autocomplete="off">
										<label for="sgrb-point-skin"></label>
									</div>
								</div>
								<div class="col-md-2">
									<label for="sgrb-point-skin">Point</label>
								</div>
							<?php echo (!SGRB_PRO_VERSION) ? '</div>' : '';?>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4 col-md-offset-4" style="height: 100px;">
						<div class="sgrb-skin-style-preview">
							<div class=""></div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row" style="margin-bottom: 10px;">
			<div class="col-md-2">
				<div class="col-md-2"><a href="javascript:void(0)" type="button" class="sgrb-reset-options btn btn-danger" title="Reset to default"><?php _e('Reset to default', 'sgrb');?></a></div>
			</div>
			<div class="col-md-8 sgrb-skin-color-to-show<?php echo (@$sgrbDataArray['rate-type'] == SGRB_RATE_TYPE_STAR || !@$sgrbRev->getId()) ? '' : ' sgrb-disable' ;?>">
				<div class="row">
					<div class="col-md-6 text-right">
						<?php _e('Rate Skin color', 'sgrb');?>:
					</div>
					<div class="col-md-5">
						<input name="skin-color" type="text" value="<?php echo esc_attr(@$sgrbDataArray['skin-color']);?>" class="color-picker my-cp" autocomplete="off">
					</div>
				</div>
			</div>
		</div>

		<div class="row" style="margin-bottom: 10px;">
			<div class="col-md-6 text-right">
				<?php _e('Form & content text color', 'sgrb');?>:
			</div>
			<div class="col-md-5">
				<input name="rate-text-color" type="text" value="<?php echo esc_attr(@$sgrbDataArray['rate-text-color']);?>" class="color-picker" autocomplete="off">
			</div>
		</div>

		<div class="row sgrb-background-color-disable-js<?php echo (@$sgrbDataArray['transparent-background']) ? ' sgrb-disabled' : '';?>" style="margin-bottom: 10px;">
			<div class="col-md-6 text-right">
				<?php _e('Form & content background color', 'sgrb');?>:
			</div>
			<div class="col-md-5">
				<input name="total-rate-background-color" type="text" value="<?php echo esc_attr(@$sgrbDataArray['total-rate-background-color']);?>" class="color-picker" autocomplete="off">
			</div>
		</div>

		<div class="row" style="margin-bottom: 10px;">
			<div class="col-md-6 text-right">
				<span style="vertical-align:sub;"><?php echo _e('Transparent background', 'sgrb');?>:</span>
			</div>
			<div class="col-md-5">
				<div class="sgrb-on-off-checkbox-wrapper">
					<input type="checkbox" value="true" id="sgrb-transparent" name="transparent-background"<?php echo (@$sgrbDataArray['transparent-background']) ? ' checked' : '';?>>
					<label class="sgrb-checkbox-label" for="sgrb-transparent"></label>
				</div>
			</div>
		</div>

		<div class="row" style="margin-bottom: 10px;">
			<div class="col-md-6 text-right">
				<span style="vertical-align:sub;"><?php echo _e('Show total rate', 'sgrb');?>:</span>
			</div>
			<div class="col-md-5">
				<div class="sgrb-on-off-checkbox-wrapper">
					<input type="checkbox" value="true" id="sgrb-total-rate" name="totalRate"<?php echo (@$sgrbDataArray['total-rate'] || (!@$sgrbRev->getId())) ? ' checked' : '';?>>
					<label class="sgrb-checkbox-label" for="sgrb-total-rate"></label>
				</div>
			</div>
		</div>

		<div class="row" style="margin-bottom: 10px;">
			<div class="col-md-6 text-right">
				<span style="vertical-align:sub;"><?php echo _e('Show comments', 'sgrb');?>:</span>
			</div>
			<div class="col-md-5">
				<div class="sgrb-on-off-checkbox-wrapper">
					<input type="checkbox" value="true" id="sgrb-show-comments" name="showComments"<?php echo (@$sgrbDataArray['show-comments'] || (!@$sgrbRev->getId())) ? ' checked' : '';?>>
					<label class="sgrb-checkbox-label" for="sgrb-show-comments"></label>
				</div>
			</div>
		</div>

<?php if (SGRB_PRO_VERSION == 0) :?>
		<div class="row" style="margin-bottom: 10px;">
			<div class="col-md-6 text-right">
				<span style="vertical-align:sub;"><?php echo _e('Include captcha', 'sgrb');?>:</span>
			</div>
			<div class="col-md-5">
				<a target="_blank" href="<?php echo SGRB_PRO_URL ;?>" type="button" class="btn btn-danger" style="width: 100px;height: 31px;border-radius: 50px;">PRO</a>
			</div>
		</div>
<?php else: ?>
		<div class="row" style="margin-bottom: 10px;">
			<div class="col-md-6 text-right">
				<span style="vertical-align:sub;"><?php echo _e('Include captcha', 'sgrb');?>:</span>
			</div>
			<div class="col-md-5">
				<div class="sgrb-on-off-checkbox-wrapper">
					<input type="checkbox" value="true" id="sgrb-captcha-on" name="captcha-on"<?php echo (@$sgrbDataArray['captcha-on'] || (!@$sgrbRev->getId())) ? ' checked' : '';?>>
					<label class="sgrb-checkbox-label" for="sgrb-captcha-on"></label>
				</div>
			</div>
		</div>
<?php endif;?>
		<div class="row" style="margin-bottom: 10px;">
			<div class="col-md-6 text-right">
				<span style="vertical-align:sub;"><?php echo _e('Set review wrapper width', 'sgrb');?>:</span>
			</div>
			<div class="col-md-5">
				<div class="row">
					<div class="col-md-3">
						<input class="sgrb-wrapper-width-input" type="number" value="<?php echo (@$sgrbDataArray['wrapper-width'] ? @$sgrbDataArray['wrapper-width'] : 100);?>" name="wrapper-width">
					</div>
					<div class="col-md-3">
						<div class="sgrb-px-percent-checkbox-wrapper">
							<input type="checkbox" value="true" id="sgrb-wrapper-width-px" name="wrapper-width-px"<?php echo (@$sgrbDataArray['wrapper-width-px']) ? ' checked' : '';?>>
							<label class="sgrb-checkbox-label" for="sgrb-wrapper-width-px"></label>
						</div>
					</div>
				</div>
				<label class="sgrb-checkbox-label" for="sgrb-wrapper-width"></label>
			</div>
		</div>

	</div>

	<div class="sgrb-template-options-box" style="<?php echo (!@$sgrbDataArray['review-type'] || @$sgrbDataArray['review-type'] == 2) ? 'min-height:100px;' : 'display: none;';?>">
	<div class="sg-box-title"><?php echo _e('Template customize options', 'sgrb');?></div>
	<div class="sg-box-content">
		<?php if (SGRB_PRO_VERSION == 1) :?>
			<?php require_once('templatesOptionsPro.php');?>
		<?php else :?>
			<div style="position:relative;background-color:rgba(204, 204, 204, 0.27);">
			<div class="sgrb-coming-soon">
				<a class="sgrb-pull-right" target="_blank" href="<?php echo SGRB_PRO_URL ;?>"><img src="<?php echo $sgrb->app_url.'assets/page/img/long-ribbon.png'; ?>" width="400px"></a>
			</div>
				<div class="sgrb-template-options" style="opacity:0.7;">
					<div class="row">
						<div class="col-md-6 text-right">
							<?php echo _e('Background color', 'sgrb');?>:
						</div>
						<div class="col-md-5">
							<input type="text" class="color-picker my" autocomplete="off">
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 text-right">
							<?php echo _e('Text color', 'sgrb');?>:
						</div>
						<div class="col-md-5">
							<input type="text" class="color-picker" autocomplete="off">
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 text-right">
							<label for="sgrb-template-shadow-on"><?php echo _e('Template inner boxes shadow effect', 'sgrb');?>:</label>
						</div>
						<div class="col-md-5">
							<div class="sgrb-checkbox-wrapper">
								<input id="sgrb-template-shadow-on" value="true" type="checkbox" autocomplete="off">
								<label class="sgrb-checkbox-label" for="sgrb-template-shadow-on"></label>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 text-right">
							<?php echo _e('Color', 'sgrb');?>:
						</div>
						<div class="col-md-5">
							<input type="text" class="color-picker" autocomplete="off">
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 text-right">
							<?php echo _e('To Left / Right (- / +)', 'sgrb');?>:<i class="sgrb-required-asterisk"> * </i>
						</div>
						<div class="col-md-5">
							<input class="sgrb-template-shadow-directions sgrb-wrapper-width-input" type="number" autocomplete="off"> - px
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 text-right">
							<?php echo _e('To Top / Bottom (- / +)', 'sgrb');?>:<i class="sgrb-required-asterisk"> * </i>
						</div>
						<div class="col-md-5">
							<input class="sgrb-template-shadow-directions sgrb-wrapper-width-input" type="number" autocomplete="off"> - px
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 text-right">
							<?php echo _e('Blur effect', 'sgrb');?>:
						</div>
						<div class="col-md-5">
							<input class="sgrb-template-shadow-directions sgrb-wrapper-width-input" type="number" autocomplete="off"> - px
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 text-right">
							<?php echo _e('Font', 'sgrb');?>:
						</div>
						<div class="col-md-5">
							<div class="sgrb-total-options-rows-rate-type">
								<?php if (SGRB_PRO_VERSION) :?>
									<span>
										<div id="selectFonts" class="bfh-selectbox bfh-googlefonts" data-font="<?=@$sgrbDataArray['template-font']?>">
											<span class="caret selectbox-caret"></span>
										</div>
										<span id="drop"></span>
										<input class="fontSelectbox" type="hidden" name="fontSelectbox" value="">
									</span>
								<?php else :?>
									<img src="<?php echo $sgrb->app_url.'assets/page/img/default-font-input.png';?>" width="180px">
								<?php endif ;?>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php endif ;?>
	</div>
</div></div>
