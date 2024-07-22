<?php

namespace Database\Seeders;

use App\Models\Cartao;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Tigo\DocumentBr\Cpf; 

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $users_lista_teste = [[
            'email_verified_at' => now(),
            'name' => 'SUPER Admin',
            'email' => 'super_admin@gmail.com',
            'password' => bcrypt('12345678'),
            'cpf' => '89170186022',
            'cep' => '83709150',
            'rua' => 'Carlos Vicente Zapxon',
            'numero' => '1300',
            'complemento' => 'casa23',
            'celular' => '41984191656',
            'role' => 1,
            'analfabeto' => 0
        ], [
            'email_verified_at' => now(),
            'name' => 'Operador SAMU',
            'email' => 'operador_samu@gmail.com',
            'password' => bcrypt('12345678'),
            'cpf' => '39096471032',
            'cep' => '83709150',
            'rua' => 'Carlos Vicente Zapxon',
            'numero' => '1300',
            'complemento' => 'casa23',
            'celular' => '41984191656',
            'role' => 2,
            'analfabeto' => 0
        ], [
            'email_verified_at' => now(),
            'name' => 'USER ALFAbetizado',
            'email' => 'user_alfa@gmail.com',
            'password' => bcrypt('12345678'),
            'cpf' => '75637120030',
            'cep' => '83709150',
            'rua' => 'Carlos Vicente Zapxon',
            'numero' => '1300',
            'complemento' => 'casa23',
            'celular' => '41984191656',
            'role' => 3,
            'analfabeto' => 0
        ], [
            'email_verified_at' => now(),
            'name' => 'USER ANALFAbeto',
            'email' => 'user_analfa@gmail.com',
            'password' => bcrypt('12345678'),
            'cpf' => '32637120030',
            'cep' => '83709150',
            'rua' => 'Carlos Vicente Zapxon',
            'numero' => '1300',
            'complemento' => 'casa23',
            'celular' => '41984191656',
            'role' => 3,
            'analfabeto' => 1
        ], [
            'email_verified_at' => now(),
            'name' => 'SAMU Admin',
            'email' => 'samu_admin@gmail.com',
            'password' => bcrypt('12345678'),
            'cpf' => '39096471992',
            'cep' => '83709150',
            'rua' => 'Carlos Vicente Zapxon',
            'numero' => '1300',
            'complemento' => 'casa23',
            'celular' => '41984191656',
            'role' => 4,
            'analfabeto' => 0
        ]];

        $faker = Faker::create();
        $users_lista_faker = [];
        $total_fakes = 100;
        for ($i = 0; $i < $total_fakes; $i++) {
            $cpf = new Cpf();
        
            // Defina a porcentagem desejada para cada role
            $percentRole1 = 0.02; // 2%
            $percentRole2 = 0.02; // 2%
            $percentRole4 = 0.02; // 2%
            $percentRole3 = 0.94; // 94%
        
            // Calcule o número de usuários para cada role
            $numRole1 = round($percentRole1 * $total_fakes);
            $numRole2 = round($percentRole2 * $total_fakes);
            $numRole4 = round($percentRole4 * $total_fakes);
            $numRole3 = $total_fakes - ($numRole1 + $numRole2 + $numRole4);
        
            // Inicialize o campo 'role' como role3 (a maioria)
            $role = 3;
        
            // Distribua as roles conforme as porcentagens
            if ($i < $numRole1) {
                $role = 1;
            } elseif ($i < ($numRole1 + $numRole2)) {
                $role = 2;
            } elseif ($i < ($numRole1 + $numRole2 + $numRole4)) {
                $role = 4;
            }
        
            // Crie o usuário fictício
            $fakerUser = [
                'email_verified_at' => $faker->dateTimeThisDecade,
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => bcrypt('password'), // Pode gerar uma senha aleatória se preferir
                'cpf' => $cpf->generate(), // CPF fictício
                'cep' => $faker->numerify('837#####'), // CEP fictício
                'rua' => $faker->streetName, // Rua fictícia
                'numero' => $faker->buildingNumber, // Número do endereço fictício
                'complemento' => $faker->secondaryAddress, // Complemento fictício do endereço
                'celular' => $faker->numerify('419########'), // Número de celular fictício
                'role' => $role, // Role conforme a distribuição
                'analfabeto' => $faker->boolean // Valor aleatório para 'analfabeto'
            ];
        
            $users_lista_faker[] = $fakerUser;
        }
        

        foreach (array_merge($users_lista_teste, $users_lista_faker) as $user) {
            $existingUser = User::where('cpf', $user['cpf'])->first();
            if (!$existingUser) {
                User::create($user);
            } else {
                $existingUser->update($user);
            }
        }

        $cartoes_lista = [
            [
                'nivel' => 'voltar',
                'legenda_user' => 'Voltar',
                'legenda_samu' => 'Botão voltar',
                'imagem_nome' => 'botao-voltar.png',
                'imagem_caminho' => 'public/images/botao-voltar.png',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nivel' => 'cancelar',
                'legenda_user' => 'Cancelar',
                'legenda_samu' => 'Cancelar',
                'imagem_nome' => 'botao-cancelar.svg',
                'imagem_caminho' => 'public/images/botao-cancelar.svg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nivel' => 'raiz',
                'legenda_user' => 'Chamar SAMU',
                'legenda_samu' => 'Preciso de ajuda!',
                'imagem_nome' => 'chamarSAMU.svg',
                'imagem_caminho' => 'public/images/chamarSAMU.svg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nivel' => 'avancar',
                'legenda_user' => 'Avançar',
                'legenda_samu' => 'Avançar',
                'imagem_nome' => 'botao-avancar.png',
                'imagem_caminho' => 'public/images/botao-avancar.png',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nivel' => 'nivel1',
                'legenda_user' => 'Emergência na rua',
                'legenda_samu' => 'É uma emergência na rua',
                'imagem_nome' => 'paisagem-rua.jpg',
                'imagem_caminho' => 'public/images/paisagem-rua.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nivel' => 'nivel1',
                'legenda_user' => 'Emergência em casa',
                'legenda_samu' => 'É uma emergência em casa',
                'imagem_nome' => 'paisagem-casa.jpg',
                'imagem_caminho' => 'public/images/paisagem-casa.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nivel' => 'nivel2',
                'legenda_user' => 'Emergência com criança',
                'legenda_samu' => 'Envolve uma criança',
                'imagem_nome' => 'acidente-crianca.png',
                'imagem_caminho' => 'public/images/acidente-crianca.png',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nivel' => 'nivel2',
                'legenda_user' => 'Emergência com adulto',
                'legenda_samu' => 'Envolve um adulto',
                'imagem_nome' => 'acidente-adulto.png',
                'imagem_caminho' => 'public/images/acidente-adulto.png',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nivel' => 'nivel2',
                'legenda_user' => 'Emergência com idoso',
                'legenda_samu' => 'Envolve um idoso',
                'imagem_nome' => 'acidente-idoso.png',
                'imagem_caminho' => 'public/images/acidente-idoso.png',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nivel' => 'nivel3',
                'legenda_user' => 'Afogamento',
                'legenda_samu' => 'Aguém afogado',
                'imagem_nome' => 'acidente-afogamento.jpg',
                'imagem_caminho' => 'public/images/acidente-afogamento.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nivel' => 'nivel3',
                'legenda_user' => 'Briga',
                'legenda_samu' => 'Feridos em briga',
                'imagem_nome' => 'acidente-briga.jpg',
                'imagem_caminho' => 'public/images/acidente-briga.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nivel' => 'nivel3',
                'legenda_user' => 'Acidente com bicicleta',
                'legenda_samu' => 'Acidente envolvendo ciclista',
                'imagem_nome' => 'acidente-carro_bicicleta.jpg',
                'imagem_caminho' => 'public/images/acidente-carro_bicicleta.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nivel' => 'nivel3',
                'legenda_user' => 'Acidente com moto',
                'legenda_samu' => 'Acidente envolvendo motociclista',
                'imagem_nome' => 'acidente-carro_moto.jpg',
                'imagem_caminho' => 'public/images/acidente-carro_moto.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nivel' => 'nivel3',
                'legenda_user' => 'Pessoa atropelada',
                'legenda_samu' => 'Alguém foi atropelado',
                'imagem_nome' => 'acidente-carro_pessoa.jpg',
                'imagem_caminho' => 'public/images/acidente-carro_pessoa.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nivel' => 'nivel3',
                'legenda_user' => 'Choque elétrico',
                'legenda_samu' => 'Alguém sofreu choque elétrico',
                'imagem_nome' => 'acidente-eletrica.jpg',
                'imagem_caminho' => 'public/images/acidente-eletrica.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nivel' => 'nivel3',
                'legenda_user' => 'Engasgado na garganta',
                'legenda_samu' => 'Alguém engasgado com algo',
                'imagem_nome' => 'acidente-engasgo.jpg',
                'imagem_caminho' => 'public/images/acidente-engasgo.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nivel' => 'nivel3',
                'legenda_user' => 'Ferido por fogo ou calor',
                'legenda_samu' => 'Alguém queimado (fogo ou fonte de calor)',
                'imagem_nome' => 'acidente-fogo.jpg',
                'imagem_caminho' => 'public/images/acidente-fogo.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nivel' => 'nivel3',
                'legenda_user' => 'Ataque coração',
                'legenda_samu' => 'Alguém em parada cardíaca',
                'imagem_nome' => 'acidente-coracao.jpg',
                'imagem_caminho' => 'public/images/acidente-coracao.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nivel' => 'nivel3',
                'legenda_user' => 'Acidente por queda',
                'legenda_samu' => 'Queda em altura',
                'imagem_nome' => 'acidente-queda.jpg',
                'imagem_caminho' => 'public/images/acidente-queda.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nivel' => 'nivel3',
                'legenda_user' => 'Intoxicação por químicos',
                'legenda_samu' => 'Intoxicação por remédios ou produtos químicos',
                'imagem_nome' => 'acidente-remedios.jpg',
                'imagem_caminho' => 'public/images/acidente-remedios.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nivel' => 'nivel3',
                'legenda_user' => 'Sangramento forte',
                'legenda_samu' => 'Consigo ver forte sangramento',
                'imagem_nome' => 'acidente-sangramento_forte.jpg',
                'imagem_caminho' => 'public/images/acidente-sangramento_forte.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nivel' => 'nivel3',
                'legenda_user' => 'Sangramento médio',
                'legenda_samu' => 'Consigo ver sangramento médio',
                'imagem_nome' => 'acidente-sangramento_medio.jpg',
                'imagem_caminho' => 'public/images/acidente-sangramento_medio.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nivel' => 'nivel3',
                'legenda_user' => 'Sangramento fraco',
                'legenda_samu' => 'Consigo ver sangramento fraco',
                'imagem_nome' => 'acidente-sangramento_fraco.jpg',
                'imagem_caminho' => 'public/images/acidente-sangramento_fraco.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nivel' => 'nivel3',
                'legenda_user' => 'Acidente de trânsito',
                'legenda_samu' => 'Acidente de trânsito',
                'imagem_nome' => 'acidente-transito.jpg',
                'imagem_caminho' => 'public/images/acidente-transito.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nivel' => 'nivel3',
                'legenda_user' => 'Sem sangramento',
                'legenda_samu' => 'Não vejo sangramento',
                'imagem_nome' => 'sem-sangramento.jpg',
                'imagem_caminho' => 'public/images/sem-sangramento.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nivel' => 'nivel3',
                'legenda_user' => 'Osso quebrado',
                'legenda_samu' => 'Fratura óssea',
                'imagem_nome' => 'acidente-fratura.jpg',
                'imagem_caminho' => 'public/images/acidente-fratura.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nivel' => 'foto',
                'legenda_user' => 'Enviar foto da emergência',
                'legenda_samu' => 'Tirei foto da emergência',
                'imagem_nome' => 'tirar-foto-problema.jpg',
                'imagem_caminho' => 'public/images/tirar-foto-problema.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nivel' => 'registrar',
                'legenda_user' => 'Abrir chamado',
                'legenda_samu' => 'Estou aguardando atendimento',
                'imagem_nome' => 'abrir-chamado.jpg',
                'imagem_caminho' => 'public/images/abrir-chamado.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ];

        foreach ($cartoes_lista as $cartao) {
            $existingCartao = Cartao::where('imagem_nome', $cartao['imagem_nome'])->first();
            if (!$existingCartao) {
                Cartao::create($cartao);
            } else {
                $existingCartao->update($cartao);
            }
        }
    }
}
