<?php

declare(strict_types=1);

namespace App\Migrations\Mysql;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260622000000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create shortened_url table for MySQL';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE shortened_url (
            id INT AUTO_INCREMENT PRIMARY KEY,
            short_code VARCHAR(10) NOT NULL,
            original_url VARCHAR(2048) NOT NULL,
            expires_at DATETIME NOT NULL COMMENT \'(DC2Type:datetime_immutable)\',
            UNIQUE INDEX uq_short_code (short_code)
        ) DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci ENGINE = InnoDB');
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE shortened_url');
    }
}
