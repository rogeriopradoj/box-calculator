<?php
class RogerioPradoJ_BoxCalculator_EmpregadoTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var RogerioPradoJ_BoxCalculator_Empregado
     */
    public $empregado;

    public function assertPreConditions()
    {
        $this->assertTrue(
            class_exists($class = 'RogerioPradoJ_BoxCalculator_Empregado'),
            'Class not found: '.$class
        );
        $this->assertInstanceOf('RogerioPradoJ_BoxCalculator_Empregado', $this->empregado);
    }

    public function setUp()
    {
        $this->empregado = new RogerioPradoJ_BoxCalculator_Empregado();
    }

    public function tearDown()
    {
        $this->empregado = null;
    }

    /**
     * @dataProvider providerForDvMatriculaComEmpregadoRealDeveRetornarDvReal
     */
    public function testDvMatriculaComEmpregadoRealDeveRetornarDvReal($matricula, $dv)
    {
        $this->assertEquals($dv, $this->empregado->dvMatricula($matricula));
    }

    public function providerForDvMatriculaComEmpregadoRealDeveRetornarDvReal()
    {
        return array(
            array('C222222', '0'),
            array('C777777', '2'),
            array('C999999', '1'),
        );
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testDvMatriculaNaoPermiteMatriculaNaoC()
    {
        $matricula = 'P123456';
        $this->empregado->dvMatricula($matricula);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testDvMatriculaNaoPermiteMatriculaMenos7Digitos()
    {
        $matricula = 'C1234';
        $this->empregado->dvMatricula($matricula);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testDvMatriculaNaoPermiteMatriculaMais7Digitos()
    {
        $matricula = 'C1234567';
        $this->empregado->dvMatricula($matricula);
    }
}
