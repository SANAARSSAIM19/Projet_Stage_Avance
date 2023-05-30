<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Remboursement extends Model
{
    use HasFactory;
    public function advancerequests()
    {
        return $this->belongsToMany(AdvanceRequest::class);
    }

    public function headings(): array
    {
       
        return [
            'Nom',
            'Prenom',
            'Rubrique',
            'Référence',
            'Montant Initial',
            'Premiére Échéance',
            'Dérnière Échéance',
            'Retenue',
            'Solde Fin',
            // Ajoutez les autres colonnes de la table de remboursement ici
        ];
    }

   /* public function model(array $row)
    {
        // Créer une instance de modèle Remboursement et assigner les valeurs des colonnes
        return new Remboursement([
            'id' => $row[0],
            'premiere_echance' => $row[1],
            'derniere_echance' => $row[1],
            'retenue' => $row[1],
            'solde_fin' => $row[1],
            'id_demande' => $row[1],
            // Assigner les valeurs des autres colonnes
        ]);
    }*/
}
