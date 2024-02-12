<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_NOTICE | E_WARNING | E_ERROR );

require_once(dirname(__DIR__).'/model/cadastroProdutoModel.php');

require_once(dirname(__DIR__).'/services/cadastroProdutoService.php');
