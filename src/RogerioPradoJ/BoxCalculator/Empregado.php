<?php
class RogerioPradoJ_BoxCalculator_Empregado
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
    public static function dvMatricula($matricula)
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
}
