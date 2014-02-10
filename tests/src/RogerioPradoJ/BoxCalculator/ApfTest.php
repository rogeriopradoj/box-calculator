<?php
class RogerioPradoJ_BoxCalculator_ApfTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var RogerioPradoJ_BoxCalculator_Apf
     */
    public $apf;

    public function assertPreConditions()
    {
        $this->assertTrue(
            class_exists($class = 'RogerioPradoJ_BoxCalculator_Apf'),
            'Class not found: '.$class
        );
        $this->assertInstanceOf('RogerioPradoJ_BoxCalculator_Apf', $this->apf);
    }

    public function setUp()
    {
        $this->apf = new RogerioPradoJ_BoxCalculator_Apf();
    }

    public function tearDown()
    {
        $this->apf = null;
    }

    /**
     * @dataProvider providerForDvApfComOperacoesReaisDeveRetornarDv
     */
    public function testDvApfComOperacaoRealDeveRetornarDvReal($operacao, $dv)
    {
        $this->assertEquals($dv, $this->apf->dvApf($operacao));
    }

    public function providerForDvApfComOperacoesReaisDeveRetornarDv()
    {
        return array(
            array('0161138', '37'),
            array('1003766', '33'),
            array('0216997', '19'),
            array('0217000', '82'),
            array('0227448', '95'),
            array('0230764', '90'),
            array('1234567', '05'),
        );
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testDvApfNaoPermiteOperacaoIgualZero()
    {
        $operacao = '0';
        $this->apf->dvApf($operacao);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testDvApfNaoPermiteOperacaoNegativa()
    {
        $operacao = '-123';
        $this->apf->dvApf($operacao);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testDvApfNaoPermiteOperacaoComMaisSeteDigitos()
    {
        $operacao = '12345678';
        $this->apf->dvApf($operacao);
    }
}
