<?php

namespace Lalitwebhopers\WhMailer;
use GuzzleHttp\ClientInterface;
use Illuminate\Mail\Transport\Transport;
use Illuminate\Support\Facades\Log;
use Swift_Mime_SimpleMessage;

class WhMailer extends Transport
{
    protected $client;
    protected $key;
    protected $url;

    /**
     * Create a new Custom transport instance.
     *
     * @param  \GuzzleHttp\ClientInterface  $client
     * @param  string|null  $url
     * @param  string  $key
     * @return void
     */
    public function __construct(ClientInterface $client, $key, $url)
    {
        $this->key = $key;
        $this->client = $client;
        $this->url = $url;
    }

    /**
     * {@inheritdoc}
     */
    public function send(Swift_Mime_SimpleMessage $message, &$failedRecipients = null)
    {
        $this->beforeSendPerformed($message);
        $payload = $this->getPayload($message);
        $this->client->request('POST', $this->url, $payload);
        $this->sendPerformed($message);
        return $this->numberOfRecipients($message);
    }

    /**
     * Get the HTTP payload for sending the message.
     *
     * @param  \Swift_Mime_SimpleMessage  $message
     * @return array
     */
    protected function getPayload(Swift_Mime_SimpleMessage $message)
    {
        // Change this to the format your API accepts
        return [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->key,
                'Accept'        => 'application/json',
                'api-key' => $this->key,
            ],
            'json' => [
                'from' => $this->mapContactsToEmail($message->getFrom()),
                'to' => $this->mapContactsToEmail($message->getTo()),
                'cc' => $this->mapContactsToEmail($message->getCc()),
                'bcc' => $this->mapContactsToEmail($message->getBcc()),
                'html' => $message->getBody(),
                'subject' => $message->getSubject(),
            ],
        ];
    }

    protected function mapContactsToNameEmail($contacts)
    {
        $formatted = [];
        if (empty($contacts)) {
            return [];
        }
        foreach ($contacts as $address => $display) {
            $formatted[] =  [
                'name' => $display,
                'email' => $address,
            ];
        }
        return $formatted;
    }

    protected function mapContactsToEmail($contacts)
    {
        $formatted = [];
        if (empty($contacts)) {
            return '';
        }
        foreach ($contacts as $address => $display) {
            $formatted[] =  $address;
        }
        $formatted = implode(',', $formatted);
        Log::info($formatted);
        return $formatted;
    }
}
