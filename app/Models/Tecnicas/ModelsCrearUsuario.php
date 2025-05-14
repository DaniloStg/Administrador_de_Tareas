<?php 
 namespace App\Models\Tecnicas;
 use CodeIgniter\Model;
 class ModelsCrearUsuario extends Model{ 
 protected $table = 'usuarios';  
 protected $primaryKey = 'id';
 protected $useAutoIncrement = true; 
 protected $returnType = 'array';
 protected $useSoftDeletes = false;
 protected $allowedFields = ['nombre', 'apellido', 'correo', 'contrasena'];
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
