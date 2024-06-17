<?php
// Função para obter dados detalhados do Firebase
function getData($url) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url . '.json');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    curl_close($ch);
    
    if ($response === false) {
        die('Erro ao conectar ao Firebase: ' . curl_error($ch));
    }

    $data = json_decode($response, true);

    // Verifica se há erro na resposta
    if (isset($data['error'])) {
        die('Erro ao obter dados do Firebase: ' . $data['error']);
    }

    // Caso não haja dados, retornar um array vazio para evitar null
    return $data ?: [];
}

// URLs para as diferentes categorias
$firebaseUrl = 'https://anossa-horta-default-rtdb.firebaseio.com/';
$categories = ['verduras', 'legumes', 'frutas'];
$items = [];

// Obtendo dados para cada categoria
foreach ($categories as $category) {
    $items[$category] = getData($firebaseUrl . $category);
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Informações de Produtos</title>
    <style>
        body { font-family: Arial, sans-serif; }
        ul { list-style-type: none; padding: 0; }
        li { padding: 10px; margin: 5px; background: #f0f0f0; cursor: pointer; }
        .popup { display: none; position: fixed; left: 50%; top: 50%; transform: translate(-50%, -50%); padding: 20px; background: white; border: 1px solid #ccc; }
        .popup-content { margin-bottom: 20px; }
        .close { cursor: pointer; color: red; }
    </style>
    <script src="js/script.js"></script>
</head>
<body>

<?php foreach ($items as $category => $categoryItems): ?>
    <?php if (is_array($categoryItems) && !empty($categoryItems)): ?>
        <h1><?php echo ucfirst($category); ?></h1>
        <ul>
            <?php foreach ($categoryItems as $item): ?>
                <li onclick="showPopup('<?php echo htmlentities(json_encode($item)); ?>')">
                    <?php echo $item['nome']; ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
<?php endforeach; ?>

<div id="popup" class="popup">
    <div id="popup-content" class="popup-content"></div>
    <button class="close" onclick="closePopup()">Fechar</button>
</div>

<script>
    function showPopup(info) {
        var item = JSON.parse(info);
        var popup = document.getElementById('popup');
        var content = document.getElementById('popup-content');

        content.innerHTML = `
            <p><strong>Nome:</strong> ${item.nome}</p>
            <p><strong>Rega:</strong> ${item.rega}</p>
            <p><strong>Tempo de Cultivo:</strong> ${item.tempo_de_cultivo}</p>
            <p><strong>Sol:</strong> ${item.sol}</p>
            <p><strong>Vitamina A:</strong> ${item.vitaminaA}</p>
            <p><strong>Vitamina B:</strong> ${item.vitaminaB}</p>
            <p><strong>Vitamina C:</strong> ${item.vitaminaC}</p>
            <p><strong>Ferro:</strong> ${item.ferro}</p>
            <p><strong>Cálcio:</strong> ${item.calcio}</p>
        `;
        popup.style.display = 'block';
    }

    function closePopup() {
        document.getElementById('popup').style.display = 'none';
    }
</script>

</body>
</html>
