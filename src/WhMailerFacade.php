<?php

namespace Lalitwebhopers\WhMailer;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Lalitwebhopers\WhMailer\Skeleton\SkeletonClass
 */
class WhMailerFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'wh-mailer';
    }
}
