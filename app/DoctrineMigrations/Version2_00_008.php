<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Schema\SchemaException;


class Version2_00_008 extends AbstractMigration {
    /**
     * @param Schema $schema
     *
     * 17 sql queries
     */
    public function up(Schema $schema) {
        try
        {
            $table = $schema->getTable('user_import');
        }
        catch(SchemaException $e) {
            $this->addSql('
                CREATE TABLE user_import (
                    id INT AUTO_INCREMENT NOT NULL,
                    createdDate DATE NOT NULL,
                    import_name VARCHAR(255) NOT NULL,
                    lastRunDate DATE DEFAULT NULL,
                    state INT NOT NULL,
                    createdBy_id INT DEFAULT NULL,
                    INDEX IDX_F81CD5203174800F (createdBy_id),
                    PRIMARY KEY(id)
                ) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
            ');
            $this->addSql('
                ALTER TABLE user_import
                ADD CONSTRAINT FK_F81CD5203174800F
                FOREIGN KEY (createdBy_id)
                REFERENCES user (id);
            ');
        }


        try
        {
            $table = $schema->getTable('user_import_line');
        }
        catch(SchemaException $e)
        {
            $this->addSql('
                CREATE TABLE user_import_line (
                    id INT AUTO_INCREMENT NOT NULL,
                    import_id INT DEFAULT NULL,
                    errors_id INT DEFAULT NULL,
                    login VARCHAR(255) DEFAULT NULL,
                    mail VARCHAR(255) DEFAULT NULL,
                    prenom VARCHAR(255) DEFAULT NULL,
                    nom VARCHAR(255) DEFAULT NULL,
                    promo VARCHAR(255) DEFAULT NULL,
                    filliere VARCHAR(255) DEFAULT NULL,
                    adresse VARCHAR(255) DEFAULT NULL,
                    telephone VARCHAR(255) DEFAULT NULL,
                    state INT NOT NULL,
                    action INT NOT NULL,
                    INDEX IDX_952393E3B6A263D9 (import_id),
                    UNIQUE INDEX UNIQ_952393E3FF459ADA (errors_id),
                    PRIMARY KEY(id)
                ) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
            ');
        }

        try
        {
            $table = $schema->getTable('user_import_line_error');
        }
        catch(SchemaException $e)
        {
            $this->addSql('
                CREATE TABLE user_import_line_error (
                    id INT AUTO_INCREMENT NOT NULL,
                    email_ko TINYINT(1) NOT NULL,
                    login_ko TINYINT(1) NOT NULL,
                    login_not_found TINYINT(1) NOT NULL,
                    prenom_not_found TINYINT(1) NOT NULL,
                    nom_not_found TINYINT(1) NOT NULL,
                    login_already_exists TINYINT(1) NOT NULL,
                    promo_format_ko TINYINT(1) NOT NULL,
                    PRIMARY KEY(id)
                ) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;
            ');
            $this->addSql('
                ALTER TABLE user_import_line
                ADD CONSTRAINT FK_952393E3B6A263D9
                FOREIGN KEY (import_id)
                REFERENCES user_import (id);
            ');
            $this->addSql('
                ALTER TABLE user_import_line
                ADD CONSTRAINT FK_952393E3FF459ADA
                FOREIGN KEY (errors_id)
                REFERENCES user_import_line_error (id);
            ');
        }

        try
        {
            $table = $schema->getTable('user_import_line');
            $column = $table->getColumn('password');
        }
        catch(SchemaException $e)
        {
            $this->addSql('ALTER TABLE user_import_line ADD COLUMN password VARCHAR(255) NOT NULL');
        }

        try
        {
            $table = $schema->getTable('user_import_line_error');
            $column = $table->getColumn('password_ko');
        }
        catch(SchemaException $e)
        {
            $this->addSql('ALTER TABLE user_import_line_error ADD COLUMN password_ko TINYINT(1) NOT NULL');
        }

        //Due to historical reason in dev and production, remove a foreign key not inside this file 
        try
        {
            $table = $schema->getTable('user_import_line_error');
            $column = $table->getForeignKey('FK_98CC1ECA4D7B7542');
            $this->addSql('ALTER TABLE user_import_line_error DROP FOREIGN KEY FK_98CC1ECA4D7B7542');
        }
        catch(SchemaException $e) { }

        //Due to historical reason in dev and production, remove a field not inside this file 
        try
        {
            $table = $schema->getTable('user_import_line_error');
            $column = $table->getColumn('line_id');
            $this->addSql('ALTER TABLE user_import_line_error DROP COLUMN line_id');
        }
        catch(SchemaException $e) { }

        try
        {
            $table = $schema->getTable('user_import_line');
            $column = $table->getColumn('password');
            $this->addSql('ALTER TABLE user_import_line CHANGE password password VARCHAR(255) DEFAULT NULL;');
        }
        catch(SchemaException $e) { }

        $this->addSql('COMMIT');

    }
    /**
     * @param Schema $schema
     */
    public function down(Schema $schema) {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
