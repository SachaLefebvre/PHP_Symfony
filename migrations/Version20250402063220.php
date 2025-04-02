<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20250402063220 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            CREATE TABLE book_author (book_id INT NOT NULL, author_id INT NOT NULL, INDEX IDX_9478D34516A2B381 (book_id), INDEX IDX_9478D345F675F31B (author_id), PRIMARY KEY(book_id, author_id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            CREATE TABLE comment (id INT AUTO_INCREMENT NOT NULL, name VARCHAR(255) NOT NULL, email VARCHAR(255) NOT NULL, created_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', published_at DATETIME NOT NULL COMMENT '(DC2Type:datetime_immutable)', status VARCHAR(255) NOT NULL, content LONGTEXT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8mb4 COLLATE `utf8mb4_unicode_ci` ENGINE = InnoDB
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE book_author ADD CONSTRAINT FK_9478D34516A2B381 FOREIGN KEY (book_id) REFERENCES book (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE book_author ADD CONSTRAINT FK_9478D345F675F31B FOREIGN KEY (author_id) REFERENCES author (id) ON DELETE CASCADE
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE book ADD editor_id INT NOT NULL, ADD comments_id INT DEFAULT NULL
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE book ADD CONSTRAINT FK_CBE5A3316995AC4C FOREIGN KEY (editor_id) REFERENCES editor (id)
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE book ADD CONSTRAINT FK_CBE5A33163379586 FOREIGN KEY (comments_id) REFERENCES comment (id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_CBE5A3316995AC4C ON book (editor_id)
        SQL);
        $this->addSql(<<<'SQL'
            CREATE INDEX IDX_CBE5A33163379586 ON book (comments_id)
        SQL);
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql(<<<'SQL'
            ALTER TABLE book DROP FOREIGN KEY FK_CBE5A33163379586
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE book_author DROP FOREIGN KEY FK_9478D34516A2B381
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE book_author DROP FOREIGN KEY FK_9478D345F675F31B
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE book_author
        SQL);
        $this->addSql(<<<'SQL'
            DROP TABLE comment
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE book DROP FOREIGN KEY FK_CBE5A3316995AC4C
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_CBE5A3316995AC4C ON book
        SQL);
        $this->addSql(<<<'SQL'
            DROP INDEX IDX_CBE5A33163379586 ON book
        SQL);
        $this->addSql(<<<'SQL'
            ALTER TABLE book DROP editor_id, DROP comments_id
        SQL);
    }
}
