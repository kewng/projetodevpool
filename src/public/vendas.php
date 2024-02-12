<?php
	include('../app/cfg/cfgListarVendas.php');
?>

<!DOCTYPE html>
<html lang="PT-BR">
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>ERP da Kew</title>
		<link rel="stylesheet" type="text/css" href="assets/css/produtos.css">
        <script src="https://kit.fontawesome.com/fca9e7075b.js" crossorigin="anonymous"></script>
	</head>

    <body>
        <div class="container">
            <header class="header">
                <div class="header-content">
                    <h1 class="title">ERP!</h1>

                    <nav class="menu">
                        <div class="menu-nav">
                            <ul>
                                <li><a href="index.php">home</a></li>
                                <li><a href="produtos.php">produtos</a></li>
                                <li><a href="vendas.php">vendas</a></li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </header>

            <aside class="filter">
                <h2 class="subtitle-produto">Filtros:</h2>
                <div class="filter-container">
                <form action="incluirvendas.php" class="button" method="post">
                        <input type="submit" name="button-incluir" class="novo" value="Incluir novo">
                    </form>

                    <label for="data" >situação:</label><br>
                    <form>
                        <input type="date" class="data" id="data" name="data">
                    </form>

                    <label for="ordenar">ordenar por:</label><br>
                    <select name="ordenar" id="ordenar" class="ordenar">
                        <option value="id">Selecionar</option>
                        <option value="nome">Nome</option>
                        <option value="preco">Preço</option>
                    </select>
                </div>
            </aside>    

            <main class="home principal">
                <div class="search-container">
                    <form>
                        <label for="search" class="title-produto">vendas</label>
                        <input type="search" class="search" id="search" name="search" placeholder="número da venda" class="search-bar">
                        <button class="search-button"><i class="fa fa-search"></i></button>
                        <button class="search-button" type="button" id="delete-button"><i class="fa fa-trash"></i></button>
                    </form>
                </div>

                <div class="dados-produtos">
                    <div class="dados-group">
                        <table class="table-produtos" id="table-produtos">
                            <thead class="listagem-produtos">
                                <th><input type="checkbox" class="check" id="select-all"></th>
                                <th>cliente</th>
                                <th>data</th>
                                <th>valor total</th>
                                <th><i class="fa fa-edit"></i></th>
                            </thead>
                            
                            <tbody class="table-body" id="table-body">
                        </table>
                    </div>
		        </div>

            </main> 

            <footer class="footer">
                    Portfolio pessoal &copy Kellen 2022. 
                </footer>
            </div>
        </div>
	</body>
	
    <script type="text/javascript" src="assets/js/exibirVendas.js"></script>
</html>