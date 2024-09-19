<?php
namespace App\Models;
use App\Core\SQL;

class User extends SQL
{


    private ?int $id = null;
    protected string $firstname;
    protected string $lastname;
    protected string $email;
    protected string $password;
    protected ?string $validation_code = null;
    protected int $status = 0;

    protected ?string $reset_token = null;

    protected ?string $token_expiration = null;


    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getFirstname(): string
    {
        return $this->firstname;
    }

    /**
     * @param string $firstname
     */
    public function setFirstname(string $firstname): void
    {
        $allowed_tags = '<h1><h2><h3><h4><h5><h6><p><b><i><u><strike><s><del><blockquote><center><code><ul><ol><li><a><img><div><span><br><strong><em>';
        $this->firstname = ucwords(strtolower(trim(strip_tags($firstname, $allowed_tags))));
    }

        /**
     * @return ?string
     */
    public function getValidationCode(): ?string
    {
        return $this->validation_code;
    }

    /**
     * @param ?string $validation_code
     */
    public function setValidationCode(?string $validation_code): void
    {
        $this->validation_code = $validation_code;
    }

    /**
     * @return string
     */
    public function getResetToken(): string
    {
        return $this->reset_token;
    }

    /**
     * @param ?string $reset_token
     */
    public function setResetToken(?string $reset_token): void
    {
        $this->reset_token = $reset_token;
    }

    /**
     * @return ?string
     */
    public function getTokenExpiration(): string
    {
        return $this->token_expiration;
    }

    /**
     * @param ?string $token_expiration
     */
    public function setTokenExpiration(?string $token_expiration): void
    {
        $this->token_expiration = $token_expiration;
    }

    /**
     * @return string
     */
    public function getLastname(): string
    {
        return $this->lastname;
    }

    /**
     * @param string $lastname
     */
    public function setLastname(string $lastname): void
    {
        $allowed_tags = '<h1><h2><h3><h4><h5><h6><p><b><i><u><strike><s><del><blockquote><center><code><ul><ol><li><a><img><div><span><br><strong><em>';
        $this->lastname = strtoupper(trim(strip_tags($lastname, $allowed_tags)));
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $allowed_tags = '<h1><h2><h3><h4><h5><h6><p><b><i><u><strike><s><del><blockquote><center><code><ul><ol><li><a><img><div><span><br><strong><em>';
        $this->email = strtolower(trim(strip_tags($email, $allowed_tags)));
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = password_hash($password, PASSWORD_DEFAULT);
    }

    /**
     * @return int
     */
    public function getStatus(): int
    {
        return $this->status;
    }

    /**
     * @param int $status
     */
    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    /**
     * Retourne le statut sous forme de chaîne de caractères.
     *
     * @return string
     */
    public function getStringifiedStatus(): string
    {
        $statuses = [
            0 => "Invité",
            1 => "Utilisateur",
            2 => "Éditeur",
            3 => "Modérateur",
            4 => "Administrateur"
        ];

        return $statuses[$this->status] ?? "Inconnu";
    }

    public function findOneByEmail(string $email) {
        $sql = "SELECT * FROM {$this->table} WHERE email = :email";

        $queryPrepared = $this->pdo->prepare($sql);
        $queryPrepared->execute([":email" => $email]);
        $queryPrepared->setFetchMode(\PDO::FETCH_CLASS, 'App\Models\User');
        return $queryPrepared->fetch();
    }

    public function findOneById(int $id) {
        $sql = "SELECT * FROM {$this->table} WHERE id = :id";

        $queryPrepared = $this->pdo->prepare($sql);
        $queryPrepared->execute([":id" => $id]);
        $queryPrepared->setFetchMode(\PDO::FETCH_CLASS, 'App\Models\User');
        return $queryPrepared->fetch();
    }

    public function findAll() {
        $sql = "SELECT * FROM {$this->table}";

        $queryPrepared = $this->pdo->prepare($sql);
        $queryPrepared->execute();
        $queryPrepared->setFetchMode(\PDO::FETCH_CLASS, 'App\Models\User');
        return $queryPrepared->fetchAll();
    }

    public function delete(): void
    {
        if (!empty($this->getId())) {
            $sql = "DELETE FROM {$this->table} WHERE id = :id";
            $queryPrepared = $this->pdo->prepare($sql);
            $queryPrepared->execute([':id' => $this->getId()]);
        }
    }

    public function count(): int
    {
        $sql = "SELECT COUNT(*) as count FROM {$this->table}";
        $queryPrepared = $this->pdo->prepare($sql);
        $queryPrepared->execute();
        $result = $queryPrepared->fetch(\PDO::FETCH_ASSOC);
        return (int) $result['count'];
    }
}
