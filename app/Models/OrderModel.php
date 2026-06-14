<?php

namespace App\Models;

use CodeIgniter\Model;

class OrderModel extends Model
{
    protected $table            = 'orders';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;

    protected $allowedFields = [
        'user_id',
        'order_code',
        'customer_name',
        'customer_phone',
        'customer_address',
        'service_type',
        'payment_method',
        'payment_status',
        'total_price',
        'status',
        'notes',
    ];

    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    public function getOrdersWithUser(?int $userId = null): array
    {
        $builder = $this->select('orders.*, users.username, users.nama_lengkap')
            ->join('users', 'users.id = orders.user_id', 'left')
            ->orderBy('orders.created_at', 'DESC');

        if ($userId !== null) {
            $builder->where('orders.user_id', $userId);
        }

        return $builder->findAll();
    }
}
