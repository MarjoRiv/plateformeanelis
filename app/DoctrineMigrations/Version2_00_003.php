<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Schema\SchemaException;


class Version2_00_003 extends AbstractMigration {
    /**
     * @param Schema $schema
     *
     * 3 sql queries
     */
    public function up(Schema $schema) {
        try {
            $table = $schema->getTable('Parameters');
            $this->addSql('TRUNCATE TABLE Parameters;');
            $this->addSql('INSERT INTO `Parameters` (`id`, `name`, `type`, `value`) VALUES
(1, "anelis.accueil.welcomeText", "html", "Salut et bienvenue sur la nouvelle plateforme <strong>ANELIS</strong>, l\'association des <strong>AN</strong>ciens <strong>É</strong>lèves de <strong>L</strong>\'<strong>IS</strong>ima !<br>\r\n                                   <br>\r\n                                   Vous êtes sur la <strong>version bêta</strong> de la plateforme. Si vous trouvez des bugs ou des pistes d\'améliorations, n\'hésitez pas à nous les <a href=\"https://bitbucket.org/Dawlys/plateformeanelis/issues?status=new&status=open\" target=\"_blank\">signaler</a>. \r\n                                   <br><br>\r\n                                   ANELIS lance actuellement une grande <strong>campagne pour retrouver un maximum d\'anciens</strong> dont on a perdu les e-mails. <strong>Nous avons besoin de vous</strong>, alors si vous avez un petit peu de temps, <a href=\"mailto:support@anelis.org\">contactez-nous</a>.\r\n                                   <br><br>\r\n                                   En vous remerciant d\'avance\r\n                                   <br>\r\n                                   L\'équipe ANELIS"),
(2, "anelis.cotisation.staticCotisationText", "html", "<h3>Pourquoi Cotiser ?</h3>\r\n           Cotiser permet à l\'association d\'évoluer et de subvenir aux différents besoins financiers comme la maintenance et l\'hébergement de cette plateforme ou encore l\'organisation d\'évènements !\r\n           Cela vous donne également des avantages comme la possibilité de proposer des offres aux ZZ et de consulter le profil des personnes !"),
(3, "anelis.accueil.isMaintenance", "boolean", "0");');
        }catch (SchemaException $e)
        {}

        $this->addSql('COMMIT;');
    }
    /**
     * @param Schema $schema
     */
    public function down(Schema $schema) {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
