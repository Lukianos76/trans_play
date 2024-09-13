<?php

namespace App\Shared\Infrastructure\Symfony\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Yaml\Yaml;

#[AsCommand(name: 'app:create-entity')]
class CreateEntityCommand extends Command
{
    protected function configure()
    {
        $this
            ->setDescription('Crée les dossiers et fichiers pour une nouvelle entité.')
            ->setHelp('Cette commande vous permet de créer les dossiers et fichiers nécessaires pour une nouvelle entité.')
            ->addArgument('entityName', InputArgument::REQUIRED, 'Le nom de l\'entité. (ex: User)');
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $entityName = $input->getArgument('entityName');
        $lowerEntityName = strtolower($entityName);

        $entityPath = __DIR__ . "/../../../../{$entityName}";
        $configPath = __DIR__ . "/../../../../../config";
        $templatePath = __DIR__ . "/templates";

        $filesystem = new Filesystem();

        $this->createEntityFilesAndDirectories($filesystem, $entityName, $lowerEntityName, $entityPath, $templatePath);
        $this->updateDoctrineConfig($filesystem, $entityName, $configPath);
        $this->updateServicesConfig($filesystem, $entityName, $configPath);
        $this->updateRoutesConfig($filesystem, $entityName, $lowerEntityName, $configPath);

        $output->writeln("Les dossiers et fichiers pour l'entité $entityName ont été créés avec succès.");
        return Command::SUCCESS;
    }

    private function createEntityFilesAndDirectories(Filesystem $filesystem, string $entityName, string $lowerEntityName, string $entityPath, string $templatePath): void
    {
        $templates = [
            'controller' => file_get_contents("{$templatePath}/controller.tpl.php"),
            'dto' => file_get_contents("{$templatePath}/dto.tpl.php"),
            'entity' => file_get_contents("{$templatePath}/entity.tpl.php"),
            'repository_interface' => file_get_contents("{$templatePath}/repository_interface.tpl.php"),
            'validator_interface' => file_get_contents("{$templatePath}/validator_interface.tpl.php"),
            'doctrine_mapping' => file_get_contents("{$templatePath}/doctrine_mapping.tpl.xml"),
            'doctrine_repository' => file_get_contents("{$templatePath}/doctrine_repository.tpl.php"),
            'symfony_validator' => file_get_contents("{$templatePath}/symfony_validator.tpl.php"),
            'create_use_case' => file_get_contents("{$templatePath}/create_use_case.tpl.php"),
            'delete_use_case' => file_get_contents("{$templatePath}/delete_use_case.tpl.php"),
            'update_use_case' => file_get_contents("{$templatePath}/update_use_case.tpl.php"),
            'get_use_case' => file_get_contents("{$templatePath}/get_use_case.tpl.php"),
            'get_all_use_case' => file_get_contents("{$templatePath}/get_all_use_case.tpl.php"),
        ];

        $paths = [
            "{$entityPath}/Application/Controller/{$entityName}Controller.php" => $templates['controller'],
            "{$entityPath}/Application/UseCase/Create{$entityName}UseCase.php" => $templates['create_use_case'],
            "{$entityPath}/Application/UseCase/Delete{$entityName}UseCase.php" => $templates['delete_use_case'],
            "{$entityPath}/Application/UseCase/Update{$entityName}UseCase.php" => $templates['update_use_case'],
            "{$entityPath}/Application/UseCase/Get{$entityName}UseCase.php" => $templates['get_use_case'],
            "{$entityPath}/Application/UseCase/GetAll{$entityName}UseCase.php" => $templates['get_all_use_case'],
            "{$entityPath}/Application/DTO/{$entityName}DTO.php" => $templates['dto'],
            "{$entityPath}/Domain/Entity/{$entityName}.php" => $templates['entity'],
            "{$entityPath}/Domain/Repository/{$entityName}RepositoryInterface.php" => $templates['repository_interface'],
            "{$entityPath}/Domain/Validator/{$entityName}ValidatorInterface.php" => $templates['validator_interface'],
            "{$entityPath}/Infrastructure/Doctrine/Mapping/{$entityName}.orm.xml" => $templates['doctrine_mapping'],
            "{$entityPath}/Infrastructure/Doctrine/Repository/Doctrine{$entityName}Repository.php" => $templates['doctrine_repository'],
            "{$entityPath}/Infrastructure/Symfony/Validator/{$entityName}Validator.php" => $templates['symfony_validator'],
        ];

        foreach ($paths as $path => $template) {
            $content = str_replace(['{{entityName}}', '{{entityNameLower}}'], [$entityName, $lowerEntityName], $template);
            $filesystem->dumpFile($path, $content);
        }
    }

    private function updateDoctrineConfig(Filesystem $filesystem, string $entityName, string $configPath): void
    {
        $doctrineConfigPath = "{$configPath}/packages/doctrine.yaml";
        $doctrineConfig = Yaml::parseFile($doctrineConfigPath);
        $doctrineConfig['doctrine']['orm']['mappings'][$entityName] = [
            'is_bundle' => false,
            'type' => 'xml',
            'dir' => "%kernel.project_dir%/src/{$entityName}/Infrastructure/Doctrine/Mapping",
            'prefix' => "App\\{$entityName}\Domain\Entity",
            'alias' => $entityName,
            'mapping' => true,
        ];
        $filesystem->dumpFile($doctrineConfigPath, Yaml::dump($doctrineConfig, 4));
    }

    private function updateServicesConfig(Filesystem $filesystem, string $entityName, string $configPath): void
    {
        $servicesConfigPath = "{$configPath}/services.yaml";
        $servicesConfig = Yaml::parseFile($servicesConfigPath);
        $serviceToExclude = "%kernel.project_dir%/src/{$entityName}/Domain/Entity/";
        if (!in_array($serviceToExclude, $servicesConfig['services']["App\\"]['exclude'])) {
            $servicesConfig['services']["App\\"]['exclude'][] = $serviceToExclude;
        }
        $filesystem->dumpFile($servicesConfigPath, Yaml::dump($servicesConfig, 4));
    }

    private function updateRoutesConfig(Filesystem $filesystem, string $entityName, string $lowerEntityName, string $configPath): void
    {
        $routesConfigPath = "{$configPath}/routes.yaml";
        $routesConfig = Yaml::parseFile($routesConfigPath);
        $routesConfig["{$lowerEntityName}_controllers"] = [
            'resource' => [
                'path' => "../src/{$entityName}/Application/Controller",
                'namespace' => "App\\{$entityName}\Application\Controller",
            ],
            'type' => 'attribute'
        ];
        $filesystem->dumpFile($routesConfigPath, Yaml::dump($routesConfig, 4));
    }
}
