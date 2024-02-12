<?php
	include('../app/cfg/cfgListarProdutos.php');
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
                    <form action="incluirProduto.php" class="button" method="post">
                        <input type="submit" name="button-incluir" class="novo" value="Incluir novo">
                    </form>
                    
                    <form>
                        <label for="situacao" >situação:</label><br>
                        <select name="situacao" id="situacao" class="situacao">
                            <option value="all">Todas</option>
                            <option value="ative">Ativo</option>
                            <option value="inative">Inativo</option>
                        </select><br>
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
                    <form class="search-cfg">
                        <label for="search" class="title-produto">produtos</label>
                        <input type="search" class="search" id="search" name="search" placeholder="nome do produto" class="search-bar">
                        <button class="search-button" type="button"><i class="fa fa-search"></i></button>
                        <button type="button" id="delete-button"><i class="fa fa-trash"></i></button>
                    </form>
                </div>

                <div class="dados-produtos">
                    <div class="dados-group">
                        <table class="table-produtos" id="table-produtos">
                            <thead class="listagem-produtos" id="listagem-produtos">
                                <th><input type="checkbox" class="check" id="select-all"></th>
                                <th>nome</th>
                                <th>preço</th>
                                <th>situação</th>
                                <th><button type="button" class="search-button" id="edit-button"><i class="fa fa-edit"></i></button></th>
                            </thead>
                            
                            <tbody class="table-body" id="table-body">
                            </tbody>
                            
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

    <script type="text/javascript" src="assets/js/exibirProduto.js"></script>
	
</html>