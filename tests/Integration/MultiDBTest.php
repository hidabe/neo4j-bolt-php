<?php

namespace PTS\Bolt\Tests\Integration;

use PTS\Bolt\Configuration;
use PTS\Bolt\Protocol\SessionInterface;
use PTS\Bolt\Tests\IntegrationTestCase;
use PTS\Bolt\Driver;

/**
 * @group integration
 * @group V4+
 */
class MultiDBTest extends IntegrationTestCase
{
    public function testDatabaseSelect()
    {
        if ($this->getConfig()->getValue('version') < 4) {
            $this->markTestSkipped('Multidatabase feature only since V4+');
            return;
        }
        $config = $this->getConfig()->withDatabase('system');
        $this->setDriverWhithConfig($config);
        $session = $this->getSession();
        $result = $session->run('SHOW DATABASES');
        $this->assertEquals('system', $result->getSummary()->getDatabase());
    }
}
