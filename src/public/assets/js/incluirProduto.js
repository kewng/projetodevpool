class ProdutoEvents {
    
	clickButtonCancel() {
		var button = document.querySelector('button[name="cancelar-button"]');

		button.addEventListener('click', function() {
            window.location.replace("produtos.php");
        });
    }

	clickButtonSave() {
		var button = document.querySelector('button[name="salvar-button"]');

		button.addEventListener('click', function() {
			var nome = document.querySelector('input[name=nome]');
            var descricao = document.querySelector('input[name=descricao]');
            var preco = document.querySelector('input[name=preco]');
            var unidade = document.querySelector('input[name=unidade]');
            var situacao = document.getElementById('situacao');

            if (nome.value == '') {
				alert('Nome deve ser informado.');

				return false;
			}

            if (preco.value == '') {
				alert('O preço deve ser informado.');

				return false;
			}

			if (situacao.value === null || situacao.value == '' || situacao.value === 'Selecionar') {
				alert('A situação do produto deve ser selecionada.');

				return false;
			}

			var formData = new FormData();

			formData.append('nome', nome.value);
			formData.append('descricao', descricao.value);
			formData.append('preco', preco.value);
			formData.append('unidadeMedida', unidade.value);
			formData.append('situacao', situacao.value);

            if (typeof button.id !== 'undefined' && button.id.includes('save_')) {
                formData.append('id', button.id.split('save_')[1]);
            }


			fetch('incluirProduto.php', {
				method: 'POST',
				body: formData,
			})
			.then((response) => response.json())
			.then(function(responseBody) {
				if (responseBody.tipo == 'success') {
					alert(responseBody.mensagem);
					
                    window.location.replace("produtos.php");
				}

				return responseBody;
			})
			.catch(function(err) {
				alert(err.toString());
				console.log('Não foi possível realizar a requisição: ');
				console.log("Error", err.stack);
				console.log("Error", err.name);
				console.log("Error", err.message);
			})
		});
	}
}

function loadProductEditor() {
	var url = document.URL;
	if (url.includes('id=')) {
		var formData = new FormData();
		const id = url.split('id=')[1]; 

		fetch('incluirProduto.php?idLoad=' + id, {
			method: 'GET',
		})
		.then((response) => response.json())
		.then(function(responseBody) {
			if (responseBody.tipo === 'success') {
				updateProductPage(responseBody.produto[0]);
			}
		})
		.catch(function(err) {
			alert(err.toString());
			console.log('Não foi possível realizar a requisição: ');
			console.log("Error", err.stack);
			console.log("Error", err.name);
			console.log("Error", err.message);
		});
	}
}

function updateProductPage(element) {
    document.getElementById('nome').value = element.nome;
    document.getElementById('descricao').value = element.descricao;
    document.getElementById('preco').value = element.preco;
    document.getElementById('unidade').value = element.unidadeMedida;

    if (element.situacao === 'a') {
        document.getElementById('situacao').selectedIndex = 1;
    } else {
        document.getElementById('situacao').selectedIndex = 2;
    }

    document.querySelector('button[name="salvar-button"]').id = 'save_' + element.id;
	
}



/**
 * Executa ao terminar de carregar a tela.
 */
window.onload = function() {
	var events = new ProdutoEvents();

	events.clickButtonSave();
    events.clickButtonCancel();

	loadProductEditor();
}