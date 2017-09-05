<?php
global $sgrb;
$sgrb->includeController('Controller');
$sgrb->includeController('Comment');
$sgrb->includeCore('Template');
$sgrb->includeLib('Input');
$sgrb->includeView('Admin');
$sgrb->includeView('Review');
$sgrb->includeView('TemplateDesign');
$sgrb->includeModel('TemplateDesign');
$sgrb->includeModel('Review');
$sgrb->includeModel('Comment');
$sgrb->includeModel('CommentForm');
$sgrb->includeModel('Template');
$sgrb->includeModel('Category');
$sgrb->includeModel('Comment_Rating');
$sgrb->includeModel('Rate_Log');
$sgrb->includeModel('Page_Review');

class SGRB_ReviewController extends SGRB_Controller
{
	private $flag = 0;
	private $isWidgetReview = false;

	public function index()
	{
		global $sgrb;
		$sgrb->includeScript('page/scripts/helpers/sgReviewHelper');
		$sgrb->includeScript('page/scripts/helpers/sgTemplateHelper');
		$sgrb->includeScript('page/scripts/helpers/sgCommentHelper');
		$sgrb->includeScript('page/scripts/helpers/sgRateSkin');
		$sgrb->includeScript('page/scripts/helpers/sgMainHelper');
		$sgrb->includeScript('page/scripts/helpers/sgWizardSettings');
		$sgrb->includeScript('page/scripts/sgReview');
		$sgrb->includeScript('page/scripts/sgComment');
		$sgrb->includeScript('page/scripts/sgTemplate');
		$sgrb->includeScript('page/scripts/sgForm');
		$sgrb->includeStyle('page/styles/bootstrapTheme');
		$sgrb->includeScript('core/scripts/main');
		$sgrb->includeScript('core/scripts/sgrbRequestHandler');
		$review = new SGRB_ReviewReviewView();
		$createNewUrl = $sgrb->adminUrl('Review/edit');

		SGRB_AdminView::render('Review/index', array(
			'createNewUrl' => $createNewUrl,
			'review' => $review
		));
	}

	public function sgrbShortcode($atts, $content)
	{
		global $sgrb;

		$attributes = shortcode_atts(array(
			'id' => '1',
		), $atts);
		$sgrbId = (int)$attributes['id'];
		$sgrbRev = SGRB_ReviewModel::finder()->findByPk($sgrbId);
		if(!$sgrbRev){
			return false;
		}
		$arr = array();
		$title = $sgrbRev->getTitle();
		$templateId = $sgrbRev->getTemplate_id();
		$options = $sgrbRev->getOptions();
		$template = SGRB_TemplateModel::finder()->findByPk($templateId);

		$arr['title'] = $title;
		$arr['id'] = $sgrbId;
		$arr['template-id'] = $templateId;
		$arr['options'] = json_decode($options,true);
		$arr['template'] = $template;
		$sgrbDataArray[] = $arr;

		$html = $this->createReviewHtml($sgrbDataArray);
		$this->flag++;
		return $html;
	}

	public function ajaxSave()
	{
		global $wpdb;
		global $sgrb;
		$sgrb->includeCore('Template');
		SGRB_Input::setSource($_POST);

		$tempOptions = array();
		$options = array();
		$tagsArray = array();
		$templateImgArr = array();
		$templateTextArr = array();
		$templateUrlArr = array();
		$currentReviewProducts = array();
		$reviewId = 0;
		$lastRevId = 0;
		$isUpdate = false;
		$isSimpleReview = false;
		//$rateTypeNotice = SGRB_Input::get('rate-type-notice');
		$reviewType = SGRB_Input::get('review-type');
		$templateImgArr = SGRB_Input::get('image_url');
		$templateTextArr = SGRB_Input::get('input_html');
		$templateUrlArr = SGRB_Input::get('input_url');
		$tempName = SGRB_Input::get('sgrb-template');

		$title = SGRB_Input::get('sgrb-title');
		$tagsArray = SGRB_Input::get('tagsArray');

		$tempOptions['images'] = $templateImgArr;
		$tempOptions['html'] = $templateTextArr;
		$tempOptions['url'] = $templateUrlArr;
		$tempOptions['name'] = $tempName;

		if (count($_POST)) {

			$reviewId = (int)SGRB_Input::get('sgrb-id');

			$review = new SGRB_ReviewModel();
			$isUpdate = false;

			if ($reviewId) {

				$isUpdate = true;
				$review = SGRB_ReviewModel::finder()->findByPk($reviewId);
				if (!$review) {
					exit();
				}
				$options = $review->getOptions();
				$options = json_decode($options, true);

				$wooOptions = @$options['woo-products'];
				$currentRateType = @$options['rate-type'];
				$currentReviewProducts = json_decode($wooOptions);


			}
			////////////////////////////
			$simpleReviewTemplate = '';
			$simpleReviewTemplateType = '';
			$shadowLeftRight = '';
			$shadowTopBottom = '';
			$shadowBlur = '';
			//////////////////////
			$options['notify'] = '';
			$options['required-title-checkbox'] = '';
			$options['required-email-checkbox'] = '';
			$options['auto-approve-checkbox'] = '';
			$options['user-detect-by'] = '';
			$options['template-field-shadow-on'] = '';
			$options['sgrb-google-search-on'] = '';
			$options['disable-wp-comments'] = '';
			// wooCommerce
			$options['disable-woo-comments'] = '';
			// wooCommerce
			$options['comments-count-to-show'] = '';
			$options['comments-count-to-load'] = '';
			$options['required-login-checkbox'] = '';
			$options['hide-comment-form'] = '';
			$options['captcha-on'] = '';
			$options['widget-link-add-text'] = '';
			$options['widget-link-edit-text'] = '';
			$wooCategoryString = '';
			$wooProductsString = '';

			if ($reviewType == SGRB_REVIEW_TYPE_SIMPLE) {
				$isSimpleReview = true;
				$simpleReviewTemplateTypeEmpty = SGRB_Input::get('sgrb-sample-template-type-empty');
				$simpleReviewTemplateTypeText = SGRB_Input::get('sgrb-sample-template-type-text');
				$simpleReviewTemplateTypeImage = SGRB_Input::get('sgrb-sample-template-type-image');
				if ($simpleReviewTemplateTypeEmpty) {
					/*nothing to show, empty template part in front*/
					$simpleReviewTemplate = '';
					$simpleReviewTemplateType = 'empty';
				}
				else if ($simpleReviewTemplateTypeText) {
					/*get text*/
					$simpleReviewTemplate = SGRB_Input::get('sgrb-sample-template-text');
					$simpleReviewTemplateType = 'text';
				}
				else if ($simpleReviewTemplateTypeImage) {
					/*get image url*/
					$simpleReviewTemplate = SGRB_Input::get('simple_image_url');
					$simpleReviewTemplateType = 'image';
				}
				/* set default simple template id,which is equal to 27 ($result is template id)*/
				$tempId = $review->getTemplate_id();
				if ($tempId) {
					$template = new Template('simple_review', $tempId);
				}
				else {
					$template = new Template('simple_review');
				}
				$tempOptions['name'] = 'simple_review';
				$result = $template->save($tempOptions);
			}
			else if ($reviewType == SGRB_REVIEW_TYPE_POST) {
				$tempId = $review->getTemplate_id();
				if ($tempId) {
					$template = new Template('post_review', $tempId);
				}
				else {
					$template = new Template('post_review');
				}
				$tempOptions['name'] = 'post_review';
				$result = $template->save($tempOptions);
			}
			else if ($reviewType == SGRB_REVIEW_TYPE_WOO) {
				$tempId = $review->getTemplate_id();
				if ($tempId) {
					$template = new Template('woo_review', $tempId);
				}
				else {
					$template = new Template('woo_review');
				}
			}
			else {
				$tempId = $review->getTemplate_id();
				if ($tempId) {
					$template = new Template($tempName,$tempId);
				}
				else {
					$template = new Template($tempName);
				}

				$result = $template->save($tempOptions);
				if (!$result) {
					exit();
				}
			}
			/////////////////////////////

			$fields = SGRB_Input::get('field-name');
			//$simpleFields = SGRB_Input::get('simple-field-name');
			$fields = $this->stripslashesDeep($fields);
			$simpleFields = SGRB_Input::getStripSlashed('simple-field-name');
			$fieldId = SGRB_Input::get('fieldId');
			$simpleFieldId = SGRB_Input::get('simpleFieldId');
			$title = SGRB_Input::getStripSlashed('sgrb-title');
			//$ratingType = SGRB_Input::get('rate-type');
			$totalRateBackgroundColor = SGRB_Input::get('total-rate-background-color');

			$shadowLeftRight = SGRB_Input::get('shadow-left-right');
			$shadowTopBottom = SGRB_Input::get('shadow-top-bottom');
			$shadowBlur = SGRB_Input::get('shadow-blur');
			$postCategory = SGRB_Input::get('post-category');
			// wooCommerce
			$wooReviewShowType = SGRB_Input::get('wooReviewShowType');

			if ($wooReviewShowType == 'showByCategory') {
				$wooProductsCategories = SGRB_Input::get('all-products-categories');
				$wooProductsCategories = rtrim($wooProductsCategories, ',');
				$wooCategory = explode(',', $wooProductsCategories);
				$wooCategoryString = json_encode($wooCategory);
				$wooProducts = array();
				$wooProductsString = '';
			}
			else if ($wooReviewShowType == 'showByProduct') {
				$wooCategory = array();
				$wooProductsCategories = SGRB_Input::get('all-products-categories');
				$wooProductsCategories = str_replace('\"', '"', $wooProductsCategories);
				$wooProductsCategories = json_decode($wooProductsCategories, true);

				if (!empty($currentReviewProducts)) {
					foreach ($wooProductsCategories as $prod => $val) {
						if ($val == 0) {
							unset($wooProductsCategories[$prod]);
						}
						else {
							$wooProductsCategories[$prod] = 1;
						}
					}
				}

				$wooProducts = $wooProductsCategories;
				$wooProductsString = json_encode($wooProductsCategories);
				$wooCategoryString = '';
			}
			$disableWooComments = SGRB_Input::get('disable-woo-comments');
			// wooCommerce
			$disableWPcomments = SGRB_Input::get('disableWPcomments');
			$commentsCount = (int)SGRB_Input::get('comments-count-to-show');
			$commentsCountLoad = (int)SGRB_Input::get('comments-count-to-load');

			if (SGRB_PRO_VERSION) {
				// wooCommerce
				$options['wooReviewShowType'] = $wooReviewShowType;
				// wooCommerce
				$options['captcha-text'] = SGRB_Input::getStripSlashed('captcha-text');
				$options['logged-in-text'] = SGRB_Input::getStripSlashed('logged-in-text');
				$options['no-captcha-text'] = SGRB_Input::getStripSlashed('no-captcha-text');
				$options['widget-link-add-text'] = SGRB_Input::getStripSlashed('widget-link-add-text');
				$options['widget-link-edit-text'] = SGRB_Input::getStripSlashed('widget-link-edit-text');
				if ($commentsCount) {
					$options['comments-count-to-show'] = $commentsCount;
				}
				if ($commentsCountLoad) {
					$options['comments-count-to-load'] = $commentsCountLoad;
				}
				if (SGRB_Input::isIsset('email-notification-checkbox')) {
					$options['notify'] = sanitize_text_field(SGRB_Input::get('email-notification'));
				}
				if (SGRB_Input::isIsset('template-field-shadow-on')) {
					if ($shadowLeftRight && $shadowTopBottom) {
						$options['template-field-shadow-on'] = SGRB_Input::isIsset('template-field-shadow-on');
						$options['shadow-left-right'] = $shadowLeftRight;
						$options['shadow-top-bottom'] = $shadowTopBottom;
						$options['template-shadow-color'] = SGRB_Input::get('template-shadow-color');
						$options['shadow-blur'] = $shadowBlur;
					}
				}
				$options['sgrb-google-search-on'] = SGRB_Input::isIsset('sgrb-google-search-on');
				$options['captcha-on'] = SGRB_Input::isIsset('captcha-on');
			}
			$options['tags'] = json_encode($tagsArray);
			if ($disableWPcomments) {
				$options['disable-wp-comments'] = 1;
			}
			// wooCommerce
			if ($disableWooComments) {
				$options['disable-woo-comments'] = 1;
			}
			if ($reviewType == SGRB_REVIEW_TYPE_WOO) {
				if ($wooReviewShowType == 'showByCategory') {
					$options['woo-category'] = $wooCategoryString;
					$options['woo-products'] = '';
				}
				else if ($wooReviewShowType == 'showByProduct') {
					$options['woo-products'] = $wooProductsString;
					$options['woo-category'] = '';
				}
			}
			// wooCommerce
			if ($postCategory && $tempOptions['name'] == 'post_review') {
				$options['post-category'] = $postCategory;
			}
			$options['required-title-checkbox'] = SGRB_Input::isIsset('required-title-checkbox');
			$options['required-email-checkbox'] = SGRB_Input::isIsset('required-email-checkbox');
			$options['required-login-checkbox'] = SGRB_Input::isIsset('required-login-checkbox');
			$options['hide-comment-form'] = SGRB_Input::isIsset('hide-comment-form');
			$options['auto-approve-checkbox'] = SGRB_Input::isIsset('auto-approve-checkbox');

			$options['user-detect-by'] = SGRB_Input::get('user-detect-by');

			$captchaText = SGRB_Input::getStripSlashed('captcha-text');
			$loggedInText = SGRB_Input::getStripSlashed('logged-in-text');
			//localization
			$options['success-comment-text'] = SGRB_Input::getStripSlashed('success-comment-text');
			$options['total-rating-text'] = SGRB_Input::getStripSlashed('total-rating-text');
			$options['add-review-text'] = SGRB_Input::getStripSlashed('add-review-text');
			$options['edit-review-text'] = SGRB_Input::getStripSlashed('edit-review-text');
			$options['name-text'] = SGRB_Input::getStripSlashed('name-text');
			$options['name-placeholder-text'] = SGRB_Input::getStripSlashed('name-placeholder-text');
			$options['email-text'] = SGRB_Input::getStripSlashed('email-text');
			$options['email-placeholder-text'] = SGRB_Input::getStripSlashed('email-placeholder-text');
			$options['title-text'] = SGRB_Input::getStripSlashed('title-text');
			$options['title-placeholder-text'] = SGRB_Input::getStripSlashed('title-placeholder-text');
			$options['comment-text'] = SGRB_Input::getStripSlashed('comment-text');
			$options['comment-placeholder-text'] = SGRB_Input::getStripSlashed('comment-placeholder-text');
			$options['load-more-text'] = SGRB_Input::getStripSlashed('load-more-text');
			$options['no-more-text'] = SGRB_Input::getStripSlashed('no-more-text');
			$options['post-button-text'] = SGRB_Input::getStripSlashed('post-button-text');
			$options['no-category-text'] = SGRB_Input::getStripSlashed('no-category-text');
			$options['no-name-text'] = SGRB_Input::getStripSlashed('no-name-text');
			$options['no-email-text'] = SGRB_Input::getStripSlashed('no-email-text');
			$options['no-title-text'] = SGRB_Input::getStripSlashed('no-title-text');
			$options['no-comment-text'] = SGRB_Input::getStripSlashed('no-comment-text');
			$options['show-all-text'] = SGRB_Input::getStripSlashed('show-all-text');
			$options['hide-text'] = SGRB_Input::getStripSlashed('hide-text');
			$options['comment-by-text'] = SGRB_Input::getStripSlashed('comment-by-text');
			$options['review-type'] = SGRB_Input::getStripSlashed('review-type');

			$options['total-rate'] = SGRB_Input::get('totalRate');
			$options['show-comments'] = SGRB_Input::get('showComments');
			$options['total-rate-background-color'] = SGRB_Input::get('total-rate-background-color');
			$options['rate-type'] = SGRB_Input::get('rate-type');
			$options['template-font'] = SGRB_Input::get('fontSelectbox');
			$options['template-background-color'] = SGRB_Input::get('template-background-color');
			$options['template-text-color'] = SGRB_Input::get('template-text-color');
			$options['transparent-background'] = SGRB_Input::get('transparent-background');
			$options['wrapper-width'] = (int)SGRB_Input::get('wrapper-width');
			$options['wrapper-width-px'] = SGRB_Input::get('wrapper-width-px');

			if ($isSimpleReview) {
				$options['simple-review-template'] = $simpleReviewTemplate;
				$options['simple-review-template-type'] = $simpleReviewTemplateType;
			}
			$options['skin-color'] = SGRB_Input::get('skin-color');
			$options['rate-text-color'] = SGRB_Input::get('rate-text-color');

			// check if rating type change, if true,change comments' rates
			if ($isUpdate && @$currentRateType != SGRB_Input::get('rate-type')) {
				$this->changeRateType($currentRateType, SGRB_Input::get('rate-type'), $reviewId);
			}

			$options = json_encode($options);
			$review->setTitle(sanitize_text_field($title));
			$review->setType(sanitize_text_field($reviewType));
			$review->setTemplate_id(sanitize_text_field(@$result));//template id
			$review->setOptions(sanitize_text_field($options));

			if (!@$fields[0] && $reviewType == SGRB_REVIEW_TYPE_PRODUCT) {
				exit();
			}

			if (!empty($tagsArray)) {
				foreach ($tagsArray as $tags) {
					wp_create_tag($tags);
				}
			}

			$res = $review->save();

			if ($review->getId()) {
				$lastRevId = $review->getId();
			}
			else {
				if (!$res) return false;
				$lastRevId = $wpdb->insert_id;
			}

			if ($reviewType == SGRB_REVIEW_TYPE_WOO) {
				SGRB_Page_ReviewModel::finder()->deleteAll('review_id = %d', $lastRevId);
				if (!empty($wooProducts)) {
					foreach ($wooProducts as $wooProd => $val) {
						if ($val == 1) {
							$pageReview = new SGRB_Page_ReviewModel();
							$pageReview->setProduct_id(sanitize_text_field($wooProd));
							$pageReview->setReview_id(sanitize_text_field($lastRevId));
							$pageReview->save();
						}
					}
				}
				else if (!empty($wooCategory)) {
					for ($i = 0;$i < count($wooCategory);$i++) {
						$pageReview = new SGRB_Page_ReviewModel();
						$pageReview->setCategory_id(sanitize_text_field($wooCategory[$i]));
						$pageReview->setReview_id(sanitize_text_field($lastRevId));
						$pageReview->save();
					}
				}
			}

			if (!$isUpdate) {
				if ($reviewType == SGRB_REVIEW_TYPE_SIMPLE) {
					$categories = new SGRB_CategoryModel();
					$categories->setReview_id(sanitize_text_field($lastRevId));
					$categories->setName(sanitize_text_field($simpleFields));
					$categories->save();
				}
				else {
					for ($i=0;$i<count($fields);$i++) {
						if (!$fields[$i]) {
							continue;
						}
						$categories = new SGRB_CategoryModel();
						$categories->setReview_id(sanitize_text_field($lastRevId));
						$categories->setName(sanitize_text_field($fields[$i]));
						$categories->save();

					}
				}
			}

		}
		echo $lastRevId;
		exit();
	}

