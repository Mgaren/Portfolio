<?php

namespace App\Security;

use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use SymfonyCasts\Bundle\VerifyEmail\Exception\VerifyEmailExceptionInterface;
use SymfonyCasts\Bundle\VerifyEmail\VerifyEmailHelperInterface;

class EmailVerifier
{
    private VerifyEmailHelperInterface $verifyEmailHelper;
    private MailerInterface $mailer;
    private EntityManagerInterface $entityManager;

    /**
     * EmailVerifier constructor.
     * @param VerifyEmailHelperInterface $helper
     * @param MailerInterface $mailer
     * @param EntityManagerInterface $manager
     */
    public function __construct(
        VerifyEmailHelperInterface $helper,
        MailerInterface $mailer,
        EntityManagerInterface $manager
    ) {
        $this->verifyEmailHelper = $helper;
        $this->mailer = $mailer;
        $this->entityManager = $manager;
    }

    /**
     * @param string $verifyEmailRouteName
     * @param User $user
     * @param TemplatedEmail $email
     * @throws TransportExceptionInterface
     */
    public function sendEmailConfirmation(
        string $verifyEmailRouteName,
        User $user,
        TemplatedEmail $email
    ): void {
        $signatureComponents = $this->verifyEmailHelper->generateSignature(
            $verifyEmailRouteName,
            (string)$user->getId(),
            $user->getEmail()
        );

        $context = $email->getContext();
        $context['signedUrl'] = $signatureComponents->getSignedUrl();
        $context['expiresAt'] = $signatureComponents->getExpiresAt();

        $email->context($context);

        $this->mailer->send($email);
    }

    /**
     * @param Request $request
     * @param User $user
     * @throws VerifyEmailExceptionInterface
     */
    public function handleEmailConfirmation(Request $request, User $user): void
    {
        $this->verifyEmailHelper->validateEmailConfirmation(
            $request->getUri(),
            (string)$user->getId(),
            $user->getEmail()
        );

        $user->setIsVerified(true);

        $this->entityManager->persist($user);
        $this->entityManager->flush();
    }
}
