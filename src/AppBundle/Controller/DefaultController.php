<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Category;
use AppBundle\Entity\Product;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $categoryRepository = $this->getDoctrine()->getManager()->getRepository('AppBundle:Category');
        $categories = $categoryRepository->findAll();

        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', array(
            'categories' => $categories
        ));
    }

    /**
     * @Route("/category/{id}", name="category")
     * @param Category $category
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function categoryAction(Category $category)
    {
        return $this->render('default/category.html.twig', array(
            'category' => $category,
        ));

    }

    /**
     * @Route("/view-item/{id}", name="view_item")
     * @param Product $product
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function itemAction(Product $product)
    {
        return $this->render('default/product.html.twig', array(
            'product' => $product,
        ));
    }
}