	public function changeRateType($currentRateType, $typeToChange, $reviewId)
	{
		$allCategoriesToEdit = array();
		$percentRange = 0;
		$maxRate = 0;
		$allCategoriesToEdit = SGRB_CategoryModel::finder()->findAll('review_id = %d', $reviewId);
		if ($currentRateType == SGRB_RATE_TYPE_STAR) {
			$percentRange = 0.5;//10%
		}
		else if ($currentRateType == SGRB_RATE_TYPE_PERCENT) {
			$percentRange = 10;//10%
		}
		else if ($currentRateType == SGRB_RATE_TYPE_POINT) {
			$percentRange = 1;//10%
		}

		if (!empty($allCategoriesToEdit)) {
			foreach ($allCategoriesToEdit as $category) {
				if (!$category) {
					continue;
				}
				$categoryId = $category->getId();
				$allRatesToEdit = SGRB_Comment_RatingModel::finder()->findAll('category_id = %d', $categoryId);
				if (!empty($allRatesToEdit)) {
					foreach ($allRatesToEdit as $rate) {
						$rateToEdit = $rate->getRate();
						$percent = ($rateToEdit / $percentRange) * 10;//get percent
						if ($typeToChange == SGRB_RATE_TYPE_STAR) {
							$maxRate = 5;
						}
						else if ($typeToChange == SGRB_RATE_TYPE_PERCENT) {
							$maxRate = 100;
						}
						else if ($typeToChange == SGRB_RATE_TYPE_POINT) {
							$maxRate = 10;
						}
						$editedRate = $maxRate * $percent / 100;

						$rate->setRate($editedRate);
						$rate->save();
					}
				}
			}
		}
	}

	public function stripslashesDeep($value)
	{
		if (is_array($value)) {
			$value = array_map(array($this, 'stripslashesDeep'), $value);
		}
		else {
			$value = stripslashes($value);
		}

		return $value;
	}

