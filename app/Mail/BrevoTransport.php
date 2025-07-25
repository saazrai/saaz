<?php

namespace App\Mail;

use Brevo\Client\Api\TransactionalEmailsApi;
use Brevo\Client\Configuration;
use Brevo\Client\Model\SendSmtpEmail;
use Brevo\Client\Model\SendSmtpEmailSender;
use Brevo\Client\Model\SendSmtpEmailTo;
use GuzzleHttp\Client;
use Symfony\Component\Mailer\SentMessage;
use Symfony\Component\Mailer\Transport\AbstractTransport;
use Symfony\Component\Mime\MessageConverter;

class BrevoTransport extends AbstractTransport
{
    protected $api;

    protected $apiKey;

    public function __construct(string $apiKey)
    {
        parent::__construct();

        $this->apiKey = $apiKey;

        $config = Configuration::getDefaultConfiguration()->setApiKey('api-key', $apiKey);
        $this->api = new TransactionalEmailsApi(new Client, $config);
    }

    protected function doSend(SentMessage $message): void
    {
        $email = MessageConverter::toEmail($message->getOriginalMessage());

        $sendSmtpEmail = new SendSmtpEmail;

        // Set sender
        $from = $email->getFrom();
        if (! empty($from)) {
            $fromAddress = reset($from);
            $sender = new SendSmtpEmailSender;
            $sender->setEmail($fromAddress->getAddress());
            $sender->setName($fromAddress->getName() ?: $fromAddress->getAddress());
            $sendSmtpEmail->setSender($sender);
        }

        // Set recipients
        $to = [];
        foreach ($email->getTo() as $address) {
            $recipient = new SendSmtpEmailTo;
            $recipient->setEmail($address->getAddress());
            $recipient->setName($address->getName() ?: $address->getAddress());
            $to[] = $recipient;
        }
        $sendSmtpEmail->setTo($to);

        // Set subject
        $sendSmtpEmail->setSubject($email->getSubject());

        // Set content
        if ($email->getHtmlBody()) {
            $sendSmtpEmail->setHtmlContent($email->getHtmlBody());
        }

        if ($email->getTextBody()) {
            $sendSmtpEmail->setTextContent($email->getTextBody());
        }

        try {
            $result = $this->api->sendTransacEmail($sendSmtpEmail);
        } catch (\Exception $e) {
            throw new \Symfony\Component\Mailer\Exception\TransportException(
                'Unable to send email via Brevo API: '.$e->getMessage()
            );
        }
    }

    public function __toString(): string
    {
        return 'brevo';
    }
}
