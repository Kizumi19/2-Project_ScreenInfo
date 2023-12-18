<?php

namespace App\Command;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Entity\User;

#[AsCommand(
    name: 'app:delete-user',
    description: 'Elimina un usuari de l\'aplicació mitjançant el seu correu electrònic',
)]
class DeleteUserCommand extends Command
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
    }

    protected function configure(): void
    {
        $this
            ->addArgument('email', InputArgument::REQUIRED, 'El correu electrònic del usuari a eliminar')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $email = $input->getArgument('email');

        if (!$email) {
            $io->error('Cal especificar el correu electrònic de l\'usuari.');
            return Command::FAILURE;
        }

        $user = $this->entityManager->getRepository(User::class)->findOneByEmail($email);

        if ($user) {
            $this->entityManager->remove($user);
            $this->entityManager->flush();

            $io->success(sprintf('L\'usuari amb el correu electrònic %s ha sigut eliminat.', $email));
        } else {
            $io->error(sprintf('No s\'ha trobat cap usuari amb el correu electrònic %s.', $email));
            return Command::FAILURE;
        }

        return Command::SUCCESS;
    }
}
