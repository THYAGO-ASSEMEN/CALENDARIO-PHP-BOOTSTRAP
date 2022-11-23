<!DOCTYPE html>

<html lang="pt-br">

<head>

    <title>Calendario</title>
    <!-- Meta Tags -->

    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="thyago assemen oliveira">
    <meta name="description" content="MANAUS AMAZONAS">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"></script>




</head>

<body>


        <div id="calendar" class="container">

            <?php
			$data_atual = date('Y-m-d'); //aaaa-mm-dd (2000-01-30)
			$dia_atual = date('d'); //dd
			$mes_atual = date('m'); //mm
			$ano_atual = date('Y'); //yyyy
			

			$qtdDiasMesAtual = cal_days_in_month(CAL_GREGORIAN, $mes_atual, $ano_atual); //mostra a quantidade de dias correspondente ao mes e ano inseridos respectivamente nas variaveis..
																						//ex: 11/2022 = 30 dias.

			$dia_semana_mensal = array(); // cria uma array com a primeira semana

			for ($cria_dia_semana_mensal = 1; $cria_dia_semana_mensal <= $qtdDiasMesAtual; $cria_dia_semana_mensal++) {
				$date = date_create();
				date_date_set($date, $ano_atual, $mes_atual, $cria_dia_semana_mensal);
				$dia_semana_mensal[$cria_dia_semana_mensal] = date_format($date, 'w');
			}

			//esse for acima faz uma verificação para saber em qual dia da semana começa o mês atual.



			$meses_extenso = array();
			$meses_extenso[1] = "Janeiro";
			$meses_extenso[2] = "Fevereiro";
			$meses_extenso[3] = "Março";
			$meses_extenso[4] = "Abril";
			$meses_extenso[5] = "Maio";
			$meses_extenso[6] = "Junho";
			$meses_extenso[7] = "Julho";
			$meses_extenso[8] = "Agosto";
			$meses_extenso[9] = "Setembro";
			$meses_extenso[10] = "Outubro";
			$meses_extenso[11] = "Novembro";
			$meses_extenso[12] = "Dezembro";

			$transforma_mes_atual_em_int = intval($mes_atual);
			$mes_atual_por_extenso = $meses_extenso[$transforma_mes_atual_em_int];

			//atribui a variavel $mes_atua_por_extenso o nome do mês atual em português, que será impresso acima do calendário no front




			//essa funçao foi criada para você selecionar quais dias da semana você irá indisponibilizar
			function verificaIndispDiaSemana($dia_semana_verifica){
				$indisp_dia_semana = array();
				$indisp_dia_semana[0] = true; 		//indisponibiliza domingo
				$indisp_dia_semana[1] = false;		//indisponibiliza segunda
				$indisp_dia_semana[2] = false;		//indisponibiliza terça
				$indisp_dia_semana[3] = false;		//indisponibiliza quarta
				$indisp_dia_semana[4] = false;		//indisponibiliza quinta
				$indisp_dia_semana[5] = false;		//indisponibiliza sexta
				$indisp_dia_semana[6] = true;		//indisponibiliza sabado

				if($indisp_dia_semana[$dia_semana_verifica]){
					return true;
				}else{
					return false;
				}
			}



			function indispDiasAnteriores($hoje){
				$dia_atual = date('d');
				if($hoje < $dia_atual){
					return true; //caso você defina este retorno como true, ele indisponibiliza no calendário os dias anteriores ao dia atual. 
								 //Caso seja false, ele não restringirá os dias anteriores ao dia atual
				}else{
					return false;//caso seja false, ele deixa disponivel os dias igual ou posterior ao dia atual.
								 //caso seja true, ele indisponibiliza os dias igual ou posterior ao dia atual.
				}
			}


			?>

            <table class="d-flex justify-content-center">
                <tr>
                    <th colspan="7" class="text-center">


                        <div class="mt-4 p-2 bg-primary text-white rounded">
                            <h1>
                                <?php echo $mes_atual_por_extenso; //imprime no cabeçalho da tabela o mes atual por extenso
								?>
                            </h1>

                        </div>


                    </th>
                </tr>
                <tr class="text-center">
                    <th>Dom</th>
                    <th>Seg</th>
                    <th>Ter</th>
                    <th>Qua</th>
                    <th>Qui</th>
                    <th>Sex</th>
                    <th>Sáb</th>
                </tr>

                <?php


				if ($dia_semana_mensal[1] >= 5 && $qtdDiasMesAtual > 30) { // se o dia 1 for numa sexta feira ou sabado e a quantidade de dias do mes for maior que 30

					$semanas_mensal = 5; // ele define que o mes tem 6 semanas

				} else { //se nao

					$semanas_mensal = 4; //ele define que o mes tem 5 semanas

				}


				$cont_dia = 1; // variavel que será incrementada conforme os dias forem sendo impresso. tendo limite até a quantidade de dias que o mês possui



				for ($semana = 0; $semana <= $semanas_mensal; $semana++) { //ao voce ver o calendário do windows. verá que ele possui 5 linhas, entao erá criada 5 linhas e a primeira semana se torna a $semana == 0

					echo "<tr>"; // cria uma linha na tabela

					if ($semana == 0) { //se a semana for == 0 faz referencia a uma verificação da primeira semana

						for ($dia_semana = 0; $dia_semana <= 6; $dia_semana++) { //dia semana faz referencia aos 7 dias que a semana possui, seguindo a regra do php, que começa domingo com o valor 0 e termina com o sabado com o valor 6

							if ($dia_semana < $dia_semana_mensal[1]) { //$dia_semana_mensal[1] faz referencia a que dia da semana é o dia 1 do mês atual. entao fiz uma verificação se o dia da semana do for for menor que o dia 1 do mÊs ele imprime espaço vazio

								echo "<td><button type='button' disabled class='w-100 btn btn-outline-light text-dark btn-block'>&nbsp;</button></td>";
							} else { //caso o dia da primeira semana for igual ao dia da semana do dia 1 do mes atual ele: imprime o dia 1 e começa a incrementar os dias da primeira semana

								if (verificaIndispDiaSemana($dia_semana) || indispDiasAnteriores($cont_dia)) { // verifica se a dia da semana é domingo ou sabado ou dia anterior ao dia atual e deixa estas datas indisponiveis para a seleção

									echo "<td><button type='button'  disabled class='w-100 btn btn-outline-light text-dark btn-block'>$cont_dia</button></td>";
								} else { //caso não ele deixa disponivel para seleção

									if ($dia_atual == $cont_dia) {

										echo "<td><button type='button' class='w-100 btn btn-primary btn-block'>$cont_dia</button></td>";
									} else {

										echo "<td><button type='button' class='w-100 btn btn-outline-light text-dark btn-block'>$cont_dia</button></td>";
									}
								}
								$cont_dia++; // incrementbtn-lighto de dias17px
							}
						}
					} else { // aqui imprime o restante das semanas

						for ($dia_semana = 0; $dia_semana <= 6; $dia_semana++) { // for criado para percorrer a semana, fazer verificaçõe e imprimir data

							if ($semana == $semanas_mensal && $cont_dia == $qtdDiasMesAtual) { //verifica se a semana é a ultima semana do mês, lembrando que semana começa com 0 logo semana 4 é a quinta semana

								if (verificaIndispDiaSemana($dia_semana) || indispDiasAnteriores($cont_dia)) { // verifica se a dia da semana é domingo ou sabado ou dia anterior ao dia atual e deixa estas datas indisponiveis para a seleção

									echo "<td><button type='button' disabled class='w-100 btn btn-outline-light text-dark btn-block'>$cont_dia</button></td>";
								} else { //caso não ele deixa disponivel para seleção
									if ($dia_atual == $cont_dia) {

										echo "<td><button type='button' class='w-100 btn btn-primary btn-block'>$cont_dia</button></td>";
									} else {

										echo "<td><button type='button' class='w-100 btn btn-outline-light text-dark btn-block'>$cont_dia</button></td>";
									}
								}
								$cont_dia++; //incremento de dias

							} elseif ($semana == $semanas_mensal && $cont_dia > $qtdDiasMesAtual) { //verifica se é a semana 4 e se a variavel cont_dia é maior que a quantidade de dias que este mes tem. caso seja verdadeiro, ele começa a imprimir espaços vazio

								echo "<td><button type='button'  disabled class='w-100 btn btn-outline-light text-dark btn-block'>&nbsp;</button></td>";

							} else { // se não

								if (verificaIndispDiaSemana($dia_semana) || indispDiasAnteriores($cont_dia)) { // verifica se a dia da semana é domingo ou sabado ou dia anterior ao dia atual e deixa estas datas indisponiveis para a seleção

									echo "<td><button type='button' disabled class='w-100 btn btn-outline-light text-dark btn-block'>$cont_dia</button></td>";

								} else { //caso não ele deixa disponivel para seleção
									if ($dia_atual == $cont_dia) {

										echo "<td><button type='button' class='w-100 btn btn-primary btn-block'>$cont_dia</button></td>";
									} else {

										echo "<td><button type='button' class='w-100 btn btn-outline-light text-dark btn-block'>$cont_dia</button></td>";
									}
								}
								$cont_dia++; //incremento de dias
							}
						}
					}
					echo "</tr>"; //fecha alinha na tabela
				}

				?>
            </table>
        </div>





</body>

</html>