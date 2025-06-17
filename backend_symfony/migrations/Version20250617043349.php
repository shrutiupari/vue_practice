<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250617043349 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE invoice ADD patient_email VARCHAR(100) NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE invoice ADD patient_name VARCHAR(150) NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE invoice ADD description VARCHAR(200) NULL
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE SCHEMA public
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE invoice DROP patient_email
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE invoice DROP patient_name
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE invoice DROP description
        SQL);
    }
}
