<?php

namespace CaoMinhDuc\ExcelTemplate;

use Illuminate\Support\Facades\Facade;

/**
 * @see \CaoMinhDuc\ExcelTemplate\Skeleton\SkeletonClass
 */
class ExcelTemplateFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'excel-template';
    }
}
