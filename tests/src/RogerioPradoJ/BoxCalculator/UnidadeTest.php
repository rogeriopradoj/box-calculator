<?php
class RogerioPradoJ_BoxCalculator_UnidadeTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var RogerioPradoJ_BoxCalculator_Empregado
     */
    public $unidade;

    public function assertPreConditions()
    {
        $this->assertTrue(
            class_exists($class = 'RogerioPradoJ_BoxCalculator_Unidade'),
            'Class not found: '.$class
        );
        $this->assertInstanceOf('RogerioPradoJ_BoxCalculator_Unidade', $this->unidade);
    }

    public function setUp()
    {
        $this->unidade = new RogerioPradoJ_BoxCalculator_Unidade();
    }

    public function tearDown()
    {
        $this->unidade = null;
    }

    /**
     * @dataProvider providerForDvCodigoComEmpregadoRealDeveRetornarDvReal
     */
    public function testDvCodigoComUnidadeRealDeveRetornarDvReal($codigo, $dv)
    {
        $this->assertEquals($dv, $this->unidade->dvCodigo($codigo));
    }

    public function providerForDvCodigoComEmpregadoRealDeveRetornarDvReal()
    {
        return array(
            array('4154', '8'),
            array('4241', '2'),
            array('0236', '4'),
        );
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testDvCodigoNaoPermiteUnidadeMenos4Digitos()
    {
        $codigo = '1';
        $this->unidade->dvCodigo($codigo);
        $codigo = '12';
        $this->unidade->dvCodigo($codigo);
        $codigo = '123';
        $this->unidade->dvCodigo($codigo);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testDvCodigoNaoPermiteUnidadeMais7Digitos()
    {
        $codigo = '12345';
        $this->unidade->dvCodigo($codigo);
    }
}
