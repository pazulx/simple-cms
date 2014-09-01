<?php

namespace EnterId\CmsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Filesystem\Filesystem;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

use EnterId\CmsBundle\Entity\Page;
use Symfony\Component\HttpFoundation\Request;

class PageController extends Controller
{

    /**
     * @Route("/index")
     *
     */
    public function indexAction()
    {
        $response = $this->render('EnterIdCmsBundle:Page:index.html.twig');
        // set the shared max age - which also marks the response as public
        $response->setPublic();
        $response->setSharedMaxAge(600);

        return $response;
    }

    /**
     * @Route("/news")
     *
     */
    public function newsAction()
    {
        $response = $this->render('EnterIdCmsBundle:Page:news.html.twig');
        // ...

        $response->setPublic();
        $response->setSharedMaxAge(15);
        return $response;
    }

    /**
     * @Route("/page/{slug}.html")
     * @ParamConverter("post", class="EnterIdCmsBundle:Page")
     *
     * @Template()
     */
    public function pageAction(Page $page)
    {
        $output = $this->render(
            'EnterIdCmsBundle:Page:'.$page->getTemplate(),
            array('page' => $page)
        );

        //$fs = new Filesystem();

        //$staticHtmlPath = $this->container->getParameter('static_html_path');

        //$filename = $staticHtmlPath."/{$page->getSlug()}.html";

        //$fs->dumpFile($filename, $output->getContent());

        return $output;
    }

    /**
     * @Route("/contact")
     * @Template()
     */
    public function contactAction(Request $request)
    {
        //$form = $this->createForm(new EnquiryType());

        //if ($request->getMethod() == 'POST') {
            //$form->bind($request);

            //if ($form->isValid()) {

                //$data = $form->getData();

                //$message = \Swift_Message::newInstance()
                    //->setSubject($this->get('translator')->trans('Zapytanie do fileshark.pl'))
                    //->setFrom(
                        //$this->container
                            //->getParameter('enter_id_site.emails.contact_email')
                    //)
                    //->setTo(
                        //$this->container
                            //->getParameter('enter_id_site.emails.contact_email')
                    //)
                    //->setReplyTo($data['email'])
                    //->setBody(
                        //$this->renderView(
                            //'EnterIdSiteBundle:Page:contactEmail.txt.twig',
                            //array('enquiry' => $data)
                        //)
                    //);

                //$this->get('mailer')->send($message);

                //$this->get('session')->getFlashBag()->add(
                    //'notice-success',
                    //'enterid.site.page.messages.contact.success'
                //);


                //// Redirect - This is important to prevent users re-posting
                //// the form if they refresh the page
                //return $this->redirect(
                    //$this->generateUrl($request->get('_route'))
                //);
            //}
        //}

        //return array( 'form' => $form->createView() );
        return array();
    }
}
