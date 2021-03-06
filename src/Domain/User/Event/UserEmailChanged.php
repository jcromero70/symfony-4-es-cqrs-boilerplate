<?php

declare(strict_types=1);

namespace App\Domain\User\Event;

use App\Domain\User\ValueObject\Email;
use Broadway\Serializer\Serializable;
use Ramsey\Uuid\Uuid;
use Ramsey\Uuid\UuidInterface;

final class UserEmailChanged implements Serializable
{
    public static function deserialize(array $data): self
    {
        return new self(
            Uuid::fromString($data['uuid']),
            Email::fromString($data['email'])
        );
    }

    public function serialize(): array
    {
        return [
            'uuid' => $this->uuid->toString(),
            'email' => $this->email->toString()
        ];
    }

    public function __construct(UuidInterface $uuid, Email $email)
    {
        $this->email = $email;
        $this->uuid = $uuid;
    }

    /**
     * @var UuidInterface
     */
    public $uuid;

    /**
     * @var Email
     */
    public $email;


}
