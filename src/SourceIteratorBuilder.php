<?php
/**
 * Copyright WideFocus. See LICENSE.txt.
 * https://www.widefocus.net
 */

namespace WideFocus\Feed\Source\Builder;

use WideFocus\Feed\Entity\FeedInterface;
use WideFocus\Feed\Source\Builder\Manager\IdentitySourceManagerInterface;
use WideFocus\Feed\Source\Iterator\SourceIteratorFactoryInterface;
use WideFocus\Feed\Source\Iterator\SourceIteratorInterface;

class SourceIteratorBuilder implements SourceIteratorBuilderInterface
{
    /**
     * @var SourceIteratorFactoryInterface
     */
    private $sourceIteratorFactory;

    /**
     * @var IdentitySourceManagerInterface
     */
    private $identitySourceManager;

    /**
     * @var SourceConditionBuilderInterface
     */
    private $sourceConditionBuilder;

    /**
     * @var SourceFieldBuilderInterface
     */
    private $sourceFieldBuilder;

    /**
     * @var SourceParametersBuilderInterface
     */
    private $parametersBuilder;

    /**
     * Constructor.
     *
     * @param SourceIteratorFactoryInterface   $sourceIteratorFactory
     * @param IdentitySourceManagerInterface   $identitySourceManager
     * @param SourceConditionBuilderInterface  $sourceConditionBuilder
     * @param SourceFieldBuilderInterface      $sourceFieldBuilder
     * @param SourceParametersBuilderInterface $parametersBuilder
     */
    public function __construct(
        SourceIteratorFactoryInterface $sourceIteratorFactory,
        IdentitySourceManagerInterface $identitySourceManager,
        SourceConditionBuilderInterface $sourceConditionBuilder,
        SourceFieldBuilderInterface $sourceFieldBuilder,
        SourceParametersBuilderInterface $parametersBuilder
    ) {
        $this->sourceIteratorFactory  = $sourceIteratorFactory;
        $this->identitySourceManager  = $identitySourceManager;
        $this->sourceConditionBuilder = $sourceConditionBuilder;
        $this->sourceFieldBuilder     = $sourceFieldBuilder;
        $this->parametersBuilder      = $parametersBuilder;
    }

    /**
     * Build a source iterator for a feed entity.
     *
     * @param FeedInterface $feed
     *
     * @return SourceIteratorInterface
     */
    public function buildIterator(
        FeedInterface $feed
    ): SourceIteratorInterface
    {
        $parameters = $this->parametersBuilder
            ->buildParameters($feed);

        return $this->sourceIteratorFactory->createIterator(
            $this->identitySourceManager->createSource(
                $feed->getSourceType(),
                $parameters
            ),
            $this->sourceConditionBuilder->buildConditions(
                $feed,
                $parameters
            ),
            $this->sourceFieldBuilder->buildFields(
                $feed,
                $parameters
            )
        );
    }
}