	public function edit()
	{
		global $wpdb;
		global $sgrb;

		if (SGRB_PRO_VERSION) {
			$sgrb->includeStyle('page/styles/general/bootstrap-formhelpers.min');
			$sgrb->includeScript('page/scripts/helpers/bootstrap-formhelpers.min');
		}
		$sgrb->includeScript('core/scripts/jquery.rateyo');
		$sgrb->includeScript('core/scripts/jquery.barrating');
		$sgrb->includeScript('core/scripts/jquery-ui.min');
		$sgrb->includeScript('core/scripts/jquery-ui-slider-pips.min');
		$sgrb->includeScript('page/scripts/helpers/sgReviewHelper');
		$sgrb->includeScript('page/scripts/helpers/sgTemplateHelper');
		$sgrb->includeScript('page/scripts/helpers/sgCommentHelper');
		$sgrb->includeScript('page/scripts/helpers/sgRateSkin');
		$sgrb->includeScript('page/scripts/helpers/sgMainHelper');
		$sgrb->includeScript('page/scripts/helpers/sgWizardSettings');
		$sgrb->includeScript('page/scripts/sgReview');
		$sgrb->includeScript('page/scripts/sgComment');
		$sgrb->includeScript('page/scripts/sgTemplate');
		$sgrb->includeScript('page/scripts/sgForm');
		$sgrb->includeScript('page/scripts/bootstrap.min');
		$sgrb->includeScript('core/scripts/main');
		$sgrb->includeScript('core/scripts/sgrbRequestHandler');
		$sgrb->includeStyle('core/styles/css/jquery.rateyo');
		$sgrb->includeStyle('core/styles/css/bars-1to10');
		$sgrb->includeStyle('core/styles/css/jquery-ui.min');
		$sgrb->includeStyle('core/styles/css/jquery-ui-slider-pips.min');
		$sgrb->includeStyle('page/styles/general/sg-box-cols');
		$sgrb->includeStyle('page/styles/bootstrap.min');
		$sgrb->includeStyle('page/styles/animate');
		$sgrb->includeStyle('page/styles/general');
		$sgrb->includeStyle('page/styles/font-awesome.min');
		$sgrb->includeStyle('page/styles/bootstrapTheme');
		$sgrb->includeStyle('page/styles/review/save');
		$sgrb->includeStyle('page/styles/general/sgrbWizardSettings');

		$sgrbId = 0;
		$sgrbDataArray = array();
		$tagsArray = array();
		$sgrbOptions = array();
		$fields = '';
		$tempName = '';
		$res = '';
		$simpleField = '';
		$ratings = array();
		$allTemplates = array();
		$termsArray = array();
		$productsArray = array();
		$categoriesArray = array();
		$allPageReviews = array();
		$matchesProducts = array();
		$matchesCategories = array();

		$allTerms = get_terms(array('get' => 'all'));
		$allProductsCount = get_posts(array(
			'post_type'		=> 'product',
			'numberposts'	=> -1
		));
		if (!empty($allProductsCount)) {
			$allProductsCount = count($allProductsCount);
		}
		if (!empty($allTerms)) {
			foreach ($allTerms as $term) {
				if (@$term->term_id) {
					if (get_term_meta($term->term_id)) {
						$termsArray['id'][] = $term->term_id;
						$termsArray['name'][] = $term->name;
					}
				}
			}
		}

		$allProducts = get_posts(array('post_type' => 'product','numberposts' => 5));
		if (!empty($allProducts)) {
			foreach ($allProducts as $product) {
				$productsArray['id'][] = $product->ID;
				$productsArray['name'][] = $product->post_title;
			}
		}

		$tempView = new SGRB_TemplateDesignView();
		$allTemplates = SGRB_TemplateDesignModel::finder()->findAllBySql("SELECT * from ".$tempView->getTablename()."  ORDER BY ".$tempView->getTablename().".sgrb_pro_version DESC");

		$sgrbId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
		$allPageReviews = SGRB_Page_ReviewModel::finder()->findAll();
		if (!empty($allPageReviews) && !empty($productsArray)) {
			for ($i=0;$i<count($allPageReviews);$i++) {
				for ($j=0;$j<count($productsArray['id']);$j++) {
					$catId = $allPageReviews[$i]->getCategory_id();
					$prodId = $allPageReviews[$i]->getProduct_id();
					$revId = $allPageReviews[$i]->getReview_id();
					if ($prodId) {
						if ($prodId == $productsArray['id'][$j] && $revId != $sgrbId) {
							$matchesProducts['id'][] = $prodId;
							if ($revId) {
								$matchReview = SGRB_ReviewModel::finder()->findByPk($revId);
								if ($matchReview) {
									$matchReviewTitle = $matchReview->getTitle();
									$matchesProducts['review'][] = $matchReviewTitle;
								}
							}
						}
					}
					if ($catId) {
						if ($catId == @$termsArray['id'][$j] && $revId != $sgrbId) {
							// to  add is used in some review text
							$matchesCategories['id'][] = $catId;
							if ($revId) {
								$matchReview = SGRB_ReviewModel::finder()->findByPk($revId);
								if ($matchReview) {
									$matchReviewTitle = $matchReview->getTitle();
									$matchesCategories['review'][] = $matchReviewTitle;
								}
							}
						}
					}
				}
			}
		}
		$sgrbRev = SGRB_ReviewModel::finder()->findByPk($sgrbId);
		$allCommentsUrl = $sgrb->adminUrl('Comment/index','id='.$sgrbId);
		$sgrbSaveUrl = $sgrb->adminUrl('Review/edit');
		//If edit
		if ($sgrbRev) {

			$sgrbDataArray = array();

			$fields = SGRB_CategoryModel::finder()->findAll('review_id = %d', $sgrbId);
			$sgrbOptions = $sgrbRev->getOptions();
			$sgrbOptions = json_decode($sgrbOptions, true);

			$tempId = $sgrbRev->getTemplate_id();

			if (!$tempId) {
				$template = new SGRB_TemplateModel();
			}
			else {
				$template = SGRB_TemplateModel::finder()->findByPk($tempId);
				if (!$template) {
					$template = new SGRB_TemplateModel();
					$tempName = 'full_width';
				}
				else {
					$tempName = $template->getName();
				}
			}
			if (!@$tempName) {
				if (@$sgrbOptions['review-type'] == SGRB_REVIEW_TYPE_POST) {
					$tempName = 'post_review';
					$res = '';
				}
				else if (@$sgrbOptions['review-type'] == SGRB_REVIEW_TYPE_WOO) {
					$tempName = 'woo_review';
					$res = '';
				}
			}
			else {
				$temp = new Template($tempName,$tempId);
				$res = $temp->adminRender();
			}

			$title = $sgrbRev->getTitle();
			$template = $sgrbRev->getTemplate_id();

			$options = $sgrbRev->getOptions();
			$options = json_decode($options, true);

			$sgrbDataArray = $options;
			$sgrbDataArray['title'] = $title;
			$reviewType = @$sgrbDataArray['review-type'];
			if ($reviewType == SGRB_REVIEW_TYPE_SIMPLE) {
				$simpleField = $fields;
				$fields = '';
			}
			if (@$sgrbDataArray['wooReviewShowType']) {
				if ($sgrbDataArray['wooReviewShowType'] == 'showByCategory') {
					if (@$sgrbDataArray['woo-category']) {
						$sgrbDataArray['woo-category'] = json_decode($sgrbDataArray['woo-category']);
					}
				}
			}
			if (@$sgrbOptions['review-type'] == SGRB_REVIEW_TYPE_POST) {
				$sgrbDataArray['template'] = 'post_review';
			}
			else if (@$sgrbOptions['review-type'] == SGRB_REVIEW_TYPE_WOO) {
				$sgrbDataArray['template'] = 'woo_review';
			}

			$tagsArray = json_decode(@$options['tags'], true);
			$sgrbDataArray['tags'] = @$tagsArray;
			//////////////
			if (@$sgrbDataArray['review-type'] == SGRB_REVIEW_TYPE_PRODUCT) {
				$selectedTemplate = SGRB_TemplateModel::finder()->findByPk($template);
				$sgrbDataArray['template'] = $selectedTemplate->getName();
			}
		}
		else {
			$sgrbRev = new SGRB_ReviewModel();
			$sgrbId = 0;
			$temp = new Template('full_width');
			$res = $temp->adminRender();
		}
		SGRB_AdminView::render('Review/edit', array(
			'sgrbDataArray'  => $sgrbDataArray,
			'sgrbSaveUrl'    => $sgrbSaveUrl,
			'sgrbRevId'      => $sgrbId,
			'sgrbRev' 		 => $sgrbRev,
			'fields' 		 => $fields,
			'simpleField' 	 => $simpleField,
			'ratings' 		 => $ratings,
			'allCommentsUrl' => $allCommentsUrl,
			'res' 			 => $res,
			'allTemplates' 	 => $allTemplates,
			'termsArray' 	 => $termsArray,
			'allProductsCount' 	 => $allProductsCount,
			'productsArray'  => $productsArray,
			'categoriesArray'  => $categoriesArray,
			'allPageReviews' => $allPageReviews,
			'matchesProducts'=> $matchesProducts,
			'matchesCategories'=> $matchesCategories
		));
	}

	public function ajaxWooProductLoad()
	{
		global $sgrb;
		global $wpdb;
		$allProductsString = '';
		$productsArray = array();
		$allPageReviews = array();
		$selectedProducts = array();
		SGRB_Input::setSource($_POST);
		$start = SGRB_Input::get('start');
		$reviewId = SGRB_Input::get('reviewId');
		$perPage = SGRB_Input::get('perPage');

		$allPageReviews = SGRB_Page_ReviewModel::finder()->findAll('review_id <> %d', $reviewId);

		if ($reviewId) {
			$review = SGRB_ReviewModel::finder()->findByPk($reviewId);
			if ($review) {
				$options = $review->getOptions();
				$options = json_decode($options, true);
				$selectedProducts = $options['woo-products'];
				$selectedProducts = json_decode($selectedProducts, true);

				foreach ($selectedProducts as $product => $value) {
					if ($value == 0) {
						unset($selectedProducts[$product]);
					}
				}
			}
		}

		$allProducts = get_posts(array(
			'post_type'		=> 'product',
			'numberposts'	=> $perPage,
			'offset'		=> $start
		));

		$matchProdArray = array();
		if (!empty($allPageReviews)) {
			for ($k=0;$k<count($allPageReviews);$k++) {
				$revId = $allPageReviews[$k]->getReview_id();
				if ($revId) {
					$review = SGRB_ReviewModel::finder()->findByPk($revId);
					if ($review) {
						$reviewName = $review->getTitle();
					}
				}
				$prodId = $allPageReviews[$k]->getProduct_id();
				$matchProdArray[$k]['id'] = $prodId;
				$matchProdArray[$k]['name'] = $reviewName;
			}
		}

		if (!$allProducts) {
			$allProducts = array();
		}
		for ($i=0;$i<count($allProducts);$i++) {
			$productsArray[$i]['matchProdId'] = '';
			$productsArray[$i]['matchReview'] = '';
			if (!$selectedProducts) {
				$productsArray[$i]['id'] = $allProducts[$i]->ID;
				$productsArray[$i]['name'] = $allProducts[$i]->post_title;
				$productsArray[$i]['checked'] = '';
				$productsArray[$i]['checkedClass'] = '';

				$selectedProducts = array();
				continue;
			}
			foreach ($selectedProducts as $key => $val) {
				$productsArray[$i]['id'] = $allProducts[$i]->ID;
				$productsArray[$i]['name'] = $allProducts[$i]->post_title;
				$productsArray[$i]['checked'] = '';
				$productsArray[$i]['checkedClass'] = 'sgrb-selected-products';
				if (@$selectedProducts[$productsArray[$i]['id']] == 1) {
					$productsArray[$i]['checked'] = ' checked';
					break;
				}
			}

			if (!empty($matchProdArray)) {
				$productsArray[$i]['matchProdId'] = '';
				$productsArray[$i]['matchReview'] = '';

				$matchProdArray = array();
				continue;
			}
			for ($k=0;$k<count($matchProdArray);$k++) {
				$productsArray[$i]['matchProdId'] = '';
				$productsArray[$i]['matchReview'] = '';
				if ($productsArray[$i]['id'] == $matchProdArray[$k]['id']) {
					$productsArray[$i]['matchProdId'] = ' disabled';
					$productsArray[$i]['checkedClass'] = '';
					$productsArray[$i]['matchReview'] = ' - <i class="sgrb-is-used">used in </i> '.$matchProdArray[$k]['name'].'<i class="sgrb-is-used"> review</i>';
					break;
				}
			}
		}
		die(json_encode($productsArray));
	}

	public function morePlugins()
	{
		global $sgrb;
		$sgrb->includeStyle('page/styles/review/save');
		$sgrb->includeStyle('page/styles/general/sg-box-cols');
		SGRB_AdminView::render('Review/morePlugins');
	}

	public function reviewSetting()
	{
		global $sgrb;
		$sgrb->includeScript('core/scripts/jquery.rateyo');
		$sgrb->includeScript('core/scripts/jquery.barrating');
		$sgrb->includeScript('core/scripts/jquery-ui.min');
		$sgrb->includeScript('core/scripts/jquery-ui-slider-pips.min');
		$sgrb->includeScript('page/scripts/helpers/sgReviewHelper');
		$sgrb->includeScript('page/scripts/helpers/sgTemplateHelper');
		$sgrb->includeScript('page/scripts/helpers/sgCommentHelper');
		$sgrb->includeScript('page/scripts/helpers/sgRateSkin');
		$sgrb->includeScript('page/scripts/helpers/sgMainHelper');
		$sgrb->includeScript('page/scripts/helpers/sgWizardSettings');
		$sgrb->includeScript('page/scripts/sgReview');
		$sgrb->includeScript('page/scripts/sgComment');
		$sgrb->includeScript('page/scripts/sgTemplate');
		$sgrb->includeScript('page/scripts/sgForm');
		$sgrb->includeScript('page/scripts/bootstrap.min');
		$sgrb->includeScript('core/scripts/main');
		$sgrb->includeScript('core/scripts/sgrbRequestHandler');
		$sgrb->includeStyle('core/styles/css/jquery.rateyo');
		$sgrb->includeStyle('core/styles/css/bars-1to10');
		$sgrb->includeStyle('core/styles/css/jquery-ui.min');
		$sgrb->includeStyle('core/styles/css/jquery-ui-slider-pips.min');
		$sgrb->includeStyle('page/styles/general/sg-box-cols');
		$sgrb->includeStyle('page/styles/bootstrap.min');
		$sgrb->includeStyle('page/styles/animate');
		$sgrb->includeStyle('page/styles/general');
		$sgrb->includeStyle('page/styles/font-awesome.min');
		$sgrb->includeStyle('page/styles/bootstrapTheme');
		$sgrb->includeStyle('page/styles/review/save');
		$sgrb->includeStyle('page/styles/general/sgrbWizardSettings');

		SGRB_AdminView::render('Review/reviewSetting');
	}

	public function ajaxSaveFreeTables()
	{
		global $sgrb;
		global $wpdb;
		$deleteTables = (int)@$_POST['saveFreeTables'];
		$result = false;
		if ($deleteTables) {
			update_option('SGRB_SAVE_TABLES', 'SGRB_SAVE_TABLES');
		}
		else {
			delete_option('SGRB_SAVE_TABLES');
		}
		die(1);
	}

	public function ajaxCloseBanner()
	{
		$result = delete_option(SG_REVIEW_BANNER);
		update_option(SG_NO_BANNER, SG_NO_BANNER);
		die($result);
	}

	// delete review
	public function ajaxDelete()
	{
		global $sgrb;
		SGRB_Input::setSource($_POST);
		$id = (int)SGRB_Input::get('id');
		$deletedReview = SGRB_ReviewModel::finder()->findByPk($id);
		SGRB_CategoryModel::finder()->deleteAll('review_id = %d', $id);
		SGRB_TemplateModel::finder()->deleteByPk($deletedReview->getTemplate_id());
		SGRB_CategoryModel::finder()->deleteAll('review_id = %d', $id);
		SGRB_CommentModel::finder()->deleteAll('review_id = %d', $id);
		SGRB_Rate_LogModel::finder()->deleteAll('review_id = %d', $id);
		SGRB_Page_ReviewModel::finder()->deleteAll('review_id = %d', $id);
		SGRB_ReviewModel::finder()->deleteByPk($id);
		exit();
	}

