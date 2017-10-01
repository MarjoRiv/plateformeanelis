<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Schema\SchemaException;


class Version2_00_006 extends AbstractMigration {
    /**
     * @param Schema $schema
     *
     * 3 sql queries
     */
    public function up(Schema $schema) {

          try {
              $table = $schema->getTable('Parameters');
              $this->addSql('INSERT INTO `Parameters` (`name`, `type`, `value`) VALUES("anelis.cotisation.cotisationReduiteText","html","Votre promotion n\'est pas encore diplomée ou vient de l\'être, vous bénéficiez
                                  donc du tarif réduit.")');
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
