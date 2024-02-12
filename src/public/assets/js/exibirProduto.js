function carregarProdutos() {
	console.log("atualizando produtos");
    fetch('produtos.php?buscar=todos', {
        method: 'GET',
    })
    .then((response) => response.json())
    .then(function(responseBody) {
        if (responseBody.totalRegistros > 0) {
            var exemploView = new ProdutosView();

            exemploView.montarProdutos(responseBody.dados);
        }
    })
    .catch(function(err) {
        console.log('Não foi possível realizar a requisição: ', err);
    })
}

function clickButtonDelete() {
	var button = document.getElementById('delete-button');

	
	button.addEventListener('click', function() {
		var selectAll = document.getElementById('select-all');
		var toDelete = [];
		
		var formData = new FormData();

		if (selectAll.checked) {
			formData.append('all', true);
		} else {
			formData.append('all', false);

			var table = document.getElementById('table-produtos');
			var rows = table.rows;

			for (var i = 0; i < rows.length; i++) {
				var selectBox = rows[i].cells[0].children[0];
				
				if (selectBox.checked) {
					toDelete.push(selectBox.id.replace("produto_", ""));
				}
			}

			if (toDelete.length === 0) return true;
		}
		
		formData.append('ids', JSON.stringify(toDelete));

		fetch('produtos.php', {
			method: 'POST',
			body: formData,
		})
		.then((response) => response.json())
		.then(function(responseBody) {
			alert(responseBody.mensagem);
			
			window.location.replace("produtos.php");
			
			return responseBody;
		})
		.catch(function(err) {
			alert(err.toString());
			console.log('Não foi possível realizar a requisição: ');
			console.log("Error", err.stack);
			console.log("Error", err.name);
			console.log("Error", err.message);
		});
	});

}


class ProdutosView {
	montarProdutos(dados) {
		const tbody = document.getElementById('table-body');
		tbody.innerHTML = '';

		sortArray(dados);

		dados.forEach(element => {
			let bodyTR = document.createElement('tr');

			let auxTD = document.createElement('td');
			
			let bodyTD = document.createElement('input');
			bodyTD.id = "produto_" + element.id;
			bodyTD.type = "checkbox";
			bodyTD.className = "check";
			auxTD.appendChild(bodyTD);

			bodyTR.appendChild(auxTD);


			bodyTD = document.createElement('td');
			bodyTD.innerHTML = element.nome
			bodyTR.appendChild(bodyTD);

			bodyTD = document.createElement('td');
			bodyTD.innerHTML = element.preco;
			bodyTR.appendChild(bodyTD);

            bodyTD = document.createElement('td');
			bodyTD.innerHTML = element.situacao;
			bodyTR.appendChild(bodyTD);


			bodyTD = document.createElement('button');
            bodyTD.innerHTML = '<i class="fa fa-edit" aria-hidden="true"></i>';
			bodyTD.type = "button";
			bodyTD.addEventListener('click', function() {
				window.location.replace("incluirProduto.php?id=" + element.id);
			});
			bodyTR.appendChild(bodyTD);

			tbody.appendChild(bodyTR);
		});
	}
}

function sortArray(dados) {
	var sort = document.getElementById('ordenar').value;
	var situacao = document.getElementById('situacao').value;

	dados.sort(function(a, b){
		switch (sort) {
			case 'id':
				return a.id - b.id;
			case 'nome':
				return a.nome.toLowerCase().localeCompare(b.nome.toLowerCase());
			case 'preco':
				return a.preco - b.preco;
		}
		
		return 0;
	});

	if (situacao !== 'all') {
		for (var i = dados.length-1; i >= 0; i--) {
			var valid = 'a';
			switch (situacao) {
				case 'inative':
					valid = 'i';
					break;
			}

			if (dados[i].situacao !== valid) {
				delete dados[i];
			}
		}
	}
	
}

window.onload = function() {
	document.getElementById('ordenar').addEventListener('change', function () {
		carregarProdutos();
	});

	document.getElementById('situacao').addEventListener('change', function () {
		carregarProdutos();
	});

	carregarProdutos();
	clickButtonDelete();
}