<?php namespace WhiteFrame\View;

use Illuminate\Support\Facades\Facade;

class ViewFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'white-frame.view.view';
    }
}