<?php

namespace App\Models;

use App\Entities\UserEntity;
use CodeIgniter\Model;

class UserModel extends Model
{
    protected $DBGroup = 'default';
    protected $table = 'user';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $insertID = 0;
    protected $returnType = 'App\Entities\UserEntity';
    protected $useSoftDelete = false;
    protected $protectFields = true;
    protected $allowedFields = ['name', 'number', 'email', 'password'];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';
    protected $deletedField = 'deleted_at';

    // Validation
    protected $validationRules = [
        'name' => 'required',
        'number' => 'required|exact_length[10]|numeric|is_unique[user.number]',
        'email' => 'required|valid_email|is_unique[user.email]',
        'password' => 'required',
        'password_confirm' => 'required|matches[password]',
    ];
    protected $validationMessages = [
        'name' => [
            'required'   => 'Your baby name is missing.',
            'min_length' => 'Too short, man!',
        ]
    ];
    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = ['hashPassword'];
    protected $afterInsert = [];
    protected $beforeUpdate = ['hashPassword'];
    protected $afterUpdate = [];
    protected $beforeFind = [];
    protected $afterFind = [];
    protected $beforeDelete = [];
    protected $afterDelete = [];

    // Find user
    public function login(UserEntity $user)
    {
        if ($this->exists($user)) {
            $db = $this
                ->select()
                ->where('number', $user->number)
                ->first();
            if (password_verify($user->password, $db->password)) {
                return $db;
            } else {
                return false;
            }
        } else {
            return false;
        }

    }

    // Find if User exists
    public function exists(UserEntity $user): bool
    {
        if ($this->readByNumber($user)) {
            return true;
        } else {
            return false;
        }
    }

    // Search by number
    public function readByNumber(UserEntity $user)
    {
        // TODO: Show this in report.
        return $this
            ->select()
            ->where('number', $user->number)
            ->first();
    }

    // Is user Admin
    public function isAdmin(UserEntity  $user){
        if($user->admin == 1){
            return true;
        }else{
            return false;
        }
    }

    // Hash password
    protected function hashPassword(array $data)
    {
        if (! isset($data['data']['password'])) return $data;

        $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        //unset($data['data']['password']);

        return $data;
    }

    // Before inserting into table
    public function beforeInsert(UserEntity $user){
        return $this->hashPassword($user);
    }
}