	// delete review field
	public function ajaxDeleteField()
	{
		global $sgrb;
		SGRB_Input::setSource($_POST);
		$id = (int)SGRB_Input::get('id');
		SGRB_CategoryModel::finder()->deleteByPk($id);
		SGRB_Comment_RatingModel::finder()->deleteAll('category_id = %d', $id);
		exit();
	}

	public function ajaxCloneReview()
	{
		global $sgrb;
		global $wpdb;
		$lastRevId = 0;
		$newTemplateId = 0;
		$categoriesToClone = array();
		SGRB_Input::setSource($_POST);
		$id = (int)SGRB_Input::get('id');
		$reviewToClone = SGRB_ReviewModel::finder()->findByPk($id);
		if (!$reviewToClone) {
			exit($lastRevId);
		}
		$reviewType = $reviewToClone->getType();
		$reviewTitle = $reviewToClone->getTitle();
		$reviewTemplateId = $reviewToClone->getTemplate_id();
		$reviewOptions = $reviewToClone->getOptions();

		if ($reviewTemplateId) {
			$templateToClone = SGRB_TemplateModel::finder()->findByPk($reviewTemplateId);
			if (!$templateToClone) {
				exit($lastRevId);
			}
			$templateName = $templateToClone->getName();
			$templateOptions = $templateToClone->getOptions();

			$newTemplate = new SGRB_TemplateModel();
			$newTemplate->setName($templateName);
			$newTemplate->setOptions($templateOptions);
			$newTemplate->save();

			$newTemplateId = $wpdb->insert_id;
		}

		$newReview = new SGRB_ReviewModel();
		$newReview->setType($reviewType);
		$newReview->setTitle($reviewTitle);
		$newReview->setTemplate_id($newTemplateId);
		$newReview->setOptions($reviewOptions);
		$newReview->save();

		$lastRevId = $wpdb->insert_id;

		$categoriesToClone = SGRB_CategoryModel::finder()->findAll('review_id = %d', $id);
		if (empty($categoriesToClone)) {
			exit();
		}

		foreach ($categoriesToClone as $category) {
			$categoriesToCloneName = $category->getName();
			$newCategory = new SGRB_CategoryModel();
			$newCategory->setReview_id($lastRevId);
			$newCategory->setName($categoriesToCloneName);
			$newCategory->save();
		}

		exit($lastRevId);

	}

	public function createWidgetReviewHtml ($review)
	{
		$arr = array();
		$html = '';
		if ($review) {
			$title = $review->getTitle();
			$templateId = $review->getTemplate_id();
			$options = $review->getOptions();
			$template = SGRB_TemplateModel::finder()->findByPk($templateId);
			$templateOptions = $template->getOptions();
			$templateOptions = json_decode($templateOptions, true);

			$arr['title'] = $title;
			$arr['id'] = $review->getId();
			$arr['template-id'] = $templateId;
			$arr['options'] = json_decode($options,true);
			$arr['template'] = $template;
			$arr['widget-image'] = $templateOptions['images'][0];
			$sgrbDataArray[] = $arr;
			$html .= $this->createReviewHtml($sgrbDataArray, true);
		}

		return $html;
	}

	public function createPostReviewHtml ($review)
	{
		global $post;

		$currentPost = get_post();
		if (!is_object($currentPost)) {
			return false;
		}
		$postMetaValue = get_post_meta($currentPost->ID);

		if (empty($postMetaValue)) {
			return false;
		}
		if (!@$postMetaValue['post_review'] || @empty($postMetaValue['post_review'])) {
			return false;
		}
		else {
			$postReviewId = $postMetaValue['post_review'][0];

			if ($postReviewId != $review->getId()) {
				return false;
			}
		}
		$arr = array();
		$title = $review->getTitle();
		$templateId = $review->getTemplate_id();
		$options = $review->getOptions();
		$template = SGRB_TemplateModel::finder()->findByPk($templateId);

		$arr['title'] = $title;
		$arr['id'] = $review->getId();
		$arr['template-id'] = $templateId;
		$arr['options'] = json_decode($options,true);
		$arr['template'] = $template;
		$sgrbDataArray[] = $arr;

		$html = $this->createReviewHtml($sgrbDataArray);
		return $html;
	}

	// wooCommerce
	public function createWooReviewHtml ($review)
	{
		$arr                = array();
		$title              = $review->getTitle();
		$templateId         = $review->getTemplate_id();
		$options            = $review->getOptions();
		$template           = SGRB_TemplateModel::finder()->findByPk($templateId);
		$arr['title']       = $title;
		$arr['id']          = $review->getId();
		$arr['template-id'] = $templateId;
		$arr['options']     = json_decode($options,true);
		$arr['template']    = $template;
		$sgrbDataArray[]    = $arr;
		$html               = $this->createReviewHtml($sgrbDataArray);
		return $html;
	}

	// create all review html
	private function createReviewHtml($review, $isWidget=false)
	{
		global $sgrb;
		$userLoggedIn = false;
		if (SGRB_PRO_VERSION) {
			$sgrb->includeStyle('page/styles/general/bootstrap-formhelpers.min');
			$sgrb->includeScript('page/scripts/helpers/bootstrap-formhelpers.min');
		}
		$sgrb->includeStyle('core/styles/css/main-front');
		$sgrb->includeStyle('page/styles/general/sg-box-cols');

		$sgrb->includeScript('page/scripts/helpers/sgRateSkin');
		$sgrb->includeScript('page/scripts/helpers/sgWizardSettings');
		$sgrb->includeScript('page/scripts/helpers/sgReviewHelper');
		$sgrb->includeScript('page/scripts/helpers/sgTemplateHelper');
		$sgrb->includeScript('page/scripts/helpers/sgCommentHelper');
		$sgrb->includeScript('page/scripts/helpers/sgMainHelper');
		$sgrb->includeScript('page/scripts/sgReview');
		$sgrb->includeScript('page/scripts/sgComment');
		$sgrb->includeScript('page/scripts/sgTemplate');
		$sgrb->includeScript('page/scripts/sgForm');
		$sgrb->includeScript('core/scripts/main');
		$sgrb->includeScript('core/scripts/sgrbRequestHandler');

		$this->setIsWidgetReview($isWidget);
		$isWidget = $this->getIsWidgetReview();
		if (!$review) {
			return false;
		}
		$reviewMainOptions = $review[0]['options'];
		SGRB_Input::setSource($reviewMainOptions);
		$reviewMainRateSkinType = SGRB_Input::get('rate-type');

		if ($reviewMainRateSkinType == SGRB_RATE_TYPE_STAR) {
			//including scripts/styles for current skin
			$sgrb->includeScript('core/scripts/jquery.rateyo');
			$sgrb->includeStyle('core/styles/css/jquery.rateyo');
		}
		else if ($reviewMainRateSkinType == SGRB_RATE_TYPE_PERCENT) {
			//including scripts/styles for current skin
			$sgrb->includeScript('core/scripts/jquery-ui.min');
			$sgrb->includeScript('core/scripts/jquery-ui-slider-pips.min');
			$sgrb->includeStyle('core/styles/css/jquery-ui.min');
			$sgrb->includeStyle('core/styles/css/jquery-ui-slider-pips.min');
		}
		else if ($reviewMainRateSkinType == SGRB_RATE_TYPE_POINT) {
			//including scripts/styles for current skin
			$sgrb->includeScript('core/scripts/jquery.barrating');
			$sgrb->includeStyle('core/styles/css/bars-1to10');
		}

		$html = '';
		$commentForm = '';
		$categoriesToRate = '';

		$mainTemplate = $review[0]['template'];
		if (!$mainTemplate && (SGRB_Input::get('review-type') != SGRB_REVIEW_TYPE_WOO)) {
			return false;
		}

		$templateStyles = '';
		$templateBackgroundColor = SGRB_Input::get('template-background-color');
		$templateTextColor = SGRB_Input::get('template-text-color');
		$templateFont = SGRB_Input::get('template-font');

		if ($templateBackgroundColor) {
			$templateStyles .= 'background-color: '.$templateBackgroundColor.';';
		}
		if ($templateTextColor) {
			$templateStyles .= 'color: '.$templateTextColor.';';
		}
		if ($templateFont) {
			$templateStyles .= 'font-family: '.$templateFont.';';
		}

		$templateStyles = $templateStyles ? 'style="'.$templateStyles.'"' : '';
		// get template part
		if (!SGRB_Input::get('review-type')) {
			$template = new Template($mainTemplate->getName(),$mainTemplate->getId());
			$result = $template->render();
			$result = '<div class="sgrb-template-part-wrapper" '.$templateStyles.'>'.$result.'</div>';
		}
		else {
			$result = $this->getTemplatePartHtml(@$reviewMainOptions['review-type'], $mainTemplate, $reviewMainOptions, @$review[0]['widget-image']);
		}

		$categories = SGRB_CategoryModel::finder()->findAll('review_id = %d', $review[0]['id']);
		$ratesArray = array();
		$eachRatesArray = array();

		$totalRateBackgroundColor = SGRB_Input::get('total-rate-background-color', '#fbfbfb');
		$transparentBackground = SGRB_Input::isIsset('transparent-background');
		$rateTextColor = SGRB_Input::get('rate-text-color', '#4c4c4c');

		//if isset transparent,set background-color 'trasparent',else selected color or default
		$totalRateBackgroundColor = $transparentBackground ? 'transparent' : $totalRateBackgroundColor;

		//localization
		$reviewAllOptions = $this->getAllReviewOptionsAssocArray($review[0]['id']);
		$addReviewText = $reviewAllOptions['add-review-text'];

		$postId = '';
		$sgrbWidgetWrapperStyles = '';
		$sgrbWidgetWrapper = 'sgrb-common-wrapper';
		//$closeHtml = '';
		$eachCategoryHide = '';//hide categories in total rate box for widget
		$isPostReview = false;
		$currentPost = get_post();
		$currentPostId = $currentPost->ID;

		$totalRate = $this->getTotalRate($review[0]['id']);//if no second parameter return totalRate
		$eachRatesArray = $this->getTotalRate($review[0]['id'], 1);//if has second parameter return eachRate

		$eachCategoryRate = false;
		$sgrbEachEditableRate = array();
		$userCookieDataArray = array();
		$currentCommentId = 0;
		$userCookieData = 0;
		$currentComment = new SGRB_CommentModel();
		$UserComTitle = '';
		$UserComName = '';
		$UserComEmail = '';
		$UserComComment = '';
		$hideForm = false;
		//$detectUserByIp = @$reviewMainOptions['user-detect-by'];

		$currentCommentId = $this->userDetection($review[0]['id']);

		//if review is commented(has comment id)
		if ($currentCommentId) {
			$hideForm = false;
			$currentComment = SGRB_CommentModel::finder()->findByPk($currentCommentId);
			if (!$currentComment) {
				$currentComment = new SGRB_CommentModel();
				$sgrbEachEditableRate = array();
			}
			else {
				$UserComTitle = $currentComment->getTitle();
				$UserComName = $currentComment->getName();
				$UserComEmail = $currentComment->getEmail();
				$UserComComment = $currentComment->getComment();
				$sgrbEachEditableRate = SGRB_Comment_RatingModel::finder()->findAll('comment_id = %d', $currentCommentId);
				$addReviewText = $reviewAllOptions['edit-review-text'];
			}
		}
		foreach ($categories as $category) {
			if ($isPostReview) {
				$approvedComments = SGRB_CommentModel::finder()->findAll('review_id = %d && approved = %d && post_id = %d', array($review[0]['id'], 1, $postId));
			}
			else {
				$approvedComments = SGRB_CommentModel::finder()->findAll('review_id = %d && approved = %d', array($review[0]['id'], 1));
			}

			$commentsArray = $approvedComments;
		}

		if (@$reviewMainOptions['wrapper-width']) {
			$wrapperWidth = 'width: ';
			$wrapperWidth .= $reviewMainOptions['wrapper-width'];
			if (@$reviewMainOptions['wrapper-width-px']) {
				$wrapperWidth .= 'px';
			}
			else {
				$wrapperWidth .= '%';
			}
		}
		else {
			$wrapperWidth = '';
		}

		$sgrbSearchCommentsCount = '';

		// template options first column
		$templateStyles = '';

		// template shadow options
		$templateShadow = '';

		if (SGRB_Input::isIsset('template-field-shadow-on')) {
			$templateShadowLeftRight = SGRB_Input::get('shadow-left-right');
			$templateShadowTopBottom = SGRB_Input::get('shadow-top-bottom');
			$templateShadowBlur = SGRB_Input::get('shadow-blur');
			$templateShadowColor = SGRB_Input::get('template-shadow-color');
			if ($templateShadowLeftRight && $templateShadowTopBottom) {
				$templateShadow .= 'box-shadow: '.$templateShadowLeftRight.'px '.$templateShadowTopBottom.'px ';
				$templateShadow .= $templateShadowBlur ? $templateShadowBlur.'px ' : '';
				$templateShadow .= $templateShadowColor ? $templateShadowColor : '';
			}
		}

		$html .= '<input class="sgrb-template-shadow-style" type="hidden" value="'.$templateShadow.'">';
		$html .= '<div class="sgrb-template-custom-style" '.$templateStyles.'>';

		$totalRateSymbol = '';
		if (SGRB_Input::get('rate-type') == SGRB_RATE_TYPE_STAR) {
			$totalRateSymbol = '<img style="vertical-align: sub;" src="'.$sgrb->app_url.'assets/page/img/star_simbol.png" width="30px">';
			if ($isWidget) {
				$totalRateSymbol = '&#9733';
			}
			$bestRating = 5;
		}
		else if (SGRB_Input::get('rate-type') == SGRB_RATE_TYPE_PERCENT) {
			$totalRateSymbol = '%';
			$bestRating = 100;
		}
		else if (SGRB_Input::get('rate-type') == SGRB_RATE_TYPE_POINT) {
			$totalRateSymbol = '&#8226';
			$bestRating = 10;
		}

		// show google search
		$googleSearchResult = '';
		$googleSearchON = SGRB_Input::isIsset('sgrb-google-search-on');
		if (SGRB_PRO_VERSION && $googleSearchON) {
			$googleSearchResult = $this->prepareGoogleSearchSchemaWithData($totalRate, $sgrbSearchCommentsCount, $review[0]['title'], $bestRating);
		}

		// $sgrbFakeId, set fake,but unique review id,
		// even if page displays the same review repeatedly
		$sgrbFakeId = mt_rand();
		$html .= $googleSearchResult;
		$html .= $result;

		$hiddenValuesToUse = $this->includeHiddenValuesToUse($sgrbFakeId, $review[0]['id'], $reviewMainOptions, $totalRateBackgroundColor);
		$html .= $hiddenValuesToUse;

		$totalRateHtml = $this->createTotalRateHtml($review[0]['id']);
		$approvedCommentsHtml = $this->prepareCommentsWrapper($review[0]['id']);

		//create category field html with its rate skin,by type (star,percent,point)
		$showTotalRate = SGRB_Input::isIsset('total-rate');
		$categoryHtml = '';
		if ($showTotalRate) {
			$html .= $totalRateHtml;
		}
		$commentForm .= $this->getCommentFormHtml(@$review[0]['id'], $currentCommentId, $sgrbFakeId);
		$mainWrapperReviewId = 'sgrb-review-'.@$review[0]['id'];
		$widgetTotalRatings = '';
		if ($isWidget) {
			$sgrbWidgetWrapper = 'sgrb-widget-wrapper';
			$mainWrapperReviewId = 'sgrb-widget-review-'.@$review[0]['id'];
			$widgetTotalRatings = '<div class="sgrb-widget-review-ratings-wrapper" style="background-color:'.esc_attr(@$totalRateBackgroundColor).';color: '.@$rateTextColor.';"></div>';
		}
		return '<form class="sgrb-user-rate-js-form"><div id="'.$sgrbFakeId.'" data-sgrb-id="'.$sgrbFakeId.'" class="'.$sgrbWidgetWrapper.'" style="'.$wrapperWidth.'">'.$html.'</div>'.$approvedCommentsHtml.$commentForm.'</div></form>';
	}

