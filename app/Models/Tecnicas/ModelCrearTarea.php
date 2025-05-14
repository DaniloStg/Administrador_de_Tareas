<?php 
 namespace App\Models\Tecnicas;
 use CodeIgniter\Model;
 class ModelCrearTarea extends Model{ 
 protected $table = 'tareas';  
 protected $primaryKey = 'id';
 protected $useAutoIncrement = true; 
 protected $returnType = 'array';
 protected $useSoftDeletes = false;
 protected $allowedFields = ['tema', 'descripcion', 'prioridad', 'fechaVencimiento', 'fechaRecordatorio','id_usuario', 'estado', 'archivada'];
 protected $useTimestamps = false;  // Dates
 protected $dateFormat = 'datetime';
 protected $createdField = 'created_at';
 protected $updatedField = 'updated_at';
 protected $deletedField = 'deleted_at';
 protected $validationRules = []; // Validation
 protected $validationMessages = [];
 protected $skipValidation = false;
 protected $cleanValidationRules = true;
 }
 ?>
