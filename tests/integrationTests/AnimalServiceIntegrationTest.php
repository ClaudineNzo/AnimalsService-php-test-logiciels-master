<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use PHPUnit\Framework\TestCase;

require __DIR__ . '/../../src/AnimalService.php';

/**
 * * @covers invalidInputException
 * @covers \AnimalService
 *
 * @internal
 */
final class AnimalServiceIntegrationTest extends TestCase
{
    private $animalService;

    public function __construct(string $name = null, array $data = [], $dataName = '') {
        parent::__construct($name, $data, $dataName);
        $this->animalService = new AnimalService();
    }

    // test de suppression de toute les données, nécessaire pour nettoyer la bdd de tests à la fin
    public function testDeleteAll()
    {
        $this->animalService->createAnimal('lion','df5d4fd');
        $this->animalService->createAnimal('poisson','df546');
        $this->animalService->createAnimal('lievre','nuldvdsl');

        $this->animalService->deleteAllAnimal();

        $reponse = $this->animalService->getAllAnimals();
        $this->assertEmpty($reponse);
    }


    public function testCreation()
    {
        $this->animalService->createAnimal('chien','HH59825f');
        $reponse = $this->animalService->getAllAnimals();
        $row = end($reponse);

        self::assertEquals('chien', $row['nom']);
        self::assertEquals('HH59825f', $row['numeroIdentifcation']);
    }

    public function testSearch()
    {
        $this->animalService->createAnimal('lion','t5596om');
        $row = $this->animalService->searchAnimal('lion');

        self::assertEquals('lion', $row[0]['nom']);
        self::assertEquals('t5596om', $row[0]['numeroIdentifcation']);
    }

    public function testModify()
    {
        $this->animalService->createAnimal('tigre','tr6845654');
        $reponse = $this->animalService->getAllAnimals();
        $row = end($reponse);
        $this->animalService->updateAnimal($row['id'],'ligre','tr6845654');
        $reponse2 = $this->animalService->getAllAnimals();
        $row2 = end($reponse2);
        self::assertEquals('ligre', $row2['nom']);
        self::assertEquals('tr6845654', $row2['numeroIdentifcation']);
    }

    public function testDelete()
    {
        $this->animalService->createAnimal('cafard','cf68465');
        $reponse = $this->animalService->getAllAnimals();
        $row = end($reponse);
        $this->animalService->deleteAnimal($row['id']);
        $reponse2 = $this->animalService->getAllAnimals();
        $row2 = end($reponse2);
        self::assertNotEquals($row['id'], $row2['id']);
    }

}
