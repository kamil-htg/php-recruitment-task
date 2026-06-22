<?php

declare(strict_types=1);

namespace App\Migrations\Postgresql;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

final class Version20260622000000 extends AbstractMigration
{
    public function getDescription(): string
    {
        return 'Create shortened_url table for PostgreSQL';
    }

    public function up(Schema $schema): void
    {
        $this->addSql('CREATE TABLE shortened_url (
            id SERIAL PRIMARY KEY,
            short_code VARCHAR(10) NOT NULL,
            original_url VARCHAR(2048) NOT NULL,
            expires_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL,
            CONSTRAINT uq_short_code UNIQUE (short_code)
        )');
        $this->addSql("COMMENT ON COLUMN shortened_url.expires_at IS '(DC2Type:datetime_immutable)'");
    }

    public function down(Schema $schema): void
    {
        $this->addSql('DROP TABLE shortened_url');
    }
}
