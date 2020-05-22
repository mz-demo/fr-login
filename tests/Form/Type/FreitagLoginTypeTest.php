<?php
// tests/Form/Type/LoginFormTypeTest.php
namespace App\Tests\Form\Type;

use App\Form\Type\LoginFormType;
use App\Service\LoginCheck;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Form\PreloadedExtension;
use Symfony\Component\Form\Test\TypeTestCase;

class LoginFormTypeTest extends TypeTestCase
{
    private $objectManager;

    protected function setUp(): void
    {
        $this->objectManager = $this->createMock(ObjectManager::class);
        parent::setUp();
    }

    protected function getExtensions()
    {
        $type = new LoginFormType($this->objectManager);

        return [
            new PreloadedExtension([$type], []),
        ];
    }

    public function testSubmitValidData()
    {
        $formData = [
            'username' => 'michi',
            'password' => '123',
        ];

        // Instead of creating a new instance, the one created in
        // getExtensions() will be used.
        $form = $this->factory->create(LoginFormType::class, $formData);
        $form->submit($formData);

        // No transformation failures
        $this->assertTrue($form->isSynchronized());

        $expected = new LoginCheck();
        $this->assertSame($expected->getCredentials(), $form->getData());
    }
}
