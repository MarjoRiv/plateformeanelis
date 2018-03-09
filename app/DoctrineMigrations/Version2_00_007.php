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

          try {
          	
              $table = $schema->getTable('newsletter');
          }
          catch(SchemaException $e){
           $this->addSql('CREATE TABLE newsletter (id INT AUTO_INCREMENT NOT NULL, newsletter VARCHAR(255) NOT NULL, commentaire VARCHAR(255) NOT NULL, frequence VARCHAR(255) NOT NULL, mailjet_id VARCHAR(255) NOT NULL DEFAULT "0", PRIMARY KEY(id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;');
           //on remplie la table newsletter avec les 4 newsletters précédantes
           $this->addSql('INSERT INTO `newsletter` (`id`, `newsletter`, `commentaire`, `frequence`) VALUES(1,"mlEmployments","Recherche d\'emploi","mensuel");');
           $this->addSql('INSERT INTO `newsletter` (`id`, `newsletter`, `commentaire`, `frequence`) VALUES(2,"mlEvents","Tout les événements en France","mensuel");');
           $this->addSql('INSERT INTO `newsletter` (`id`, `newsletter`, `commentaire`, `frequence`) VALUES(3,"mlInformations","Information à ne pas louper","annuel");');
           $this->addSql('INSERT INTO `newsletter` (`id`, `newsletter`, `commentaire`, `frequence`) VALUES(4,"mlIsimaNews","Tout ce qui ce passe à l\'isima","tout les 5 mois");');
          }
          try {
          	
	          $table = $schema->getTable('subscriber');
          }
          catch(SchemaException $e){
            //on créer la table subscriber (table d'association)
            $this->addSql('CREATE TABLE subscriber (user_id INT NOT NULL, newsletter_id INT NOT NULL, INDEX IDX_AD005B69A76ED395 (user_id), INDEX IDX_AD005B6922DB1917 (newsletter_id), PRIMARY KEY(user_id, newsletter_id)) DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE = InnoDB;;');
            $this->addSql('ALTER TABLE subscriber ADD CONSTRAINT FK_AD005B69A76ED395 FOREIGN KEY (user_id) REFERENCES User (id);');
            $this->addSql('ALTER TABLE subscriber ADD CONSTRAINT FK_AD005B6922DB1917 FOREIGN KEY (newsletter_id) REFERENCES newsletter (id);');
            //on remplie la table d'association (id user // id newsletter) por les utilisateur voullant la newsletter
            $this->addSql('INSERT INTO `subscriber` (`user_id`, `newsletter_id`) SELECT `user`.`id`,`newsletter`.`id` FROM user INNER JOIN newsletter ON mlInformations = 1 WHERE `newsletter`.`newsletter` = "mlInformations";');
            $this->addSql('INSERT INTO `subscriber` (`user_id`, `newsletter_id`) SELECT `user`.`id`,`newsletter`.`id` FROM user INNER JOIN newsletter ON mlEmployment = 1 WHERE `newsletter`.`newsletter` = "mlEmployments";');
            $this->addSql('INSERT INTO `subscriber` (`user_id`, `newsletter_id`) SELECT `user`.`id`,`newsletter`.`id` FROM user INNER JOIN newsletter ON mlEvents = 1 WHERE `newsletter`.`newsletter` = "mlEvents";');
            $this->addSql('INSERT INTO `subscriber` (`user_id`, `newsletter_id`) SELECT `user`.`id`,`newsletter`.`id` FROM user INNER JOIN newsletter ON mlIsimaNews = 1 WHERE `newsletter`.`newsletter` = "mlIsimaNews";');
          }



         //on supprie les 4 newsletter hardcodder
          try {
	        $table = $schema->getTable('user');
            $column = $table->getColumn('mlInformations');
	        $this->addSql('ALTER TABLE user DROP mlInformations;');
          }
          catch(SchemaException $e){
          }

          try {
	        $table = $schema->getTable('user');
            $column = $table->getColumn('mlEmployment');
	        $this->addSql('ALTER TABLE user DROP mlEmployment;');
          }
          catch(SchemaException $e){
          }
          try {
	        $table = $schema->getTable('user');
            $column = $table->getColumn('mlEvents');
	        $this->addSql('ALTER TABLE user DROP mlEvents;');
          }
          catch(SchemaException $e){
          }
          try {
	        $table = $schema->getTable('user');
            $column = $table->getColumn('mlIsimaNews');
	        $this->addSql('ALTER TABLE user DROP mlIsimaNews;');
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
