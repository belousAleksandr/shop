<?php

namespace AdminBundle\Admin;

use AppBundle\Entity\Product;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class ProductAdmin extends BaseAdmin
{
    /**
     * The related field reflection, ie if OrderElement is linked to Order,
     * then the $parentReflectionProperty must be the ReflectionProperty of
     * the order (OrderElement::$order).
     *
     * @var \ReflectionProperty
     */
    protected $parentAssociationMapping = 'store';

    /**
     * {@inheritdoc}
     */
    public function createQuery($context = 'list')
    {
        $store = $this->getParent()->getSubject();
        $query = parent::createQuery($context);

        // Filter stores by user
        $query
            ->andWhere($query->expr()->eq($query->getRootAliases()[0].'.store', ':store'))
            ->setParameter('store', $store);
        return $query;
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('category')
            ->add('name')
            ->add('price')
        ;
    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->add('id')
            ->add('name')
            ->add('category')
            ->add('price')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name')
            ->add('category')
            ->add('price')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('name')
            ->add('price')
        ;
    }
}
