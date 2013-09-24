<?php

namespace Acme\DemoBundle\Controller;

use APY\DataGridBundle\Grid\Source\Entity as GridEntity;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Acme\DemoBundle\Entity\Book;

/**
 * Book controller.
 *
 * @Route("/book")
 */
class BookController extends Controller
{

    /**
     * Lists all Book entities.
     *
     * @Route("/", name="book")
     * @Template()
     */
    public function indexAction()
    {
        $authors = $this->getDoctrine()->getRepository('AcmeDemoBundle:Author')->findAll();
        
        $source = new GridEntity('AcmeDemoBundle:Book');
        $grid = $this->get('grid');
        $grid
            ->setSource($source)
            ->setDefaultOrder('id', 'asc')
            ->getColumn('authors.name')->manipulateRenderCell(
                function($value, $row, $router) {
                    $authors = [];
                    foreach ($row->getEntity()->getAuthors() as $author) {
                        $authors[] = $author->getName();
                    }
    
                    return implode(', ', $authors);
                }
            )->setValues(array_combine($authors, $authors));

        return $grid->getGridResponse();
    }

    /**
     * Lists all Book entities. (alt)
     *
     * @Route("/alt", name="book_alt")
     * @Method("GET")
     * @Template()
     */
    public function altAction()
    {
        $books = $this->getDoctrine()->getRepository('AcmeDemoBundle:Book')->findAll();

        return compact('books');
    }

    /**
     * Finds and displays a Book entity.
     *
     * @Route("/{id}", name="book_show")
     * @Method("GET")
     * @Template()
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('AcmeDemoBundle:Book')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Book entity.');
        }

        return array(
            'entity'      => $entity,
        );
    }
}
