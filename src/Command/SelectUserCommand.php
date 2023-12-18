<?php

namespace App\Command;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Entity\User;

#[AsCommand(
    name: 'app:select-user',
    description: 'Consulta els usuaris existents de l\'aplicació',
)]
class SelectUserCommand extends Command
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
    }

    protected function configure(): void
    {
        $this
            ->addArgument('mostrar', InputArgument::OPTIONAL, 'Es mostrarà tots els usuaris existents')
            ->addOption('admin', null, InputOption::VALUE_NONE, 'Només es mostraran els usuaris administrador')
            ->addOption('normal', null, InputOption::VALUE_NONE, 'Només es mostraran els usuaris administrador')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $mostrar = $input->getArgument('mostrar');

        $io->note(sprintf('You passed an option: %s', $mostrar));

        $qb = $this->entityManager->createQueryBuilder();
        $qb->select('u')
            ->from(User::class,'u');

        if ($input->getOption('admin')) {
            $qb->where('u.roles LIKE :role')
                ->setParameter('role', '%"ROLE_ADMIN"%');
        } elseif ($input->getOption('normal')){
            $qb->where('u.roles NOT LIKE :role')
                ->setParameter('role','%"ROLE_ADMIN"%' );
        }

        $users = $qb->getQuery()->getResult();
        foreach ($users as $user) {
            $io->listing([
                'ID: ' . $user->getId(),
                'Email: ' . $user->getEmail(),
                'Roles: ' . implode(', ', $user->getRoles()),
            ]);
        }

        $io->success('Consulta realitzada.');

        return Command::SUCCESS;
    }
}
