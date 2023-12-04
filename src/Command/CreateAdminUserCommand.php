<?php

namespace App\Command;

use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Repository\UserRepository;
use App\Entity\User;

#[AsCommand(
    name: 'app:create-user',
    description: 'Aquesta comanda serveix per crear usuaris (normals i administradors)',
)]
class CreateAdminUserCommand extends Command
{
    private UserRepository $userRepository;
    private UserPasswordHasherInterface $passwordHasher;


    public function __construct(UserRepository $userRepository, UserPasswordHasherInterface $passwordHasher)
    {
        parent::__construct();
        $this->userRepository = $userRepository;
        $this->passwordHasher = $passwordHasher;

    }

    protected function configure(): void
    {
        $this
            ->addArgument('email', InputArgument::REQUIRED, 'Escriu l\'email de l\'usuari')
            ->addArgument('contrasenya', InputArgument::REQUIRED, 'Escriu la contrasenya de l\'usuari')
            ->addOption('admin', null, InputOption::VALUE_NONE, 'Si s\'activa aquesta opció, es crearà un nou usuari del tipus "administrador"')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {

        $io = new SymfonyStyle($input, $output);
        $email = $input->getArgument('email');
        $password = $input->getArgument('contrasenya');

        $io->note(sprintf('You passed an email: %s', $email));
        $io->note(sprintf('You passed an password: %s', $password));


        $usuari = new User();
        $usuari->setEmail($email);
        $usuari->setPassword($password);

        if ($input->getOption('admin')) {
            $io->note(sprintf('Vols crear un usuari de tipus "administrador"'));
            $usuari->setRoles(['ROLE_ADMIN']);
        } else {
            $usuari->setRoles(['ROLE_USER']);
        }

        $hashPassword = $this->passwordHasher->hashPassword($usuari, $password);
        $usuari->setPassword($hashPassword);

        $this->userRepository->createUser($usuari);

        $io->success('Enhorabona has creat un nou usuari!');

        return Command::SUCCESS;
    }
}
