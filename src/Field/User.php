<?php

namespace Adapt\Acf\Field;

use Adapt\Acf\FieldInterface;
use App\Model\Post;

/**
 * Class User.
 *
 * @author Junior Grossi <juniorgro@gmail.com>
 */
class User extends BasicField implements FieldInterface
{
    /**
     * @var \App\Model\User
     */
    protected $user;

    /**
     * @var \App\Model\User
     */
    protected $value;

    /**
     * @param Post $post
     */
    public function __construct(Post $post)
    {
        parent::__construct($post);
        $this->user = new \App\Model\User();
        $this->user->setConnection($post->getConnectionName());
    }

    /**
     * @param string $fieldName
     */
    public function process($fieldName)
    {
        $userId = $this->fetchValue($fieldName);
        $this->value = $this->user->find($userId);
    }

    /**
     * @return \App\Model\User
     */
    public function get()
    {
        return $this->value;
    }
}
