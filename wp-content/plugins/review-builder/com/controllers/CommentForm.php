<?php
global $sgrb;
$sgrb->includeController('Controller');
$sgrb->includeView('Admin');
$sgrb->includeView('Review');
$sgrb->includeView('CommentForm');
$sgrb->includeModel('CommentForm');
$sgrb->includeModel('Review');
$sgrb->includeModel('Comment');
$sgrb->includeModel('Template');
$sgrb->includeModel('Category');
$sgrb->includeModel('Comment_Rating');
$sgrb->includeModel('Rate_Log');
$sgrb->includeLib('Input');

class SGRB_CommentFormController extends SGRB_Controller
{

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
		$sgrb->includeScript('core/scripts/sgrbRequestHandler');
		$sgrb->includeStyle('page/styles/bootstrapTheme');
		$createNewUrl = $sgrb->adminUrl('CommentForm/save');

		SGRB_AdminView::render('CommentForm/index', array(
			'createNewUrl' => $createNewUrl,
			'form' => $form
		));
	}

	public function edit()
	{
		global $sgrb;

		$sgrb->includeScript('page/scripts/helpers/sgReviewHelper');
		$sgrb->includeScript('core/scripts/jquery.rateyo');
		$sgrb->includeScript('page/scripts/helpers/sgTemplateHelper');
		$sgrb->includeScript('page/scripts/helpers/sgCommentHelper');
		$sgrb->includeScript('page/scripts/helpers/sgRateSkin');
		$sgrb->includeScript('page/scripts/helpers/sgMainHelper');
		$sgrb->includeScript('page/scripts/helpers/sgWizardSettings');
		$sgrb->includeScript('page/scripts/sgReview');
		$sgrb->includeScript('page/scripts/sgComment');
		$sgrb->includeScript('page/scripts/sgTemplate');
		$sgrb->includeScript('page/scripts/sgForm');
		$sgrb->includeScript('core/scripts/main');
		$sgrb->includeScript('core/scripts/sgrbRequestHandler');
		$sgrb->includeStyle('page/styles/commentForm/save');
		$sgrb->includeStyle('page/styles/general/sg-box-cols');

		$sgrbSaveUrl = $sgrb->adminUrl('CommentForm/edit');
		$options = array();

		$options = get_option('sgrb-comment-box-theme');
		if (empty($options)) {
			$options = '{"comment-box-theme":"1","comment-box-rate-show":"true","comment-box-rate-alignment":"right","comment-box-title-show":"true","comment-box-title-alignment":"left","comment-box-avatar":null,"comment-box-text":"true","comment-box-avatar-and-text-alignment":"left","comment-box-date-show":"true","comment-box-comment-by-show":"true","comment-box-date-alignment":"right"}';
		}
		$options = json_decode($options, true);
		SGRB_AdminView::render('CommentForm/edit', array(
			'options' => $options,
			'sgrbSaveUrl' => $sgrbSaveUrl
		));
	}

	public function ajaxSave()
	{
		SGRB_Input::setSource($_POST);
		$options = array();
		if (count($_POST)) {
			$options['comment-box-theme'] = SGRB_Input::get('comment-box-theme');

			//rate part
			$options['comment-box-rate-show'] = SGRB_Input::get('comment-box-rate-show');
			if ($options['comment-box-rate-show']) {//if selected to show each rate
				$options['comment-box-rate-alignment'] = SGRB_Input::get('comment-box-rate-alignment');
				if (!$options['comment-box-rate-alignment']) {
					$options['comment-box-rate-alignment'] = 'right';//by default align to right
				}
			}

			//title part
			$options['comment-box-title-show'] = SGRB_Input::get('comment-box-title-show');
			if ($options['comment-box-title-show']) {
				$options['comment-box-title-alignment'] = SGRB_Input::get('comment-box-title-alignment');
				if (!$options['comment-box-title-alignment']) {
					$options['comment-box-title-alignment'] = 'left';//by default align to left
				}
			}

			//comment and avatar part
			$options['comment-box-avatar'] = SGRB_Input::get('comment-box-avatar');
			$options['comment-box-text'] = SGRB_Input::get('comment-box-text');
			if ($options['comment-box-avatar'] && $options['comment-box-text']) {
				$options['comment-box-avatar-and-text-alignment'] = SGRB_Input::get('comment-box-avatar-and-text-alignment');
			}
			else if ($options['comment-box-avatar'] || $options['comment-box-text']) {
				$options['comment-box-avatar-and-text-alignment'] = 'left';
			}
			else if (!$options['comment-box-avatar'] && !$options['comment-box-text']) {
				$options['comment-box-avatar-and-text-alignment'] = '';
			}
			else {
				$options['comment-box-avatar-and-text-alignment'] = 'left';//by default align to left
			}

			//date/comment by part
			$options['comment-box-date-show'] = SGRB_Input::get('comment-box-date-show');
			$options['comment-box-comment-by-show'] = SGRB_Input::get('comment-box-comment-by-show');
			if ($options['comment-box-date-show'] || $options['comment-box-comment-by-show']) {
				$options['comment-box-date-alignment'] = SGRB_Input::get('comment-box-date-alignment');
			}
			$options = json_encode($options);
			update_option('sgrb-comment-box-theme', $options);
			echo 1;
			exit();
		}
	}
}
