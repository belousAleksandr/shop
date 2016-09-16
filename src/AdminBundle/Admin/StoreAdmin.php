<?php

namespace AdminBundle\Admin;

use AppBundle\Entity\Store;
use Knp\Menu\ItemInterface as MenuItemInterface;
use Sonata\AdminBundle\Admin\AdminInterface;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class StoreAdmin extends BaseAdmin
{

    /**
     * {@inheritdoc}
     */
    public function createQuery($context = 'list')
    {
        $query = parent::createQuery($context);

        // Filter stores by user
        $query
            ->leftJoin($query->getRootAliases()[0].'.users', 'users')
            ->andWhere($query->expr()->eq('users.id', ':user_id'))
            ->setParameter('user_id', $this->getUser()->getId());
        return $query;
    }

    /**
     * @param DatagridMapper $datagridMapper
     */
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('id')
            ->add('name')
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
        ;
    }

    /**
     * Configures the tab menu in your admin.
     *
     * @param MenuItemInterface $menu
     * @param                   $action
     * @param AdminInterface    $childAdmin
     *
     * @return mixed
     */
    protected function configureTabMenu(MenuItemInterface $menu, $action, AdminInterface $childAdmin = null)
    {
       if(is_null($childAdmin)) {
            $subject = $this->getSubject();

            if($subject && $subject->getId()) {
                /** @var AdminInterface $child */
                foreach ($this->getChildren() as $child) {
                    $menu->addChild(
                        $child->getLabel(),
                        array('uri' => $child->generateUrl('list'))
                    );

                }
            }
       }
    }

    /**
     * @param Store $object
     */
    public function prePersist($object)
    {
        $object->addUser($this->getUser());
    }

    /**
     * @param Store $object
     */
    public function preUpdate($object)
    {
        $object->addUser($this->getUser());
    }
}
