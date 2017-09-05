<?php

global $sgrb;
$sgrb->includeLib('Review');
$sgrb->includeModel('Review');

class SGRB_ReviewReviewView extends SGRB_Review
{
	public function __construct()
	{
		parent::__construct('sgrb');
		$sgrbPro = '';
		if (!SGRB_PRO_VERSION) {
			$sgrbPro = '<i style="color:#ff0000"> (PRO) </i>';
		}

		$this->setRowsPerPage(10);
		$this->setTablename(SGRB_ReviewModel::TABLE);
		$this->setColumns(array(
			'id',
			'title',
			'type'
		));
		$this->setBulk();
		$this->setDisplayColumns(array(
			'sgrb-id' => 'ID',
			'title' => 'Title',
			'type' => 'Review type',
			'total_rate' => 'Total rate',
			'comment' => '<i class="vers comment-grey-bubble"></i>Comments',
			'shortcode' => 'Shortcode',
			'options' => 'Widget '.$sgrbPro

		));
		$this->setSortableColumns(array(
			'id' => array('id', false),
			'title' => array('title', true),
			'type' => array('type', false)
		));
		$this->setInitialSort(array(
			'id' => 'DESC'
		));

	}

	public function customizeRow(&$row)
	{
		global $sgrb;
		$id = $row[0];
		$reviewType = '';
		$totalRate = 'no rates';
		$commentUrl = $sgrb->adminUrl('Comment/index','id='.$id);
		$comments = SGRB_CommentModel::finder()->findAll('review_id = %d', $id);
		$commentsCount = '';
		foreach ($comments as $val) {
			$commentsCount = count($comments);
			if ($commentsCount) {
				$commentsCount = '::'.$commentsCount;
			}
		}
		if ($row[2] == SGRB_REVIEW_TYPE_SIMPLE) {
			$reviewType = 'Simple';
		}
		else if ($row[2] == SGRB_REVIEW_TYPE_PRODUCT) {
			$reviewType = 'Product';
		}
		else if ($row[2] == SGRB_REVIEW_TYPE_SOCIAL) {
			$reviewType = 'Social';
		}
		else if ($row[2] == SGRB_REVIEW_TYPE_POST) {
			$reviewType = 'Post';
		}
		else if ($row[2] == SGRB_REVIEW_TYPE_WOO) {
			$reviewType = 'WooCommerce';
		}
		$row[2] = $reviewType;
		$totalRate = $this->getTotalRate($id);
		$row[3] = round($totalRate, 1);

		$row[4] = '<a href="'.$commentUrl.'">'.$commentsCount.'</a>';
		$editUrl = $sgrb->adminUrl('Review/edit','id='.$id);
		$row[5] = "<input type='text' onfocus='this.select();' style='font-size:12px;' readonly value='[sgrb_review id=".$id."]' class='sgrb-large-text code'>";
		if (SGRB_PRO_VERSION) {
			$row[6] = "<input type='text' onfocus='this.select();' style='font-size:12px;' readonly value='[sgrb_widget id=".$id."]' class='sgrb-large-text code'>";
		}
		else {
			$row[6] = "<input type='text' style='font-size:12px;color: #ff0000;' readonly value='[shortcode]' class='sgrb-large-text code'>";
		}
		$row[1] .= '<p class="sgrb-show-hide-option-links-js" style="margin:0;visibility:hidden;"><a href="'.$editUrl.'">'.__('Edit', 'sgrb').'</a>&nbsp;|&nbsp;
					<a href="#" onclick="SGReview.ajaxDelete('.$id.')">'.__('Delete', 'sgrb').'</a>&nbsp;|&nbsp;
					<a href="#" onclick="SGReview.prototype.ajaxCloneReview('.$id.')">'.__('Clone', 'sgrb').'</a></p>';
	}

	public function customizeQuery(&$query)
	{
		//$query .= ' LEFT JOIN wp_sgrb_comment ON wp_sgrb_comment.review_id='.$this->tablename.'.id';
	}

	public function getTotalRate($reviewId)
	{
		global $sgrb;
		$total = 0;
		$rateCount = 0;
		$currentReviewCategories = SGRB_CategoryModel::finder()->findAll('review_id = %d', $reviewId);
		foreach ($currentReviewCategories as $category) {
			$rates = SGRB_Comment_RatingModel::finder()->findAll('category_id = %d', $category->getId());
			foreach ($rates as $rate) {
				$total += $rate->getRate();
				$rateCount++;
			}
		}

		if ($total) {
			$total = $total/$rateCount;
		}
		return $total;
	}
}
