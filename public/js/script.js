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