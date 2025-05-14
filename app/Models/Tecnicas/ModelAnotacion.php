<?php 
 namespace App\Models\Tecnicas;
 use CodeIgniter\Model;
 class ModelAnotacion extends Model{ 
 protected $table = 'anotaciones';  
 protected $primaryKey = 'id';
 protected $useAutoIncrement = true; 
 protected $returnType = 'array';
 protected $useSoftDeletes = false;
 protected $allowedFields = ['id', 'id_usuario','id_tarea', 'mensaje'];
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
