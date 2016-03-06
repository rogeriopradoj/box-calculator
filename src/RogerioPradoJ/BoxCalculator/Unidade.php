<?php
class RogerioPradoJ_BoxCalculator_Unidade
{
    /**
     * retorna o dv (dígito verificador) de uma matrícula
     *
     * @param  string  $matricula do empregado, 7 dígitos, formato C123456
     * 
     * @return integer $dv da matrícula, formato 1
     *
     * @throws InvalidArgumentException Se matrícula não tiver exatamente sete dígitos
     *                                  ou não começar com C
     */
    public function dvMatricula($matricula)
    {
        if ((strlen($matricula) !== 7) ) {
            throw new InvalidArgumentException("Matrícula deve ter 7 dígitos", 1);
        }

        if ('C' !== strtoupper(substr($matricula, 0, 1)) ) {
            throw new InvalidArgumentException("Matrícula deve ter 7 dígitos", 1);
        }

        $digitos = str_split(substr($matricula, -6));
        $somaCalculaDigito  =   0;

        for ($i=0; $i<6; $i++){
            $somaCalculaDigito  +=  $digitos[$i] * ($i + 2);
        }

        $restoDivisaoPor11  =   $somaCalculaDigito % 11;

        if ($restoDivisaoPor11 == 10) {
            $digitoVerificador = 0;
        } else {
            $digitoVerificador = $restoDivisaoPor11;
        }

        return $digitoVerificador;
    }

    /**
     * retorna o dv (dígito verificador) de uma unidade
     *
     * @param string $codigo da unidade, 4 digitos, formato 1234
     *
     * @return integer $dv da unidade, formato 1
     *
     * @throws InvalidArgumentException Se o código não tiver exatamente 4 dígitos
     */
    public function dvCodigo($codigo)
    {
        if ((strlen($codigo) !== 4) ) {
            throw new InvalidArgumentException("Código deve ter 4 dígitos", 1);
        }

        $digitos = str_split($codigo);
        $somaCalculaDigito  =   0;

        for ($i=0; $i<4; $i++){
            $somaCalculaDigito  +=  $digitos[$i] * ($i + 6);
        }

        $restoDivisaoPor11  =   $somaCalculaDigito % 11;

        if ($restoDivisaoPor11 == 10) {
            $digitoVerificador = 0;
        } else {
            $digitoVerificador = $restoDivisaoPor11;
        }

        return $digitoVerificador;
    }
}
