<?php

namespace App\Models;

use CodeIgniter\Model;

class Aluno extends Model
{
    protected $table = 'alunos';
    protected $primaryKey = 'id';

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = [
        'avatar',
        'nome',
        'endereco',
    ];

    protected $useTimestamps = false;

    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
}