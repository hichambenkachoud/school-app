<?php

namespace ManagementBundle\Command;

use Doctrine\ORM\EntityManagerInterface;
use ManagementBundle\Entity\Module;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class CsvImportModuleCommand extends Command
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct();
        $this->em = $em;
    }

    protected function configure(){
        $this
            ->setName('csv:import')
            ->setDescription('Import Modules')
        ;

    }

    protected function execute(InputInterface $input, OutputInterface $output){

        $io = new SymfonyStyle($input, $output);
        $io->title('Attempting to import the feed ...');

        $module = (new Module())
            ->setTitle('module 1')
            ->setCode('code module 1')
            ->setCoefficient(4)
            ->setHours(48);

        $this->em->persist($module);

        $this->em->flush();

        $io->success('Everything went well!');
    }
}