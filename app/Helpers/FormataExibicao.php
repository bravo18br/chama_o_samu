<?php

namespace App\Helpers;

// Para usar esse helper, vá no composer.json e adicione o arquivo em files, conforme exemplo:
// 	"autoload": {
//         "psr-4": {
//             "App\\": "app/",
//             "Database\\Factories\\": "database/factories/",
//             "Database\\Seeders\\": "database/seeders/",
//         },
//         "files": [
//             "files": [
//    			 	"app/Helpers/Log.php",
//  			  	"app/Helpers/FormataExibicao.php"
// 						]
//         ]
//     },
// Após editar o composer.json, rodar o comando: composer dump-autoload
// Exemplo de como usar no blade:
// 						@php
//                     $formataExibicao = new App\Helpers\FormataExibicao;
//                     @endphp
//                     <p>CEP: {{ $formataExibicao->cep($chamado->user->cep) }}</p>



class FormataExibicao
{
	public function cep($cep)
	{
		$numbers = self::limparEntrada($cep);

		if (strlen($numbers) == 8)
			return preg_replace('/^(\d{2})(\d{3})(\d{3})$/', '${1}.${2}-${3}', self::limparEntrada($numbers));


		return NULL;
	}
	public function cnpj($cnpj)
	{
		$numbers = self::limparEntrada($cnpj);

		if (strlen($numbers) == 14)
			return preg_replace('/^(\d{2})(\d{3})(\d{3})(\d{4})(\d{2})$/', '${1}.${2}.${3}/${4}-${5}', self::limparEntrada($numbers));

		return NULL;
	}
	public function cpf($cpf)
	{
		$numbers = self::limparEntrada($cpf);

		if (strlen($numbers) == 11)
			return preg_replace('/^(\d{3})(\d{3})(\d{3})(\d{2})$/', '${1}.${2}.${3}-${4}', self::limparEntrada($numbers));

		return NULL;
	}
	public function data_hora($data)
	{
		return $data->format('d/m/y H:i');
	}
	public function data($data)
	{
		return $data->format('d/m/y');
	}
	public function hora($data)
	{
		return $data->format('H:i');
	}
	public function celular($data)
	{
		$numeroLimpo = self::limparEntrada($data);
		$numeroFormatado = preg_replace('/^(\d{2})(\d{1})(\d{4})(\d{4})$/', '($1) $2 $3-$4', $numeroLimpo);
		return $numeroFormatado;
	}
	private static function limparEntrada($entrada)
	{
		return preg_replace('/[^0-9]/', '', $entrada);
	}
}
