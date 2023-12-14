<?php

require_once 'C:\wamp64\www\tienda_virtual\Libraries\Core\Autoload.php'; // Ajusta la ruta según tu configuración de Composer
require_once 'C:\wamp64\www\tienda_virtual\Libraries\Core\Views.php';

class ViewsTest extends PHPUnit\Framework\TestCase
{
    public function testGetView()
    {
        $views = new Views();

        // Creamos un mock para simular el controlador (puedes ajustar según tus necesidades)
        $controllerMock = $this->getMockBuilder(stdClass::class)->getMock();

        // Capturamos la salida para realizar aserciones sobre ella
        ob_start();
        $views->getView($controllerMock, 'exampleView', 'exampleData');
        $output = ob_get_clean();

        // Realizamos aserciones según el comportamiento esperado
        $this->expectOutputRegex('/ContenidoEsperadoEnLaVista/');

        // Otra aserción puede ser verificar si la vista esperada es la correcta
        $this->assertStringContainsString('ContenidoEsperadoEnLaVista', $output);
    }
}
