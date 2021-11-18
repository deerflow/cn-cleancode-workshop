<?php

class User
{
    public const ROLE_ADMIN_PAYEUR = 'ADMIN_PAYEUR';
    public const ROLE_ADMIN_ENTREPRISE = 'ADMIN_ENTREPRISE';
    public const ROLE_REFERENT = 'REFERENT';
    public const ROLE_BENEFICIARY = 'BENEFICIARY';

    public int $id;
    public string $firstname;
    public string $lastname;
    public string $email;
    public string $password;
    public string $phone_number;
    public string $address;
    public Company $active_company;
    public Data $data;

    public function detach_company(int $id): void
    {
        // this method is only for demonstration purpose
    }

    public function active_company(): Collection
    {
        return new Collection();
    }

    public function assignDefaultRole(string $role): void
    {
        // this method is only for demonstration purpose
    }

    public function assignMainRole(string $role): void
    {
        // this method is only for demonstration purpose
    }

    public function removeRole(string $role): void
    {
        // this method is only for demonstration purpose
    }

    public function defaultRole(): RoleCollection
    {
        return new RoleCollection();
    }

    public function mainRole(): RoleCollection
    {
        return new RoleCollection();
    }

    public function save(): void
    {
        // this method is only for demonstration purpose
    }

    public function isReferentOrGreater(): bool
    {
        return true;
    }

    public function isSuperAdmin(): bool
    {
        return true;
    }

    public function can(string $service): bool
    {
        return true;
    }

    public static function find(int $id): User
    {
        return new User();
    }

    public function hasData(): bool
    {
        return true;
    }

    public static function all(): array
    {
        return [];
    }
}