	// create new comment and rate, calls in front
	public function ajaxUserRate()
	{
		global $sgrb;
		global $wpdb;
		$ratedFields = array();
		$proComment = array();
		$cookieValueArray = array();
		$cookieValue = '';
		$title = '';
		$comment = '';
		SGRB_Input::setSource($_POST);
		$ratedFields['fields'] = SGRB_Input::get('field');
		$ratedFields['rates'] = SGRB_Input::get('rate');
		$reviewId = (int)SGRB_Input::get('reviewId');

		$salt = 'SGRB';
		if (SGRB_Input::isIsset('captcha-on')) {
			$captcha = SGRB_Input::get('addCaptcha-'.$reviewId);
			if ((!$captcha) || (strtoupper($captcha.$salt) != (SGRB_Input::get('captchaCode').$salt))) {
				echo false;
				exit();
			}
		}

		$post = SGRB_Input::get('addPostId');
		// User edit his comment
		$currentUserCommentId = SGRB_Input::get('current-user-comment-id');
		$detectUserByPc = SGRB_Input::get('detect-user-by-ip');

		////////////////////////
		$currentReview = SGRB_ReviewModel::finder()->findByPk($reviewId);
		$reviewOptions = $currentReview->getOptions();
		$options = json_decode($reviewOptions,true);

		$adminEmail = $options['notify'];
		$isRequiredTitle = $options['required-title-checkbox'];
		$isRequiredEmail = $options['required-email-checkbox'];
		$autoApprove = $options['auto-approve-checkbox'];
		if (!$autoApprove) {
			$autoApprove = 0;
		}

		$reviewTitle = $currentReview->getTitle();
		$name = SGRB_Input::getStripSlashed('addName');
		$mainEmail = SGRB_Input::get('addEmail');
		if ($mainEmail) {
			$email = filter_var($mainEmail, FILTER_VALIDATE_EMAIL);
		}
		$title = SGRB_Input::getStripSlashed('addTitle');
		$comment = SGRB_Input::getStripSlashed('addComment');

		if (count($_POST)) {
			$cookieValue = self::getClientIpAddress();
			for ($i=0;$i<count($ratedFields['fields']);$i++) {
				if (!$ratedFields['rates'][$i]) {
					$commonRate = false;
					echo $commonRate;
					return;
				}
			}
			$mainComment = new SGRB_CommentModel();
			// if user edit his review don't create new CommentModel
			if ($currentUserCommentId) {
				$mainComment = SGRB_CommentModel::finder()->findByPk($currentUserCommentId);
				$autoApprove = $mainComment->getApproved();
			}

			/////////////////////////
			$time = current_time('mysql');
			if (!$time) {
				@date_default_timezone_set(get_option('timezone_string'));
				$time = date('Y-m-d-h-m-s');
			}
			$mainComment->setCdate(sanitize_text_field($time));
			$mainComment->setReview_id(sanitize_text_field($reviewId));
			$mainComment->setPost_id(sanitize_text_field($post));
			$mainComment->setApproved($autoApprove);
			$mainComment->setName(sanitize_text_field($name));
			$mainComment->setEmail(sanitize_text_field($email));
			$mainComment->setTitle(sanitize_text_field($title));
			$mainComment->setComment(sanitize_text_field($comment));

			$commentRes = $mainComment->save();

			if ($mainComment->getId()) {
				$lastComId = $mainComment->getId();
			}
			else {
				if (!$commentRes) return false;
				$lastComId = $wpdb->insert_id;
			}
			// if admin selects to notify about new comment
			if ($adminEmail) {
				$currentUser = wp_get_current_user();
				$currentUserName = $currentUser->user_nicename;
				$subject = 'Review Builder Wordpress plugin.';
				$blogName = get_option('blogname');
				$editUrl = $sgrb->adminUrl('Comment/index').'sgrb_allComms&id='.$reviewId;
				$content = 'Hi '.ucfirst($currentUserName).'! Your '.ucfirst($reviewTitle).' review created in Wordpress,  '.$blogName.' blog, has been commented.'."\r\n";
				$message = $content."\r\n".'Follow this link '.$editUrl.' to edit it.';

				$headers  = 'MIME-Version: 1.0'."\r\n";
				$headers .= 'Content-type: text/html; charset=UTF-8'."\r\n"; //set UTF-8

				wp_mail($adminEmail, $subject, $message, $headers);
			}

			$rate = 0;

			// ($ratedFields['fields']) & ($ratedFields['rates']) have equal count;
			if ($currentUserCommentId) {
				$i = 0;
				$mainRates = SGRB_Comment_RatingModel::finder()->findAll('comment_id = %d', $currentUserCommentId);
				foreach ($mainRates as $mainRate) {
					$mainRate->setComment_id(sanitize_text_field($currentUserCommentId));
					$mainRate->setRate(sanitize_text_field($ratedFields['rates'][$i]));
					$mainRate->setCategory_id(sanitize_text_field($ratedFields['fields'][$i]));
					$mainRate->save();
					$rate += $ratedFields['rates'][$i];
					$commonRate = $rate / count($ratedFields['rates']);
					if ($commonRate !== 10) {
						$commonRate = str_replace('0','',$commonRate);
					}
					$i++;
				}
			}
			else {
				for ($i=0;$i<count($ratedFields['fields']);$i++) {
					$mainRate = new SGRB_Comment_RatingModel();
					$mainRate->setComment_id(sanitize_text_field($lastComId));
					$mainRate->setRate(sanitize_text_field($ratedFields['rates'][$i]));
					$mainRate->setCategory_id(sanitize_text_field($ratedFields['fields'][$i]));
					$mainRate->save();
					$rate += $ratedFields['rates'][$i];
					$commonRate = $rate / count($ratedFields['rates']);
					if ($commonRate !== 10) {
						$commonRate = str_replace('0','',$commonRate);
					}
				}
			}

			if ($detectUserByPc) {
				$cookieValueArray['review-id'] = $reviewId;
				$cookieValueArray['comment-id'] = $lastComId;
				$cookieValueArray['post-id'] = $post;
				$cookieValueString = json_encode($cookieValueArray);

				$cookieSaved = setcookie('sgrb-user-detect', stripcslashes($cookieValueString), time()+365*24*60*60, '/');
				if ($cookieSaved) {
					echo $lastComId;
					exit();
				}
			}
			// if new insert, save the rater
			$newUser = new SGRB_Rate_LogModel();
			$allRateLogs = SGRB_Rate_LogModel::finder()->findAll();
			foreach ($allRateLogs as $singleRateLog) {
				if ($singleRateLog->getReview_id() == $reviewId) {
					if ($singleRateLog->getComment_id() == $lastComId) {
						$rateLogId = $singleRateLog->getId();
						$newUser = SGRB_Rate_LogModel::finder()->findByPk($rateLogId);
					}
				}
			}
			$newUser->setReview_id(sanitize_text_field($reviewId));
			if ($post) {
				$newUser->setPost_id(sanitize_text_field($post));
			}
			$newUser->setComment_id(sanitize_text_field($lastComId));
			$newUser->setIp(sanitize_text_field($cookieValue));
			$newUser->save();

			echo $lastComId;
			exit();
		}
	}

	public function ajaxSelectTemplate ()
	{
		global $sgrb;
		SGRB_Input::setSource($_POST);
		$tempName = SGRB_Input::get('template');
		$mainTemplate = new Template($tempName);
		$res = $mainTemplate->adminRender();
		echo $res;
		exit();
	}

	public function ajaxLazyLoading ()
	{
		global $sgrb;
		SGRB_Input::setSource($_POST);

		$approvedComments = SGRB_CommentController::getCommentsByReviewId(SGRB_Input::get('review'));
		$allComments = SGRB_CommentController::getCommentsByReviewId(SGRB_Input::get('review'),1 );

		$review = SGRB_ReviewModel::finder()->findByPk(SGRB_Input::get('review'));
		if (!$review) {
			return false;
		}
		$reviewOptions = $review->getOptions();

		$comments = array();
		foreach ($approvedComments as $appComment) {
			$comment = array();
			$commentId = $appComment->getId();
			$rates = SGRB_Comment_RatingModel::finder()->findAll('comment_id = %d', array($commentId));
			foreach ($rates as $rate) {
				$comment['rates'][] = $rate->getRate();
			}
			$comment['title'] = esc_attr($appComment->getTitle());
			$comment['comment'] = esc_attr($appComment->getComment());
			$comment['name'] = esc_attr($appComment->getName());
			$comment['date'] = esc_attr($appComment->getCdate());
			$comment['id'] = esc_attr($appComment->getId());
			$comment['count'] = esc_attr(count($allComments));

			$comments[] = $comment;
		}
		die(json_encode($comments));
	}

	public function getPostReview ($post,$review)
	{
		global $wpdb;
		$sql = $wpdb->prepare("SELECT meta_value FROM ". $wpdb->prefix ."postmeta WHERE post_id = %d AND meta_key = %s",$post,$review);
		$row = $wpdb->get_row($sql);
		$id = 0;
		if($row) {
			$id =  (int)@$row->meta_value;
		}
		return $id;
	}

