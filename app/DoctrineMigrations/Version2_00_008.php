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

          try {
          	
              $table = $schema->getTable('user_import');
          }
          catch(SchemaException $e){
           $this->addSql('CREATE TABLE user_import (id INT AUTO_INCREMENT NOT NULL, createdDate DATE NOT NULL, lastRunDate DATE NOT NULL, state INT NOT NULL, PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;');
          }


          try {

              $table = $schema->getTable('user_import_line');
          }
          catch(SchemaException $e){
           $this->addSql('CREATE TABLE user_import_line (id INT AUTO_INCREMENT NOT NULL, import_id INT DEFAULT NULL, errors_id INT DEFAULT NULL, login VARCHAR(255) NOT NULL, mail VARCHAR(255) NOT NULL, prenom VARCHAR(255) NOT NULL, nom VARCHAR(255) NOT NULL, promo VARCHAR(255) NOT NULL, filliere VARCHAR(255) NOT NULL, adresse VARCHAR(255) NOT NULL, telephone VARCHAR(255) NOT NULL, state INT NOT NULL, action INT NOT NULL, INDEX IDX_952393E3B6A263D9 (import_id), UNIQUE INDEX UNIQ_952393E3FF459ADA (errors_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;');
          }

        try {

            $table = $schema->getTable('user_import_line_error');
        }
        catch(SchemaException $e){
            $this->addSql('CREATE TABLE user_import_line_error (id INT AUTO_INCREMENT NOT NULL, line_id INT DEFAULT NULL, email_ko TINYINT(1) NOT NULL, login_cant_generate TINYINT(1) NOT NULL, login_ko TINYINT(1) NOT NULL, login_not_found TINYINT(1) NOT NULL, UNIQUE INDEX UNIQ_98CC1ECA4D7B7542 (line_id), PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;');
            $this->addSql('ALTER TABLE user_import_line ADD CONSTRAINT FK_952393E3B6A263D9 FOREIGN KEY (import_id) REFERENCES user_import (id);');
            $this->addSql('ALTER TABLE user_import_line ADD CONSTRAINT FK_952393E3FF459ADA FOREIGN KEY (errors_id) REFERENCES user_import_line_error (id);');
            $this->addSql('ALTER TABLE user_import_line_error ADD CONSTRAINT FK_98CC1ECA4D7B7542 FOREIGN KEY (line_id) REFERENCES user_import_line (id);');
        }

        $this->addSql('COMMIT');

    }
    /**
     * @param Schema $schema
     */
    public function down(Schema $schema) {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
