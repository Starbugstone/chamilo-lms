<?php
/* For licensing terms, see /license.txt */

namespace Chamilo\CoreBundle\Migrations\Schema\V110;

use Chamilo\CoreBundle\Migrations\AbstractMigrationChamilo;
use Doctrine\DBAL\Schema\Schema;

/**
 * Session date changes
 */
class Version20150528103216 extends AbstractMigrationChamilo
{
    /**
     * @param Schema $schema
     */
    public function up(Schema $schema)
    {
        $this->addSql('ALTER TABLE session ADD COLUMN access_start_date datetime NOT NULL');
        $this->addSql('ALTER TABLE session ADD COLUMN access_end_date datetime NOT NULL');
        $this->addSql('ALTER TABLE session ADD COLUMN coach_access_start_date datetime NOT NULL');
        $this->addSql('ALTER TABLE session ADD COLUMN coach_access_end_date datetime NOT NULL');
        $this->addSql('ALTER TABLE session ADD COLUMN display_start_date datetime NOT NULL');
        $this->addSql('ALTER TABLE session ADD COLUMN display_end_date datetime NOT NULL');

        $this->addSql('UPDATE session SET access_start_date = date_start');
        $this->addSql("UPDATE session SET access_end_date = CONVERT(CONCAT(date_end, ' 23:59:59'), DATETIME)");

        $this->addSql('UPDATE session SET coach_access_start_date = CONVERT(DATE_SUB(date_start, INTERVAL nb_days_access_before_beginning DAY), DATETIME) ');
        $this->addSql('UPDATE session SET coach_access_start_date = NULL WHERE nb_days_access_before_beginning = 0');

        $this->addSql('UPDATE session SET coach_access_end_date = CONVERT(DATE_ADD(date_end, INTERVAL nb_days_access_after_end DAY), DATETIME) ');
        $this->addSql('UPDATE session SET coach_access_end_date = NULL WHERE nb_days_access_after_end = 0');

        $this->addSql('UPDATE session SET display_start_date = access_start_date');
        $this->addSql('UPDATE session SET display_end_date = access_end_date');

        $this->addSql('ALTER TABLE session DROP date_start');
        $this->addSql('ALTER TABLE session DROP date_end');
        $this->addSql('ALTER TABLE session DROP nb_days_access_before_beginning');
        $this->addSql('ALTER TABLE session DROP nb_days_access_after_end');
    }

    /**
     * @param Schema $schema
     */
    public function down(Schema $schema)
    {
        $this->addSql('ALTER TABLE session CREATE date_start date NOT NULL');
        $this->addSql('ALTER TABLE session CREATE date_end date NOT NULL');
        $this->addSql('ALTER TABLE session CREATE nb_days_access_before_beginning TINYINT');
        $this->addSql('ALTER TABLE session CREATE nb_days_access_after_end TINYINT');

        $this->addSql('UPDATE session SET date_start = access_start_date');
        $this->addSql('UPDATE session SET date_end = access_end_date');

        $this->addSql('UPDATE session SET nb_days_access_before_beginning = DATEDIFF(access_start_date, coach_access_start_date) WHERE access_start_date != coach_access_start_date AND coach_access_start_date IS NOT NULL');
        $this->addSql('UPDATE session SET nb_days_access_after_end = DATEDIFF(coach_access_end_date, coach_access_end_date) WHERE access_end_date != coach_access_end_date AND coach_access_end_date IS NOT NULL');
        $this->addSql('UPDATE session SET nb_days_access_before_beginning = 0 WHERE access_start_date = coach_access_start_date OR coach_access_start_date IS NULL');
        $this->addSql('UPDATE session SET nb_days_access_after_end = 0 WHERE access_end_date = coach_access_end_date OR coach_access_end_date IS NULL');

        $this->addSql('ALTER TABLE session DROP access_start_date');
        $this->addSql('ALTER TABLE session DROP access_end_date');
        $this->addSql('ALTER TABLE session DROP coach_access_start_date');
        $this->addSql('ALTER TABLE session DROP coach_access_end_date');
        $this->addSql('ALTER TABLE session DROP display_start_date');
        $this->addSql('ALTER TABLE session DROP display_end_date');
    }
}
