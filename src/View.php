<?php namespace WhiteFrame\View;

/**
 * Class View
 * @package Modules\Core\View
 */
class View
{
	protected $nested;

	/**
	 *
	 */
	public function __construct()
	{
		$this->nested = [];
	}

	/**
	 * @param $nestView
	 * @param $nestedView
	 * @param array $nestedDatas
	 */
	public function nest($nestView, $nestedView, $nestedDatas = [])
	{
		$this->nested[$nestView][$nestedView] = $nestedDatas;
	}

	/**
	 * @return array
	 */
	public function getNested($nestView)
	{
		if(isset($this->nested[$nestView]))
			return $this->nested[$nestView];
		else
			return [];
	}
}