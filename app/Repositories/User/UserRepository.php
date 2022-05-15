<?php
namespace App\Repositories\User;
use App\User;
use App\Repositories\Base\BaseRepository;
class UserRepository extends BaseRepository implements UserRepositoryInterface {
    protected $user;
    public function __construct(User $user){
        parent::__construct($user);
    }

}
?>