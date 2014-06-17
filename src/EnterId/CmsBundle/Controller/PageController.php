<?php

namespace EnterId\CmsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use EnterId\CmsBundle\Entity\Page;

class PageController extends Controller
{
    /**
     * @Route("/page/{slug}")
     * @ParamConverter("post", class="EnterIdCmsBundle:Page")
     *
     * @Template()
     */
    public function indexAction(Page $page)
    {
        return $this->render(
            'EnterIdCmsBundle:Page:'.$page->getTemplate(),
            array('page' => $page)
        );
    }
}
