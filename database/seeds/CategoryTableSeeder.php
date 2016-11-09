<?php

use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            // Abonnements
            [
                'id'                 => 1,
                'name'               => 'Abonnements',
                'category_type_id'   => Budgeck\Models\CategoryType::EXPENSE,
                'parent_category_id' => null,
            ],
            [
                'id'                 => 2,
                'name'               => 'Câble / Satellite',
                'category_type_id'   => Budgeck\Models\CategoryType::EXPENSE,
                'parent_category_id' => 1,
            ],
            [
                'id'                 => 3,
                'name'               => 'Internet',
                'category_type_id'   => Budgeck\Models\CategoryType::EXPENSE,
                'parent_category_id' => 1,
            ],
            [
                'id'                 => 4,
                'name'               => 'Téléphone mobile',
                'category_type_id'   => Budgeck\Models\CategoryType::EXPENSE,
                'parent_category_id' => 1,
            ],
            [
                'id'                 => 5,
                'name'               => 'Téléphone fixe',
                'category_type_id'   => Budgeck\Models\CategoryType::EXPENSE,
                'parent_category_id' => 1,
            ],

            // Achats & Shopping
            [
                'id'                 => 6,
                'name'               => 'Achats & Shopping',
                'category_type_id'   => Budgeck\Models\CategoryType::EXPENSE,
                'parent_category_id' => null,
            ],
            [
                'id'                 => 7,
                'name'               => 'Cadeaux',
                'category_type_id'   => Budgeck\Models\CategoryType::EXPENSE,
                'parent_category_id' => 6,
            ],
            [
                'id'                 => 8,
                'name'               => 'Vêtements/chaussures',
                'category_type_id'   => Budgeck\Models\CategoryType::EXPENSE,
                'parent_category_id' => 6,
            ],
            [
                'id'                 => 9,
                'name'               => 'Autres',
                'category_type_id'   => Budgeck\Models\CategoryType::EXPENSE,
                'parent_category_id' => 6,
            ],

            // Alimentation & Restaurant
            [
                'id'                 => 10,
                'name'               => 'Alimentation & Restaurant',
                'category_type_id'   => Budgeck\Models\CategoryType::EXPENSE,
                'parent_category_id' => null,
            ],
            [
                'id'                 => 11,
                'name'               => 'Supermarché',
                'category_type_id'   => Budgeck\Models\CategoryType::EXPENSE,
                'parent_category_id' => 10,
            ],
            [
                'id'                 => 12,
                'name'               => 'Restaurant',
                'category_type_id'   => Budgeck\Models\CategoryType::EXPENSE,
                'parent_category_id' => 10,
            ],
            [
                'id'                 => 13,
                'name'               => 'Autres',
                'category_type_id'   => Budgeck\Models\CategoryType::EXPENSE,
                'parent_category_id' => 10,
            ],

            // Auto & Transport
            [
                'id'                 => 14,
                'name'               => 'Auto & Transport',
                'category_type_id'   => Budgeck\Models\CategoryType::EXPENSE,
                'parent_category_id' => null,
            ],
            [
                'id'                 => 15,
                'name'               => 'Carburant',
                'category_type_id'   => Budgeck\Models\CategoryType::EXPENSE,
                'parent_category_id' => 14,
            ],
            [
                'id'                 => 16,
                'name'               => 'Assurance',
                'category_type_id'   => Budgeck\Models\CategoryType::EXPENSE,
                'parent_category_id' => 14,
            ],
            [
                'id'                 => 17,
                'name'               => 'Péage',
                'category_type_id'   => Budgeck\Models\CategoryType::EXPENSE,
                'parent_category_id' => 14,
            ],
            [
                'id'                 => 18,
                'name'               => 'Stationnement',
                'category_type_id'   => Budgeck\Models\CategoryType::EXPENSE,
                'parent_category_id' => 14,
            ],
            [
                'id'                 => 19,
                'name'               => 'Entretien',
                'category_type_id'   => Budgeck\Models\CategoryType::EXPENSE,
                'parent_category_id' => 14,
            ],
            [
                'id'                 => 20,
                'name'               => 'Transports en commun',
                'category_type_id'   => Budgeck\Models\CategoryType::EXPENSE,
                'parent_category_id' => 14,
            ],

            // Banque
            [
                'id'                 => 21,
                'name'               => 'Banque',
                'category_type_id'   => Budgeck\Models\CategoryType::EXPENSE,
                'parent_category_id' => null,
            ],
            [
                'id'                 => 22,
                'name'               => 'Epargne',
                'category_type_id'   => Budgeck\Models\CategoryType::EXPENSE,
                'parent_category_id' => 21,
            ],
            [
                'id'                 => 23,
                'name'               => 'Frais bancaires',
                'category_type_id'   => Budgeck\Models\CategoryType::EXPENSE,
                'parent_category_id' => 21,
            ],
            [
                'id'                 => 24,
                'name'               => 'Remboursement emprunt',
                'category_type_id'   => Budgeck\Models\CategoryType::EXPENSE,
                'parent_category_id' => 21,
            ],

            [
                'id'                 => 25,
                'name'               => 'Divers',
                'category_type_id'   => Budgeck\Models\CategoryType::EXPENSE,
                'parent_category_id' => 21,
            ],

            // Logement
            [
                'id'                 => 26,
                'name'               => 'Logement',
                'category_type_id'   => Budgeck\Models\CategoryType::EXPENSE,
                'parent_category_id' => null,
            ],
            [
                'id'                 => 27,
                'name'               => 'Loyer',
                'category_type_id'   => Budgeck\Models\CategoryType::EXPENSE,
                'parent_category_id' => 26,
            ],
            [
                'id'                 => 28,
                'name'               => 'Electricité',
                'category_type_id'   => Budgeck\Models\CategoryType::EXPENSE,
                'parent_category_id' => 26,
            ],
            [
                'id'                 => 29,
                'name'               => 'Gaz',
                'category_type_id'   => Budgeck\Models\CategoryType::EXPENSE,
                'parent_category_id' => 26,
            ],
            [
                'id'                 => 30,
                'name'               => 'Eau',
                'category_type_id'   => Budgeck\Models\CategoryType::EXPENSE,
                'parent_category_id' => 26,
            ],
            [
                'id'                 => 31,
                'name'               => 'Assurance',
                'category_type_id'   => Budgeck\Models\CategoryType::EXPENSE,
                'parent_category_id' => 26,
            ],

            // Santé
            [
                'id'                 => 32,
                'name'               => 'Santé',
                'category_type_id'   => Budgeck\Models\CategoryType::EXPENSE,
                'parent_category_id' => null,
            ],
            [
                'id'                 => 33,
                'name'               => 'Médecin',
                'category_type_id'   => Budgeck\Models\CategoryType::EXPENSE,
                'parent_category_id' => 32,
            ],
            [
                'id'                 => 34,
                'name'               => 'Pharmacie',
                'category_type_id'   => Budgeck\Models\CategoryType::EXPENSE,
                'parent_category_id' => 32,
            ],

            // Divers
            [
                'id'                 => 35,
                'name'               => 'Divers',
                'category_type_id'   => Budgeck\Models\CategoryType::EXPENSE,
                'parent_category_id' => null,
            ],

            // Incomes
            [
                'id'                 => 36,
                'name'               => 'Intérêts',
                'category_type_id'   => Budgeck\Models\CategoryType::INCOME,
                'parent_category_id' => null,
            ],
            [
                'id'                 => 37,
                'name'               => 'Remboursement',
                'category_type_id'   => Budgeck\Models\CategoryType::INCOME,
                'parent_category_id' => null,
            ],
            [
                'id'                 => 38,
                'name'               => 'Salaire',
                'category_type_id'   => Budgeck\Models\CategoryType::INCOME,
                'parent_category_id' => null,
            ],
        ]);
    }
}
