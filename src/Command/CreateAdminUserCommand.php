<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Repository\UserRepository;


#[AsCommand(
    name: 'app:create-admin-user',
    description: 'Aquesta comanda serveix per crear usuaris (normals i administradors)',
)]
class CreateAdminUserCommand extends Command
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        parent::__construct();
        $this->userRepository = $userRepository;
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
        //$this->userRepository->
        $io = new SymfonyStyle($input, $output);
        $email = $input->getArgument('email');
        $password = $input->getArgument('contrasenya');

        $io->note(sprintf('You passed an email: %s', $email));
        $io->note(sprintf('You passed an password: %s', $password));


        if ($input->getOption('admin')) {
            $io->note(sprintf('Vols crear un usuari de tipus "administrador"'));
        }

        $io->success('You have a new command! Now make it your own! Pass --help to see your options.');

        return Command::SUCCESS;
    }
}
