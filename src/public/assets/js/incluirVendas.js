class VendaEvents {
    
	clickButtonCancel() {
		var button = document.querySelector('button[name="cancelar-button"]');

		button.addEventListener('click', function() {
            window.location.replace("vendas.php");
        });
    }

	clickButtonSave() {
		var button = document.querySelector('button[name="salvar-button"]');

		button.addEventListener('click', function() {
			var nome = document.querySelector('input[name=nome]');
            var dataVenda = document.querySelector('input[name=data]');
            var subtotal = document.querySelector('input[name=subtotal]');
            var desconto = document.querySelector('input[name=desconto]');
			var totalVenda = document.querySelector('input[name=total]');

            if (nome.value == '') {
				alert('Nome do cliente deve ser informado.');

				return false;
			}

			if (dataVenda.value === '') {
				alert('Uma data deve ser selecionada.');

				return false;
			}

			var formData = new FormData();

			formData.append('nome', nome.value);
			formData.append('dataVenda', dataVenda.value);
			formData.append('subtotal', subtotal.value);
			formData.append('desconto', desconto.value);
			formData.append('totalVenda', totalVenda.value);
			formData.append('produtos', JSON.stringify(getAlreadyInProdutos(), replacer));
			
            if (typeof button.id !== 'undefined' && button.id.includes('save_')) {
                formData.append('id', button.id.split('save_')[1]);
            }


			fetch('incluirVendas.php', {
				method: 'POST',
				body: formData,
			})
			.then((response) => response.json())
			.then(function(responseBody) {
				if (responseBody.tipo == 'success') {
					alert(responseBody.mensagem);
					
                    window.location.replace("vendas.php");
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

	incluirProduto() {
		var button = document.getElementById('incluir');

		button.addEventListener('click', function() {
			var produtoId = document.getElementById('produtos').value;
			var map = getAlreadyInProdutos();

			if (map.has(produtoId)) {
				carregarProdutosAdicionados(map.get(produtoId), 1);
			} else {
				loadAndSendToProcess(produtoId, 1);
			}

		});
	}
}

function replacer(key, value) {
	if(value instanceof Map) {
		return {
			dataType: 'Map',
			value: Array.from(value.entries()), // or with spread: value: [...value]
	  	};
	} else {
	  	return value;
	}
}

function reviver(key, value) {
	if(typeof value === 'object' && value !== null) {
		if (value.dataType === 'Map') {
			return new Map(value.value);
	  	}
	}
	return value;
  }

function loadAndSendToProcess(id, amount) {
	fetch('incluirProduto.php?idLoad=' + id, {
		method: 'GET',
	})
	.then((response) => response.json())
	.then(function(responseBody) {
		if (responseBody.tipo === 'success') {
			console.log(responseBody.produto[0]);

			carregarProdutosAdicionados(responseBody.produto[0], amount);
		}

		return null;
	})
	.catch(function(err) {
		alert(err.toString());
		console.log('Não foi possível realizar a requisição: ');
		console.log("Error", err.stack);
		console.log("Error", err.name);
		console.log("Error", err.message);
	});
}

function carregarProdutosAdicionados(produto, amount) {
	var map = getAlreadyInProdutos();

	if (map.has(produto.id)) {
		var temp = map.get(produto.id);

		temp.quantidade = parseInt(temp.quantidade) + amount;
	} else {
		produto.quantidade = amount;
		map.set(produto.id, produto);
	}

	var table = document.getElementById('table-body');
	table.innerHTML = '';

	map.forEach(function fun(value, key, map) {
		if (value.quantidade <= 0) return;
 
		let bodyTR = document.createElement('tr');
		bodyTR.id = value.id;

		let bodyTD = document.createElement('td');
		bodyTD.innerHTML = value.nome;
		bodyTR.appendChild(bodyTD);

		bodyTD = document.createElement('td');
		bodyTD.innerHTML = value.preco;
		bodyTR.appendChild(bodyTD);

		bodyTD = document.createElement('td');
		bodyTD.innerHTML = value.quantidade;
		bodyTR.appendChild(bodyTD);

		bodyTD = document.createElement('button');
		bodyTD.innerHTML = '<i class="fa fa-trash" aria-hidden="true"></i>';
		bodyTD.type = "button";
		bodyTD.addEventListener('click', function() {
			var tempProduto = {id: value.id};
			carregarProdutosAdicionados(tempProduto, -1);
		});
		bodyTR.appendChild(bodyTD);
		
		table.appendChild(bodyTR);
	});

	updateCurrentTotalValue();
}

function updateCurrentTotalValue() {
	var map = getAlreadyInProdutos();
	var total = 0;
	var desconto = 0;

	try {
		var val = document.getElementById('desconto').value;
		desconto = parseInt(val);

		if (!Number.isInteger(desconto)) {
			desconto = 0;
		}
	} catch (e) {
		desconto = 0;
	}

	map.forEach(function fun(value, key, map) {
		total += parseFloat(value.quantidade) * parseFloat(value.preco);
	});

	document.getElementById('subtotal').value = total;
	document.getElementById('total').value = total * (1-(desconto/100));
}

function getAlreadyInProdutos() {
	const map = new Map();
	var table = document.getElementById('table-produtos');
	var rows = table.rows;

	for (var i = 1; i < rows.length; i++) {
		var nome = rows[i].cells[0].innerHTML;
		var preco = rows[i].cells[1].innerHTML;
		var quantidade = rows[i].cells[2].innerHTML;
		var id = rows[i].id;

		var produto = {id: id, nome: nome, preco: preco, quantidade: quantidade};

		console.log(produto);

		map.set(id, produto);
	}

	return map;
}

function loadProductsList() {
	fetch('produtos.php?buscar=todos', {
        method: 'GET',
    })
    .then((response) => response.json())
    .then(function(responseBody) {
        if (responseBody.totalRegistros > 0) {
			const select = document.getElementById('produtos');
			var dados = responseBody.dados;
			
			dados.forEach(element => {
				var opt = document.createElement('option');

				opt.value = element.id;
				opt.innerHTML = element.nome;

				select.appendChild(opt);
			});
        }
    })
    .catch(function(err) {
        console.log('Não foi possível realizar a requisição: ', err);
    })
}

function loadVendaEditor() {
	var url = document.URL;
	console.log(url);
	if (url.includes('id=')) {
		var formData = new FormData();
		const id = url.split('id=')[1]; 

		fetch('incluirVendas.php?idLoad=' + id, {
				method: 'GET',
			})
			.then((response) => response.json())
			.then(function(responseBody) {
				if (responseBody.tipo === 'success') {
					updateProductPage(responseBody.venda[0]);
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
    document.getElementById('data').value = element.dataVenda.split(" ")[0];
    document.getElementById('subtotal').value = element.subtotal;
    document.getElementById('desconto').value = element.desconto;
	document.getElementById('total').value = element.totalVenda;

	var map = JSON.parse(element.produtos, reviver);

	map.forEach(function fun(value, key, map) {
		carregarProdutosAdicionados(value, value.quantidade);
	});

    document.querySelector('button[name="salvar-button"]').id = 'save_' + element.id;
	
}

window.onload = function() {
	var events = new VendaEvents();

	events.clickButtonSave();
    events.clickButtonCancel();
	events.incluirProduto();
	
	document.getElementById('desconto').addEventListener('change', function () {
		updateCurrentTotalValue();
	});

	loadVendaEditor();
	loadProductsList();
}