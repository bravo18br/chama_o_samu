<?php

namespace Database\Seeders;

use App\Models\Cartao;
use App\Models\User;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Tigo\DocumentBr\Cpf;
use Illuminate\Support\Facades\App;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $cartoes_lista = [
            [
                'nivel' => 'voltar',
                'legenda_user' => 'Voltar',
                'legenda_samu' => 'Botão voltar',
                'imagem_nome' => 'botao-voltar.svg',
                'imagem_caminho' => 'public/images/botao-voltar.svg',
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
                'imagem_nome' => 'botao-avancar.svg',
                'imagem_caminho' => 'public/images/botao-avancar.svg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nivel' => 'nivel1',
                'legenda_user' => 'Emergência na rua',
                'legenda_samu' => 'É uma emergência na rua',
                'imagem_nome' => 'atendimento-rua-3.jpg',
                'imagem_caminho' => 'public/images/atendimento-rua-3.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nivel' => 'nivel1',
                'legenda_user' => 'Emergência em casa',
                'legenda_samu' => 'É uma emergência em casa',
                'imagem_nome' => 'atendimento-casa-5.png',
                'imagem_caminho' => 'public/images/atendimento-casa-5.png',
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
                'imagem_nome' => 'acidente-afogamento.png',
                'imagem_caminho' => 'public/images/acidente-afogamento.png',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nivel' => 'nivel3',
                'legenda_user' => 'Briga',
                'legenda_samu' => 'Feridos em briga',
                'imagem_nome' => 'acidente-briga.png',
                'imagem_caminho' => 'public/images/acidente-briga.png',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nivel' => 'nivel3',
                'legenda_user' => 'Acidente com bicicleta',
                'legenda_samu' => 'Acidente envolvendo ciclista',
                'imagem_nome' => 'acidente-bicicleta.png',
                'imagem_caminho' => 'public/images/acidente-bicicleta.png',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nivel' => 'nivel3',
                'legenda_user' => 'Acidente com moto',
                'legenda_samu' => 'Acidente envolvendo motociclista',
                'imagem_nome' => 'acidente-moto.png',
                'imagem_caminho' => 'public/images/acidente-moto.png',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nivel' => 'nivel3',
                'legenda_user' => 'Pessoa atropelada',
                'legenda_samu' => 'Alguém foi atropelado',
                'imagem_nome' => 'acidente-atropelamento.png',
                'imagem_caminho' => 'public/images/acidente-atropelamento.png',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nivel' => 'nivel3',
                'legenda_user' => 'Choque elétrico',
                'legenda_samu' => 'Alguém sofreu choque elétrico',
                'imagem_nome' => 'acidente-choque-eletrico.png',
                'imagem_caminho' => 'public/images/acidente-choque-eletrico.png',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nivel' => 'nivel3',
                'legenda_user' => 'Engasgado na garganta',
                'legenda_samu' => 'Alguém engasgado com algo',
                'imagem_nome' => 'acidente-engasgo.png',
                'imagem_caminho' => 'public/images/acidente-engasgo.png',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nivel' => 'nivel3',
                'legenda_user' => 'Ferido por fogo ou calor',
                'legenda_samu' => 'Alguém queimado (fogo ou fonte de calor)',
                'imagem_nome' => 'acidente-queimadura.png',
                'imagem_caminho' => 'public/images/acidente-queimadura.png',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nivel' => 'nivel3',
                'legenda_user' => 'Ataque coração',
                'legenda_samu' => 'Alguém em parada cardíaca',
                'imagem_nome' => 'acidente-ataque-cardiaco.png',
                'imagem_caminho' => 'public/images/acidente-ataque-cardiaco.png',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nivel' => 'nivel3',
                'legenda_user' => 'Acidente por queda',
                'legenda_samu' => 'Queda em altura',
                'imagem_nome' => 'acidente-queda.png',
                'imagem_caminho' => 'public/images/acidente-queda.png',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nivel' => 'nivel3',
                'legenda_user' => 'Intoxicação por químicos',
                'legenda_samu' => 'Intoxicação por remédios ou produtos químicos',
                'imagem_nome' => 'acidente-intox-quimica.png',
                'imagem_caminho' => 'public/images/acidente-intox-quimica.png',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nivel' => 'nivel3',
                'legenda_user' => 'Sangramento forte',
                'legenda_samu' => 'Consigo ver forte sangramento',
                'imagem_nome' => 'acidente-sangramento-forte.png',
                'imagem_caminho' => 'public/images/acidente-sangramento-forte.png',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nivel' => 'nivel3',
                'legenda_user' => 'Sangramento médio',
                'legenda_samu' => 'Consigo ver sangramento médio',
                'imagem_nome' => 'acidente-sangramento-medio.png',
                'imagem_caminho' => 'public/images/acidente-sangramento-medio.png',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nivel' => 'nivel3',
                'legenda_user' => 'Sangramento fraco',
                'legenda_samu' => 'Consigo ver sangramento fraco',
                'imagem_nome' => 'acidente-sangramento-leve.png',
                'imagem_caminho' => 'public/images/acidente-sangramento-leve.png',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nivel' => 'nivel3',
                'legenda_user' => 'Acidente de trânsito',
                'legenda_samu' => 'Acidente de trânsito',
                'imagem_nome' => 'acidente-transito.png',
                'imagem_caminho' => 'public/images/acidente-transito.png',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nivel' => 'nivel3',
                'legenda_user' => 'Sem sangramento',
                'legenda_samu' => 'Não vejo sangramento',
                'imagem_nome' => 'acidente-sem-sangramento.png',
                'imagem_caminho' => 'public/images/acidente-sem-sangramento.png',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nivel' => 'nivel3',
                'legenda_user' => 'Osso quebrado',
                'legenda_samu' => 'Fratura óssea',
                'imagem_nome' => 'acidente-fratura-ossea.png',
                'imagem_caminho' => 'public/images/acidente-fratura-ossea.png',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nivel' => 'foto',
                'legenda_user' => 'Enviar foto da emergência',
                'legenda_samu' => 'Tirei foto da emergência',
                'imagem_nome' => 'tirar-foto-problema.svg',
                'imagem_caminho' => 'public/images/tirar-foto-problema.svg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'nivel' => 'registrar',
                'legenda_user' => 'Abrir chamado',
                'legenda_samu' => 'Estou aguardando atendimento',
                'imagem_nome' => 'abrir-chamado.svg',
                'imagem_caminho' => 'public/images/abrir-chamado.svg',
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

        // SEEDER CASO AMBIENTE DE DESENVOLVIMENTO
        if (App::environment('local')) {
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
        }

        // SEEDER CASO AMBIENTE DE PRODUÇÃO
        if (App::environment('prod')) {

            $users_lista = [[
                'email_verified_at' => now(),
                'name' => 'Chris Klein',
                'email' => 'bravo18br@gmail.com',
                'password' => bcrypt('12345678'),
                'cpf' => '04333747996',
                'cep' => '83709150',
                'rua' => 'Carlos Vicente Zapxon',
                'numero' => '1300',
                'complemento' => 'casa23',
                'celular' => '41984191656',
                'role' => 1,
                'analfabeto' => 0
            ]];

            if (env('SUPER_ADM_USER') && env('SUPER_ADM_PASS')) {
                $super_user = [
                    'email_verified_at' => now(),
                    'name' => 'SMCIT SUPER Admin',
                    'email' => env('SUPER_ADM_USER'),
                    'password' => bcrypt(env('SUPER_ADM_PASS')),
                    'cpf' => '89170186022',
                    'cep' => '83709150',
                    'rua' => 'Rua Número Zero',
                    'numero' => '9999',
                    'complemento' => '999',
                    'celular' => '41999999999',
                    'role' => 1,
                    'analfabeto' => 0
                ];
                $users_lista[] = $super_user;
            };


            foreach ($users_lista as $user) {
                $existingUser = User::where('cpf', $user['cpf'])->first();
                if (!$existingUser) {
                    User::create($user);
                } else {
                    $existingUser->update($user);
                }
            }
        }
    }
}
