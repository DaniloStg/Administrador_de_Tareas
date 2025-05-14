<?php 
 namespace App\Models\Tecnicas;
 use CodeIgniter\Model;
 class ModelCompartidos extends Model{ 
 protected $table = 'compartidos';  
 protected $primaryKey = 'idCompartido';
 protected $useAutoIncrement = true; 
 protected $returnType = 'array';
 protected $useSoftDeletes = false;
 protected $allowedFields = ['idUsuarioEnvio','idUsuarioInvitado','idTareaCompartida', 'estado'];
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
