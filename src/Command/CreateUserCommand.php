<?php

namespace App\Command;

use App\Entity\User;
use App\Util\PasswordUtil;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class CreateUserCommand extends Command
{
    /**
     * @var string
     */
    protected static $defaultName = 'app:create-user';

    /**
     * @var UserPasswordEncoderInterface
     */
    private $userPasswordEncoder;

    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * CreateUserCommand constructor.
     * @param UserPasswordEncoderInterface $userPasswordEncoder
     * @param EntityManagerInterface $em
     * @param string|null $name
     */
    public function __construct(
        UserPasswordEncoderInterface $userPasswordEncoder,
        EntityManagerInterface $em,
        string $name = null
    ) {
        parent::__construct($name);
        $this->userPasswordEncoder = $userPasswordEncoder;
        $this->em = $em;
    }

    protected function configure()
    {
        $this
            ->setDescription('This command will create a user for admin.')
            ->addArgument('email', InputArgument::REQUIRED, 'write email')
        ;
    }

    /**
     * @param InputInterface $input
     * @param OutputInterface $output
     * @return int
     * @throws \Exception
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $email = $input->getArgument('email');
        $password = PasswordUtil::generatePassword();
        $user = new User($email);
        $passwordHash = $this->userPasswordEncoder->encodePassword($user, $password);
        $user->setPasswordHash($passwordHash);
        $this->em->persist($user);
        $this->em->flush();
        $output->write(\sprintf("Password for user %s is: %s\n", $email, $password));
        $output->write('User successfully created!');
    }
}
