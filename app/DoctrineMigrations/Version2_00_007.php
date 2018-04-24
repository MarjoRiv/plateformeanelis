<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Schema\SchemaException;


class Version2_00_007 extends AbstractMigration {
    /**
     * @param Schema $schema
     *
     * 17 sql queries
     */
    public function up(Schema $schema) {


        /**
         * Création de la table newsletter et remplissage de base
         */
          try {
          	
              $table = $schema->getTable('newsletter');
          }
          catch(SchemaException $e){
           $this->addSql('CREATE TABLE newsletter (id INT AUTO_INCREMENT NOT NULL, newsletter VARCHAR(255) NOT NULL, commentaire VARCHAR(255) , frequence VARCHAR(255), mailjet_id VARCHAR(255) NOT NULL DEFAULT "0", PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;');
           $this->addSql('INSERT INTO `newsletter` (`id`, `newsletter`, `commentaire`, `frequence`) VALUES(1,"Newsletter Anelis","Actualité sur la vie de ISIMA et de l\'Anelis, des anciens (naissance, mariage, création d\'entreprise...) et du BDE","Tous les deux mois");');
           $this->addSql('INSERT INTO `newsletter` (`id`, `newsletter`, `commentaire`, `frequence`) VALUES(2,"Newsletter Events","Tous les événements en France","Mensuel");');
           $this->addSql('INSERT INTO `newsletter` (`id`, `newsletter`, `commentaire`, `frequence`) VALUES(3,"Newsletter Emplois","Recherche d\'emploi","Mensuel");');
           $this->addSql('INSERT INTO `newsletter` (`id`, `newsletter`, `commentaire`, `frequence`) VALUES(4,"Newsletter Isima","Tout ce qui se passe à l\'isima","Mensuel");');
          }

        /**
         * Création de la table subscriber avec la conversion des anciens abonnements en nouveaux
         */
          try {
          	
	          $table = $schema->getTable('subscriber');
          }
          catch(SchemaException $e){
            $this->addSql('CREATE TABLE subscriber (user_id INT NOT NULL, newsletter_id INT NOT NULL, INDEX IDX_AD005B69A76ED395 (user_id), INDEX IDX_AD005B6922DB1917 (newsletter_id), PRIMARY KEY(user_id, newsletter_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;;');
            $this->addSql('ALTER TABLE subscriber ADD CONSTRAINT FK_AD005B69A76ED395 FOREIGN KEY (user_id) REFERENCES User (id);');
            $this->addSql('ALTER TABLE subscriber ADD CONSTRAINT FK_AD005B6922DB1917 FOREIGN KEY (newsletter_id) REFERENCES newsletter (id);');
            $this->addSql('INSERT INTO `subscriber` (`user_id`, `newsletter_id`) SELECT `User`.`id`,`newsletter`.`id` FROM User INNER JOIN newsletter ON mlInformations = 1 WHERE `newsletter`.`id` = 1;');
            $this->addSql('INSERT INTO `subscriber` (`user_id`, `newsletter_id`) SELECT `User`.`id`,`newsletter`.`id` FROM User INNER JOIN newsletter ON mlEvents = 1 WHERE `newsletter`.`id` = 2;');
            $this->addSql('INSERT INTO `subscriber` (`user_id`, `newsletter_id`) SELECT `User`.`id`,`newsletter`.`id` FROM User INNER JOIN newsletter ON mlEmployment = 1 WHERE `newsletter`.`id` = 3;');
            $this->addSql('INSERT INTO `subscriber` (`user_id`, `newsletter_id`) SELECT `User`.`id`,`newsletter`.`id` FROM User INNER JOIN newsletter ON mlIsimaNews = 1 WHERE `newsletter`.`id` = 4;');
          }


        /**
         * Suppression des anciennes colonnes dans user
         */
          try {
	        $table = $schema->getTable('User');
            $column = $table->getColumn('mlInformations');
	        $this->addSql('ALTER TABLE User DROP mlInformations;');
          }
          catch(SchemaException $e){
          }

          try {
	        $table = $schema->getTable('User');
            $column = $table->getColumn('mlEmployment');
	        $this->addSql('ALTER TABLE User DROP mlEmployment;');
          }
          catch(SchemaException $e){
          }
          try {
	        $table = $schema->getTable('User');
            $column = $table->getColumn('mlEvents');
	        $this->addSql('ALTER TABLE User DROP mlEvents;');
          }
          catch(SchemaException $e){
          }
          try {
	        $table = $schema->getTable('User');
            $column = $table->getColumn('mlIsimaNews');
	        $this->addSql('ALTER TABLE User DROP mlIsimaNews;');
          }
          catch(SchemaException $e){
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
