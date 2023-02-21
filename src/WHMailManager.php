<?php

namespace Lalitwebhopers\WhMailer;

use Illuminate\Mail\MailManager;

class WHMailManager extends MailManager
{
    protected function createWHMailerTransport()
    {
        $config = $this->app['config']->get('services.whmailer', []);

        return new WhMailer(
            $this->guzzle($config), $config['key'], $config['url']
        );
    }
}