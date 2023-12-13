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
final class AnimalServiceUnitTest extends TestCase {
    private AnimalService $animalService;

    public function __construct(string $name = null, array $data = [], $dataName = '') {
        parent::__construct($name, $data, $dataName);
        $this->animalService = new AnimalService();
    }


    public function testCreationAnimalWithoutAnyText() {
        $this->expectException(invalidInputException::class);
        $this->expectExceptionMessage('le nom doit être renseigné');
        $this->animalService->createAnimal(null,null);
    }

    public function testCreationAnimalWithoutName() {
        $this->expectException(invalidInputException::class);
        $this->expectExceptionMessage('le nom doit être renseigné');
        $this->animalService->createAnimal(null,2);
    }

    public function testCreationAnimalWithoutNumber() {
        $this->expectException(invalidInputException::class);
        $this->expectExceptionMessage('le numeroIdentification doit être renseigné');
        $this->animalService->createAnimal('chat',null);
    }


    public function testSearchAnimalWithNumber() {
        $this->expectException(invalidInputException::class);
        $this->expectExceptionMessage('search doit être une chaine de caractères');

        $this->animalService->searchAnimal(5678);

    }
    public function testSearchAnimalWithoutText() {
        $this->expectException(invalidInputException::class);
        $this->expectExceptionMessage('search doit être renseigné');

        $this->animalService->searchAnimal('');
    }
    public function testSearchAnimalWithText() {
        $reponse = $this->animalService->searchAnimal('luc');
        $this->assertIsArray($reponse);
    }
    public function testModifyAnimalWithInvalidId() {
        $this->expectException(invalidInputException::class);
        $this->expectExceptionMessage("l'id doit être un entier non nul");

        $this->animalService->updateAnimal(-12,'dfgdf','jjvkdjv');

    }
    public function testModifyAnimalWithEmptyId() {
        $this->expectException(invalidInputException::class);
        $this->expectExceptionMessage("l'id doit être renseigné");

        $this->animalService->updateAnimal('','dfgdf','jjvkdjv');
    }
    public function testModifyAnimalWithEmptyName() {
        $this->expectException(invalidInputException::class);
        $this->expectExceptionMessage("le nom  doit être renseigné");

        $this->animalService->updateAnimal(1,null,'jjvkdjv');
    }
    public function testModifyAnimalWithEmptyNumeroIdentification() {
        $this->expectException(invalidInputException::class);
        $this->expectExceptionMessage("le numeroIdentification doit être renseigné");

        $this->animalService->updateAnimal(1,'chat',null);
    }
    public function testModifyAnimalWithValidIdNomNumeroIdentification() {
        $reponse = $this->animalService->updateAnimal(1,'nulll','nulll');
        self::assertTrue($reponse);
    }


    public function testDeleteAnimalWithTextAsId() {
        $this->expectException(invalidInputException::class);
        $this->expectExceptionMessage("l'id doit être un entier non nul");

        $this->animalService->deleteAnimal('tfykhu');
    }
    public function testDeleteAnimalWithIdUnder0() {
        $this->expectException(invalidInputException::class);
        $this->expectExceptionMessage("l'id doit être un entier non nul");

        $this->animalService->deleteAnimal(-18);
    }
    public function testDeleteAnimalWithIdEqualsNull() {
        $this->expectException(invalidInputException::class);
        $this->expectExceptionMessage("l'id doit être renseigné");

        $this->animalService->deleteAnimal(null);
    }
    public function testDeleteAnimalWithIdOk() {
        $reponse = $this->animalService->deleteAnimal(1);

        self::assertTrue($reponse);
    }

    public function testgetAnimalWithTextAsId() {
        $this->expectException(invalidInputException::class);
        $this->expectExceptionMessage("l'id doit être un entier non nul");

        $this->animalService->getAnimal('1fgd');
    }
    public function testgetAnimalWithIdUnder0() {
        $this->expectException(invalidInputException::class);
        $this->expectExceptionMessage("l'id doit être un entier non nul");

        $this->animalService->getAnimal(-1);
    }
    public function testgetAnimalWithIdEqualsNull() {
        $this->expectException(invalidInputException::class);
        $this->expectExceptionMessage("l'id doit être renseigné");

        $this->animalService->getAnimal(null);
    }
    public function testgetAnimalWithIdOk() {
        $this->animalService->createAnimal('testNom',5665);
        $reponse = $this->animalService->getAnimal(2);

        self::assertEquals('testNom',$reponse['nom']);
    }
    public function testgetAllAnimals() {
        $reponse = $this->animalService->getAllAnimals();
        $this->assertIsArray($reponse);
    }
    public function testDeleteAllAnimals() {
        $reponse = $this->animalService->deleteAllAnimal();

        self::assertNotFalse( $reponse);
    }

}
