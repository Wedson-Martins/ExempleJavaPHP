<?php

$statusSalvar = "disabled";
$statusCancelar = "disabled";

if (isset($_GET['incluir'])) {
	incluir();
}

if (isset($_GET['salvar'])) {
	if (!isset($_GET['idVoo'])) {
		salvar();
	} else {
		atualizar();
	}
}

if (isset($_GET['cancelar'])) {
	$statusSalvar = "disabled";
	$statusCancelar = "disabled";
}

if (isset($_GET['editar'])) {
	$result = buscaVoo($_GET['editar']);

	$idVoo = $result->idVoo;
	$dataVoo = $result->dataVoo;
	$custo = $result->custo;
	$distancia = $result->distancia;
	$captura = $result->captura;
	$nivelDor = $result->nivelDor;
} else {

	$idVoo = "";
	$dataVoo = "00/00/0000";
	$custo = null;
	$distancia = null;
	$captura = "";
	$nivelDor = null;
}


if (isset($_GET['excluir'])) {
	deleta();
}


function buscaVoo($id)
{
	$json = array(
		'idVoo' => $id
	);

	$url = "http://localhost:8080/voos/buscar";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POST,           1);
	curl_setopt($ch, CURLOPT_POSTFIELDS,     json_encode($json));
	curl_setopt($ch, CURLOPT_HTTPHEADER,     array('Content-Type: application/json'));
	$resultado = curl_exec($ch);
	$resultado = json_decode($resultado);
	curl_close($ch);

	return $resultado;
}


function incluir()
{
	$dataVoo = "";
	$custo = null;
	$distancia = null;
	$captura = "";
	$nivelDor = null;
	header("Location:http://localhost/test1.php");
}

function salvar()
{
	$url = "http://localhost:8080/voos";


	if (
		!empty($_GET['data']) && !empty($_GET['custo']) &&
		!empty($_GET['distancia']) && !empty($_GET['captura']) &&
		!empty($_GET['dor'])
	) {


		$json = array(
			'dataVoo' => $_GET['data'],
			'custo' => $_GET['custo'],
			'distancia' => $_GET['distancia'],
			'captura' => $_GET['captura'],
			'nivelDor' => $_GET['dor'],
		);

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL,            $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST,           1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,     json_encode($json));
		curl_setopt($ch, CURLOPT_HTTPHEADER,     array('Content-Type: application/json'));
		curl_exec($ch);

		incluir();
	} else {
		echo '<div class="alert alert-warning">Verifique se algum campo necessario está em branco.</div>';
	}
}

function atualizar()
{
	$url = "http://localhost:8080/voos";
	if (
		!empty($_GET['data']) && !empty($_GET['custo']) &&
		!empty($_GET['distancia']) && !empty($_GET['captura']) &&
		!empty($_GET['dor'])
	) {
		$ch = curl_init();

		$json = array(
			'idVoo' => $_GET['idVoo'],
			'dataVoo' => $_GET['data'],
			'custo' => $_GET['custo'],
			'distancia' => $_GET['distancia'],
			'captura' => $_GET['captura'],
			'nivelDor' => $_GET['dor'],
		);


		curl_setopt($ch, CURLOPT_URL,            $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST,           1);
		curl_setopt($ch, CURLOPT_POSTFIELDS,     json_encode($json));
		curl_setopt($ch, CURLOPT_HTTPHEADER,     array('Content-Type: application/json'));
		$result = curl_exec($ch);
		incluir();
	} else {
		echo '<div class="alert alert-warning">Verifique se algum campo necessario está em branco.</div>';
	}
}

function listarVoos()
{
	$url = "http://localhost:8080/voos";

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_URL, $url);
	$result = curl_exec($ch);

	$result = curl_exec($ch);
	return $result;
}


function deleta()
{
	$json = array(
		'idVoo' => $_GET['idVoo']
	);

	$url = "http://localhost:8080/voos/delete";
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_POST,           1);
	curl_setopt($ch, CURLOPT_POSTFIELDS,     json_encode($json));
	curl_setopt($ch, CURLOPT_HTTPHEADER,     array('Content-Type: application/json'));
	$result = curl_exec($ch);
	$result = json_decode($result);
	curl_close($ch);
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8" />

	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">







	<script>
		function alterando() {
			document.getElementById("salvar").disabled = false;
			document.getElementById("cancelar").disabled = false;
		}

		function cancelar() {
			document.getElementById("salvar").disabled = true;
			document.getElementById("cancelar").disabled = true;
		}
	</script>


	<title>Voos</title>
