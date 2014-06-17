<?php

namespace EnterId\CmsBundle\Twig;

use JMS\DiExtraBundle\Annotation\Service;
use JMS\DiExtraBundle\Annotation\Tag;
use JMS\DiExtraBundle\Annotation\Inject;
use JMS\DiExtraBundle\Annotation\InjectParams;

use Doctrine\ORM\EntityManager;

/**
 * TwigExtension
 *
 * @Service("enterid_cmsbundle_twig_extension", public=true)
 * @Tag("twig.extension")
 *
 * @author Piotr Kazulak <pazulx@gmail.com>
 */
class TwigExtension extends \Twig_Extension
{
    /**
     * em
     *
     * @var EntityManager
     * @access private
     */
    private $em;

    /**
     * templating
     *
     * @var mixed
     * @access private
     */
    private $templating;

    private $environment;

    /**
     * @InjectParams({
     *     "em" = @Inject("doctrine.orm.entity_manager"),
     * })
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }

    /**
     * initRuntime
     *
     * @param \Twig_Environment $environment
     * @access public
     * @return void
     */
    public function initRuntime(\Twig_Environment $environment)
    {
        $this->environment = $environment;
    }

    /**
     * getFunctions
     *
     * @access public
     * @return void
     */
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('renderWidget', array($this, 'renderWidget'), array('is_safe' => array('html'))),
        );
    }

    /**
     * renderWidget
     *
     * @param mixed $name
     * @access public
     * @return void
     */
    public function renderWidget($name)
    {
        $widget = $this->em->getRepository('EnterIdCmsBundle:Widget')
            ->findOneByName($name);

        if (!$widget){
            throw new \Exception("Widget not found: $name");
        }

        //$output widgetService->render();
        $output = $this->environment->render('EnterIdCmsBundle:Widget:'.$widget->getTemplate());

        return $output;
    }

    /**
     * getName
     *
     * @access public
     * @return void
     */
    public function getName()
    {
        return 'twig_extension';
    }
}
