<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Schema\SchemaException;


class Version2_00_004 extends AbstractMigration {
    /**
     * @param Schema $schema
     *
     * 3 sql queries
     */
    public function up(Schema $schema) {
        try {
            $table = $schema->getTable('Parameters');
            $this->addSql('INSERT INTO `Parameters` (`name`, `type`, `value`) VALUES
("anelis.cotisation.cotisationEnAttenteText", "html", "Vous pouvez payez en ligne par Carte Bancaire ou Paypal en cliquant sur le bouton Paypal ci-dessous. 

Vous pouvez également régler :
<ul>

                            <li>Par chèque à l\'ordre de l\'<b>Anelis</b></li>

                            <li>Par virement bancaire (merci de préciser nom et prénom dans l\'objet du virement) : <br/><b>FR76 1680 6050 0066 0746 3319 725</b></li>

                            <li>En espèces, en contactant un membre Anelis </li>

                            </ul>
                            
                            \r\n En cas de problèmes ou questions, merci de contacter support@anelis.org
");');
        }catch (SchemaException $e)
        {}

        $this->addSql('ALTER TABLE Cotisation ADD datePaiement DATE DEFAULT NULL;');

        $this->addSql('COMMIT;');
    }
    /**
     * @param Schema $schema
     */
    public function down(Schema $schema) {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