</head>

<body>
	<div class="container">
		<div class="container">
			<div class="row">
				<h5>ACME FLIGHT MANAGER</h5>
			</div>
			<div class="row border pr-4">
				<div class="col ">


					<table class="table">
						<thead>
							<tr>
								<th>Data</th>
								<th>Captura</th>
								<th>Nível de Dor</th>
							</tr>
						</thead>
						<tbody>
							<tr class="table-active">
								<?php
								$resultado = json_decode(listarVoos());
								?>

								<?php
								foreach ($resultado as $voo) {
									echo "<tr> ";
									echo '<td> <a href="test1.php?editar=' . $voo->idVoo . '" style="text-decoration: none"  /> ' . $voo->dataVoo . '</td>';
									echo '<td> <a href="test1.php?editar=' . $voo->idVoo . '" style="text-decoration: none"  /> ' . $voo->captura  . '</td>';
									echo '<td> <a href="test1.php?editar=' . $voo->idVoo . '" style="text-decoration: none"  /> ' . $voo->nivelDor . '</td>';
									echo "</tr> ";
								}
								?>
						</tbody>
					</table>
				</div>




				<div class="col border">

					<form method="get" onSubmit="return val()" action="test1.php" value=<?php echo $idVoo ?>>
						<div class="p-2 row mb-12">
							<div class="p-1 col-sm-6">
								<input type="submit" class="btn btn-info" name="incluir" id="incluir" value="Incluir" />
							</div>




							<div class="p-1 col-sm-6">
								<input type="submit" class="btn btn-danger" name="excluir" id="excluir" value="Excluir" />
							</div>

						</div>
						<input type="hidden" class="form-control" id="idVoo" name="idVoo" value=<?php echo $idVoo; ?>></input>
						<div class="row mb-3">
							<label class="col-sm-2 col-form-label">Data</label>
							<div class="col-sm-10">
								<input type="date" class="form-control" id="data" name="data" onfocus="alterando();" value=<?php echo $dataVoo ?>></input>
							</div>
						</div>

						<div class="row mb-3">
							<label class="col-sm-2 col-form-label">Custo</label>
							<div class="col-sm-10">
								<input type="text" class="form-control" id="custo" name="custo" onfocus="alterando();" value=<?php echo $custo; ?>></input>
							</div>
						</div>

						<div class="row mb-3">
							<label class="col-sm-3 col-form-label">Distância</label>
							<div class="col-sm-9">
								<input type="text" class="form-control" id="distancia" name="distancia" onfocus="alterando();" value=<?php echo $distancia; ?>></input>
							</div>
						</div>

						<fieldset class="row mb-3">
							<div class="row mb-12">
								<label class="col-sm-4 form-check">Captura</label>
								<div class="col-sm-4">
									<div class="form-check">
										<input class="form-check-input" type="radio" name="captura" onfocus="alterando();" id="nao" value="N" <?php echo ($captura == 'N' ? 'checked' : ''); ?>></input>
										<label class="form-check-label" for="gridRadios1">
											Não
										</label>
									</div>
								</div>
								<div class="col-sm-4">
									<div class="form-check">
										<input class="form-check-input" type="radio" name="captura" onfocus="alterando();" id="sim" value="S" <?php echo ($captura == 'S' ? 'checked' : ''); ?>></input>
										<label class="form-check-label" for="gridRadios2">
											sim
										</label>
									</div>
								</div>
							</div>
						</fieldset>

						<div class="row mb-3">
							<label class="col-sm-4 col-form-label">Nível dor</label>
							<div class="col-sm-8">
								<input type="text" class="form-control" id="dor" name="dor" onfocus="alterando();" value=<?php echo $nivelDor; ?>></input>
							</div>
						</div>

						<input type="submit" class="p-1 btn btn-success" name="salvar" id="salvar" value="Salvar" <?php echo $statusSalvar; ?> />
						<input type="submit" class="p-1 btn btn-secondary" name="cancelar" id="cancelar" value="Cancelar" <?php echo $statusCancelar; ?> />
					</form>
				</div>
			</div>
		</div>
	</div>
</body>

</html>