<?php

namespace DMKClub\Bundle\MemberBundle\Migrations\Schema\v1_3;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\DBAL\Types\Type;

use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

use Oro\Bundle\EntityBundle\EntityConfig\DatagridScope;
use Oro\Bundle\EntityExtendBundle\EntityConfig\ExtendScope;
use Oro\Bundle\EntityExtendBundle\Migration\ExtendOptionsManager;
use Oro\Bundle\EntityExtendBundle\Migration\Extension\ExtendExtension;
use Oro\Bundle\EntityExtendBundle\Migration\Extension\ExtendExtensionAwareInterface;
use Oro\Bundle\EntityExtendBundle\Migration\OroOptions;
use Oro\Bundle\MigrationBundle\Migration\Migration;
use Oro\Bundle\MigrationBundle\Migration\OrderedMigrationInterface;
use Oro\Bundle\MigrationBundle\Migration\ParametrizedSqlMigrationQuery;
use Oro\Bundle\MigrationBundle\Migration\QueryBag;
use OroCRM\Bundle\SalesBundle\Entity\Opportunity;
use DMKClub\Bundle\MemberBundle\Entity\MemberProposal;
use DMKClub\Bundle\MemberBundle\Migrations\Schema\DMKClubMemberBundleInstaller;

class AddProposalStatus implements
    Migration,
    ExtendExtensionAwareInterface,
    ContainerAwareInterface,
    OrderedMigrationInterface
{
    /** @var ContainerInterface */
    protected $container;

    /** @var ExtendExtension */
    protected $extendExtension;

    /**
     * {@inheritdoc}
     */
    public function getOrder()
    {
        return 1;
    }

    /**
     * @param ExtendExtension $extendExtension
     */
    public function setExtendExtension(ExtendExtension $extendExtension)
    {
        $this->extendExtension = $extendExtension;
    }

    /**
     * {@inheritdoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    /**
     * {@inheritdoc}
     */
    public function up(Schema $schema, QueryBag $queries)
    {
        DMKClubMemberBundleInstaller::addMemberProposalStatusField($schema, $queries, $this->extendExtension);
    }

}
