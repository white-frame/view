<?php namespace WhiteFrame\View;

/**
 * Class View
 * @package Modules\Core\View
 */
class View
{
	protected $views;

	/**
	 *
	 */
	public function __construct()
	{
		$this->views = [];
	}

	/**
	 * @param $nestView
	 * @param $nestSection
	 * @param $nestedView
	 * @param array $nestedDatas
	 */
	public function add($nestView, $nestSection, $nestedView, $nestedDatas = [])
	{
		$this->views[$nestView][] = [
			'section' => $nestSection,
			'view' => $nestedView,
			'datas' => $nestedDatas
		];
	}

	/**
	 * @return array
	 */
	public function get($nestView)
	{
		if(isset($this->views[$nestView]))
			return $this->views[$nestView];
		else
			return [];
	}
}