<?php
class RogerioPradoJ_BoxCalculator_Apf
{
    /**
     * @var array
     */
    private $tabelaCalculoDv = array(
        0 => 6,
        1 => 8,
        2 => 0,
        3 => 2,
        4 => 4,
        5 => 7,
        6 => 9,
        7 => 1,
        8 => 3,
        9 => 5,
    );

    /**
     * retorna o dv (dígito verificador de um apf)
     *
     * @param  string $apf operação sete dígitos, formato 1234567
     * 
     * @return string $dv dois dígitos, formato 12
     *
     * @throws InvalidArgumentException Se operação tiver mais que sete dígitos
     */
    public function dvApf($apf)
    {
        $dv = null;
        $apf = intval($apf);

        if ($apf <= 0 || $apf > 9999999) {
            throw new InvalidArgumentException("Apf pode ter no máximo 7 dígitos", 1);
        }

        $dv1 = 0;
        $dv2 = 0;

        // separa os digitos da operação recebida num array
        $digitos = str_split($apf);

        $somaCalculaDigito = 0;

        foreach ($digitos as $posicao => $valor) {

            if ($posicao % 2 == 0) {
                // se a posição for par
                $somaCalculaDigito += $this->tabelaCalculoDv[$valor];
            } else {
                // se a posição for ímpar
                $somaCalculaDigito += $valor;
            }

            // dv é o resto da divisão por 10
            $dv1 = $somaCalculaDigito % 10;

        }

        $operacaoTemporaria = $dv1 . $apf;

        $digitos = str_split($operacaoTemporaria);

        $somaCalculaDigito = 0;

        foreach ($digitos as $posicao => $valor) {

            if ($posicao % 2 == 0) {
                // se a posição for par
                $somaCalculaDigito += $this->tabelaCalculoDv[$valor];
            } else {
                // se a posição for ímpar
                $somaCalculaDigito += $valor;
            }

            // dv é o resto da divisão por 10
            $dv2 = $somaCalculaDigito % 10;
        }

        $dv = str_pad($dv1 . $dv2, 2, '0', STR_PAD_LEFT);

        return $dv;
    }

    private function dvTemporario()
    {

    }
}