	public static function getClientIpAddress()
	{
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			$ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			$ip = $_SERVER['REMOTE_ADDR'];
		}
		return sanitize_text_field($ip);
	}

	public function getSimpleTemplate($type, $value = '')
	{
		$templateHtml = '';
		if ($type != 'empty') {
			if ($type == 'text') {
				if ($this->hasContentShortcode($value)) {
					$value = do_shortcode($value);
				}
				$value = '<div class="sg-col-12"><div class="sgrb-simple-template-text">'.$value.'</div></div>';
			}
			else if ($type == 'image') {
				$value = '<div class="sg-col-12"><div class="sgrb-simple-template-image"><div class="sgrb-image-review" style="background-image:url('.$value.')"></div></div></div>';
			}

			$templateHtml .= '<div class="sgrb-front-simple-template-wrapper"><div class="sg-row">'.$value;
			$templateHtml .= '</div></div>';
		}
		return $templateHtml;
	}

	public function getTemplatePartHtml($reviewType, $mainTemplate, $reviewMainOptions, $widgetImage = '')
	{
		$result = '';
		$templateStyles = '';
		SGRB_Input::setSource($reviewMainOptions);

		$isWidget = $this->getIsWidgetReview();
		$simpleReviewTemplateType  = SGRB_Input::get('simple-review-template-type');
		$simpleReviewTemplateValue = SGRB_Input::get('simple-review-template');
		$templateBackgroundColor   = SGRB_Input::get('template-background-color');
		$templateTextColor         = SGRB_Input::get('template-text-color');
		$templateFont              = SGRB_Input::get('template-font');

		if ($templateBackgroundColor) {
			$templateStyles .= 'background-color: '.$templateBackgroundColor.';';
		}
		if ($templateTextColor) {
			$templateStyles .= 'color: '.$templateTextColor.';';
		}
		if ($templateFont) {
			$templateStyles .= 'font-family: '.$templateFont.';';
		}

		$templateStyles = $templateStyles ? 'style="'.$templateStyles.'"' : '';

		if (!$reviewType) {
			return '';
		}
		if ($reviewType == SGRB_REVIEW_TYPE_PRODUCT) {
			$template = new Template($mainTemplate->getName(),$mainTemplate->getId());
			$result = $template->render();
		}
		else if ($reviewType == SGRB_REVIEW_TYPE_SIMPLE) {
			$result = $this->getSimpleTemplate($simpleReviewTemplateType, $simpleReviewTemplateValue);
		}
		else if ($reviewType == SGRB_REVIEW_TYPE_WOO || $reviewType == SGRB_REVIEW_TYPE_POST) {
			$result = '';
		}
		$currentPost = get_post();
		$currentPostType = $currentPost->post_type;
		if (is_singular('post') && !is_page() && SGRB_PRO_VERSION && (SGRB_Input::get('review-type') == SGRB_REVIEW_TYPE_POST) || (SGRB_Input::get('review-type') == SGRB_REVIEW_TYPE_WOO) || $currentPostType == 'product') {
			$result = '<div class="sg-template-wrapper"></div>';
		}
		else if ($isWidget) {
			$result = '<div class="sg-template-wrapper"><img src="'.$widgetImage.'" width="280" height="210"></div>';
			$templateStyles = '';
		}

		$result = '<div class="sgrb-template-part-wrapper" '.$templateStyles.'>'.$result.'</div>';
		return $result;
	}

	public function createTotalRateHtml($reviewId)
	{
		$skinHtml = '';
		$params            = self::getAllReviewOptionsAssocArray($reviewId);
		$isWidgetReview    = $this->getIsWidgetReview();
		$sgrbWidgetTooltip = '';
		if (empty($params)) {
			return '';
		}
		$categories = $this->getReviewCategories($reviewId);
		if (!$categories) {
			return '';
		}
		if ($isWidgetReview) {
			$sgrbWidgetTooltip = '-widget';
		}
		$totalRateBackgroundColor = $params['total-rate-background-color'];
		$transparentBackground    = $params['transparent-background'];
		$rateTextColor            = $params['rate-text-color'];
		$totalText                = $params['total-rating-text'];
		$showTotalRate            = $params['total-rate'];
		$rateSkinType             = $params['rate-type'];
		$isAutoApprove            = $params['auto-approve-checkbox'];

		$totalRateSymbol          = $this->getRatingSkinType($params['rate-type']);
		$tooltipHtml              = $this->getTooltipHtml($reviewId);
		$eachCategoryRate         = $this->getTotalRate($reviewId);//total rate
		$eachRatesArray           = $this->getTotalRate($reviewId, 1);

		if (!$showTotalRate) {
			return '';
		}
		if ($transparentBackground) {
			$totalRateBackgroundColor = $transparentBackground;
		}
		$totalRateHtml = '<div class="sgrb-total-rate-wrapper" style="background-color:'.esc_attr($totalRateBackgroundColor).';color: '.$rateTextColor.';">
								<input class="sgrb-rate-skin-type" type="hidden" value="'.$rateSkinType.'">
								<input class="sgrb-is-auto-approve" type="hidden" value="'.$isAutoApprove.'">
								<div class="sgrb-total-rate-title">
									<div class="sgrb-total-rate-title-text"><span>'.$totalText.'</span></div>
								</div>
								<div class="sgrb-total-rate-count">'.$tooltipHtml.'
									<div class="sgrb-total-rate-count-text sgrb-show-tooltip'.@$sgrbWidgetTooltip.'" title=""><span>'.esc_attr(@$eachCategoryRate).' '.$totalRateSymbol.'</span></div>
								</div>';
		if ($isWidgetReview) {
			//if widget,show only total rate (without categories)
			return $totalRateHtml.'</div>';
		}
		foreach ($categories as $category) {
			if (strlen($category->getName()) > 31) {
				$text = substr($category->getName(), 0, 28).'...';
			}
			else {
				$text = $category->getName();
			}
			$totalRateHtml .= '<div class="sgrb-row-category">
					<div class="sgrb-row-category-name"><i>'.esc_attr($text).'</i></div>';
			if (!empty($eachRatesArray)) {
				$eCatId = $category->getId();
				$eCatId = $eachRatesArray[$eCatId];
				$eCatId = $eCatId[0];
				if (!empty($eCatId)) {
					if (count($categories)>1) {
						$eachCategoryRate = round($eCatId->getAverage(), 1);
					}
				}
			}
			if ($rateSkinType == SGRB_RATE_TYPE_STAR) {
				$totalRateHtml .= '<div class="sgrb-rate-each-skin-wrapper"><input class="sgrb-each-category-total" name="" type="hidden" value="'.$eachCategoryRate.'"><div class="rateYoTotal"></div><div class="sgrb-counter"></div></div></div>';
			}
			else if ($rateSkinType == SGRB_RATE_TYPE_PERCENT) {
				$totalRateHtml .= '<div class="sgrb-each-percent-skin-wrapper"><input class="sgrb-each-category-total" name="" type="hidden" value="'.$eachCategoryRate.'"><div class="circles-slider"></div></div></div>';
			}
			else if ($rateSkinType == SGRB_RATE_TYPE_POINT) {
				$skinHtml .= '<div class="sgrb-rate-each-skin-wrapper">
							<input class="sgrb-each-category-total" type="hidden" value="'.$eachCategoryRate.'">
							<select class="sgrb-point">
								  <option value="1">1</option>
								  <option value="2">2</option>
								  <option value="3">3</option>
								  <option value="4">4</option>
								  <option value="5">5</option>
								  <option value="6">6</option>
								  <option value="7">7</option>
								  <option value="8">8</option>
								  <option value="9">9</option>
								  <option value="10">10</option>
							</select></div></div>';
			}
		}
		return $totalRateHtml.$skinHtml.'</div>';
	}

	public function prepareGoogleSearchSchemaWithData($totalRate = '', $sgrbSearchCommentsCount = '', $reviewTitle = '', $bestRating = 0)
	{
		$googleSearchResult = '';
		$googleSearchResult .= '<div itemscope="" itemtype="http://schema.org/AggregateRating">
									<span style="display:none;" itemprop="itemreviewed">'.$reviewTitle.'</span>
									<meta content="'.$totalRate.'" itemprop="ratingValue">
									<meta content="'.$sgrbSearchCommentsCount.'" itemprop="ratingCount">
									<meta content="'.$sgrbSearchCommentsCount.'" itemprop="reviewCount">
									<meta content="'.$bestRating.'" itemprop="bestRating">
									<meta content="1" itemprop="worstRating"></div>';
		return $googleSearchResult;
	}

	public function includeHiddenValuesToUse($sgrbFakeId, $reviewId, $reviewMainOptions, $backgroundColor)
	{
		global $sgrb;
		$html = '';
		SGRB_Input::setSource($reviewMainOptions);
		$clientIpAddress = self::getClientIpAddress();
		$requiredTitle   = SGRB_Input::get('required-title-checkbox');
		$requiredEmail   = SGRB_Input::get('required-email-checkbox');
		$skinColor       = SGRB_Input::get('skin-color');
		$templateFont    = SGRB_Input::get('template-font');
		$rateType        = SGRB_Input::get('rate-type');
		$textColor       = SGRB_Input::get('rate-text-color', '#4c4c4c');

		$html .= '<input value="'.$sgrbFakeId.'" type="hidden" class="sgrb-reviewFakeId" name="reviewFakeId">';
		$html .= '<input value="'.esc_attr(@$reviewId).'" type="hidden" class="sgrb-reviewId" name="reviewId">';

		$html .= '<input value="'.esc_attr($clientIpAddress).'" type="hidden" class="sgrb-cookie">';
		$html .= '<input value="'.SGRB_PRO_VERSION.'" type="hidden" class="sgrb-is-pro">';
		$html .= '<input value="'.$sgrb->app_url.'assets/page/img/avatar.png" type="hidden" class="sgrb-avatar-url">';
		$html .= '<input value="'.$requiredTitle.'" type="hidden" class="sgrb-requiredTitle">';
		$html .= '<input value="'.$requiredEmail.'" type="hidden" class="sgrb-requiredEmail">';

		$html .= '<input class="sgrb-skin-color" type="hidden" value="'.esc_attr($skinColor).'">';
		$html .= '<input class="sgrb-current-font" type="hidden" value="'.esc_attr($templateFont).'">';
		$html .= '<input class="sgrb-rating-type" type="hidden" value="'.esc_attr($rateType).'">';
		$html .= '<input class="sgrb-rate-text-color" type="hidden" value="'.esc_attr($textColor).'">';
		$html .= '<input class="sgrb-rate-background-color" type="hidden" value="'.esc_attr($backgroundColor).'">';

		return $html;
	}

	public function hasContentShortcode($content) {
		global $shortcode_tags;

		preg_match_all( '@\[([^<>&/\[\]\x00-\x20=]++)@', $content, $matches );
		$tagnames = array_intersect( array_keys( $shortcode_tags ), $matches[1] );

		/* If tagnames is empty it's mean content does not have shortcode */
		if (empty($tagnames)) {
			return false;
		}
		return true;
	}

	public function getReviewOptionsByPk($review = false, $index = '') {
		if (!$review instanceof SGRB_ReviewModel) {
			$review = SGRB_ReviewModel::finder()->findByPk($review);
		}
		if (!$review || !$index) {
			return '';
		}
		$optionValueToReturn = '';

		$options = $review->getOptions();
		$options = json_decode($options, true);

		if (isset($options[$index])) {
			$optionValueToReturn = $options[$index];
		}

		return $optionValueToReturn;
	}

	public static function getAllReviewOptionsAssocArray($review = false) {
		$options = array();
		if (!$review instanceof SGRB_ReviewModel) {
			$review = SGRB_ReviewModel::finder()->findByPk($review);
		}
		if (!$review) {
			return '';
		}

		$options = $review->getOptions();
		$options = json_decode($options, true);

		if (!@$options['total-rate-background-color']) {
			$options['total-rate-background-color'] = '#fbfbfb';
		}
		if (!@$options['rate-text-color']) {
			$options['rate-text-color'] = '#4c4c4c';
		}

		return $options;
	}

	public function getCommentFormHtml($reviewId, $currentCommentId = 0, $sgrbFakeId) {

		$eachCategoryRate = false;
		$sgrbEachEditableRate = array();

		$html = '';
		$titleRequiredAsterisk = '';
		$emailRequiredAsterisk = '';
		$sgrvNotApprovedMessage = '';
		$isWidget = $this->getIsWidgetReview();
		$formOptions = self::getAllReviewOptionsAssocArray($reviewId);
		$totalRate = $this->getTotalRate($reviewId);
		$eachRatesArray = $this->getTotalRate($reviewId, 1);
		$commentBoxThemeOptions = get_option('sgrb-comment-box-theme');
		$fieldAsterisk = '<i class="sgrb-comment-form-asterisk">*</i>';
		$userLoggedIn = $formOptions['required-login-checkbox'];
		$hideCommentForm = @$formOptions['hide-comment-form'];
		$addReviewText = @$formOptions['add-review-text'];
		$editReviewText = @$formOptions['edit-review-text'];
		if ($formOptions['transparent-background']) {
			$formOptions['total-rate-background-color'] = 'transparent';
		}
		if ($currentCommentId) {
			$sgrbEachEditableRate = SGRB_Comment_RatingModel::finder()->findAll('comment_id = %d', $currentCommentId);
			$addReviewText = $editReviewText;
		}
		$categoryHtml = $this->getRateSkinToRate($reviewId, $eachRatesArray, $eachCategoryRate, $totalRate, $sgrbEachEditableRate, $currentCommentId);
		$user = wp_get_current_user();
		if (@$formOptions['required-title-checkbox']) {
			$titleRequiredAsterisk = $fieldAsterisk;
		}
		if (@$formOptions['required-email-checkbox']) {
			$emailRequiredAsterisk = $fieldAsterisk;
		}

		$commentData = SGRB_CommentController::getFrontCommentData($currentCommentId);
		$postId = self::getCurrentPostId();
		$captchaHtml = $this->getCaptchaHtml($reviewId);

		$html = '<div class="sgrb-user-comment-wrapper" style="background-color: '.@$formOptions['total-rate-background-color'].';color: '.@$formOptions['rate-text-color'].';">
							<div class="sgrb-hide-show-wrapper">
								<div id="sgrb-review-form-title" class="sgrb-front-comment-rows">
									<span class="sgrb-comment-title">'.$addReviewText.'</span>
								</div>
								<div class="sgrb-notice-rates"><span class="sgrb-notice-rates-text"></span></div>';
		$html .= '<div class="sgrb-show-hide-comment-form">'.$categoryHtml;
		if ($hideCommentForm || $isWidget) {
			$html = '<input type="hidden" class="sgrb-captcha-on" name="captcha-on" value="'.@$formOptions['captcha-on'].'">
					<input type="hidden" name="current-user-comment-id" value="'.$commentData['id'].'">
					<input type="hidden" class="detect-user-by-ip" name="detect-user-by-ip" value="'.$formOptions['user-detect-by'].'">
					<input type="hidden" class="sgrb-thank-text" value="'.@$formOptions['success-comment-text'].'">
					<input type="hidden" class="sgrb-no-rate-text" value="'.@$formOptions['no-category-text'].'">
					<input type="hidden" class="sgrb-no-name-text" value="'.@$formOptions['no-name-text'].'">
					<input type="hidden" class="sgrb-no-email-text" value="'.@$formOptions['no-email-text'].'">
					<input type="hidden" class="sgrb-no-title-text" value="'.@$formOptions['no-title-text'].'">
					<input type="hidden" class="sgrb-no-comment-text" value="'.@$formOptions['no-comment-text'].'">
					<input type="hidden" class="sgrb-comment-by-text" value="'.@$formOptions['comment-by-text'].'">
					<input type="hidden" class="sgrb-no-captcha-text" value="'.@$formOptions['no-captcha-text'].'">
					<textarea style="display:none" class="sgrb-comment-box-theme-options">'.@$commentBoxThemeOptions.'</textarea>';
			return $html;
		}
		if ($userLoggedIn) {
			if (!$user->exists()) {
				$html .= '<input type="hidden" class="sgrb-captcha-on" name="captcha-on" value="'.@$formOptions['captcha-on'].'">
					<input type="hidden" name="current-user-comment-id" value="'.$commentData['id'].'">
					<input type="hidden" class="detect-user-by-ip" name="detect-user-by-ip" value="'.$formOptions['user-detect-by'].'">
					<input type="hidden" class="sgrb-thank-text" value="'.@$formOptions['success-comment-text'].'">
					<input type="hidden" class="sgrb-no-rate-text" value="'.@$formOptions['no-category-text'].'">
					<input type="hidden" class="sgrb-no-name-text" value="'.@$formOptions['no-name-text'].'">
					<input type="hidden" class="sgrb-no-email-text" value="'.@$formOptions['no-email-text'].'">
					<input type="hidden" class="sgrb-no-title-text" value="'.@$formOptions['no-title-text'].'">
					<input type="hidden" class="sgrb-no-comment-text" value="'.@$formOptions['no-comment-text'].'">
					<input type="hidden" class="sgrb-comment-by-text" value="'.@$formOptions['comment-by-text'].'">
					<input type="hidden" class="sgrb-no-captcha-text" value="'.@$formOptions['no-captcha-text'].'">
					<textarea style="display:none" class="sgrb-comment-box-theme-options">'.@$commentBoxThemeOptions.'</textarea>';
				return $html;
			}
		}
		if (!@$commentData['approved'] && $currentCommentId) {
			$html .= '<span class="sgrb-not-approved-message">Your comment has not been approved yet</span>';
		}

		$html .= '<div class="sgrb-front-comment-rows">
					<span class="sgrb-comment-title">'.@$formOptions['name-text'].' </span>'.$fieldAsterisk.'
					<span class="sgrb-each-field-notice">
						<input class="sgrb-add-fname" name="addName" type="text" value="'.$commentData['name'].'" placeholder="'.@$formOptions['name-placeholder-text'].'" autocomplete="off">
						<i></i>
					</span>
				</div>
				<div class="sgrb-front-comment-rows">
					<span class="sgrb-comment-title">'.@$formOptions['email-text'].' </span>'.$emailRequiredAsterisk.'
					<span class="sgrb-each-field-notice">
						<input class="sgrb-add-email" name="addEmail" type="email" value="'.$commentData['email'].'" placeholder="'.@$formOptions['email-placeholder-text'].'" autocomplete="off">
						<i></i>
					</span>
				</div>
				<div class="sgrb-front-comment-rows">
					<span class="sgrb-comment-title">'.@$formOptions['title-text'].' </span>'.$titleRequiredAsterisk.'
					<span class="sgrb-each-field-notice">
						<input class="sgrb-add-title" name="addTitle" type="text" value="'.$commentData['title'].'" placeholder="'.@$formOptions['title-placeholder-text'].'" autocomplete="off">
						<i></i>
					</span>
				</div>
				<div class="sgrb-front-comment-rows">
					<span class="sgrb-comment-title">'.@$formOptions['comment-text'].' </span>'.$fieldAsterisk.'
					<textarea class="sgrb-add-comment" name="addComment" placeholder="'.@$formOptions['comment-placeholder-text'].'" autocomplete="off">'.@$commentData['comment'].'</textarea><i></i>'.@$captchaHtml.'
				</div>';

		$html .= '<input name="addPostId" type="hidden" value="'.@$postId.'">
				<div class="sgrb-post-comment-button">
					<input type="hidden" class="sgrb-captcha-on" name="captcha-on" value="'.@$formOptions['captcha-on'].'">
					<input type="hidden" name="current-user-comment-id" value="'.$commentData['id'].'">
					<input type="hidden" class="detect-user-by-ip" name="detect-user-by-ip" value="'.$formOptions['user-detect-by'].'">
					<input type="hidden" class="sgrb-thank-text" value="'.@$formOptions['success-comment-text'].'">
					<input type="hidden" class="sgrb-no-rate-text" value="'.@$formOptions['no-category-text'].'">
					<input type="hidden" class="sgrb-no-name-text" value="'.@$formOptions['no-name-text'].'">
					<input type="hidden" class="sgrb-no-email-text" value="'.@$formOptions['no-email-text'].'">
					<input type="hidden" class="sgrb-no-title-text" value="'.@$formOptions['no-title-text'].'">
					<input type="hidden" class="sgrb-no-comment-text" value="'.@$formOptions['no-comment-text'].'">
					<input type="hidden" class="sgrb-comment-by-text" value="'.@$formOptions['comment-by-text'].'">
					<input type="hidden" class="sgrb-no-captcha-text" value="'.@$formOptions['no-captcha-text'].'">
					<textarea style="display:none" class="sgrb-comment-box-theme-options">'.@$commentBoxThemeOptions.'</textarea>
					<input data-sgrb-id="'.$sgrbFakeId.'" type="button" value="'.@$formOptions['post-button-text'].'" onclick="SGReview.prototype.ajaxUserRate('.@$reviewId.','.'0'.','.$sgrbFakeId.')" class="sgrb-user-comment-submit" style="background-color: '.$formOptions['total-rate-background-color'].';color: '.$formOptions['rate-text-color'].';">
				</div>';
		$html .= '</div>
					</div>
				</div>';
		//$html .= '<div class="sgrb-show-hide-comment-form" style="display:block"></div>';

		return $html;
	}

	public function getCaptchaHtml($reviewId) {
		global $sgrb;
		$captchaHtml = '';
		$formOptions = self::getAllReviewOptionsAssocArray($reviewId);
		if (SGRB_PRO_VERSION && $formOptions['captcha-on']/* && !$isWidget*/) {
			$sgrb->includeScript('core/scripts/jquery.plugin');
			$sgrb->includeScript('core/scripts/jquery.realperson');
			$sgrb->includeStyle('core/styles/css/jquery.realperson');
			$captchaText = 'Change image';
			if (@$formOptions['captcha-text']) {
				$captchaText = @$formOptions['captcha-text'];
			}
			$captchaHtml = '<div class="sgrb-captcha-wrapper">
							<div class="sgrb-captcha-notice"><span class="sgrb-captcha-notice-text"></span></div>
								<input id="sgrb-captcha-'.@$reviewId.'" type="text" name="addCaptcha-'.@$reviewId.'" autocomplete="off">
								<input type="hidden" class="sgrb-captcha-text" value="'.$captchaText.'">
							</div>';
		}
		return $captchaHtml;
	}

	public function getRateSkinToRate($reviewId, $eachRatesArray = array(), $eachCategoryRate, $totalRate, $sgrbEachEditableRate, $currentCommentId) {
		$sgRate = 0;
		$index = 0;
		$eCatId = 0;
		$eachPercentRate = 0;
		$categoryHtml = '';
		$skinHtml = '';
		$categories = $this->getReviewCategories($reviewId);
		$commentBoxThemeOptions = get_option('sgrb-comment-box-theme');;
		$notLoggedInText = $this->getReviewOptionsByPk($reviewId, 'logged-in-text');
		$rateSkinType = $this->getReviewOptionsByPk($reviewId, 'rate-type');
		$requireLoginToRate = $this->getReviewOptionsByPk($reviewId, 'required-login-checkbox');
		$user = wp_get_current_user();
		if ($requireLoginToRate) {
			if (!$user->exists()) {
				return $notLoggedInText.'<textarea style="display:none" class="sgrb-comment-box-theme-options">'.@$commentBoxThemeOptions.'</textarea>';
			}
		}
		foreach ($categories as $category) {
			if (strlen($category->getName()) > 31) {
				$text = substr($category->getName(), 0, 28).'...';
			}
			else {
				$text = $category->getName();
			}
			if (($rateSkinType == SGRB_RATE_TYPE_PERCENT || $rateSkinType == SGRB_RATE_TYPE_POINT) && $currentCommentId) {

				$eCatId = $category->getId();
				$eCatId = @$eachRatesArray[$eCatId];
				$eCatId = @$eCatId[0];
				if ($eCatId) {
					$eachPercentRate = round($eCatId->getAverage(), 1);
				}
			}

			$categoryHtml .= '<input class="sgrb-fieldId" name="field[]" type="hidden" value="'.esc_attr($category->getId()).'">';
			$categoryHtml .= '<div class="sgrb-row-category">
					<input class="sgrb-each-rate-skin" name="rate[]" type="hidden" value="'.$eachPercentRate.'">
					<div class="sgrb-row-category-name"><i>'.esc_attr($text).'</i></div>';
			if ($eachCategoryRate && !empty($eachRatesArray)) {
				$eachCategoryRate = $totalRate;
				$eCatId = $category->getId();
				$eCatId = $eachRatesArray[$eCatId];
				$eCatId = $eCatId[0];
				if (!empty($eCatId)) {
					if (count($categories)>1) {
						$eachCategoryRate = round($eCatId->getAverage(), 1);
					}
				}
			}
			if (!@empty($sgrbEachEditableRate)) {
				if ($currentCommentId && (@$sgrbEachEditableRate[$index]->getCategory_id() == $category->getId())) {
					$sgRate = $sgrbEachEditableRate[$index]->getRate();
				}
			}
			if ($rateSkinType == SGRB_RATE_TYPE_STAR) {
				$categoryHtml .= '<div class="sgrb-rate-each-skin-wrapper sgrb-rate-clicked-count"><input class="sgrb-each-category-total" name="" type="hidden" value="'.$eachCategoryRate.'"><input name="sgRate" type="hidden" value="'.$sgRate.'"><div class="rateYo"></div><div class="sgrb-counter"></div></div></div>';
			}
			else if ($rateSkinType == SGRB_RATE_TYPE_PERCENT) {
				$categoryHtml .= '<div class="sgrb-each-percent-skin-wrapper sgrb-rate-clicked-count"><input class="sgrb-each-category-total" name="" type="hidden" value="'.$eachCategoryRate.'"><div class="circles-slider sgrb-circle-total"></div><input name="sgRate" type="hidden" value="'.$sgRate.'"></div></div>';
			}
			else if ($rateSkinType == SGRB_RATE_TYPE_POINT) {
				$skinHtml = '<div class="sgrb-rate-each-skin-wrapper sgrb-rate-clicked-count"><input class="sgrb-each-category-total" name="" type="hidden" value="'.$eachCategoryRate.'"><input name="sgRate" type="hidden" value="'.$sgRate.'">
					<select class="sgrb-point-user-edit">
						  <option value="1">1</option>
						  <option value="2">2</option>
						  <option value="3">3</option>
						  <option value="4">4</option>
						  <option value="5">5</option>
						  <option value="6">6</option>
						  <option value="7">7</option>
						  <option value="8">8</option>
						  <option value="9">9</option>
						  <option value="10">10</option>
					</select></div></div>';
			}
			$categoryHtml .= $skinHtml;
			$index++;
		}
		return $categoryHtml;
	}

	public function getReviewCategories($reviewId) {
		$categories = array();
		if ($reviewId) {
			$categories = SGRB_CategoryModel::finder()->findAll('review_id = %d', $reviewId);
		}
		return $categories;
	}

	public static function getCurrentPostId() {
		$postId = 0;
		if (is_singular('post') && !is_page()) {
			$currentPost = get_post();
			$postId = get_post()->ID;
		}
		return $postId;
	}

	public function getTotalRate($reviewId, $returnTotal = 0) {
		global $sgrb;
		$ratesArray = array();
		$eachRatesArray = array();
		$categories = $this->getReviewCategories($reviewId);
		$formOptions = self::getAllReviewOptionsAssocArray($reviewId);
		$commentRatingModel = new SGRB_Comment_RatingModel();
		$commentTablename = $sgrb->tablename($commentRatingModel::TABLE);

		$countRates = 0;
		foreach ($categories as $category) {
			$approvedComments = SGRB_CommentModel::getAllComments($reviewId, 1);
			if (empty($approvedComments)) {
				break;
			}
			$sgrbIndex = 0;
			foreach ($approvedComments as $approvedComment) {
				$sgrbIndex++;
				$rates = SGRB_Comment_RatingModel::finder()->findAll('category_id = %d && comment_id = %d', array($category->getId(), $approvedComment->getId()));
				$eachRates = SGRB_Comment_RatingModel::finder()->findBySql('SELECT AVG(rate) AS average, category_id FROM '.$commentTablename.' WHERE category_id='.$category->getId().' GROUP BY category_id');
				$ratesArray[] = $rates;
				$eachRatesArray[$category->getId()][] = $eachRates;
			}
		}
		$countRates = 0;
		$rating = 0;

		foreach ($ratesArray as $rate) {
			$countRates += 1;
			if (!empty($rate)) {
				$rating += $rate[0]->getRate();
			}
		}
		if (!$countRates) {
			$totalRate = 0;
		}
		else {
			$totalRate = round($rating / $countRates);
		}

		if ($returnTotal) {
			return $eachRatesArray;
		}
		return $totalRate;
	}

	public function getRatingSkinType($type) {
		global $sgrb;
		$starRateSymbolSize = '30px';
		$isWidget = $this->getIsWidgetReview();
		if ($isWidget) {
			$starRateSymbolSize = '20px';
		}
		$rateSymbol = '<img style="vertical-align: sub;" src="'.$sgrb->app_url.'assets/page/img/star_simbol.png" width="'.$starRateSymbolSize.'">';
		if ($type == SGRB_RATE_TYPE_STAR) {
			$rateSymbol = '<img style="vertical-align: sub;" src="'.$sgrb->app_url.'assets/page/img/star_simbol.png" width="'.$starRateSymbolSize.'">';
		}
		else if ($type == SGRB_RATE_TYPE_PERCENT) {
			$rateSymbol = '%';
		}
		else if ($type == SGRB_RATE_TYPE_POINT) {
			$rateSymbol = '&#8226';
		}
		return $rateSymbol;
	}

	public function getTooltipHtml($reviewId) {
		$commentsArray = SGRB_CommentModel::getAllComments($reviewId, 1);
		$sgrbWidgetTooltip = '';
		$mainCommentsCount = count($commentsArray);
		if (empty($commentsArray) || !$commentsArray) {// no rates
			$allApprovedComments = '';
			$mainCommentsCount = '<div class="sgrb-tooltip'.$sgrbWidgetTooltip.'"><span class="sgrb-tooltip'.$sgrbWidgetTooltip.'-text">no rates</span></div>';
		}
		else {
			if ($mainCommentsCount == 1) {// 1 rate
				$sgrbSearchCommentsCount = $mainCommentsCount;
				$mainCommentsCount = '<div class="sgrb-tooltip'.$sgrbWidgetTooltip.'"><span class="sgrb-tooltip'.$sgrbWidgetTooltip.'-text">'.$mainCommentsCount.' rate</span></div>';
			}
			else {// more then 1 rates
				$sgrbSearchCommentsCount = $mainCommentsCount;
				$mainCommentsCount = '<div class="sgrb-tooltip'.$sgrbWidgetTooltip.'"><span class="sgrb-tooltip'.$sgrbWidgetTooltip.'-text">'.$mainCommentsCount.' rates</span></div>';
			}

		}
		return $mainCommentsCount;
	}

	public function userDetection($reviewId) {
		$detectUserByPc = $this->getReviewOptionsByPk($reviewId, 'user-detect-by');
		$postId = self::getCurrentPostId();
		if ($detectUserByPc) {//if true => detect by PC else by default(IP)
			return $this->detectByPC($reviewId, $postId);
		}
		else {
			return $this->detectByIP($reviewId, $postId);
		}
	}

	public function detectByPC($reviewId, $postId = 0) {
		$currentCommentId = 0;
		if (isset($_COOKIE['sgrb-user-detect'])) {
			$userCookieDataString = stripslashes($_COOKIE['sgrb-user-detect']);
			$userCookieDataArray = json_decode($userCookieDataString, true);
			$currentCookieReviewId = $userCookieDataArray['review-id'];
			$currentCookiePostId = $userCookieDataArray['post-id'];
			$currentCommentId = $userCookieDataArray['comment-id'];
			if ($postId) {
				if ($postId == $currentCookiePostId) {
					if ($reviewId == $currentCookieReviewId) {
						$currentCommentId = $userCookieDataArray['comment-id'];
					}
				}
			}
			else {
				if ($reviewId == $currentCookieReviewId) {
					$currentCommentId = $userCookieDataArray['comment-id'];
				}
			}
			if (!$currentCommentId) {
				$hideForm = true;
			}
		}
		return $currentCommentId;
	}

	public function detectByIP($reviewId, $postId = 0) {
		$currentCommentId = 0;
		if ($postId) {
			$userIp = SGRB_Rate_LogModel::finder()->find('review_id = %d && post_id = %d && ip = %s', array($reviewId, $postId, self::getClientIpAddress()));
		}
		else {
			$userIp = SGRB_Rate_LogModel::finder()->find('review_id = %d && ip = %s', array($reviewId, self::getClientIpAddress()));
		}
		if ($userIp) {
			$currentCommentId = $userIp->getComment_id();
			$useripPostId = $userIp->getPost_id();
			if (!$currentCommentId) {
				$hideForm = true;
			}
		}
		return $currentCommentId;
	}

	public function setIsWidgetReview($isWidget) {
		$this->isWidgetReview = $isWidget;
	}

	public function getIsWidgetReview() {
		return $this->isWidgetReview;
	}

	public function prepareCommentsWrapper($reviewId) {
		global $sgrb;
		$isWidget = $this->getIsWidgetReview();
		$reviewMainOptions = $this->getAllReviewOptionsAssocArray($reviewId);
		if ($reviewMainOptions['review-type'] == SGRB_REVIEW_TYPE_POST) {
			$postId = SGRB_ReviewController::getCurrentPostId();
			$commentsArray = SGRB_CommentModel::finder()->findAll('review_id = %d && approved = %d && post_id = %d ', array($reviewId, 1, $postId));//SGRB_CommentController::getCommentsByReviewId($reviewId);
		}
		else {
			$commentsArray = SGRB_CommentModel::finder()->findAll('review_id = %d && approved = %d ', array($reviewId, 1));//SGRB_CommentController::getCommentsByReviewId($reviewId);
		}

		$postId = self::getCurrentPostId();
		if (!@$reviewMainOptions['show-comments']) {
			return '';
		}
		if (!$reviewMainOptions['total-rate-background-color']) {
			$reviewMainOptions['total-rate-background-color'] = '#fbfbfb';
		}
		if ($reviewMainOptions['transparent-background']) {
			$reviewMainOptions['total-rate-background-color'] = 'transparent';
		}
		if (!$reviewMainOptions['rate-text-color']) {
			$reviewMainOptions['rate-text-color'] = '#4c4c4c';
		}
		$allApprovedComments = '<div class="sgrb-approved-comments-to-show">
								<input class="sgrb-no-more-text" type="hidden" value="'.$reviewMainOptions['no-more-text'].'">
								<input class="sgrb-show-all-text" type="hidden" value="'.$reviewMainOptions['show-all-text'].'">
								<input class="sgrb-hide-text" type="hidden" value="'.$reviewMainOptions['hide-text'].'">
								<input class="sgrb-comments-count" type="hidden" value="'.@$reviewMainOptions['comments-count-to-show'].'">
								<input class="sgrb-comments-count-load" type="hidden" value="'.@$reviewMainOptions['comments-count-to-load'].'">';
		$allApprovedComments .= '</div>';
		if (empty($commentsArray)) {
			return $allApprovedComments;
		}
		if (!@$reviewMainOptions['comments-count-to-show']) {
			@$reviewMainOptions['comments-count-to-show'] = SGRB_COMMENTS_PER_PAGE;
		}
		if (!@$reviewMainOptions['comments-count-to-load']) {
			!@$reviewMainOptions['comments-count-to-load'] = 3;
		}

		if (!empty($commentsArray) && @$reviewMainOptions['show-comments'] && !$isWidget) {
			$tmp = ceil(count($commentsArray)/SGRB_COMMENTS_PER_PAGE);
			$allApprovedComments .= '<div class="sgrb-pagination" style="background-color:'.esc_attr($reviewMainOptions['total-rate-background-color']).';color: '.$reviewMainOptions['rate-text-color'].';">';
			$allApprovedComments .= '<input class="sgrb-comments-per-page" type="hidden" value="'.@$reviewMainOptions['comments-count-to-show'].'">';
			$perPage = @$reviewMainOptions['comments-count-to-show'];
			$allApprovedComments .= '<input class="sgrb-page-count" type="hidden" value="'.$tmp.'">';
			$allApprovedComments .= '<input class="sgrb-comments-count" type="hidden" value="'.@$reviewMainOptions['comments-count-to-show'].'">';
			$allApprovedComments .= '<input class="sgrb-comments-count-load" type="hidden" value="'.@$reviewMainOptions['comments-count-to-load'].'">';
			$allApprovedComments .= '<input class="sgrb-post-id" type="hidden" value="'.$postId.'">';
			$allApprovedComments .= '<i class="sgrb-loading-spinner"><img src='.$sgrb->app_url.'assets/page/img/comment-loader.gif></i>';
			$allApprovedComments .= '<a class="sgrb-comment-load" href="javascript:void(0)">'.$reviewMainOptions['load-more-text'].'</a>';
			$allApprovedComments .= '</div>';
		}
		return $allApprovedComments;
	}

	public function ajaxReloadReviewFrontView() {
		global $sgrb;
		$html = array();
		$reviewId = $_POST['reviewId'];
		$sgrbFakeId = $_POST['sgrbFakeId'];
		$commentId = $_POST['commentId'];
		$totalRateHtml = $this->createTotalRateHtml($reviewId);
		$commentFormHtml = $this->getCommentFormHtml($reviewId, $commentId, $sgrbFakeId);
		$html['totalRateHtml'] = $totalRateHtml;
		$html['commentFormHtml'] = $commentFormHtml;
		die(json_encode($html));
	}


}
