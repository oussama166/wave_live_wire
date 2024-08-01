<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\VacationType>
 */
class VacationTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    private array $vacationTypes = [
        [
            "label" => "Congés Annuels",
            "description" => "Jours de congés que les employés accumulent chaque année.",
            "isPaid" => true,
            "duration" => 30, // souvent 30 jours ouvrables par an
            "reduction" => 0,
            "backgroundColor" => "#4CAF50" // Green
        ],
        [
            "label" => "Congé de Maternité/Paternité",
            "description" => "Congés pris à la naissance ou à l'adoption d'un enfant.",
            "isPaid" => true,
            "duration" => 16, // en semaines, exemple pour la maternité en France
            "reduction" => 0,
            "backgroundColor" => "#FF9800" // Orange
        ],
        [
            "label" => "Congé de Maladie",
            "description" => "Congés pris pour raison de santé.",
            "isPaid" => true,
            "duration" => 0, // variable selon la durée de la maladie
            "reduction" => 0, // souvent partiellement ou avec des indemnités de la sécurité sociale
            "backgroundColor" => "#F44336" // Red
        ],
        [
            "label" => "Congé de Mariage",
            "description" => "Congé accordé pour son propre mariage.",
            "isPaid" => true,
            "duration" => 4, // en général 4 jours
            "reduction" => 0,
            "backgroundColor" => "#E91E63" // Pink
        ],
        [
            "label" => "Congé pour Enfant Malade",
            "description" => "Congé pris pour s'occuper d'un enfant malade.",
            "isPaid" => true,
            "duration" => 0, // variable selon les conventions collectives et la législation
            "reduction" => 0, // souvent partiellement
            "backgroundColor" => "#03A9F4" // Light Blue
        ],
        [
            "label" => "Congé Sans Solde",
            "description" => "Congé pris sans rémunération.",
            "isPaid" => false,
            "duration" => 0, // variable selon l'accord entre l'employé et l'employeur
            "reduction" => 100,
            "backgroundColor" => "#9E9E9E" // Gray
        ],
        [
            "label" => "Congé Sabbatique",
            "description" => "Congé de longue durée pris pour des raisons personnelles ou professionnelles.",
            "isPaid" => false,
            "duration" => 0, // souvent plusieurs mois à un an
            "reduction" => 100,
            "backgroundColor" => "#673AB7" // Deep Purple
        ],
        [
            "label" => "Congé Parental d'Éducation",
            "description" => "Congé pris pour élever un enfant en bas âge.",
            "isPaid" => true,
            "duration" => 36, // jusqu'aux trois ans de l'enfant (en mois)
            "reduction" => 50, // souvent avec une indemnité réduite
            "backgroundColor" => "#FFC107" // Amber
        ],
        [
            "label" => "Congé de Formation",
            "description" => "Congé pris pour suivre une formation professionnelle.",
            "isPaid" => true,
            "duration" => 0, // variable selon la durée de la formation
            "reduction" => 50, // souvent sous forme d'une partie du salaire ou d'une indemnité de formation
            "backgroundColor" => "#3F51B5" // Indigo
        ],
        [
            "label" => "Jours de RTT (Réduction du Temps de Travail)",
            "description" => "Jours de repos compensatoires pour les heures supplémentaires ou la réduction du temps de travail.",
            "isPaid" => true,
            "duration" => 0, // variable selon l'accord de l'entreprise
            "reduction" => 0,
            "backgroundColor" => "#8BC34A" // Light Green
        ]
    ];


    public function definition(): array
    {
        $vacationType = $this->faker->unique()->randomElement($this->vacationTypes);

        return [
            'label' => $vacationType['label'],
            'description' => $vacationType['description'],
            'isPaid' => $vacationType['isPaid'],
            'duration' => $vacationType['duration'],
            'reduction' => $vacationType['reduction'],
            'backgroundColor'=>$vacationType['backgroundColor'],
        ];
    }
}
