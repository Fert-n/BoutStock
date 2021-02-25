<?php

namespace App\Command;

use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;

class CreateMailCommand extends Command
{
    protected static $defaultName = 'app:test:mail';

    /**
     * @var MailerInterface
     */
    private $mailer;

    public function __construct(MailerInterface $mailer)
    {
        $this->mailer = $mailer;

        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $email = (new TemplatedEmail())
            ->from(new Address('exemple@ex.fr', 'nath'))
            ->to('nathanaelle.fert2020@campus-eni.fr')
            ->subject('test')
            ->text('je mets ce que je veux')
        ;

        $this->mailer->send($email);

       return Command::SUCCESS;
    }
}