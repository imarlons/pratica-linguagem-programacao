<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="styles.css">
    <title>Sistema de Veículos</title>
</head>

<body>

    <div class="container">
        <h1>[ Sistema de Veículos ]</h1>
        <div class="forms-wrapper">
            <form method="POST">
                <h2>Criar "Carro"</h2>
                <input type="hidden" name="tipo" value="carro">
                <label for="marca_carro">Marca:</label>
                <input type="text" name="marca" id="marca_carro" required value="Porsche">
                <label for="modelo_carro">Modelo:</label>
                <input type="text" name="modelo" id="modelo_carro" required value="911">
                <label for="portas">Portas:</label>
                <input type="number" name="portas" id="portas" required value="2">
                <button type="submit">Criar Carro</button>
            </form>

            <form method="POST">
                <h2>Criar "Moto"</h2>
                <input type="hidden" name="tipo" value="moto">
                <label for="marca_moto">Marca:</label>
                <input type="text" name="marca" id="marca_moto" required value="Honda">
                <label for="modelo_moto">Modelo:</label>
                <input type="text" name="modelo" id="modelo_moto" required value="Hornet">
                <label for="cilindradas">Cilindradas:</label>
                <input type="number" name="cilindradas" id="cilindradas" required value="750">
                <button type="submit">Criar Moto</button>
            </form>

            <form method="POST">
                <h2>Criar "Caminhão"</h2>
                <input type="hidden" name="tipo" value="caminhao">
                <label for="marca_caminhao">Marca:</label>
                <input type="text" name="marca" id="marca_caminhao" required value="Volvo">
                <label for="modelo_caminhao">Modelo:</label>
                <input type="text" name="modelo" id="modelo_caminhao" required value="FH500">
                <label for="capacidade">Carga (Toneladas):</label>
                <input type="number" name="capacidadeCarga" id="capacidade" step="0.1" required value="30">
                <button type="submit">Criar Caminhão</button>
            </form>
        </div>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            require_once 'veiculo.php';
            require_once 'carro.php';
            require_once 'moto.php';
            require_once 'caminhao.php';

            $tipo = $_POST['tipo'] ?? '';
            $marca = htmlspecialchars($_POST['marca'] ?? '');
            $modelo = htmlspecialchars($_POST['modelo'] ?? '');
            $veiculo = null;

            if ($tipo === 'carro') {
                $portas = (int)($_POST['portas'] ?? 0);
                $veiculo = new Carro($marca, $modelo, $portas);
            } elseif ($tipo === 'moto') {
                $cilindradas = (int)($_POST['cilindradas'] ?? 0);
                $veiculo = new Moto($marca, $modelo, $cilindradas);
            } elseif ($tipo === 'caminhao') {
                $capacidade = (float)($_POST['capacidadeCarga'] ?? 0);
                $veiculo = new Caminhao($marca, $modelo, $capacidade);
            }

            if ($veiculo) {
                echo '<div class="resultado">';
                echo '<strong>Informações do Veículo Criado:</strong><br>';
                echo $veiculo->info();
                echo '</div>';
            }
        }
        ?>
    </div>

</body>

</html>