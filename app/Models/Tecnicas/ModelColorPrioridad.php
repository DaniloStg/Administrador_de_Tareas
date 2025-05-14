<?php 
 namespace App\Models\Tecnicas;
 use CodeIgniter\Model;
 class ModelColorPrioridad extends Model{ 
 protected $table = 'colortarea';  
 protected $primaryKey = 'id_usuario';
 protected $useAutoIncrement = true; 
 protected $returnType = 'array';
 protected $useSoftDeletes = false;
 protected $allowedFields = ['colorAlta','colorMedia','colorBaja','id_usuario'];
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
